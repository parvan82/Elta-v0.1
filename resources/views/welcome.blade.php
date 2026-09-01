<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>التا - تخصصی‌ترین پلتفرم فریلنسینگ ایران</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeMoreStyle.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #212529, #495057);
            overflow-x: hidden;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            z-index: 10;
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            color: #C6D4DF;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: #a2b6da;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #4caf50, #45a049);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.6);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: transparent;
            color: #a2b6da;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            border: 2px solid #a2b6da;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary-custom:hover {
            background: rgba(162, 182, 218, 0.1);
            color: #a2b6da;
            text-decoration: none;
            transform: translateY(-3px);
        }

        .section {
            padding: 80px 20px;
            position: relative;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #C6D4DF;
            text-align: center;
            margin-bottom: 3rem;
        }

        .feature-card {
            background: linear-gradient(135deg, rgba(107, 107, 107, 0.6), rgba(77, 77, 77, 0.45), rgba(38, 38, 38, 0.6));
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(162, 182, 218, 0.3);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #C6D4DF;
            margin-bottom: 15px;
        }

        .feature-description {
            color: #bdc3c7;
            line-height: 1.8;
            font-size: 1rem;
        }

        .stats-section {
            background: linear-gradient(135deg, rgba(33, 37, 41, 0.9), rgba(73, 80, 87, 0.9));
            padding: 60px 20px;
            border-radius: 30px;
            margin: 40px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 700;
            color: #4caf50;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.2rem;
            color: #a2b6da;
        }

        .projects-preview,
        .ads-preview {
            padding: 40px 0;
        }

        .preview-card {
            background: linear-gradient(135deg, #6b6b6b 0%, #4d4d4d 45%, #262626 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            margin: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            min-height: 300px;
            cursor: pointer;
        }

        .preview-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .preview-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #C6D4DF;
            margin-bottom: 15px;
        }

        .preview-description {
            color: #bdc3c7;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .preview-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .preview-tag {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            background: rgba(162, 182, 218, 0.2);
            color: #a2b6da;
            border: 1px solid rgba(162, 182, 218, 0.3);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-on-scroll-rtl {
            opacity: 0;
            transform: translatex(-30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll-rtl.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-on-scroll-ltr {
            opacity: 0;
            transform: translatex(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll-ltr.animated {
            opacity: 1;
            transform: translateY(0);
        }


        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(162, 182, 218, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: 20%;
            left: 15%;
            animation-delay: 5s;
        }

        .shape:nth-child(3) {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 30%;
            animation-delay: 10s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 992px) {
            .card-advertisement {
                min-width: 100%;
                height: auto;
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

            .distinguished-card .card-header-advertisement {
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
    </style>
</head>

<body>
    <section class="hero-section">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="hero-content">
            <div class="container">
                <img src="{{ asset('images/name.jpg') }}" alt="التا" style="max-width: 200px; margin-bottom: 2rem; filter: drop-shadow(0 4px 20px rgba(0,0,0,0.5));">
                <h1 class="hero-title animate-on-scroll">به التا خوش آمدید</h1>
                <p class="hero-subtitle animate-on-scroll">اولین و تخصصی‌ترین پلتفرم فریلنسینگ ایران</p>
                <div class="cta-buttons animate-on-scroll">
                    <a href="{{ route('login.form', ['role' => 'freelancer']) }}" class="btn-primary-custom">
                        <i class="fas fa-user-tie me-2"></i>
                        من فریلنسر هستم
                    </a>
                    <a href="{{ route('login.form', ['role' => 'employer']) }}" class="btn-secondary-custom">
                        <i class="fas fa-building me-2"></i>
                        من کارفرما هستم
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="stats-section animate-on-scroll">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" data-target="{{ $stats['total_users'] ?? 1000 }}" data-suffix="">0</div>
                            <div class="stat-label">کاربر فعال</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" data-target="{{ $stats['total_projects'] ?? 500 }}" data-suffix="">0</div>
                            <div class="stat-label">پروژه فعال</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" data-target="{{ $stats['total_ads'] ?? 300 }}" data-suffix="">0</div>
                            <div class="stat-label">آگهی ثبت شده</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" data-target="{{ str_replace('%', '', $stats['success_rate'] ?? '95') }}" data-suffix="%">0</div>
                            <div class="stat-label">نرخ موفقیت</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title animate-on-scroll">چرا التا؟</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">پرداخت امن</h3>
                        <p class="feature-description">
                            تمام تراکنش‌ها در التا با سیستم پرداخت امن انجام می‌شود تا حقوق فریلنسر و کارفرما هر دو حفظ شود.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">تعامل مستقیم</h3>
                        <p class="feature-description">
                            بدون واسطه گفت‌وگو کنید، شرایط پروژه را شفاف کنید و ارتباطی حرفه‌ای بسازید.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-rose-50 text-rose-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">دسترسی کامل</h3>
                        <p class="feature-description">
                            دسترسی به فریلنسرها، پروژه‌ها و شرکت‌ها. هر فرصتی برای همکاری مستقیم در دسترس شماست.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 3a2.828 2.828 0 0 1 4 4L7 21H3v-4L17 3z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">ثبت آگهی و پروژه</h3>
                        <p class="feature-description">
                            ثبت آگهی و پروژه می‌تواند درصد دریافت پروژه را بالا ببرد و به دیده شدن پروفایل کمک کند.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-yellow-50 text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="7"></circle>
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                            </svg>
                        </div>
                        <h3 class="feature-title">پروفایل حرفه‌ای</h3>
                        <p class="feature-description">
                            ساخت یک رزومه قابل اشتراک‌گذاری و نمایش نمونه کارها برای جذب پروژه‌های بیشتر.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card animate-on-scroll">
                        <div class="feature-icon bg-purple-50 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <h3 class="feature-title">تضمین کیفیت</h3>
                        <p class="feature-description">
                            سیستم بررسی و تایید کیفیت برای اطمینان از حرفه‌ای بودن فریلنسرها و پروژه‌ها.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($projects) && $projects->count() > 0)
    <section class="section projects-preview" style="background: rgba(0,0,0,0.2);">
        <div class="container">
            <h2 class="section-title animate-on-scroll">جدیدترین پروژه‌های التا</h2>
            <div class="row" style="margin: 0;">
                @foreach($projects->take(6) as $project)
                @php
                $hasDistinguishedTag = false;
                foreach($project->serviceTags ?? [] as $tag) {
                if($tag->name === 'متمایز') {
                $hasDistinguishedTag = true;
                break;
                }
                }
                $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
                $sortedTags = collect($project->serviceTags ?? [])->sortBy(function($tag) use ($tagOrder) {
                return array_search($tag->name, $tagOrder);
                })->values();
                @endphp
                <div class="col-lg-4 col-md-6 mb-4 ">
                    <a class="user-card-link"
                        href="{{ route('login.form', [
       'role' => 'freelancer',
       'redirect_to' => url('/content?type=project&id='.$project->id)
   ]) }}"
                        style="text-decoration:none;color:inherit;">
                        <div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }}">
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
                            @auth
                            <div class="add-contact project-card-favorite" data-user-id="{{ $project->user->id }}">
                                @if ($project->user->is_favorite ?? false)
                                <i class="fa-solid fa-user-check icon-anim"></i>
                                @else
                                <i class="fa-solid fa-user-plus icon-anim"></i>
                                @endif
                            </div>
                            @endauth
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">

                <a href="{{ route('login.form', [
    'redirect' => 'search-results'
]) }}" class="btn-secondary-custom">
                    مشاهده همه پروژه‌ها
                </a>
            </div>
        </div>
    </section>
    @endif

    @if(isset($ads) && $ads->count() > 0)
    <section class="section ads-preview">
        <div class="container" style="max-width: 1300px;">
            <h2 class="section-title animate-on-scroll">جدیدترین آگهی‌های التا</h2>
            <div class="row justify-content-center" style="row-gap:30px;">
                
                @php
                    $randomAds = $ads->shuffle()->take(6);
                    $leftAds = $randomAds->take(3);
                    $rightAds = $randomAds->skip(3)->take(3);
                @endphp

                <div class="col-lg-6 col-md-12 d-flex flex-column ">

                    @foreach($leftAds as $ad)
                        @php
                        $isDistinguished = $ad->tags->contains(fn($tag) => $tag->name === 'متمایز');
                        $mainImage = $ad->images->firstWhere('is_main', true);
                        @endphp

                        <div class="mb-4 animate-on-scroll-ltr" style="width:100%; max-width:360px;">
                        <a class="user-card-link"
                            href="{{ route('login.form', [
                                'role' => 'employer',
                                'redirect_to' => url('/content?type=ad&id='.$ad->id)
                            ]) }}"
                            style="text-decoration:none;color:inherit;">



                            <div class="card-advertisement {{ $isDistinguished ? 'distinguished-card' : '' }}">
                                <div class="card-header-advertisement">
                                    <img src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" class="image-advertisement">
                                </div>
                                <div class="card-body-top">
                                    <span class="services-tags">
                                        {{ $ad->user->username }}@
                                    </span>
                                    @auth
                                    <div class="add-contact" data-user-id="{{ $ad->user->id }}">
                                        @if ($ad->is_favorite ?? false)
                                        <i class="fa-solid fa-user-check icon-anim"></i>
                                        @else
                                        <i class="fa-solid fa-user-plus icon-anim"></i>
                                        @endif
                                    </div>
                                    @endauth
                                </div>
                                <div class="card-body-advertisement">
                                    <h5>{{ $ad->title }}</h5>
                                    <h6>{{ $ad->service_type }}</h6>
                                    <p style="min-height: 113px">{!! nl2br(e(Str::limit($ad->description, 200))) !!}</p>
                                </div>
                                <div class="card-body-bottom">
                                    <h6>
                                        از {{ number_format((float) $ad->price * 1000000, 0, '.', ',') }}<span class="price-label"></span>
                                    </h6>
                                </div>
                            </div>
                        </a>
                        </div>
                    @endforeach

                </div>

                <div class="col-lg-6 col-md-12 d-flex flex-column">

                    @foreach($rightAds as $ad)
                        @php
                        $isDistinguished = $ad->tags->contains(fn($tag) => $tag->name === 'متمایز');
                        $mainImage = $ad->images->firstWhere('is_main', true);
                        @endphp

                        <div class="mb-4 animate-on-scroll-rtl" style="width:100%; max-width:360px;">
                        <a class="user-card-link"
                            href="{{ route('login.form', [
                                'role' => 'employer',
                                'redirect_to' => url('/content?type=ad&id='.$ad->id)
                            ]) }}"
                            style="text-decoration:none;color:inherit;">

                            <div class="card-advertisement {{ $isDistinguished ? 'distinguished-card' : '' }}">
                                <div class="card-header-advertisement">
                                    <img src="{{ $mainImage ? asset('storage/' . $mainImage->image_path) : asset('storage/images/default.jpg') }}" class="image-advertisement">
                                </div>
                                <div class="card-body-top">
                                    <span class="services-tags">
                                        {{ $ad->user->username }}@
                                    </span>
                                    @auth
                                    <div class="add-contact" data-user-id="{{ $ad->user->id }}">
                                        @if ($ad->is_favorite ?? false)
                                        <i class="fa-solid fa-user-check icon-anim"></i>
                                        @else
                                        <i class="fa-solid fa-user-plus icon-anim"></i>
                                        @endif
                                    </div>
                                    @endauth
                                </div>
                                <div class="card-body-advertisement">
                                    <h5>{{ $ad->title }}</h5>
                                    <h6>{{ $ad->service_type }}</h6>
                                    <p style="min-height: 113px">{!! nl2br(e(Str::limit($ad->description, 200))) !!}</p>
                                </div>
                                <div class="card-body-bottom">
                                    <h6>
                                        از {{ number_format((float) $ad->price * 1000000, 0, '.', ',') }}<span class="price-label"></span>
                                    </h6>
                                </div>
                            </div>

                        </a>
                        </div>
                    @endforeach

                </div>


            </div>

            <div class="text-center mt-4">
                <a href="{{ route('login.form', [
    'redirect' => 'search-results'
]) }}" class="btn-secondary-custom">
                    مشاهده همه آگهی‌ها
                </a>
            </div>
        </div>
    </section>
    @endif

    <section class="section" style="background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(69, 160, 73, 0.1));">
        <div class="container text-center">
            <div class="animate-on-scroll">
                <h2 class="section-title">آماده شروع هستید؟</h2>
                <p style="color: #a2b6da; font-size: 1.2rem; margin-bottom: 2rem;">
                    همین حالا به التا بپیوندید و تجربه فریلنسینگ حرفه‌ای را شروع کنید
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('login.form', ['role' => 'freelancer']) }}" class="btn-primary-custom">
                        <i class="fas fa-user-plus me-2"></i>
                        ثبت‌نام به عنوان فریلنسر
                    </a>
                    <a href="{{ route('login.form', ['role' => 'employer']) }}" class="btn-secondary-custom">
                        <i class="fas fa-building me-2"></i>
                        ثبت‌نام به عنوان کارفرما
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="app-content fade-in" style="opacity: 1; transform: translateY(0px); transition: opacity 1s ease-out, transform 1s ease-out; animation: 1s ease-out 0.7s 1 normal forwards running fadeIn;">
        <div class="benefits">
            @foreach($randomRows as $index => $usersGroup)
            <div class="basic-marquee {{ $index % 2 == 0 ? 'basic-marquee-1' : 'basic-marquee-2' }}">
                @foreach($usersGroup as $user)
                <a href="{{ url('profile/' . $user->id) }}">
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
    <footer class="border border-slate-100 bg-white rounded-2xl mx-auto mt-[100px] z-50 relative mb-3" dir="rtl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 justify-between items-center gap-4">
                <div class="flex flex-col items-center justify-center text-center w-55">
                    <img id="img-icon" class="w-35 h-35" src="{{ asset('images/name.jpg') }}" alt="" style="filter: brightness(1.2);">
                    <p class="text-sm text-slate-400 mt-3">تخصصی‌ترین پلتفرم فریلنسینگ ایران</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white">تماس</h4>
                    <ul class="mt-3 space-y-2 text-sm text-slate-400">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            info@elta.ir
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            021-12345678
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-100 text-xs text-slate-500 flex flex-col sm:flex-row justify-between gap-2" style="border-color: rgba(255,255,255,0.1);">
                <p dir="ltr">© {{ date('Y') }} elta. تمامی حقوق محفوظ است.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-primary-500" style="color: #a2b6da;">قوانین</a>
                    <a href="#" class="hover:text-primary-500" style="color: #a2b6da;">حریم خصوصی</a>
                    <a href="#" class="hover:text-primary-500" style="color: #a2b6da;">سوالات متداول</a>
                </div>
            </div>
        </div>
    </footer>

    <script>

        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const suffix = element.getAttribute('data-suffix') || '';
            const duration = 2000;
            const steps = 60;
            const increment = target / steps;
            let current = 0;
            let stepCount = 0;

            const timer = setInterval(() => {
                stepCount++;
                current += increment;

                if (stepCount >= steps) {
                    current = target;
                    clearInterval(timer);
                }
                const formattedNumber = Math.floor(current).toLocaleString('fa-IR');
                element.textContent = formattedNumber + suffix;
            }, duration / steps);
        }

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');

                    if (entry.target.classList.contains('stats-section')) {
                        const statNumbers = entry.target.querySelectorAll('.stat-number[data-target]');
                        statNumbers.forEach((statNumber, index) => {
                            setTimeout(() => {
                                animateCounter(statNumber);
                            }, index * 100);
                        });
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        window.addEventListener('load', () => {
            document.querySelectorAll('.hero-content .animate-on-scroll').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animated');
                }, index * 200);
            });
        });
        document.querySelectorAll('.animate-on-scroll-rtl').forEach(el => {
            observer.observe(el);
        });

        window.addEventListener('load', () => {
            document.querySelectorAll('.hero-content .animate-on-scroll-rtl').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animated');
                }, index * 200);
            });
        });
        document.querySelectorAll('.animate-on-scroll-ltr').forEach(el => {
            observer.observe(el);
        });

        window.addEventListener('load', () => {
            document.querySelectorAll('.hero-content .animate-on-scroll-ltr').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animated');
                }, index * 200);
            });
        });

        document.addEventListener('click', function(event) {
            const addContactBtn = event.target.closest('.add-contact');
            if (!addContactBtn) return;

            event.preventDefault();
            event.stopPropagation();

            var userId = addContactBtn.getAttribute('data-user-id');
            if (!userId) {
                console.warn('data-user-id not found on add-contact button');
                return;
            }

            var icon = addContactBtn.querySelector('i');
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
                        body: JSON.stringify({
                            favorite_id: userId
                        })
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
                    })
                    .catch(error => {
                        console.error('Error toggling favorite:', error);
                        icon.classList.remove('icon-fade');
                        icon.className = addContactBtn.querySelector('i').classList.contains('fa-user-check') ?
                            'fa-solid fa-user-check icon-anim' :
                            'fa-solid fa-user-plus icon-anim';
                    });
            }, 150);
        });
    </script>
    <script src="{{ asset('js/homeFreelancer.js') }}"></script>
</body>

</html>