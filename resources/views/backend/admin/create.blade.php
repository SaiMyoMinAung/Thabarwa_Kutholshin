@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create Admin')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Admin</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    @if($errors->has('super_error'))
    <div class="col-md-12 alert alert-danger">
        {{ $errors->first('super_error') }}
    </div>
    @endif

    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('admins.update',$admin->uuid) : route('admins.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" placeholder="Enter Name" value="{{ $edit ? $admin->name : old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : (old('email') && !$errors->has('email') ? 'is-valid': '') }}" id="email" placeholder="Enter Email" value="{{ $edit ? $admin->email : old('email')}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $edit ? $admin->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('type_of_admin_id') ? 'has-error' : '' }}">
                            <label for="type_of_admin">Select Type Of Admin <span class="text-danger">*</span></label>
                            <select name="type_of_admin_id" id="type_of_admin" class="form-control custom-select {{ $errors->has('type_of_admin_id') ? 'is-invalid' : (old('type_of_admin_id') && !$errors->has('type_of_admin_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($typeOfAdmins as $type)
                                <option value="{{$type->id}}" @if($edit && $admin->type_of_admin_id == $type->id) selected @endif @if(old('type_of_admin_id') == $type->id) selected @endif>{{$type->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type_of_admin_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type_of_admin_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('office_id') ? 'has-error' : '' }}">
                            <label for="office">Select Office <span class="text-danger">*</span></label>
                            <select name="office_id" id="office" class="form-control custom-select {{ $errors->has('office_id') ? 'is-invalid' : (old('office_id') && !$errors->has('office_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($offices as $office)
                                <option value="{{$office->id}}" @if($edit && $admin->office_id == $office->id) selected @endif @if(old('office_id') == $office->id) selected @endif>{{$office->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('office_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('office_id') }}
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        <a href="{{route('admins.index')}}" class="btn btn-warning">Cancel</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#type_of_admin').select2({
            placeholder: "Select Type Of Admin",
            allowClear: true
        })

        $('#office').select2({
            placeholder: "Select Office",
            allowClear: true
        })
    });
</script>
@endsection