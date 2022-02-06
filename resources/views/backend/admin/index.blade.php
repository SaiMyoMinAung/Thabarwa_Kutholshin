@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@stop

@section('title', 'Admin List')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Admin List</h1>
    </div>
    <a href="{{route('admins.create')}}" class="btn btn-success">Create Admin</a>
</div>
@stop

@section('content')
<table id="adminTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th style="max-width: 200px;">Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Office</th>
            <th>Role</th>
            <th style="min-width: 105px;">Options</th>
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

        let dataTable = $('#adminTable').DataTable({
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('admin_edit_uuid')

                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('admin_edit_uuid')
                }

            },
            // "bStateSave": true,
            dom: 'Pfrtpi',
            "columnDefs": [{
                targets: [4, 5],
            }],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('admins.index') }}",
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "office"
                },
                {
                    "data": "role"
                },
                {
                    "data": "options",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        dataTable.on('draw', function() {

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
                    localStorage.setItem('admin_edit_uuid', uuid);
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
        })

    });
</script>
@stop