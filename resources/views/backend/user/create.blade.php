@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create User')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif User</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('users.update',$user->uuid) : route('users.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" id="name" placeholder="Enter Name" value="{{ $edit ? $user->name : old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : (old('email') && !$errors->has('email') ? 'is-valid': '') }}" id="email" placeholder="Enter Email" value="{{ $edit ? $user->email : old('email')}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $edit ? $user->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                            <label for="city_id">Select City <span class="text-danger">*</span></label>
                            <select name="city_id" class="form-control select2 {{ $errors->has('city_id') ? 'is-invalid' : (old('city_id') && !$errors->has('city_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($edit && $user->city_id == $city->id) selected @endif @if(old('city_id') == $city->id) selected @endif>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city_id') }}
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        <a href="{{route('users.index')}}" class="btn btn-warning">Cancel</a>
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
            placeholder: "Select City",
            allowClear: true
        })
    });
</script>
@endsection