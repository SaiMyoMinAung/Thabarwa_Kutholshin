@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create User')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Create User</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Enter Name" value="{{old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter Email" value="{{old('email')}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="Enter Phone" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state_region_id') ? 'has-error' : '' }}">
                            <label for="state_region">Select State Region <span class="text-danger">*</span></label>
                            <select name="state_region_id" class="form-control select2 {{ $errors->has('state_region_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach($stateRegions as $stateRegion)
                                <option value="{{$stateRegion->id}}" @if(old('state_region_id')==$stateRegion->id) selected @endif>{{$stateRegion->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state_region_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state_region_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('ward_id') ? 'has-error' : '' }}">
                            <label for="ward_id">Select Ward <span class="text-danger">*</span></label>
                            <select name="ward_id" class="form-control select2 {{ $errors->has('ward_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach($wards as $ward)
                                <option value="{{$ward->id}}" @if(old('ward_id')==$ward->id) selected @endif>{{$ward->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ward_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ward_id') }}
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{route('volunteers.index')}}" class="btn btn-warning">Cancel</a>
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
        $('.select2').select2({
            placeholder: "Select Box",
            allowClear: true
        })
    });
</script>
@endsection