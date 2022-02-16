@extends('adminlte::page')

@section('css')
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<style>
    td.details-control {
        background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>
@stop

@section('title', 'Shared List Of Store')

@section('content_header')
@include('backend.partials.admininfo')
<div class="row">
    @can('create-share-internal-donated-item')
    <a class="btn btn-success" style="min-width: 250px" href="{{route('share_internal_donated_items.create')}}">{{trans('button.add_share_list')}}</a>
    @endcan
    <h1 class="ml-5">
        {{trans('title.shared_list_of_store')}}
    </h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="input-daterange input-group" id="datepicker">
            <input type="text" class="form-control" name="date" id="date" placeholder="Date" autocomplete="off">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control" id="export">
                <option disabled selected>Select To Download</option>
                <option value="excel">Excel File</option>
                <!-- <option value="pdf">PDF File</option> -->
            </select>
        </div>
    </div>
</div>

<table id="shareInternalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>{{trans('input.date')}}</th>
            <th style="max-width: 200px;">{{trans('input.name')}}</th>
            <th>{{trans('input.qty')}}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop

@section('js')
<script src="{{ asset('js/backend/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function() {

        if (localStorage.getItem('internalDonatedItemDate')) {
            var today = localStorage.getItem('internalDonatedItemDate');
        } else {
            var today = new Date().toISOString().substr(0, 10);
        }
        
        document.querySelector("#date").value = today;

        $("#date").datepicker({
            format: 'yyyy-mm-dd',
            "autoclose": true
        });

        $('#export').change(function($event) {
            var date = $("#date").val()
            var self = this;
            var value = $event.target.value
            var url = window.location.href + '?export=' + value + '&date=' + date

            $.ajax({
                url,
                xhrFields: {
                    responseType: 'blob',
                },
                success: function(result, status, xhr) {
                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                    console.log(matches)
                    var filename = (matches != null && matches[1] ? matches[1].replaceAll('"', '') : '.xlsx');

                    // The actual download
                    var blob = new Blob([result], {
                        // type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                    document.getElementById('export').getElementsByTagName('option')[0].selected = 'selected'
                }
            })
        })

        function format(d, uuid) {
            return $.get('generate-share-internal-donated-item-list', {
                "data": d.detail_data,
                "uuid": uuid
            }, function(data, status, xhr) {
                return data;
            })
        }
        let url = "{{ route('share_internal_donated_items.index') }}" + "?date=" + today
        let dataTable = $('#shareInternalDonatedItemTable').DataTable({
            "language": {
                "zeroRecords": "စာရင်း ထည့်သွင်းထားခြင်း မရှိပါ။"
            },
            createdRow: function(row, data, dataIndex) {
                $(row).attr('id', data.id);
            },
            dom: "t",
            "order": [
                [1, 'desc']
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url,
            },
            "columns": [{
                    "class": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": ""
                }, {
                    "data": "date",
                    orderable: false,
                    searchable: false,
                },
                {
                    "data": "name",
                    orderable: false,
                    searchable: false,
                },
                {
                    "data": "count",
                    orderable: false,
                    searchable: false,
                }
            ]
        });

        var detailRows = [];

        $('#shareInternalDonatedItemTable tbody').on('click', 'tr td.details-control', async function() {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr);
            var idx = $.inArray(tr.attr('id'), detailRows);

            if (row.child.isShown()) {
                tr.removeClass('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');

                // to show edited mark color
                let uuid = localStorage.getItem('share_internal_donateditem_uuid')

                format(row.data(), uuid).then(await
                    function(res) {
                        row.child(res).show();
                        // remove saved uuid from local storage
                        localStorage.removeItem('share_internal_donateditem_uuid')
                        // activate yes cancel tooltip
                        activateToggle()
                    })


                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
            localStorage.setItem('detailRowsOfSIDI', JSON.stringify(detailRows));
        });

        // On each draw, loop over the `detailRows` array and show any child rows
        dataTable.on('draw', function() {
            let id = JSON.parse(localStorage.getItem('detailRowsOfSIDI'));
            $.each(id, function(i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });

        });

        $("#date").change(function() {
            var date = $(this).val()
            localStorage.setItem('shareInternalDonatedItemDate', date);
            var new_url = location.protocol + '//' + location.host + location.pathname + '?date=' + date;
            dataTable.ajax.url(new_url).load();
        })

        function activateToggle() {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                // other options
                onConfirm: function(value) {
                    let href = $(this).data('href')
                    console.log(href)
                    $('#delete-form').attr('action', href)
                    document.getElementById("delete-form").submit();
                },
                buttons: [{
                        class: 'btn btn-xs btn-danger pl-3 pr-3',
                        label: 'Yes',
                        value: 'Delete'
                    },
                    {
                        class: 'btn btn-xs btn-secondary pl-2 pr-2',
                        label: 'Cancel',
                        cancel: true
                    }
                ]
            });
            $('[data-toggle=editconfirmation]').confirmation({
                rootSelector: '[data-toggle=editconfirmation]',
                // other options
                onConfirm: function(value) {
                    let href = $(this).data('href')
                    let uuid = $(this).data('uuid')
                    localStorage.setItem('share_internal_donateditem_uuid', uuid);
                    window.location.href = href
                },
                buttons: [{
                        class: 'btn btn-xs btn-danger pl-3 pr-3',
                        label: 'Yes',
                        value: 'Delete'
                    },
                    {
                        class: 'btn btn-xs btn-secondary pl-2 pr-2',
                        label: 'Cancel',
                        cancel: true
                    }
                ]
            });

        }

    });
</script>
@stop