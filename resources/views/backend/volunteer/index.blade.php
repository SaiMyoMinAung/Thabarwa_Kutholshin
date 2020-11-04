@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
            <th>State Region</th>
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
            <th>State Region</th>
            <th>Office</th>
            <th>Options</th>
        </tr>
    </tfoot>
</table>
@stop

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('volunteers.index') }}",
            },
            "order": [
                [1, 'asc']
            ],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
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
                    "data": "state_region"
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
    });
</script>
@stop