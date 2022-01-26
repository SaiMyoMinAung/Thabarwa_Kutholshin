@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')
<div class="d-flex justify-content-center">
    <h1>
        {{trans('title.add_list_to_store')}}
    </h1>
</div>
<div class="row">
    <div class="col-md-3">
        <a href="{{route('internal_donated_items.index')}}" style="min-width: 250px" class="btn btn-outline-primary"><i class="fas fa-table"></i> {{trans('button.show_table')}}</a>
    </div>
</div>
@stop

@section('content')
<div id="dashboard-app">
    <internal-donated-item-component :internal_donated_item='@json($internalDonatedItem)' />
</div>
@stop

@section('js')
@stop