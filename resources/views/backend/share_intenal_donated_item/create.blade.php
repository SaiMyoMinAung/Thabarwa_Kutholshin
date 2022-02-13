@extends('adminlte::page')

@section('title', 'Detail Of Donated Item')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop

@section('content_header')
<div class="row">
    <a class="btn btn-outline-primary" style="min-width: 250px" href="{{route('share_internal_donated_items.index')}}"><i class="fas fa-table"></i>
        {{ trans("button.show_table") }}
    </a>
    <h1 class="ml-5">
        {{trans('title.add_shared_list')}}
    </h1>
</div>
@stop

@section('content')
<div id="dashboard-app">
    <share-internal-donated-item-component :share_internal_donated_item='@json($shareInternalDonatedItem)' />
</div>
@stop

@section('js')
@stop