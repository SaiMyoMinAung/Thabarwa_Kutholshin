@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create Team')

@section('content_header')
@include('backend.partials.admininfo')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Team</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('teams.update',$team->uuid) : route('teams.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" id="name" placeholder="Enter Name" value="{{ $edit ? $team->name : old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email </label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : (old('email') && !$errors->has('email') ? 'is-valid': '') }}" id="email" placeholder="Enter Email" value="{{ $edit ? $team->email : old('email')}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $edit ? $team->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('center_id') ? 'has-error' : '' }}">
                            <label for="center_id">Select Center <span class="text-danger">*</span></label>
                            <select name="center_id" class="form-control select2 custom-select {{ $errors->has('center_id') ? 'is-invalid' : (old('center_id') && !$errors->has('center_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($centers as $center)
                                <option value="{{$center->id}}" @if($edit && $team->center_id == $center->id) selected @endif @if(old('center_id')==$center->id) selected @endif>{{$center->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('center_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('center_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                            <label for="note">Note <span class="text-danger">*</span></label>
                            <textarea name="note" class="form-control  {{ $errors->has('note') ? 'is-invalid' : (old('note') && !$errors->has('note') ? 'is-valid': '') }}" id="note" placeholder="Enter note" style="height: 100px;">{{ $edit ? $team->note : old('note')}}</textarea>
                            @if ($errors->has('note'))
                            <div class="invalid-feedback">
                                {{ $errors->first('note') }}
                            </div>
                            @endif
                        </div>
                        @if($edit)
                        <div class="form-group {{ $errors->has('is_available') ? 'has-error' : '' }}">
                            <label for="is_available">Is Available <span class="text-danger">*</span></label>
                            <input type="checkbox" name="is_available" value="1" id="is_available" @if($edit && $team->is_available) checked @endif>
                            @if ($errors->has('is_available'))
                            <div class="invalid-feedback">
                                {{ $errors->first('is_available') }}
                            </div>
                            @endif
                        </div>
                        @endif

                        <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        <a href="{{route('teams.index')}}" class="btn btn-warning">Cancel</a>
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
            placeholder: "Select Center",
            allowClear: true
        })
    });
</script>
@endsection