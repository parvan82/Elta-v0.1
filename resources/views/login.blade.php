<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/icons/box-icons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">

    <link rel="stylesheet" href="./../css/login.css">
    <link rel="stylesheet" href="./../css/alerts.css">
</head>

<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="custom-alert error" id="alert-message">
        <div class="alert-content">

            <div class="alert-message">{{ $error }}</div>

        </div>
    </div>
    @endforeach
    @endif

    @if (session('success'))
    <div class="custom-alert success" id="alert-message">
        <div class="alert-content">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-message">{{ session('success') }}</div>
            <button class="alert-close" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="custom-alert error" id="alert-message">
        <div class="alert-content">
            <div class="alert-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="alert-message">{{ session('error') }}</div>
            <button class="alert-close" type="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif
    <!-- Wrapper Area -->
    <div class="wrapper__area {{ request()->has(['redirect', 'role']) ? 'sign-up__Mode-active' : '' }}" id="wrapper_Area">
        <!-- Forms Area -->
        <div class="forms__area">
            <!-- Login Form -->
            <form class="login__form" id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="redirect" id="redirectField" value="{{ request()->query('redirect') }}">
                <!-- Form Title -->
                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">

                <div class="header-singIn">
                    <h1 class="form__title">ورود</h1>

                    <div class="mobile-sing-up-btn">
                        <span>ثبت نام</span>
                    </div>

                </div>
                <!-- inputs Groups -->
                <div class="input__group">
                    <label class="field">
                        <input type="text" name="UsernameOrPhone" placeholder="نام کاربری یا شماره موبایل" id="loginUsername">
                    </label>
                    <span class="input__icon"><i class='bx bx-user-circle'></i></span>
                    <small class="input__error_message"></small>
                </div>

                <div class="input__group">
                    <label class="field">
                        <input type="password" name="password" placeholder="رمز عبور" id="loginPassword" autocomplete="current-password">
                    </label>
                    <span class="input__icon"><i class="bx bx-lock"></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                    <small class="input__error_message"></small>
                </div>


                <div class="form__actions">
                    <div id="forgotPasswordBtn" class="forgot_password">
                        رمز عبور خود را فراموش کردید؟
                    </div>
                </div>
                <!-- Login Button -->
                <button type="submit" class="submit-button" id="loginSubmitBtn">ورود</button>
                <!-- Alternate Login -->

            </form>

            <!-- End Login Form -->

            <!-- Sign Up Form -->
            <form class="sign-up__form" id="signUpForm" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- فیلد مخفی برای رول -->
                <input type="hidden" name="role" id="roleField" value="{{ request()->query('role') }}">
                <!-- Form Title -->
                <div class="header-singup">
                    <h1 class="form__title">ثبت نام</h1>
                    <div class="mobile-sing-in-btn">
                        <span>ورود</span>
                    </div>

                </div>
                @if (request()->get('role') === 'freelancer')
                <!-- inputs Groups -->
                <div class="input__group">
                    <label class="field">
                        <input type="text" name="name" placeholder="نام و نام خانوادگی" id="signUpname">
                    </label>
                    <span class="input__icon"><i class="bx bx-user"></i></span>
                    <small class="input__error_message"></small>
                </div>

                <div class="input__group">
                    <label class="field">
                        <input type="text" name="username" placeholder="نام کاربری" id="signUpUsername">
                    </label>
                    <span class="input__icon"><i class='bx bx-user-circle'></i></span>
                    <small class="input__error_message"></small>
                </div>

                <div class="input__group">
                    <label class="field">
                        <input type="text" name="phone" placeholder="شماره موبایل" id="signUpPhoneNumber">
                    </label>
                    <span class="input__icon"><i class='bx bx-user-circle'></i></span>
                    <small class="input__error_message"></small>
                </div>

                <div class="input__group">
                    <label class="field">
                        <input type="password" name="password" placeholder="رمز عبور" id="signUpPassword" autocomplete="new-password">
                    </label>
                    <span class="input__icon"><i class="bx bx-lock"></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <div class="input__group confirm__group">
                    <label class="field">
                        <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" id="signUpConfirmPassword" autocomplete="new-password">
                    </label>
                    <span class="input__icon"><i class='bx bxs-lock'></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <button type="submit" class="submit-button" id="signUpSubmitBtn">ثبت نام</button>
                @elseif(request()->get('role') === 'employer')

                <div class="input__group">
                    <label class="field">
                        <input type="text" name="name" class="pl" placeholder="نام و نام خانوادگی رابط سازمان" id="signUpname">
                    </label>
                    <span class="input__icon"><i class="bx bx-user"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <div class="input__group">
                    <small class="info-input">*این اطلاعات برای فریلنسر نمایش داده نخواهد شد</small>
                    <label class="field">
                        <input type="text" name="phone" class="pl" placeholder="شماره موبایل رابط سازمان" id="signUpPhoneNumber">
                    </label>
                    <span class="input__icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <div class="input__group">
                    <label class="field">
                        <input type="text" name="username" placeholder="نام کاربری" id="signUpUsername">
                    </label>
                    <span class="input__icon"><i class='bx bx-user-circle'></i></span>
                    <small class="input__error_message"></small>
                </div>



                <div class="input__group">
                    <label class="field">
                        <input type="password" name="password" placeholder="رمز عبور" id="signUpPassword" autocomplete="new-password">
                    </label>
                    <span class="input__icon"><i class="bx bx-lock"></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <div class="input__group confirm__group">
                    <label class="field">
                        <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" id="signUpConfirmPassword" autocomplete="new-password">
                    </label>
                    <span class="input__icon"><i class='bx bxs-lock'></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                    <small class="input__error_message"></small>
                </div>
                <button type="submit" class="submit-button" id="signUpSubmitBtn">ثبت نام</button>

                @endif
                @if(!request()->has('role'))
                <!-- Sign Up Button -->
                <p style="color: var(--paragraph-color); font-size: 20px; padding: 20px; margin-bottom: 20px;"> اگر حساب کاربری نداری با ثبت اطلاعات فردی خود به خانواده التا بپیوندید</p>
                <div class="cta-buttons animate-on-scroll animated">
                    <a href="http://127.0.0.1:8000/elta/login?role=freelancer" class="btn-primary-custom">
                        <i class="fas fa-user-tie me-2"></i>
                        من فریلنسر هستم
                    </a>
                    <a href="http://127.0.0.1:8000/elta/login?role=employer" class="btn-secondary-custom" style="background: #a2b6da78;color: white;">
                        <i class="fas fa-building me-2"></i>
                        من کارفرما هستم
                    </a>
                </div>
                @endif
            </form>
            <!-- End Sign Up Form -->
        </div>
        <!-- End Forms Area -->

        <!-- Aside Area -->
        <div class="aside__area" id="aside_Area">
            @if (request()->get('role') === 'freelancer')
            <div class="login__aside-info">
                <h4>خوش برگشتی التایی عزیز</h4>
                <img src="{{ asset('images/login/img-sing-up.png') }}" alt="Image">
                <p>با ثبت اطلاعات فردی خود به خانواده التا بپیوندید</p>
                <button id="aside_signUp_Btn">ثبت نام</button>
            </div>
            @elseif(request()->get('role') === 'employer')
            <div class="login__aside-info">
                <h4>خوش برگشتی التایی عزیز</h4>
                <img src="{{ asset('images/login/img-sing-up.png') }}" alt="Image">
                <p>با ثبت اطلاعات سازمانی خود به خانواده التا بپیوندید</p>
                <button id="aside_signUp_Btn">ثبت نام</button>
            </div>
            @endif
            @if(!request()->has('role'))
            <div class="login__aside-info">
                <h4>خوش برگشتی التایی عزیز</h4>
                <img src="{{ asset('images/login/img-sing-up.png') }}" alt="Image">
                <p style="padding-top: 0px; margin-bottom: 0px;"> اگر حساب کاربری نداری با ثبت اطلاعات فردی خود به خانواده التا بپیوندید</p>
                <div class="cta-buttons animate-on-scroll animated">
                    <a href="{{ route('login.form', array_filter(['role' => 'freelancer','redirect' => request('redirect'),])) }}" class="btn-primary-custom"><i class="fas fa-building me-2"></i>من فریلنسر هستم</a>
                    <a href="{{ route('login.form', array_filter(['role' => 'employer','redirect' => request('redirect'),])) }}" class="btn-secondary-custom"><i class="fas fa-building me-2"></i>من کارفرما هستم</a>
                </div>
            </div>
            @endif
            <div class="sign-up__aside-info">
                <h4>خوش آمدید</h4>
                <img src="{{ asset('images/login/img-sing-in.png') }}" alt="Image">
                <p>اگر در التا حساب دارید با وارد کردن اطلاعات حساب خود وارد سایت شوید</p>
                <button id="aside_signIn_Btn">ورود</button>
            </div>
        </div>
    </div>
    <!-- End Wrapper Area -->

    <script src="./../js/login.js"></script>

    <!-- Alert System -->
    <script src="./../js/alerts.js"></script>
    <script>
        // نمایش اعلانات موجود در صفحه
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.custom-alert');
            alerts.forEach(alert => {
                alert.style.display = 'block';

                // بعد از 5 ثانیه، اعلان به تدریج ناپدید می‌شود
                setTimeout(function() {
                    alert.classList.add('fade-out');
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>

</body>

</html>