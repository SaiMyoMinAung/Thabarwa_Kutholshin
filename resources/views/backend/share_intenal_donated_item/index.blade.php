@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.2/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('title', 'Shared List Of Store')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>{{trans('title.shared_list_of_store')}}</h1>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{route('share_internal_donated_items.create')}}">{{trans('button.add_share_list')}}</a>
    </div>
</div>
@stop

@section('content')
<table id="shareInternalDonatedItemTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>{{trans('input.date')}}</th>
            <th style="max-width: 200px;">{{trans('input.item_type')}}</th>
            <th style="max-width: 200px;">{{trans('input.item_sub_type')}}</th>
            <th>{{trans('input.sacket_qty')}}</th>
            <th style="max-width: 200px;">{{trans('input.by_admin')}}</th>
            <th>{{trans('input.option')}}</th>
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
            createdRow: function(row, data, dataIndex) {
                let uuid = localStorage.getItem('share_internal_donateditem_uuid')

                if (uuid != null && data.uuid == uuid) {
                    $(row).addClass('bg-info');
                    localStorage.removeItem('share_internal_donateditem_uuid')
                }

            },
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
                    "data": "socket"
                },
                {
                    "data": "by_admin",
                },
                {
                    "data": "option",
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
                    localStorage.setItem('internal_donateditem_uuid', uuid);
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