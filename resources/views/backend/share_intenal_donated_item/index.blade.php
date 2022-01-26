@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"> -->
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
<div class="d-flex justify-content-center">
    <h1>{{trans('title.shared_list_of_store')}}</h1>
</div>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-success" style="min-width: 250px" href="{{route('share_internal_donated_items.create')}}">{{trans('button.add_share_list')}}</a>
    </div>
</div>
@stop

@section('content')
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        function format(d, uuid) {
            return $.get('generate-share-internal-donated-item-list', {
                "data": d.detail_data,
                "uuid": uuid
            }, function(data, status, xhr) {
                return data;
            })
        }

        let dataTable = $('#shareInternalDonatedItemTable').DataTable({
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
                "url": "{{ route('share_internal_donated_items.index') }}",
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