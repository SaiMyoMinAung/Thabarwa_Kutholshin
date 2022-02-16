@extends('adminlte::page')

@section('title', 'Donated Items')

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

@section('content_header')
@include('backend.partials.admininfo')
<div class="row">

    @can('create-internal-donated-items')
    <a href="{{route('internal_donated_items.create')}}" style="min-width: 250px" class="btn btn-success">{{trans('button.add_new_item_to_store')}}</a>
    @endcan
    <h1 class="ml-5">
        {{trans('title.store_list')}}
    </h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="input-daterange input-group pb-1" id="datepicker">
            <input type="text" class="form-control" name="date" id="date" placeholder="Date" autocomplete="off">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group pb-1">
            <select class="form-control" id="export">
                <option>Select To Download</option>
                <option value="excel">Excel File</option>
                <option value="pdf">PDF File</option>
            </select>
        </div>
    </div>
</div>

<table id="internalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>{{trans('input.date')}}</th>
            <th>{{trans('input.alms_round')}}</th>
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
    function format(d, uuid) {
        return $.get('generate-internal-donated-item-list', {
            "data": d.detail_data,
            "uuid": uuid
        }, function(data, status, xhr) {
            return data;
        })
    }

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
        let url = "{{ route('internal_donated_items.index') }}" + "?date=" + today
        var dataTable = $('#internalDonatedItemTable').DataTable({
            "language": {
                "zeroRecords": "စာရင်း ထည့်သွင်းထားခြင်း မရှိပါ။"
            },
            createdRow: function(row, data, dataIndex) {
                $(row).attr('id', data.id);
            },
            dom: 't',
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": url,
            },
            "order": [
                [1, 'desc']
            ],
            "columns": [{
                    "class": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": ""
                }, {
                    "data": "date",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "alms_round_name",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "item_sub_type_count",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        var detailRows = [];

        $('#internalDonatedItemTable tbody').on('click', 'tr td.details-control', async function() {
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
                let uuid = localStorage.getItem('internal_donateditem_uuid')

                format(row.data(), uuid).then(await
                    function(res) {
                        row.child(res).show();
                        // remove saved uuid from local storage
                        localStorage.removeItem('internal_donateditem_uuid')
                        // activate yes cancel tooltip
                        activateToggle()
                    })


                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
            localStorage.setItem('detailRowsForIDI', JSON.stringify(detailRows));
        });

        // On each draw, loop over the `detailRows` array and show any child rows
        dataTable.on('draw', function() {
            let id = JSON.parse(localStorage.getItem('detailRowsForIDI'));
            $.each(id, function(i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });

        });

        $("#date").change(function() {
            var date = $(this).val()
            localStorage.setItem('internalDonatedItemDate', date);
            var new_url = location.protocol + '//' + location.host + location.pathname + '?date=' + date;
            dataTable.ajax.url(new_url).load();
        })

        function activateToggle() {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                // other options
                onConfirm: function(value) {
                    let href = $(this).data('href')
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
                    localStorage.setItem('internal_donateditem_uuid', uuid);
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