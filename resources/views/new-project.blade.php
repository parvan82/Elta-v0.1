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
                <h2 id="h11">{{ $renewProjectId ? 'تمدید پروژه' : 'ایجاد پروژه' }}</h2>
                <ul id="progressbar" class="{{ $renewProjectId ? 'progressbar-disabled' : '' }}">
                    @if(!($renewProjectId ?? false))
                        <li class="active">عنوان و توضیحات</li>
                        <li>مهارت و سرویس</li>
                        <li>اولویت و بودجه</li>
                        <li>خدمات التا</li>
                        <li>التا کارت پروژه</li>
                    @else
                        <li class="active">التا کارت آگهی</li>
                    @endif
                </ul>


                <fieldset dir="rtl">
                  <h2 class="fs-title">انتخاب عنوان و توضیحات</h2>
                  <h3 class="fs-subtitle"> عنوان پروژه :</h3>
                  <input class="mb-3" type="text" name="title" placeholder="نام پروژه برای جذب فریلنسر مهم است"/>
                  <h3 class="fs-subtitle"> توضیحات تکمیلی پروژه :</h3>
                  <textarea id="project-desc" name="description" placeholder="توضیحات پروژه را وارد کنید" style="height: 100px;"></textarea>
                  <input type="button" name="next" class="next action-button" value="بعدی" />
                </fieldset>

                <fieldset dir="rtl">
                    <h2 class="fs-title" >سرویس و مهارت های مورد نیاز پروژه</h2>
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

                    <h3 class="fs-subtitle"> مهارت های مورد نیاز :</h3>

                    <div class="skill-selector-container">
                        <div class="skill-search-container">
                          <input type="text" id="skill-search" class="skill-search-input" placeholder="جستجو در مهارت‌ها..." dir="rtl" style="padding: 12px 40px 12px 15px;">
                          <i class="fas fa-search skill-search-icon "></i>
                        </div>

                        <div class="skill-tabs-wrapper">
                          <div class="skill-tabs">
                            <div class="b2">
                                <button type="button" class="skill-tab active" data-category="devops">برنامه نویسی</button>
                                <button type="button" class="skill-tab" data-category="system">سیستم عامل</button>
                                <button type="button" class="skill-tab" data-category="design">طراحی</button>
                                <button type="button" class="skill-tab" data-category="architecture">معماری</button>
                                <button type="button" class="skill-tab" data-category="civil">عمران</button>
                                <button type="button" class="skill-tab" data-category="crm">CRM</button>
                                <button type="button" class="skill-tab" data-category="erp">ERP</button>
                                <button type="button" class="skill-tab" data-category="marketing">تولید محتوا</button>
                                <button type="button" class="skill-tab" data-category="database">دیتابیس</button>
                                <button type="button" class="skill-tab" data-category="data">داده کاوی</button>
                                <button type="button" class="skill-tab" data-category="game">بازی سازی</button>
                                <button type="button" class="skill-tab" data-category="music">آهنگسازی</button>
                            </div>
                          </div>
                        </div>

                        <div class="skill-category" id="category-devops">
                          <div class="skill-grid" id="skills-grid-devops">
                          </div>
                        </div>

                        <div class="skill-category" id="category-system">
                          <div class="skill-grid" id="skills-grid-system">
                          </div>
                        </div>

                        <div class="skill-category" id="category-design">
                          <div class="skill-grid" id="skills-grid-design">
                          </div>
                        </div>

                        <div class="skill-category" id="category-architecture">
                          <div class="skill-grid" id="skills-grid-architecture">
                          </div>
                        </div>

                        <div class="skill-category" id="category-civil">
                          <div class="skill-grid" id="skills-grid-civil">
                          </div>
                        </div>

                        <div class="skill-category" id="category-crm">
                          <div class="skill-grid" id="skills-grid-crm">
                          </div>
                        </div>

                        <div class="skill-category" id="category-erp">
                          <div class="skill-grid" id="skills-grid-erp">
                          </div>
                        </div>

                        <div class="skill-category" id="category-marketing">
                          <div class="skill-grid" id="skills-grid-marketing">
                          </div>
                        </div>

                        <div class="skill-category" id="category-database">
                          <div class="skill-grid" id="skills-grid-database">
                          </div>
                        </div>

                        <div class="skill-category" id="category-data">
                          <div class="skill-grid" id="skills-grid-data">
                          </div>
                        </div>

                        <div class="skill-category" id="category-game">
                          <div class="skill-grid" id="skills-grid-game">
                          </div>
                        </div>

                        <div class="skill-category" id="category-music">
                          <div class="skill-grid" id="skills-grid-music">
                          </div>
                        </div>
                    </div>

                    <div id="selected-skills" class="selected-skills-container" style="margin-top: 15px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; min-height: 50px;">
                      <h4 style="font-size: 14px; color: #666; margin-bottom: 10px;">مهارت‌های انتخاب شده:</h4>
                      <div id="skills-tags" style="display: flex; flex-wrap: wrap; gap: 5px;">

                      </div>
                    </div>

                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                </fieldset>
                <fieldset dir="rtl">
                    <h2 class="fs-title">بودجه و اولیت های شما</h2>
                    <h3 class="fs-subtitle"> اولیت های شما به  فریلنسرها در کیفیت پروژه و میزان بودجه کمک میکند :</h3>
                    <div class="priority-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                      
                        <div class="priority-option" data-value="اولویت با کیفیت و دقت کار">
                            <h4>کیفیت بالا</h4>
                            <p>اولویت با کیفیت و دقت کار</p>
                        </div>
                        
                        <div class="priority-option" data-value="اولویت با سرعت و زمان تحویل">
                            <h4>سرعت تحویل</h4>
                            <p>اولویت با سرعت و زمان تحویل</p>
                        </div>
                      
                        <div class="priority-option" data-value="اولویت با هزینه کمتر">
                            <h4>بودجه کم</h4>
                            <p>اولویت با هزینه کمتر</p>
                        </div>
                        
                        <div class="priority-option" data-value="تعادل بین کیفیت، سرعت و هزینه">
                            <h4>تعادل</h4>
                            <p>تعادل بین کیفیت، سرعت و هزینه</p>
                        </div>

                    </div>

                    <h3 class="fs-subtitle"> بودجه پیشنهادی شما :</h3>
                    
                    <div class="budget-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        
                        <div class="budget-option" data-value="پروژه ساده">
                            <h4>پروژه ساده</h4>
                            <p>زیر 1 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="پروژه خیلی کوچیک">
                            <h4>پروژه خیلی کوچیک</h4>
                            <p>1 تا 5 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="5 تا 10 میلیون تومان">
                            <h4>پروژۀ کوچیک</h4>
                            <p>5 تا 10 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="10 تا 20 میلیون تومان">
                            <h4>پروژۀ متوسط</h4>
                            <p>10 تا 20 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="20 تا 30 میلیون تومان">
                            <h4>پروژۀ بزرگ</h4>
                            <p>20 تا 30 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="بیشتر از 30 میلیون تومان">
                            <h4>پروژۀ بزرگ تر</h4>
                            <p>بیشتر از 30 میلیون تومان </p>
                        </div>
                        
                        <div class="budget-option" data-value="قابل مذاکره">
                            <h4>قابل مذاکره</h4>
                            <p>داخل چت روم التا به توافق خواهید رسید</p>
                        </div>

                    </div>

                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />
                
                </fieldset>
                <fieldset dir="rtl">
                    <h2 class="fs-title">سرویس ها و خدمات التا</h2>
                    <h3 class="fs-subtitle">خدمات اضافی برای بهبود پروژه شما:</h3>

                    <div class="elta-services" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px;">

                        <!-- ایجاد پروژه -->
                        <div class="service" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: not-allowed; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: not-allowed;" checked disabled>
                            </div>  
                            <div style="flex: 1; text-align: right;">
                                <h4 style="margin: 0 0 10px 0; color: #333; font-size: 18px;">ایجاد پروژه در التا</h4>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">پروژه‌ خود را در التا ثبت کنید تا در کوتاه‌ترین زمان، به هزاران فریلنسر متخصص در حوزه‌ مدنظر شما معرفی شود. فرصتی برای همکاری با بهترین‌ها در انتظار شماست.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۱۳۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- مدیر پروژه -->
                        <div class="service" data-value="مدیر پروژه" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>  
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                <h4 style="margin: 0; color: #333; font-size: 18px;">مدیر پروژه التا</h4>
                                <span style="background: #007bff; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">مدیر پروژه</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">با انتخاب مدیر پروژه در التا، اجرای پروژه‌تان را به یک متخصص حرفه‌ای بسپارید. مدیر پروژه از لحظه انتخاب فریلنسر تا تحویل نهایی، بر کیفیت، زمان‌بندی و جزئیات کار نظارت می‌کند تا تجربه‌ای بدون دغدغه برای شما رقم بخورد.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۵,۰۰۰,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- فوری -->
                        <div class="service" data-value="فوری" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">فوری</h4>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">فوری</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">اگر زمان برای شما حیاتی است، پروژه خود را به‌صورت فوری در التا ثبت کنید.  این نوع پروژه‌ها در اولویت فریلنسرهای فعال و با‌انگیزه قرار می‌گیرند تا در سریع‌ترین زمان ممکن، با حفظ کیفیت، کار شما را تحویل دهند.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۱۴۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- تخصصی -->
                        <div class="service" data-value="تخصصی" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">تخصصی</h4>
                                    <span style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">تخصصی</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">با فعال‌سازی حالت <strong>پروژه حرفه‌ای</strong> در التا، توضیحات پروژه‌ شما توسط تیم متخصص بازبینی و بهینه‌سازی می‌شود تا شفاف‌تر، دقیق‌تر و جذاب‌تر برای فریلنسرها نمایش یابد.  نتیجه؟ پیشنهادهای با‌کیفیت‌تر و همکاری با افراد حرفه‌ای‌تر.</p>                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۹۹,۰۰۰ تومان</span>
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
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۹۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                    </div>  

                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />

                </fieldset>
                <fieldset dir="rtl">
                    @php
                        $renewProjectId = request()->get('renew');
                        $step = request()->get('step', 1);
                    
                        // پروژه تمدید شده
                        $renewProject = $renewProjectId ? \App\Models\NewProject::with('skills','serviceTags','user')->find($renewProjectId) : null;
                    
                        // برای حالت عادی از $project استفاده می‌کنیم
                        $displayProject = $renewProject ?? $project ?? null;
                    
                        $hasDistinguishedTag = false;
                        $sortedTags = collect([]);
                        if($displayProject) {
                            foreach($displayProject->serviceTags ?? [] as $tag) {
                                if($tag->name === 'متمایز') $hasDistinguishedTag = true;
                            }
                        
                            $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
                            $sortedTags = collect($displayProject->serviceTags ?? [])->sortBy(function($tag) use ($tagOrder){
                                return array_search($tag->name, $tagOrder);
                            })->values();
                        }
                    @endphp
                    
                    <script>
                        window.isRenewProject = {{ $renewProject ? 'true' : 'false' }};
                        window.renewProjectData = {!! $renewProject ? $renewProject->toJson() : 'null' !!};
                    </script>
                    
                    <h2 class="fs-title">التا کارت پروژه</h2>
                    <h3 class="fs-subtitle">پیش نمایشی از التا کارت پروژه شما :</h3>
                    
                    <div class="user-card-link mt-5 mb-3">
                    
                        @if($renewProject)
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
                        @else                            

                        
                           <div class="project-card" id="project-card">
                                <div class="project-card-header">
                                    <div class="project-card-avatar">
                                        <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" alt="Profile">
                                    </div>
                                </div>
                                   
                                <div class="project-card-tags dynamic-tag-box" id="selected-services-tags">
                                                            
                                </div>
                                                            
                                                            
                                {{-- عنوان پروژه --}}
                                <h3 class="project-card-title" id="project-title">{{ Auth::user()->name }}</h3>
                                                            
                                {{-- بودجه --}}
                                <div class="project-card-budget" id="project-budget-tag"></div>
                                                            
                                {{-- توضیحات --}}
                                <p class="project-card-description" id="project-description">توضیحات پروژه شما اینجا نمایش داده می‌شود</p>
                                                            
                                {{-- اولویت --}}
                                <div class="project-card-priority">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span id="project-priority">اولویت پروژه</span>
                                </div>
                                                            
                                {{-- مهارت‌ها --}}
                                <div class="project-card-skills dynamic-skill-box" id="project-skills">
                                        <span class="project-skill-pill">مهارت‌ها</span>
                                </div>
                                                            
                                <div class="add-contact project-card-favorite">
                                    <i class="fa-solid fa-user-plus icon-anim"></i>
                                </div>
                                                            
                            </div>
                        @endif
                                            
                    </div>

                    <h2 class="fs-title">صورتحساب</h2>
                    <h3 class="fs-subtitle">جزئیات هزینه‌ها و مجموع پرداختی</h3>

                    <div id="invoice-container" style="max-width: 800px; margin: 0 auto; text-align: right;">
                        <div id="invoice-items">
                            <!-- ردیف‌های صورتحساب اینجا رندر می‌شوند -->
                        </div>
                        <div id="invoice-total" style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; ">
                            <span style="font-weight: 700; color: white;">مجموع قابل پرداخت</span>
                            <span id="invoice-total-amount" style="color: #27AE60;">۰ تومان</span>
                        </div>
                    </div>
                    
                    
                    <button type="button" id="pay-btn" class="action-button">
                        {{ $renewProjectId ? 'تمدید پروژه' : 'ثبت پروژه' }}
                    </button>

                    @if($renewProjectId)
                        <input type="hidden" name="renew_project_id" value="{{ $renewProjectId }}">
                    @endif


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


<!-- Alert System -->
<script src="../js/alerts.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function () {
    const step = {{ $step }};
    const renewId = "{{ $renewProjectId }}";

    if (step == 5) {
        // همه fieldset ها
        const fieldsets = document.querySelectorAll("fieldset");
        const progressItems = document.querySelectorAll("#progressbar li");

        fieldsets.forEach((fs, i) => {
            fs.style.display = (i === 4) ? "block" : "none";
        });

        progressItems.forEach((li, i) => {
            if (i <= 4) li.classList.add("active");
        });

        // اگر تمدید بود → آیدی رو نگه دار
        if (renewId) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "renew_project_id";
            input.value = renewId;
            document.querySelector("form")?.appendChild(input);
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const payBtn = document.getElementById("pay-btn");
    if (!payBtn) return;

    payBtn.addEventListener("click", function (e) {
        e.preventDefault();

        const form = document.getElementById("msform");
        if (!form) return;

        const formData = new FormData(form);

        // بررسی حالت تمدید
        const renewId = document.querySelector('input[name="renew_project_id"]')?.value;
        const isRenew = !!renewId;
        if (isRenew) {
            formData.append("renew_project_id", renewId);
        }

        // اگر حالت تمدید است، فقط renew_project_id را ارسال کن
        if (!isRenew) {
            // اضافه کردن مهارت‌ها
            if (window.selectedSkills && window.selectedSkills.length > 0) {
                const skillsForSubmit = window.selectedSkills.map(skill => ({
                    skill: skill.text || skill.value,
                }));
                formData.append("selected_skills", JSON.stringify(skillsForSubmit));
            }

            // اضافه کردن سرویس‌های التا (selected_services)
            if (window.selectedServices && window.selectedServices.length > 0) {
                const eltaServices = window.selectedServices.filter(s => s !== 'create-project');
                if (eltaServices.length > 0) {
                    formData.append("selected_services", JSON.stringify(eltaServices));
                }
            }

            // اضافه کردن بودجه
            const selectedBudget = document.querySelector(".budget-option.selected")?.getAttribute("data-value");
            if (selectedBudget) {
                formData.append("budget", selectedBudget);
            }

            // اضافه کردن اولویت
            const selectedPriority = document.querySelector(".priority-option.selected")?.getAttribute("data-value");
            if (selectedPriority) {
                formData.append("priority", selectedPriority);
            }

            // اضافه کردن سرویس اصلی (اطمینان از وجود آن)
            const serviceValue = document.querySelector("#service-select")?.value;
            if (serviceValue) {
                // اگر از قبل وجود دارد، آن را حذف کن و دوباره اضافه کن تا مطمئن شویم
                if (formData.has("service")) {
                    formData.delete("service");
                }
                formData.append("service", serviceValue);
            }
        }

        // ارسال با fetch
        fetch("/home/new-project", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')?.value || ""
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const msg = isRenew ? "آگهی با موفقیت تمدید شد" : "آگهی با موفقیت ثبت شد";
                if (window.alertManager) {
                    window.alertManager.success(msg);
                } else {
                    alert(msg);
                }

                // انتقال بعد از ۲ ثانیه
                setTimeout(() => {
                    window.location.href = "/home/profile/employer";
                }, 2000);

            } else {
                // نمایش خطاهای سرور
                if (data.errors && Array.isArray(data.errors)) {
                    data.errors.forEach(err => {
                        if (window.alertManager) {
                            window.alertManager.error(err);
                        } else {
                            alert(err);
                        }
                    });
                } else if (data.message) {
                    if (window.alertManager) {
                        window.alertManager.error(data.message);
                    } else {
                        alert(data.message);
                    }
                } else {
                    const msg = "خطا در ثبت آگهی";
                    if (window.alertManager) {
                        window.alertManager.error(msg);
                    } else {
                        alert(msg);
                    }
                }
            }
        })
        .catch(err => {
            console.error(err);
            const msg = "خطا در ارسال درخواست";
            if (window.alertManager) {
                window.alertManager.error(msg);
            } else {
                alert(msg);
            }
        });
    });
});


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
</script>
</body>
</html>
