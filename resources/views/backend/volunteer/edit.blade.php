@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Edit Volunteer')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Edit Volunteer</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{route('volunteers.update',$volunteer->uuid)}}" method="post">
            @csrf
            @method('PUT')
            <div class="card border ">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Enter Name" value="{{$volunteer->name}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter Email" value="{{$volunteer->email}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="Enter Phone" value="{{$volunteer->phone}}">
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
                                <option value="{{$stateRegion->id}}" @if($volunteer->state_region_id==$stateRegion->id) selected @endif>{{$stateRegion->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state_region_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state_region_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('office_id') ? 'has-error' : '' }}">
                            <label for="office_id">Select Office <span class="text-danger">*</span></label>
                            <select name="office_id" class="form-control select2 {{ $errors->has('office_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach($offices as $office)
                                <option value="{{$office->id}}" @if($volunteer->office_id==$office->id) selected @endif>{{$office->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('office_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('office_id') }}
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
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