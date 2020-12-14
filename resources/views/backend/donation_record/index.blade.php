@extends('adminlte::page')

@section('css')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.2.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Donation Records')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Donation Records</h1>
    </div>
    <a href="{{route('donation_records.create')}}" class="btn btn-success">Create Donation Records</a>
</div>
@stop

@section('content')
<table id="donationRecords" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Created At</th>
            <th>Sr No</th>
            <th>Ct No</th>
            <th>Name</th>
            <th>Donor</th>
            <th>Date</th>
            <th>Cash</th>
            <th>Kind Of Donation</th>
            <th>Donation Material</th>
            <th>Options</th>
            <th>Type Of Money</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Created At</th>
            <th>Sr No</th>
            <th>Ct No</th>
            <th>Name</th>
            <th>Donor</th>
            <th>Date</th>
            <th>Cash</th>
            <th>Kind Of Donation</th>
            <th>Donation Material</th>
            <th>Options</th>
            <th>Type Of Money</th>
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
        let dataTable = $('#donationRecords').DataTable({
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('donated_record_uuid')
                
                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('donated_record_uuid')
                }

            },
            dom: 'Pfrtpi',
            "bStateSave": true,
            searchPanes: {
                layout: 'columns-4',
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('donation_records.index') }}",
            },
            "columnDefs": [{
                "targets": [1, 11],
                "visible": false,
                "searchable": false
            }, {
                searchPanes: {
                    show: true,
                },
                targets: [6, 7, 8, 11],
            }],
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
                    "data": "sr_no"
                },
                {
                    "data": "ct_no"
                },
                {
                    "data": "main_donor_name"
                },
                {
                    "data": "donor"
                },
                {
                    "data": "date_of_donation"
                },
                {
                    "data": "cash"
                },
                {
                    "data": "kind_of_donation"
                },
                {
                    "data": "donation_material"
                },
                {
                    "data": "options",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "type_of_money",
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
                    localStorage.setItem('donated_record_uuid', uuid);
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