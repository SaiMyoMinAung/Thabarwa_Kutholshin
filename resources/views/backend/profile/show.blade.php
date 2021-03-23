@extends('adminlte::page')

@section('css')
@stop

@section('title', 'My Profile')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>My Profile</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="card border col-md-6">
        <form action="{{route('profile.update',$admin->uuid)}}" method="post">
            @csrf
            <div class="card-body">

                <!-- Name -->
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" id="name" placeholder="Enter Name" value="{{ $admin->name }}" autofocus>
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>

                <!-- Email -->
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input name="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : (old('email') && !$errors->has('email') ? 'is-valid': '') }}" id="email" placeholder="Enter Email" value="{{ $admin->email }}" autofocus>
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $admin->phone }}">
                    @if ($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success"> Update </button>

            </div>
        </form>
    </div>


</div>
@stop

@section('js')
@stop