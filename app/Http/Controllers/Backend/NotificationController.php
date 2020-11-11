<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->orderBy('id', 'desc')->paginate(10);
        // dd($notifications->currentPage);
        return view('backend.notification.index', compact('notifications'));
    }

    public function clickNotifications(DatabaseNotification $notification)
    {

        $notification->markAsRead();

        return redirect($notification->data["url"]);
    }
}
