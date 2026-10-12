<!-- resources/views/search.blade.php -->

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>home</title>
    <!-- Font Awesome CDN -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/newProject.css">
    <link rel="stylesheet" href="../css/alerts.css">
    <link href="{{ asset('css/tooman/css/font.css') }}" rel="stylesheet" type="text/css" />

    <style>


    .price {
  margin: 40px 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}

/* هر بخش ورودی (حداقل / حداکثر) */
.price-value {
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
}

/* عنوان بالای هر ورودی */
.price-title {
  font-size: 13px;
  font-weight: bold;
  position: absolute;
    top: -11px;
  white-space: nowrap;
}

/* موقعیت عنوان در دو سمت */
.price-title.r {
    right: 0;
    margin-right: 16px;
    display: flex;
    color: white;
}
.price-title.r .price-label {
    font-size: 18px;
    margin-top: 2px;
    margin-inline: 5px;
}
/* خط بین دو ورودی */
.price-line {
  flex: 1;
  border-bottom: 2px solid #27AE60;
  align-self: center;
}

/* استایل ورودی */
.price-input {
  border: 1px solid #27AE60 !important;
  border-top: none !important;
  border-radius: 15px !important;
  background: white;
  padding: 8px 12px;
  outline: none;
  transition: 0.3s;
  font-family: inherit;
  text-align: center;
}

.price-input:focus {
  border-color: #2ecc71 !important;
  box-shadow: 0 2px 6px rgba(39, 174, 96, 0.5);
}

.price-input.error {
  border-color: #e74c3c !important;
  box-shadow: 0 2px 6px rgba(231, 76, 60, 0.5);
}

/* پیام خطا زیر ورودی */
.error-message {
  color: #e74c3c;
  font-size: 12px;
  margin-top: 5px;
  min-height: 15px;
  text-align: center;
}
.multi-image-picker {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: sans-serif;
  position: relative;
}

.main-upload {
  width: 100%;
  height: 200px;
  border-radius: 20px;
  border: 2px solid #27ae60;
  overflow: hidden;
  position: relative;
  cursor: pointer;
  transition: 0.3s;
}

.main-upload:hover {
  background-color: #e5ffee;
}

.upload-label {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color: #27ae60;
}


.upload-label .placeholder i {
  font-size: 48px;
  margin-bottom: 10px;
}

.upload-label .placeholder p {
  font-size: 14px;
  color: #2e7d32;
}

.main-upload img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* دکمه افزودن تصویر جدید */
.add-more-btn {
  position: absolute;
  right: 10px;
  top: 10px;
  background: #27ae60;
  color: white;
  border: none;
  border-radius: 50%;
  width: 35px;
  height: 35px;
  font-size: 24px;
  line-height: 35px;
  cursor: pointer;
  box-shadow: 0 3px 6px rgba(0,0,0,0.2);
  transition: all 0.4s ease;
  opacity: 0;
  transform: translate(0, 50px);
  z-index: 5;
}

.add-more-btn.show {
  opacity: 1;
  transform: translate(0, 0);
}

/* شمارنده */
.image-count {
  position: absolute;
  bottom: 8px;
  right: 10px;
  background: rgba(39, 174, 96, 0.9);
  color: white;
  font-size: 12px;
  padding: 4px 8px;
  border-radius: 10px;
}

/* گالری تصاویر کوچک */
.image-gallery {
  margin-top: 15px;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  justify-content: center;
}

.image-gallery .thumb {
  position: relative;
  width: 70px;
  height: 70px;
  border-radius: 10px;
  overflow: hidden;
  border: 2px solid #27ae60;
    transition: 0.3s;

}

.image-gallery .thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-gallery .thumb button {
  position: absolute;
  top: 3px;
  right: 3px;
  background: rgba(231, 76, 60, 0.9);
  border: none;
  color: white;
  width: 20px;
  height: 20px;
  font-size: 14px;
  border-radius: 50%;
  cursor: pointer;
  transition: 0.3s;
}

.image-gallery .thumb button:hover {
  background: #c0392b;
}

.info-image-picker {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(255, 255, 255, 0.95);
  color: #fff;
  background-color:#27AE60;
  border: 2px solid #27AE60; 
    padding: 0px 14px;
    padding-top: 1px;
  border-radius: 12px 12px 0px 0px;
  font-size: 13px;
  text-align: center;
  opacity: 0;
  transition: all 0.6s ease;
  pointer-events: none;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.info-image-picker.active {
  top: -25px;
  opacity: 1;
  transform: translate(-50%, 0);
}

  .card-advertisement {
    position: relative; /* والد مطلق برای هدر */
    width: 100%;
    height: 270px;
    background-color: #444;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin: 20px 0px;
    color: #fff;
    overflow: visible; /* مهم: اجازه می‌دهد هدر بیرون بزنه */
  }

  .card-header-advertisement {
    position: absolute; /* مطلق برای بیرون زدگی */
    top: 50%;           /* وسط عمودی کارت */
    right: -24px;       /* بیرون زدن از سمت راست */
    width: 200px;
    height: calc( 100% - 10% );
    border-radius: 16px;
    overflow: hidden;
    transform: translateY(-50%); /* وسط دقیق عمودی */
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
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
      
  padding-right: 190px;
      text-align: right;
  }

  .card-body-advertisement h5 {
    margin: 0 0 8px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
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

  .card-body-top{
      display: flex;
      justify-content: space-between;
      padding: 15px 180px 7px 20px;
  }
  .card-body-bottom{
      margin-top: 15px;
      text-align: right;
      padding-right: 190px;

  }
    .card-body-bottom h6{ 
      display: flex;
  }
  .distinguished-card {
      background:  #888888;
      backdrop-filter: blur(10px);
      border: 2px solid #333;
      box-shadow: 0 0 25px rgb(0, 0, 0) !important;
      border-radius: 10px;
  }
  .distinguished-card .card-header-advertisement{
        border: 2px solid #333;
  }
  .service-tag-distinguished {
    background: #f39c12;
    color: white;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: bold;
    margin-right: 10px;
  }
.price-label {
    font-size: 24px;
    margin-top: 3px;
    margin-right: 7px;
}


        /* ریسپانسیو برای کارت‌های آگهی مشابه */
        @media (max-width: 768px) {
            .portfolio-container.ads{
                padding-top: 14em;
            }
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
/* ✅ نسخه موبایل (زیر 768px): عمودی زیر هم */
@media (max-width: 768px) {
  .price {
    flex-direction: column;
    align-items: stretch;
    gap: 30px;
  }

  .price-line {
    display: none; /* خط وسط حذف میشه در موبایل */
  }

  .price-title {
        top: -11px;    
        right: 5px
  }

  .price-value {
    width: 100%;
  }
}

    </style>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="custom-alert error" id="alert-message">
                <div class="alert-content">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-message">{{ $error }}</div>
                </div>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="custom-alert success" id="alert-message">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-message">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="custom-alert error" id="alert-message">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alert-message">{{ session('error') }}</div>
            </div>
        </div>
    @endif
<header>
    <section class="nav-head">
        <div class="header">
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
                    <a href="{{route('notifications')}}" class="open-btn"><i class="fa-solid fa-bell"></i><span class="notification-bell-badge"></span></a>
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
        <div class="col-md-12 p-3">
            <form id="msform">
                @csrf      
                <h2 id="h11">{{ $isRenew ? 'تمدید آگهی' : 'ثبت آگهی' }}</h2>
                <ul id="progressbar" class="{{ $isRenew ? 'progressbar-disabled' : '' }}">
                  @if(!($isRenew ?? false))
                      <li class="active">عنوان و توضیحات</li>
                      <li>نوع سرویس و مبلغ</li>
                      <li>پیش نمایش و نمونه کار</li>
                      <li>خدمات التا</li>
                      <li>التا کارت آگهی</li>
                  @else
                      <li class="active">التا کارت آگهی</li>
                  @endif
                </ul>
                <fieldset dir="rtl">
                  <h2 class="fs-title">انتخاب عنوان و توضیحات</h2>
                  <h3 class="fs-subtitle"> عنوان آگهی :</h3>
                  <input class="mb-3" type="text" placeholder="نام آگهی برای جذب کارفرما بسیار تاثیر گذار است"/>
                  <h3 class="fs-subtitle"> توضیحات تکمیلی آگهی :</h3>
                  <textarea id="project-desc" placeholder="توضیحات آگهی را وارد کنید" style="height: 100px;"></textarea>
                  <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>

                <fieldset dir="rtl">
                    <h2 class="fs-title" >سرویس و مبلغ مورد نظر آگهی</h2>
                    <h3 class="fs-subtitle"> سرویس مورد نظر :</h3>

                    <div class="service-select-container">
                      <div class="service-select-wrapper">
                        <div class="service-select-trigger" id="service-trigger">
                          <span id="service-selected-text">انتخاب سرویس</span>
                          <i class="fas fa-chevron-down service-select-arrow"></i>
                        </div>

                        <div class="service-dropdown" id="service-dropdown">
                          <div class="service-option" data-value="" data-text="انتخاب سرویس">انتخاب سرویس</div>
                          <div class="service-option" data-value="برنامه نویسی" data-text="برنامه نویسی">برنامه نویسی</div>
                          <div class="service-option" data-value="سیستم عامل" data-text="سیستم عامل">سیستم عامل</div>
                          <div class="service-option" data-value="طراحی گرافیک" data-text="طراحی گرافیک">طراحی گرافیک</div>
                          <div class="service-option" data-value="معماری" data-text="معماری">معماری</div>
                          <div class="service-option" data-value="عمران" data-text="عمران">عمران</div>
                          <div class="service-option" data-value="CRM" data-text="CRM">CRM</div>
                          <div class="service-option" data-value="ERP" data-text="ERP">ERP</div>
                          <div class="service-option" data-value="تولید محتوا" data-text="تولید محتوا">تولید محتوا</div>
                          <div class="service-option" data-value="دیتابیس" data-text="دیتابیس">دیتابیس</div>
                          <div class="service-option" data-value="داده کاوی" data-text="داده کاوی">داده کاوی</div>
                          <div class="service-option" data-value="بازی سازی" data-text="بازی سازی">بازی سازی</div>
                          <div class="service-option" data-value="آهنگسازی" data-text="آهنگسازی">آهنگسازی</div>
                        </div>

                        <input type="hidden" name="service" id="service-select" value="">
                      </div>
                    </div>

                    <h3 class="fs-subtitle">مبلغ مورد نظر</h3>
                    <div class="price">
                      <div class="price-value">
                        <span class="price-title r">حداقل بودجه (<span class="price-label"></span>)</span>
                        <input class="price-input" id="price" type="text" placeholder="300,000">
                        <small class="error-message" id="min-error"></small>
                      </div>
                      <div class="price-line"></div>

                    </div>
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                </fieldset>
                <fieldset dir="rtl" style="padding-top: 34px">
                                        <h3 class="fs-subtitle mb-4">پیش نمایش و نمونه کار های آگهی را انتخاب کنید</h3>

                    <div class="multi-image-picker">
                      <div class="info-image-picker">این عکس پیش نمایش آگهی خواهد بود</div>
                      <div class="main-upload">
                        <input type="file" id="imageUpload" accept="image/*" multiple hidden>
                        <label for="imageUpload" class="upload-label">
                          <div class="placeholder">
                            <i class="fa-solid fa-file-circle-plus"></i>
                            <p>برای افزودن تصویر کلیک کنید</p>
                          </div>
                          <img id="mainPreview" src="" alt="" hidden>
                        </label>
                      
                        <!-- دکمه اضافه عکس -->
                        <button type="button" id="addMoreBtn" class="add-more-btn" hidden>+</button>
                      
                        <!-- شمارنده -->
                        <div class="image-count" id="imageCount">0/5</div>
                      </div>
                    
                      <div class="image-gallery" id="imageGallery"></div>
                    </div>
                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                
                </fieldset>
                <fieldset dir="rtl">
                    <h2 class="fs-title">سرویس ها و خدمات التا</h2>
                    <h3 class="fs-subtitle">خدمات اضافی برای بشتر دیده شدن آگهی شما:</h3>

                    <div class="elta-services" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px;">

                        <div class="service"  style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: not-allowed; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: not-allowed;" checked disabled>
                            </div>  
                            <div style="flex: 1; text-align: right;">
                                <h4 style="margin: 0 0 10px 0; color: #333; font-size: 18px;">ثبت آگهی در التا</h4>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">ثبت آگهی در التا به شما این امکان را می‌دهد که به عنوان یک فریلنسر بیشتر دیده شوید. با نمایش بهتر پروفایل و نمونه کارهای شما، شانس دریافت پروژه‌های جدید و متنوع افزایش پیدا می‌کند و فرصت‌های کاری بیشتری در دسترس شما قرار می‌گیرد.</p>
                                <span style="color: #27AE60; display: flex; font-weight: bold; font-size: 16px;">۱۳۹,۰۰۰<span class="price-label"></span></span>
                            </div>
                        </div>

                        <!-- متمایز -->
                        <div class="service" data-value="متمایز" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">متمایز</h4>
                                    <span style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">متمایز</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">با فعال‌سازی گزینه <strong>پروژه متمایز</strong> در التا، ظاهر التا کارت پروژه شما در فهرست‌ به‌صورت ویژه نمایش داده می‌شود.  این ویژگی باعث جلب توجه سریع‌تر فریلنسرها و افزایش احتمال دریافت پیشنهادهای بیشتر و باکیفیت‌تر می‌شود.</p>
                                <span style="color: #27AE60; display: flex; font-weight: bold; font-size: 16px;">۹۹,۰۰۰<span class="price-label"></span></span>
                            </div>
                        </div>

                    </div>  

                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />

                </fieldset>
                <fieldset dir="rtl">
                    @if($isRenew)
                        <input type="hidden" name="renew_ad_id" id="renewAdId" value="{{ $ad->id }}">
                    @endif

                    <h2 class="fs-title">التا کارت پروژه</h2>
                    <h3 class="fs-subtitle"> پیش نمایشی از التا کارت پروژه شما :</h3>
                    <div class="card-advertisement">
@if($ad)
    @php
        $mainImage = $ad->images->firstWhere('is_main', true);
    @endphp
    <div class="card-header-advertisement">
        <img src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" 
             class="image-advertisement" 
             alt="{{ $ad->title ?? 'تصویر آگهی' }}">
    </div>
@else
    <div class="card-header-advertisement">
        <img src="{{ asset('storage/images/default.jpg') }}" class="image-advertisement" alt="تصویر پیش‌فرض">
    </div>
@endif

                      <div class="card-body-top">
                        <div class="tags-card-advertisement">
                        </div>
                        <i class="fa-solid fa-user-plus"></i>                   

                      </div>
                      <div class="card-body-advertisement">
                        <h5>{{ old('title', $ad->title ?? 'عنوان کارت') }}</h5>
                        <h6>{{ $ad->service_type ?? 'نوع سرویس' }}</h6>
                        <p>{{ old('description', $ad->description ?? 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیالی الخصوص طراحان خله اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.') }}</p>
                        </div>
                      <div class="card-body-bottom">
                        <h6>از {{ old('price', $ad->price ?? '1,000,000') }} <span class="price-label"></span></h6>
                      </div>                    

                    </div>
                    <h2 class="fs-title">صورتحساب</h2>
                    <h3 class="fs-subtitle">جزئیات هزینه‌ها و مجموع پرداختی</h3>

                    <div id="invoice-container" style="max-width: 800px; margin: 0 auto; text-align: right;">
                        <div id="invoice-items" style="background: #fff; border: 2px solid #e1e8ed; border-radius: 12px; padding: 15px;">
                            <!-- ردیف‌های صورتحساب اینجا رندر می‌شوند -->
                        </div>
                        <div id="invoice-total" style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 12px; padding: 12px 16px;">
                            <span style="font-weight: 700; color: white;">مجموع قابل پرداخت</span>
                            <span id="invoice-total-amount" style="font-weight: 800; color: #27AE60;">۰ <span class="price-label"></span></span>
                        </div>
                    </div>

                    <button type="button" id="pay-btn-ads" class="action-button">{{ $isRenew ? 'تمدید آگهی' : 'ثبت پروژه' }}</button>
                </fieldset>

            </form>
        </div>
    </div>
</main>
    <script src="../js/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>
<div id="overlay" class="overlay"></div>
<script src="../js/newProject.js"> </script>
<script src="../js/alerts.js"></script>

<script>

document.addEventListener("DOMContentLoaded", () => {
    const isRenew = {{ $isRenew ? 'true' : 'false' }};

    if (isRenew) {
        const fieldsets = document.querySelectorAll("fieldset");
        fieldsets.forEach(fs => fs.style.display = "none");

        fieldsets[fieldsets.length - 1].style.display = "block";

        // progressbar
        const steps = document.querySelectorAll("#progressbar li");
        steps.forEach(li => li.classList.add("active"));
    }
});

const input = document.getElementById("imageUpload");
const mainPreview = document.getElementById("mainPreview");
const gallery = document.getElementById("imageGallery");
const placeholder = document.querySelector(".placeholder");
const addMoreBtn = document.getElementById("addMoreBtn");
const imageCount = document.getElementById("imageCount");
const imageUpload = document.getElementById('imageUpload');
const infoBox = document.querySelector('.info-image-picker');
  const cardImage = document.querySelector('.image-advertisement');


imageUpload.addEventListener('change', function (e) {
  if (e.target.files.length > 0) {
    infoBox.classList.add('active');
  }
  
});

let images = [];
const MAX_IMAGES = 5;

// تابع نمایش اعلان سفارشی
function showCustomAlert(message, type = "error") {
  const alert = document.createElement("div");
  alert.classList.add("custom-alert", type);
  alert.innerHTML = `
    <div class="alert-content">
      <div class="alert-icon">
        <i class="fas ${type === "success" ? "fa-check-circle" : "fa-exclamation-circle"}"></i>
      </div>
      <div class="alert-message">${message}</div>
    </div>
  `;
  document.body.appendChild(alert);

  // نمایش با انیمیشن
  setTimeout(() => (alert.style.display = "block"), 100);

  // حذف خودکار
  setTimeout(() => {
    alert.classList.add("fade-out");
    setTimeout(() => alert.remove(), 500);
  }, 5000);
}

// انتخاب عکس‌ها
input.addEventListener("change", (event) => {
  const files = Array.from(event.target.files);

  if (images.length + files.length > MAX_IMAGES) {
    showCustomAlert("حداکثر ۵ تصویر می‌توانید انتخاب کنید.");
    return;
  }

  images.push(...files);
  updateUI();
});

// رندر تصاویر کوچک و اصلی
function renderGallery() {
  gallery.innerHTML = "";

  images.forEach((file, index) => {
    const reader = new FileReader();
    reader.onload = (e) => {
      const thumb = document.createElement("div");
      thumb.classList.add("thumb");
      thumb.innerHTML = `
        <img src="${e.target.result}" alt="thumb">
        <button onclick="removeImage(${index})">&times;</button>
      `;

      // ✅ کلیک روی بندانگشتی برای تغییر عکس اصلی و فعال کردنش
      thumb.querySelector("img").addEventListener("click", () => {
        mainPreview.src = e.target.result;
        mainPreview.hidden = false;
        placeholder?.style && (placeholder.style.display = 'none');
        cardImage.src = e.target.result;

        // حذف active از همه بندانگشتی‌ها
        document.querySelectorAll(".thumb").forEach(t => t.classList.remove("active"));
        // افزودن active به بندانگشتی انتخاب‌شده
        thumb.classList.add("active");
      });

      gallery.appendChild(thumb);

      // اگر اولین عکس است، به طور پیش‌فرض active شود
      if (index === 0) {
        thumb.classList.add("active");
      }
    };
    reader.readAsDataURL(file);
  });
}


// به‌روزرسانی ظاهر
function updateUI() {
  if (images.length > 0) {
    const lastImage = images[images.length - 1];
    const reader = new FileReader();
    reader.onload = (e) => {
      mainPreview.src = e.target.result;
      mainPreview.hidden = false;
      placeholder.style.display = "none";
              cardImage.src = e.target.result;

    };
    reader.readAsDataURL(lastImage);

    // نمایش دکمه +
    addMoreBtn.hidden = false;
    setTimeout(() => addMoreBtn.classList.add("show"), 100);
  }

  imageCount.textContent = `${images.length}/${MAX_IMAGES}`;
  renderGallery();
}

// حذف تصویر
function removeImage(index) {
  images.splice(index, 1);

  if (images.length === 0) {
    mainPreview.hidden = true;

    // 🔹 بازگرداندن استایل Flex برای placeholder
    placeholder.style.display = "flex";
    placeholder.style.flexDirection = "column";
    placeholder.style.alignItems = "center";
    placeholder.style.justifyContent = "center";

    addMoreBtn.classList.remove("show");
    setTimeout(() => (addMoreBtn.hidden = true), 300);

    // 🔹 غیرفعال کردن متن پیش‌نمایش
    infoBox.classList.remove('active');
  } else {
    const lastImage = images[images.length - 1];
    const reader = new FileReader();
    reader.onload = (e) => (mainPreview.src = e.target.result);
    reader.readAsDataURL(lastImage);
  }

  imageCount.textContent = `${images.length}/${MAX_IMAGES}`;
  renderGallery();
}

// کلیک روی دکمه +
addMoreBtn.addEventListener("click", () => input.click());


// نمایش اعلانات موجود در صفحه
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.custom-alert');
    alerts.forEach(alert => {
        alert.style.display = 'block';
        
        // بعد از 5 ثانیه، اعلان به تدریج ناپدید می‌شود
        setTimeout(function() {
            alert.classList.add('fade-out');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }, 5000);
    });
});

(function(){
  const MIN_VALUE = 300000;
  const MAX_VALUE = 1000000000;

  function formatWithCommas(n) {
    if (n === '') return '';
    // use en-US to have comma thousands separator
    return Number(n).toLocaleString('en-US');
  }

  function setError(input, msg) {
    input.classList.add('error');
    const err = input.nextElementSibling;
    if (err) err.textContent = msg;
  }

  function clearError(input) {
    input.classList.remove('error');
    const err = input.nextElementSibling;
    if (err) err.textContent = '';
  }

  function validateAndFormat(input) {
    const rawWithCommas = input.value;
    // remove commas for checking
    const cleaned = rawWithCommas.replace(/,/g, '');
    // Priority 1: empty
    if (!cleaned) {
      input.value = '';
      setError(input, 'مقدار نمی‌تواند خالی باشد');
      return;
    }

    // Priority 2: non-digit present?
    if (/\D/.test(cleaned)) {
      // show non-number error, but also remove non-digits for display
      const digitsOnly = cleaned.replace(/\D/g, '');
      input.value = formatWithCommas(digitsOnly);
      setError(input, 'مقدار باید عدد باشد');
      return;
    }

    // Now it's purely digits
    const num = parseInt(cleaned, 10);
    input.value = formatWithCommas(cleaned);

    // Priority 3: range check
    if (num < MIN_VALUE || num > MAX_VALUE) {
      setError(input, `عدد باید بین ${MIN_VALUE.toLocaleString()} تا ${MAX_VALUE.toLocaleString()} باشد`);
      return;
    }

    // valid
    clearError(input);
  }

  // attach events
  document.querySelectorAll('.price-input').forEach(input => {
    // inputmode numeric helps mobile keyboards
    input.setAttribute('inputmode', 'numeric');

    // On input: perform live validation & formatting
    input.addEventListener('input', function(e) {
      // preserve caret loosely: formatting resets caret but acceptable in many cases
      const before = this.selectionStart;
      // run validation & formatting
      validateAndFormat(this);
      // try to restore caret roughly near end (detailed caret math omitted for simplicity)
      this.setSelectionRange(this.value.length, this.value.length);
    });

    // also validate on paste (paste triggers input but to be safe)
    input.addEventListener('paste', function(e) {
      // small delay to let pasted value appear, then validate
      setTimeout(() => validateAndFormat(this), 0);
    });

    // optional: validate on blur too to ensure final state
    input.addEventListener('blur', function() {
      validateAndFormat(this);
    });
  });
})();

document.addEventListener("DOMContentLoaded", () => {

  // فیلدها
  const titleInput = document.querySelector('input[type="text"][placeholder="نام آگهی برای جذب کارفرما بسیار تاثیر گذار است"]');
  const descInput = document.querySelector('#project-desc');
  const minPriceInput = document.querySelector('#price');
  const serviceHidden = document.querySelector('#service-select');
  const serviceOptions = document.querySelectorAll('.service-option');
  const imageUpload = document.querySelector('#imageUpload');
  const mainPreview = document.querySelector('#mainPreview');

  // کارت پیش‌نمایش
  const cardTitle = document.querySelector('.card-body-advertisement h5');
  const cardService = document.querySelector('.card-body-advertisement h6');
  const cardDesc = document.querySelector('.card-body-advertisement p');
  const cardBudget = document.querySelector('.card-body-bottom h6');

  // --- تابع برای فرمت عدد به تومان
  const formatPrice = (val) => {
    return val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  };

  // --- به‌روزرسانی عنوان
  titleInput.addEventListener('input', () => {
    cardTitle.textContent = titleInput.value.trim() || "عنوان کارت";
  });

  // --- به‌روزرسانی توضیحات
  descInput.addEventListener('input', () => {
    cardDesc.textContent = descInput.value.trim() || 
      "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...";
  });

  // --- به‌روزرسانی سرویس
  serviceOptions.forEach(opt => {
    opt.addEventListener('click', () => {
      const value = opt.dataset.value;
      const text = opt.dataset.text;
      serviceHidden.value = value;
      document.querySelector('#service-selected-text').textContent = text;
      cardService.textContent = text !== "" ? text : "نوع سرویس";
      document.querySelector('#service-dropdown').style.display = "none";
    });
  });

  // --- به‌روزرسانی قیمت‌ها
  function updateBudget() {
    const min = minPriceInput.value.replace(/\D/g, "");
    if (min) {
      cardBudget.innerHTML = `از ${formatPrice(min)} <span class="price-label"></span> `;
    } else {
      cardBudget.innerHTML = 'از ... تا ... <span class="price-label"></span>';
    }
  }
  minPriceInput.addEventListener('input', updateBudget);

// --- برای ارسال به بک‌اند
const payBtn = document.querySelector('#pay-btn-ads');

payBtn.addEventListener('click', () => {
    const formData = new FormData();

    // CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;
    formData.append('_token', csrfToken);

    // بررسی حالت تمدید
    const renewInput = document.querySelector('input[name="renew_ad_id"]');
    const isRenew = renewInput !== null;

    if (isRenew) {
        // فقط آیدی آگهی را ارسال کن
        formData.append('ad_id', renewInput.value);
    } else {
        // ارسال فرم کامل برای آگهی جدید
        formData.append('title', titleInput.value);
        formData.append('description', descInput.value);
        formData.append('service', serviceHidden.value);
        formData.append('price', minPriceInput.value);

        // ارسال تگ‌ها
        window.selectedServices.forEach((tag, i) => {
            formData.append(`tags[${i}]`, tag);
        });

        // ارسال عکس‌ها
        if (images.length > 0) {
            formData.append('main_image', images[0]);
            images.slice(1).forEach((img, idx) => {
                formData.append(`gallery_images[${idx}]`, img);
            });
        }
    }

    // تعیین URL بر اساس نوع درخواست
    const url = isRenew ? '/ads/renew' : '/ads/store';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            if (window.alertManager) {
                window.alertManager.success(isRenew ? "آگهی با موفقیت تمدید شد" : "آگهی با موفقیت ثبت شد");
            } else {
                alert(isRenew ? "آگهی با موفقیت تمدید شد" : "آگهی با موفقیت ثبت شد");
            }

            setTimeout(() => {
                window.location.href = "/home/freelancer";
            }, 2000);
        } else {
            // اگر سرور آرایه خطا داد
            if (data.errors && Array.isArray(data.errors)) {
                data.errors.forEach(err => {
                    if (window.alertManager) {
                        window.alertManager.error(err);
                    } else {
                        alert(err);
                    }
                });
            } else {
                if (window.alertManager) {
                    window.alertManager.error("خطا در ثبت آگهی");
                } else {
                    alert("خطا در ثبت آگهی");
                }
            }
        }
    })
    .catch(err => {
        console.error(err);
        if (window.alertManager) {
            window.alertManager.error("خطا در ارسال درخواست");
        } else {
            alert("خطا در ارسال درخواست");
        }
    });
});



}); 
</script>
</body>
</html>
