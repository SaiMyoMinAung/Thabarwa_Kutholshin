@extends('adminlte::page')

@section('css')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Contribution Lists')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>{{trans('menu.contribution_lists')}}</h1>
    </div>
    <a href="{{route('contributions.create')}}" class="btn btn-success">{{trans('button.create_contribution_list')}}</a>
</div>
@stop

@section('content')
<table id="contributionRecords" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Note</th>
            <th>Office</th>
            <th>Items</th>
            <th>Driver</th>
            <th>Confirmed</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Note</th>
            <th>Office</th>
            <th>Items</th>
            <th>Driver</th>
            <th>Confirmed</th>
            <th >Options</th>
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
        let dataTable = $('#contributionRecords').DataTable({
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
                "url": "{{ route('contributions.index') }}",
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
                    "data": "confirmed",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "options",
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
                    let id = $(this).data('id')
                    localStorage.setItem('contribution_id', id);
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