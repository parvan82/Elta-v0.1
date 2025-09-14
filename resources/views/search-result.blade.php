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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
<header>
    <section class="nav-head">
        <div class="header2">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar">
                <div class="sidebar-header">
                    <div class="header-btn">
                        <button id="close-sidebar" class="closeBtn"><i class="bi bi-x"></i></button>
                        <a href="{{ route('freelancerProfile') }}?popup=open"><button class="editBtn"><svg height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg></button></a>
                    </div>

                    <div class="user-info">
                        <p class="name">{{ Auth::user()->name}}</p>
                        <p class="career">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                        <p class="username-title">{{ Auth::user()->username}}</p>
                    </div>
                    <div class="profile-picture">
                        <img  src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
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
                        <li><button><a href="{{ url(config('chatify.routes.prefix')) }}"><span>پیام ها</span></a><div class="notification-badge">99</div></button></li>
                        <li><button><a href="{{ route('portfolioShow', ['id' => auth()->user()->id]) }}"><span>رزومه</span></a> </button></li>
                        <li><button><a href="#"><span>کیف پول</span></a> </button></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button class="Btn"><div class="logout"><i class="bi bi-box-arrow-right"></i></div><div class="text">خروج</div></button>
                    </form>
                    <button class="Btn"><div class="support"><i class="fa-solid fa-headset "></i></div><div class="text text-success" >پشتیبانی</div></button>
                </div>
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
                    <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i></a>
                </div>
                <div class="site-name">
                    <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
                </div>
            </div>

        </div>

    </section>

</header>
<main class="main-container" >
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('user.search') }}" method="GET">
                <div class="search2">
                    <div class="search-box" style="box-shadow: 0 0 20px #444;">
                        <div class="search-field">
                            <input
                                type="text"
                                name="q"
                                class="search-input"
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

        @if($users->isEmpty())
            <div class="col-12 mt-4">
                <div class="eltaCard" style="box-shadow: 0 0 20px #555; ">
                    <div class="search-elta-card pt-5 d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                        <img src="{{ asset('images/search/not-result.png') }}" alt="" style="width: 200px; height: 200px;">
                        <h4 class="text-center mt-4">فریلنسری برای جستجوی شما پیدا نشد</h4>
                        <p class="text-center mt-2">نگارش کلید واژه های خود را بررسی کنید</p>
                        <p class="text-center  mt-2">کلید واژه دیگری وارد کنید</p>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6 pt-3 pr-2" id="left-card">
                <div class="left-card">
                    @if ($clickedUser)
                        <div class="left-card-top">
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
                                      <svg class="share-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path></svg>
                                    </div>
                                    <div class="tooltip-content">
                                      <div class="social-icons">
                                        <a href="#" class="social-icon twitter">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z"/></svg>
                                        </a>
                                        <a href="#" class="social-icon whatsapp">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                        </a>
                                        <a href="#" class="social-icon linkedin">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
                                        </a>
                                        <a href="#" class="social-icon copy">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z"/></svg>        </a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                                <div class="search-info-container">
                                    <h4 class="select-search-name">{{ $clickedUser->name }}</h4>
                                    <h6 class="select-search-scope-work">{{ $clickedUser->workarea }}</h6>
                                    <p class="select-search-about-me">{{ $clickedUser->aboutme }}</p>
                                </div>
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
                        </div>

                        <div class="d-flex justify-content-between p-3 " style="direction: rtl;">
                            <h6 style="color:gold; margin:0px;">2 پروژه باز</h6>
                            <h6 style="color:green;margin:0px;">10 پروژه موفق</h6>
                            <h6 style="font-weight: bold;margin:0px; color:#999">2 سال سابقه فعالیت در التا</h6>
                        </div>

                        <div class="left-card-bottom">
                            <h5 class="pr-3 pt-3"><b>اطلاعات فردی</b></h5>
                            <div class=" pr-4" style="direction: rtl;">
                                <span class="d-flex">
                                    <h6 style=" padding:0px 5px"><b>سن:</b></h6>
                                    <h6>22 سال</h6>
                                </span>
                                <span class="d-flex">
                                    <h6 style=" padding:0px 5px"><b>وضعیت نظام وظیفه:</b></h6>
                                    <h6>{{ $clickedUser->personalInformation->military_status ?? 'ثبت نشده' }}</h6>
                                </span>
                                <span class="d-flex">
                                    <h6 style=" padding:0px 5px"><b>تحصیلات:</b></h6>
                                    @forelse($clickedUser->educationalHistories ?? [] as $edu)
                                        <h6>{{ $edu->degree }} - {{ $edu->major }}</h6>
                                    @empty
                                        <h6>ثبت نشده</h6>
                                    @endforelse
                                </span>
                            </div>

                            <hr>

                            <h5 class="pr-3"><b>سطح زبان</b></h5>
                            <div class="d-flex mr-4" style="direction: rtl; gap:10px; flex-wrap: wrap;">
                                @forelse($clickedUser->languages ?? [] as $lang)
                                    <div class="language-tag">
                                        <span>{{ $lang->language }}</span>
                                        <span class="mx-2 ng-star-inserted">|</span>
                                        <span class="tag-title font-weight-bold">{{ $lang->language_level}}</span>

                                    </div>
                                    @empty
                                        <h6>ثبت نشده</h6>
                                @endforelse
                            </div>

                            <hr>

                            <h5 class="pr-3"><b>مهارت ها</b></h5>
                            <div class="d-flex mr-4" style="direction: rtl; gap:10px; flex-wrap: wrap;">
                                @forelse($clickedUser->skillMapping ?? [] as $map)
                                    @if($map->skill)
                                        <div class="language-tag">
                                            <span>{{ $map->skill->skill }}</span>
                                            <span class="mx-2 ng-star-inserted">|</span>
                                            <span class="tag-title font-weight-bold">@if($map->level) {{ $map->level }} @endif</span>
                                        </div>
                                    @endif
                                @empty
                                    <p>ثبت نشده</p>
                                @endforelse
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between px-3" style="direction: rtl;">
                                <h5 class="font-weight-bold">نمونه کار ها</h5>
                                <h6><b>{{ count($clickedUser->portfolios ?? []) }}</b> پروژه ثبت شده است</h6>
                            </div>
                            <div class="portfolio-container">
                                @forelse($clickedUser->portfolios ?? [] as $portfolio)
                                    <div class="portfolio-content ">
                                        <h5 class="m-3"><b>{{$portfolio->title}}</b></h5>
                                        @php
                                            $file = $portfolio->file;
                                            $link = $portfolio->link;
                                            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <div class="col-md-12 image-container-portfolio">
                                                <img src="{{ asset($file) }}" class="img-fluid" alt="{{ $portfolio->title }}">
                                            </div>
                                        @elseif(in_array($file_extension, ['mp4', 'webm', 'ogg']))
                                            <video controls style="max-width: 100%;">
                                                <source src="{{ asset($file) }}" type="video/{{ $file_extension }}">
                                                مرورگر شما از ویدئو پشتیبانی نمی‌کند.
                                            </video>
                                        @elseif(in_array($file_extension, ['mp3', 'wav', 'ogg']))
                                            <audio controls>
                                                <source src="{{ asset($file) }}" type="audio/{{ $file_extension }}">
                                                مرورگر شما از صوت پشتیبانی نمی‌کند.
                                            </audio>
                                        @elseif($file_extension === 'html')
                                            <iframe src="{{ asset($file) }}" class="w-100" style="height: 500px; border:none"> مرورگر شما </iframe>
                                        @else
                                            <p class="text-muted">نوع فایل پشتیبانی نمی‌شود.</p>
                                        @endif
                                        <h5 class="pr-3 mt-3"><b>توضیحات</b></h5>
                                        <p class="mx-3 mb-3">{{$portfolio->description}}</p>
                                        @if(strpos($link, 'github.com') !== false)
                                            <a href="{{ $link }}" id="githubBtn" class="socialBtn mx-3 mb-3">
                                                <svg class="github-svgIcon" viewBox="0 0 496 512" height="1.4em" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8z"></path>
                                                </svg>
                                                <span class="text">Github</span>
                                            </a>
                                        @elseif(strpos($link, 'soundcloud.com') !== false)
                                            <a href="{{ $link }}" id="soundcloudBtn" class="socialBtn mx-3 mb-3" >
                                                <svg  class="soundcloud-svgIcon"  viewBox="0 0 640 512" height="25px" xmlns="http://www.w3.org/2000/svg" fill="#ff8800" class="soundcloud"><path d="M111.4 256.3l5.8 65-5.8 68.3c-.3 2.5-2.2 4.4-4.4 4.4s-4.2-1.9-4.2-4.4l-5.6-68.3 5.6-65c0-2.2 1.9-4.2 4.2-4.2 2.2 0 4.1 2 4.4 4.2zm21.4-45.6c-2.8 0-4.7 2.2-5 5l-5 105.6 5 68.3c.3 2.8 2.2 5 5 5 2.5 0 4.7-2.2 4.7-5l5.8-68.3-5.8-105.6c0-2.8-2.2-5-4.7-5zm25.5-24.1c-3.1 0-5.3 2.2-5.6 5.3l-4.4 130 4.4 67.8c.3 3.1 2.5 5.3 5.6 5.3 2.8 0 5.3-2.2 5.3-5.3l5.3-67.8-5.3-130c0-3.1-2.5-5.3-5.3-5.3zM7.2 283.2c-1.4 0-2.2 1.1-2.5 2.5L0 321.3l4.7 35c.3 1.4 1.1 2.5 2.5 2.5s2.2-1.1 2.5-2.5l5.6-35-5.6-35.6c-.3-1.4-1.1-2.5-2.5-2.5zm23.6-21.9c-1.4 0-2.5 1.1-2.5 2.5l-6.4 57.5 6.4 56.1c0 1.7 1.1 2.8 2.5 2.8s2.5-1.1 2.8-2.5l7.2-56.4-7.2-57.5c-.3-1.4-1.4-2.5-2.8-2.5zm25.3-11.4c-1.7 0-3.1 1.4-3.3 3.3L47 321.3l5.8 65.8c.3 1.7 1.7 3.1 3.3 3.1 1.7 0 3.1-1.4 3.1-3.1l6.9-65.8-6.9-68.1c0-1.9-1.4-3.3-3.1-3.3zm25.3-2.2c-1.9 0-3.6 1.4-3.6 3.6l-5.8 70 5.8 67.8c0 2.2 1.7 3.6 3.6 3.6s3.6-1.4 3.9-3.6l6.4-67.8-6.4-70c-.3-2.2-2-3.6-3.9-3.6zm241.4-110.9c-1.1-.8-2.8-1.4-4.2-1.4-2.2 0-4.2.8-5.6 1.9-1.9 1.7-3.1 4.2-3.3 6.7v.8l-3.3 176.7 1.7 32.5 1.7 31.7c.3 4.7 4.2 8.6 8.9 8.6s8.6-3.9 8.6-8.6l3.9-64.2-3.9-177.5c-.4-3-2-5.8-4.5-7.2zm-26.7 15.3c-1.4-.8-2.8-1.4-4.4-1.4s-3.1.6-4.4 1.4c-2.2 1.4-3.6 3.9-3.6 6.7l-.3 1.7-2.8 160.8s0 .3 3.1 65.6v.3c0 1.7.6 3.3 1.7 4.7 1.7 1.9 3.9 3.1 6.4 3.1 2.2 0 4.2-1.1 5.6-2.5 1.7-1.4 2.5-3.3 2.5-5.6l.3-6.7 3.1-58.6-3.3-162.8c-.3-2.8-1.7-5.3-3.9-6.7zm-111.4 22.5c-3.1 0-5.8 2.8-5.8 6.1l-4.4 140.6 4.4 67.2c.3 3.3 2.8 5.8 5.8 5.8 3.3 0 5.8-2.5 6.1-5.8l5-67.2-5-140.6c-.2-3.3-2.7-6.1-6.1-6.1zm376.7 62.8c-10.8 0-21.1 2.2-30.6 6.1-6.4-70.8-65.8-126.4-138.3-126.4-17.8 0-35 3.3-50.3 9.4-6.1 2.2-7.8 4.4-7.8 9.2v249.7c0 5 3.9 8.6 8.6 9.2h218.3c43.3 0 78.6-35 78.6-78.3.1-43.6-35.2-78.9-78.5-78.9zm-296.7-60.3c-4.2 0-7.5 3.3-7.8 7.8l-3.3 136.7 3.3 65.6c.3 4.2 3.6 7.5 7.8 7.5 4.2 0 7.5-3.3 7.5-7.5l3.9-65.6-3.9-136.7c-.3-4.5-3.3-7.8-7.5-7.8zm-53.6-7.8c-3.3 0-6.4 3.1-6.4 6.7l-3.9 145.3 3.9 66.9c.3 3.6 3.1 6.4 6.4 6.4 3.6 0 6.4-2.8 6.7-6.4l4.4-66.9-4.4-145.3c-.3-3.6-3.1-6.7-6.7-6.7zm26.7 3.4c-3.9 0-6.9 3.1-6.9 6.9L227 321.3l3.9 66.4c.3 3.9 3.1 6.9 6.9 6.9s6.9-3.1 6.9-6.9l4.2-66.4-4.2-141.7c0-3.9-3-6.9-6.9-6.9z"></path></svg>
                                                <span class="text">Soundcloud</span>
                                            </a>
                                        @endif

                                    </div>
                                    @empty
                                    <p>ثبت نشده</p>
                                @endforelse
                            </div>

                        <hr>
                        <div class="d-flex justify-content-between px-3" style="direction: rtl;">
                                <h5 class="font-weight-bold">فریلنسر های مشابه</h5>
                            </div>
                        <div class="eltaCard m-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                            <div class="search-elta-card pt-5">
                                                                    <span class="active offline"></span>
                                                                <div class="search-image-container">
                                        <img src="http://localhost:8000/storage/images/default.jpg" alt="Profile Picture">
                                    </div>
                                    <div class="search-card-tags">
                                        <h6 class="username-search-card">mohammady.kasra</h6>
                                        <h6 class="tags">gold</h6>
                                    </div>
                                    <div class="add-contact"><i class="fa-solid fa-user-plus"></i></div>
                                    <div class="search-info-container">
                                        <h4 class="search-name">گشتاسب محجوبی</h4>
                                        <h6 class="search-scope-work">کارشناس سئو</h6>
                                        <p class="search-about-me">در زمینه توسعه وب، تجربه و دانش زیادی دارم و به دنبال چالش‌های جدید هستم.</p>
                                    </div>
                                    <div class="search-card-skill">
                                                                    <h6 class="userSkill-search-card">GIT</h6>
                                                            </div>
                            </div>
                        </div>
                        <div class="eltaCard m-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                            <div class="search-elta-card pt-5">
                                                                    <span class="active offline"></span>
                                                                <div class="search-image-container">
                                        <img src="http://localhost:8000/storage/images/default.jpg" alt="Profile Picture">
                                    </div>
                                    <div class="search-card-tags">
                                        <h6 class="username-search-card">mohammady.kasra</h6>
                                        <h6 class="tags">gold</h6>
                                    </div>
                                    <div class="add-contact"><i class="fa-solid fa-user-plus"></i></div>
                                    <div class="search-info-container">
                                        <h4 class="search-name">گشتاسب محجوبی</h4>
                                        <h6 class="search-scope-work">کارشناس سئو</h6>
                                        <p class="search-about-me">در زمینه توسعه وب، تجربه و دانش زیادی دارم و به دنبال چالش‌های جدید هستم.</p>
                                    </div>
                                    <div class="search-card-skill">
                                                                    <h6 class="userSkill-search-card">GIT</h6>
                                                            </div>
                            </div>
                        </div>
                        <div class="eltaCard m-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                            <div class="search-elta-card pt-5">
                                                                    <span class="active offline"></span>
                                                                <div class="search-image-container">
                                        <img src="http://localhost:8000/storage/images/default.jpg" alt="Profile Picture">
                                    </div>
                                    <div class="search-card-tags">
                                        <h6 class="username-search-card">mohammady.kasra</h6>
                                        <h6 class="tags">gold</h6>
                                    </div>
                                    <div class="add-contact"><i class="fa-solid fa-user-plus"></i></div>
                                    <div class="search-info-container">
                                        <h4 class="search-name">گشتاسب محجوبی</h4>
                                        <h6 class="search-scope-work">کارشناس سئو</h6>
                                        <p class="search-about-me">در زمینه توسعه وب، تجربه و دانش زیادی دارم و به دنبال چالش‌های جدید هستم.</p>
                                    </div>
                                    <div class="search-card-skill">
                                                                    <h6 class="userSkill-search-card">GIT</h6>
                                                            </div>
                            </div>
                        </div>
                        </div>
                        @else
                        <div class="left-card-top d-flex flex-column align-items-center justify-content-start" style="height: 100%; padding-top: 20px;">
                                <img src="{{ asset('images/search/result.png') }}" alt="" style="width: 300px; height: 300px;">
                                <h5 class="text-center mt-5">برای مشاهده رزومه، روی یکی از کارت‌ها کلیک کنید</h5>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6 pt-3 pl-2" id="right-card">
                <div class="right-card">
                    <div class="d-felx justify-content-between mb-5 mt-2" style="direction: rtl; color:white;">
                    @if (!empty($query) && !$users->isEmpty())
                        <p >
                            <b>{{ $users->count() }}</b> نتیجه برای {{ $query }}
                        </p>
                    @endif
                    </div>

                    @foreach ($users as $user)
                    <a class="user-card-link"
   href="{{ $defaultUrl = url()->current() . '?q=' . urlencode($query) . '&clickedUserId=' . $user->id }}"
   data-default-url="{{ $defaultUrl }}"
   data-mobile-url="{{ url('/mobile/profile/' . $user->id) }}">


                        <div class="eltaCard mb-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                            <div class="search-elta-card pt-5">
                                @if ( Cache::has('user-is-online-' . $user->id) )
                                    <span class="active online"></span>
                                @else
                                    <span class="active offline"></span>
                                @endif
                                <div class="search-image-container">
                                    <img src="{{ $user->profilepic ? asset('storage/' . $user->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
                                </div>
                                <div class="search-card-tags">
                                    <h6 class="username-search-card">{{ $user->username }}</h6>
                                    <h6 class="tags">gold</h6>
                                </div>
                                <div class="add-contact" data-user-id="{{ $user->id }}">
                                    @if ($user->is_favorite)
                                        <i class="fa-solid fa-user-tie"></i>
                                    @else
                                        <i class="fa-solid fa-user-plus"></i>
                                    @endif
                                </div>
                                <div class="search-info-container">
                                    <h4 class="search-name">{{ $user->name }}</h4>
                                    <h6 class="search-scope-work">{{ $user->workarea }}</h6>
                                    <p class="search-about-me">{{ $user->aboutme }}</p>
                                </div>
                                <div class="search-card-skill">
                                    @foreach ($user->skills as $skill)
                                        <h6 class="userSkill-search-card">{{ $skill }}</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

</main>




<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div id="overlay" class="overlay"></div>
<script>
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


// input auto typing...
const input = document.querySelector('.search-input');
const text = "برنامه نویس بک اند"; // متنی که تایپ می‌شود
let currentIndex = 0;
let isTyping = true; // برای تشخیص اینکه در حال تایپ هستیم یا حذف
let isWaiting = false; // برای جلوگیری از تداخل تایم‌ها

// تایپ کردن یا حذف کردن حرف به حرف
function typeText() {
    if (isTyping) {
        input.placeholder = text.substring(0, currentIndex); // تایپ حرف به حرف
        currentIndex++;

        // وقتی به انتهای متن رسید، برای چند ثانیه تایپ شده می‌ماند
        if (currentIndex > text.length) {
            isTyping = false; // متوقف کردن تایپ
            isWaiting = true; // فعال کردن وضعیت انتظار
            setTimeout(() => {
                isWaiting = false; // تمام شدن زمان انتظار
                currentIndex = text.length; // شروع به حذف حرف
            }, 2000); // نگه داشتن تایپ شده برای 2 ثانیه
        }
    } else if (!isWaiting) {
        input.placeholder = text.substring(0, currentIndex); // حذف حرف به حرف
        currentIndex--;

        // وقتی به ابتدای متن رسید، دوباره تایپ می‌کنیم
        if (currentIndex <= 0) {
            isTyping = true; // شروع مجدد تایپ
        }
    }
}

// تکرار تایپ و حذف هر 100 میلی‌ثانیه
setInterval(typeText, 200);

document.addEventListener("DOMContentLoaded", function () {
    fetch('/unread-messages')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.notification-badge');
            if (data.unread > 0) {
                badge.textContent = data.unread;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        });
});

document.querySelectorAll('.add-contact').forEach(btn => {
    btn.addEventListener('click', function () {
                event.preventDefault();

        const targetUserId = this.dataset.userId;

        fetch("/favorite/toggle", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ favorite_id: targetUserId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                this.innerHTML = '<i class="fa-solid fa-user-tie"></i>';
            } else {
                this.innerHTML = '<i class="fa-solid fa-user-plus"></i>';
            }
        });
    });
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

</script>
</body>
</html>
