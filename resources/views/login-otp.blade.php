<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <title>Login</title>
    <link href="./../css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="./../css/login.css">

<Style>
    @media (max-width: 480px) {
        .wrapper__area {
        display: contents; /* ساختار wrapper رو حذف می‌کنه ولی بچه‌ها رو نگه می‌داره */
    }
    .aside__area {
        display: none; /* قسمت کناری رو حذف می‌کنه */
    }
}
.custom-alert {
    display: none; /* مخفی در حالت عادی */
    position: fixed;
    top: 40px;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 15px 20px;
    border-radius: 10px;
    text-align: center;
    z-index: 99999;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    font-weight: bold;
    background-color: #f44336; /* رنگ قرمز */
    color: white;
}
.custom-alert.fade-in {
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    0% {
        top: -100px; /* شروع از بالای صفحه */
    }
    100% {
        top: 40px; /* به 20px پایین‌تر می‌آید */
    }
}
.custom-alert.fade-out {
    animation: fadeOut 1s ease-out forwards;
}
</Style>
</head>
<body>
@error('otp')
    <div class="custom-alert" id="alert-message">
        <p>{{ $message }}</p>
    </div>
@enderror


<!-- Wrapper Area -->
<div class="wrapper__area" id="wrapper_Area">


    <!-- Forms Area -->
    <div class="forms__area flex justify-center items-center min-h-screen from-red-950 to-teal-700 " >
    <div class="verify-card backdrop-blur-md text-white ring-8 ring-black/5 py-24 flex flex-col gap-6 shadow-lg rounded-xl w-full max-w-lg text-center relative overflow-hidden ml-1" style="background: linear-gradient(#212529, #495057);">

        <h1 class="text-3xl font-bold tracking-wider">کد تایید را وارد کنید</h1>
        <div class="text-2xs space-y-2 *:leading-6">
        <p>کد پیامکی ارسال شده به شماره <strong>{{ session('phone', 'شماره نامشخص') }}</strong> را وارد کنید.</p>
        </div>
        <form action="{{ route('verify.code') }}" method="POST" id="otp-form" style="position: relative; top:60px;">
            @csrf
            <input type="hidden" name="otp" id="otp-value">

            <div dir="ltr" class="flex gap-2 sm:gap-4 justify-center  *:bg-black/10 *:text-white *:border *:border-white/30 *:rounded-lg *:py-1 *:px-2 *:text-xl *:max-w-10 sm:*:py-2 sm:*:px-3 sm:*:text-3xl sm:*:max-w-12 *:text-center *:transition-all *:duration-300 focus-visible:*:bg-black/90  *:outline-none *:ring-0">
                <input type="text" id="num-1" maxlength="1" data-code-input>
                <input type="text" id="num-2" maxlength="1" data-code-input>
                <input type="text" id="num-3" maxlength="1" data-code-input>
                <input type="text" id="num-4" maxlength="1" data-code-input>
            </div>


            <button type="submit" id="btn-new-code" class="w-fit mx-auto border border-white/30 bg-black/30 rounded-md py-2 px-4 uppercase font-thin transition-all duration-300 relative isolate overflow-hidden hover:text-white focus-visible:text-white outline-none ring-0 before:absolute before:-z-10 before:inset-[100%_0] before:bg-green-900 before:transition-all before:duration-300 hover:before:inset-0 focus-visible:before:inset-0" style="position: relative; top:20px;">
                تایید و ادامه      
            </button>
        </form>

    </div>
</div>

    <!-- End Forms Area -->

    <!-- Aside Area -->
    <div class="aside__area" id="aside_Area">
        <div class="login__aside-info">
            <h4>احراز هویت با شماره</h4>
            <img src="{{ asset('images/login/verify.png') }}" style="margin-top: 50px; " alt="Image">
            <p>برای امنیت بیشتر سایت احراز هویت در این مرحله با شماره صورت میگیرد.</p>
        </div>
    </div>
</div>
<!-- End Wrapper Area -->

<script>
const codeInputs = document.querySelectorAll('[data-code-input]');
const otpHiddenInput = document.getElementById('otp-value');
const otpForm = document.getElementById('otp-form');

// فقط اجازه ورود عدد
function onlyNumberKey(evt) {
    evt.target.value = evt.target.value.replace(/[^0-9]/g, '');
}

// حرکت بین اینپوت‌ها
codeInputs.forEach((input, index) => {
    input.addEventListener('input', function (e) {
        onlyNumberKey(e);
        if (this.value && index < codeInputs.length - 1) {
            codeInputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === "Backspace" && !this.value && index > 0) {
            codeInputs[index - 1].focus();
        }
    });
});

// پر کردن hidden input قبل از ارسال
otpForm.addEventListener('submit', function (e) {
    let otp = '';
    codeInputs.forEach(input => otp += input.value);
    otpHiddenInput.value = otp;
});

document.addEventListener('DOMContentLoaded', function () {
    var alertMessage = document.getElementById('alert-message');

    if (alertMessage) {
        // نمایش پیام خطا با انیمیشن fade-in و حرکت از بالا به پایین
        alertMessage.style.display = 'block';
        alertMessage.classList.add('fade-in');

        // بعد از 5 ثانیه، پیام خطا به تدریج ناپدید می‌شود
        setTimeout(function () {
            alertMessage.classList.remove('fade-in');
            alertMessage.classList.add('fade-out');

            // پس از اتمام انیمیشن fade-out، پیام به طور کامل پنهان می‌شود
            // زمان انیمیشن fade-out
        }, 3000); // 5000 میلی‌ثانیه = 5 ثانیه
    }
});
</script>

</body>
</html>
