<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteChatController;
use App\Http\Controllers\NewAdvertisementController;
use App\Http\Controllers\newProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SearchController;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Models\Advatisement;


Route::get('/unread-messages', [ProfileController::class, 'unreadMessagesCount']);

Route::post('/edit/message', [MessagesController::class, 'edit'])->name('edit.message');

// صفحه اصلی
Route::get('/elta', [ProfileController::class, 'welcome']);

Route::post('/chatify/record-audio', [MessagesController::class, 'recordAudio'])->name('chatify.record.audio');

// صفحه خانه

Route::middleware(['auth', 'role:employer'])->get('home/employer', [ProfileController::class, 'showSuggestedFreelancers'])->name('employerHome');
Route::middleware(['auth', 'role:freelancer'])->get('home/freelancer', [ProfileController::class, 'showSuggestedEmployer'])->name('freelancerHome');



Route::get('elta/login', function (Request $request) {
    $role = $request->query('role', 'employer');
    return view('login', compact('role'));
})->name('login.form');


Route::middleware(['auth' , 'role:employer'])->get('/home/profile/employer', [ProfileController::class, 'myProjects'])->name('employerProfile');
Route::middleware(['auth' , 'role:freelancer'])->get('/home/profile/freelancer', [ProfileController::class, 'myAds'])->name('freelancerProfile');


Route::post('/submit-profile', [PortfolioController::class, 'store'])->name('profile.submit');
Route::delete('/delete-language/{id}', [PortfolioController::class, 'deleteLanguage'])->name('delete.language');
Route::delete('/education/{id}', [PortfolioController::class, 'deleteEducation'])->name('education.delete');
Route::delete('/delete-skill/{id}', [PortfolioController::class, 'deleteSkill'])->name('delete.skill');
Route::delete('/job-history/{id}', [PortfolioController::class, 'deleteJob'])->name('delete.job');



Route::put('/educational/update', [PortfolioController::class, 'EducationalUpdate'])->name('educational.update');

Route::put('/job/update/{id}', [PortfolioController::class, 'JobUpdate']);
Route::delete('/delete/portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('delete.Portfolio');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');


Route::post('/register' , [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->post('/companies/save', [CompanyController::class, 'save'])
    ->name('companies.save');

Route::get('/home/elta-card', function () {return view('EltaCard');})->name('EltaCard');

Route::get('/search/freelancer', [SearchController::class, 'searchFreelancer'])->name('user.search');
Route::get('/search/employer', [SearchController::class, 'searchProjects'])->name('user.search.employer');


Route::get('/notifications', [NotificationController::class, 'notifications'])
    ->middleware('auth')
    ->name('notifications');

Route::post('/favorite/toggle', [FavoriteChatController::class, 'toggle'])->middleware('auth');


Route::get('/profile/{id}', [SearchController::class, 'mobileProfile'])->middleware('auth')->name('mobile.profile');
Route::get('/content', [SearchController::class, 'mobileProject'])
    ->middleware('auth')
    ->name('mobile.Project');

Route::get('/login/otp' , function () {return view('login-otp');})->name('login-otp');
Route::post('/login/otp/code' , [AuthController::class, 'verifyCode'])->name('verify.code');
Route::post('/reset' , [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/confirm/reset/password' , [AuthController::class, 'confirmResetPassword'])->name('ConfirmResetPassword');
Route::get('/reset/password' , function(){return view('reset-password-form');})->name('reset.password.form');

Route::middleware(['auth', 'role:employer'])
    ->get('/home/new-project', function () {

        $renewProjectId = request('renew');
        $project = null;

        if ($renewProjectId) {
            $project = \App\Models\NewProject::with(['skills', 'serviceTags'])
                ->where('id', $renewProjectId)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        return view('new-project', compact('project', 'renewProjectId'));
    })->name('newProject');
Route::middleware(['auth' , 'role:employer'])->post('/home/new-project', [NewProjectController::class, 'store'])->name('new-project.store');

Route::middleware('auth')->group(function () {
    Route::post('/portfolio/{portfolio}/like', [PortfolioController::class, 'toggleLike'])->name('portfolio.like');
});



Route::middleware(['auth', 'role:freelancer'])
    ->get('/home/new-Advertisement', function (Request $request) {

        $ad = null;
        $isRenew = false;

        if ($request->has('renew')) {
            $ad = Advatisement::where('id', $request->renew)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $isRenew = true;
        }

        return view('Newadvertisement', compact('ad', 'isRenew'));
    })
    ->name('Newadvertisement');
Route::middleware(['auth' , 'role:freelancer'])->post('/ads/store' , [NewAdvertisementController::class , 'store'])->name('NewAdvertisementController');
Route::post('/ads/renew', [NewAdvertisementController::class, 'renew'])
    ->middleware(['auth','role:freelancer']);


Route::get('/test' , function (){return view('test');})->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/api/conversation/project', [newProjectController::class, 'getConversationProject']);
    Route::post('/api/conversation/project', [newProjectController::class, 'saveConversationProject']);
});
