@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')
@stop

@section('content')
<div id="dashboard-app">
    <share-internal-donated-item-component :share_internal_donated_item='@json($shareInternalDonatedItem)'/>
</div>
@stop

@section('js')
@stop