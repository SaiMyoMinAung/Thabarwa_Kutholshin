@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
@include('backend.partials.admininfo')
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
            setCookie("href-id", $(this).attr('href'))
            var text = $(this).text();
            $(this).parent().parent()[0].childNodes[0].text = text
        });

        var id = getCookie("href-id");
        if (id.length != 0) {
            var link = "#myTab a[href='" + id + "']";
            console.log(link)
            $(link).tab('show')
        }
        
    });

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/backend/settings";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>
@stop