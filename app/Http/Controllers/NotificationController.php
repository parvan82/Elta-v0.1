<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function notifications()
    {
        $userId = auth()->id();

        // ------------------- پیام‌ها -------------------
        $messages = ChMessage::with('from')
            ->where('to_id', $userId)
            ->where('seen', false)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($msg) {
                $from = $msg->from;
                if (!$from) return null;

                return [
                    'type' => 'message',
                    'from_name' => $from->name,
                    'from_username' => $from->username,
                    'from_avatar' => $from->profilepic
                        ? asset('storage/'.$from->profilepic)
                        : asset('images/default.jpg'),
                    'message' => \Illuminate\Support\Str::limit(strip_tags($msg->body), 50),
                    'link' => url(config('chatify.routes.prefix')).'/'.$from->id,
                    'created_at' => $msg->created_at,
                ];
            })
            ->filter()
            ->values()      // ← مهم
            ->collect();    // ← بسیار مهم

        // -------------------- لایک‌ها --------------------
        $likes = DB::table('likes as l')
            ->join('user_portfolio as p', 'l.portfolio_id', '=', 'p.id')
            ->join('users as u', 'l.user_id', '=', 'u.id')
            ->where('p.user_id', $userId)
            ->where('l.created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('l.created_at', 'desc')
            ->select(
                'l.created_at as liked_at',
                'u.name as liker_name',
                'u.username as liker_username',
                'u.profilepic as liker_avatar',
                'p.id as portfolio_id',
                'p.title as portfolio_title',
                'p.file as portfolio_file'
            )
            ->get()
            ->map(function ($like) {
                return [
                    'type' => 'like',
                    'from_name' => $like->liker_name,
                    'from_username' => $like->liker_username,
                    'from_avatar' => $like->liker_avatar
                        ? asset('storage/'.$like->liker_avatar)
                        : asset('images/default.jpg'),
                    'message' => "نمونه کار $like->portfolio_title شما را لایک کرد",
                    'link' => url('/portfolio/'.$like->portfolio_id),
                    'portfolio_title' => $like->portfolio_title,
                    'portfolio_file' => $like->portfolio_file
                        ? asset('storage/'.$like->portfolio_file)
                        : null,
                    'created_at' => $like->liked_at,
                ];
            })
            ->values()
            ->collect();   // ← اینم مهم


        // ------------------- ادغام همه -------------------
        $activities = $messages->merge($likes)
            ->sortByDesc('created_at')
            ->values(); // کلیدهای مرتب‌شده

        return view('notification', [
            'activities' => $activities
        ]);
    }
}
