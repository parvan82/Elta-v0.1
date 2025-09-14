<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>home</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/home.css">
    <style>
    @media (max-width: 991.98px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .portfolio-container {
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        scroll-snap-type: y mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        gap: 1rem;
        padding: 1rem;
        height: fit-content;
        max-height: 500px;
    }

    .portfolio-content {
        margin: 5px;
        color: #888;
        border: 2px solid #999;
        border-radius: 5px;
        background: #333333;
        scroll-snap-align: start;
        flex: 0 0 auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 1rem;
        min-height: 200px;
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
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <div class="left-buttons">
                    <button id="open-sidebar" class="open-btn">☰</button>
                    <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i></a>
                </div>

                <div class="site-name"><img id="img-icon" src="{{ asset('images/name.jpg') }}" alt=""></div>

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
                <div class="suggest"> ادیت ویدو </div>
                <div class="suggest"> فوتوشاپ </div>
                <div class="suggest">فرانت اند </div>
                <div class="suggest">بک اند </div>
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
                            </div>
                        </div>

                        <div class="back-elta-card px-3">
                            <div class="data-container">
                                <div class="skill">
                                    <h6 class="title-skill">مهارت ها</h6>
                                    <div class="skill-container">
                                        @foreach ($user->skills as $skill)
                                            <div class="skills">{{ $skill->skill_name }}</div>
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
                            </div>`
                        </div>

                        <div class="button-container ">
                            <button class="btn btn-link cardBtn view-details-button">نمایش جزئیات</button>
                            <a href="{{ url('chatify/' . $user->id) }}" class="btn btn-link cardBtn">ارسال پیام</a>
                        </div>
                    </div>
                @endforeach
            </div>


    </section>
    <div class=" content-container">
        <div class="club-card-container mt-5">

            <div class="club-card shop">
                <div class="start-card">
                    <h5 class="club-title">شاپ</h5>
                    <p class="club-description">
                        التا شاپ فضایی برای پیدا کردن چیزای ریز و درشته از المنت های ساده و کوچیک تا المنت های بزرگ و حرفه ای رو میتونی از التا شاپ تهیه کنی اگر در حوضه ای به صورت حرفه ای فعالیت میکنی پیشنهاد میکنم حتما یک سر به التا شاپ بزنی‌
                    </p>
                </div>
                <div class="end-card">
                    <button class="clubBtn">
                        التا شاپ
                    </button>
                    <img src="{{ asset('images/logo.jpg') }}"  class="club-logo" alt="">
                </div>
            </div>

            <div class="club-card job">
                <div class="start-card">
                    <h5 class="club-title">جاب</h5>
                    <p class="club-description">
                        شرکت نوپا داری و نیاز به نیرو داری؟ نیرو متخصص و تایید شده میخوایی؟ التا جاب این مشکل رو حل کرده میتونی با ورود به التا جاب و با مقایسه التا کارت های کارمندان مصاحبه حضوری با افراد حرفه ای داشته باش و تیم حرفه ای خودتو تشکیل بدی
                    </p>
                </div>
                <div class="end-card">
                    <button class="clubBtn">
                        التا جاب
                    </button>
                    <img src="{{ asset('images/logo.jpg') }}"  class="club-logo" alt="">

                </div>
            </div>

            <div class="club-card learn">
                <div class="start-card">
                    <h5 class="club-title">لرن</h5>
                    <p class="club-description">
                        التا لرن محیطی کاملا نو برای یادگیری علاقه مندان به تمام دسته بندی های مربوطه هستش ما با کمک التایی های عزیز تلاش کردیم بهترین اموزش هارو برای شما تولید کنیم. همین الان شروع به یادگیری کن و در حوضه های مختلف التا شروع به کار کن و عضو خانواده التا شو
                    </p>
                </div>
                <div class="end-card">
                    <button class="clubBtn">
                        التا لرن
                    </button>
                    <img src="{{ asset('images/logo.jpg') }}"  class="club-logo" alt="">

                </div>
            </div>
        </div>

        <div class="description-card up-down">
            <h4 class="title-description">التا فریلنسر چیه؟</h4>
            <p class="content-description">همیشه یکی از نیاز های شرکت های بزرگ تا کسب و کار های کوچک داشتن نیرو مطمئن و قابل اتکا بوده و  دغدغه این مدیران زمان , کیفیت و هزینه کار بوده . التا فریلنسر با گزینش درست افراد تونسته مجموعه ای از افراد حرفه‌ای که در حوضه کاری خود مهارت بالایی دارن و یا افراد با استعداد نو ظهور که انگیزه بالایی برای رشد دارند رو گرد آوری کنه و همین امر باعث شده سرعت و سهولت انتخاب نیرو بالا بره و از جهتی حضور افراد نو ظهور که نیاز به میدان برای دیده شدن دارن میتوانند هزینه های پروژه شمارو کاهش بدن و و نیرویی با انگیزه به شما ارائه بدن , و البته نباید از حضور افراد قدیمی و حرفه ای برای داشتن یک کار با کیفیت بالا غافل شد</p>
        </div>

        <div class="description-card down-up">
            <h4 class="title-description"> مزایای کار با التا</h4>
            <div class="info-card-container">
                <div class="info-card security">
                    <img class="m-3" width="50" height="50" src="https://img.icons8.com/ios/50/security-shield-green.png" alt="security-shield-green"/>
                    <p>بعد از توافق برای پروژه بین شما و کارمند التا قرارداد الکترونیکی ایجاد میشه که الزامات توافق در اون ذکر شده , مبلغ پرداختی شما در حساب التا کارمند نگه داری میشود و پس از پایان پروژه و رضایت شما به کارمند پرداخت میشه</p>
                </div>

                <div class="info-card supports">
                    <img class="m-3" width="50" height="50" src="https://img.icons8.com/ios/50/headset--v1.png" alt="headset--v1"/>
                    <p>پشتیبانی التا در تمامی لحاضات اجرای پروژه در کنار شما خواهد بود تا در طی روند اجرای پروژه مشکلی نداشته باشید و با خیالت راحت پروژه خودتون رو به پایان برسانید</p>
                </div>

                <div class="info-card guarantee">
                    <img class="m-3" width="50" height="50" src="https://img.icons8.com/ios/50/spyware-free.png" alt="spyware-free"/>
                    <p>وجود قرارداد الکترونیک امکان کلاهبرداری رو از بین میبرد و شما میتوانید در محیطی  ایمن پروزه خود را به پایان برسانید . هر کارمند التا وظیفه دارد که رضایت شما رو در رابطه با روند پیشرفت  پروژه جلب کند </p>

                </div>
                <div class="info-card guarantee">
                    <img class="m-3" width="50" height="50" src="https://img.icons8.com/ios/50/stairs-up.png" alt="stairs-up"/>
                    <p>در هر لحظه شما میتوانید با کارمند التا در ارتباط باشید و به تمام مراحل پروژ نظارت داشته باشید و روند موفقیت پروژه به شما گزارش داده میشود </p>
                </div>
            </div>
        </div>

        <div class="description-card up-down-0">
            <h4 class="title-description">چرا التا</h4>
            <p class="content-description">اگر بخواهیم از جنبه اجتماعی به این موضوع نگاه کنیم التا فضایی برای پیشرفت تمامی افراد در تمامی سطح ها میباشد , التا مجموعه ای بزرگ برای رشد و تحول حوضه های مختلف است . سهولت کار در التا موجب شده  که ارتباط بین  کارمندان و کارفرما ها و صاحیبن کسب و کار راحت شود و بازار کار در عرصه های مختلف رونق بگیرد . شما کارفرمای عزیز با انتخاب التا زمینه رشد و پیشرفت رو برای کسب و کار خود و سایر افراد ایجاد میکنید</p>
        </div>
        <section id=timeline>

            <div class="demo-card-header">
                <h2>ثبت شرکت در التا</h2>
                <p class="leader">برای بهره‌مندی تجربه خوب و مفید از سایت بهتر است روند زیر را طی کنید</p>
            </div>
            <div class="demo-card-wrapper">
                <div class="demo-card demo-card--step1">
                    <div class="head">

                        <h2><span class="small">پروفایل</span>تکمیل فیلد های پروفایل</h2>
                        <div class="number-box">
                            <span>01</span>
                        </div>
                    </div>
                    <div class="body">
                        <p>برای جلوه بهتر از شرکت شما برای فریلنسرهای التا و مشتری های شما نیاز است فیلد های پروفایل شرکت خود را کامل کنید . این کار علاوه جلوه شرکت شما به درک بهتر نیاز های شما برایز فریسلنران کمک میکند</p>
                    </div>
                </div>

                <div class="demo-card demo-card--step2">
                    <div class="head head2">
                        <h2><span class="small">تایید</span>تایید مشخصات شرکت</h2>
                        <div class="number-box">
                            <span>02</span>
                        </div>
                    </div>
                    <div class="body">
                        <p>تیم پشتیبانی التا در کوتاه ترین زمان ممکن مشخصات ارسال شده شمارو بررسی میکند تا از وجود خطا و مشکل جلوگیری شود . در این بازه زمانی شما میتوانید از امکانات سایت استفاده کنید و در صورت مشکل تیم التا با شما تماس خواهد گرفت</p>
                    </div>
                </div>

                <div class="demo-card demo-card--step3">
                    <div class="head head3">

                        <h2><span class="small">درخواست کارت</span>درخواست التا کارت</h2>
                        <div class="number-box">
                            <span>03</span>
                        </div>
                    </div>
                    <div class="body">
                        <p>پس از اینکه شرکت شما در التا ثبت شد و به رسمیت شناخته شد شما میتوانید با مراجعه به داشبورد و قسمت التا کارت , پس از انتخاب مشخصات ظاهری کارت , التا کارت خود را سفارش بدید . التا کارت کمک میکند تا صفحه شرکت خود را در التا به مشتریان خود نمایش بدید این صفحه شامل مشخصات شرکت و فعالیت ها و پروژه های در حال اجرا و به اتمام رسیده است</p>
                    </div>
                </div>

                <div class="demo-card demo-card--step4">
                    <div class="head head4">

                        <h2><span class="small"> دریافت کارت</span> دریافت التا کارت</h2>
                        <div class="number-box">
                            <span>04</span>
                        </div>
                    </div>
                    <div class="body">
                        <p> پس از ارسال درخواست التا کارت شما در ۳ الی ۷ روز کاری به دست شما خواهد رسید . التا کارت میتواند رابط فیزیکی بین شرکت شما و التا برای مشتری باشد تا مشتری شما علاوه بر مشخصات شرکت شما فعالیت ها و پروژه های به اتمام رسیده و در حال اجرا شرکت شمارو ببیند</p>
                    </div>
                </div>

                <div class="demo-card demo-card--step5">
                    <div class="head head5">


                        <h2><span class="small">پایان</span>و در کلام آخر</h2>
                        <div class="number-box">
                            <span>05</span>
                        </div>
                    </div>
                    <div class="body">
                        <p>حال شما یک شرکت بروز دارید که پتانسیل و انعطاف بالایی میتواند در بازار کار داشته باشد . پیشنهاد میشه شرکت التا و تیم التارو شامل اعتماد خود قرار بدید , وظیفه ما رفع نیاز های کسب کار شما و ایجاد امتیاز مثبتی نسب به سایر رقبا شما هست . به خانواده بزرگ التا خوش آمیدید</p>
                    </div>
                </div>

            </div>
        </section>
    </div>
</main>
<footer>

</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/home.js"></script>

<div id="overlay" class="overlay"></div>

</body>
</html>
