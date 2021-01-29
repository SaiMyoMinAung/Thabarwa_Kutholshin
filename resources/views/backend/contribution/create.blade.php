@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
@stop

@section('title', $edit ? 'Edit Contribution' : 'Create Contribution' )

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Contribution</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="card border col-md-6">
        <form action="{{ $edit ? route('contributions.update',$contribution->id) : route('contributions.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card-body">

                <!-- Title -->
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : (old('title') && !$errors->has('title') ? 'is-valid': '') }}" id="title" placeholder="Enter Title" value="{{ $edit ? $contribution->title : old('title')}}" autofocus>
                    @if ($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                    @endif
                </div>

                <!-- Note -->
                <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                    <label for="note">Note <span class="text-danger">*</span></label>
                    <textarea name="note" class="form-control {{ $errors->has('note') ? 'is-invalid' : (old('note') && !$errors->has('note') ? 'is-valid': '') }}" id="note" placeholder="Enter Note" style="height:100px">{{ $edit ? $contribution->note :old('note')}}</textarea>
                    @if ($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                    @endif
                </div>


                <!-- Volunteer -->
                <div class="form-group {{ $errors->has('volunteer_id') ? 'has-error' : '' }}">
                    <label for="volunteer_id">Select Volunteer <span class="text-danger">*</span></label>
                    <select name="volunteer_id" class="form-control select2-volunteer custom-select {{ $errors->has('volunteer_id') ? 'is-invalid' : (old('volunteer_id') && !$errors->has('volunteer_id') ? 'is-valid': '') }}">
                        <option></option>
                        @foreach($volunteers as $volunteer)
                        <option value="{{$volunteer->id}}" @if($edit && $contribution->volunteer_id == $volunteer->id) selected @endif @if(old('volunteer_id')==$volunteer->id) selected @endif>{{$volunteer->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('volunteer_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('volunteer_id') }}
                    </div>
                    @endif
                </div>

                <!-- Items -->
                @if(!$edit)
                <div class="form-group {{ $errors->has('items_id') ? 'has-error' : '' }}">
                    <label for="items_id">Select Items <span class="text-danger">*</span></label>
                    <select name="items_id[]" multiple="multiple" class="form-control item-select2 custom-select {{ $errors->has('items_id') ? 'is-invalid' : (old('items_id') && !$errors->has('items_id') ? 'is-valid': '') }}">
                        @if($edit)
                        @foreach($selectedItems as $item)
                        <option selected value="{{$item->id}}">{{$item->item_unique_id}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('items_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('items_id') }}
                    </div>
                    @endif
                </div>
                @endif

                <!-- Receive Office -->
                <div class="form-group {{ $errors->has('receive_office_id') ? 'has-error' : '' }}">
                    <label for="receive_office_id">Select Receive Office <span class="text-danger">*</span></label>
                    <select name="receive_office_id" class="form-control receive-office-select2 custom-select {{ $errors->has('receive_office_id') ? 'is-invalid' : (old('receive_office_id') && !$errors->has('receive_office_id') ? 'is-valid': '') }}">
                        <option></option>
                        @foreach($receiveOffices as $office)
                        <option value="{{$office->id}}" @if($edit && $contribution->receive_office_id == $office->id) selected @endif @if(old('receive_office_id')==$office->id) selected @endif>{{$office->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('receive_office_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receive_office_id') }}
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>

                @if($edit)
                <!-- <input type="submit" value="Update And Confirm" class="btn btn-warning" name="update_and_confirm"> -->
                @endif

                <a href="{{route('contributions.index')}}" class="btn btn-default">Cancel</a>


            </div>
        </form>
    </div>
    @if($edit)
    <div class="card border col-md-6">
        <div class="card-body">
            <form action="{{route('contribution.items.add',$contribution->id)}}" method="post">
                @csrf
                <div class="form-group {{ $errors->has('items_id') ? 'has-error' : '' }}">
                    <label for="items_id">Select Items <span class="text-danger">*</span></label>
                    <select name="items_id[]" multiple="multiple" class="form-control item-select2 custom-select {{ $errors->has('items_id') ? 'is-invalid' : (old('items_id') && !$errors->has('items_id') ? 'is-valid': '') }}">
                        <option></option>
                    </select>
                    @if ($errors->has('items_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('items_id') }}
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Add Item</button>
            </form>
        </div>
    </div>
    @endif

</div>
@if($edit)
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
@endif

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
        let url = "{{route('get.internalDonatedItems')}}";
        // start Item select2
        $(".item-select2").select2({
            allowClear: true,
            placeholder: "Select Items",
            ajax: {
                url,
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    console.log(data)
                    let mappedData = data.data.map((data) => {
                        return {
                            id: data.id,
                            text: data.item_unique_id
                        }
                    })

                    return {
                        results: mappedData,
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },

            },
        });
        // end Item select2
        @if($edit)
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
                "url": "{{ route('contribution.items.index',$contribution->id) }}",
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
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                // other options
                onConfirm: function(value) {
                    let itemuuid = $(this).data('itemuuid')
                    let contributionid = $(this).data('contributionid');
                    let url = '/backend/contributions/' + contributionid + '/internal_donated_items/' + itemuuid + '/confirm';

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

            $('[data-toggle=removeconfirmation]').confirmation({
                rootSelector: '[data-toggle=removeconfirmation]',
                // other options
                onConfirm: function(value) {
                    let itemuuid = $(this).data('itemuuid')
                    let contributionid = $(this).data('contributionid');
                    let url = '/backend/contributions/' + contributionid + '/internal_donated_items/' + itemuuid + '/remove';

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
        @endif


    });
</script>
@endsection