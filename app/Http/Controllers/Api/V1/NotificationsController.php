<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function unread()
    {
        $unreadNotifications = auth()->user()->notifications()->where('read', 0)->get();

        $test = '';

    }
}
