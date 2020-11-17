@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-centered">
        <form action="{{route('donated_items.update',$donatedItem->uuid)}}" method="post">
            @csrf
            @method('PUT')
            <div class="card border border-success">
                <div class="card-body row">
                    <div class="col-md-6">
                        <h3><span class="badge badge-success">{{$donatedItem->item_unique_id}}</span> - <span class="badge badge-success">{{$donatedItem->statusName}}</span></h3>


                        <div class="form-group {{ $errors->has('about_item') ? 'has-error' : '' }}">
                            <label for="about_item">About Item <span class="text-danger">*</span></label>
                            <input name="about_item" id="about_item" type="text" class="form-control {{ $errors->has('about_item') ? 'is-invalid' : '' }}" id="about_item" placeholder="Enter About Item" value="{{$donatedItem->about_item}}">
                            @if ($errors->has('about_item'))
                            <div class="invalid-feedback">
                                {{ $errors->first('about_item') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('pickedup_at') ? 'has-error' : '' }}">
                            <label>Picked Up Date <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <input name="pickedup_at" type="date" class="form-control pull-right {{ $errors->has('pickedup_at') ? 'is-invalid' : '' }}" value="{{$donatedItem->pickedup_at->format('yy-m-d')}}">
                                @if ($errors->has('pickedup_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pickedup_at') }}
                                </div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('pickedup_address') ? 'has-error' : '' }}">
                            <label>Picked Up Info <span class="text-danger">*</span></label>
                            <textarea name="pickedup_address" class="form-control {{ $errors->has('pickedup_address') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter Picked Up Info">{{$donatedItem->pickedup_info}}</textarea>
                            @if ($errors->has('pickedup_address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('pickedup_address') }}
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12 card">
                                <div class="form-group card-body {{ $errors->has('remark') ? 'has-error' : '' }}">
                                    <label for="remark">Remark <span class="text-danger">*</span></label>
                                    <textarea id="remark" name="remark" hidden>{{$donatedItem->remark ?? 'No Remark!'}}</textarea>
                                    <div class="remark-div" style="border:1px solid white;border-radius:5px;padding:5px;margin-bottom:4px;">{!! $donatedItem->remark ?? 'No Remark!' !!}</div>
                                    <button class="btn btn-xs btn-primary remark-edit" type="button">Edit Remark</button>
                                    <button class="btn btn-xs btn-success remark-done" type="button">Done</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <h3>Donor Information</h3>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="donor_name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Enter Name" value="{{$donatedItem->donor_name}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>

                        <!-- <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter Email" value="{{$donatedItem->donor->email}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div> -->

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="Enter Phone" value="{{$donatedItem->phone}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                            <label for="country">Country </label>
                            <select name="country_id" class="form-control country-select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                <option value="{{$donatedItem->country->id}}" selected>{{$donatedItem->country->name}}</option>
                            </select>
                            @if ($errors->has('country_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state_region_id') ? 'has-error' : '' }}">
                            <label for="state_region">State Region </label>
                            <select name="state_region_id" class="form-control state-region-select2 {{ $errors->has('state_region_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                <option value="{{$donatedItem->stateRegion->id}}" selected>{{$donatedItem->stateRegion->name}}</option>
                            </select>
                            @if ($errors->has('state_region_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state_region_id') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                            <label for="city">City </label>
                            <select name="city_id" class="form-control city-select2 {{ $errors->has('city_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                <option value="{{$donatedItem->city->id}}" selected>{{$donatedItem->city->name}}</option>
                            </select>
                            @if ($errors->has('city_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city_id') }}
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-success">Update</button>
                        @if($donatedItem->is_confirmed_by_donor == 0)
                        <input type="submit" class="btn btn-primary" name="is_confirmed" value="Update And Confirmed">
                        @endif
                        @if($donatedItem->is_confirmed_by_donor == 1 && $donatedItem->pickedup_volunteer_id == null)
                        <input type="submit" class="btn btn-warning" name="is_cancelled" value="Update And Cancel">
                        @endif
                        @if($donatedItem->is_confirmed_by_donor == 1)
                        <a class="btn btn-info" href="{{route('donated_items.manage',$donatedItem->uuid)}}">Manage</a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('vendor/summernote/summernote-bs4.js')}}"></script>
<script>
    $(function() {
        var country_url = "{{route('getCountries')}}";
        // start country select2
        $(".country-select2").select2({
            placeholder: "Select Country",
            allowClear: true,
            ajax: {
                url: country_url,
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    console.log(data)
                    let mappedData = data.data.map((data) => {
                        return {
                            id: data.id,
                            text: data.name
                        }
                    })

                    return {
                        results: mappedData,
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },

            },
        });
        // end country select2

        $('.state-region-select2').select2({
            placeholder: "Select State Region",
            allowClear: true
        })

        $('.city-select2').select2({
            placeholder: "Select City",
            allowClear: true
        })

        let country_id = $('.country-select2').val();
        if (country_id.length == 0) {
            $('.state-region-select2').attr("disabled", true);
        } else {
            initStateRegionSelect2(country_id)
        }

        let state_region_id = $('.state-region-select2').val();
        if (state_region_id.length == 0) {
            $('.city-select2').attr("disabled", true);
        } else {
            initCitySelect2(state_region_id)
        }

    })

    $(document).ready(function() {

        $('.country-select2').on("select2:select", function(event) {
            var country_id = $(event.currentTarget).find("option:selected").val();
            $('.state-region-select2').attr("disabled", false);
            $('.state-region-select2').val(null).trigger('change');
            $('.city-select2').val(null).trigger('change');
            initStateRegionSelect2(country_id)
        })

        $('.state-region-select2').on("select2:select", function(event) {
            var state_region_id = $(event.currentTarget).find("option:selected").val();
            $('.city-select2').attr("disabled", false);
            $('.city-select2').val(null).trigger('change');
            initCitySelect2(state_region_id)
        })

        $('.country-select2').on("select2:unselect", function(event) {
            $('.state-region-select2').attr("disabled", true);
            $('.state-region-select2').val(null).trigger('change');
            $('.city-select2').attr("disabled", true);
            $('.city-select2').val(null).trigger('change');
        })

        $('.state-region-select2').on("select2:unselect", function(event) {
            $('.city-select2').attr("disabled", true);
            $('.city-select2').val(null).trigger('change');
        })

        $('.remark-edit').click(function() {
            edit()
        })

        $('.remark-done').click(function() {
            done()
        })
        var edit = function() {
            $('.remark-div').summernote({
                focus: true
            });
        };

        var done = function() {
            var markup = $('.remark-div').summernote('code');
            $('.remark-div').summernote('destroy');
            var textarea = document.querySelector('#remark');
            textarea.value = '';
            textarea.value = markup
        };
    })

    function initCitySelect2(state_region_id) {
        var url = "{{route('getCities')}}" + "?state_region_id=" + state_region_id

        // start city select2
        $(".city-select2").select2({
            allowClear: true,
            placeholder: "Select City",
            ajax: {
                url,
                dataType: 'json',
                data: function(params) {
                    return {
                        state_region_id: state_region_id,
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    console.log(data)
                    let mappedData = data.data.map((data) => {
                        return {
                            id: data.id,
                            text: data.name
                        }
                    })

                    return {
                        results: mappedData,
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },

            },
        });
        // end city select2
    }

    function initStateRegionSelect2(country_id) {
        var url = "{{route('getStateRegions')}}" + "?country_id=" + country_id

        // start state region select2
        $(".state-region-select2").select2({
            allowClear: true,
            placeholder: "Select State Region",
            ajax: {
                url,
                dataType: 'json',
                data: function(params) {
                    return {
                        country_id: country_id,
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    console.log(data)
                    let mappedData = data.data.map((data) => {
                        return {
                            id: data.id,
                            text: data.name
                        }
                    })

                    return {
                        results: mappedData,
                        pagination: {
                            more: (params.page * data.per_page) < data.total
                        }
                    };
                },

            },
        });
        // end state region select2
    }
</script>
@stop