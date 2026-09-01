<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../../css/content.css">
    <link href="{{ asset('css/tooman/css/font.css') }}" rel="stylesheet" type="text/css" />
    @vite('resources/css/app.css')
</head>
<body>
    <header>

        <section class="nav-head">
        <div class="header2">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar">
                @php
                    $user = auth()->user();
                @endphp
                @if ($user && $user->role === 'freelancer')
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
                        <li><button><a href="{{ url(config('chatify.routes.prefix')) }}"><span>پیام ها</span></a><div class="notification-badge freelancer"></div></button></li>
                        <li><button><a href="{{ route('mobile.profile', ['id' => auth()->user()->id]) }}"><span>رزومه</span></a> </button></li>
                        <li><button><a href="{{ route('EltaCard') }}"><span>التا کارت</span></a></button></li>
                        <li><button><a href="#"><span>کیف پول</span></a> </button></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button class="Btn"><div class="logout"><i class="bi bi-box-arrow-right"></i></div><div class="text" id="logout-btn">خروج</div></button>
                    </form>
                    <button class="Btn"><div class="support"><i class="fa-solid fa-headset "></i></div><div class="text" id="support-btn">پشتیبانی</div></button>
                </div>
                @else
                <div class="sidebar-header">
                    <div class="header-btn">
                        <button id="close-sidebar" class="closeBtn"><i class="bi bi-x"></i></button>
                        <a href="{{ route('employerProfile') }}?popup=open"><button class="editBtn"><svg height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg></button></a>
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
                        <li><button><a href="{{ url(config('chatify.routes.prefix')) }}"><span>پیام ها</span></a><div class="notification-badge"></div></button></li>
                        <li><button><a href="{{ route('EltaCard') }}"><span>التا کارت</span></a></button></li>
                        <li><button><a href="#"><span>کیف پول</span></a></button></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button class="Btn"><div class="logout"><i class="bi bi-box-arrow-right"></i></div><div class="text" id="logout-btn">خروج</div></button>
                    </form>
                    <button class="Btn"><div class="support"><i class="fa-solid fa-headset "></i></div><div class="text" id="support-btn">پشتیبانی</div></button>
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
    <div class="col-md-12 px-2 py-3" id="mobile-left-card">
        @if ($type === 'project')
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
                              <svg class="share-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path></svg>
                            </div>
                            <div class="tooltip-content">
                              <div class="social-icons">
                                <a href="#" class="social-icon telegram">
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
                            <h4 class="select-search-name">{{ $clickedUser->companies->company_name}}</h4>
                            <h6 class="select-search-scope-work">{{ $clickedUser->workarea }}</h6>
                            <p class="select-search-about-me">{{ $clickedUser->aboutme }}</p>
                        </div>
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
                                  <span style="font-size: 2em;">{{ $clickedUser->companies->company_type }}</span>
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
                <div class="left-card-bottom" >
                    @if(!empty($clickedproject))
                        <div class="ad-info-container project-info-container" style="direction: rtl;">
                            <!-- عنوان پروژه -->
                            <div class="ad-header d-flex justify-content-between">
                                <h4 dir='rtl' class="ad-title mb-0 mr-0">
                                    <i class="fa-solid fa-briefcase" style="color: #ffd700; margin-left: 10px;"></i>
                                    {{ $clickedproject->title }}
                                </h4>
                                @if($clickedproject->user_id)
                                    <a href="{{ url('chatify/' . $clickedproject->user_id . '?project_id=' . $clickedproject->id) }}" 
                                       class="project-chat-btn" 
                                       style="margin-right: 15px; text-decoration: none;">
                                        <button type="button" style="
                                            display: inline-flex;
                                            align-items: center;
                                            gap: 8px;
                                            padding: 10px 20px;
                                            background: linear-gradient(135deg, #27AE60, #2ECC71);
                                            color: white;
                                            border: none;
                                            border-radius: 25px;
                                            font-size: 14px;
                                            font-weight: 600;
                                            cursor: pointer;
                                            transition: all 0.3s ease;
                                            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
                                        " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(39, 174, 96, 0.4)';" 
                                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(39, 174, 96, 0.3)';">
                                            <i class="fa-solid fa-comments" style="font-size: 16px;"></i>
                                            <span style="white-space: nowrap;">ارسال پیشنهاد</span>
                                        </button>
                                    </a>
                                @endif
                            </div>
                            <hr class="section-divider">

                            <!-- اطلاعات اصلی پروژه -->
                            <div class="ad-details project-details-grid">
                                <!-- سرویس مورد نیاز -->
                                <div class="info-item">
                                    <div class="info-icon service-icon">
                                        <i class="fa-solid fa-file-export"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-label">سرویس مورد نیاز</h6>
                                        <p class="info-value">{{ $clickedproject->service ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>

                                <!-- بودجه -->
                                <div class="info-item">
                                    <div class="info-icon price-icon">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-label">بودجه</h6>
                                        <p class="info-value price-value">{{ $clickedproject->budget ?? 'ثبت نشده' }} </p>
                                    </div>
                                </div>

                                <!-- اولویت‌ها -->
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-label">اولویت‌ها</h6>
                                        <p class="info-value">{{ $clickedproject->priority ?? 'ثبت نشده' }}</p>
                                    </div>
                                </div>
                            </div>
 
                            <!-- برچسب‌ها / ویژگی‌ها -->
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

                            <!-- مهارت‌ها -->
                            <div style="direction: rtl;">
                                <h4 dir="rtl" class="ad-title mr-0"><i class="bi bi-tools" style="color: #ffd700; margin-left: 10px;"></i>مهارت‌ها</h4>
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

                            <!-- توضیحات پروژه -->
                            <div class="description-section">
                                <h5 class="section-title">
                                    <i class="fa-solid fa-file-lines" style="color: #ffd700; margin-left: 10px;"></i>
                                    توضیحات پروژه
                                </h5>
                                <div class="description-content" id="aboutText">
                                    <p>{{ $clickedproject->description ?? 'توضیحاتی ثبت نشده است.' }}</p>
                                </div>
                                <label class="container-more mb-3" id="toggleAbout">
                                  <input type="checkbox" id="aboutToggleCheck">
                                  <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="chevron-down">
                                      <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                                  </svg>
                                </label>   
                            </div>
                        </div>
                    @endif
                    <hr class="section-divider m-0 mb-3">
                    @if($similarProjects->count())
                            <h4 dir="rtl" class="ad-title "><i class="bi bi-badge-ad" style="color: #ffd700; margin-left: 10px;"></i>پروژه‌های مشابه</h4>
                        @foreach ($similarProjects as $project)
                            @php
                                // بررسی اینکه پروژه تگ "متمایز" دارد یا نه
                                $hasDistinguishedTag = false;
                                foreach($project->serviceTags ?? [] as $tag) {
                                    if($tag->name === 'متمایز') {
                                        $hasDistinguishedTag = true;
                                        break;
                                    }
                                }                   

                                // مرتب‌سازی تگ‌ها بر اساس اولویت خاص
                                $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];                  

                                $sortedTags = collect($project->serviceTags ?? [])->sortBy(function($tag) use ($tagOrder) {
                                    return array_search($tag->name, $tagOrder);
                                })->values();
                            @endphp                 

                            <a class="user-card-link" href="{{ url('/content?type=project&id=' . $project->id) }}" style="text-decoration:none; color:inherit;">
                                <div style="background: #3a4046; margin: 20px; border-radius: 10px;">
<div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }} m-0">
                                    {{-- هدر کارت --}}
                                    <div class="project-card-header">
                                        <div class="project-card-avatar">
                                            <img src="{{ asset('storage/' . ($project->user->profilepic ?? 'images/default.jpg')) }}" alt="Profile">
                                        </div>
                                    </div>

                                    {{-- تگ‌های سرویس --}}
                                    <div class="project-card-tags dynamic-tag-box">
                                        @foreach($sortedTags as $tag)
                                            @php
                                                $tagClass = match($tag->name) {
                                                    'تخصصی' => 'takhasosi',
                                                    'فوری' => 'fori',
                                                    'مدیر پروژه' => 'modir-proje',
                                                    'متمایز' => 'motamayez',
                                                    default => '',
                                                };
                                            @endphp
                                            <span class="project-card-tag {{ $tagClass }}">{{ $tag->name }}</span>
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
                                            <span class="project-skill-pill">{{ $skill->skill }}</span>
                                        @endforeach
                                    </div>

                                    {{-- علاقه‌مندی --}}
                                    <div class="add-contact project-card-favorite" data-user-id="{{ $project->user->id }}">
                                        @if ($project->user->is_favorite)
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
        @elseif ($type === 'ad')
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
                                  <svg class="share-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path></svg>
                                </div>
                                <div class="tooltip-content">
                                  <div class="social-icons">
                                    <a href="#" class="social-icon telegram">
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
                                <h4 class="select-search-name">{{ $clickedUser->name}}</h4>
                                <h6 class="select-search-scope-work">{{ $clickedUser->workarea }}</h6>
                                <p class="select-search-about-me">{{ $clickedUser->aboutme }}</p>
                            </div>
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
                              <path d="M20.5,-37.9C26.5,-32,31.4,-26.5,40.2,-20.2C49,-13.9,61.9,-7,63,0.6C64.1,8.2,53.4,16.5,43,20C32.6,23.5,22.4,22.3,15.3,26.4C8.1,30.4,4.1,39.7,-2.8,44.6C-9.8,49.5,-19.5,50.1,-31.5,48.9C-43.5,47.7,-57.8,44.6,-60.7,36.2C-63.7,27.7,-55.3,13.9,-44.2,6.4C-33.1,-1,-19.2,-2.1,-14.2,-7C-9.2,-11.9,-13.1,-20.7,-12.3,-29.6C-11.4,-38.4,-5.7,-47.3,0.8,-48.7C7.2,-50,14.5,-43.8,20.5,-37.9Z" transform="translate(100 100)"></path>
                            </svg>
                            <div class="card-content">
                              <span>{{ $item->count() }}</span>
                              <p>آگهی ثبت شده</p>
                            </div>
                        </div>                        
                          <!-- کارت ۲ -->
                        <div class="card open">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                              <path d="M32,-49.6C41.1,-50.3,47.7,-40.8,55.1,-30.8C62.5,-20.9,70.8,-10.4,65.7,-3C60.5,4.5,42,9,35.3,20.3C28.6,31.5,33.8,49.6,29.9,52.9C26,56.3,13,45,-0.7,46.3C-14.4,47.5,-28.9,61.3,-38.4,61.1C-48,61,-52.6,47,-49.6,34.5C-46.6,22,-36,11,-35,0.6C-34,-9.9,-42.6,-19.7,-43.4,-28.4C-44.1,-37,-37,-44.4,-28.5,-44.1C-20,-43.8,-10,-35.7,0.8,-37C11.5,-38.3,23,-49,32,-49.6Z" transform="translate(100 100)"></path>
                            </svg>
                            <div class="card-content">
                              <span>{{ $clickedUser->portfolios->count() }}</span>
                              <p>نمونه کار ثبت شده</p>
                            </div>
                        </div>                        
                          <!-- کارت ۳ -->
                        <div class="card History">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                              <path d="M23.7,-37.5C31.1,-36.8,37.9,-31.3,39.7,-24.2C41.4,-17.2,38.1,-8.6,42.9,2.7C47.6,14.1,60.3,28.1,58.4,34.9C56.6,41.8,40.1,41.4,28,43.9C15.8,46.4,7.9,51.7,-0.1,51.9C-8.1,52,-16.1,47,-21.8,40.7C-27.5,34.5,-30.8,27.1,-31.6,20.1C-32.5,13.1,-30.9,6.6,-32,-0.6C-33.1,-7.8,-36.8,-15.6,-37.9,-25.9C-38.9,-36.2,-37.3,-48.9,-30.5,-50.1C-23.7,-51.3,-11.9,-40.9,-1.9,-37.6C8.1,-34.4,16.3,-38.3,23.7,-37.5Z" transform="translate(100 100)"></path>
                            </svg>
                            <div class="card-content">
                              <span>3</span>
                              <p>سال سابقه در التا</p>
                            </div>
                        </div>
                    </div>
                    <div class="left-card-bottom">
                        <div class="ad-info-container" style="direction: rtl;">
                                <!-- عنوان آگهی -->
                                <div class="ad-header mb-4 d-flex justify-content-between">
                                    <h4 dir='rtl' class="ad-title mb-3">
                                        <i class="fa-solid fa-bullhorn" style="color: #ffd700; margin-left: 10px;"></i>
                                        {{ $item->title }}
                                    </h4>
                                    @if($item->user_id)
                                        <a href="{{ url('chatify/' . $item->user_id . '?project_id=' . $item->id) }}" 
                                           class="project-chat-btn" 
                                           style="margin-right: 15px; text-decoration: none;">
                                            <button type="button" style="
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 8px;
                                                padding: 10px 20px;
                                                background: linear-gradient(135deg, #27AE60, #2ECC71);
                                                color: white;
                                                border: none;
                                                border-radius: 25px;
                                                font-size: 14px;
                                                font-weight: 600;
                                                cursor: pointer;
                                                transition: all 0.3s ease;
                                                box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
                                            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(39, 174, 96, 0.4)';" 
                                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(39, 174, 96, 0.3)';">
                                                <i class="fa-solid fa-comments" style="font-size: 16px;"></i>
                                                <span style="white-space: nowrap;">ارسال پیشنهاد</span>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <hr class="section-divider">

                                <!-- عکس اصلی آگهی -->
                                @if($item->mainImage)
                                    <div class="main-image-wrapper mb-4">
                                        <div class="main-image-container" onclick="openImageGallery(0)">
                                            <img src="{{ asset('storage/' . $item->mainImage->image_path) }}" 
                                                 alt="{{ $item->title }}" 
                                                 class="main-image">
                                            <div class="image-overlay">
                                                <i class="fa-solid fa-expand"></i>
                                                <span>برای مشاهده بزرگ کلیک کنید</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- گالری عکس‌های دیگر -->
                                @if($item->images && $item->images->count() > 0)
                                    @php
                                        $allImages = collect();
                                        if($item->mainImage) {
                                            $allImages->push($item->mainImage);
                                        }
                                        foreach($item->images as $img) {
                                            if(!$img->is_main) {
                                                $allImages->push($img);
                                            }
                                        }
                                    @endphp
                                    
                                    @if($allImages->count() > 1 || ($item->mainImage && $item->images->where('is_main', false)->count() > 0))
                                        <div class="gallery-container mb-4">
                                            <h6 class="gallery-title mb-3">
                                                <i class="fa-solid fa-images" style="color: #ffd700; margin-left: 8px;"></i>
                                                <b>گالری تصاویر</b>
                                                <span class="image-count">({{ $allImages->count() }} تصویر)</span>
                                            </h6>
                                            <div class="image-gallery">
                                                @foreach($allImages as $index => $image)
                                                    <div class="gallery-item" onclick="openImageGallery({{ $index }})">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                             alt="گالری تصویر" 
                                                             class="gallery-thumbnail">
                                                        <div class="gallery-overlay">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr class="section-divider">
                                    @endif
                                @endif

                                <!-- اطلاعات آگهی -->
                                <div class="ad-details">
                                    <div class="info-item">
                                        <div class="info-icon service-icon">
                                            <i class="fa-solid fa-tag"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6 class="info-label">نوع سرویس</h6>
                                            <p class="info-value">{{ $item->service_type ?? 'ثبت نشده' }}</p>
                                        </div>
                                    </div>

                                    @if($item->price)
                                        <div class="info-item">
                                            <div class="info-icon price-icon">
                                                <i class="fa-solid fa-wallet"></i>
                                            </div>
                                            <div class="info-content">
                                                <h6 class="info-label">قیمت</h6>
                                                <p class="info-value price-value">

                                                        از {{ $item->price  }} <span class="price-label"></span>

                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <hr class="section-divider">
                                
                                <!-- توضیحات آگهی -->
                                <div class="description-section">
                                    <h5 class="section-title">
                                        <i class="fa-solid fa-file-lines" style="color: #ffd700; margin-left: 10px;"></i>
                                        توضیحات آگهی
                                    </h5>
                                    <div class="description-content" id="aboutText">
                                        <p>{{ $item->description ?? 'توضیحاتی ثبت نشده است.' }}</p>
                                    </div>
                                    <label class="container-more mb-3" id="toggleAbout">
                                      <input type="checkbox" id="aboutToggleCheck">
                                      <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="chevron-down">
                                          <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                                      </svg>
                                    </label>   
                                </div>
                            </div>
                            <hr class="section-divider m-0">

                        @if($similarAds->isNotEmpty())
                            <h4 dir="rtl" class="ad-title mt-4"><i class="bi bi-badge-ad" style="color: #ffd700; margin-left: 10px;"></i>آگهی های مشابه</h4>
                            @foreach($similarAds as $similarAd)
                                @php
                                    $isDistinguished = $similarAd->tags->contains(fn($tag) => $tag->name === 'متمایز');
                                @endphp
                                <a href="{{ url('/content?type=ad&id=' . $similarAd->id) }}" style="text-decoration:none; color:inherit;">
                                    <div class="card-advertisement {{ $isDistinguished ? 'distinguished-card' : '' }}" dir='rtl'>
                                        @php
                                            $mainImage = $similarAd->images->firstWhere('is_main', true);
                                        @endphp
                                        <div class="card-header-advertisement">
                                            <img 
                                                src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" 
                                                class="image-advertisement"
                                            >
                                        </div>
                                        <div class="card-body-top">
                                            <span class="services-tags">
                                                {{ $similarAd->user->username }}@
                                            </span>
                                            <div class="add-contact" data-user-id="{{ $similarAd->user->id }}">
                                                @if ($similarAd->user->is_favorite)
                                                    <i class="fa-solid fa-user-check icon-anim"></i>
                                                @else
                                                    <i class="fa-solid fa-user-plus icon-anim"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body-advertisement">
                                            <h5>{{ $similarAd->title }}</h5>
                                            <h6>{{ $similarAd->service_type }}</h6>
                                            <p style="min-height: 113px">
                                                {!! nl2br(e(Str::limit($similarAd->description, 200))) !!}
                                            </p>
                                        </div>
                                        <div class="card-body-bottom">
                                            <h6>
                                                از {{ $similarAd->price }}<span class="price-label"></span>
                                            </h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </a>
                        @endif
                @endif
            </div>
        @endif
    </div>
<script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div id="overlay" class="overlay"></div>
    
    <!-- مودال گالری عکس‌ها -->
    <div id="imageGalleryModal" class="gallery-modal">
        <div class="gallery-modal-overlay" onclick="closeImageGallery()"></div>
        <div class="gallery-modal-content">
            <button class="gallery-close-btn" onclick="closeImageGallery()">
                <i class="fa-solid fa-times"></i>
            </button>
            <button class="gallery-nav-btn gallery-prev" onclick="changeImage(-1)">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <button class="gallery-nav-btn gallery-next" onclick="changeImage(1)">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="gallery-image-wrapper">
                <img id="galleryMainImage" class="gallery-main-image" src="" alt="گالری تصویر">
                <div class="gallery-loader">
                    <div class="loader-spinner"></div>
                </div>
            </div>
            <div class="gallery-info">
                <span id="galleryImageCounter" class="image-counter"></span>
            </div>
            <div class="gallery-thumbnails-container">
                <div id="galleryThumbnails" class="gallery-thumbnails"></div>
            </div>
        </div>
    </div>
    
    <script>
   
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

    const available = box.clientWidth * 0.95;
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

window.addEventListener('resize', updateAll);

        const check = document.getElementById("aboutToggleCheck");
const aboutText = document.getElementById("aboutText");
const toggleAbout = document.getElementById("toggleAbout");

const collapsedHeight = 130; // ارتفاع بسته (دو خط)

function expand() {
    aboutText.style.maxHeight = aboutText.scrollHeight + "px";
}

function collapse() {
    aboutText.style.maxHeight = collapsedHeight + "px";
}

// همیشه در ابتدا بسته باشد
collapse();

// چک می‌کنیم آیا متن کوتاه است یا نه
function checkTextLength() {
    // اگر ارتفاع واقعی متن <= ارتفاع دو خط بود → فلش را مخفی کن
    if (aboutText.scrollHeight <= collapsedHeight + 5) {
        toggleAbout.style.display = "none";
    } else {
        toggleAbout.style.display = "flex";
    }
}

checkTextLength();

check.addEventListener("change", () => {
    if (check.checked) {
        expand();
    } else {
        collapse();
    }
});
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const openSidebarBtn = document.getElementById("open-sidebar");
        const closeSidebarBtn = document.getElementById("close-sidebar");
        const navHead = document.querySelector('.header');



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

    document.addEventListener("DOMContentLoaded", function () {
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
    document.addEventListener('DOMContentLoaded', function() {
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

      const userId = "{{ $clickedUser->id ?? auth()->id() }}";

      const baseUrl = `${window.location.origin}/profile/${userId}?ref=share`;
      const encodedUrl = encodeURIComponent(baseUrl);

      const shareLinks = {
        telegram: `https://t.me/share/url?url=${encodedUrl}`,
        whatsapp: `https://api.whatsapp.com/send?text=${encodedUrl}`,
        linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`
      };

      document.querySelectorAll('.social-icon').forEach(icon => {
        icon.addEventListener('click', function(e) {
          e.preventDefault();

          if (icon.classList.contains('copy')) {
            const textArea = document.createElement('textarea');
            textArea.value = baseUrl;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showCopyMessage('لینک پروفایل کپی شد');
          } 
          else if (icon.classList.contains('telegram')) {
            window.open(shareLinks.telegram, '_blank');
          } 
          else if (icon.classList.contains('whatsapp')) {
            window.open(shareLinks.whatsapp, '_blank');
          } 
          else if (icon.classList.contains('linkedin')) {
            window.open(shareLinks.linkedin, '_blank', 'width=600,height=400');
          }
        });
      });
    });
    
    // مدیریت گالری عکس‌ها
    let galleryImages = [];
    let currentImageIndex = 0;
    let touchStartX = 0;
    let touchEndX = 0;
    
    // تابع باز کردن گالری
    function openImageGallery(index) {
        // جمع‌آوری تمام عکس‌ها
        galleryImages = [];
        
        @if($type === 'ad' && !empty($item))
            @php
                $allImages = collect();
                if($item->mainImage) {
                    $allImages->push($item->mainImage);
                }
                foreach($item->images as $img) {
                    if(!$img->is_main) {
                        $allImages->push($img);
                    }
                }
            @endphp
            
            @foreach($allImages as $img)
                galleryImages.push('{{ asset('storage/' . $img->image_path) }}');
            @endforeach
        @endif
        
        if (galleryImages.length === 0) return;
        
        currentImageIndex = Math.max(0, Math.min(index, galleryImages.length - 1));
        
        const modal = document.getElementById('imageGalleryModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        updateGalleryImage();
        updateThumbnails();
    }
    
    // تابع بستن گالری
    function closeImageGallery() {
        const modal = document.getElementById('imageGalleryModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    // تابع تغییر عکس
    function changeImage(direction) {
        if (galleryImages.length === 0) return;
        
        currentImageIndex += direction;
        
        if (currentImageIndex < 0) {
            currentImageIndex = galleryImages.length - 1;
        } else if (currentImageIndex >= galleryImages.length) {
            currentImageIndex = 0;
        }
        
        updateGalleryImage();
        updateThumbnails();
    }
    
    // تابع به‌روزرسانی عکس اصلی
    function updateGalleryImage() {
        const mainImage = document.getElementById('galleryMainImage');
        const loader = document.querySelector('.gallery-loader');
        const counter = document.getElementById('galleryImageCounter');
        
        if (galleryImages.length === 0) return;
        
        loader.classList.add('active');
        mainImage.style.opacity = '0';
        
        const img = new Image();
        img.onload = function() {
            mainImage.src = galleryImages[currentImageIndex];
            mainImage.style.opacity = '1';
            loader.classList.remove('active');
        };
        img.src = galleryImages[currentImageIndex];
        
        counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
    }
    
    // تابع به‌روزرسانی thumbnail ها
    function updateThumbnails() {
        const container = document.getElementById('galleryThumbnails');
        container.innerHTML = '';
        
        galleryImages.forEach((imgSrc, index) => {
            const thumbItem = document.createElement('div');
            thumbItem.className = 'gallery-thumbnail-item' + (index === currentImageIndex ? ' active' : '');
            thumbItem.onclick = () => {
                currentImageIndex = index;
                updateGalleryImage();
                updateThumbnails();
            };
            
            const thumbImg = document.createElement('img');
            thumbImg.src = imgSrc;
            thumbImg.alt = `تصویر ${index + 1}`;
            
            thumbItem.appendChild(thumbImg);
            container.appendChild(thumbItem);
        });
    }
    
    // مدیریت کلیدهای کیبورد
    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('imageGalleryModal');
        if (!modal.classList.contains('active')) return;
        
        if (event.key === 'Escape') {
            closeImageGallery();
        } else if (event.key === 'ArrowRight' || event.key === 'ArrowLeft') {
            event.preventDefault();
            changeImage(event.key === 'ArrowRight' ? -1 : 1);
        }
    });
    
    // مدیریت swipe برای موبایل
    const galleryImageWrapper = document.querySelector('.gallery-image-wrapper');
    if (galleryImageWrapper) {
        galleryImageWrapper.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        galleryImageWrapper.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe right (next image)
                changeImage(1);
            } else {
                // Swipe left (previous image)
                changeImage(-1);
            }
        }
    }
    
    // بستن مودال با کلیک روی overlay
    document.querySelector('.gallery-modal-overlay')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageGallery();
        }
    });

    
document.querySelectorAll('.add-contact').forEach(function(btn) {
    btn.addEventListener('click', function(event) {

        // جلوگیری 100% از کلیک لینک
        event.preventDefault();
        event.stopPropagation();

        var userId = this.getAttribute('data-user-id');
        var icon = this.querySelector('i');
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
                body: JSON.stringify({ favorite_id: userId })
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

            });
        }, 150);
    });
});

    </script>

</body>
</html>