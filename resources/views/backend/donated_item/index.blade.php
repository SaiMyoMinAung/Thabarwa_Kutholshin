@extends('adminlte::page')

@section('title', 'Donated Items')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@stop

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Donated Item list</h1>
    </div>
    <a href="{{route('donated_items.create')}}" class="btn btn-success">Create Donated Item</a>
</div>

@stop

@section('content')
<table id="userTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Created At</th>
            <th>About Item</th>
            <th>Picked Up At</th>
            <th>Picked Up Info</th>
            <th>Status</th>
            <th>Kind Of Item</th>
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
        $('#userTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('donated_items.index') }}",
            },
            "columnDefs": [{
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                },
            ],
            "order": [
                [1, 'desc']
            ],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "about_item"
                },
                {
                    "data": "pickedup_at"
                },
                {
                    "data": "pickedup_info"
                },
                {
                    "data": "status"
                },
                {
                    "data": "kind_of_item"
                },
            ]
        });
    });
</script>
@stop