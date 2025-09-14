<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="./../css/login.css">
</head>
<body>
@if ($errors->any())
    <div class="custom-alert" id="alert-message">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- Wrapper Area -->
<div class="wrapper__area" id="wrapper_Area">


    <!-- Forms Area -->
        <div class="forms__area">
            <!-- Login Form -->
            <form class="login__form" id="loginForm"  method="POST" action="{{ route('login') }}">
                    @csrf      
                    <!-- Form Title -->
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
                        <label for="checkboxInput" class="remeber_me">
                            <span>منو به خاطر بسپار</span>
                            <input type="checkbox" id="checkboxInput" name="remember">
                            <span class="checkmark"></span>
                        </label>                    

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

                <!-- Sign Up Button -->
                <button type="submit" class="submit-button" id="signUpSubmitBtn">ثبت نام</button>

            </form> 
            <!-- End Sign Up Form -->
        </div>
    <!-- End Forms Area -->

    <!-- Aside Area --> 
    <div class="aside__area" id="aside_Area">
        <div class="login__aside-info">
            <h4>خوش برگشتی التایی عزیز</h4>
            <img src="{{ asset('images/login/img-sing-up.png') }}" alt="Image">
            <p>با ثبت اطلاعات فردی خود به خانواده التا بپیوندید</p>
            <button id="aside_signUp_Btn">ثبت نام</button>
        </div>
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

</body>
</html>
