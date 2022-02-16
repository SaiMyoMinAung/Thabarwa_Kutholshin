@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Role List')

@section('content_header')
@include('backend.partials.admininfo')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Role List</h1>
    </div>
    <a href="{{route('roles.create')}}" class="btn btn-success">Create Role</a>
</div>
@stop

@section('content')
<table id="roleTable" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Permissions</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        @php $selectedPermissions = $role->permissions->pluck('id')->toArray(); @endphp
        <tr>
            <td>{{ $loop->index +1  }}</td>
            <td>{{$role->name}}</td>
            <td style="min-width:400px;max-width:400px">
                <p>

                    <button class="btn btn-primary collapseButton" type="button" data-target="#collapseDiv-{{$role->id}}">
                        Show All Permissions <span class="badge badge-warning">{{$role->permissions()->count()}}</span>
                    </button>
                </p>
                <div class="collapse" id="collapseDiv-{{$role->id}}">
                    <div class="card card-body">
                        @foreach($lists as $list)
                        <div>
                            @foreach(Spatie\Permission\Models\Permission::where('name','LIKE',"%$list")->get() as $permission)
                            @if (in_array($permission->id,$selectedPermissions))
                            <span class="badge badge-pill badge-success font-weight-normal px-2 py-1 mr-1">{{$permission->name}}</span>
                            @else
                            <span class="badge badge-pill badge-danger font-weight-normal px-2 py-1 mr-1" style="text-decoration:line-through">{{$permission->name}}</span>
                            @endif


                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>

            </td>
            <td>
                @if (auth()->user()->can('edit-role'))
                <a href="{{route('roles.edit' , $role->id)}}" class="btn btn-warning link-text">Edit</a>
                @else
                -
                @endif
            </td>
            <td>
                @if (auth()->user()->can('delete-role'))
                <a class="btn btn-danger link-text" href="#deleteModalCenter" onclick="deleteData('{{route('roles.destroy',$role->id)}}')" data-toggle="modal">Delete</a>
                @else
                -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('js')
<script>
    $('.collapseButton').click(function() {
        let id = $(this).data("target");
        if (!$(id).hasClass("show")) {
            $(id).addClass("show");
        } else {
            $(id).removeClass("show");
            $(id).addClass("collapse")
        }

    })
    // $(document).ready(function() {

    //     let dataTable = $('#adminTable').DataTable({
    //         createdRow: function(row, data, dataIndex) {
    //             let uuid = localStorage.getItem('admin_edit_uuid')

    //             if (uuid != null && data.uuid == uuid) {
    //                 $(row).addClass('bg-info');
    //                 localStorage.removeItem('admin_edit_uuid')
    //             }

    //         },
    //         // "bStateSave": true,
    //         dom: 'Pfrtpi',
    //         "columnDefs": [{
    //             targets: [4, 5],
    //         }],
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": "{{ route('admins.index') }}",
    //         },
    //         "order": [
    //             [0, 'desc']
    //         ],
    //         "columns": [{
    //                 data: 'DT_RowIndex',
    //                 name: 'DT_RowIndex',
    //                 searchable: false,
    //             },
    //             {
    //                 "data": "name"
    //             },
    //             {
    //                 "data": "email"
    //             },
    //             {
    //                 "data": "phone"
    //             },
    //             {
    //                 "data": "office"
    //             },
    //             {
    //                 "data": "options",
    //                 orderable: false,
    //                 searchable: false
    //             }
    //         ]
    //     });

    //     dataTable.on('draw', function() {

    //         $('[data-toggle=confirmation]').confirmation({
    //             rootSelector: '[data-toggle=confirmation]',
    //             // other options
    //             onConfirm: function(value) {
    //                 let href = $(this).data('href')

    //                 $('#delete-form').attr('action', href)
    //                 document.getElementById("delete-form").submit();
    //             },
    //             buttons: [{
    //                     class: 'btn btn-xs btn-danger pl-3 pr-3',
    //                     label: 'Yes',
    //                     value: 'Delete'
    //                 },
    //                 {
    //                     class: 'btn btn-xs btn-secondary pl-2 pr-2',
    //                     label: 'Cancel',
    //                     cancel: true
    //                 }
    //             ]
    //         });

    //         $('[data-toggle=editconfirmation]').confirmation({
    //             rootSelector: '[data-toggle=editconfirmation]',
    //             // other options
    //             onConfirm: function(value) {
    //                 let href = $(this).data('href')
    //                 let uuid = $(this).data('uuid')
    //                 localStorage.setItem('admin_edit_uuid', uuid);
    //                 window.location.href = href
    //             },
    //             buttons: [{
    //                     class: 'btn btn-xs btn-danger pl-3 pr-3',
    //                     label: 'Yes',
    //                     value: 'Delete'
    //                 },
    //                 {
    //                     class: 'btn btn-xs btn-secondary pl-2 pr-2',
    //                     label: 'Cancel',
    //                     cancel: true
    //                 }
    //             ]
    //         });
    //     })

    // });
</script>
@stop