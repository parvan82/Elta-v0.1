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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                    <button class="alert-close" type="button">
                        <i class="fas fa-times"></i>
                    </button>
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
                <button class="alert-close" type="button">
                    <i class="fas fa-times"></i>
                </button>
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
                <button class="alert-close" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif
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
        <div class="col-md-12 p-3">
            <form id="msform">
                @csrf      
                <h2 id="h11">ایجاد پروژه</h2>
                <ul id="progressbar">
                  <li>عنوان و توضیحات</li>
                  <li>سرویس و مهارت ها</li>
                  <li>بودجه و اولیت ها</li>
                  <li>خدمات التا</li>
                  <li>التا کارت پروژه</li>
                </ul>

                <fieldset dir="rtl">
                  <h2 class="fs-title">انتخاب عنوان و توضیحات</h2>
                  <h3 class="fs-subtitle"> عنوان پروژه :</h3>
                  <input class="mb-3" type="text" placeholder="نام پروژه برای جذب فریلنسر مهم است"/>
                  <h3 class="fs-subtitle"> توضیحات تکمیلی پروژه :</h3>
                  <textarea id="project-desc" placeholder="توضیحات پروژه را وارد کنید" style="height: 100px;"></textarea>
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
                          <div class="service-option" data-value="web-development" data-text="توسعه وب">توسعه وب</div>
                          <div class="service-option" data-value="mobile-development" data-text="توسعه موبایل">توسعه موبایل</div>
                          <div class="service-option" data-value="graphic-design" data-text="طراحی گرافیک">طراحی گرافیک</div>
                          <div class="service-option" data-value="content-writing" data-text="نویسندگی محتوا">نویسندگی محتوا</div>
                          <div class="service-option" data-value="marketing" data-text="بازاریابی">بازاریابی</div>
                          <div class="service-option" data-value="translation" data-text="ترجمه">ترجمه</div>
                          <div class="service-option" data-value="video-editing" data-text="تدوین ویدیو">تدوین ویدیو</div>
                          <div class="service-option" data-value="photography" data-text="عکاسی">عکاسی</div>
                          <div class="service-option" data-value="other" data-text="سایر">سایر</div>
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
                          <button type="button" class="skill-tabs-arrow right" aria-label="بعدی"><i class="fas fa-chevron-right"></i></button>
                          <div class="skill-tabs">
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
                          <button type="button" class="skill-tabs-arrow left" aria-label="قبلی"><i class="fas fa-chevron-left"></i></button>
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
                      
                        <div class="priority-option" data-value="quality" style="padding: 20px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">کیفیت بالا</h4>
                            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">اولویت با کیفیت و دقت کار</p>
                        </div>
                        
                        <div class="priority-option" data-value="speed" style="padding: 20px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">سرعت تحویل</h4>
                            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">اولویت با سرعت و زمان تحویل</p>
                        </div>
                      
                        <div class="priority-option" data-value="budget" style="padding: 20px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">بودجه کم</h4>
                            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">اولویت با هزینه کمتر</p>
                        </div>
                        
                        <div class="priority-option" data-value="balanced" style="padding: 20px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">تعادل</h4>
                            <p style="margin: 10px 0 0 0; color: #666; font-size: 14px;">تعادل بین کیفیت، سرعت و هزینه</p>
                        </div>

                    </div>

                    <h3 class="fs-subtitle"> بودجه پیشنهادی شما :</h3>
                    <div class="budget-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        
                        <div class="budget-option" data-value="low" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژه ساده</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">زیر 1 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="medium" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژه خیلی کوچیک</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">1 تا 5 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="high" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژۀ کوچیک</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">5 تا 10 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="high" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژۀ متوسط</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">10 تا 20 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="high" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژۀ بزرگ</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">20 تا 30 میلیون تومان</p>
                        </div>
                        
                        <div class="budget-option" data-value="high" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">پروژۀ بزرگ تر</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">بیشتر از 30 میلیون تومان </p>
                        </div>
                        
                        <div class="budget-option" data-value="negotiable" style="padding: 15px; border: 2px solid #ddd; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s ease; background: white;">
                            <h4 style="margin: 0; color: #333; font-size: 16px;">قابل مذاکره</h4>
                            <p style="margin: 5px 0 0 0; color: #666; font-size: 14px;">داخل چت روم التا به توافق خواهید رسید</p>
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
                        <div class="service" data-value="create-project" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: not-allowed; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: not-allowed;" checked disabled>
                            </div>  
                            <div style="flex: 1; text-align: right;">
                                <h4 style="margin: 0 0 10px 0; color: #333; font-size: 18px;">ایجاد پروژه</h4>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">پروژه شما برای هزاران فریلنسر که مهارت انجام پروژه شما را دارند از طریق ایمیل ارسال می شود.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۱۳۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- ۷۱ درصد تخفیف - بی‌نهایت -->
                        <div class="service" data-value="unlimited" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">۷۱ درصد تخفیف</h4>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">بی‌نهایت</span>
                                </div>
                                    <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">در پروژه بینهایت، کارفرما امکان تبادل اطلاعات تماس، ارتباط حضوری و استخدام فریلنسر را خواهد داشت. با انتخاب این گزینه، کمیسیون کارفرما ۰ محاسبه میشود.</p>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="text-decoration: line-through; color: #999; font-size: 14px;">۲,۰۰۰,۰۰۰ تومان</span>
                                    <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۵۹۹,۰۰۰ تومان</span>
                                </div>
                            </div>

                        </div>

                        <!-- مدیر پروژه -->
                        <div class="service" data-value="project-manager" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>  
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">مدیر پروژه</h4>
                                    <span style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">مدیر پروژه</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">با انتخاب مدیر پروژه اختصاصی، یک متخصص از طرف پونیشا کل فرآیند اجرای پروژه شما را مدیریت میکند؛ از انتخاب بهترین فریلنسر تا تحویل نهایی با کیفیت و در زمان مقرر.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۵,۰۰۰,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- ۴۰ درصد تخفیف - فوری و برجسته -->
                        <div class="service" data-value="urgent-featured" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">۴۰ درصد تخفیف</h4>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">فوری</span>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">برجسته</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">این دو ویژگی را با هم انتخاب کنید و ۴۰% تخفیف دریافت کنید</p>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="text-decoration: line-through; color: #999; font-size: 14px;">۴۹۸,۰۰۰ تومان</span>
                                    <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۲۹۹,۰۰۰ تومان</span>
                                </div>
                            </div>
                        </div>

                        <!-- فوری -->
                        <div class="service" data-value="urgent" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">فوری</h4>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">فوری</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">پروژه فوری نشانگر عجله کارفرما برای انجام هرچه سریع تر پروژه است و مورد توجه فریلنسرهای حرفه ای که علاقه دارند زودتر پروژه دریافت کنند قرار می گیرد.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۱۴۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- برجسته -->
                        <div class="service" data-value="featured" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">برجسته</h4>
                                    <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">برجسته</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">پروژه برجسته به دلیل برجسته بودن بیشتر مورد توجه فریلنسرهای حرفه ای قرار می گیرد و فریلنسرهای بیشتری در پروژه شرکت خواهند کرد.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۳۴۹,۰۰۰ تومان</span>
                            </div>
                          </div>

                        <!-- حرفه‌ای -->
                        <div class="service" data-value="professional" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">حرفه‌ای</h4>
                                    <span style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">حرفه‌ای</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">پروژه شما توسط متخصصین پونیشا ویرایش میشود تا توضیحات کامل و واضح تری نوشته شود و پیشنهادهای دقیقتری دریافت کنید.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۹۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- متمایز -->
                        <div class="service" data-value="distinctive" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">متمایز</h4>
                                    <span style="background: #f39c12; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">متمایز</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">رنگ پیش زمینه پروژه شما در فهرست پروژه ها متمایز از بقیه پروژه ها خواهد بود. این کار باعث میشود فریلنسرهای بیشتری به پروژه شما توجه کنند.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۹۹,۰۰۰ تومان</span>
                            </div>
                        </div>

                        <!-- میزبانی وب -->
                        <div class="service" data-value="web-hosting" style="display: flex; align-items: center; padding: 20px; border: 2px solid #ddd; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s ease;">
                            <div style="margin-left: 20px;">
                                <input type="checkbox" class="service-checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <h4 style="margin: 0; color: #333; font-size: 18px;">میزبانی وب</h4>
                                    <span style="background: #3498db; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold;">میزبانی وب</span>
                                </div>
                                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">با انتخاب این گزینه، تیم پونیشا در ساعات کاری با شما تماس میگیرد تا نیازهای هاست شما را بررسی کرده و تخفیف ویژه را در اختیارتان قرار دهد.</p>
                                <span style="color: #27AE60; font-weight: bold; font-size: 16px;">۰ تومان</span>
                            </div>
                        </div>

                    </div>  

                    <input type="button" name="next" class="next action-button" value="بعدی" />
                    <input type="button" name="previous" class="previous action-button" value="قبلی" />

                </fieldset>
                <fieldset dir="rtl">

                    <h2 class="fs-title">التا کارت پروژه</h2>
                    <h3 class="fs-subtitle"> پیش نمایشی از التا کارت پروژه شما :</h3>
                    <div class="user-card-link mt-5">
                        <div class="eltaCard mb-5" style="box-shadow: 0 0 20px #444;">
                            <div class="search-elta-card pt-5">
                                <div class="search-image-container">
                                    <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" alt="Profile Picture">
                                </div>
                                <div class="search-card-tags">
                                    <h6 class="username-search-card" style="margin: 2px; padding: 3px 8px;">{{ Auth::user()->username }}</h6>
                                    <div id="selected-services-tags" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                        <h6 class="tags" id="project-budget-tag" style="margin: 2px; padding: 3px 8px;">پروژه</h6>
                                    </div>
                                </div>
                                <div class="add-contact" data-user-id="{{ Auth::user()->id }}">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>
                                <div class="search-info-container" style="direction: rtl; text-align: right;">
                                    <h4 class="search-name" id="project-title">{{ Auth::user()->name }}</h4>
                                    <h6 class="search-scope-work" id="project-service">سرویس انتخاب شده</h6>
                                    <p class="search-about-me" id="project-description">توضیحات پروژه شما اینجا نمایش داده می‌شود</p>
                                </div>
                                <div class="search-card-skill" id="project-skills">
                                    <h6 class="userSkill-search-card">مهارت‌ها</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="fs-title">صورتحساب</h2>
                    <h3 class="fs-subtitle">جزئیات هزینه‌ها و مجموع پرداختی</h3>

                    <div id="invoice-container" style="max-width: 800px; margin: 0 auto; text-align: right;">
                        <div id="invoice-items" style="background: #fff; border: 2px solid #e1e8ed; border-radius: 12px; padding: 15px;">
                            <!-- ردیف‌های صورتحساب اینجا رندر می‌شوند -->
                        </div>
                        <div id="invoice-total" style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; background: #f8f9fa; border: 2px solid #e1e8ed; border-radius: 12px; padding: 12px 16px;">
                            <span style="font-weight: 700; color: #2C3E50;">مجموع قابل پرداخت</span>
                            <span id="invoice-total-amount" style="font-weight: 800; color: #27AE60;">۰ تومان</span>
                        </div>
                    </div>

                    <button type="button" id="pay-btn" class="action-button">ثبت پروژه</button>
                    <input type="button" class="previous action-button" value="قبلی" />

                </fieldset>

            </form>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<div id="overlay" class="overlay"></div>
<script src="../js/newProject.js"> </script>
<script>
document.getElementById("pay-btn").addEventListener("click", function() {
    // همه داده‌های فرم رو جمع کن
    let formData = new FormData(document.getElementById("msform"));

    fetch("/payment/request", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.url) {
            window.location.href = data.url; // رفتن به درگاه زرین‌پال
        }
    });
});
</script>

<!-- Alert System -->
<script src="../js/alerts.js"></script>
<script>
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
