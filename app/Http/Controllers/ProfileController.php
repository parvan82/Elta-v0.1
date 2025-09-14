<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{

    public function showSuggestedFreelancers()
    {
        $users = User::with(['skills', 'languages']) // skills = دسترسی مستقیم به user_skill
        ->where('role', 'freelancer')
            ->whereNotNull('name')
            ->whereNotNull('username')
            ->whereNotNull('workarea')
            ->whereNotNull('aboutme')
            ->whereHas('skills')
            ->inRandomOrder()
            ->take(15)
            ->get();

        return view('HomeEmployer', compact('users'));
    }


    public function showSuggestedEmployer()
    {
        $users = User::with(['skills', 'languages'])
            ->where('role', 'employer')
            ->whereNotNull('name')
            ->whereNotNull('username')
            ->whereNotNull('workarea')
            ->whereNotNull('aboutme')
            ->inRandomOrder()
            ->take(15)
            ->get();


        return view('HomeFreelancer', compact('users'));
    }

    public function unreadMessagesCount()
    {
        $count = DB::table('ch_messages') // نام جدول پیام‌ها
        ->where('to_id', Auth::id()) // پیام‌های ارسال شده به کاربر جاری
        ->where('seen', 0) // پیام‌های نخوانده
        ->count(); // تعداد پیام‌ها

        return response()->json([
            'unread' => $count
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
