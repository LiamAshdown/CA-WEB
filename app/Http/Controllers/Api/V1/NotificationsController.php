<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResourceCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Notification;

class NotificationsController extends Controller
{
    /**
     * Get Notifications
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return new NotificationResourceCollection($notifications);
    }

    /**
     * Get Unread Notifications
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unread()
    {
        $notifications = auth()->user()->unreadNotifications;

        return new NotificationResourceCollection($notifications);
    }

    /**
     * Mark a notification as read.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $notification->read_at = Carbon::now();
        $notification->save();

        return response()->json(['message' => 'Notification marked as read successfully.']);
    }
}
