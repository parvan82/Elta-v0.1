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

    <style>

/* اسکرول بار باریک و راست */
.employer-projects-scroll::-webkit-scrollbar {
    width: 5px; /* عرض باریک‌تر */
}

.employer-projects-scroll::-webkit-scrollbar-track {
    background: #2c2c2c; /* رنگ پس‌زمینه مسیر اسکرول */
    border-radius: 10px;
}

.employer-projects-scroll::-webkit-scrollbar-thumb {
    background: #888; /* رنگ خود اسکرول */
    border-radius: 10px;
}

.employer-projects-scroll::-webkit-scrollbar-thumb:hover {
    background: #555; /* رنگ هنگام هاور */
}

/* برای فایرفاکس */
.employer-projects-scroll {
    scrollbar-width: thin;
    scrollbar-color: #888 #2c2c2c;
}
            .search-card-skill {
    grid-area: skills;
    display: flex;
    gap: 5px;
    direction: rtl;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 5px;
    min-width: 0; /* برای ellipsis */
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}
            .more-tag{
                height: 27px;
                width: 27px;
                padding: 5px  !important;
            }
.employer-projects-scroll {
max-height: 790px;
    overflow-y: auto;
    overflow-x: hidden;
    margin-right: -15px;
    padding-right: 10px;
    direction: ltr;

}
.employer-projects-scroll .eltaCard .search-card-tags{
    display: none;
}
.employer-projects-scroll .eltaCard .search-name{
    top: 10px;
    right: 15px;
    max-width: calc(100% - 30px);
}
.employer-projects-scroll .eltaCard .priority-info {
    bottom: 30px;
    direction: ltr;
    right: 15px;
}
.employer-projects-scroll .eltaCard .search-scope-work{
        top: 45px;
    right: 15px;
}
.employer-projects-scroll .eltaCard .search-about-me{
    top: 85px;
}
        html{
            height: 100%;
        }
        body{
            height: 100%;
        }
        .left-card{
            height: calc(100% - 90%);        
        }
        
        
        .card-advertisement {
            position: relative; /* والد مطلق برای هدر */
            width: calc(100% - 7%);
            height: 270px;
            background-color: #444;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px 20px;
            color: #fff;
            overflow: visible; /* مهم: اجازه می‌دهد هدر بیرون بزنه */
        }

.card-header-advertisement {
    position: absolute; /* مطلق برای بیرون زدگی */
    top: 50%; /* وسط عمودی کارت */
    right: -24px; /* بیرون زدن از سمت راست */
    width: 200px;
    height: calc(100% - 10%);
    border-radius: 16px;
    overflow: hidden;
    transform: translateY(-50%); /* وسط دقیق عمودی */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 2; /* روی کارت باشد */
}

.image-advertisement {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* کارت بادی و فوتر */
.card-body-advertisement {
    padding-left: 10px;
    padding-right: 190px;
    text-align: right;
}


.card-body-advertisement h5 {
    margin: 0 0 8px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
         overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    white-space: normal;
}

.card-body-advertisement p {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 1.5;
    color: #ddd;
     overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    white-space: normal;

}

.card-body-top {
    display: flex;
    justify-content: space-between;
    padding: 15px 190px 7px 20px;
}
.card-body-bottom {
    margin-top: 15px;
    text-align: right;
    padding-right: 190px;
    position: absolute;
    bottom: 15px;
}
.distinguished-card {
    background: #666666;
    backdrop-filter: blur(10px);
    border: 2px solid #333;
    box-shadow: 0 0 25px rgb(0, 0, 0) !important;
    border-radius: 10px;
}
.distinguished-card .card-header-advertisement {
    border: 2px solid #333;
}

.services-tags {
    padding: 4px 8px;
    border: 2px solid #999;
    border-radius: 50px;
    color: #b7b7b7;
    font-size: 12px;
}
.card-body-bottom br{
    display:none;
}
.more-tag {
    padding: 6px !important;
    font-size: 10px;
    border-radius: 50px;
    height:30px;
    width: 30px;
    border: #7c0000f7 solid 2px;
    background-color: #ff000055;
}
.search-card-tags{
    margin-right: 70px;
}

.likes:hover {
    background-color: rgba(255, 0, 0, 0.616);
}
        /* ریسپانسیو برای کارت‌های آگهی مشابه */
        @media (max-width: 768px) {

            .card-advertisement {
                width: 100%;
                height: auto;
                margin: 15px auto;
            }

            .card-header-advertisement {
                position: relative;
                top: 0;
                right: 0;
                width: 100%;
                height: 180px;
                margin-bottom: 10px;
                transform: none;
                border-radius: 10px 10px 0 0;
            }
            .distinguished-card .card-header-advertisement{
                border: none;
                border-bottom: 2px solid #333;
            }

            .card-body-advertisement {
                padding: 12px 15px 10px 15px;
            }

            .card-body-top {
                padding: 10px 15px 5px 15px;
            }

            .card-body-bottom {
                position: static;
                padding: 10px 15px 15px 15px;
                margin-top: 5px;
            }
        }
@media (max-width:640px) {

.card-body-bottom br{
    display:block;
}
}
@media (max-width: 427px) {
    .search-card-tags {
        margin-right: 0px;
    }
}
@media (max-width:640px) {

    .eltaCard{
        margin: 10px 0px !important;
    }

}
@media (max-width:340px) {
    .search-name{
        right: 15px;
    }
    .eltaCard{
        margin: 35px 10px !important;
    }
    .search-card-tags{
    margin-right: 0px;
}
    .search-image-container{
        display: none;
    }
}
    </style>
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
                <div class="left-card">
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
@if ($clickedUser->role === 'freelancer')

    <h4 class="select-search-name">{{ $clickedUser->name }}</h4>

@elseif ($clickedUser->role === 'employer')

    <h4 class="select-search-name">
        {{ optional($clickedUser->companies)->company_name ?? 'نام شرکت ثبت نشده' }}
    </h4>

@endif


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
                            		<div class="username">{{$clickedUser->name ?? 'نام کاربر' }}</div>
                            		<div class="lable-message"> ارسال پیام</div>
                            		<div class="user-id">@ {{ $clickedUser->username }}</div>
                            	</div>
                            </button>
                            </a>

                        </div>                        
@if ($clickedUser->role === 'freelancer')


                        <div class="Statistics-card-container">

                            <div class="card success">
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M20.5,-37.9C26.5,-32,31.4,-26.5,40.2,-20.2C49,-13.9,61.9,-7,63,0.6C64.1,8.2,53.4,16.5,43,20C32.6,23.5,22.4,22.3,15.3,26.4C8.1,30.4,4.1,39.7,-2.8,44.6C-9.8,49.5,-19.5,50.1,-31.5,48.9C-43.5,47.7,-57.8,44.6,-60.7,36.2C-63.7,27.7,-55.3,13.9,-44.2,6.4C-33.1,-1,-19.2,-2.1,-14.2,-7C-9.2,-11.9,-13.1,-20.7,-12.3,-29.6C-11.4,-38.4,-5.7,-47.3,0.8,-48.7C7.2,-50,14.5,-43.8,20.5,-37.9Z" transform="translate(100 100)" />
                                </svg>
                                <div class="card-content">
                                  <span>10</span>
                                  <p>پروژه موفق</p>
                                </div>
                            </div>                        

                              <!-- کارت ۲ -->
                            <div class="card open">
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M32,-49.6C41.1,-50.3,47.7,-40.8,55.1,-30.8C62.5,-20.9,70.8,-10.4,65.7,-3C60.5,4.5,42,9,35.3,20.3C28.6,31.5,33.8,49.6,29.9,52.9C26,56.3,13,45,-0.7,46.3C-14.4,47.5,-28.9,61.3,-38.4,61.1C-48,61,-52.6,47,-49.6,34.5C-46.6,22,-36,11,-35,0.6C-34,-9.9,-42.6,-19.7,-43.4,-28.4C-44.1,-37,-37,-44.4,-28.5,-44.1C-20,-43.8,-10,-35.7,0.8,-37C11.5,-38.3,23,-49,32,-49.6Z" transform="translate(100 100)" />
                                </svg>
                                <div class="card-content">
                                  <span>2</span>
                                  <p>پروژه باز</p>
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

                        <div class="mobile-left-card-bottom">
                            <h4 dir="rtl" class="ad-title mt-4"><i class="bi bi-person-circle" style="color: #ffd700; margin-left: 10px;"></i>اطلاعات فردی</h4>
                            <div class="pr-4 info-container-personal" >
                                <span class="d-flex mx-3 my-2">
                                    <h6 style=" padding:0px 5px"><b>سن:</b></h6>
                                    <h6>22 سال</h6>
                                </span>
                                <span class="d-flex mx-3 my-2">
                                    <h6 style=" padding:0px 5px"><b>وضعیت نظام وظیفه:</b></h6>
                                    <h6>{{ $clickedUser->personalInformation->military_status ?? 'ثبت نشده' }}</h6>
                                </span>
                                <span class="d-flex mx-3 my-2">
                                    <h6 style=" padding:0px 5px"><b>تحصیلات:</b></h6>
                                    @forelse($clickedUser->educationalHistories ?? [] as $edu)
                                        <h6>{{ $edu->degree }} - {{ $edu->major }}</h6>
                                    @empty
                                        <h6>ثبت نشده</h6>
                                    @endforelse
                                </span>
                            </div>

                            <hr class="section-divider">

                            <h4 dir="rtl" class="ad-title">
                                <i class="bi bi-translate" style="color: #ffd700; margin-left: 10px;"></i>
                                سطح زبان
                            </h4>                            
                            <div class="d-flex mr-4" style="direction: rtl; gap:10px; flex-wrap: wrap; ">
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

                            <hr class="section-divider">

                            <h4 dir="rtl" class="ad-title">
                                <i class="bi bi-tools" style="color: #ffd700; margin-left: 10px;"></i>
                                مهارت ها
                            </h4>
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
                                    <div class="d-flex mr-4" style="width: 100%; margin: 30px;display: flex;justify-content:center;padding: 15px;background: #666;border-radius: 12px;box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);transition: transform 0.2s ease, box-shadow 0.2s ease;border: 1px solid rgba(255, 255, 255, 0.1);color: white;">
                                        <p>ثبت نشده</p>
                                    </div>

                                @endforelse
                            </div>

                            <hr class="section-divider">

                            <div class="d-flex justify-content-between px-3" style="direction: rtl;">
                            <h4 dir="rtl" class="ad-title mr-0">
                                <i class="bi bi-columns-gap" style="color: #ffd700; margin-left: 10px;"></i>
                                نمونه کار
                            </h4>
                            <h4 class="ad-title" style="font-size: 14px; white-space: break-spaces; font-weight: 0;"><b> {{ count($clickedUser->portfolios ?? []) }}</b> پروژه ثبت شده است</h4>
                            </div>
                            
                            
                            <div class="portfolio-container @if(($clickedUser->portfolios ?? collect())->isEmpty()) overflow-hidden @endif" @if(($clickedUser->portfolios ?? collect())->isEmpty()) style="display: flex; justify-content: center;" @endif>
                                @forelse($clickedUser->portfolios ?? [] as $portfolio)
                                    <div class="main">
                                        <div class="portfolios_card">
                                            {{-- ✅ بررسی وجود فایل یا لینک --}}
                                            @php
                                                $file = $portfolio->file;
                                                $link = $portfolio->link;
                                                $file_extension = $file ? strtolower(pathinfo($file, PATHINFO_EXTENSION)) : null;           
                                        
                                                // نوع فایل برای آیکون
                                                switch(true) {
                                                    case in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']):
                                                        $file_icon = 'fa-solid fa-image';
                                                        break;
                                                    case in_array($file_extension, ['mp4', 'webm', 'ogg']):
                                                        $file_icon = 'fa-solid fa-video';
                                                        break;
                                                    case in_array($file_extension, ['mp3', 'wav', 'ogg']):
                                                        $file_icon = 'fa-solid fa-music';
                                                        break;
                                                    case $file_extension === 'html':
                                                        $file_icon = 'fa-brands fa-html5';
                                                        break;
                                                    case $file_extension === 'pdf':
                                                        $file_icon = 'fa-solid fa-file-pdf';
                                                        break;
                                                    case $file_extension === 'doc' || $file_extension === 'docx':
                                                        $file_icon = 'fa-solid fa-file-word';
                                                        break;
                                                    case $file_extension === 'zip' || $file_extension === 'rar':
                                                        $file_icon = 'fa-solid fa-file-zipper';
                                                        break;
                                                    default:
                                                        $file_icon = 'fa-solid fa-file'; // فایل ناشناس
                                                        break;
                                                }
                                            @endphp

                                            @if($file_extension && in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <img src="{{ asset($file) }}" class="img-fluid" alt="{{ $portfolio->title }}" style="width:100%; height:100%; object-fit:cover; border-radius:7px;">
                                            @elseif($file_extension && in_array($file_extension, ['mp4', 'webm', 'ogg']))
                                                <video controls style="width:100%; height:100%; object-fit:cover; border-radius:7px;">
                                                    <source src="{{ asset($file) }}" type="video/{{ $file_extension }}">
                                                    مرورگر شما از ویدیو پشتیبانی نمی‌کند.
                                                </video>
                                            @elseif($file_extension && in_array($file_extension, ['mp3', 'wav', 'ogg']))
                                                            <div class="unsupported-file">
                                                            
                                                <audio controls style="width:100%;">
                                                    <source src="{{ asset($file) }}" type="audio/{{ $file_extension }}">
                                                    مرورگر شما از صوت پشتیبانی نمی‌کند.
                                                </audio>
                                                                </div>
                                                            
                                            @elseif($file_extension === 'html')
                                                <iframe src="{{ asset($file) }}" scrolling="no" class="iframe-preview"></iframe>
                                            @else
                                                <div class="unsupported-file">
                                                    <i class="fa-solid fa-file"></i>
                                                </div>
                                            @endif
                                            
                                            {{-- آیکون تمام‌صفحه --}}
                                            <div class="visit">
                                              <button class="fullscreen-btn" onclick="goToPortfolio({{ $portfolio->id }})">
                                                  <span class="tooltip">مشاهده پروژه</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 96C239.2 96 174.5 132.8 127.4 176.6C80.6 220.1 49.3 272 34.4 307.7C31.1 315.6 31.1 324.4 34.4 332.3C49.3 368 80.6 420 127.4 463.4C174.5 507.1 239.2 544 320 544C400.8 544 465.5 507.2 512.6 463.4C559.4 419.9 590.7 368 605.6 332.3C608.9 324.4 608.9 315.6 605.6 307.7C590.7 272 559.4 220 512.6 176.6C465.5 132.9 400.8 96 320 96zM176 320C176 240.5 240.5 176 320 176C399.5 176 464 240.5 464 320C464 399.5 399.5 464 320 464C240.5 464 176 399.5 176 320zM320 256C320 291.3 291.3 320 256 320C244.5 320 233.7 317 224.3 311.6C223.3 322.5 224.2 333.7 227.2 344.8C240.9 396 293.6 426.4 344.8 412.7C396 399 426.4 346.3 412.7 295.1C400.5 249.4 357.2 220.3 311.6 224.3C316.9 233.6 320 244.4 320 256z"/></svg>
                                              </button>
                                            </div>
                                        
                                            <div class="fl">
                                                <button class="fullscreen-btn" onclick="openFile('{{ asset($file) }}')">
                                                  <span class="tooltip">تمام صفحه</span>
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                                    <path d="M128 96C110.3 96 96 110.3 96 128L96 224C96 241.7 110.3 256 128 256C145.7 256 160 241.7 160 224L160 160L224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L128 96zM160 416C160 398.3 145.7 384 128 384C110.3 384 96 398.3 96 416L96 512C96 529.7 110.3 544 128 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480L160 416zM416 96C398.3 96 384 110.3 384 128C384 145.7 398.3 160 416 160L480 160L480 224C480 241.7 494.3 256 512 256C529.7 256 544 241.7 544 224L544 128C544 110.3 529.7 96 512 96L416 96zM544 416C544 398.3 529.7 384 512 384C494.3 384 480 398.3 480 416L480 480L416 480C398.3 480 384 494.3 384 512C384 529.7 398.3 544 416 544L512 544C529.7 544 544 529.7 544 512L544 416z"/>
                                                  </svg>
                                                </button>
                                            </div>
                                        
                                            <div class="portfolios_card_back"></div>
                                        </div>
                                    
                                        {{-- اطلاعات پورتفولیو --}}
                                        <div class="data">
                                            <div class="img">
                                                <i class="{{ $file_icon }}"></i>
                                            </div>
                                            <div class="portfolios_text">
                                                <div class="text_m">{{ $portfolio->title }}</div>
                                                <div class="text_s">{{ $portfolio->description }}</div>
                                            </div>
                                        </div>
                                    
                                        {{-- بخش دکمه‌ها --}}
                                        <div class="btns">
                                            <div class="likes {{ $portfolio->isLikedBy(auth()->user()) ? 'active' : '' }}" data-id="{{ $portfolio->id }}">
                                                <div class="con-like">
                                                    <input class="like" type="checkbox" {{ $portfolio->isLikedBy(auth()->user()) ? 'checked' : '' }}>
                                                    <div class="checkmark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24" style="outline-style: none !important;">
                                                          <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                                          <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"></path>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                                                          <polygon class="poly" points="10,10 20,20"></polygon>
                                                          <polygon class="poly" points="10,50 20,50"></polygon>
                                                          <polygon class="poly" points="20,80 30,70"></polygon>
                                                          <polygon class="poly" points="90,10 80,20"></polygon>
                                                          <polygon class="poly" points="90,50 80,50"></polygon>
                                                          <polygon class="poly" points="80,80 70,70"></polygon>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <span class="likes_text">{{ $portfolio->likes()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <div class="portfolio-empty">
                                    نمونه کار ثبت نشده است
                                </div>
                                @endforelse

                            </div>

                            <hr class="section-divider">
                                          
                            <div class="d-flex justify-content-between px-3" style="direction: rtl;">
                                <h4 dir="rtl" class="ad-title mr-0">
                                    <i class="bi bi-badge-ad" style="color: #ffd700; margin-left: 10px;"></i>
                                    آگهی ها
                                </h4>
                                <h4 class="ad-title" style="font-size: 14px; white-space: break-spaces; font-weight: 0;"><b>{{ count($userAds  ?? []) }}</b> آگهی ثبت شده است </h4>
                            </div>
                            
                            
                            <div class="portfolio-container  @if(($clickedUser->portfolios ?? collect())->isEmpty()) overflow-hidden @endif" @if(($clickedUser->portfolios ?? collect())->isEmpty()) style="display: flex; justify-content: center;" @endif>

                                @forelse($userAds  as $ad)
                                    @php
                                        $isDistinguished = $ad->tags->contains(fn($tag) => $tag->name === 'متمایز');
                                    @endphp                                             
                                    <a class="user-card-link"  href="{{ url('/content?type=ad&id=' . $ad->id) }}" style="text-decoration:none; color:inherit;">
                                        <div class="card-advertisement {{ $isDistinguished ? 'distinguished-card' : '' }}" dir='rtl'>                                               


                                                <!-- هدر کارت: تصویر اصلی -->
                                                @php
                                                    $mainImage = $ad->images->firstWhere('is_main', true);
                                                @endphp
                                                <div class="card-header-advertisement">
                                                    <img 
                                                        src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" 
                                                        class="image-advertisement"
                                                    >
                                                </div>                                              

                                                <!-- بخش بالای کارت: تگ‌ها -->
                                                <div class="card-body-top">
                                                            <span class="services-tags">
                                                                {{ $ad->user->username }}@
                                                            </span>
                                                    <i class="fa-solid fa-user-plus"></i>
                                                </div>                                              

                                                <!-- بدنه کارت -->
                                                <div class="card-body-advertisement">
                                                    <h5>{{ $ad->title }}</h5>
                                                    <h6>{{ $ad->service_type }}</h6>
                                                    <p style="min-height: 113px">{!! nl2br(e(Str::limit($ad->description, 200))) !!}</p>
                                                </div>                                              

                                                <!-- فوتر کارت: قیمت -->
                                                <div class="card-body-bottom">
                                                    <h6>
                                                        از {{ $ad->price  }}
                                                        <br >
                                                        تا {{ $ad->price_hight }}
                                                    </h6>
                                                </div>                                              

                                        </div>
                                    </a>
                                @empty
                                      <div class="portfolio-empty">
                                        <div class="portfolio-empty-title">آگهی ثبت نشده است</div>
                                      </div>
                                @endforelse
                            </div>
    @if(!empty($similarUsers) && $similarUsers->count())

                            <hr class="section-divider">

                            <div class="d-flex justify-content-between px-3" style="direction: rtl;">
                                <h4 dir="rtl" class="ad-title mr-0">
                                    <i class="bi bi-person-vcard" style="color: #ffd700; margin-left: 10px;"></i>
                                    فریلنسر های مشابه
                                </h4>
                            </div>

                            @endif
                            @foreach($similarUsers as $user)


                            <a class="user-card-link" href="{{ url('/profile/' . $user->id) }}"style="text-decoration:none; color:inherit;">
                                    <div class="eltaCard m-5" style="box-shadow: 0 0 20px #444; cursor: pointer;">
                                        <div class="search-elta-card">
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
                                            <div class="search-card-skill" style="display:flex; flex-wrap: wrap; gap:8px; direction: rtl;">
                                                @foreach ($user->skills as $skill)
                                                    <h6 class="userSkill-search-card">{{ $skill }}</h6>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </a>      
                            @endforeach

                        </div>
@elseif ($clickedUser->role === 'employer')

                        <div class="Statistics-card-container">

                            <div class="card success">
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M20.5,-37.9C26.5,-32,31.4,-26.5,40.2,-20.2C49,-13.9,61.9,-7,63,0.6C64.1,8.2,53.4,16.5,43,20C32.6,23.5,22.4,22.3,15.3,26.4C8.1,30.4,4.1,39.7,-2.8,44.6C-9.8,49.5,-19.5,50.1,-31.5,48.9C-43.5,47.7,-57.8,44.6,-60.7,36.2C-63.7,27.7,-55.3,13.9,-44.2,6.4C-33.1,-1,-19.2,-2.1,-14.2,-7C-9.2,-11.9,-13.1,-20.7,-12.3,-29.6C-11.4,-38.4,-5.7,-47.3,0.8,-48.7C7.2,-50,14.5,-43.8,20.5,-37.9Z" transform="translate(100 100)" />
                                </svg>
                                <div class="card-content">
                                  <span>{{ $clickedUser->companies->established_year ?? 'ثبت نشده' }}</span>
                                  <p>سال تاسیس</p>
                                </div>
                            </div>                        

                              <!-- کارت ۲ -->
                            <div class="card open">
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M32,-49.6C41.1,-50.3,47.7,-40.8,55.1,-30.8C62.5,-20.9,70.8,-10.4,65.7,-3C60.5,4.5,42,9,35.3,20.3C28.6,31.5,33.8,49.6,29.9,52.9C26,56.3,13,45,-0.7,46.3C-14.4,47.5,-28.9,61.3,-38.4,61.1C-48,61,-52.6,47,-49.6,34.5C-46.6,22,-36,11,-35,0.6C-34,-9.9,-42.6,-19.7,-43.4,-28.4C-44.1,-37,-37,-44.4,-28.5,-44.1C-20,-43.8,-10,-35.7,0.8,-37C11.5,-38.3,23,-49,32,-49.6Z" transform="translate(100 100)" />
                                </svg>
                                <div class="card-content">
                                  <span style="font-size: 2em;">{{ $clickedUser->companies->company_type ?? 'ثبت نشده' }}</span>
                                  <p>نوع مالکیت</p>
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

                        <div class="mobile-left-card-bottom">
                            
    {{-- ================= وقتی کاربر کلیک شده ================= --}}
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
                    <i class="bi bi-tools" style="color: #ffd700; margin-left: 8px;"></i>
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
                    <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                </svg>
            </label>   

        </div>

        {{-- -------------------- پروژه‌های ثبت شده توسط کارفرما -------------------- --}}
        @php
    $employerProjects = $clickedUser->NewProject ?? collect();
@endphp

@if($employerProjects->count())
    <hr class="section-divider">
    <h4 dir="rtl" class="ad-title mt-4"><i class="bi bi-kanban" style="color: #ffd700; margin-left: 10px;"></i>{{$employerProjects->count()}} پروژه ثبت شده توسط {{ $clickedUser->companies->company_name }}</h4>

    <h4 class="mb-4 text-white">
    </h4>

    {{-- کادر با اسکرول --}}
        @foreach ($employerProjects as $project)
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

    @if(!empty($similarEmployers) && $similarEmployers->count())
    <hr class="section-divider">
    <h4 dir="rtl" class="ad-title mt-4 mb-5"><i class="bi bi-person-video2" style="color: #ffd700; margin-left: 10px;"></i>کارفرماهای مشابه</h4>
    @foreach($similarEmployers as $employer)

        <a class="user-card-link" href="/profile/{{ $employer->id }}" style="text-decoration:none; color:inherit;">

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
                        <p class="search-about-me">{{ $clickedUser->companies->company_info ?? 'توضیحاتی ثبت نشده است.' }}</p>
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
                        @endif
                </div>
    </div>
<script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div id="overlay" class="overlay"></div>
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

document.addEventListener("DOMContentLoaded", () => {

    const check = document.getElementById("aboutToggleCheck");
    const aboutText = document.getElementById("aboutText");
    const toggleAbout = document.getElementById("toggleAbout");

    // اگر هرکدوم نبود → ادامه نده
    if (!check || !aboutText || !toggleAbout) {
        return; // صفحه فریلنسر است → این بخش را رد کن
    }

    const collapsedHeight = 130;

    function expand() {
        aboutText.style.maxHeight = aboutText.scrollHeight + "px";
    }

    function collapse() {
        aboutText.style.maxHeight = collapsedHeight + "px";
    }

    collapse();

    function checkTextLength() {
        if (aboutText.scrollHeight <= collapsedHeight + 5) {
            toggleAbout.style.display = "none";
        } else {
            toggleAbout.style.display = "flex";
        }
    }

    checkTextLength();

    check.addEventListener("change", () => {
        check.checked ? expand() : collapse();
    });
});


                    document.addEventListener("DOMContentLoaded", () => {
                    const sidebar = document.getElementById("sidebar");
                    const overlay = document.getElementById("overlay");
                    const openSidebarBtn = document.getElementById("open-sidebar");
                    const closeSidebarBtn = document.getElementById("close-sidebar");
                    const navHead = document.querySelector('.header');
                    
                    
                    //sidebar methods
                    
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
            
                function goToPortfolio(id) {
                    window.location.href = `/portfolio/${id}`;
                }
            
                function openFile(url) {
                  const win = window.open(url, '_blank');
                  if (win) win.focus();
                }
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
            
            
                document.querySelectorAll('.likes').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const portfolioId = btn.dataset.id;
                        const likesText = btn.querySelector('.likes_text');
                    
                        fetch(`/portfolio/${portfolioId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if(data.liked){
                                btn.classList.add('active');
                            } else {
                                btn.classList.remove('active');
                            }
                            likesText.textContent = data.likes_count;
                        });
                    });
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