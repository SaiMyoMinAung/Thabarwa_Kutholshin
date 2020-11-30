@extends('adminlte::page')

@section('title', 'Manage Request')

@section('css')
@stop

@section('content_header')
@stop

@section('content')
<div id="dashboard-app">
    <div class="col-md-12 col-lg-12">
        <a class="btn btn-secondary" href="{{route('donated_items.index')}}">Back</a>
    </div>
    <manage-request :data='@json($requestedItem)'></manage-request>
</div>
@stop

@section('js')

@stop