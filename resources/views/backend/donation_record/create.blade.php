@extends('adminlte::page')

@section('css')
@stop

@section('title', $edit ? 'Edit Donation Record' : 'Create Donation Record' )

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>@if($edit) Edit @else Create @endif Donation Record</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{ $edit ? route('donation_records.update',$donation_record->uuid) : route('donation_records.store')}}" method="post">
            @if($edit)
            @method('PUT')
            @endif
            @csrf
            <div class="card border ">
                <div class="card-body row">

                    <div class="col-sm-12 col-md-12 row">

                        <div class="col-md-3 col-sm-3">
                            <!-- Date Of Donation -->
                            <div class="form-group warpper {{ $errors->has('date_of_donation') ? 'has-error' : '' }}">
                                <label for="date_of_donation"> Date Of Donation <span class="text-danger">*</span></label>

                                <input name="date_of_donation" type="text" class="form-control flatpickr-custom-style flatpickr-for-donation-record {{ $errors->has('date_of_donation') ? 'is-invalid' : (old('date_of_donation') && !$errors->has('date_of_donation') ? 'is-valid': '') }}" id="date_of_donation" placeholder="Date Of Donation" value="{{ $edit ? $donation_record->date_of_donation : old('date_of_donation')}}">

                                @if ($errors->has('date_of_donation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_of_donation') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <!-- Sr No -->
                            <div class="form-group {{ $errors->has('sr_no') ? 'has-error' : '' }}">
                                <label for="sr_no">Serial No <span class="text-danger">*</span></label>
                                <input name="sr_no" type="text" class="form-control only-number {{ $errors->has('sr_no') ? 'is-invalid' : (old('sr_no') && !$errors->has('sr_no') ? 'is-valid': '') }}" id="sr_no" placeholder="Enter Serial No" value="{{ $edit ? $donation_record->sr_no : old('sr_no')}}" autofocus>
                                @if ($errors->has('sr_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sr_no') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <!-- Certificate No -->
                            <div class="form-group {{ $errors->has('certificate_no') ? 'has-error' : '' }}">
                                <label for="certificate_no">Certificate No <span class="text-danger">*</span></label>
                                <input name="certificate_no" type="text" class="form-control only-number {{ $errors->has('certificate_no') ? 'is-invalid' : (old('certificate_no') && !$errors->has('certificate_no') ? 'is-valid': '') }}" id="certificate_no" placeholder="Enter Certificate No" value="{{ $edit ? $donation_record->certificate_no : old('certificate_no')}}">
                                @if ($errors->has('certificate_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('certificate_no') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <!-- Center -->
                            <div class="form-group {{ $errors->has('center_id') ? 'has-error' : '' }}">
                                <label for="center_id">Select Center <span class="text-danger">*</span></label>
                                <select name="center_id" class="form-control select2-center custom-select {{ $errors->has('center_id') ? 'is-invalid' : (old('center_id') && !$errors->has('center_id') ? 'is-valid': '') }}">
                                    <option></option>
                                    @foreach($centers as $center)
                                    <option value="{{$center->id}}" @if($edit && $donation_record->center_id) selected @endif @if(old('center_id')==$center->id) selected @endif>{{$center->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('center_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('center_id') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <!-- Kind Of Donation -->
                            <div class="form-group {{ $errors->has('kind_of_donation_id') ? 'has-error' : '' }}">
                                <label for="kind_of_donation_id">Kind Of Donation <span class="text-danger">*</span></label>
                                <select name="kind_of_donation_id" class="form-control select2-kind-of-donation custom-select {{ $errors->has('kind_of_donation_id') ? 'is-invalid' : (old('kind_of_donation_id') && !$errors->has('kind_of_donation_id') ? 'is-valid': '') }}">
                                    <option></option>
                                    @foreach($kindOfDonations as $kindOfDonation)
                                    <option value="{{$kindOfDonation->id}}" @if($edit && $donation_record->kind_of_donation_id) selected @endif @if(old('kind_of_donation_id')==$kindOfDonation->id) selected @endif>{{$kindOfDonation->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('kind_of_donation_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kind_of_donation_id') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <!-- Main Donor Name -->
                            <div class="form-group {{ $errors->has('main_donor_name') ? 'has-error' : '' }}">
                                <label for="main_donor_name">Main Donor Name <span class="text-danger">*</span></label>
                                <input name="main_donor_name" id="main_donor_name" type="text" class="form-control {{ $errors->has('main_donor_name') ? 'is-invalid' : (old('main_donor_name') && !$errors->has('main_donor_name') ? 'is-valid': '') }}" id="main_donor_name" placeholder="Enter Main Donor Name" value="{{ $edit ? $donation_record->main_donor_name : old('main_donor_name')}}">
                                @if ($errors->has('main_donor_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_donor_name') }}
                                </div>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-3 col-sm-3">
                            <!-- Donation Cash -->
                            <div class="form-group {{ $errors->has('donation_cash') ? 'has-error' : '' }}">
                                <label for="donation_cash">Donation Cash <span class="text-danger">*</span></label>
                                <input name="donation_cash" type="text" class="form-control only-number {{ $errors->has('donation_cash') ? 'is-invalid' : (old('donation_cash') && !$errors->has('donation_cash') ? 'is-valid': '') }}" id="donation_cash" placeholder="Enter Donation Cash" value="{{ $edit ? $donation_record->donation_cash : old('donation_cash')}}">
                                @if ($errors->has('donation_cash'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('donation_cash') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <!-- Type Of Money -->
                            <div class="form-group {{ $errors->has('type_of_money') ? 'has-error' : '' }}">
                                <label for="type_of_money">Type Of Money <span class="text-danger">*</span></label>
                                <select name="type_of_money" class="form-control select2-type-of-money custom-select {{ $errors->has('type_of_money') ? 'is-invalid' : (old('type_of_money') && !$errors->has('type_of_money') ? 'is-valid': '') }}">
                                    <option></option>
                                    @foreach($types as $type)
                                    <option value="{{$type['label']}}" @if($edit && $donation_record->label) selected @endif @if($type['code']==old('type_of_money')) selected @endif>{{$type['symbol']}} ( {{ $type['label']}} )</option>
                                    @endforeach


                                </select>
                                @if ($errors->has('type_of_money'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_of_money') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <!-- Donor -->
                            <div class="form-group {{ $errors->has('donor') ? 'has-error' : '' }}">
                                <label for="donor">Donor <span class="text-danger">*</span></label>
                                <textarea name="donor" class="form-control {{ $errors->has('donor') ? 'is-invalid' : (old('donor') && !$errors->has('donor') ? 'is-valid': '') }}" id="donor" placeholder="Enter Donor" style="height:100px">{{ $edit ? $donation_record->donor :old('donor')}}</textarea>
                                @if ($errors->has('donor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('donor') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <!-- Donation Material -->
                            <div class="form-group {{ $errors->has('donation_material') ? 'has-error' : '' }}">
                                <label for="donation_material">Donation Material <span class="text-danger">*</span></label>
                                <textarea name="donation_material" class="form-control {{ $errors->has('donation_material') ? 'is-invalid' : (old('donation_material') && !$errors->has('donation_material') ? 'is-valid': '') }}" id="donation_material" placeholder="Enter Donation Material" style="height:100px">{{ $edit ? $donation_record->donation_material : old('donation_material')}}</textarea>
                                @if ($errors->has('donation_material'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('donation_material') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <!-- Estimate Cost -->
                            <div class="form-group {{ $errors->has('estimate_cost') ? 'has-error' : '' }}">
                                <label for="estimate_cost">Estimate Cost MMK<span class="text-danger">*</span></label>
                                <input name="estimate_cost" type="text" class="form-control only-number {{ $errors->has('estimate_cost') ? 'is-invalid' : (old('estimate_cost') && !$errors->has('estimate_cost') ? 'is-valid': '') }}" id="estimate_cost" placeholder="Enter Estimate Cost" value="{{ $edit ? $donation_record->estimate_cost : old('estimate_cost')}}">
                                @if ($errors->has('estimate_cost'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estimate_cost') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9"></div>


                        <div class="col-md-1 col-sm-2">
                            <button type="submit" class="btn btn-success">@if($edit) Update @else Create @endif</button>
                        </div>
                        <div class="col-md-1 col-sm-2">
                            <a href="{{route('donation_records.index')}}" class="btn btn-warning">Cancel</a>
                        </div>

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
        $('.select2-center').select2({
            placeholder: "Select Center",
            allowClear: true
        })
        $('.select2-kind-of-donation').select2({
            placeholder: "Select Kind Of Donation",
            allowClear: true
        })
        $('.select2-type-of-money').select2({
            placeholder: "Select Type Of Money",
            allowClear: true
        })

    });
</script>
@endsection