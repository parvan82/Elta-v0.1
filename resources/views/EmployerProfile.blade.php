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
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.css') }}">

    <link rel="stylesheet" href="/css/profile.css">
    <style>
           .about-click {
    cursor: pointer;
}

        .wallet-top,
.wallet-middle,
.wallet-bottom {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .open-project , .expired-project , .closed-project{
            width: 100%;
            height: 100%;
            bottom: -8px;
            right: -8px;
            border-radius: 10px;
        }
        .title.open-project , .title.expired-project , .title.closed-project{
width: 90px;
    height: 27px;
    top: -28px;
    left: 25px;
    position: absolute;
    border-radius: 10px 10px 0px 0px;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 600;
    font-size: 0.85rem;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    border: none;
    padding-bottom: 5px;
}
        }
        .open-project {    
    border: 8px solid #28a745;
}
.title.open-project{
        background: rgba(40, 167, 68, 0.4); /* سبز با شفافیت 40% */
}

.closed-project {             
    border: 8px solid #ffc107;
}
.title.closed-project{
    background: rgba(255, 193, 7, 0.4); /* زرد */

}
.expired-project {            
    border: 8px solid #dc3545;
}
.title.expired-project{
        background: rgba(220, 53, 69, 0.4); /* قرمز */

}
   .project-expired {
    position: relative;
}

.project-expired .search-elta-card {
    filter: grayscale(100%);
    background-color: #444;
}

.disabled-link {
    pointer-events: none;
    cursor: default;
}
.renew-overlay {
    position: absolute;
    top: -25px;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;

    backdrop-filter: blur(1px);
    -webkit-backdrop-filter: blur(2px);
clip-path: polygon(0 26px, 100% 0, 100% 100%, 0 100%);
}

.renew-btn {
    background: #dc3545;
    color: #fff;
    padding: 12px 28px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;

    box-shadow:
        0 0 14px rgba(220, 53, 69, 0.45),
        0 0 30px rgba(220, 53, 69, 0.25);

    animation: softPulse 2.5s infinite;
    transition: transform .25s ease, box-shadow .25s ease;
}

.renew-btn:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow:
        0 0 22px rgba(220, 53, 69, 0.65),
        0 0 55px rgba(220, 53, 69, 0.4);
}
@keyframes softPulse {
    0% {
        box-shadow: 0 0 14px rgba(220,53,69,.45);
    }
    50% {
        box-shadow: 0 0 22px rgba(220,53,69,.65);
    }
    100% {
        box-shadow: 0 0 14px rgba(220,53,69,.45);
    }
}

    </style>
    </head>
<body>
    <div class="container">
        <div class="main-body">
            <nav class="breadcrumb">
                <img id="img-icon" src="{{ asset('images/name.jpg') }}" alt="">
            </nav>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3 d-flex flex-column">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="profile-container " >
                                    <button class="editBtn editProfileBtn" id="editBtn" onclick="openPopup()">
                                        <svg height="1em" viewBox="0 0 512 512">
                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                        </svg>
                                    </button>
                                    <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}"  class="rounded-circle" width="150" height="150">
                                </div>
                                <div id="editProfilePopup" class="popup">
                                    <div class="popup-content" >
                                        <div class="d-flex justify-content-between">
                                            <span class="closeBtn"  onclick="closePopup()"><i class="bi bi-x sign"></i></span>
                                            <h4 class="m-0">پروفایل</h4>
                                        </div>
                                        <div class="popup-body">
                                            <div class="left-column">
                                                <div class="profile-container">
                                                    <label for="profilePicInput" class="profile-pic-label">
                                                        <img id="profilePic" src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" class="rounded-circle" width="150" height="150" alt="Profile Picture">
                                                    </label>                                                   

                                                    <span class="addPhotoBtn" id="openFilePicker">
                                                        <input type="file" id="profilePicInput" class="profile-pic-input" onchange="previewProfilePic(event)" hidden>
                                                        <i class="bi bi-plus"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="right-column">
                                                <div class="input-group">
                                                    <label for="companyName">نام برند/شرکت</label>
                                                    <input type="text" id="companyName" placeholder="نام برند/سازمان خود را وراد کنید">
                                                </div>
                                                <div class="input-group">
                                                    <label for="workArea">صنعت</label>
                                                    <select name="workArea" id="workArea" class="input select2">
                                                        <option value="حسابرسی">حسابرسی</option>
                                                        <option value="بانکداری">بانکداری</option>
                                                        <option value="سرمایه گذاری و مالی">سرمایه گذاری و مالی</option>
                                                        <option value="کالاهای مصرفی و تند گردش">کالاهای مصرفی و تند گردش</option>
                                                        <option value="کالاهای الکتریکی و لوازم خانگی">کالاهای الکتریکی و لوازم خانگی</option>
                                                        <option value="خودرو و صنایع وابسته">خودرو و صنایع وابسته</option>
                                                        <option value="فناوری اطلاعات / نرم افزار و سخت افزار">فناوری اطلاعات / نرم افزار و سخت افزار</option>
                                                        <option value="اینترنت / تجارت الکترونیک / خدمات آنلاین">اینترنت / تجارت الکترونیک / خدمات آنلاین</option>
                                                        <option value="تلکام">تلکام</option>
                                                        <option value="تولیدی / صنعتی">تولیدی / صنعتی</option>
                                                        <option value="نفت، گاز و پتروشیمی">نفت، گاز و پتروشیمی</option>
                                                        <option value="انرژی / نیروگاهی">انرژی / نیروگاهی</option>
                                                        <option value="تجارت / بازرگانی">تجارت / بازرگانی</option>
                                                        <option value="خدمات درمانی و سلامتی">خدمات درمانی و سلامتی</option>
                                                        <option value="تجهیزات پزشکی">تجهیزات پزشکی</option>
                                                        <option value="دارو">دارو</option>
                                                        <option value="آرایشگاه / کلینیک زیبایی">آرایشگاه / کلینیک زیبایی</option>
                                                        <option value="مد و کالاهای لوکس">مد و کالاهای لوکس</option>
                                                        <option value="خرده فروشی / مرکز خرید / فروشگاه">خرده فروشی / مرکز خرید / فروشگاه</option>
                                                        <option value="حمل و نقل / ترابری">حمل و نقل / ترابری</option>
                                                        <option value="خطوط هوایی / هوانوردی">خطوط هوایی / هوانوردی</option>
                                                        <option value="کشتیرانی">کشتیرانی</option>
                                                        <option value="گردشگری / هتلداری">گردشگری / هتلداری</option>
                                                        <option value="کترینگ / رستوران / واحدهای غذایی">کترینگ / رستوران / واحدهای غذایی</option>
                                                        <option value="خدمات برگزاری همایش ،مجالس، سمینار و نمایشگاه">خدمات برگزاری همایش ،مجالس، سمینار و نمایشگاه</option>
                                                        <option value="شرکتهای خدماتی / پیمانکاران">شرکتهای خدماتی / پیمانکاران</option>
                                                        <option value="خدمات مهندسی و تخصصی">خدمات مهندسی و تخصصی</option>
                                                        <option value="طراحی / گرافیک / هنر">طراحی / گرافیک / هنر</option>
                                                        <option value="معماری">معماری</option>
                                                        <option value="خدمات سازمانی / مشاوره مدیریت">خدمات سازمانی / مشاوره مدیریت</option>
                                                        <option value="بازاریابی و تبلیغات">بازاریابی و تبلیغات</option>
                                                        <option value="رسانه / چاپ و نشر">رسانه / چاپ و نشر</option>
                                                        <option value="کشاورزی">کشاورزی</option>
                                                        <option value="ساختمان / مصالح و تجهیزات ساختمانی">ساختمان / مصالح و تجهیزات ساختمانی</option>
                                                        <option value="آموزش / پژوهش">آموزش / پژوهش</option>
                                                        <option value="بیمه">بیمه</option>
                                                        <option value="حقوقی و قضایی">حقوقی و قضایی</option>
                                                        <option value="املاک و مستغلات">املاک و مستغلات</option>
                                                        <option value="ورزشی / تفریح و سرگرمی">ورزشی / تفریح و سرگرمی</option>
                                                        <option value="ترجمه">ترجمه</option>
                                                        <option value="بخش دولتی">بخش دولتی</option>
                                                        <option value="خیریه / موسسات غیر انتفاعی / سازمانهای مردم نهاد">خیریه / موسسات غیر انتفاعی / سازمانهای مردم نهاد</option>
                                                        <option value="تکنولوژی و نوآوری / سرمایه گذاری خطرپذیر / شتاب دهنده">تکنولوژی و نوآوری / سرمایه گذاری خطرپذیر / شتاب دهنده</option>
                                                        <option value="بازی و سرگرمی">بازی و سرگرمی</option>
                                                        <option value="معدن">معدن</option>
                                                        <option value="EPC / ساخت">EPC / ساخت</option>
                                                    </select>                        
                                                </div>
                                            </div>
                                        </div>
                                <div class="about-me" style="position: relative;">
                                        <label for="aboutMe">درباره ما</label>
                                        <textarea 
                                            id="aboutMe" 
                                            maxlength="60"
                                            oninput="updateCharCount()"
                                            placeholder="برای مثال : بزرگترین صادر کننده پوشاک"
                                        ></textarea>
                                        <div id="charCount" ></div>
                                    </div>
                                        <button class="col-md-12 save-btn" >ذخیره</button>
                                    </div>
                                 </div>
                                <div class="mt-1 text-center">
                                    <h4 class="mb-1">{{ Auth::user()->companies->company_name ?? ' نام برند خود را وارد کنید'}}</h4>
                                    <p class=" mb-1">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                                    <h6 class="username-card">{{ Auth::user()->username }}</h6>
                                    <p class="font-size-sm px-3 text-center" id="rtl">{{ Auth::user()->aboutme ?? 'متنی برای معرفی سازمان خود بنویسید' }}</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 flex-grow-1">
                        <div class="card-body d-flex flex-column justify-content-between">                  
                            <div class="wallet-top d-flex justify-content-center">
                                <img src="{{ asset('images/profile-pages/wallet.png') }}" width="150">
                            </div>                  
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between gap-3">
                                        <h6 class="mb-0">1,300,000 toman</h6>
                                        <h6 class="mb-0" dir="rtl">درآمد پروژه‌های باز :</h6>
                                    </div>
                                </li>                               
                                <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between gap-3">
                                        <h6 class="mb-0">1,300,000 toman</h6>
                                        <h6 class="mb-0" dir="rtl">درآمد پروژه‌های باز :</h6>
                                    </div>
                                </li>                               
                                <li class="list-group-item d-flex justify-content-center align-items-center p-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between gap-3">
                                        <h6 class="mb-0">1,300,000 toman</h6>
                                        <h6 class="mb-0" dir="rtl">درآمد پروژه‌های باز :</h6>
                                    </div>
                                </li>
                            </ul>                   
                            <div class="wallet-bottom text-center justify-content-center">
                                <button class="button x"><img src="{{ asset('images/profile-pages/wallet-icon.png') }}"  width="28" viewBox="0 0 48 48"height="28">برداشت</button>                  
                            </div>                  
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex justify-content-between">
                                <button  id="InfoBtn" class="addBtn"><i class="bi bi-plus sign"></i></button>
                                <h6 class=" align-items-center my-2" id="rtl"><i class="material-icons my-2">اطلاعات سازمان</i></h6>
                                </div>
                            </div>
                            <!-- company info pop-up -->
                                <div id="editCompanyPopup" class="popup" style="display:none;">
                                    <div class="popup-content infoPopup" id="rtl">
                                        <div class="d-flex justify-content-between">
                                            <span class="closeBtn" id="close-company"><i class="bi bi-x sign"></i></span>
                                            <h4>ویرایش اطلاعات شرکت</h4>
                                        </div>
                                        <form id="editCompanyForm" method="POST" action="{{ route('companies.save') }}">
                                            
                                            @csrf
                                            <div class="row">
                                                <!-- left inputs -->
                                                <div class="col-md-6">
                                                    <label>نوع شرکت</label>
                                                    <select name="company_type" class="input select2">
                                                        <option value="خصوصی" {{ (Auth::user()->companies->company_type ?? '') == 'خصوصی' ? 'selected' : '' }}>خصوصی</option>
                                                        <option value="دولتی" {{ (Auth::user()->companies->company_type ?? '') == 'دولتی' ? 'selected' : '' }}>دولتی</option>
                                                        <option value="عمومی" {{ (Auth::user()->companies->company_type ?? '') == 'عمومی' ? 'selected' : '' }}>عمومی</option>
                                                        <option value="خصولتی" {{ (Auth::user()->companies->company_type ?? '') == 'خصولتی' ? 'selected' : '' }}>خصولتی</option>
                                                        <option value="غیردولتی" {{ (Auth::user()->companies->company_type ?? '') == 'غیردولتی' ? 'selected' : '' }}>غیردولتی</option>
                                                    </select>
                                                    <label>سال تأسیس</label>
                                                    <input  type="text"  id="establishedYearPicker"  class="input" name="established_year" value="{{ Auth::user()->companies->established_year ?? '' }}" placeholder="انتخاب سال تأسیس" readonly/>

                                                    <label>شهر</label>
                                                    <input type="text" class="input" name="city" value="{{ Auth::user()->companies->city ?? '' }}">
                                                </div>                              
                                                <!-- right inputs -->
                                                <div class="col-md-6">                          
                                                    <label>شماره تلفن شرکت</label>
                                                    <input type="text" class="input" name="company_phone" value="{{ Auth::user()->companies->company_phone ?? '' }}">                               

                                                    <label>اندازه سازمان</label>
                                                    <select name="company_size" class="input select2">
                                                        <option value="زیر 10 نفر" >زیر 10 نفر</option>
                                                        <option value="بین 10 تا 50 نفر" >بین 10 تا 50 نفر</option>
                                                        <option value="بین 50 تا 200 نفر" >بین 50 تا 200 نفر</option>
                                                        <option value="بین 200 تا 500 نفر" >بین 200 تا 500 نفر</option>
                                                        <option value="بین 500 تا 1000 نفر" >بین 500 تا 1000 نفر</option>
                                                        <option value="بین 1000 تا 5000 نفر" >بین 1000 تا 5000 نفر</option>
                                                        <option value="بیش از 5000">بیش از 5000</option>
                                                    </select>       

                                                    <label>شناسه ملی شرکت</label>
                                                    <input type="text" class="input" name="national_id" value="{{ Auth::user()->companies->national_id ?? '' }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <label>درباره سازمان</label>
                                                    <textarea name="company_info" id="company_info" placeholder="سازمان خود را معرفی کنید"></textarea>
                                                </div>
                                            </div>
                                            <button class="col-md-12 save-btn mt-2" >ذخیره</button>
                                        </form>
                                    </div>
                                 </div>
                            <!-- -->
                            <!-- preview info -->
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_type ?? 'نوع مالکیت سازمان را وارد کنید'}}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: نوع مالکیت</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value" id="establishedYearDisplay">{{ Auth::user()->companies->established_year ?? '' }}</div>                                    
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: سال تأسیس</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->city ?? 'شهر خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شهر</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_phone ?? 'اطلاعات تماس ثبت نشده است' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: تلفن سازمان</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_size ?? 'اندازه سازمان خود را تعیین کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: اندازه سازمان</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->national_id ?? 'شناسه ملی شرکت خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شناسه ملی شرکت</h6></div>
                                </div>
                                <hr>
                                <div class="d-flex flex-column align-items-end text-end">
                                    <h5>درباره ما</h5>
                                    <p id="aboutText" class="mb-2 about-click" style="max-height:70px; overflow:hidden; transition:max-height .4s ease; direction:rtl; text-align:right; unicode-bidi:plaintext; margin-top:10px;">
                                        {{ Auth::user()->companies->company_info ?? 'توضیحاتی در مورد سازمان خود بنویسید' }}
                                    </p>
                                    <label class="container-more" id="toggleAbout">
                                      <input type="checkbox" id="aboutToggleCheck">
                                      <svg viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="chevron-down">
                                          <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                                      </svg>
                                    </label>
                                </div>

                            <!--  -->
                        </div>
                    </div>
                    <div class="row gutters-sm">
                        <div class="col-sm-12 my-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <button class="addBtn" onclick="openRepresentativePopup()"><i class="bi bi-plus sign"></i></button>
                                        <h6 class=" align-items-center my-2" id="rtl"><i class="material-icons my-2">اطلاعات رابط سازمان</i></h6>
                                    </div>
                                    <div id="representativePopup" class="popup">
                                        <div class="popup-content">
                                            <div class="d-flex justify-content-between">
                                                <span class="closeBtn" onclick="closeRepresentativePopup()"><i class="bi bi-x sign"></i></span>
                                                <h4>ویرایش اطلاعات نماینده شرکت</h4>
                                            </div>
                                            <form id="representativeForm">
                                                @csrf
                                                <label>نام و نام خانوادگی</label>
                                                <input type="text" name="Fullname" class="input" value="{{ Auth::user()->name ?? '' }}">                                   

                                                <label>شماره تماس</label>
                                                <input type="text" name="Phone" class="input" value="{{ Auth::user()->phone ?? '' }}">                                 

                                                <label>سمت</label>
                                                <input type="text" name="userSide" class="input" value="{{ Auth::user()->side_user ?? '' }}">                                 
                                                
                                                <button type="submit" class="save-btn mt-3 col-md-12">ذخیره</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->name ?? 'نام نماینده سازمان را وارد کنید'}}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: نماینده شرکت</h6></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->phone ?? 'شماره تماس رابط سازمان را وارد کنید' }}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شماره تماس</h6></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->side_user ?? 'سمت رابط سازمان را وارد کنید' }}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: سمت</h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
<div class="card mb-3"  id="rtl" style="max-height: 291px; overflow: auto;">
                                    <div class="d-flex justify-content-between p-0 mb-3" >
                                        <button   class="addBtn" id="SkillBtn"><i class="bi bi-plus sign"></i></button>
                                        <h5 class=" align-items-center my-2"><i class="material-icons mr-2">به چه مهارت هایی نیاز دارید؟</i></h5>
                                    </div>
    
                                    <div id="skillModal" class="popup">
                                        <div class="popup-content">
                                            <div class="d-flex justify-content-between mb-3">
                                                <button class="closeBtn" id="closeModalBtn"><i class="bi bi-x sign"></i></button>
                                                <h4>مهارت‌های نرم‌افزاری</h4>
                                            </div>
                                            <div class="search-bar">
                                                <input type="text" id="searchInput" placeholder="جستجو...">
                                            </div>
    
                                            <!-- سلکت باکس حوضه‌ها -->
                                            <div class="select-container">
                                                <label for="categorySelect" class="my-3">حوزه‌ها</label>
                                                <select id="categorySelect">
                                                    <option value="devops">نرم افزارها و زبان‌های برنامه‌نویسی / DevOps</option>
                                                    <option value="network">شبکه و سخت‌افزار / سیستم‌عامل</option>
                                                    <option value="design">طراحی گرافیک / طراحی محصول</option>
                                                    <option value="architecture">معماری و شهرسازی</option>
                                                    <option value="civil">مهندسی عمران</option>
                                                    <option value="crm">مدیریت ارتباط با مشتری - CRM</option>
                                                    <option value="erp">نرم‌افزارهای ERP</option>
                                                    <option value="marketing">دیجیتال مارکتینگ / سئو / مدیریت محتوا</option>
                                                    <option value="database">پایگاه داده</option>
                                                    <option value="data">داده‌کاوی، بیگ دیتا و BI</option>
                                                    <option value="game">بازی‌سازی</option>
                                                    <option value="music">آهنگ‌سازی</option>
                                                </select>
                                            </div>
    
                                            <!-- نمایش نرم‌افزارها بر اساس حوضه انتخابی -->
                                            <div id="softwareList" class="software-list">
                                                <!-- نرم‌افزارها به صورت داینامیک بارگذاری می‌شوند -->
                                            </div>
    
                                            <!-- نمایش مقادیر انتخاب شده -->
                                            <div id="selectedSkills" class="selected-skills">
                                                <h6>مقادیر انتخاب شده</h6>
                                                <ul id="selectedSkillsList"></ul>
                                            </div>
    
                                            <button id="skillSubmit" class="col-md-12 mt-3" type="submit">ارسال</button>
                                        </div>
                                    </div>
                                    <!-- preview skill -->
                                        @if(Auth::user()->skillMapping->isNotEmpty())
                                            <div class="col-12 row" dir="rtl">
                                                @foreach(Auth::user()->skillMapping as $mapping)
                                                    <div class="skill m-1" data-skill-id="{{ $mapping->skill->id }}">
                                                        <span>
                                                            <i class="bi bi-x-circle-fill text-danger remove-skill" data-id="{{ $mapping->id }}" style="cursor: pointer;"></i>
                                                        </span>
                                                        <span class="mx-1">|</span>
                                                        <span class="tag-title font-weight-bold">{{ $mapping->skill->skill }}</span>
                                                        <span class="mx-1">|</span>
                                                        <span>{{ $mapping->level }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="card bg-danger align-items-center m-3">
                                                <p class="m-0" id="rtl">هیچ مهارتی ثبت نشده است</p>
                                            </div>
                                        @endif
                                    <!--  -->
                                </div>


            <nav class="breadcrumb justify-content-between mt-2">
    <a href="{{ route('newProject') }}">
        <button class="addBtn"><i class="bi bi-plus sign"></i></button>
    </a>    
    <h4 class="mt-1">پروژه های ثبت شده تا کنون</h4>
</nav> 

@if(Auth::user()->NewProject->isNotEmpty())

    @foreach ($projects as $project)
            @php
            // بررسی اینکه پروژه تگ "متمایز" دارد یا نه
            $hasDistinguishedTag = false;
            foreach($project->serviceTags ?? [] as $tag) {
                if($tag->name === 'متمایز') {
                    $hasDistinguishedTag = true;
                    break;
                }
            }

            // مرتب‌سازی تگ‌ها
            $tagOrder = ['مدیر پروژه', 'فوری', 'تخصصی', 'متمایز'];
            $sortedTags = collect($project->serviceTags ?? [])->sortBy(function($tag) use ($tagOrder) {
                return array_search($tag->name, $tagOrder);
            })->values();

            // تعیین رنگ و متن بر اساس وضعیت
            if($project->status === 'open'){
                $statusBadge = 'open-project';
                                $statusText = 'باز';
            } elseif($project->status === 'closed'){
                $statusBadge = 'closed-project';
                                $statusText = 'بسته';

            } else { // expired
                $statusBadge = 'expired-project';
                                $statusText = 'منقضی';

            }
        @endphp
@php
    $isExpired = $project->status === 'expired';
@endphp

<div class="project-card-wrapper {{ $isExpired ? 'project-expired' : '' }}">

    {{-- دکمه تمدید فقط برای منقضی --}}
    @if($isExpired)
        <div class="renew-overlay">
<a href="{{ route('newProject', ['renew' => $project->id, 'step' => 5]) }}"
   class="renew-btn"  style="text-decoration:none; color:white;">
    تمدید پروژه
</a>

        </div>
    @endif

      <a class="user-card-link {{ $isExpired ? 'disabled-link' : '' }}"
       href="{{ $isExpired ? 'javascript:void(0)' : url('/content?type=project&id=' . $project->id) }}"
       style="text-decoration:none; color:inherit;">
       
                                <div class="project-card {{ $hasDistinguishedTag ? 'distinguished' : '' }}">
                                    
            <div class="title {{ $statusBadge }}">
                {{ $statusText }}
            </div>
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
        </a>
        </div>

    @endforeach

@else
    <div class="col-md-12 card p-3">
        <p class="m-0 card bg-danger align-items-center" id="rtl">تا کنون آگهی ثبت نکردید</p>
    </div>
@endif

            <div id="loading-screen">
                <div class="loader">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
            </div>
            <div id="custom-alert" class="custom-alert">
            <span id="alert-message"></span>
        </div>
        </div>
    </div>
    <script src="{{ asset('/js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('/js/persian-datepicker.js') }}"></script>
    <script src="{{ asset('/js/persian-date.js') }}"></script>
    <script>
        const skillBtn = document.getElementById('SkillBtn');
        const modal = document.getElementById('skillModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const categorySelect = document.getElementById('categorySelect');
        const softwareList = document.getElementById('softwareList');
        const selectedSkillsList = document.getElementById('selectedSkillsList');
        const searchInput = document.getElementById('searchInput');
        // دکمه ارسال مهارت‌ها
        const skillSubmitBtn = document.getElementById('skillSubmit');
        function sendSkillsToServer() {

            document.getElementById("skillModal").style.display = "none";

            document.getElementById("loading-screen").style.display = "flex";

            const skillsToSend = selectedSkills.map(skill => {
                const [software, level] = skill.split(' - '); // جدا کردن نام نرم‌افزار و سطح
                return { skill: software, level: level }; // بازگرداندن شیء با `skill` و `level`
            });

            // ارسال داده‌ها به سرور با استفاده از fetch
            fetch('/submit-profile', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // مشخص کردن نوع داده
                    'Accept': 'application/json', // خیلی مهم
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    StatusSkills: skillsToSend // ارسال داده‌ها در قالب { StatusSkills: [...] }
                })
            })
                .then(response => response.json()) // پاسخ از سرور را دریافت کنید
                .then(data => {
                    showAlert("مهارت‌ها با موفقیت ذخیره شدند", "success");

                    // ریلود کردن صفحه
                    window.location.reload(); // ریلود کردن صفحه برای نمایش تغییرات جدید
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert("خطا در ارسال درخواست", "error");
                });
        }



        skillSubmitBtn.addEventListener('click', (e) => {
            e.preventDefault(); // جلوگیری از ارسال فرم به صورت پیش‌فرض (در صورت استفاده در فرم)

            // ارسال داده‌ها به سرور
            sendSkillsToServer();
        });


        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase(); // دریافت متن جستجو و تبدیل به حروف کوچک
            const category = categorySelect.value; // گرفتن دسته‌بندی انتخاب شده
            displaySoftware(category, searchTerm); // نمایش نرم‌افزارها با جستجو
        });

        // دکمه باز کردن پاپ آپ
        skillBtn.addEventListener('click', () => {
            modal.style.display = "flex";
        });

        // دکمه بستن پاپ آپ
        closeModalBtn.addEventListener('click', () => {
            modal.style.display = "none";
        });

        // لیست نرم‌افزارها بر اساس حوضه
        const softwareData = {
            devops:['Ruby on Rails','html & css','vb script','java script','android develpment','go','node.js','php','jquery','SharePoint','assembly','fortran','xamarin','swift','Microsoft Visual Studio','Netbeans','Eclipse','Android Studio','Notepad++','C#','C++','Java','C','Delphi','Pascal','Python','iOS Development (Objective C)','Visual Basic','Crystal Reports','Stimulsoft Report','Fast Report','Quick Report','Subversion','GIT','Xcode','Angular','Django','Hibernate','Laravel','React','Rest API','Unit Testing','Dependency Injection','Entity Framework','Visual Paradigm','Selenium','Rational rose','Jenkins','Microsoft Test Manager','ZeroMQ','Kafka','VueJS','Elastic Search','Keras','OpenCV','Java SE','Oracle WebLogic','Oracle Form & Report','Dart','React Native','.Net Core / .Net','Flutter','Embedded C','Microsoft Azure Devops / TFS','Kotlin','Dapper','Scala','TypeScript','Erlang','ShellScript','Rust','Groovy','MQL','Elixir','Nuxt.js','Next.js','Docker','RabbitMQ','Docker Swarm','Ceph','Kubernetes','Helm','Rancher','Gerafana','Prometheus','Octupos','TeamCity','Gitlab','Ansible'],
            network:['Wireshark','IIS','ISA Server / TMG','GFI LAN GUARD','GFI Web Monitor','Exchange Server','Active Directory','Windows Server','Mikrotik','DHCP','DNS Settings','Mac OS','Linux','Cloud Security','Server Virtualization (ESX,VMware and …)','SCOM (System Center Operations Manager)','CCNA','CCNP','CCIE','JUNIPER','MCP','MCSA','MPLS','VoIP','Firewall','Routing','Switching','MTCNA','MTCRE','MTCTCE','MTCUME','MTCWE','Network+','A+','PRTG','Solarwinds','Zabbix','Veeam','CEH','Security+'],
            design:['3D Studio Max','ACD See','Adobe Dreamweaver','Adobe Flash','Adobe Illustrator','Adobe Indesign','Adobe Photoshop','Adobe Premiere','After Effects','Art Rage','Blender','Cinema 4D','Corel Draw','DrawPlus','Gimp','Inkscape','Maya','PhotoDirector','PhotoPlus','PhotoStudio','Xara Photo & Graphic Designer','Toon Boom Studio','TV Paint','Adobe XD','ZBrush','Zeplin','Sketch','Axure','Adobe Audition','Davinci Resolve','SpeedTree','Modo','Adobe Dimension','Edius','Final Cut','KeyShot','Figma'],
            architecture:['Archicad','AutoCad','Grasshopper','Lumion','Post Production','Revit','Rhino','Sketchup','Vray'],
            civil:['Autocad Civil 3D','Canvas','CSI Bridge','ETABS','FLAC 3D','Lusas','Opensees','Perform','Plaxis Professional','Safe','SAM LEAP','SAP2000','Section Builder','سازه 90','Navisworks','تدکار','Tekla Structures'],
            crm:['Microsoft Dynamics','Sales Force','Sugar','دیدار','سرو','پیام گستر','روش','ایده آل','Dana'],
            erp:['SAP','Oracle ERP','Microsoft ERP','Logo','IFS','Odoo ERP'],
            marketing:['Wordpress','Google Analytics','Joomla','Drupal','Google Tag Manager','Google Search Console','Google Data Studio','Ahrefs','Keyword Planner','Keywordtool','KWFinder','Moz','Screaming Frog','Semrush','Sitebulb'],
            database:['Sql Server','MySql','PostgreSql','Oracle Database','T-Sql','PL-SQL','Redis','MongoDB','Cassandra','Neo4j','Oracle NoSQL','Couchbase','CouchDB'],
            data:['Rapid Miner','Knime','Qlikview','Qliksense','Tableau','PowerBI','SSIS','SSRS','SSAS','Hadoop','Hbase','MapReduce','Spark','Zookeeper','Cloudera','Weka','Oracle BI','ODI'],
            game:['Unity','Corona SDK','SpriteKit','AppGameKit','Construct 2','MonoGame','Cocos2D','Gideros','Haxe','Unreal Engine','GameMaker','Torque 3D','Buildbox'],
            music:['Ableton Live','FL Studio','Logic Pro X','Cubase','Pro Tools','Studio One','Reason','Reaper','GarageBand','Bitwig Studio','Nuendo','Audacity','Cakewalk','BandLab','Finale','Sibelius','Notion','Dorico','Kontakt','Omnisphere','Serum','Massive','Sylenth1','Nexus','Spitfire Audio','EastWest','iZotope Ozone','iZotope Neutron','Melodyne','Auto-Tune','Waves Plugins','FabFilter','Soundtoys','Valhalla DSP','Native Instruments Komplete','Loopmasters','Splice','LANDR','Arcade by Output','UVI Workstation',]
        };

        // ذخیره مقادیر انتخاب شده
        let selectedSkills = [];

        categorySelect.addEventListener('change', (e) => {
            const category = e.target.value;
            displaySoftware(category);
        });
        

        function displaySoftware(category, searchTerm = '') {
            softwareList.innerHTML = ''; // پاک کردن محتوای قبلی

            const filteredSoftware = softwareData[category].filter(software =>
                software.toLowerCase().includes(searchTerm) // بررسی مطابقت نرم‌افزار با جستجو
            );

            filteredSoftware.forEach(software => {
                const div = document.createElement('div');
                div.classList.add('software-item');

                // نمایش نرم‌افزار به عنوان دکمه
                div.innerHTML = `
                <button class="software-btn">${software}</button>
                <div class="software-level">
                    <button>مبتدی</button>
                    <button>متوسط</button>
                    <button>حرفه‌ای</button>
                </div>
            `;

                const softwareBtn = div.querySelector('.software-btn');
                const softwareLevel = div.querySelector('.software-level');


                softwareBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // جلوگری از بسته شدن سریع

            // بستن همه منوهای دیگر
            document.querySelectorAll('.software-level').forEach(menu => {
                if (menu !== softwareLevel) menu.style.display = 'none';
            });

            // نمایش یا پنهان کردن لیست سطح
            if (softwareLevel.style.display === 'block') {
                softwareLevel.style.display = 'none';
            } else {
                softwareLevel.style.display = 'block';

                // موقعیت‌دهی دقیق با توجه به دکمه
                const btnRect = softwareBtn.getBoundingClientRect();
                const containerRect = softwareList.getBoundingClientRect();

                softwareLevel.style.top = `${softwareBtn.offsetHeight + 5}px`; // زیر دکمه
                softwareLevel.style.left = `0px`; // هم‌راستا با دکمه
            }
        });

                // افزودن سطح انتخاب شده به لیست
                const levelButtons = div.querySelectorAll('.software-level button');
                levelButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const selectedLevel = `${software} - ${button.textContent}`;
                        if (!selectedSkills.includes(selectedLevel)) {
                            selectedSkills.push(selectedLevel);
                            updateSelectedSkills();
                        }
                        softwareLevel.style.display = 'none'; // بستن منو بعد از انتخاب سطح
                    });
                });

                softwareList.appendChild(div);
            });
        }

        function updateSelectedSkills() {
            selectedSkillsList.innerHTML = ''; // پاک کردن لیست قبلی

            selectedSkills.forEach((skill, index) => {
                // ایجاد HTML برای هر مهارت
                const skillHTML = `
                <div class="skillselect m-1">
                    <span class="levelspan ">${skill.split(' - ')[1]}</span>
                    <span class="mx-1 ng-star-inserted">|</span>
                    <span class="tag-title skillsapn ">${skill.split(' - ')[0]}</span>
                    <span class="mx-1 ng-star-inserted ">|</span>
                    <span class="ng-star-inserted deletespan">
                        <i class="bi bi-x-circle-fill text-danger remove-skill"
                           style="cursor: pointer;"
                           data-index="${index}"></i>
                    </span>
                    <br>
                </div>
            `;

                // اضافه کردن مهارت به لیست
                selectedSkillsList.innerHTML += skillHTML;
            });

            // افزودن event listener به آیکون‌های حذف
            const removeIcons = selectedSkillsList.querySelectorAll('.remove-skill');
            removeIcons.forEach(icon => {
                icon.addEventListener('click', () => {
                    const index = icon.getAttribute('data-index'); // دریافت ایندکس از data-index
                    selectedSkills.splice(index, 1); // حذف مهارت از آرایه
                    updateSelectedSkills(); // بروزرسانی لیست مهارت‌ها
                });
            });
        }

        // نمایش نرم‌افزارهای پیش‌فرض
        displaySoftware('devops');
document.addEventListener('click', () => {
    document.querySelectorAll('.software-level').forEach(menu => {
        menu.style.display = 'none';
    });
});
        document.querySelectorAll('.remove-skill').forEach(button => {
            button.addEventListener('click', function(event) {

                document.getElementById("loading-screen").style.display = "flex";
                const skillId = event.target.getAttribute('data-id'); // شناسه مهارت را از data-id بگیرید

                // ارسال درخواست حذف به سرور
                fetch(`/delete-skill/${skillId}`, {
                    method: 'DELETE',  // استفاده از متد DELETE
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            event.target.closest('.skill').remove();
                            showAlert("مهارت با موفقیت حذف شد", "success");
                            location.reload();
                        } else {
                            showAlert("خطا در حذف مهارت", "error");

                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        showAlert("خطا در ارسال درخواست", "error");

                    });
            });
        });
 
document.addEventListener("DOMContentLoaded", function () {

    const openBtn  = document.getElementById("aboutText");
    const popup    = document.getElementById("editCompanyPopup");
    const closeBtn = document.getElementById("close-company");

    if (!openBtn || !popup || !closeBtn) return;

    openBtn.addEventListener("click", function () {
        popup.style.display = "flex";
    });

    closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // بستن با کلیک بیرون
    popup.addEventListener("click", function (e) {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});
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

             function updateCharCount() {
    const aboutMe = document.getElementById('aboutMe');
    const charCount = document.getElementById('charCount');
    const maxChars = aboutMe.getAttribute('maxlength');
    const currentLength = aboutMe.value.length;

    charCount.textContent = `${maxChars} / ${currentLength}`;

    // تغییر رنگ وقتی به حد نهایی نزدیک می‌شه
    if (currentLength > maxChars * 0.9) {
        charCount.style.color = 'red';
    } else {
        charCount.style.color = 'wihte';
    }
}

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

        document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('establishedYearDisplay');
    let year = el.textContent.trim();

    if(year) {
        // اعداد انگلیسی به فارسی
        year = year.replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);

        el.textContent = year;
    } else {
        el.textContent = 'سالروز تأسیس شرکت خود را وارد کنید';
    }
});
        
$(document).ready(function() {
    const currentYear = new Date().getFullYear(); // سال جاری میلادی

    $("#establishedYearPicker").persianDatepicker({
        format: "YYYY",          // فقط سال
        viewMode: "year",        // نمایش سال‌ها
        initialValue: true,      // مقدار اولیه داشته باشد
        initialValueType: "gregorian", // سال میلادی
        autoClose: true,         // بستن خودکار بعد از انتخاب
        position: "auto",        // موقعیت مناسب بدون فول‌اسکرین
        responsive: false,       // جلوگیری از فول‌اسکرین موبایل
        toolbox: {
            enabled: false       // حذف کامل جعبه ابزار (دکمه امروز و سایر ابزارها)
        },
        dayPicker: { enabled: false },   // غیرفعال کردن روز
        monthPicker: { enabled: false }, // غیرفعال کردن ماه
    });

    // اگر بخوای مقدار پیش‌فرض فارسی هم باشه:
    let picker = $("#establishedYearPicker").data("datepicker");
    picker.setDate(`${currentYear}/01/01`);
});

function persianToEnglishNumber(str) {
    return str.replace(/[۰-۹]/g, function(d) {
        return '0123456789'[d.charCodeAt(0) - 1776];
    });
}

                document.addEventListener('DOMContentLoaded', function() {
    const openFilePicker = document.getElementById('openFilePicker');
    const fileInput = document.getElementById('profilePicInput');

    openFilePicker.addEventListener('click', function() {
        fileInput.click(); // باز کردن input هنگام کلیک روی آیکون
    });
});
         function openPopup() {
        document.getElementById('editProfilePopup').style.display = 'flex';
    }

    // بستن پاپ‌آپ
    function closePopup() {
        document.getElementById('editProfilePopup').style.display = 'none';
    }

    // پیش‌نمایش عکس پروفایل
    function previewProfilePic(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profilePic');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('editProfilePopup').querySelector('.save-btn').addEventListener('click', function(event) {
        event.preventDefault(); // جلوگیری از ارسال سنتی فرم

        document.getElementById('editProfilePopup').style.display = 'none';

        // جمع‌آوری داده‌ها از فیلدهای فرم
  const profileData = {
    workField: document.getElementById('workArea').value,  // حوزه کاری
    aboutMe: document.getElementById('aboutMe').value,     // درباره من
    profileImage: document.getElementById('profilePic').src,
    companyName: document.getElementById('companyName').value, // نام شرکت

};

        // دریافت توکن CSRF از متا تگ
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ایجاد درخواست AJAX با `XMLHttpRequest`
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/submit-profile', true);

        // تنظیم هدرهای مورد نیاز
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        // مدیریت پاسخ سرور
        xhr.onload = function() {
            document.getElementById("loading-screen").style.display = "flex";

            console.log("Server response:", xhr.responseText); // **لاگ گرفتن از پاسخ سرور**

            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Parsed response:", response); // **لاگ گرفتن از JSON پارس شده**

                    if (response.success) {
                        showAlert("تغییرات شما ذخیره شد", "success");
                        location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                    } else {
                        showAlert("خطا در ارسال درخواست", "error");

                    }
                } catch (error) {
                    showAlert("خطا در ارسال درخواست", "error");
                    console.error("Error parsing response:", error, "Raw response:", xhr.responseText);

                }
            } else {
                showAlert("خطا در ارسال درخواست", "error");
                console.error("Error sending data:", xhr.status, xhr.statusText, "Response:", xhr.responseText);

            }
        };

        // مدیریت خطای اتصال به سرور
        xhr.onerror = function() {
            showAlert("خطا در برقراری ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید", "error");
            console.error("Network error");
        };

        // ارسال داده به سرور
        xhr.send(JSON.stringify({ profileData }));
    });
    });
    // ذخیره تغییرات پروفایل
    
    //پاپ آپ اطلاعات شرکت
    document.addEventListener("DOMContentLoaded", function () {
            const openBtn = document.getElementById("InfoBtn");
            const popup = document.getElementById("editCompanyPopup");
            const closeBtn = document.getElementById("close-company");

            openBtn.addEventListener("click", function (e) {
                e.preventDefault();
                popup.style.display = "flex";
            });

            closeBtn.addEventListener("click", function () {
                popup.style.display = "none";
            });

            // بستن با کلیک بیرون از پاپ‌آپ
            window.addEventListener("click", function (e) {
                if (e.target === popup) {
                    popup.style.display = "none";
                }
            });
        });

$(document).on('submit', '#editCompanyForm', function (e) {
    e.preventDefault();

    document.getElementById("loading-screen").style.display = "flex";

    var formData = new FormData(this);

    // تبدیل عدد فارسی به انگلیسی
    if(formData.has('established_year')) {
        let val = formData.get('established_year');
        formData.set('established_year', persianToEnglishNumber(val));
    }

    $.ajax({
        url: "{{ route('companies.save') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function (response) {
            showAlert("اطلاعات شرکت با موفقیت ذخیره شد", "success");
            location.reload();
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            console.log(formData);
            showAlert("خطا در ارسال درخواست", "error");
        }
    });
});

    //پاپ آپ اطلاعات نماینده
        function openRepresentativePopup() {
            document.getElementById('representativePopup').style.display = 'flex';
        }

        function closeRepresentativePopup() {
            document.getElementById('representativePopup').style.display = 'none';
        }

        $(document).ready(function () {
            $('#representativeForm').on('submit', function (e) {
                document.getElementById("loading-screen").style.display = "flex";

                e.preventDefault();     

                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('profile.submit') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert("اطلاعات نماینده شرکت با موفقیت ذخیره شد", "success");
                        closeRepresentativePopup();
                        location.reload();
                    },
                    error: function() {
                        showAlert("خطا در ذخیره‌سازی اطلاعات. لطفا دوباره تلاش کنید.", "error");
                    }
                });
            });
        });
    //نوتیفیکیشن ها
        function showAlert(message, type = "success", duration = 3000) {
            const alertBox = document.getElementById('custom-alert');
            const alertMessage = document.getElementById('alert-message');

            alertMessage.textContent = message;
            alertBox.style.display = 'block';

            alertBox.classList.remove("success-alert", "error-alert");

            if (type === "success") {
                alertBox.classList.add("success-alert");
            } else if (type === "error") {
                alertBox.classList.add("error-alert");
            }

            setTimeout(() => {
                alertBox.style.display = 'none';
            }, duration);
        }
</script>

</body>
</html>