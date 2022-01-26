@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')
<div class="d-flex justify-content-center">
    <h1>
        {{trans('title.add_shared_list')}}
    </h1>
</div>
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-outline-primary" style="min-width: 250px" href="{{route('share_internal_donated_items.index')}}"><i class="fas fa-table"></i>
            {{ trans("button.show_table") }}
        </a>
    </div>
</div>
@stop

@section('content')
<div id="dashboard-app">
    <share-internal-donated-item-component :share_internal_donated_item='@json($shareInternalDonatedItem)' />
</div>
@stop

@section('js')
@stop