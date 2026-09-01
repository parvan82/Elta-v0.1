<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>home</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/homeMoreStyle.css">
    <link href="{{ asset('css/tooman/css/font.css') }}" rel="stylesheet" type="text/css" />

    <style>
    @media (max-width: 768px) {
            .card-advertisement {
                width: 80px;
                height: auto;
                margin: 15px 20px;
                overflow: hidden;
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
.price-label {
    font-size: 20px;
    margin-top: 2px;
    margin-right: 7px;
}
    </style>
</head>
<body>
<header>
    <section class="nav-head">
        <div class="header">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar">
                <div class="sidebar-header">
                    <div class="header-btn">
                        <button id="close-sidebar" class="closeBtn"><i class="fa-solid fa-xmark" style="font-size: 16px"></i></button>
                        <a href="{{ route('employerProfile') }}?popup=open"><button class="editBtn"><svg height="1em" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg></button></a>
                    </div>
                    
                    <div class="user-info">
                        <p class="name">{{ Auth::user()->companies->company_name }}</p>
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
                        <li><button><a href="{{ route('mobile.profile', ['id' => auth()->user()->id]) }}"><span>سازمان شما</span></a> </button></li>
                        <li><button><a href="{{ route('EltaCard') }}"><span>التا کارت</span></a></button></li>
                        <li><button><a href="#"><span>کیف پول</span></a></button></li>
                    </ul>
                </div>
                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button class="Btn"><div class="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></div><div class="text" id="logout-btn">خروج</div></button>
                    </form>
                    <button class="Btn"><div class="support"><i class="fa-solid fa-headset "></i></div><div class="text" id="support-btn">پشتیبانی</div></button>
                </div>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <div class="left-buttons">
                    <button id="open-sidebar" class="open-btn">☰</button>
                    <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i><span class="notification-bell-badge"></span></a>
                </div>
                <div class="site-name">
                    <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
                </div>
            </div>
        </div>

    </section>

</header>
<main class="mt-5">

    <section>
        <div class="rows">
            <div class="item"> html <img width="50" height="50" src="{{ asset('images/home/html.png') }}" alt="html"/></div>
            <div class="item"> css <img width="50" height="50" src="{{  asset('images/home/css.png') }}" alt="css"/></div>
            <div class="item"> php <img width="50" height="50" src="{{  asset('images/home/php.png') }}" alt="php"/></div>
            <div class="item"> vs code <img width="24" height="24" src="{{  asset('images/home/visual-studio-code-2019.png') }}" alt="visual-studio-code-2019"/></div>
            <div class="item"> python <img width="50" height="50" src="{{  asset('images/home/python.png') }}" alt="python"/></div>
            <div class="item"> c++ <img width="50" height="50" src="{{  asset('images/home/c-plus-plus.png') }}" alt="c-plus-plus"/></div>
            <div class="item"> c# <img width="50" height="50" src="{{  asset('images/home/cs.png') }}" alt="cs"/></div>
            <div class="item"> github <img width="50" height="50" src="{{  asset('images/home/github.png') }}" alt="github"/></div>
            <div class="item"> html <img width="50" height="50" src="{{  asset('images/home/html.png') }}" alt="html"/></div>
        </div>
        <div class="rows">
            <div class="item"> json <img width="50" height="50" src="{{  asset('images/home/json.png') }}" alt="json"/></div>
            <div class="item"> react js <img width="80" height="80" src="{{  asset('images/home/react.png') }}" alt="react"/></div>
            <div class="item"> laravel <img width="50" height="50" src="{{  asset('images/home/laravel.png') }}" alt="laravel"/></div>
            <div class="item"> json <img width="50" height="50" src="{{  asset('images/home/json.png') }}" alt="json"/></div>
            <div class="item"> golang <img width="50" height="50" src="{{  asset('images/home/golang.png') }}" alt="golang"/></div>
            <div class="item"> Kotlin <img width="50" height="50" src="{{  asset('images/home/kotlin.png') }}" alt="kotlin"/></div>
            <div class="item"> java <img width="50" height="50" src="{{  asset('images/home/java-coffee-cup-logo.png') }}" alt="java-coffee-cup-logo"/></div>
            <div class="item"> SQL <img width="50" height="50" src="{{  asset('images/home/sql.png') }}" alt="sql"/></div>
            <div class="item"> postman <img width="64" height="64" src="{{  asset('images/home/postman-api.png') }}" alt="postman-api"/></div>
        </div>
        <div class="rows">
            <div class="item"> SketchUp  <img width="50" height="50" src="{{  asset('images/home/google-sketchup.png') }}" alt="google-sketchup"/></div>
            <div class="item"> ZBrush <img width="100" height="100" src="{{  asset('images/home/zbrush.png') }}" alt="zbrush"/></div>
            <div class="item"> Blender <img width="50" height="50" src="{{  asset('images/home/blender-3d.png') }}" alt="blender-3d"/></div>
            <div class="item"> 3ds Max <img width="50" height="50" src="{{  asset('images/home/3ds-max.png') }}" alt="3ds-max"/></div>
            <div class="item"> Illustrator  <img width="50" height="50" src="{{  asset('images/home/adobe-illustrator--v1.png') }}" alt="adobe-illustrator--v1"/></div>
            <div class="item"> GIMP <img width="50" height="50" src="{{  asset('images/home/gimp.png') }}" alt="gimp"/></div>
            <div class="item"> Krita <img width="50" height="50" src="{{  asset('images/home/krita.png') }}" alt="krita"/></div>
            <div class="item"> After Effects <img width="50" height="50" src="{{  asset('images/home/adobe-after-effects--v1.png') }}" alt="adobe-after-effects--v1"/></div>
            <div class="item"> SketchUp  <img width="50" height="50" src="{{  asset('images/home/google-sketchup.png') }}" alt="google-sketchup"/></div>
        </div>
        <div class="rows">
            <div class="item"> adobe XD <img width="50" height="50" src="{{  asset('images/home/adobe-xd--v1.png') }}" alt="adobe-xd--v1"/> </div>
            <div class="item"> Inkscape <img width="48" height="48" src="{{  asset('images/home/inkscape--v1.png') }}" alt="inkscape--v1"/></div>
            <div class="item"> CorelDRAW <img width="50" height="50" src="{{  asset('images/home/coreldraw.png') }}" alt="coreldraw"/></div>
            <div class="item"> Photoshop <img width="50" height="50" src="{{  asset('images/home/adobe-photoshop--v1.png') }}" alt="adobe-photoshop--v1"/></div>
            <div class="item"> Figma <img width="50" height="50" src="{{  asset('images/home/figma--v1.png') }}" alt="figma--v1"/></div>
            <div class="item"> Framer <img width="50" height="50" src="{{  asset('images/home/framer.png') }}" alt="framer"/></div>
            <div class="item"> Cinema 4D <img width="64" height="64" src="{{  asset('images/home/cinema-4d.png') }}" alt="cinema-4d"/></div>
            <div class="item"> Affinity Designer <img width="50" height="50" src="{{  asset('images/home/affinity-designer.png') }}" alt="affinity-designer"/></div>
            <div class="item"> adobe XD <img width="50" height="50" src="{{  asset('images/home/adobe-xd--v1.png') }}" alt="adobe-xd--v1"/> </div>
        </div>
        <div class="rows">
            <div class="item"> Bitwig Studio <img width="50" height="50" src="{{  asset('images/home/bitwig--v1.png') }}" alt="bitwig--v1"/></div>
            <div class="item"> rekordbox <img width="100" height="100" src="{{  asset('images/home/rekordbox.png') }}" alt="rekordbox"/></div>
            <div class="item"> Logic Pro X <img width="50" height="50" src="{{  asset('images/home/logic-pro-x.png') }}" alt="logic-pro-x"/></div>
            <div class="item"> Bitwig Studio <img width="50" height="50" src="{{  asset('images/home/bitwig--v1.png') }}" alt="bitwig--v1"/></div>
            <div class="item"> Logic Pro X <img width="50" height="50" src="{{  asset('images/home/logic-pro-x.png') }}" alt="logic-pro-x"/></div>
            <div class="item"> FL Studio <img width="50" height="50" src="{{  asset('images/home/fl-studio.png') }}" alt="fl-studio"/></div>
            <div class="item"> GarageBand <img width="50" height="50" src="{{  asset('images/home/garage-band--v2.png') }}" alt="garage-band--v2"/></div>
            <div class="item"> FL Studio <img width="50" height="50" src="{{  asset('images/home/fl-studio.png') }}" alt="fl-studio"/></div>
            <div class="item"> Bitwig Studio <img width="50" height="50" src="{{  asset('images/home/bitwig--v1.png') }}" alt="bitwig--v1"/></div>
        </div>
        <div class="rows">
            <div class="item"> InShot <img width="50" height="50" src="{{  asset('images/home/inshot.png') }}" alt="inshot"/></div>
            <div class="item"> premiere pro <img width="50" height="50" src="{{  asset('images/home/adobe-premiere-pro.png') }}" alt="adobe-premiere-pro"/></div>
            <div class="item"> DaVinci Resolve <img width="50" height="50" src="{{  asset('images/home/davinci-resolve.png') }}" alt="davinci-resolve"/></div>
            <div class="item"> premiere pro <img width="50" height="50" src="{{  asset('images/home/adobe-premiere-pro.png') }}" alt="adobe-premiere-pro"/></div>
            <div class="item"> Final Cut Pro X <img width="100" height="100" src="{{  asset('images/home/final-cut-pro-x.png') }}" alt="final-cut-pro-x"/></div>
            <div class="item"> DaVinci Resolve <img width="50" height="50" src="{{  asset('images/home/davinci-resolve.png') }}" alt="davinci-resolve"/></div>
            <div class="item"> InShot <img width="50" height="50" src="{{  asset('images/home/inshot.png') }}" alt="inshot"/></div>
            <div class="item"> premiere pro <img width="50" height="50" src="{{  asset('images/home/adobe-premiere-pro.png') }}" alt="adobe-premiere-pro"/></div>
            <div class="item"> InShot <img width="50" height="50" src="{{  asset('images/home/inshot.png') }}" alt="inshot"/></div>
        </div>
        <div class="rows">
            <div class="item"> Figma <img width="50" height="50" src="{{  asset('images/home/figma--v1.png') }}" alt="figma--v1"/></div>
            <div class="item"> Framer <img width="50" height="50" src="{{  asset('images/home/framer.png') }}" alt="framer"/></div>
            <div class="item"> Cinema 4D <img width="64" height="64" src="{{  asset('images/home/cinema-4d.png') }}" alt="cinema-4d"/></div>
            <div class="item"> Affinity Designer <img width="50" height="50" src="{{  asset('images/home/affinity-designer.png') }}" alt="affinity-designer"/></div>
            <div class="item"> adobe XD <img width="50" height="50" src="{{  asset('images/home/adobe-xd--v1.png') }}" alt="adobe-xd--v1"/> </div>
            <div class="item"> FL Studio <img width="50" height="50" src="{{  asset('images/home/fl-studio.png') }}" alt="fl-studio"/></div>
            <div class="item"> GarageBand <img width="50" height="50" src="{{  asset('images/home/garage-band--v2.png') }}" alt="garage-band--v2"/></div>
            <div class="item"> FL Studio <img width="50" height="50" src="{{  asset('images/home/fl-studio.png') }}" alt="fl-studio"/></div>
            <div class="item"> Bitwig Studio <img width="50" height="50" src="{{  asset('images/home/bitwig--v1.png') }}" alt="bitwig--v1"/></div>
        </div>
        <div class="floating-card p-3">
        <form action="{{ route('user.search') }}" method="GET">
                <div class="search" id="search-section">
                    <div class="search-box">
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
            <div class="suggest-container">
                <div class="suggest">فرانت اند </div>
                <div class="suggest">بک اند </div>
                <div class="suggest"> طراح داخلی </div>
                <div class="suggest"> میکس مستر </div>
                <div class="suggest mobile"> ادیت ویدو </div>
                <div class="suggest mobile"> فوتوشاپ </div>
                <div class="suggest mobile">فرانت اند </div>
                <div class="suggest mobile">بک اند </div>
                <div class="suggest"> طراح داخلی </div>
                <div class="suggest"> میکس مستر </div>
                <div class="suggest"> ادیت ویدو </div>
                <div class="suggest"> فوتوشاپ </div>
            </div>
            <div class="suggest-card-container">
    
                @foreach ($users as $user)
                    <div class="eltaCard">
                        <div class="front-elta-card pt-5">
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $user->profilepic) }}" alt="Profile Picture">
                            </div>
                            <div class="info-container">
                                <h4 class="name">{{ $user->name }}</h4>
                                <h6 class="scope-work">{{ $user->workarea }}</h6>
                                <h6 class="username-card">{{ $user->username}}</h6>
                                <p class="about-me">{{ $user->aboutme }}</p>
                                <a href="{{ route('mobile.profile', ['id' => $user->id]) }}" class="btn btn-link cardBtn">مشاهده رزومه</a>
                            </div>
                        </div>          

                        <div class="back-elta-card px-3">
                            <div class="data-container">
                            <div class="skill">
                                <h6 class="title-skill">مهارت‌ها</h6>
                                <div class="skill-container">
                                    @foreach ($user->skills as $skill)
                                        <div class="skills">{{ $skill->skill }}</div> {{-- فیلد skill در جدول user_skill --}}
                                    @endforeach
                                </div>
                            </div>
        

                                {{-- اگر زبان می‌خوای نمایش بدی --}}
                                @if ($user->languages && $user->languages->count())
                                    <div class="language">
                                        <h6 class="title-language">زبان ها</h6>
                                        <div class="language-container">
                                            @foreach ($user->languages as $lang)
                                                <div class="languages">{{ $lang->language }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>          

                        <div class="button-container ">
                            <button class="btn btn-link cardBtn view-details-button">نمایش جزئیات</button>
                            <a href="{{ url('chatify/' . $user->id) }}" class="btn btn-link cardBtn">ارسال پیام</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </section>

      <div class="content-container" style="max-width:2000px">
            <section id="features" >
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 " style="margin-bottom: 100px">   

                        <div class="grid lg:grid-cols-2 gap-10 items-center">
                            <div class="order-1 lg:order-2 " >
                                <div class="grid gap-6">
                                    <div class="flex gap-4 text-white" dir="rtl">
                                        <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">پرداخت امن</h3>
                                            <p class="text-sm text-slate-400">تمام تراکنش‌ها در التا با سیستم پرداخت امن انجام می‌شود تا حقوق فریلنسر و کارفرما هر دو حفظ شود.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 text-white" dir="rtl">
                                        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">تعامل مستقیم</h3>
                                            <p class="text-sm text-slate-400">با فریلنسر بدون واسطه گفت‌وگو کنید، شرایط پروژه رو شفاف سازی کنبد و نتیجه بهتری بگیرید.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 text-white" dir="rtl">
                                        <div class="w-12 h-12 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold mb-1">دسترسی به فریلنسر ها و آگهی ها</h3>
                                            <p class="text-sm text-slate-400">رزومه و نمونه کاری های چندین فریلنسر حرفهای و مشتاق در دسترس شماست که در لحظه میتوانید ارتباط برقرار کنید</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4 text-white" dir="rtl">
                                        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 0 1 4 4L7 21H3v-4L17 3z"></path></svg>
                                        </div>
                                        <div class="relative w-fit">
                                            <h3 class="font-semibold mb-1">ثبت  پروژه</h3>
                                            <p class="text-sm text-slate-400">پروژه خود را در التا ثبت کنید تا در دسترس چندین فریلنسر قرار بگیرد و  همکاری حرفه و یا بلند مدت در محیطی تخصصی داشته باشید</p>
                                            <img src="{{  asset('images/home/arrow.svg') }}" class="transform rotate-[30deg] absolute w-[80px] top-[70px] right-[-80px]"  />
                                            <a href="{{ route('newProject') }}" class="h-f-btn absolute top-[100px] right-0 mt-6 inline-flex items-center gap-2 px-5 py-3 rounded-md border border-gray-300 bg-white/60 text-gray-800 font-semibold backdrop-blur-md no-underline hover:no-underline transition-colors duration-300 hover:bg-white hover:border-gray-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                      </svg>
                                      همین حالا پروژه خود را ثبت کنید
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="t-h-c-i order-2 lg:order-1 relative -z-[1]">
                                <img src="{{  asset('images/employer-home-pic1.jpg') }}" class="w-full h-auto rounded-2xl shadow-xl ring-1 ring-black/5" >
                                <div class="absolute -top-6 -right-6 hidden md:block bg-white rounded-xl shadow-lg p-4 border border-slate-100">
                                    <div class="flex items-center gap-3" dir="rtl">
                                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold">التا فریلنسر</p>
                                            <p class="text-xs text-slate-500">نیاز هر کسب و کار</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ads absolute">
                                <h3 class="text-xl font-semibold">جدید ترین آگهی های التا</h3>
                                </iv>
                            </div>
                        </div>
                    </div>
            </section>
        
            <div class="d-flex  mx-auto sm:px-6 py-14">
                <div class="infinite-slider" dir="rtl" style="padding: 60px 30px;">
                    <div class="slider-track">
                        @foreach($ads as $ad)
                            @php
                                $isDistinguished = $ad->tags->contains(fn($tag) => $tag->name === 'متمایز');
                            @endphp
                            <a class="user-card-link"  href="{{ url('/content?type=ad&id=' . $ad->id) }}" style="text-decoration:none; color:inherit;">
                                <div class="card-advertisement {{ $isDistinguished ? 'distinguished-card' : '' }}">                         
                                    @php
                                        $mainImage = $ad->images->firstWhere('is_main', true);
                                    @endphp
                                    <div class="card-header-advertisement">
                                        <img src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" class="image-advertisement">
                                    </div>                          
                                    <div class="card-body-top">
                                        <span class="services-tags">
                                            {{ $ad->user->username }}@
                                        </span>
                                        <div class="add-contact" data-user-id="{{ $ad->user->id }}">
                                            @if ($ad->is_favorite)
                                                <i class="fa-solid fa-user-check icon-anim"></i>
                                            @else
                                                <i class="fa-solid fa-user-plus icon-anim"></i>
                                            @endif
                                        </div>

                                    </div>                          
                                    <div class="card-body-advertisement">
                                        <h5>{{ $ad->title }}</h5>
                                        <h6>{{ $ad->service_type }}</h6>
                                        <p style="min-height: 113px">{!! nl2br(e(Str::limit($ad->description, 200))) !!}</p>
                                    </div>                          
                                    <div class="card-body-bottom">
                                        <h6>
                                            از {{ $ad->price }}<span class="price-label"></span>
                                        </h6>
                                    </div>                          
                                </div>       
                            </a>                            
                        @endforeach
                    </div>
                </div>
            </div>
            <section id="features" class="py-16">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-10 items-center">
                        <div class="order-2 lg:order-1" dir="rtl">
                            <p class="text-white mt-5">التا علاوه بر فراهم‌کردن دسترسی به متخصصان حرفه‌ای، به شما کمک می‌کند تا پروژه‌هایتان را سریع‌تر، دقیق‌تر و با هزینهٔ مناسب‌تر انجام دهید و همکاری حرفه ای رو تجربه کنید. تنها کافی است مراحل زیر را دنبال کنید:</p>                            <ul class="mt-3 space-y-3 text-sm text-slate-400">
                            <ul class="mt-3 space-y-3 text-sm text-slate-400">
                                <li class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check text-green-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    تکمیل پروفایل
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check text-green-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    ثبت پروژه
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check text-green-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    جست و جو آگهی ها و فریلنسر ها
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check text-green-600"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    باز کردن تعامل
                                </li>
                            </ul>
                            <a href="{{ route('employerProfile') }}"
                               class="mt-6 inline-flex items-center gap-2 px-5 py-3 rounded-md border border-gray-300 bg-white/60 text-gray-800 font-semibold backdrop-blur-md no-underline hover:no-underline transition-colors duration-300 hover:bg-white hover:border-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                                    <path d="M2 7h20v14H2z"></path>
                                    <path d="M16 3H8v4h8z"></path>
                                </svg>
                                تکمیل پروفایل
                            </a>

                        </div>
                        <div class="order-1 lg:order-2 relative">
                            <img src="{{  asset('images/employer-home-pic4.jpg') }}" alt="برترین پلتفرم فریلنسینگ ایران" class="w-full h-auto rounded-2xl shadow-xl ring-1 ring-black/5">
                                        <div class="t-h-c -top-14 absolute hidden md:block bg-white rounded-xl shadow-lg p-4 border border-slate-100 " style="left: -30px; text-align: center;">
                                            <h3 class="text-xl font-semibold text-slate-700 mt-2">بهترین نقطه برای شروع یک داستان</h3>
                                        </div>
                            <div class="absolute -bottom-6 -right-6 hidden md:block bg-white rounded-xl shadow-lg p-4 border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-lightbulb">
                                            <line x1="9" y1="18" x2="15" y2="18"></line>
                                            <line x1="10" y1="22" x2="14" y2="22"></line>
                                            <path d="M12 2a6 6 0 0 0-6 6c0 3 3 5 6 5s6-2 6-5a6 6 0 0 0-6-6z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold">سر نقطه</p>
                                        <p class="text-xs text-slate-500">چطور شروع کنdم؟</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <div class="app-content fade-in" style="opacity: 1; transform: translateY(0px); transition: opacity 1s ease-out, transform 1s ease-out; animation: 1s ease-out 0.7s 1 normal forwards running fadeIn;">
        <div class="benefits">
            @foreach($randomRows as $index => $usersGroup)
                <div class="basic-marquee {{ $index % 2 == 0 ? 'basic-marquee-1' : 'basic-marquee-2' }}">
                    @foreach($usersGroup as $user)
                        <a href="{{ url('chatify/' . $user->id) }}">
                            <div class="flex flex-col gap-2 w-full min-w-60 sm:min-w-60 sm:w-auto text-[10px] sm:text-xs z-50 cursor-pointer" dir="rtl">
                                <div class="succsess-alert flex items-center justify-between w-full p-2 rounded-2xl bg-[#4f545a] hover:bg-[#5a6066] transition-all duration-300">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-white/10">
                                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-white font-semibold">{{ $user->name }}</p>
                                            <p class="text-gray-400">{{ $user->workarea ?? 'بدون حوزه مشخص' }}</p>
                                        </div>
                                  </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <footer class="border border-slate-100 bg-white rounded-2xl mx-auto mt-[200px] z-50 relative mb-3 " dir="rtl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-2 justify-between items-center gap-4">
                    <div class="flex flex-col items-center justify-center text-center w-55">
                        <img id="img-icon" class="w-35 h-35" src="{{ asset('images/name.jpg') }}" alt="">                        
                        <p class="text-sm text-slate-600 mt-3">تخصصی ترین پلتفرم فریلنسینگ ایران</p>
                    </div>
                    <div >
                        <h4 class="font-semibold">تماس</h4>
                        <ul class="mt-3 space-y-2 text-sm text-slate-600">
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                info@elta.ir
                            </li>
                            <li class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                021-12345678
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-slate-100 text-xs text-slate-500 flex flex-col sm:flex-row justify-between gap-2">
                    <p dir="ltr">© 2025 elta. تمامی حقوق محفوظ است.</p>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-primary-500">قوانین</a>
                        <a href="#" class="hover:text-primary-500">حریم خصوصی</a>
                        <a href="#" class="hover:text-primary-500">سوالات متداول</a>
                    </div>
                </div>
            </div>
    </footer>
    <script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/home.js"></script>
    <script src="../js/homeFreelancer.js"></script>
    <div id="overlay" class="overlay"></div>

</body>
</html>
