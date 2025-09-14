<?php

// app/Http/Controllers/FavoriteChatController.php
namespace App\Http\Controllers;

use App\Models\ChFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FavoriteChatController extends Controller
{
    public function toggle(Request $request)
    {
        $userId = Auth::id();
        $targetId = $request->input('favorite_id');

        $favorite = ChFavorite::where('user_id', $userId)
            ->where('favorite_id', $targetId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            ChFavorite::create([
                'id' => Str::uuid(),
                'user_id' => $userId,
                'favorite_id' => $targetId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
