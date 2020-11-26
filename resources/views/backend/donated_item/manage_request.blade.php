@extends('adminlte::page')

@section('title', 'Manage Request')

@section('css')
@stop

@section('content_header')
@stop

@section('content')
<div id="dashboard-app">
    <manage-request :data='@json($requestedItem)'></manage-request>
</div>
@stop

@section('js')

@stop