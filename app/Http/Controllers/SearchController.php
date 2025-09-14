<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $clickedUserId = $request->input('clickedUserId');
        $clickedUser = null;
        $query = $request->input('q');
        $users = collect();

        if ($query) {
            $keywords = explode(' ', $query);

            $results = DB::table('users')
                ->join('skill_mapping', 'users.id', '=', 'skill_mapping.user_id')
                ->join('user_skill', 'skill_mapping.skill_id', '=', 'user_skill.id')
                ->leftJoin('keyword_mapping', 'user_skill.id', '=', 'keyword_mapping.skill_id')
                ->leftJoin('keyword', 'keyword_mapping.keyword_id', '=', 'keyword.id')
                ->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('keyword.keyword', 'like', "%$word%")
                            ->orWhere('user_skill.skill', 'like', "%$word%");
                    }
                })
                ->select(
                    'users.id as user_id',
                    'users.name',
                    'users.username',
                    'users.profilepic',
                    'users.aboutme',
                    'users.workarea',
                    'user_skill.skill as skill'
                )
                ->get();

            $grouped = $results->groupBy('user_id')->map(function ($items) {
                $first = $items->first();
                return (object)[
                    'id' => $first->user_id,
                    'name' => $first->name,
                    'username' => $first->username,
                    'profilepic' => $first->profilepic,
                    'aboutme' => $first->aboutme,
                    'workarea' => $first->workarea,
                    'skills' => $items->pluck('skill')->unique()->values(),
                ];
            });

            $users = $grouped->values();
        }

        if ($clickedUserId) {
            $clickedUser = User::with([
                'personalInformation',
                'educationalHistories',
                'languages',
                'jobHistories',
                'portfolios',
                'companies',
                'skillMapping.skill'
            ])->find($clickedUserId);
        }
        $favoritedIds = DB::table('ch_favorites')
            ->where('user_id', auth()->id())
            ->pluck('favorite_id')
            ->toArray();

        $users = $grouped->values()->map(function ($user) use ($favoritedIds) {
            $user->is_favorite = in_array($user->id, $favoritedIds);
            return $user;
        });

        return view('search-result', compact('users', 'query', 'clickedUser'));
    }
    public function mobileProfile($id)
    {
        $clickedUser = User::with([
            'personalInformation',
            'educationalHistories',
            'languages',
            'jobHistories',
            'portfolios',
            'companies',
            'skillMapping.skill'
        ])->find($id);

        if (!$clickedUser) {
            abort(404);
        }

        // فقط همین کاربر برای موبایل نمایش داده می‌شود، پس users فقط یک عضو دارد
        $users = collect([$clickedUser])->map(function ($user) {
            return (object)[
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'profilepic' => $user->profilepic,
                'aboutme' => $user->aboutme,
                'workarea' => $user->workarea,
                'skills' => $user->skillMapping->pluck('skill.skill')->unique()->values(),
            ];
        });

        // لیست علاقه‌مندی‌ها
        $favoritedIds = DB::table('ch_favorites')
            ->where('user_id', auth()->id())
            ->pluck('favorite_id')
            ->toArray();

        $users = $users->map(function ($user) use ($favoritedIds) {
            $user->is_favorite = in_array($user->id, $favoritedIds);
            return $user;
        });

        return view('mobile-search-result', [
            'users' => $users,
            'clickedUser' => $clickedUser,
            'query' => null,
        ]);
    }
}
