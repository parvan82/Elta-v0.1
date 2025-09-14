<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function latestMessages()
    {
        $userId = auth()->id();


        $messages = ChMessage::with('from')
            ->where('to_id', $userId)
            ->where('seen', false) // فقط پیام‌های خوانده‌نشده
            ->orderBy('created_at', 'desc')
            ->get();



        $data = $messages->map(function ($msg) {
            return [
                'from_name' => $msg->from->name,
                'from_username' => $msg->from->username,
                'from_avatar' => $msg->from->profilepic ? asset('storage/'.$msg->from->profilepic) : asset('images/default.jpg'),
                'message' => \Illuminate\Support\Str::limit(strip_tags($msg->body), 50),
                'link' => url(config('chatify.routes.prefix')).'/'.$msg->from->id,
                'created_at' => $msg->created_at,  // اضافه کردن زمان ارسال پیام

            ];
        })->values();

        return view('notification', ['messages' => $data]);
    }
}
