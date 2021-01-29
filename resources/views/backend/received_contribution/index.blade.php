@extends('adminlte::page')

@section('css')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Received Contribution Lists')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Received Contribution Lists</h1>
    </div>
</div>
@stop

@section('content')
<table id="receivedContributionRecords" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Note</th>
            <th>From Office</th>
            <th>Items</th>
            <th>Volunteer</th>
            <th>Accepted</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Note</th>
            <th>From Office</th>
            <th>Items</th>
            <th>Volunteer</th>
            <th>Accepted</th>
        </tr>
    </tfoot>
</table>
@stop

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/1.2.2/js/dataTables.searchPanes.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let dataTable = $('#receivedContributionRecords').DataTable({
            createdRow: function(row, data, dataIndex) {
                let id = localStorage.getItem('contribution_id')

                if (id != null && data.id == id) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('contribution_id')
                }

            },
            // dom: 'Pfrtpi',
            "bStateSave": true,
            // searchPanes: {
            //     layout: 'columns-4',
            // },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('received_contributions.index') }}",
            },
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
                    "data": "title"
                },
                {
                    "data": "note"
                },
                {
                    "data": "office",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "items",
                    orderable: false,
                },
                {
                    "data": "volunteer",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "accepted",
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>
@stop