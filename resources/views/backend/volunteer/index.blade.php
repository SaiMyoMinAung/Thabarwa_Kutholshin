@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Volunteer List')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Volunteer List</h1>
    </div>
    <a href="{{route('volunteers.create')}}" class="btn btn-success">Create Volunteer</a>
</div>
@stop

@section('content')
<table id="userTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Office</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Office</th>
            <th>Options</th>
        </tr>
    </tfoot>
</table>
@stop

@section('js')
<script>
    $(document).ready(function() {

        let dataTable = $('#userTable').DataTable({
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('volunteer_edit_uuid')

                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('volunteer_edit_uuid')
                }

            },
            "bStateSave": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('volunteers.index') }}",
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
                    localStorage.setItem('volunteer_edit_uuid', uuid);
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