<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SearchController;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;


Route::get('/unread-messages', [ProfileController::class, 'unreadMessagesCount']);

Route::post('/edit/message', [MessagesController::class, 'edit'])->name('edit.message');

// صفحه اصلی
Route::get('/elta', function () {return view('welcome');});

Route::post('/chatify/record-audio', [MessagesController::class, 'recordAudio'])->name('chatify.record.audio');

// صفحه خانه

Route::middleware(['auth', 'role:employer'])->get('home/employer', [ProfileController::class, 'showSuggestedFreelancers'])->name('employerHome');
Route::middleware(['auth', 'role:freelancer'])->get('home/freelancer', [ProfileController::class, 'showSuggestedEmployer'])->name('freelancerHome');



Route::get('elta/login', function (Request $request) {
    $role = $request->query('role', 'employer'); // مقدار پیش‌فرض employer
    return view('login', compact('role')); // ارسال متغیر role به ویو login
})->name('login.form');

Route::middleware(['auth' , 'role:employer'])->get('/home/profile/employer', function () {return view('EmployerProfile');})->name('employerProfile');
Route::middleware(['auth' , 'role:freelancer'])->get('/home/profile/freelancer', function () {return view('FreelancerProfile');})->name('freelancerProfile');


Route::post('/submit-profile', [PortfolioController::class, 'store'])->name('profile.submit');
Route::delete('/delete-language/{id}', [PortfolioController::class, 'deleteLanguage'])->name('delete.language');
// مسیرهای مربوط به ویرایش و حذف اطلاعات تحصیلی
Route::delete('/education/{id}', [PortfolioController::class, 'deleteEducation'])->name('education.delete');
// حذف مهارت
Route::delete('/delete-skill/{id}', [PortfolioController::class, 'deleteSkill'])->name('delete.skill');
Route::delete('/job-history/{id}', [PortfolioController::class, 'deleteJob'])->name('delete.job');



Route::put('/educational/update', [PortfolioController::class, 'EducationalUpdate'])->name('educational.update');

Route::put('/job/update/{id}', [PortfolioController::class, 'JobUpdate']);
Route::delete('/portfolio/{id}', [PortfolioController::class, 'deletePortfolio'])->name('delete.Portfolio');



// In routes/web.php
Route::post('/register' , [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->post('/companies/save', [CompanyController::class, 'save'])
    ->name('companies.save');

Route::get('/portfolio/{id}', [PortfolioController::class, 'showPortfolio'])->name('portfolioShow');

Route::get('/home/elta-card', function () {return view('EltaCard');})->name('EltaCard');

Route::get('/search', [SearchController::class, 'index'])->name('user.search');

Route::get('/notifications', [NotificationController::class, 'latestMessages'])->middleware('auth')->name('notifications');

Route::post('/favorite/toggle', [FavoriteChatController::class, 'toggle'])->middleware('auth');


Route::get('/mobile/profile/{id}', [SearchController::class, 'mobileProfile'])->middleware('auth')->name('mobile.profile');

Route::get('/login/otp' , function () {return view('login-otp');})->name('login-otp');
Route::post('/login/otp/code' , [AuthController::class, 'verifyCode'])->name('verify.code');
Route::post('/reset' , [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/confirm/reset/password' , [AuthController::class, 'confirmResetPassword'])->name('ConfirmResetPassword');
Route::get('/reset/password' , function(){return view('reset-password-form');})->name('reset.password.form');

Route::middleware(['auth' , 'role:employer'])->get('/home/new-project', function () {return view('new-project');})->name('newProject');
Route::middleware(['auth' , 'role:employer'])->post('/home/new-project', [App\Http\Controllers\NewProjectController::class, 'store'])->name('new-project.store');
