<li class="nav-item dropdown show">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
        <i class="far fa-bell"></i>
        <span class="badge badge-success navbar-badge">
            <span class="badge badge-danger navbar-badge d-none" id="noti-badge" data-num="0"></span>
            {{auth()->user()->unreadNotifications->count()}}
        </span>

    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " id="noti-menu" style="left: inherit; right: 0px;">
        @forelse(auth()->user()->getUnreadNotis() as $unreadNoti)
        <a href="{{route('notifications.click',$unreadNoti->id)}}" class="dropdown-item bg-success">
            <i class="fas fa-envelope mr-2"></i>
            {{ Str::limit($unreadNoti->data["name"], 10) }}
            donated
            {{ Str::limit($unreadNoti->data["about_item"], 10) }}
        </a>
        <div class="dropdown-divider"></div>
        @empty
        <div class="dropdown-item text-center" id="no-new-noti">
            No New Notification
        </div>
        @endforelse
        <!-- <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
        </a>
        <div class="dropdown-divider"></div> -->
        <a href="{{route('notifications.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>