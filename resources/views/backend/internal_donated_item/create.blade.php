@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')

@stop

@section('content')
<div id="dashboard-app">
    <internal-donated-item-component :internal_donated_item='@json($internalDonatedItem)'/>
</div>
@stop

@section('js')
@stop