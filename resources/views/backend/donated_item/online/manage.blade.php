@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('content_header')

@stop

@section('content')

<div class="row" id="dashboard-app">
    <online-manage-component
    :model='@json($donatedItem)'
    ></online-manage-component>
</div>

@endsection

@section('js')
<script>
    // var stepper2Node = document.querySelector('#stepper2')

    // stepper2Node.addEventListener('show.bs-stepper', function(event) {
    //     console.warn('show.bs-stepper', event)
    // })
    // stepper2Node.addEventListener('shown.bs-stepper', function(event) {
    //     console.warn('shown.bs-stepper', event)
    // })

    // var stepper2 = new Stepper(document.querySelector('#stepper2'), {
    //     linear: false,
    //     animation: true
    // })
    // var stepper = "{{Request()->stepper}}";

    // if (stepper.length != 0) {
    //     stepper2.to(stepper);
    // }
</script>
@stop