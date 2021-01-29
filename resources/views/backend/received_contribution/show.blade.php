@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
@stop

@section('title', 'Show Received Contribution' )

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Show Received Contribution</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="card border col-md-6">

        <div class="card-body">

            <!-- Title -->
            <div class="form-group">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input name="title" type="text" class="form-control" value="{{$contribution->title}}" disabled>
            </div>

            <!-- Note -->
            <div class="form-group">
                <label for="note">Note <span class="text-danger">*</span></label>
                <textarea name="note" class="form-control" style="height:100px" disabled>{{$contribution->note}}</textarea>

            </div>


            <!-- Volunteer -->
            <div class="form-group">
                <label for="volunteer_id">Select Volunteer <span class="text-danger">*</span></label>
                <select name="volunteer_id" class="form-control select2-volunteer custom-select" disabled>

                    <option>{{$contribution->volunteer->name}}</option>

                </select>
            </div>

            <!-- Items -->
            <div class="form-group ">
                <label for="items_id">Select Items <span class="text-danger">*</span></label>
                <select class="form-control item-select2 custom-select" multiple="multiple" disabled>
                    @foreach($contribution->internalDonatedItems as $internalDonatedItem)
                    <option selected>{{$internalDonatedItem->item_unique_id}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Receive Office -->
            <div class="form-group ">
                <label for="receive_office_id">Select Receive Office <span class="text-danger">*</span></label>
                <select name="receive_office_id" class="form-control receive-office-select2 custom-select " disabled>
                    <option selected>{{$contribution->receiveOffice->name}}</option>
                </select>
            </div>


        </div>

    </div>


</div>

<table id="internalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Item Unique Id</th>
            <th>Name</th>
            <th>QTY</th>
            <th>Item Type</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
    </tbody>

</table>


@endsection

@section('js')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        $('.receive-office-select2').select2({
            placeholder: "Select Receive Office",
            allowClear: true
        })

        $('.select2-volunteer').select2({
            placeholder: "Select Volunteer",
            allowClear: true
        })

        // start Item select2
        $(".item-select2").select2({
            allowClear: true,
            placeholder: "Select Items",
        });
        // end Item select2

        let url = "{{route('received_contributions.items.index',$contribution->id)}}";

        let dataTable = $('#internalDonatedItemTable').DataTable({
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('internal_donateditem_uuid')

                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('internal_donateditem_uuid')
                }

            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                url,
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
                    "data": "item_unique_id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "item_type"
                },
                {
                    "data": "status"
                },
                {
                    "data": "option",
                    orderable: false,
                    searchable: false
                },
            ]
        });

        dataTable.on('draw', function() {
            $('[data-toggle=acceptconfirmation]').confirmation({
                rootSelector: '[data-toggle=acceptconfirmation]',
                // other options
                onConfirm: function(value) {
                    let itemuuid = $(this).data('itemuuid')
                    let contributionid = $(this).data('contributionid');
                    let url = '/backend/received-contributions/' + contributionid + '/internal_donated_items/' + itemuuid + '/accept';

                    $.get(url).then((response) => {
                        console.log(response)
                        dataTable.ajax.reload()
                    }).catch(function(error) {
                        console.log(error)
                    })

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
@endsection