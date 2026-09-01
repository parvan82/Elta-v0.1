<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Advatisement;
use App\Models\ChFavorite;
use App\Models\NewProject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProfileController extends Controller
{


public function myAds()
{
    $user = auth()->user();

    $ads = Advatisement::with(['images', 'tags'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    return view('FreelancerProfile', compact('ads'));
}
    public function myProjects()
    {
        $user = auth()->user();

        $projects = NewProject::with([ 'serviceTags', 'skills'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('EmployerProfile', compact('projects'));
    }

    public function showSuggestedFreelancers()
    {
        $authId = auth()->id();

        $twoDaysAgo = Carbon::now()->subDays(2)->startOfDay();
        $nextDay    = Carbon::now()->subDays(1)->startOfDay();

        $ads = Advatisement::with(['images', 'tags', 'user'])
            ->whereBetween('created_at', [$twoDaysAgo, $nextDay])
            ->inRandomOrder()
            ->take(15)
            ->get();

        if ($ads->count() < 15) {
            $ads = Advatisement::with(['images', 'tags', 'user'])
                ->inRandomOrder()
                ->take(15)
                ->get();
        }

        foreach ($ads as $ad) {
            $ad->is_favorite = ChFavorite::where('user_id', $authId)
                ->where('favorite_id', $ad->user->id)
                ->exists();
        }

        $users = User::with(['skills', 'languages'])
            ->where('role', 'freelancer')
            ->whereNotNull('name')
            ->whereNotNull('username')
            ->whereNotNull('workarea')
            ->whereNotNull('aboutme')
            ->whereHas('skills')
            ->inRandomOrder()
            ->take(15)
            ->get();

        foreach ($users as $user) {
            $user->is_favorite = ChFavorite::where('user_id', $authId)
                ->where('favorite_id', $user->id)
                ->exists();
        }

        $allFreelancers = User::select('id', 'name', 'workarea', 'profilepic')
            ->inRandomOrder()
            ->take(60)
            ->get();

        $chunks = $allFreelancers->chunk(15);

        return view('HomeEmployer', [
            'users' => $users,
            'ads' => $ads,
            'randomRows' => $chunks
        ]);
    }


    public function showSuggestedEmployer()
    {
        $authId = auth()->id();

        $twoDaysAgo = Carbon::now()->subDays(2)->startOfDay();

        $projects = NewProject::with(['user', 'serviceTags', 'skills'])
            ->where('created_at', '>=', $twoDaysAgo)
            ->latest('created_at')
            ->take(15)
            ->get();

        if ($projects->count() < 15) {
            $projects = NewProject::with(['user', 'serviceTags', 'skills'])
                ->inRandomOrder()
                ->take(15)
                ->get();
        }

        foreach ($projects as $project) {
            $project->user->is_favorite = ChFavorite::where('user_id', $authId)
                ->where('favorite_id', $project->user->id)
                ->exists();
        }


        $users = User::with('companies')
            ->where('role', 'employer')
            ->whereHas('skills')
            ->inRandomOrder()
            ->take(15)
            ->get();

        foreach ($users as $user) {
            $user->is_favorite = ChFavorite::where('user_id', $authId)
                ->where('favorite_id', $user->id)
                ->exists();
        }

        $allFreelancers = User::select('id', 'name', 'workarea', 'profilepic')
            ->inRandomOrder()
            ->take(60)
            ->get();

        foreach ($allFreelancers as $fl) {
            $fl->is_favorite = ChFavorite::where('user_id', $authId)
                ->where('favorite_id', $fl->id)
                ->exists();
        }

        $chunks = $allFreelancers->chunk(15);

        return view('HomeFreelancer', [
            'users' => $users,
            'projects' => $projects,
            'randomRows' => $chunks
        ]);
    }



    public function welcome()
    {
        $stats = [
            'total_users' => User::count(),
            'total_projects' => NewProject::count(),
            'total_ads' => Advatisement::count(),
            'success_rate' => '95%'
        ];

        $projects = NewProject::with(['user', 'serviceTags', 'skills'])
            ->inRandomOrder()
            ->latest('created_at')
            ->take(6)
            ->get();

        $ads = Advatisement::with(['images', 'tags', 'user'])
            ->inRandomOrder()
            ->latest('created_at')
            ->take(6)
            ->get();

        $allFreelancers = User::select('id', 'name', 'workarea', 'profilepic')
            ->inRandomOrder()
            ->take(60)
            ->get();

        $randomRows = $allFreelancers->chunk(15);

        return view('welcome', compact('stats', 'projects', 'ads' , 'randomRows'));
    }

    public function unreadMessagesCount()
    {
        $count = DB::table('ch_messages')
        ->where('to_id', Auth::id())
        ->where('seen', 0)
        ->count();

        return response()->json([
            'unread' => $count
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
