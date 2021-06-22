@extends('adminlte::page')

@section('title', 'Search')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Search</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="card col-md-4">
        <div class="card-body text-center">
            <a href="{{route('search.internal.requests')}}">Search Internal Requests</a>
        </div>
    </div>
</div>

@stop