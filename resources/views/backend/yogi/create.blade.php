@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create Yogi')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Yogi</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('yogis.update',$yogi->uuid) : route('yogis.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" id="name" placeholder="Enter Name" value="{{ $edit ? $yogi->name : old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone </label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $edit ? $yogi->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('ward_id') ? 'has-error' : '' }}">
                            <label for="ward_id">Select Ward <span class="text-danger">*</span></label>
                            <select name="ward_id" class="form-control select2 custom-select {{ $errors->has('ward_id') ? 'is-invalid' : (old('ward_id') && !$errors->has('ward_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($wards as $ward)
                                <option value="{{$ward->id}}" @if($edit && $yogi->ward_id == $ward->id) selected @endif @if(old('ward_id')==$ward->id) selected @endif>{{$ward->name}} ({{$ward->center->name}})</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ward_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ward_id') }}
                            </div>
                            @endif
                        </div>                        

                        <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        <a href="{{route('yogis.index')}}" class="btn btn-warning">Cancel</a>
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