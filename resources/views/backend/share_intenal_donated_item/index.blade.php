@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Shared List Of Store')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Shared List Of Store</h1>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{route('share_internal_donated_items.create')}}">Add Share List</a>
    </div>
</div>
@stop

@section('content')
<table id="shareInternalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Date</th>
            <th style="max-width: 200px;">Item Type Name</th>
            <th style="max-width: 200px;">Item Sub Type Name</th>
            <th>Package</th>
            <th>Socket</th>
            <th style="max-width: 200px;">By Admin</th>
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

        let dataTable = $('#shareInternalDonatedItemTable').DataTable({
            "bStateSave": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('share_internal_donated_items.index') }}",
            },
            "order": [
                [1, 'desc']
            ],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                },
                {
                    "data": "date"
                },
                {
                    "data": "item_type"
                },
                {
                    "data": "item_sub_type"
                },
                {
                    "data": "package"
                },
                {
                    "data": "socket"
                },
                {
                    "data": "by_admin",
                },
            ]
        });

    });
</script>
@stop