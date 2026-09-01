<!-- resources/views/search.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/welcome/logo.jpg">
    <title>home</title>
    <!-- Font Awesome CDN -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../../css/content.css">
    <style>
        
.elta-filter-bar {
    background: rgba(26, 31, 36, 0.35);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(0, 0, 0, 0.6);
    border-radius: 12px;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    color: #fff;
    overflow: hidden;
}

.elta-filter-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    cursor: pointer;
    user-select: none;
}

.elta-filter-title {
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.elta-filter-chevron {
    transition: transform 0.25s ease;
    font-size: 13px;
    opacity: 0.75;
}

.elta-filter-chevron.rotated {
    transform: rotate(180deg);
}

.elta-filter-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    padding: 0 16px;
}

.elta-filter-group {
    padding: 4px 0 14px;
}

.elta-filter-label {
    display: block;
    font-size: 12px;
    opacity: 0.6;
    margin-bottom: 8px;
}

.elta-filter-empty {
    text-align: center;
    opacity: 0.6;
    padding: 24px 0;
    font-size: 14px;
}

.elta-filter-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.elta-pill {
    /* ریست کامل استایل پیش‌فرض دکمه */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    outline: none;
    font: inherit;
    line-height: 1;
    -webkit-tap-highlight-color: transparent;

    border: 1px solid rgba(255, 255, 255, 0.15);
    background: rgba(255, 255, 255, 0.05);
    color: #d8d8d8;
    font-size: 12.5px;
    font-weight: 500;
    padding: 7px 16px;
    border-radius: 20px;
    cursor: pointer;
    transition: background 0.18s ease, border-color 0.18s ease,
                color 0.18s ease, transform 0.12s ease, box-shadow 0.18s ease;
}

.elta-pill:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
    color: #fff;
}

.elta-pill:active {
    transform: scale(0.95);
}

.elta-pill:focus {
    outline: none;
    box-shadow: none;
}

.elta-pill:focus-visible {
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.35);
}

.elta-pill.active {
    background: #fff;
    color: #1a1f24;
    border-color: #fff;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(255, 255, 255, 0.15);
}

.elta-pill-tag[data-filter-value="فوری"].active {
    background: #ff5757;
    border-color: #ff5757;
    color: #fff;
    box-shadow: 0 2px 10px rgba(255, 87, 87, 0.35);
}

.elta-pill-tag[data-filter-value="مدیر پروژه"].active {
    background: #4d8cff;
    border-color: #4d8cff;
    color: #fff;
    box-shadow: 0 2px 10px rgba(77, 140, 255, 0.35);
}

.elta-pill-tag[data-filter-value="تخصصی"].active {
    background: #38c172;
    border-color: #38c172;
    color: #fff;
    box-shadow: 0 2px 10px rgba(56, 193, 114, 0.35);
}

.elta-pill-tag[data-filter-value="متمایز"].active {
    background: #ffb020;
    border-color: #ffb020;
    color: #1a1f24;
    box-shadow: 0 2px 10px rgba(255, 176, 32, 0.35);
}
.elta-filter-reset {
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin: 4px 0 14px;
    padding: 7px 16px;

    font: inherit;
    font-size: 12.5px;
    font-weight: 600;

    color: #ff8080;
    background: rgba(255, 87, 87, 0.08);
    border: 1px solid rgba(255, 87, 87, 0.35);
    border-radius: 20px;

    cursor: pointer;
    transition: background 0.18s ease, border-color 0.18s ease,
                color 0.18s ease, transform 0.12s ease, box-shadow 0.18s ease;
}

.elta-filter-reset i {
    font-size: 13px;
    transition: transform 0.3s ease;
}

.elta-filter-reset:hover {
    background: rgba(255, 87, 87, 0.16);
    border-color: #ff5757;
    color: #ffb0b0;
    box-shadow: 0 2px 10px rgba(255, 87, 87, 0.25);
}

.elta-filter-reset:hover i {
    transform: rotate(-75deg);
}

.elta-filter-reset:active {
    transform: scale(0.95);
}

.elta-filter-reset:focus {
    outline: none;
}

.elta-filter-reset:focus-visible {
    box-shadow: 0 0 0 2px rgba(255, 128, 128, 0.4);
}

@media (max-width: 767px) {
    .elta-filter-bar {
        margin-top: 10px;
    }
}

    </style>
</head>

<body>
    <header>
        <section class="nav-head">
            <div class="header2">
                <div id="sidebar" class="sidebar">
                    @php
                    $user = auth()->user();
                    @endphp
                    @if ($user && $user->role === 'freelancer')
                    <div class="sidebar-header">
                        <div class="header-btn">
                            <button id="close-sidebar" class="closeBtn"><i class="bi bi-x"></i></button>
                            <a href="{{ route('freelancerProfile') }}?popup=open"><button class="editBtn"><svg height="1em" viewBox="0 0 512 512">
                                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                    </svg></button></a>
                        </div>

                        <div class="user-info">
                            <p class="name">{{ Auth::user()->name}}</p>
                            <p class="career">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                            <p class="username-title">{{ Auth::user()->username}}</p>
                        </div>
                        <div class="profile-picture">
                            <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
                        </div>
                    </div>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <button>
                                    @php
                                    $user = auth()->user();
                                    @endphp

                                    @if ($user->role === 'freelancer')
                                    <a href="{{ route('freelancerProfile') }}"><span>پروفایل</span></a>
                                    @elseif ($user->role === 'employer')
                                    <a href="{{ route('employerProfile') }}"><span>پروفایل</span></a>
                                    @endif
                                </button>
                            </li>
                            <li><button><a href="{{ url(config('chatify.routes.prefix')) }}"><span>پیام ها</span></a>
                                    <div class="notification-badge freelancer"></div>
                                </button></li>
                            <li><button><a href="{{ route('mobile.profile', ['id' => auth()->user()->id]) }}"><span>رزومه</span></a> </button></li>
                            <li><button><a href="{{ route('EltaCard') }}"><span>التا کارت</span></a></button></li>
                            <li><button><a href="#"><span>کیف پول</span></a> </button></li>
                        </ul>
                    </div>
                    <div class="sidebar-footer">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button class="Btn">
                                <div class="logout"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="text" id="logout-btn">خروج</div>
                            </button>
                        </form>
                        <button class="Btn">
                            <div class="support"><i class="fa-solid fa-headset "></i></div>
                            <div class="text" id="support-btn">پشتیبانی</div>
                        </button>
                    </div>
                    @else
                    <div class="sidebar-header">
                        <div class="header-btn">
                            <button id="close-sidebar" class="closeBtn"><i class="bi bi-x"></i></button>
                            <a href="{{ route('employerProfile') }}?popup=open"><button class="editBtn"><svg height="1em" viewBox="0 0 512 512">
                                        <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                    </svg></button></a>
                        </div>

                        <div class="user-info">
                            <p class="name">{{ Auth::user()->name}}</p>
                            <p class="career">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                            <p class="username-title">{{ Auth::user()->username}}</p>

                        </div>
                        <div class="profile-picture">
                            <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
                        </div>
                    </div>
                    <div class="sidebar-content">
                        <ul>
                            <li><button><a href="{{route('newProject')}}"><span>ثبت پروژه</span></a> </button></li>
                            <li><button>@php
                                    $user = auth()->user();
                                    @endphp

                                    @if ($user->role === 'freelancer')
                                    <a href="{{ route('freelancerProfile') }}"><span>پروفایل</span></a>
                                    @elseif ($user->role === 'employer')
                                    <a href="{{ route('employerProfile') }}"><span>پروفایل</span></a>
                                    @endif
                                </button>
                            </li>
                            <li><button><a href="{{ url(config('chatify.routes.prefix')) }}"><span>پیام ها</span></a>
                                    <div class="notification-badge"></div>
                                </button></li>
                            <li><button><a href="{{ route('EltaCard') }}"><span>التا کارت</span></a></button></li>
                            <li><button><a href="#"><span>کیف پول</span></a></button></li>
                        </ul>
                    </div>
                    <div class="sidebar-footer">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button class="Btn">
                                <div class="logout"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="text" id="logout-btn">خروج</div>
                            </button>
                        </form>
                        <button class="Btn">
                            <div class="support"><i class="fa-solid fa-headset "></i></div>
                            <div class="text" id="support-btn">پشتیبانی</div>
                        </button>
                    </div>
                    @endif
                </div>
                <!-- Main Content -->
                <div class="main-content">
                    <div class="left-buttons">
                        <button id="open-sidebar" class="open-btn">☰</button>
                        @php
                        $user = auth()->user();
                        @endphp

                        @if ($user->role === 'freelancer')
                        <a href="{{route('freelancerHome')}}" class="open-btn"><i class="fas fa-home"></i></a>
                        @elseif ($user->role === 'employer')
                        <a href="{{route('employerHome')}}" class="open-btn"><i class="fas fa-home"></i></a>
                        @endif
                        <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i><span class="notification-bell-badge" style="left: 154px;"></span></a>
                    </div>
                    <div class="site-name">
                        <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
                    </div>
                </div>

            </div>

        </section>

    </header>
    <main class="main-container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('user.search.employer') }}" method="GET">
                        <div class="search2" dir="rtl">
                            <div class="search-box" style="box-shadow: 0 0 20px #444;">
                                <div class="search-field">
                                    <input
                                        type="text"
                                        name="q"
                                        class=" search-input-popup-w "
                                        placeholder="جستجو..."
                                        value="{{ old('q', $query ?? '') }}"
                                    > 
                                    <div class="search-box-icon">
                                        <button class="btn-icon-content" type="submit">
                                            <i class="search-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                                                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" fill="#fff"></path>
                                                </svg>
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            
            @if($results->isEmpty())
            <div class="col-12 mt-4">
                <div class="eltaCard" style="box-shadow: 0 0 20px #555; ">
                    <div class="search-elta-card pt-5 d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                        <img src="{{ asset('images/search/not-result.png') }}" alt="" style="width: 200px; height: 200px;">
                        <h4 class="text-center mt-4">پروژه یا سازمانی برای جستجوی شما پیدا نشد</h4>
                        <p class="text-center mt-2">نگارش کلید واژه های خود را بررسی کنید</p>
                        <p class="text-center  mt-2">کلید واژه دیگری وارد کنید</p>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 pt-3 pr-2" id="left-card">
                <div class="left-card">
                    @if ($clickedUser)
                    <div class="left-card-top" style="min-height: 230px;">
                        <div class="select-search-image-container">
                            <img src="{{ $clickedUser->profilepic ? asset('storage/' . $clickedUser->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
                        </div>
                        <div class="select-search-card-tags">
                            <h6 class="username-search-card">{{ $clickedUser->username }}</h6>
                            <h6 class="tags">gold</h6>
                        </div>
                        <div class="select-share">
                            <div class="tooltip-container">
                                <div class="button-content">
                                    <svg class="share-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                                        <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path>
                                    </svg>
                                </div>
                                <div class="tooltip-content">
                                    <div class="social-icons">
                                        <a href="#" class="social-icon telegram">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                <path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="social-icon whatsapp">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="social-icon linkedin">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="social-icon copy">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z" />
                                            </svg> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-info-container">
                            <h4 class="select-search-name">{{ $clickedUser->companies->company_name}}</h4>
                            <h6 class="select-search-scope-work">{{ $clickedUser->workarea }}</h6>
                            <p class="select-search-about-me">{{ $clickedUser->aboutme }}</p>
                        </div>
                        @if(empty($clickedproject))

                        <a href="{{ url('chatify/' . $clickedUser->id) }}">
                            <button id="btn-message" class="button-message">
                                <div class="content-avatar">
                                    <div class="status-user"></div>
                                    <div class="avatar">
                                        <img class="user-img" src="{{ $clickedUser->profilepic ? asset('storage/' . $clickedUser->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture" />
                                    </div>
                                </div>
                                <div class="notice-content">
                                    <div class="username">{{ $clickedUser->name ?? 'نام کاربر' }}</div>
                                    <div class="lable-message"> ارسال پیام</div>
                                    <div class="user-id">@ {{ $clickedUser->username }}</div>
                                </div>
                            </button>
                        </a>
                        @endif
                        <a href="{{ route('mobile.profile', ['id' => $clickedUser->id]) }}" style="text-decoration: none;">
                            <button class='profile-btn'>
                                <span class="box">
                                    مشاهده پروفایل
                                </span>
                            </button>
                        </a>
                    </div>

                    <div class="Statistics-card-container">

                        <div class="card success">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5,-37.9C26.5,-32,31.4,-26.5,40.2,-20.2C49,-13.9,61.9,-7,63,0.6C64.1,8.2,53.4,16.5,43,20C32.6,23.5,22.4,22.3,15.3,26.4C8.1,30.4,4.1,39.7,-2.8,44.6C-9.8,49.5,-19.5,50.1,-31.5,48.9C-43.5,47.7,-57.8,44.6,-60.7,36.2C-63.7,27.7,-55.3,13.9,-44.2,6.4C-33.1,-1,-19.2,-2.1,-14.2,-7C-9.2,-11.9,-13.1,-20.7,-12.3,-29.6C-11.4,-38.4,-5.7,-47.3,0.8,-48.7C7.2,-50,14.5,-43.8,20.5,-37.9Z" transform="translate(100 100)" />
                            </svg>
                            <div class="card-content">
                                <span>{{ $clickedUser->companies->established_year }}</span>
                                <p>سال تاسیس</p>
                            </div>
                        </div>

                        <!-- کارت ۲ -->
                        <div class="card open">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32,-49.6C41.1,-50.3,47.7,-40.8,55.1,-30.8C62.5,-20.9,70.8,-10.4,65.7,-3C60.5,4.5,42,9,35.3,20.3C28.6,31.5,33.8,49.6,29.9,52.9C26,56.3,13,45,-0.7,46.3C-14.4,47.5,-28.9,61.3,-38.4,61.1C-48,61,-52.6,47,-49.6,34.5C-46.6,22,-36,11,-35,0.6C-34,-9.9,-42.6,-19.7,-43.4,-28.4C-44.1,-37,-37,-44.4,-28.5,-44.1C-20,-43.8,-10,-35.7,0.8,-37C11.5,-38.3,23,-49,32,-49.6Z" transform="translate(100 100)" />
                            </svg>
                            <div class="card-content">
                                <span class="small">{{ $clickedUser->companies->company_type }}</span>
                                <p>شرکت</p>
                            </div>
                        </div>

                        <!-- کارت ۳ -->
                        <div class="card History">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.7,-37.5C31.1,-36.8,37.9,-31.3,39.7,-24.2C41.4,-17.2,38.1,-8.6,42.9,2.7C47.6,14.1,60.3,28.1,58.4,34.9C56.6,41.8,40.1,41.4,28,43.9C15.8,46.4,7.9,51.7,-0.1,51.9C-8.1,52,-16.1,47,-21.8,40.7C-27.5,34.5,-30.8,27.1,-31.6,20.1C-32.5,13.1,-30.9,6.6,-32,-0.6C-33.1,-7.8,-36.8,-15.6,-37.9,-25.9C-38.9,-36.2,-37.3,-48.9,-30.5,-50.1C-23.7,-51.3,-11.9,-40.9,-1.9,-37.6C8.1,-34.4,16.3,-38.3,23.7,-37.5Z" transform="translate(100 100)" />
                            </svg>
                            <div class="card-content">
                                <span>3</span>
                                <p>سال سابقه در التا</p>
                            </div>
                        </div>

                    </div>
                    <div class="left-card-bottom">

                        @if(!empty($clickedproject))
                        <div class="ad-info-container project-info-container" style="direction: rtl;">
                            <!-- عنوان پروژه -->
                            <div class="ad-header" style="position: relative; display: flex; align-items: center; justify-content: space-between;">
                                <h4 dir='rtl' class="ad-title mb-0" style="flex: 1;">
                                    <i class="fa-solid fa-briefcase" style="color: #ffd700; margin-left: 10px;"></i>
                                    {{ $clickedproject->title }}
                                </h4>
                                @if($clickedproject->user_id)
                                <a href="{{ url('chatify/' . $clickedproject->user_id . '?project_id=' . $clickedproject->id) }}"
                                    class="project-chat-btn"
                                    style="margin-right: 15px; text-decoration: none;">
                                    <button type="button" style="display: inline-flex;align-items: center;gap: 8px;padding: 10px 20px;background: linear-gradient(135deg, #27AE60, #2ECC71);color: white;border: none;border-radius: 25px;font-size: 14px;font-weight: 600;cursor: pointer;transition: all 0.3s ease;box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(39, 174, 96, 0.4)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(39, 174, 96, 0.3)';">
                                        <i class="fa-solid fa-comments" style="font-size: 16px;"></i>
                                        <span style="white-space: nowrap;">ارسال پیشنهاد</span>
                                    </button>
                                </a>
                                @endif
                            </div>
                            <hr class="section-divider">

                            <div class="ad-details project-details-grid">
                                <div class="info-item">
                                    <div class="info-icon service-icon"><i class="fa-solid fa-file-export"></i></div>
                                    <div class="info-content">
                                        <h6 class="info-label">سرویس مورد نیاز</h6>
                                        <p class="info-value">{{ $clickedproject->service ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon price-icon"><i class="fa-solid fa-wallet"></i></div>
                                    <div class="info-content">
                                        <h6 class="info-label">بودجه</h6>
                                        <p class="info-value price-value">{{ $clickedproject->budget ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fa-solid fa-list-check"></i></div>
                                    <div class="info-content">
                                        <h6 class="info-label">اولویت‌ها</h6>
                                        <p class="info-value">{{ $clickedproject->priority ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($clickedproject->services) && count($clickedproject->services))
                            <div class="tags-section mt-4">
                                <h6 class="section-title mb-3">
                                    <i class="fa-solid fa-tags" style="color: #ffd700; margin-left: 8px;"></i>
                                    برچسب‌ها و ویژگی‌ها
                                </h6>
                                <div class="tags-container">
                                    @foreach($clickedproject->services as $tag)
                                    @php
                                    $tagClass = match($tag) {
                                    'تخصصی' => 'takhasosi',
                                    'فوری' => 'fori',
                                    'مدیر پروژه' => 'modir-proje',
                                    'متمایز' => 'motamayez',
                                    default => '',
                                    };
                                    @endphp
                                    <h6 class="services-tags {{ $tagClass }} mx-1">{{ $tag }}</h6>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <hr class="section-divider">

                            <div class="px-3" style="direction: rtl;">
                                <h5 class="font-weight-bold mb-3">مهارت‌ها</h5>
                                <div class="d-flex mt-2" style="direction: rtl; gap:10px; flex-wrap: wrap;">
                                    @forelse($clickedproject->skills as $skill)
                                    <div class="language-tag">
                                        <span>{{ $skill->skill }}</span>
                                    </div>
                                    @empty
                                    <p>ثبت نشده</p>
                                    @endforelse
                                </div>
                            </div>

                            <hr class="section-divider">

                            <div class="description-section">
                                <h5 class="section-title">
                                    <i class="fa-solid fa-file-lines" style="color: #ffd700; margin-left: 10px;"></i>
                                    توضیحات آگهی
                                </h5>
                                <div class="description-content" id="aboutText">
                                    <p>{{ $clickedproject->description ?? 'توضیحاتی ثبت نشده است.' }}</p>
                                </div>
                                <label class="container-more mb-3" id="toggleAbout">
                                    <input type="checkbox" id="aboutToggleCheck">
                                    <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="chevron-down">
                                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <hr class="section-divider">
                        <h5 class="section-title mb-5 mr-4" dir="rtl">
                            پروژه های مشابه
                        </h5>
                        <div class="similar-project-container px-3">
                            @foreach($similarProjects as $item)

                            @if($item->type === 'project' && isset($item->id) && isset($item->user->id))

                            @php
                            // بررسی تگ متمایز
                            $hasDistinguishedTag = collect($item->services ?? [])
                            ->contains(fn($tag) => $tag === 'متمایز');

                            // ترتیب نمایش تگ‌ها
                            $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
                            $sortedTags = collect($item->services ?? [])
                            ->sortBy(fn($tag) => array_search($tag, $tagOrder))
                            ->values();

                            // لینک‌ها
                            $defaultUrl = url()->current()
                            . '?q=' . urlencode($query)
                            . '&clickedUserId=' . $item->user->id
                            . '&projectId=' . $item->id;

                            $mobileUrl = url('/content?type=project&id=' . $item->id);
                            @endphp

                            <a class="user-card-link" href="{{ $defaultUrl }}" data-default-url="{{ $defaultUrl }}" data-mobile-url="{{ $mobileUrl }}" style="text-decoration:none; color:inherit;">

                                <div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }}">

                                    {{-- هدر کارت --}}
                                    <div class="project-card-header">
                                        <div style="display: flex; align-items: center; gap: 10px; direction: rtl;">
                                            <div class="project-card-avatar">
                                                <img src="{{ asset('storage/' . ($item->user->profilepic ?? 'images/default.jpg')) }}" alt="Profile">
                                            </div>
                                            @if($hasDistinguishedTag)
                                            <span class="project-card-status" style="background: rgba(243, 156, 18, 0.2); color: #f39c12;">متمایز</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- تگ‌های سرویس --}}
                                    <div class="project-card-tags dynamic-tag-box">
                                        @foreach($sortedTags as $tag)
                                        @php
                                        $tagClass = match($tag) {
                                        'تخصصی' => 'takhasosi',
                                        'فوری' => 'fori',
                                        'مدیر پروژه' => 'modir-proje',
                                        'متمایز' => 'motamayez',
                                        default => '',
                                        };
                                        @endphp
                                        <span class="project-card-tag {{ $tagClass }}">{{ $tag }}</span>
                                        @endforeach
                                    </div>

                                    {{-- عنوان پروژه --}}
                                    <h3 class="project-card-title">{{ $item->title }}</h3>

                                    {{-- بودجه --}}
                                    <div class="project-card-budget">{{ $item->budget }}</div>

                                    {{-- توضیحات --}}
                                    <p class="project-card-description">{{ $item->description ?? 'توضیحاتی ثبت نشده است.' }}</p>

                                    {{-- اولویت --}}
                                    @if($item->priority)
                                    <div class="project-card-priority">
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span>{{ $item->priority }}</span>
                                    </div>
                                    @endif

                                    {{-- مهارت‌ها --}}
                                    <div class="project-card-skills dynamic-skill-box">
                                        @foreach ($item->skills ?? [] as $skill)
                                        <span class="project-skill-pill">{{ $skill }}</span>
                                        @endforeach
                                    </div>

                                    {{-- فوتر کارت --}}
                                    <div class="project-card-footer">
                                        <div class="project-card-footer-left">
                                            <span style="font-size: 12px; color: #888;">پروژه</span>
                                        </div>
                                        <div class="project-card-footer-right">
                                            <div class="add-contact project-card-favorite" data-user-id="{{ $item->user->id }}">
                                                @if ($item->is_favorite)
                                                <i class="fa-solid fa-user-check icon-anim"></i>
                                                @else
                                                <i class="fa-solid fa-user-plus icon-anim"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            @endif

                            @endforeach

                        </div>
                        @endif

                        @if(!empty($clickedUser) && empty($clickedproject))
                        <div class="ad-info-container user-info-container" style="direction: rtl;">
                            <!-- اطلاعات کاربر مانند قبل -->
                            <div class="ad-header">
                                <h4 dir='rtl' class="ad-title mb-0">
                                    <i class="fa-solid fa-user" style="color: #ffd700; margin-left: 10px;"></i>
                                    {{ $clickedUser->name }}
                                </h4>
                            </div>
                            <hr class="section-divider">

                            <div class="ad-details user-details-grid">
                                <div class="info-item">
                                    <div class="info-icon username-icon"><i class="fa-solid fa-id-badge"></i></div>
                                    <div class="info-content">
                                        <h6 class="info-label">اندازه سازمان</h6>
                                        <p class="info-value">{{ $clickedUser->companies->company_size ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon area-icon"><i class="fa-solid fa-map-marker-alt"></i></div>
                                    <div class="info-content">
                                        <h6 class="info-label">آدرس</h6>
                                        <p class="info-value">{{ $clickedUser->companies->city ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($clickedUser->skills) && count($clickedUser->skills))
                            <div class="tags-section mt-4">
                                <h6 class="section-title mb-3">
                                    <i class="fa-solid fa-tags" style="color: #ffd700; margin-left: 8px;"></i>
                                    مهارت‌های مورد نیاز سازمان
                                </h6>
                                <div class="tags-container d-flex flex-wrap" style="gap:10px;">
                                    @foreach($clickedUser->skills as $skill)
                                    <div class="language-tag">
                                        <span>{{ $skill->skill }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <hr class="section-divider">

                            <div class="description-section">
                                <h5 class="section-title">
                                    <i class="fa-solid fa-file-lines" style="color: #ffd700; margin-left: 10px;"></i>
                                    درباره {{ $clickedUser->companies->company_name ?? 'ثبت نشده' }}
                                </h5>
                                <div class="description-content" id="aboutText">
                                    <p>{{ $clickedUser->companies->company_info ?? 'توضیحاتی ثبت نشده است.' }}</p>
                                </div>
                                <label class="container-more mb-3" id="toggleAbout">
                                    <input type="checkbox" id="aboutToggleCheck">
                                    <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="chevron-down">
                                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </label>

                            </div>

                            {{-- -------------------- پروژه‌های ثبت شده توسط کارفرما -------------------- --}}
                            @php
                            $employerProjects = $clickedUser->NewProject ?? collect();
                            @endphp

                            @if($employerProjects->count())
                            <hr class="section-divider">
                            <h4 class="mb-4 text-white">
                                {{$employerProjects->count()}} پروژه ثبت شده توسط {{ $clickedUser->companies->company_name }}
                            </h4>

                            {{-- کادر با اسکرول --}}
                            <div class="employer-projects-scroll">
                                @foreach ($employerProjects as $project)
                                @php
                                $hasDistinguishedTag = collect($project->services ?? [])
                                ->contains(fn($tag) => $tag === 'متمایز');

                                $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
                                $sortedTags = collect($project->services ?? [])
                                ->sortBy(fn($tag) => array_search($tag, $tagOrder))
                                ->values();

                                $defaultUrl = url()->current() . '?q=' . urlencode($query) . '&clickedUserId=' . $project->user->id . '&projectId=' . $project->id;
                                $mobileUrl = url('/content?type=project&id=' . $project->id);
                                @endphp

                                <a class="user-card-link" href="{{ $defaultUrl }}" data-default-url="{{ $defaultUrl }}" data-mobile-url="{{ $mobileUrl }}" style="text-decoration:none; color:inherit;">
                                    <div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }}"
                                        style="margin: 10px 0; min-height: 220px;">

                                        {{-- هدر کارت --}}
                                        <div class="project-card-header">
                                            <div style="display: flex; align-items: center; gap: 10px; direction: rtl;">
                                                <div class="project-card-avatar">
                                                    <img src="{{ asset('storage/' . ($project->user->profilepic ?? 'images/default.jpg')) }}" alt="Profile">
                                                </div>
                                                @if($hasDistinguishedTag)
                                                <span class="project-card-status" style="background: rgba(243, 156, 18, 0.2); color: #f39c12;">متمایز</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- تگ‌های سرویس --}}
                                        <div class="project-card-tags dynamic-tag-box">
                                            @foreach($sortedTags as $tag)
                                            @php
                                            $tagClass = match($tag) {
                                            'تخصصی' => 'takhasosi',
                                            'فوری' => 'fori',
                                            'مدیر پروژه' => 'modir-proje',
                                            'متمایز' => 'motamayez',
                                            default => '',
                                            };
                                            @endphp
                                            <span class="project-card-tag {{ $tagClass }}">{{ $tag }}</span>
                                            @endforeach
                                        </div>

                                        {{-- عنوان پروژه --}}
                                        <h3 class="project-card-title">{{ $project->title }}</h3>

                                        {{-- بودجه --}}
                                        <div class="project-card-budget">{{ $project->budget }}</div>

                                        {{-- توضیحات --}}
                                        <p class="project-card-description">{{ $project->description ?? 'توضیحاتی ثبت نشده است.' }}</p>

                                        {{-- اولویت --}}
                                        @if($project->priority)
                                        <div class="project-card-priority">
                                            <i class="bi bi-info-circle-fill"></i>
                                            <span>{{ $project->priority }}</span>
                                        </div>
                                        @endif

                                        {{-- مهارت‌ها --}}
                                        <div class="project-card-skills dynamic-skill-box">
                                            @foreach ($project->skills ?? [] as $skill)
                                            <span class="project-skill-pill">{{ is_object($skill) ? $skill->skill : $skill }}</span>
                                            @endforeach
                                        </div>

                                        {{-- فوتر کارت --}}
                                        <div class="project-card-footer">
                                            <div class="project-card-footer-left">
                                                <span style="font-size: 12px; color: #888;">پروژه</span>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @endif

                            @if(!empty($similarEmployers) && $similarEmployers->count())
                            <hr class="section-divider">
                            <h4 class="mb-5 text-white">کارفرماهای مشابه</h4>

                            @foreach($similarEmployers as $employer)
                            @php
                            $defaultUrl = url()->current() . '?q=' . urlencode($query) . '&clickedUserId=' . $employer->id;
                            $mobileUrl = url('/content?type=employer&id=' . $employer->id);
                            @endphp

                            <a class="user-card-link" href="{{ $defaultUrl }}" data-default-url="{{ $defaultUrl }}" data-mobile-url="{{ $mobileUrl }}" style="text-decoration:none; color:inherit;">

                                <div class="eltaCard mb-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                                    <div class="search-elta-card">

                                        {{-- تصویر --}}
                                        <div class="search-image-container">
                                            <img src="{{ asset('storage/' . ($employer->profilepic ?? 'images/default.jpg')) }}" class="avatar">
                                        </div>

                                        {{-- نام کاربری --}}
                                        <div class="search-card-tags dynamic-tag-box">
                                            <h6 class="services-tags">{{ $employer->username }}</h6>
                                        </div>

                                        {{-- اطلاعات کاربر --}}
                                        <div class="search-info-container">
                                            <h4 class="search-name m-0">{{ $employer->company_name }}</h4>
                                            <h6 class="search-scope-work m-0">{{ $employer->workarea ?? 'ثبت نشده' }}</h6>
                                            <p class="search-about-me">{{ $employer->company_info ?? 'توضیحاتی ثبت نشده است.' }}</p>
                                        </div>

                                        {{-- مهارت‌ها --}}
                                        <div class="search-card-skill dynamic-skill-box" dir="rtl">
                                            @foreach ($employer->skills ?? [] as $skill)
                                            <h6 class="userSkill-search-card">{{ is_object($skill) ? $skill->skill : $skill }}</h6>
                                            @endforeach
                                        </div>

                                        {{-- علاقه‌مندی --}}
                                        <div class="add-contact" style="width: 40px;">
                                            @if (!empty($employer->is_favorite) && $employer->is_favorite)
                                            <i class="fa-solid fa-user-check icon-anim"></i>
                                            @else
                                            <i class="fa-solid fa-user-plus icon-anim"></i>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </a>
                            @endforeach
                            @endif


                        </div>
                        @endif

                    </div>


                    @else
                    <div class="left-card-top d-flex flex-column align-items-center justify-content-start" style="min-height: 100%; padding-top: 20px;">
                        <img src="{{ asset('images/search/result.png') }}" alt="" style="width: 300px; height: 300px;">
                        <h5 class="text-center mt-5">برای مشاهده پروژه یا سازمان ، روی یکی از کارت‌ها کلیک کنید</h5>
                    </div>
                    @endif
                </div>
            </div>

<div class="col-md-6 pl-2" id="right-card">
        <div class="d-flex col-md-12" style="direction:rtl; color:white; box-sizing: border-box; background: rgba(26, 31, 36, 0.35); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(0, 0, 0, 0.6); border-radius: 12px; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2); margin-top: 16px; padding: 16px 16px 0px 16px;">
            @if (!empty($query))
            <p>
                <b>{{ $results->count() }}</b>
                نتیجه برای {{ $query }}
            </p>
            @endif
        </div>


<div class="elta-filter-bar" id="eltaFilterBar" dir="rtl">
    <div class="elta-filter-header" id="eltaFilterToggle">
        <span class="elta-filter-title">
            <i class="bi bi-sliders"></i>
            فیلترها
        </span>
        <i class="bi bi-chevron-down elta-filter-chevron" id="eltaFilterChevron"></i>
    </div>

    <div class="elta-filter-body" id="eltaFilterBody">

        {{-- نوع --}}
        <div class="elta-filter-group">
            <span class="elta-filter-label">نوع</span>
            <div class="elta-filter-pills" data-filter-group="type">
                <button type="button" class="elta-pill active" data-filter-value="all">همه</button>
                <button type="button" class="elta-pill" data-filter-value="project">پروژه</button>
                <button type="button" class="elta-pill" data-filter-value="user">کارفرما</button>
            </div>
        </div>

        {{-- تگ‌ها --}}
        <div class="elta-filter-group">
            <span class="elta-filter-label">تگ‌ها</span>
            <div class="elta-filter-pills" data-filter-group="tags">
                <button type="button" class="elta-pill elta-pill-tag" data-filter-value="فوری">فوری</button>
                <button type="button" class="elta-pill elta-pill-tag" data-filter-value="مدیر پروژه">مدیر پروژه</button>
                <button type="button" class="elta-pill elta-pill-tag" data-filter-value="تخصصی">تخصصی</button>
                <button type="button" class="elta-pill elta-pill-tag" data-filter-value="متمایز">متمایز</button>
            </div>
        </div>

        <button type="button" class="elta-filter-reset" id="eltaFilterReset">
            <i class="bi bi-arrow-counterclockwise"></i>
            پاک‌کردن فیلترها
        </button>
    </div>
</div>

    <div>
        @foreach ($results as $item)

        {{-- ================= پروژه ================= --}}
        @if($item->type === 'project' && isset($item->id) && isset($item->user->id))

        @php
        $hasDistinguishedTag = collect($item->services ?? [])
        ->contains(fn($tag) => $tag === 'متمایز');

        $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
        $sortedTags = collect($item->services ?? [])
        ->sortBy(fn($tag) => array_search($tag, $tagOrder))
        ->values();

        $defaultUrl = url()->current() . '?q=' . urlencode($query) . '&clickedUserId=' . $item->user->id . '&projectId=' . $item->id;
        $mobileUrl = url('/content?type=project&id=' . $item->id);
        @endphp

        <a class="user-card-link"
           href="{{ $defaultUrl }}"
           data-default-url="{{ $defaultUrl }}"
           data-mobile-url="{{ $mobileUrl }}"
           data-item-type="project"
           data-item-tags="{{ collect($item->services ?? [])->implode(',') }}"
           style="text-decoration:none; color:inherit;">

            <div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }}">

                {{-- هدر کارت --}}
                <div class="project-card-header">
                    <div class="project-card-avatar">
                        <img src="{{ asset('storage/' . ($item->user->profilepic ?? 'images/default.jpg')) }}" alt="Profile">
                    </div>
                </div>

                {{-- تگ‌های سرویس --}}
                <div class="project-card-tags dynamic-tag-box">
                    @foreach($sortedTags as $tag)
                    @php
                    $tagClass = match($tag) {
                    'تخصصی' => 'takhasosi',
                    'فوری' => 'fori',
                    'مدیر پروژه' => 'modir-proje',
                    'متمایز' => 'motamayez',
                    default => '',
                    };
                    @endphp
                    <span class="project-card-tag {{ $tagClass }}">{{ $tag }}</span>
                    @endforeach
                </div>

                {{-- عنوان پروژه --}}
                <h3 class="project-card-title">{{ $item->title }}</h3>

                {{-- بودجه --}}
                <div class="project-card-budget">{{ $item->budget }}</div>

                {{-- توضیحات --}}
                <p class="project-card-description">{{ $item->description ?? 'توضیحاتی ثبت نشده است.' }}</p>

                {{-- اولویت --}}
                @if($item->priority)
                <div class="project-card-priority">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>{{ $item->priority }}</span>
                </div>
                @endif

                {{-- مهارت‌ها --}}
                <div class="project-card-skills dynamic-skill-box">
                    @foreach ($item->skills ?? [] as $skill)
                    <span class="project-skill-pill">{{ $skill }}</span>
                    @endforeach
                </div>


                <div class="add-contact project-card-favorite" data-user-id="{{ $item->user->id }}">
                    @if ($item->is_favorite)
                    <i class="fa-solid fa-user-check icon-anim"></i>
                    @else
                    <i class="fa-solid fa-user-plus icon-anim"></i>
                    @endif
                </div>

            </div>
        </a>
        @endif

        {{-- ================= کارفرما ================= --}}
        @if($item->type === 'user' && isset($item->id))

        @php
        $defaultUrl = url()->current() . '?q=' . urlencode($query) . '&clickedUserId=' . $item->id;
        $mobileUrl = url('/profile/' . $item->id);
        @endphp

        <a class="user-card-link"
           href="{{ $defaultUrl }}"
           data-default-url="{{ $defaultUrl }}"
           data-mobile-url="{{ $mobileUrl }}"
           data-item-type="user"
           data-item-tags=""
           style="text-decoration:none; color:inherit;">

            <div class="eltaCard mb-5"
                style="box-shadow: 0 0 20px #444; cursor: pointer; margin-top:70px;">

                <div class="search-elta-card">

                    {{-- تصویر --}}
                    <div class="search-image-container">
                        <img src="{{ asset('storage/' . ($item->profilepic ?? 'images/default.jpg')) }}" class="avatar">
                    </div>

                    {{-- نام کاربری --}}
                    <div class="search-card-tags dynamic-tag-box">
                        <h6 class="services-tags">{{ $item->username }}</h6>
                    </div>

                    {{-- اطلاعات کاربر --}}
                    <div class="search-info-container">
                        <h4 class="search-name m-0">{{ $item->company_name }}</h4>
                        <h6 class="search-scope-work m-0">{{ $item->workarea }}</h6>
                        <p class="search-about-me">{{ $item->company_info ?? 'توضیحاتی ثبت نشده است.' }}</p>
                    </div>

                    {{-- مهارت‌ها --}}
                    <div class="search-card-skill dynamic-skill-box" dir="rtl">
                        @foreach ($item->skills ?? [] as $skill)
                        <h6 class="userSkill-search-card">{{ $skill }}</h6>
                        @endforeach
                    </div>

                    {{-- علاقه‌مندی --}}
                    <div class="add-contact" style="width: 40px;">
                        @if ($item->is_favorite)
                        <i class="fa-solid fa-user-check icon-anim"></i>
                        @else
                        <i class="fa-solid fa-user-plus icon-anim"></i>
                        @endif
                    </div>

                </div>
            </div>
        </a>
        @endif

        @endforeach

    </div>


</div>

        </div>
        </div>
        @endif

        </div>
        </div>

    </main>




    <script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div id="overlay" class="overlay"></div>

    <script>
        
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('eltaFilterToggle');
    var body = document.getElementById('eltaFilterBody');
    var chevron = document.getElementById('eltaFilterChevron');

    function isMobile() {
        return window.innerWidth < 768;
    }

    function setOpen(open) {
        body.style.maxHeight = open ? body.scrollHeight + 'px' : '0px';
        chevron.classList.toggle('rotated', open);
    }

    setOpen(!isMobile());

    toggle.addEventListener('click', function () {
        var isOpen = body.style.maxHeight !== '0px' && body.style.maxHeight !== '';
        setOpen(!isOpen);
    });

    var activeType = 'all';
    var activeTags = new Set();

    var cards = document.querySelectorAll('.user-card-link');
    var typeButtons = document.querySelectorAll('[data-filter-group="type"] .elta-pill');
    var tagButtons = document.querySelectorAll('[data-filter-group="tags"] .elta-pill-tag');
    var resetBtn = document.getElementById('eltaFilterReset');
    var cardsContainer = document.querySelector('#right-card > div:last-child');

    function applyFilters() {
    var visibleCount = 0;

        cards.forEach(function (card) {
            var type = card.getAttribute('data-item-type');
            var tagsAttr = card.getAttribute('data-item-tags') || '';
            var tags = tagsAttr.split(',').filter(Boolean);

            var typeMatch = activeType === 'all' || type === activeType;
            var tagMatch = activeTags.size === 0 || tags.some(function (t) {
                return activeTags.has(t);
            });

            var show = typeMatch && tagMatch;
            card.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        var emptyMsg = document.getElementById('eltaFilterEmpty');
        if (visibleCount === 0) {
            if (!emptyMsg && cardsContainer) {
                emptyMsg = document.createElement('p');
                emptyMsg.id = 'eltaFilterEmpty';
                emptyMsg.className = 'elta-filter-empty';
                emptyMsg.textContent = 'موردی با این فیلترها یافت نشد.';
                cardsContainer.appendChild(emptyMsg);
            }
        } else if (emptyMsg) {
            emptyMsg.remove();
        }
    }

    typeButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            typeButtons.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            activeType = btn.getAttribute('data-filter-value');
            applyFilters();
        });
    });

    tagButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var val = btn.getAttribute('data-filter-value');
            if (activeTags.has(val)) {
                activeTags.delete(val);
                btn.classList.remove('active');
            } else {
                activeTags.add(val);
                btn.classList.add('active');
            }
            applyFilters();
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            activeType = 'all';
            activeTags.clear();
            typeButtons.forEach(function (b) { b.classList.remove('active'); });
            typeButtons[0].classList.add('active');
            tagButtons.forEach(function (b) { b.classList.remove('active'); });
            applyFilters();
        });
    }
});

        document.addEventListener("DOMContentLoaded", function() {
            fetch('/unread-messages')
                .then(response => response.json())
                .then(data => {
                    const sidebarBadge = document.querySelector('.notification-badge');
                    const bellBadge = document.querySelector('.notification-bell-badge');

                    if (sidebarBadge) {
                        if (data.unread > 0) {
                            sidebarBadge.textContent = data.unread;
                            sidebarBadge.style.display = 'flex';
                        } else {
                            sidebarBadge.style.display = 'none';
                        }
                    }

                    if (bellBadge) {
                        if (data.unread > 0) {
                            bellBadge.textContent = data.unread;
                            bellBadge.style.display = 'inline-block';
                        } else {
                            bellBadge.style.display = 'none';
                        }
                    }
                });
        });

        let tagUpdatePending = false;

        // محاسبه فاصله بین چپ و راست
        function getHorizontalMargins(el) {
            const style = window.getComputedStyle(el);
            return parseFloat(style.marginLeft || 0) + parseFloat(style.marginRight || 0);
        }

        // محاسبه بیشترین عرض تگ بیشتر
        function getMoreTagWidth() {
            const temp = document.createElement('span');
            temp.className = 'more-tag services-tags userSkill-search-card';
            temp.style.visibility = 'hidden';
            temp.style.position = 'absolute';
            temp.textContent = '+99';
            document.body.appendChild(temp);
            const w = temp.getBoundingClientRect().width + getHorizontalMargins(temp);
            document.body.removeChild(temp);
            return w;
        }

        function processBox(box) {
            if (!box) return;

            // حذف +n قبلی
            box.querySelectorAll('.more-tag').forEach(m => m.remove());

            const children = Array.from(box.children).filter(c => !c.classList.contains('more-tag'));

            // نمایش همه برای اندازه‌گیری
            children.forEach(c => c.style.display = '');

            const available = box.clientWidth * 0.77;
            let used = 0;
            let hideIndex = children.length;
            const moreWidth = getMoreTagWidth();

            for (let i = 0; i < children.length; i++) {
                const child = children[i];
                const w = child.getBoundingClientRect().width + getHorizontalMargins(child);

                if (used + w + moreWidth > available) {
                    hideIndex = i;
                    break;
                }
                used += w;
            }

            // فقط یک بار تغییر DOM
            const hiddenCount = children.length - hideIndex;

            children.forEach((c, i) => {
                c.style.display = i < hideIndex ? '' : 'none';
            });

            if (hiddenCount > 0) {
                const more = document.createElement('span');
                more.className = 'more-tag services-tags userSkill-search-card';
                more.textContent = `+${hiddenCount}`;
                box.appendChild(more);
            }
        }

        function updateAll() {
            if (tagUpdatePending) return;

            tagUpdatePending = true;
            requestAnimationFrame(() => {
                document.querySelectorAll('.dynamic-skill-box, .dynamic-tag-box').forEach(box => {
                    processBox(box);
                });
                tagUpdatePending = false;
            });
        }

        function observeBoxes() {
            const boxes = document.querySelectorAll('.dynamic-skill-box, .dynamic-tag-box');
            if (!boxes.length) return;

            const ro = new ResizeObserver(() => {
                updateAll(); // بدون setTimeout
            });

            boxes.forEach(b => ro.observe(b));
        }

        window.addEventListener('load', () => {
            updateAll();
            observeBoxes();
        });
        const check = document.getElementById("aboutToggleCheck");
        const aboutText = document.getElementById("aboutText");
        const toggleAbout = document.getElementById("toggleAbout");

        const collapsedHeight = 130; // ارتفاع بسته (دو خط)

        function expand() {
            aboutText.style.maxHeight = aboutText.scrollHeight + "px";
        }

        function collapse() {
            if (!aboutText) return;
            aboutText.style.maxHeight = collapsedHeight + "px";
        }

        // همیشه در ابتدا بسته باشد
        collapse();

        // چک می‌کنیم آیا متن کوتاه است یا نه
        function checkTextLength() {
            const aboutText = document.getElementById('aboutText');
            const toggleAbout = document.getElementById('toggleAbout');

            // اگر المنت‌ها وجود ندارن، کاری انجام نده
            if (!aboutText || !toggleAbout) return;

            const collapsedHeight = 60; // ارتفاع دو خط یا هر مقدار دلخواه
            if (aboutText.scrollHeight <= collapsedHeight + 5) {
                toggleAbout.style.display = "none";
            } else {
                toggleAbout.style.display = "flex";
            }
        }

        // وقتی صفحه لود شد یا محتوا تغییر کرد
        document.addEventListener('DOMContentLoaded', checkTextLength);


        if (check) {
            check.addEventListener("change", () => {
                if (check.checked) {
                    expand();
                } else {
                    collapse();
                }
            });
        }


        window.addEventListener('resize', updateAll);

        // استفاده از event delegation برای کارت‌های داینامیک
        document.addEventListener('click', function(event) {
            // بررسی اینکه آیا کلیک روی دکمه add-contact بوده یا نه
            const addContactBtn = event.target.closest('.add-contact');
            if (!addContactBtn) return;

            event.preventDefault();
            event.stopPropagation();

            var userId = addContactBtn.getAttribute('data-user-id');
            if (!userId) {
                console.warn('data-user-id not found on add-contact button');
                return;
            }

            var icon = addContactBtn.querySelector('i');
            if (!icon) return;

            icon.classList.add('icon-fade');

            setTimeout(() => {
                icon.className = 'fa-solid fa-spinner fa-spin icon-anim icon-gray';

                fetch('/favorite/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            favorite_id: userId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {

                        setTimeout(() => {
                            if (data.status === 'added') {
                                icon.className = 'fa-solid fa-check icon-anim icon-green';
                            } else {
                                icon.className = 'fa-solid fa-xmark icon-anim icon-red ml-1';
                            }
                        }, 400);

                        setTimeout(() => {
                            if (data.status === 'added') {
                                icon.className = 'fa-solid fa-user-check icon-anim';
                            } else {
                                icon.className = 'fa-solid fa-user-plus icon-anim';
                            }
                        }, 1400);

                        setTimeout(() => {
                            icon.classList.remove('icon-fade');
                        }, 500);

                    })
                    .catch(error => {
                        console.error('Error toggling favorite:', error);
                        icon.classList.remove('icon-fade');
                        icon.className = addContactBtn.querySelector('i').classList.contains('fa-user-check') ?
                            'fa-solid fa-user-check icon-anim' :
                            'fa-solid fa-user-plus icon-anim';
                    });
            }, 150);
        });
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const openSidebarBtn = document.getElementById("open-sidebar");
            const closeSidebarBtn = document.getElementById("close-sidebar");


            if (openSidebarBtn && closeSidebarBtn && sidebar && overlay) {
                openSidebarBtn.addEventListener("click", () => {
                    sidebar.classList.add("open");
                    overlay.classList.add("active");
                });

                closeSidebarBtn.addEventListener("click", () => {
                    sidebar.classList.remove("open");
                    overlay.classList.remove("active");
                });

                overlay.addEventListener("click", () => {
                    sidebar.classList.remove("open");
                    overlay.classList.remove("active");
                });
            }



        });

        function updateCardLinks() {
            document.querySelectorAll('.user-card-link').forEach(link => {
                const defaultUrl = link.dataset.defaultUrl;
                const mobileUrl = link.dataset.mobileUrl;

                if (window.innerWidth < 992) {
                    link.href = mobileUrl;
                } else {
                    link.href = defaultUrl;
                }
            });
        }

        window.addEventListener('DOMContentLoaded', updateCardLinks);
        window.addEventListener('resize', updateCardLinks);
        document.addEventListener('DOMContentLoaded', function() {
            // 🧩 تابع نمایش پیام کپی (toast)
            function showCopyMessage(msg) {
                const toast = document.createElement('div');
                toast.textContent = msg;
                toast.style.position = 'fixed';
                toast.style.bottom = '20px';
                toast.style.left = '50%';
                toast.style.transform = 'translateX(-50%)';
                toast.style.background = '#333';
                toast.style.color = 'white';
                toast.style.padding = '8px 16px';
                toast.style.borderRadius = '8px';
                toast.style.fontSize = '14px';
                toast.style.zIndex = '9999';
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.4s';
                document.body.appendChild(toast);

                requestAnimationFrame(() => toast.style.opacity = '1');
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 400);
                }, 2000);
            }

            // آیدی کاربر از Blade (در لاراول)
            const userId = "{{ $clickedUser->id ?? auth()->id() }}";

            // لینک پروفایل با پارامتر ref=share
            const baseUrl = `${window.location.origin}/profile/${userId}?ref=share`;
            const encodedUrl = encodeURIComponent(baseUrl);

            // لینک‌های اشتراک‌گذاری
            const shareLinks = {
                telegram: `https://t.me/share/url?url=${encodedUrl}`,
                whatsapp: `https://api.whatsapp.com/send?text=${encodedUrl}`,
                linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`
            };

            // هندل کلیک روی آیکون‌ها
            document.querySelectorAll('.social-icon').forEach(icon => {
                icon.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (icon.classList.contains('copy')) {
                        // 📋 کپی لینک (سازگار با موبایل و دسکتاپ)
                        const textArea = document.createElement('textarea');
                        textArea.value = baseUrl;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        showCopyMessage('لینک پروفایل کپی شد');
                    } else if (icon.classList.contains('telegram')) {
                        window.open(shareLinks.telegram, '_blank');
                    } else if (icon.classList.contains('whatsapp')) {
                        window.open(shareLinks.whatsapp, '_blank');
                    } else if (icon.classList.contains('linkedin')) {
                        window.open(shareLinks.linkedin, '_blank', 'width=600,height=400');
                    }
                });
            });
        });
    </script>
</body>

</html>