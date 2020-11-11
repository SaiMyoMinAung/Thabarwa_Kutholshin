@extends('adminlte::page')

@section('css')
@stop

@section('title', 'All Notifications')

@section('content_header')
<div class="mb-3 d-flex justify-content-between">
    <div>
        <h1>All Notifications</h1>
    </div>
</div>
@stop

@section('content')
<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">Inbox</h3>

        <div class="card-tools">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search Mail">
                <div class="input-group-append">
                    <div class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-controls">
            <div class="float-right">
                {{$notifications->currentPage() == 1 ? 1 : ($notifications->currentPage()*$notifications->perPage())}}
                -
                {{$notifications->currentPage() == 1 ? $notifications->perPage() : ($notifications->currentPage()*$notifications->perPage())+$notifications->perPage()}} / {{$notifications->total()}}
                <div class="btn-group">
                    <a @if(($notifications->currentPage()-1) != 0) href="{{$notifications->path().'?page='.($notifications->currentPage()-1)}}" @endif class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></a>
                    <a @if($notifications->lastPage() != ($notifications->currentPage()+1)) href="{{$notifications->path().'?page='.($notifications->currentPage()+1)}}" @endif class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></a>
                </div>
                <!-- /.btn-group -->
            </div>
            <!-- /.float-right -->
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped" id="noti-table">
                <tbody>
                    @forelse($notifications as $noti)
                    <tr class="clickable-row @if($noti->unread()) bg-gradient-success @endif" data-href="{{route('notifications.click',$noti->id)}}">
                            <td><i class="fas fa-envelope mr-2"></i></td>
                            <td class="mailbox-name">{{$noti->data["name"]}}</td>
                            <td class="mailbox-subject">
                                {{$noti->data["phone"]}}
                            </td>
                            <td class="mailbox-subject">{{$noti->data["about_item"]}}</td>
                            <td class="mailbox-date">{{$noti->created_at->diffForHumans()}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center">No Notifications Yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>

</div>
@stop

@section('js')
<script>
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
</script>
@stop