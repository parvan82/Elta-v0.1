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
            <form class="login__form" id="loginForm" method="POST" action="{{ route('ConfirmResetPassword') }}">
    @csrf
    <!-- Form Title -->
    <div class="header-singIn">
        <h1 class="form__title">تغییر رمز عبور</h1>
    </div>

    <!-- inputs Groups -->
    <div class="input__group">
        <label class="field">
            <input type="password" name="oldPassword" placeholder="رمز عبور قبلی" id="oldPassword" autocomplete="current-password">
        </label>
        <span class="input__icon"><i class="bx bx-lock"></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="input__error_message"></small>
    </div>

    <div class="input__group">
        <label class="field">
            <input type="password" name="newPassword" placeholder="رمز عبور جدید" id="newPassword" autocomplete="current-password">
        </label>
        <span class="input__icon"><i class="bx bx-lock"></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="input__error_message"></small>
    </div>

    <div class="input__group confirm__group">
        <label class="field">
            <input type="password" name="newPassword_confirmation" placeholder="تکرار رمز عبور جدید" id="ConfirmNewPassword" autocomplete="new-password">
        </label>
        <span class="input__icon"><i class='bx bxs-lock'></i></span>
        <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
        <small class="input__error_message"></small>
    </div>

    <!-- Hidden User ID -->
    <input type="hidden" name="user_id" value="{{ session('user_id') }}">

    <!-- Login Button -->
    <button type="submit" class="submit-button" id="loginSubmitBtn">ارسال</button>
</form>

                
            <!-- End Login Form -->

        </div>
    <!-- End Forms Area -->

    <!-- Aside Area --> 
    <div class="aside__area" id="aside_Area">
        <div class="login__aside-info">
            <h4>فراموشی رمز عبور</h4>
            <img src="{{ asset('images/login/reset-password.png') }}" alt="Image"  style="margin-top: 90px;" >
            <p> رمز عبور خود را بازیابی کنید و دوباره وارد شوید</p>
        </div>
    </div>
</div>
<!-- End Wrapper Area -->

<script>
    // گرفتن CSRF Token
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// عناصر فرم
const resetForm = document.querySelector('#loginForm');
const oldPassword = document.querySelector('#oldPassword');
const newPassword = document.querySelector('#newPassword');
const confirmNewPassword = document.querySelector('#ConfirmNewPassword');

// آیکون نمایش/مخفی کردن پسورد
const showHidePassDom = Array.from(document.querySelectorAll('.showHide__Icon i'));

// الگوها
const patterns = {
    "oldPassword": /^.{6,}$/,   // حداقل ۶ کاراکتر
    "newPassword": /^.{6,}$/,   // حداقل ۶ کاراکتر
};

// ارسال فرم
resetForm.addEventListener('submit', function (e) {
    e.preventDefault();
    if (resetFormValidation()) {
        resetForm.submit();
    }
});

// نمایش/مخفی‌کردن پسورد
showHidePassDom.forEach(icon => {
    icon.addEventListener('click', () => {
        const targetInput = icon.closest('.input__group').querySelector('.field input');
        if (icon.className.includes('bx-hide')) {
            icon.className = 'bx bx-show';
            targetInput.setAttribute('type', 'text');
        } else {
            icon.className = 'bx bx-hide';
            targetInput.setAttribute('type', 'password');
        }
    });
});

// اعتبارسنجی فرم
function resetFormValidation() {
    let isValid = true;

    // رمز قدیمی
    if (!oldPassword.value.trim()) {
        setErrorFor(oldPassword, 'رمز عبور قبلی الزامی است.');
        isValid = false;
    } else if (!patterns.oldPassword.test(oldPassword.value.trim())) {
        setErrorFor(oldPassword, 'رمز عبور قبلی نامعتبر است.');
        isValid = false;
    } else {
        setSuccessFor(oldPassword);
    }

    // رمز جدید
    if (!newPassword.value.trim()) {
        setErrorFor(newPassword, 'رمز عبور جدید الزامی است.');
        isValid = false;
    } else if (!patterns.newPassword.test(newPassword.value.trim())) {
        setErrorFor(newPassword, 'رمز عبور جدید باید حداقل ۶ کاراکتر باشد.');
        isValid = false;
    } else {
        setSuccessFor(newPassword);
    }

    // تکرار رمز جدید
    if (!confirmNewPassword.value.trim()) {
        setErrorFor(confirmNewPassword, 'تکرار رمز عبور جدید الزامی است.');
        isValid = false;
    } else if (newPassword.value.trim() !== confirmNewPassword.value.trim()) {
        setErrorFor(confirmNewPassword, 'رمز عبور و تکرار آن یکسان نیست.');
        isValid = false;
    } else {
        setSuccessFor(confirmNewPassword);
    }

    return isValid;
}

// مدیریت خطا/موفقیت
function setErrorFor(input, msg) {
    const parent = input.closest('.input__group');
    parent.classList.add('formError');
    parent.classList.remove('formSuccess');
    parent.querySelector('.input__error_message').innerHTML = msg;
}
function setSuccessFor(input) {
    const parent = input.closest('.input__group');
    parent.classList.remove('formError');
    parent.classList.add('formSuccess');
    parent.querySelector('.input__error_message').innerHTML = '';
}

// نمایش پیام خطا (مثل لاراول)
document.addEventListener('DOMContentLoaded', function () {
    var alertMessage = document.getElementById('alert-message');

    if (alertMessage) {
        alertMessage.style.display = 'block';
        alertMessage.classList.add('fade-in');

        setTimeout(function () {
            alertMessage.classList.remove('fade-in');
            alertMessage.classList.add('fade-out');
        }, 3000);
    }
});

</script>

</body>
</html>
