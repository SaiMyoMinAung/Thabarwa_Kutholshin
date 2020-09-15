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
                        <h3>Item Information</h3>

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
                        <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                            <label for="remark">Remark <span class="text-danger">*</span></label>
                            <textarea id="remark" name="remark" hidden>{{$donatedItem->remark ?? 'No Remark!'}}</textarea>
                            <div class="remark-div" style="border:1px solid white;border-radius:5px;padding:5px;margin-bottom:4px;">{!! $donatedItem->remark ?? 'No Remark!' !!}</div>
                            <button class="btn btn-xs btn-primary remark-edit" type="button">Edit Remark</button>
                            <button class="btn btn-xs btn-success remark-done" type="button">Done</button>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_confirm_by_donor" value="1" @if($donatedItem->is_confirm_by_donor == 1) checked @endif> Is Confirm By Donor<span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <h3>Donor Information</h3>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Enter Name" value="{{$donatedItem->donor->name}}">
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Enter Email" value="{{$donatedItem->donor->email}}">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input name="phone" type="text" class="form-control only-number {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="Enter Phone" value="{{$donatedItem->donor->phone}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('state_region_id') ? 'has-error' : '' }}">
                            <label for="state_region">State Region <span class="text-danger">*</span></label>
                            <select name="state_region_id" class="form-control select2 {{ $errors->has('state_region_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach($stateRegions as $stateRegion)
                                <option value="{{$stateRegion->id}}" @if($stateRegion->id == $donatedItem->donor->state_region_id) selected @endif>{{$stateRegion->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state_region_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state_region_id') }}
                            </div>
                            @endif
                        </div>


                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a class="btn btn-info" href="{{route('donated_items.manage',$donatedItem->uuid)}}">Manage</a>
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
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select State Region",
            allowClear: true
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
</script>
@stop