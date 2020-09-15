@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('content_header')

@stop

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <h2><span class="badge badge-success">{{$donatedItem->about_item}}</span> Item Management</h2>
        <div id="stepper2" class="bs-stepper">
            <div class="bs-stepper-header">
                <div class="step" data-target="#test-nl-1">
                    <button type="button" class="btn step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Assign Driver Step</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#test-nl-2">
                    <div class="btn step-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Store Step</span>
                    </div>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#test-nl-3">
                    <button type="button" class="btn step-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Assign Repairer Step</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#test-nl-4">
                    <button type="button" class="btn step-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Assign Deliver Driver Step</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#test-nl-5">
                    <button type="button" class="btn step-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">Receiver Step</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="test-nl-1" class="content">
                    <form action="{{route('donated_items.assign_driver',$donatedItem->uuid)}}" method="post" id="assign-driver-form">
                        @csrf
                        <input type="hidden" name="stepper" value="1">
                        <div class="row bg-info p-2 rounded">
                            <div class='col-md-6'>
                                <div class="form-group {{ $errors->has('driver_id') ? 'has-error' : '' }}">
                                    <label for="state_region">Assign Driver <span class="text-danger">*</span></label>
                                    <select name="pickedup_driver_id" class="form-control select2 {{ $errors->has('driver_id') ? 'is-invalid' : '' }}">
                                        <option></option>
                                        @foreach($drivers as $driver)
                                        <option value="{{$driver->id}}" @if($donatedItem->pickedup_driver_id == $driver->id) selected @endif>{{$driver->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('driver_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('driver_id') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="is_pickingup" value="1" @if($donatedItem->is_pickingup == 1) checked @endif> Is Picking Up
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-warning">Assign</button>
                                    <a class="btn btn-success" id="arrive-at-office">Arrive At Office</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div id="test-nl-2" class="content">
                    <p class="text-center">test 1</p>

                </div>
                <div id="test-nl-3" class="content">
                    <p class="text-center">test 3</p>

                </div>
                <div id="test-nl-4" class="content">
                    <p class="text-center">test 4</p>

                </div>
                <div id="test-nl-5" class="content">
                    <p class="text-center">test 5</p>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Picked Up Driver",
            allowClear: true
        })
        $('#arrive-at-office').on('click', function() {
            var r = confirm('Are You Sure To Confirm The Item Arriving At Office')
            if (r) {
                var url = "{{route('donated_items.arrive_at_office',$donatedItem->uuid)}}";
                window.location.href = url;
            }

        });
    });
    var stepper2Node = document.querySelector('#stepper2')

    stepper2Node.addEventListener('show.bs-stepper', function(event) {
        console.warn('show.bs-stepper', event)
    })
    stepper2Node.addEventListener('shown.bs-stepper', function(event) {
        console.warn('shown.bs-stepper', event)
    })

    var stepper2 = new Stepper(document.querySelector('#stepper2'), {
        linear: false,
        animation: true
    })
    var stepper = "{{Request()->stepper}}";

    if (stepper.length != 0) {
        stepper2.to(stepper);
    }
</script>
@stop