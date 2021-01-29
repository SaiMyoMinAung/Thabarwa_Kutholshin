@extends('adminlte::page')

@section('title', 'Donated Items')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@stop

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Internal Donated Item list</h1>
    </div>
    <a href="{{route('internal_donated_items.create')}}" class="btn btn-success">Input Item</a>
</div>

@stop

@section('content')
<table id="internalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Item Unique Id</th>
            <th>Name</th>
            <th>QTY</th>
            <th>Item Type</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
    </tbody>

</table>
@stop

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let dataTable = $('#internalDonatedItemTable').DataTable({
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('internal_donateditem_uuid')

                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('internal_donateditem_uuid')
                }

            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('internal_donated_items.index') }}",
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false
                },
                {
                    "data": "item_unique_id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "item_type"
                },
                {
                    "data": "status"
                },
                {
                    "data": "option",
                    orderable: false,
                    searchable: false
                },
            ]
        });

        dataTable.on('draw', function() {
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
        });

    });
</script>
@stop