<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Notification;


class NotificationController extends Controller
{
    
    public function list()
    {
        $notification = Notification::paginate(8);
        return view('WebFrontend.notification_list',compact('notification'));
    }
}