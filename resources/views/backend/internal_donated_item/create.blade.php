@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')
<div class="row">
    <a href="{{route('internal_donated_items.index')}}" style="min-width: 250px" class="btn btn-outline-primary"><i class="fas fa-table"></i>
        {{trans('button.show_table')}}</a>
    <h1 class="ml-5">
        {{trans('title.add_list_to_store')}}
    </h1>
</div>
@stop

@section('content')
<div id="dashboard-app">
    <internal-donated-item-component :internal_donated_item='@json($internalDonatedItem)' />
</div>
@stop

@section('js')
@stop