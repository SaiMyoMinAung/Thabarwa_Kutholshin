@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>Settings</h1>
    </div>
</div>
@stop

@section('content')
<div id="dashboard-app">
    <setting-component></setting-component>
</div>
@stop

@section('js')
<script>
    $(function() {
        $(".dropdown-item").click(function() {
            var text = $(this).text();
            console.log(text)
            $(this).parent().parent()[0].childNodes[0].text = text
        });

    });
</script>
@stop