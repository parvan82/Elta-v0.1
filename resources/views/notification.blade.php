<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/home.css">
    <style>
        .card-message {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #444444;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .card-message:hover {
            background-color: #555555;
        }
        .card-message .info {
            display: flex;
            justify-content:space-between;
            flex: 1;
            margin-right: 10px;
        }
        .text-name{
            display: flex;
            flex-direction: column;
        }
        .card-message .info small {
            font-size: 12px;
        }
        .card-message .avatar-container {
            position: relative;
            width: 55px;
            height: 55px;
        }
        .card-message img.avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .card-message .status-dot {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
        }
    </style>
</head>
<body>
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
                </div>
                <div class="site-name">
                    <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <main>
        <div class="main-container">

            @php use Carbon\Carbon; @endphp

            @if($messages->isEmpty())
                <div class="col-12 mt-4">
                    <div class="eltaCard" style="box-shadow: 0 0 20px #555; ">
                        <div class="search-elta-card pt-1 d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
                            <img src="{{ asset('images/notifications/empty.png') }}" alt="" style="width: 200px; height: 200px;">
                            <h5 class="text-center mt-2">صندوق اعلانات خالی است</h5>
                            
                        </div>
                    </div>
                </div>            
            @else
                @foreach ($messages as $msg)
                    <div class="card-message" onclick="window.location.href='{{ $msg['link'] }}'">
                        <div class="info">
                            <div><small>{{ Carbon::parse($msg['created_at'])->diffForHumans() }}</small></div>
                            <div class="text-name">
                                <strong>{{ $msg['from_name'] }}</strong>
                                <small>{{ $msg['message'] }}</small>
                            </div>

                        </div>
                        <div class="avatar-container">
                            <img src="{{ $msg['from_avatar'] }}" class="avatar" alt="avatar">
                        </div>
                    </div>
                @endforeach

            @endif

        </div>



    </main>
    <div id="overlay" class="overlay"></div>

    <script>document.addEventListener("DOMContentLoaded", () => {
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
</script>

</body>

</html>
