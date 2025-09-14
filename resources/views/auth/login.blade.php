<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود با OTP</title>
</head>
<body>
@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

<h2>ارسال کد تایید</h2>
<form action="{{ route('otp.send') }}" method="POST">
    @csrf
    <input type="tel" name="phone" placeholder="شماره موبایل" required autocomplete="tel">
    <button type="submit">ارسال کد</button>
</form>

<h2>تایید کد</h2>
<form action="{{ route('otp.verify') }}" method="POST">
    @csrf
    <input type="tel" name="phone" placeholder="شماره موبایل" required autocomplete="tel">
    <input type="number" name="code" placeholder="کد تایید" required autocomplete="one-time-code">
    <button type="submit">ورود</button>
</form>
</body>
</html>
