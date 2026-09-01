<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // ذخیره role در session
        if ($request->has('role')) {
            session(['login_role' => $request->role]);
        }

        // مسیر redirect بعد از لاگین
        if ($request->has('redirect_to')) {
            session(['redirect_after_login' => $request->redirect_to]);
        }

        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:employer,freelancer',
            'phone'    => 'required|string|max:255',
        ], [
            'username.unique' => 'نام کاربری تکراری است.',
        ]);

        Session::put('register_data', [
            'name'     => $request->name,
            'username' => $request->username,
            'role'     => $request->role,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password), // اگر لازم داری نگه داری
        ]);

        Session::put('auth_type', 'register');

        $otpCode = rand(1000, 9999);
        Session::put('otp_code', $otpCode);
        Session::put('otp_expire', now()->addMinutes(2));

        try {
            $api = new KavenegarApi(config('services.kavenegar.api_key'));
            $message ="کد احراز هویت شما در التا: {$otpCode}";

            $api->Send(config('services.kavenegar.sender'), $request->phone, $message);

            return redirect()->route('login-otp')
                ->with('success', 'کد احراز هویت ارسال شد.')
                ->with('phone', $request->phone);
        } catch (\Exception $e) {
            return back()->withErrors(['sms' => 'خطای ارسال پیامک: '.$e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'UsernameOrPhone' => 'required|string',
            'password' => 'required|string',
        ]);

        $input = $request->UsernameOrPhone;

        $user = preg_match('/^09\d{9}$/', $input)
            ? User::where('phone', $input)->first()
            : User::where('username', $input)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'UsernameOrPhone' => 'اطلاعات ورود نادرست است'
            ])->withInput();
        }

        Auth::login($user);

        $user->session_token = session()->getId();
        $user->save();

        if ($request->filled('redirect_to')) {
            return redirect($request->redirect_to);
        }
        // اگر از صفحه ولکام برای مشاهده بیشتر آمده باشد
        if ($request->redirect === 'search-results') {

            return redirect()->route(
                $user->role === 'employer'
                    ? 'user.search'
                    : 'user.search.employer',
                [
                    'redirect' => 'search-results'
                ]
            );
        }


        // سناریوی عادی
        return redirect()->route(
            $user->role === 'employer'
                ? 'employerHome'
                : 'freelancerHome'
        )->with('success', 'ورود با موفقیت انجام شد.');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if (Session::get('otp_code') != $request->otp) {
            return back()->withErrors(['otp' => 'کد وارد شده صحیح نیست'])->withInput();
        }

        if (now()->greaterThan(Session::get('otp_expire'))) {
            return back()->withErrors(['otp' => 'کد منقضی شده است'])->withInput();
        }

        $authType = Session::get('auth_type');
        $data = Session::get('register_data');

        if ($authType === 'reset_password') {
            $user = User::where('username', $data['username'])->first();

            if ($user) {
                // تولید رمز رندوم
                $randomPassword = Str::random(10); // شامل حروف بزرگ و کوچک و عدد

                // ذخیره رمز هش شده
                $user->password = Hash::make($randomPassword);
                $user->save();

                // ارسال رمز جدید با پیامک
                try {
                    $api = new KavenegarApi(config('services.kavenegar.api_key'));
                    $message = "کاربر گرامی {$user->name}\nرمز عبور جدید شما:\n{$randomPassword}";
                    $api->Send(config('services.kavenegar.sender'), $user->phone, $message);
                } catch (\Exception $e) {
                    \Log::error('خطای ارسال پیامک رمز جدید: '.$e->getMessage());
                }
            }

            Session::put('user_id', $user->id);


            Session::forget(['register_data', 'otp_code', 'otp_expire', 'auth_type']);
            return redirect()->route('reset.password.form')
                ->with('success');
        }


        if ($authType === 'register') {
            $user = User::create([
                'name'     => $data['name'],
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'role'     => $data['role'],
                'workarea' => 'کاربر التا',
                'phone'    => $data['phone'],
            ]);
        } else {
            $user = User::where('username', $data['username'])->first();
        }


        Session::forget(['register_data', 'otp_code', 'otp_expire', 'auth_type']);

        Auth::login($user);

        $user->session_token = session()->getId();
        $user->save();

        Cache::forever('user-is-online-' . $user->id, true);

        $nowDate = Jalalian::now()->format('Y/m/d');
        $nowTime = Jalalian::now()->format('H:i:s');
        $welcomeMessage = "کاربر گرامی {$user->name}، خوش آمدید!\n{$nowDate}\n{$nowTime}";

        try {
            $api = new KavenegarApi(config('services.kavenegar.api_key'));
            $api->Send(config('services.kavenegar.sender'), $user->phone, $welcomeMessage);
        } catch (\Exception $e) {
            \Log::error('خطای ارسال پیامک خوش آمدگویی: '.$e->getMessage());
        }

        return $user->role === 'employer'
            ? redirect()->route('employerHome')->with('success', 'ورود موفقیت‌آمیز بود.')
            : redirect()->route('freelancerHome')->with('success', 'ورود موفقیت‌آمیز بود.');
    }

    public function logout(Request $request)
    {
        $role = Auth::guard('web')->user()->role ?? 'employer'; // گرفتن رول قبل از خروج

        Cache::forget('user-is-online-' . Auth::guard('web')->id());
        Auth::guard('web')->logout(); // استفاده از گارد web

        return redirect()->route('login.form', ['role' => $role]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'UsernameOrPhone' => 'required|string',
        ]);

        $input = $request->input('UsernameOrPhone');

        // 🔹 پیدا کردن کاربر
        $user = preg_match('/^09\d{9}$/', $input)
            ? User::where('phone', $input)->first()
            : User::where('username', $input)->first();

        if (!$user) {
            return back()->withErrors([
                'UsernameOrPhone' => 'کاربری با این اطلاعات یافت نشد.'
            ])->withInput();
        }

        // 🔹 ذخیره اطلاعات ضروری در سشن
        Session::put('register_data', [
            'username' => $user->username,
            'phone'    => $user->phone,
            'role'     => $user->role,
        ]);
        Session::put('auth_type', 'reset_password'); // ✅ تغییر به reset_password

        // 🔹 تولید OTP
        $otpCode = random_int(1000, 9999);
        Session::put('otp_code', $otpCode);
        Session::put('otp_expire', now()->addMinutes(2));

        try {
            $api = new KavenegarApi(config('services.kavenegar.api_key'));
            $message = "کد بازیابی رمز عبور شما: {$otpCode}";
            $api->Send(config('services.kavenegar.sender'), $user->phone, $message);

            // 🔹 فقط success برگردون → شماره توی flash ذخیره نمی‌کنیم
            return redirect()->route('login-otp')
                ->with('success', 'کد تایید برای بازیابی رمز عبور ارسال شد.')
                ->with('phone', $user->phone);

        } catch (\Exception $e) {
            return back()->withErrors([
                'sms' => 'خطای ارسال پیامک: '.$e->getMessage()
            ]);
        }
    }

    public function confirmResetPassword(Request $request)
    {
        $request->validate([
            'user_id'            => 'required|exists:users,id',
            'oldPassword'        => 'required|string',
            'newPassword'        => 'required|string|min:6|confirmed', // نیاز به ConfirmNewPassword
        ], [
            'user_id.required'        => 'کاربر نامعتبر است.',
            'user_id.exists'          => 'کاربر یافت نشد.',
            'oldPassword.required'    => 'رمز عبور قبلی الزامی است.',
            'newPassword.required'    => 'رمز عبور جدید الزامی است.',
            'newPassword.min'         => 'رمز عبور جدید باید حداقل 6 کاراکتر باشد.',
            'newPassword.confirmed'   => 'رمز عبور و تکرار آن یکسان نیست.',
        ]);

        // پیدا کردن کاربر با آیدی
        $user = User::find($request->user_id);

        if (!$user) {
            return redirect()->route('login.form')->withErrors(['msg' => 'کاربر یافت نشد.']);
        }

        // بررسی مطابقت رمز قبلی
        if (!Hash::check($request->oldPassword, $user->password)) {
            return back()->withErrors(['oldPassword' => 'رمز عبور قبلی صحیح نیست.']);
        }

        // ذخیره رمز جدید
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // خروج از سشن فعلی
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // پیامک به کاربر
        try {
            $api = new KavenegarApi(config('services.kavenegar.api_key'));
            $message = "کاربر گرامی {$user->name}\nرمز عبور شما با موفقیت تغییر کرد.";
            $api->Send(config('services.kavenegar.sender'), $user->phone, $message);
        } catch (\Exception $e) {
            \Log::error('خطای ارسال پیامک تغییر رمز: '.$e->getMessage());
        }

        return redirect()->route('login.form', ['role' => $user->role])
            ->with('success', 'رمز عبور شما با موفقیت تغییر یافت. لطفاً دوباره وارد شوید.');
    }




}
