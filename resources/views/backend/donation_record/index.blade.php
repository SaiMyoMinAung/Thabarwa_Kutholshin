@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
        </tr>
    </tfoot>
</table>
@stop

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        let dataTable = $('#donationRecords').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('donation_records.index') }}",
            },
            "columnDefs": [{
                "targets": [1],
                "visible": false,
                "searchable": false
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
                }
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
        });

    });
</script>
@stop