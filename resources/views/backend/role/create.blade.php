@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')

@stop

@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Register New Role</h4>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('roles.store')}}" method="post">
                @csrf
                <div class="card-body">

                    <div class="form-group has-feedback {{$errors->has('name') ? 'has-error':''}}">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}">
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <input type="checkbox" onClick="toggle(this)" id="select-all" /> <label for="select-all">Select All</label>
                        <br>
                        <input type="checkbox" onClick="toggleIDI(this)" id="for-IDM" /> <label for="for-IDM">For စတို Admin</label>
                        @foreach ($lists as $list)
                        <div class="card">
                            <div class="card-footer">
                                @if(count(Spatie\Permission\Models\Permission::where('name','LIKE',"%$list")->get()) > 0)
                                <label class="d-block">
                                    <input type="checkbox" onClick='customToggle(this, "{{$list}}")' />
                                    {{$list}}
                                </label>
                                <div class="form-check form-check-inline flex-wrap">
                                    @foreach(Spatie\Permission\Models\Permission::where('name','LIKE',"%$list")->get() as $permission)
                                    <div class=" mx-0">
                                        <span class="cover"></span>
                                        <input id="permission_{{$permission->id}}" class="sub-{{$list}} {{$permission->name}}" type="checkbox" name="permission_id[]" value="{{$permission->id}}" class="form-check-input">
                                        <label class="form-check-label mr-5" for="permission_{{$permission->id}}">{{$permission->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('js')
<script>
    var pForIDIRecordAdminType = <?php echo json_encode($pForIDIRecordAdminType) ?>

    function customToggle(source, list) {
        subcheckboxes = document.getElementsByClassName('sub-' + list);
        for (var i = 0; i < subcheckboxes.length; i++) {
            subcheckboxes[i].checked = source.checked
        }
    }

    function toggle(source) {
        checkboxes = document.querySelectorAll('input[type="checkbox"]')

        checkboxes.forEach(function(item, index) {
            item.checked = source.checked
        });
    }

    function toggleIDI(source) {
        for (var i = 0; i < pForIDIRecordAdminType.length; i++) {
            let className = "." + pForIDIRecordAdminType[i];
            if ($(className)[0]) {
                $(className)[0].checked = source.checked
            }
        }
    }
</script>
@stop