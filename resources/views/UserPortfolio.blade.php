<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/home.css">
    <style>

        .media {
            position: absolute;
            top: -10%;
            left: 50%;
            transform: translateX(-50%);
            width: 80vw;
            max-width: 1000px;
            height: 300px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.21);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            backdrop-filter: blur(20px);
            z-index: 10;
        }

        .container-fluid{
            max-width: 1270px;
            position: relative;
            margin-top: 125px ;
            margin-bottom: 40px ; 
            display: flex ; 
            justify-content: center ;
            align-items: center ;
             
        }

        .portfolio-body{
            width: calc(100% - 10%);
            background: rgba(255, 255, 255, 0.21);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(86, 77, 77, 1);
            z-index: -1;  
            padding: 50px 40px;

            
        }

        .portfolio-info{
            border-radius: 10px;
            background:  rgba(255, 255, 255, 0.21);
            box-shadow: 
                15px 15px 30px rgba(20, 20, 20, 0.7),
               -15px -15px 30px rgba(255, 255, 255, 0.1);
            direction: rtl;
            padding: 20px;
            padding-bottom: 50px ; 
            margin-top: 15em;
            color: #fff;
        }

        .portfolio-info p {
            margin-top: 20px;
            font-size: 18px;
        }

        .img{
            margin-top: none;
            margin-left: none;
            top: -40px;
            left: 0px;
            width: 3em;
            transform: translateX(-50%);
            height: 3em;
            background: #666;
            transition: 0.9s ease;
            
        }

        .img i {
            font-size: 1.5em;          
            transition: 0.5s ease;
        }

        .media:hover ~ .portfolio-body .img i{
            transform: scale(1.2);
            color: #f1f1f1;
        }

        .media:hover ~ .portfolio-body .img {
          background: #444;
        }
        .link-container{
            position: absolute;
            bottom: 65px;
            right: 130px;
        }
        .btns{
            direction: rtl;
            position: absolute ;
            top: 220px;
            right: 11%;
        }
        .likes{
            margin-top: 1em; 
            opacity: 1;
              width: 3em;
                height: 1.5em;
                border-radius: 10px;
        }

        .fl-portfolio { 
            position: absolute;
            top: -250px;
            right: 0px;
            width: 54px;
            display: flex;
            opacity: 0;
            transition: .2s ease-in-out;
            z-index: 99;
            opacity: 2;
            cursor: pointer;
            margin-right: 0.5em;
        }
        .fullscreen-btn {
          width: 2em;
          height: 2em;
        
        }
        .fullscreen-btn:hover {
          width: 2.2em;
          height: 2.2em;
          overflow: visible;
        }
        .audio-wrapper {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          height: 100%;
        }

        .audio-wrapper audio {
          width: 80%;
          height: 50px;
        }
        @media (max-width: 500px) {

        .media {
            width: 85vw;
            height: 200px;
        }

        .portfolio-body {
            width: 100vw;
            padding: 50px 20px ;
        }

        .portfolio-info{
            margin-top: 9em;
        }

        .portfolio-info h1{
            font-size: 30px;
        }

        .img{
            top: 150px;
            left: 20px;
            transform: translateX(-50%);
            box-shadow: 
            5px 5px 20px rgba(20, 20, 20, 0.7),
            -15px -15px 20px rgba(255, 255, 255, 0.1);
        }

       .link-container{
            position: absolute;
            bottom: 65px;
            right: 50px;
        }

        .btns{
            top: 120px;
            right: 8%;
        }

        .fl-portfolio { 
            top: -160px;
            right: -40;
                        
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
                    <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i><span class="notification-bell-badge" style="left: 145px;"></span></a>
                </div>
                <div class="site-name">
                    <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
                </div>
            </div>

        </div>

    </section>

    </header>

    <div class="container-fluid">
            

        <div class="media">

            @php
                    $file = $portfolio->file;
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                                $link = $portfolio->link;

                // نوع فایل برای آیکون
                switch(true) {
                    case in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']):
                        $file_icon = 'fa-solid fa-image';
                        break;
                    case in_array($ext, ['mp4', 'webm', 'ogg']):
                        $file_icon = 'fa-solid fa-video';
                        break;
                    case in_array($ext, ['mp3', 'wav', 'ogg']):
                        $file_icon = 'fa-solid fa-music';
                        break;
                    case $ext === 'html':
                        $file_icon = 'fa-brands fa-html5';
                        break;
                    case $ext === 'pdf':
                        $file_icon = 'fa-solid fa-file-pdf';
                        break;
                    case $ext === 'doc' || $ext === 'docx':
                        $file_icon = 'fa-solid fa-file-word';
                        break;
                    case $ext === 'zip' || $ext === 'rar':
                        $file_icon = 'fa-solid fa-file-zipper';
                        break;
                    default:
                        $file_icon = 'fa-solid fa-file'; // فایل ناشناس
                        break;
                }
            @endphp

            @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                <img src="{{ asset($file) }}" style="width: 100%; height: 100%; border-radius: 10px; object-fit: cover;" alt="{{ $portfolio->title }}">
            @elseif(in_array($ext, ['mp4', 'webm', 'ogg']))
                <video autoplay style="width: 100%; height: 100%; border-radius: 10px; object-fit: cover;">
                    <source src="{{ asset($file) }}" type="video/{{ $ext }}">
                </video>
            @elseif(in_array($ext, ['mp3', 'wav', 'ogg']))
            <div class="audio-wrapper">
                <audio controls>
                    <source src="{{ asset($file) }}" type="audio/{{ $ext }}">
                </audio>
            </div>
            @elseif($ext === 'html')
                <iframe src="{{ asset($file) }}" style="width: 100%; height: 100%; border-radius:10px;"></iframe>
            @else
                <div class="unsupported-file">
                    <i class="fa-solid fa-file" style="color: #444; font-size:80px;"></i>
                </div>
            @endif

        </div>
        
        <div class="portfolio-body">
            <div class="img">
                <i class="{{ $file_icon }}"></i>
            </div>
            
            
            <div class="portfolio-info">
                <h1>{{ $portfolio->title }}</h1>
                <p>{{ $portfolio->description }}</p>

            </div>
        </div>
        <div class="link-container" >
            @if(strpos($link, 'github.com') !== false)
                <a href="{{ $link }}" id="githubBtn" class="socialBtn mt-2">
                    <svg class="github-svgIcon" viewBox="0 0 496 512" height="1.4em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8z"></path>
                    </svg>
                    <span class="text">Github</span>
                </a>
            @elseif(strpos($link, 'soundcloud.com') !== false)
                <a href="{{ $link }}" id="soundcloudBtn" class="socialBtn mt-2" >
                    <svg  class="soundcloud-svgIcon"  viewBox="0 0 640 512" height="25px" xmlns="http://www.w3.org/2000/svg" fill="#ff8800" class="soundcloud"><path d="M111.4 256.3l5.8 65-5.8 68.3c-.3 2.5-2.2 4.4-4.4 4.4s-4.2-1.9-4.2-4.4l-5.6-68.3 5.6-65c0-2.2 1.9-4.2 4.2-4.2 2.2 0 4.1 2 4.4 4.2zm21.4-45.6c-2.8 0-4.7 2.2-5 5l-5 105.6 5 68.3c.3 2.8 2.2 5 5 5 2.5 0 4.7-2.2 4.7-5l5.8-68.3-5.8-105.6c0-2.8-2.2-5-4.7-5zm25.5-24.1c-3.1 0-5.3 2.2-5.6 5.3l-4.4 130 4.4 67.8c.3 3.1 2.5 5.3 5.6 5.3 2.8 0 5.3-2.2 5.3-5.3l5.3-67.8-5.3-130c0-3.1-2.5-5.3-5.3-5.3zM7.2 283.2c-1.4 0-2.2 1.1-2.5 2.5L0 321.3l4.7 35c.3 1.4 1.1 2.5 2.5 2.5s2.2-1.1 2.5-2.5l5.6-35-5.6-35.6c-.3-1.4-1.1-2.5-2.5-2.5zm23.6-21.9c-1.4 0-2.5 1.1-2.5 2.5l-6.4 57.5 6.4 56.1c0 1.7 1.1 2.8 2.5 2.8s2.5-1.1 2.8-2.5l7.2-56.4-7.2-57.5c-.3-1.4-1.4-2.5-2.8-2.5zm25.3-11.4c-1.7 0-3.1 1.4-3.3 3.3L47 321.3l5.8 65.8c.3 1.7 1.7 3.1 3.3 3.1 1.7 0 3.1-1.4 3.1-3.1l6.9-65.8-6.9-68.1c0-1.9-1.4-3.3-3.1-3.3zm25.3-2.2c-1.9 0-3.6 1.4-3.6 3.6l-5.8 70 5.8 67.8c0 2.2 1.7 3.6 3.6 3.6s3.6-1.4 3.9-3.6l6.4-67.8-6.4-70c-.3-2.2-2-3.6-3.9-3.6zm241.4-110.9c-1.1-.8-2.8-1.4-4.2-1.4-2.2 0-4.2.8-5.6 1.9-1.9 1.7-3.1 4.2-3.3 6.7v.8l-3.3 176.7 1.7 32.5 1.7 31.7c.3 4.7 4.2 8.6 8.9 8.6s8.6-3.9 8.6-8.6l3.9-64.2-3.9-177.5c-.4-3-2-5.8-4.5-7.2zm-26.7 15.3c-1.4-.8-2.8-1.4-4.4-1.4s-3.1.6-4.4 1.4c-2.2 1.4-3.6 3.9-3.6 6.7l-.3 1.7-2.8 160.8s0 .3 3.1 65.6v.3c0 1.7.6 3.3 1.7 4.7 1.7 1.9 3.9 3.1 6.4 3.1 2.2 0 4.2-1.1 5.6-2.5 1.7-1.4 2.5-3.3 2.5-5.6l.3-6.7 3.1-58.6-3.3-162.8c-.3-2.8-1.7-5.3-3.9-6.7zm-111.4 22.5c-3.1 0-5.8 2.8-5.8 6.1l-4.4 140.6 4.4 67.2c.3 3.3 2.8 5.8 5.8 5.8 3.3 0 5.8-2.5 6.1-5.8l5-67.2-5-140.6c-.2-3.3-2.7-6.1-6.1-6.1zm376.7 62.8c-10.8 0-21.1 2.2-30.6 6.1-6.4-70.8-65.8-126.4-138.3-126.4-17.8 0-35 3.3-50.3 9.4-6.1 2.2-7.8 4.4-7.8 9.2v249.7c0 5 3.9 8.6 8.6 9.2h218.3c43.3 0 78.6-35 78.6-78.3.1-43.6-35.2-78.9-78.5-78.9zm-296.7-60.3c-4.2 0-7.5 3.3-7.8 7.8l-3.3 136.7 3.3 65.6c.3 4.2 3.6 7.5 7.8 7.5 4.2 0 7.5-3.3 7.5-7.5l3.9-65.6-3.9-136.7c-.3-4.5-3.3-7.8-7.5-7.8zm-53.6-7.8c-3.3 0-6.4 3.1-6.4 6.7l-3.9 145.3 3.9 66.9c.3 3.6 3.1 6.4 6.4 6.4 3.6 0 6.4-2.8 6.7-6.4l4.4-66.9-4.4-145.3c-.3-3.6-3.1-6.7-6.7-6.7zm26.7 3.4c-3.9 0-6.9 3.1-6.9 6.9L227 321.3l3.9 66.4c.3 3.9 3.1 6.9 6.9 6.9s6.9-3.1 6.9-6.9l4.2-66.4-4.2-141.7c0-3.9-3-6.9-6.9-6.9z"></path></svg>
                    <span class="text">Soundcloud</span>
                </a>
            @endif
        </div>
        
        <div class="btns">
            <div class="likes {{ $portfolio->isLikedBy(auth()->user()) ? 'active' : '' }}" data-id="{{ $portfolio->id }}">
                    <div class="con-like">
                                <input class="like" type="checkbox" {{ $portfolio->isLikedBy(auth()->user()) ? 'checked' : '' }}>
                      <div class="checkmark">
                        <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
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

    <script>
        function openFile(url) {
            const win = window.open(url, '_blank');
            if (win) win.focus();
        }

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
    </script>

</body>
</html>
