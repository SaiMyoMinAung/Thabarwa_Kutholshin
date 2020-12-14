@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Create Volunteer')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Volunteer</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('volunteers.update',$volunteer->uuid) : route('volunteers.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : (old('name') && !$errors->has('name') ? 'is-valid': '') }}" id="name" placeholder="Enter Name" value="{{ $edit ? $volunteer->name : old('name')}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email </label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : (old('email') && !$errors->has('email') ? 'is-valid': '') }}" id="email" placeholder="Enter Email" value="{{ $edit ? $volunteer->email : old('email')}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : (old('phone') && !$errors->has('phone') ? 'is-valid': '') }}" id="phone" placeholder="Enter Phone" value="{{ $edit ? $volunteer->phone : old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('office_id') ? 'has-error' : '' }}">
                            <label for="office_id">Select Office <span class="text-danger">*</span></label>
                            <select name="office_id" class="form-control select2 custom-select {{ $errors->has('office_id') ? 'is-invalid' : (old('office_id') && !$errors->has('office_id') ? 'is-valid': '') }}">
                                <option></option>
                                @foreach($offices as $office)
                                <option value="{{$office->id}}" @if($edit && $volunteer->office_id == $office->id) selected @endif @if(old('office_id')==$office->id) selected @endif>{{$office->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('office_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('office_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('volunteer_job_id') ? 'has-error' : '' }}">
                            <label for="volunteer_job_id">Select Volunteer Job <span class="text-danger">*</span></label>
                            <select name="volunteer_job_id[]" class="form-control select2-job custom-select {{ $errors->has('volunteer_job_id') ? 'is-invalid' : (old('volunteer_job_id') && !$errors->has('volunteer_job_id') ? 'is-valid': '') }}" multiple>
                                <option></option>
                                @foreach($jobs as $job)
                                <option value="{{$job->id}}" @if($edit && in_array($job->id, $selectedJobs)) selected @endif @if( old('volunteer_job_id') && in_array($job->id,old('volunteer_job_id'))) selected @endif>{{$job->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('volunteer_job_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('volunteer_job_id') }}
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        <a href="{{$indexUrl}}" class="btn btn-warning">Cancel</a>
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
            placeholder: "Select Office",
            allowClear: true
        })

        $('.select2-job').select2({
            placeholder: "Select Volunteer Job",
            allowClear: true
        })
    });
</script>
@endsection