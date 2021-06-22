@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Internal Requests List')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Internal Requests List</h1>
    </div>
</div>
@stop

@section('content')
<table id="internalRequestTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Date</th>
            <th style="max-width: 200px;">Item Name</th>
            <th>Name</th>
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
<script src="https://cdn.datatables.net/searchpanes/1.2.2/js/dataTables.searchPanes.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        let dataTable = $('#internalRequestTable').DataTable({
            // "bStateSave": true,
            dom: 'Pfrtpi',
            searchPanes: {
                layout: 'columns-4',
            },
            "columnDefs": [{
                searchPanes: {
                    show: true,
                },
                targets: [1, 6, 3],
            }],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('search.internal.requests') }}",
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
                    "data": "date"
                },
                {
                    "data": "item_name"
                },
                {
                    "data": "name"
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