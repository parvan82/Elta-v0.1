<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">

    <title>elta</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/persian-datepicker.css') }}">
    <link rel="stylesheet" href="/css/profile.css">
    <link href="{{ asset('css/tooman/css/font.css') }}" rel="stylesheet" type="text/css" />
    <style>
       


    </style>
</head>
<body>
    <div class="container">
        <div class="main-body">
            <!-- nav-bar -->
            <nav class="breadcrumb">
                <div class="site-name"><img id="img-icon-name" src="{{ asset('images/name.jpg') }}" alt=""></div>
            </nav>
            <!--  -->
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <!-- profile -->
                    <div class="card">
                        <div class="card-body">
                            <!-- preview profile -->
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="profile-container " >
                                    <button class="editBtn editProfileBtn" id="editBtn" onclick="openPopup()">
                                        <svg height="1em" viewBox="0 0 512 512">
                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                        </svg>
                                    </button>
                                    <img src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}"  class="rounded-circle" width="150" height="150">
                                </div>
                                <div class="mt-1 text-center">
                                    <h4 class="mb-1">{{ Auth::user()->name ?? 'نام و نام خانوادگی خود را وارد کنید'}}</h4>
                                    <p class="mb-1">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                                    <h6 class="username-card">{{ Auth::user()->username }}</h6>
                                    <p class="font-size-sm">{{ Auth::user()->aboutme ?? 'متنی در باره خود برای معرفی بنویسید' }}</p>
                                </div>
                            </div>
                            <!--  -->
                            <!-- profile pop-up -->
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
                                                <label for="fullName">نام و نام خانوادگی</label>
                                                <input type="text" id="fullName" value="{{ Auth::user()->name ?? 'نام و نام خانوادگی خود را وارد کنید' }}">
                                            </div>
                                            <div class="input-group">
                                                <label for="workArea">حوضه کاری</label>
                                                <input type="text" id="workArea" value="{{ Auth::user()->workarea ?? 'کاربر التا' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about-me" style="position: relative;">
                                        <label for="aboutMe">درباره من</label>
                                        <textarea 
                                            id="aboutMe" 
                                            maxlength="60"
                                            oninput="updateCharCount()"
                                            placeholder="متنی درباره خود برای معرفی بنویسید"
                                        >{{ Auth::user()->aboutme ?? '' }}</textarea>
                                        <div id="charCount"></div>
                                    </div>
                                    <button class="col-md-12 save-btn" >ذخیره</button>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <!--  -->
                    <!-- wallet -->
                    <div class="card mt-3 ">
                        <div class="card-body" style="height: 560px ;">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="my-4" src="{{ asset('images/profile-pages/wallet.png') }}"  width="150">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1 mt-2">
                                        <div class="d-flex align-items-center mt-2 mb-2 text-white">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1 mt-2">
                                        <div class="d-flex align-items-center mt-2 mb-2 text-white">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1 mt-2">
                                        <div class="d-flex align-items-center mt-2 mb-2 text-white">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                </ul>
                                <button class="button x mt-2"><img src="{{ asset('images/profile-pages/wallet-icon.png') }}"  width="28" viewBox="0 0 48 48"height="28">برداشت</button>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
                <div class="col-md-8">
                    <!-- informations -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-12 d-flex justify-content-between" id="rtl">
                                    <button  id="InfoBtn" class="addBtn"><i class="bi bi-plus sign"></i></button>
                                    <h5 class="align-items-center my-2" id="rtl"><i class="material-icons my-2">اطلاعات شخصی</i></h5>
                                </div>
                            </div>
                            <!-- info pop-up -->
                            <div id="editPopup" class="popup" style="display:none;">
                                <div class="popup-content infoPopup" id="rtl">
                                    <div class="d-flex justify-content-between">
                                        <span class="closeBtn " id="close"><i class="bi bi-x sign"></i></span>
                                        <h4 >ویرایش اطلاعات</h4>
                                    </div>
                                    <form id="editForm">
                                        <div class="row">
                                            <!-- left inputs -->
                                            <div class="col-md-6">
                                                <label>شهر سکونت</label><input type="text" class="input" name="residence_city" value="{{ Auth::user()->personalInformation->residence_city ?? '' }}">
                                                <label>تاریخ تولد</label><input type="text" class="persian-datepicker input"  name="birth_date" value="{{ Auth::user()->personalInformation->birth_date ?? '' }}">
                                                <label>شماره موبایل</label><input type="text" class="input" name="phone" value="{{ Auth::user()->phone ?? '' }}">
                                            </div>
                                            <!-- right inputs -->
                                            <div class="col-md-6">
                                                <label >ایمیل</label><input type="email" class="input " name="email" value="{{ Auth::user()->personalInformation->email ?? '' }}">
                                                <label>جنسیت</label><select id="gender-select" class="input" name="gender"><option value="مرد" {{ (Auth::user()->personalInformation->gender ?? '') == 'مرد' ? 'selected' : '' }}>مرد</option><option value="زن" {{ (Auth::user()->personalInformation->gender ?? '') == 'زن' ? 'selected' : '' }}>زن</option></select>
                                                <label>کد ملی</label><input type="text" class="input" name="personal_id" value="{{ Auth::user()->personalInformation->personal_id ?? '' }}">
                                                <div id="military-status-wrapper"><label>وضعیت خدمت</label><select id="military-status" class="input"name="military_status"><option value="مشمول" {{ (Auth::user()->personalInformation->military_status ?? '') == 'مشمول' ? 'selected' : '' }}>مشمول</option><option value="معافیت دائم" {{ (Auth::user()->personalInformation->military_status ?? '') == 'معافیت دائم' ? 'selected' : '' }}>معافیت دائم</option><option value="معافیت موقت" {{ (Auth::user()->personalInformation->military_status ?? '') == 'معافیت موقت' ? 'selected' : '' }}>معافیت موقت</option><option value="پایان خدمت" {{ (Auth::user()->personalInformation->military_status ?? '') == 'پایان خدمت' ? 'selected' : '' }}>پایان خدمت</option></select></div>
                                            </div>
                                        </div>
                                        <button class="col-md-12 mt-2" id="info-submit" type="submit">ذخیره تغییرات</button>
                                    </form>
                                </div>
                            </div>
                            <!-- -->
                            <!-- preview info -->
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->personalInformation->residence_city ?? 'شهر سکونت خود را وارد کنید'}}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شهر سکونت</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->personalInformation->gender ?? 'جنسیت حود را وارد کنید' }}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: جنسیت</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value" id="birthDateDisplay" name="birth_date">{{ Auth::user()->personalInformation->birth_date ?? 'تاریخ تولد خود را وارد کنید' }}</div>                                
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: تاریخ تولد</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->personalInformation->personal_id ?? 'کد ملی خود را وارد کنید' }}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: کدملی</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->personalInformation->military_status ?? 'وضعیت نظام وظیفه ثبت نشده است' }}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: وضعیت خدمت</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->phone ?? 'اطلاعات تماس ثبت نشده است' }}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شماره موبایل</h6></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9 info-value">{{ Auth::user()->personalInformation->email ?? 'آدرس ایمیل خود را وارد کنید' }}</div>
                                <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: ایمیل</h6></div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <!-- -->
                    <div class="row gutters-sm">
                        <div class="col-md-12 mb-3">
                            
                            
                            <!-- job -->
                            <div class="card">
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="addBtn" id="openPopupBtn"><i class="bi bi-plus sign"></i></button>
                                    <h5 class=" align-items-center my-2" id="rtl"><i class="material-icons my-2">سوابق شغلی شما</i></h5>
                                </div>
                                <div id="jobPopup" class="popup">
                                    <div class="popup-content">
                                        <div class="d-flex justify-content-between">
                                            <button class="closeBtn" id="closePopupBtn"><i class="bi bi-x sign"></i></button>
                                            <h4 class="mt-2">ثبت سابقه شغلی</h4>
                                        </div>

                                        <!-- فرم پاپ‌آپ -->
                                        <form id="jobForm">
                                            <div class="form-group">
                                                <label for="jobTitle">عنوان شغلی</label>
                                                <input type="text" class="input" id="jobTitle" class="form-control" placeholder="عنوان شغلی را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jobPosition">سمت شغلی</label>
                                                <input type="text" class="input" id="jobPosition" class="form-control" placeholder="سمت شغلی را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="organizationName">نام سازمان</label>
                                                <input type="text" class="input" id="organizationName" class="form-control" placeholder="نام سازمان را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="startDate">زمان شروع</label>
                                                <input type="text" id="startDate" class="persian-datepicker input" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="endDate">زمان پایان</label>
                                                <input type="text" id="endDate" class="persian-datepicker input" required>
                                            </div>

                                            <!-- دکمه ارسال -->
                                            <button type="submit" id="JobSubmit" class="col-md-12 mt-3">ارسال</button>
                                        </form>
                                    </div>
                                </div>
                                <div id="EditJobPopup" class="popup">
                                    <div class="popup-content">
                                        <div class="d-flex justify-content-between">
                                            <button class="closeBtn" id="closeEditJobPopupBtn"><i class="bi bi-x sign"></i></button>

                                            <h4 class="mt-2">ویرایش سوابق شغلی</h4>
                                        </div>

                                        <!-- فرم پاپ‌آپ -->
                                        <form id="editJobForm">
                                            <div class="form-group">
                                                <label for="editJobTitle">عنوان شغلی</label>
                                                <input type="text" class="input" id="editJobTitle" class="form-control" placeholder="عنوان شغلی را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editJobPosition">سمت شغلی</label>
                                                <input type="text" class="input" id="editJobPosition" class="form-control" placeholder="سمت شغلی را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editOrganizationName">نام سازمان</label>
                                                <input type="text" class="input" id="editOrganizationName" class="form-control" placeholder="نام سازمان را وارد کنید" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editStartDate">زمان شروع</label>
                                                <input type="text"  id="editStartDate" class="persian-datepicker input" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editEndDate">زمان پایان</label>
                                                <input type="text"  id="editEndDate" class="persian-datepicker input" required>
                                            </div>

                                            <!-- دکمه ارسال -->
                                            <button type="submit" id="editJobSubmit" class="col-md-12 mt-3">ارسال</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- preview job -->
                                    @if(Auth::user()->jobHistories->isNotEmpty())
                                        @foreach(Auth::user()->jobHistories as $job)
                                            <div class="jobcard py-3 mt-2">
                                                <div class="d-flex justify-content-between align-items-center experience">
                                                    <button class="editBtn JobEditBtn" data-job-id="{{ $job->id }}" data-job-title="{{ $job->job_title }}"
                                                            data-job-position="{{ $job->job_position }}" data-company-name="{{ $job->company_name }}"
                                                            data-start-date="{{ $job->start_date }}" data-end-date="{{ $job->end_date }}">                                                        <svg height="1em" viewBox="0 0 512 512">
                                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                                        </svg>
                                                    </button>
                                                    <h5>{{ $job->job_title ?? 'بدون عنوان شغلی' }}</h5>

                                                </div>
                                                <div class="mr-3 mt-2">
                                                    <h6>{{ $job->job_position ?? 'بدون سمت' }}</h6>
                                                    <h6>{{ $job->company_name ?? 'نامشخص' }}</h6>
                                                    <span class="d-flex justify-content-between">
                                                            <button class="deletebtn JobDeleteBtn mt-2" data-job-id="{{ $job->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 14" class="svgIcon bin-top"><g clip-path="url(#clip0_35_24)"><path fill="black" d="M20.8232 2.62734L19.9948 4.21304C19.8224 4.54309 19.4808 4.75 19.1085 4.75H4.92857C2.20246 4.75 0 6.87266 0 9.5C0 12.1273 2.20246 14.25 4.92857 14.25H64.0714C66.7975 14.25 69 12.1273 69 9.5C69 6.87266 66.7975 4.75 64.0714 4.75H49.8915C49.5192 4.75 49.1776 4.54309 49.0052 4.21305L48.1768 2.62734C47.3451 1.00938 45.6355 0 43.7719 0H25.2281C23.3645 0 21.6549 1.00938 20.8232 2.62734ZM64.0023 20.0648C64.0397 19.4882 63.5822 19 63.0044 19H5.99556C5.4178 19 4.96025 19.4882 4.99766 20.0648L8.19375 69.3203C8.44018 73.0758 11.6746 76 15.5712 76H53.4288C57.3254 76 60.5598 73.0758 60.8062 69.3203L64.0023 20.0648Z"></path></g><defs><clipPath id="clip0_35_24"><rect fill="white" height="14" width="69"></rect></clipPath></defs></svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 57" class="svgIcon bin-bottom"><g clip-path="url(#clip0_35_22)"><path fill="black" d="M20.8232 -16.3727L19.9948 -14.787C19.8224 -14.4569 19.4808 -14.25 19.1085 -14.25H4.92857C2.20246 -14.25 0 -12.1273 0 -9.5C0 -6.8727 2.20246 -4.75 4.92857 -4.75H64.0714C66.7975 -4.75 69 -6.8727 69 -9.5C69 -12.1273 66.7975 -14.25 64.0714 -14.25H49.8915C49.5192 -14.25 49.1776 -14.4569 49.0052 -14.787L48.1768 -16.3727C47.3451 -17.9906 45.6355 -19 43.7719 -19H25.2281C23.3645 -19 21.6549 -17.9906 20.8232 -16.3727ZM64.0023 1.0648C64.0397 0.4882 63.5822 0 63.0044 0H5.99556C5.4178 0 4.96025 0.4882 4.99766 1.0648L8.19375 50.3203C8.44018 54.0758 11.6746 57 15.5712 57H53.4288C57.3254 57 60.5598 54.0758 60.8062 50.3203L64.0023 1.0648Z"></path></g><defs><clipPath id="clip0_35_22"><rect fill="white" height="57" width="69"></rect></clipPath></defs></svg>
                                                                </button>
                                                                <h6>از {{ $job->start_date ?? 'تاریخ شروع نامشخص' }} تا {{ $job->end_date ?? 'تاریخ پایان نامشخص' }}</h6>

                                                            </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card bg-danger align-items-center m-3">
                                            <p class="m-0" id="rtl">هیچ سابقه شغلی ثبت نشده است</p>

                                        </div>
                                    @endif
                                <!--  -->
                            </div>
                            <!--  -->
                        </div>  
                        <div class="col-md-12 mb-3">
                            
                                                        <!-- Edu -->
                            <div class="card">
                                <div class="d-flex justify-content-between mb-3">
                                    <button   class="addBtn EduAddBtn"><i class="bi bi-plus sign"></i></button>
                                    <h5 class=" align-items-center my-2" id="rtl"><i class="material-icons mr-2">سوابق تحصیلی شما</i></h5>
                                </div>
                                <!-- Edu add pop-up -->
                                    <div class="popup" id="EduPopup">
                                        <div class="popup-content" id="rtl">
                                            <div class="d-flex justify-content-between">
                                                <span class="closeBtn"  onclick="closeEduPopup()"><i class="bi bi-x sign"></i></span>
                                                <h4 class="m-0">سابقه تحصیلی</h4>
                                            </div>
                                            <label for="degree">مدرک تحصیلی</label>
                                            <select id="degree" name="degree">
                                                <option value="سیکل">سیکل</option>
                                                <option value="دیپلم">دیپلم</option>
                                                <option value="کاردانی">کاردانی</option>
                                                <option value="کارشناسی">کارشناسی</option>
                                                <option value="کارشناسی ارشد">کارشناسی ارشد</option>
                                                <option value="دکترا">دکترا</option>
                                            </select>
                                            <label for="field">رشته تحصیلی</label>
                                            <input class="input" type="text" id="field" name="field" placeholder="رشته تحصیلی را وارد کنید">
                                            <label for="university">دانشگاه/مدرسه</label>
                                            <input class="input" type="text" id="university" name="university" placeholder="نام دانشگاه/مدرسه را وارد کنید">
                                            <label for="city">شهر تحصیل</label>
                                            <input class="input" type="text" id="city" name="city" placeholder="شهر تحصیل را وارد کنید">
                                            <button id="EduSubmit" class="col-md-12 mt-3" type="submit">ارسال</button>
                                        </div>
                                    </div>
                                <!--  -->
                                <!-- Edu edit pop-up -->
                                    <div class="popup" id="EditEduPopup">
                                        <div class="popup-content"  id="rtl">
                                            <div class="d-flex justify-content-between">
                                                <span class="closeBtn"  onclick="closeEditEduPopup()"><i class="bi bi-x sign"></i></span>
                                                <h4 class="m-0">سابقه تحصیلی</h4>
                                            </div>
                                            <label for="degree">مدرک تحصیلی</label>
                                            <select id="editedegree" name="degree">
                                                <option value="سیکل">سیکل</option>
                                                <option value="دیپلم">دیپلم</option>
                                                <option value="کاردانی">کاردانی</option>
                                                <option value="کارشناسی">کارشناسی</option>
                                                <option value="کارشناسی ارشد">کارشناسی ارشد</option>
                                                <option value="دکترا">دکترا</option>
                                            </select>
                                            <label for="field">رشته تحصیلی</label>
                                            <input class="input" type="text" id="editefield" name="field" placeholder="رشته تحصیلی را وارد کنید">
                                            <label for="university">دانشگاه/مدرسه</label>
                                            <input class="input" type="text" id="editeuniversity" name="university" placeholder="نام دانشگاه/مدرسه را وارد کنید">
                                            <label for="city">شهر تحصیل</label>
                                            <input class="input" type="text" id="editecity" name="city" placeholder="شهر تحصیل را وارد کنید">
                                            <button id="editeEduSubmit" class="col-md-12 mt-3" type="submit">ارسال</button>
                                        </div>
                                    </div>
                                <!--  -->
                                <!-- Edu preview -->
                                    @if(Auth::user()->educationalHistories->isNotEmpty())
                                        @foreach(Auth::user()->educationalHistories as $educational)
                                            <div class="study-card py-3 mt-2">
                                                <div class="d-flex justify-content-between align-items-center experience">
                                                    <button class="editBtn" id="editEduBtn">
                                                        <svg height="1em" viewBox="0 0 512 512">
                                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                                        </svg>
                                                    </button>
                                                    <h5>{{ $educational->degree}}</h5>
                                                </div>
                                                <div class="mr-3 mt-2">
                                                    <h6>{{ $educational->major}}</h6>
                                                    <h6>{{ $educational->university}}</h6>
                                                    <span class="d-flex justify-content-between">
                                                                    <button class="Edudeletebtn deletebtn mt-2" data-id="{{ $educational->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 14" class="svgIcon bin-top"><g clip-path="url(#clip0_35_24)"><path fill="black" d="M20.8232 2.62734L19.9948 4.21304C19.8224 4.54309 19.4808 4.75 19.1085 4.75H4.92857C2.20246 4.75 0 6.87266 0 9.5C0 12.1273 2.20246 14.25 4.92857 14.25H64.0714C66.7975 14.25 69 12.1273 69 9.5C69 6.87266 66.7975 4.75 64.0714 4.75H49.8915C49.5192 4.75 49.1776 4.54309 49.0052 4.21305L48.1768 2.62734C47.3451 1.00938 45.6355 0 43.7719 0H25.2281C23.3645 0 21.6549 1.00938 20.8232 2.62734ZM64.0023 20.0648C64.0397 19.4882 63.5822 19 63.0044 19H5.99556C5.4178 19 4.96025 19.4882 4.99766 20.0648L8.19375 69.3203C8.44018 73.0758 11.6746 76 15.5712 76H53.4288C57.3254 76 60.5598 73.0758 60.8062 69.3203L64.0023 20.0648Z"></path></g><defs><clipPath id="clip0_35_24"><rect fill="white" height="14" width="69"></rect></clipPath></defs></svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 57" class="svgIcon bin-bottom"><g clip-path="url(#clip0_35_22)"><path fill="black"d="M20.8232 -16.3727L19.9948 -14.787C19.8224 -14.4569 19.4808 -14.25 19.1085 -14.25H4.92857C2.20246 -14.25 0 -12.1273 0 -9.5C0 -6.8727 2.20246 -4.75 4.92857 -4.75H64.0714C66.7975 -4.75 69 -6.8727 69 -9.5C69 -12.1273 66.7975 -14.25 64.0714 -14.25H49.8915C49.5192 -14.25 49.1776 -14.4569 49.0052 -14.787L48.1768 -16.3727C47.3451 -17.9906 45.6355 -19 43.7719 -19H25.2281C23.3645 -19 21.6549 -17.9906 20.8232 -16.3727ZM64.0023 1.0648C64.0397 0.4882 63.5822 0 63.0044 0H5.99556C5.4178 0 4.96025 0.4882 4.99766 1.0648L8.19375 50.3203C8.44018 54.0758 11.6746 57 15.5712 57H53.4288C57.3254 57 60.5598 54.0758 60.8062 50.3203L64.0023 1.0648Z"></path></g><defs><clipPath id="clip0_35_22"><rect fill="white" height="57" width="69"></rect></clipPath></defs></svg>
                                                                    </button>
                                                                    <h6>{{ $educational->study_city}}</h6>
                                                                </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card bg-danger align-items-center m-3">
                                            <p class="m-0" id="rtl">هیچ سابقه تحصیلی ثبت نشده است</p>
                                        </div>
                                    @endif
                                <!--  -->
                            </div>
                            <!--  -->
                        </div>
                        <div class="col-12 mb-3">
                            

                            <!-- language -->
                                <div class="card"  id="rtl" style="max-height: 291px; overflow: auto;">
                                    <div class="d-flex justify-content-between p-0 mb-3" >
                                        <button   class="addBtn LanguageAddBtn"><i class="bi bi-plus sign"></i></button>
                                        <h5 class=" align-items-center my-2"><i class="material-icons mr-2">سطح زبان</i></h5>
                                    </div>
                                    <!-- language pop-up -->
                                    <div id="popup" class="popup">
                                        <div class="popup-content" >
                                            <div class="col-md-12 d-flex justify-content-between p-0">
                                                <span class="closeBtn"   onclick="LanguageclosePopup()"><i class="bi bi-x sign"></i></span>
                                                <h4 class="m-0">انتخاب زبان</h4>
                                            </div>
                                            <div class="select-container">
                                                <label for="language">زبان</label>
                                                <select id="language" name="language">
                                                    <option value="انگلیسی">انگلیسی</option>
                                                    <option value="فرانسوی">فرانسوی</option>
                                                    <option value="اسپانیایی">اسپانیایی</option>
                                                </select>
                                            </div>
                                            <div class="select-container">
                                                <label for="level">سطح زبان</label>
                                                <select id="level" name="level">
                                                    <option value="مبتدی">مبتدی</option>
                                                    <option value="متوسط رو به پایین">متوسط رو به پایین</option>
                                                    <option value="متوسط">متوسط</option>
                                                    <option value="متوسط رو به بالا">متوسط رو به بالا</option>
                                                    <option value="پیشرفته">پیشرفته</option>
                                                    <option value="درحد زبان مادری">در حد زبان مادری</option>
                                                </select>
                                            </div>
                                            <button  onclick="saveLanguageLevel()" id="LanguageSubmit" class="col-md-12 mt-5">تأیید</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <!-- language preview -->
                                
                                    @if(Auth::user()->languages->isNotEmpty())
                                    <div class="col-12 row" dir="rtl">
                                        @foreach(Auth::user()->languages as $language)
                                            <div class="language m-1">
                                                                                                <span><i class="bi bi-x-circle-fill text-danger remove-language" style="cursor: pointer;" data-id="{{ $language->id }}"></i></span>
                                                <span class="mx-1">|</span>

                                                <span class="tag-title font-weight-bold">{{ $language->language}}</span>
                                                <span class="mx-1">|</span>
                                                <span>{{ $language->language_level}}</span>
                                            </div>
                                         @endforeach
                                    </div>
                                    @else
                                        <div class="card bg-danger align-items-center m-3">
                                            <p class="m-0" id="rtl">هیچ زبانی ثبت نشده است.</p>
                                        </div>
                                    @endif
                                    <!--  -->
                                </div>
                            <!--  -->
                            <!-- skill -->
                                <div class="card mt-3"  id="rtl" style="max-height: 291px; overflow: auto;">
                                    <div class="d-flex justify-content-between p-0 mb-3" >
                                        <button   class="addBtn" id="SkillBtn"><i class="bi bi-plus sign"></i></button>
                                        <h5 class=" align-items-center my-2"><i class="material-icons mr-2">مهارت ها</i></h5>
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
                            <!--  -->
                        </div>
                    </div>
                </div>  

            </div>
            <!-- nav-bar -->
            <nav class="breadcrumb justify-content-between">
                <button class="addBtn" id="portfolioAddBtn"><i class="bi bi-plus sign"></i></button>    

                <h4 class="mt-1">نمونه کار های شما</h4>
            </nav>
            <div id="portfolioPopup" class="popup">
                <div class="popup-content">
                    <div class="col-md-12 d-flex justify-content-between ">
                        <span class="closeBtn"   onclick="portfolioClosePopup()"><i class="bi bi-x sign"></i></span>   

                        <h4>ثبت نمونه کار</h4>
                    </div>  

                    <label for="projectTitle">عنوان نمونه کار</label>
                    <input class="input" type="text" id="projectTitle" placeholder="عنوان را وارد کنید">    

                    <div class="col-md-12 p-0" id="rtl">
                        <label for="projectFile">انتخاب فایل</label>
                        <button class="addBtn" id="portfolioSendBtn"><i class="bi bi-plus sign"></i></button>
                        <input type="file" id="projectFile" accept="image/*,video/*,audio/*,.html,.css" style="display: none;" onchange="previewFile()">
                    </div>
                    <div class="col-md-12 mt-4">
                        <div id="portfolioPreview" class="file-preview"></div>
                    </div>  

                    <label for="projectDescription">توضیحات</label>
                    <input class="input" id="projectDescription" placeholder="توضیحات نمونه کار">   

                    <label for="projectLink">لینک نمونه کار</label>
                    <input class="input" type="url" id="projectLink" placeholder="لینک را وارد کنید" oninput="checkProjectLink()">
                    <div id="buttonsContainer"></div>   

                    <button class="col-md-12 mt-3" id="portfolioSubmit" onclick="submitProject()">ارسال</button>
                </div>
            </div>  

            @if(Auth::user()->portfolios->isNotEmpty())
                @foreach(Auth::user()->portfolios as $portfolio)
<div class="main my-5">
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
                                             <div class="likes" id="portoflioDeleteBtn" data-id="{{ $portfolio->id }}">
                                                <div class="deletePortfolio">
                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 14" class="svgIcon bin-top" >
                                                    <g clip-path="url(#clip0_35_24)"><path fill="black" d="M20.8232 2.62734L19.9948 4.21304C19.8224 4.54309 19.4808 4.75 19.1085 4.75H4.92857C2.20246 4.75 0 6.87266 0 9.5C0 12.1273 2.20246 14.25 4.92857 14.25H64.0714C66.7975 14.25 69 12.1273 69 9.5C69 6.87266 66.7975 4.75 64.0714 4.75H49.8915C49.5192 4.75 49.1776 4.54309 49.0052 4.21305L48.1768 2.62734C47.3451 1.00938 45.6355 0 43.7719 0H25.2281C23.3645 0 21.6549 1.00938 20.8232 2.62734ZM64.0023 20.0648C64.0397 19.4882 63.5822 19 63.0044 19H5.99556C5.4178 19 4.96025 19.4882 4.99766 20.0648L8.19375 69.3203C8.44018 73.0758 11.6746 76 15.5712 76H53.4288C57.3254 76 60.5598 73.0758 60.8062 69.3203L64.0023 20.0648Z"></path></g>
                                                    <defs>
                                                        <clipPath id="clip0_35_24"><rect fill="white" height="14" width="69"></rect></clipPath>
                                                    </defs>
                                                  </svg>                                                

                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 69 57" class="svgIcon bin-bottom" >
                                                    <g clip-path="url(#clip0_35_22)">
                                                      <path
                                                        fill="black"
                                                        d="M20.8232 -16.3727L19.9948 -14.787C19.8224 -14.4569 19.4808 -14.25 19.1085 -14.25H4.92857C2.20246 -14.25 0 -12.1273 0 -9.5C0 -6.8727 2.20246 -4.75 4.92857 -4.75H64.0714C66.7975 -4.75 69 -6.8727 69 -9.5C69 -12.1273 66.7975 -14.25 64.0714 -14.25H49.8915C49.5192 -14.25 49.1776 -14.4569 49.0052 -14.787L48.1768 -16.3727C47.3451 -17.9906 45.6355 -19 43.7719 -19H25.2281C23.3645 -19 21.6549 -17.9906 20.8232 -16.3727ZM64.0023 1.0648C64.0397 0.4882 63.5822 0 63.0044 0H5.99556C5.4178 0 4.96025 0.4882 4.99766 1.0648L8.19375 50.3203C8.44018 54.0758 11.6746 57 15.5712 57H53.4288C57.3254 57 60.5598 54.0758 60.8062 50.3203L64.0023 1.0648Z"
                                                      ></path>
                                                    </g>
                                                    <defs>
                                                      <clipPath id="clip0_35_22">
                                                        <rect fill="white" height="57" width="69"></rect>
                                                      </clipPath>
                                                    </defs>
                                                  </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                @endforeach
            @else
                <div class="card bg-danger align-items-center m-3">
                    <p class="m-0" id="rtl">هیچ نمونه کاری ثبت نشده است</p>
                </div>
            @endif  
            
                <nav class="breadcrumb justify-content-between mt-5">
                    <a href="{{ route('Newadvertisement') }}"><button class="addBtn"><i class="bi bi-plus sign"></i></button></a>    
                    <h4 class="mt-1">آگهی های ثبت شده تا کنون</h4>
                </nav> 
            @if($ads->isNotEmpty())
@foreach($ads as $ad)
@php
    $isDistinguished = $ad->tags->contains(fn($tag) => $tag->name === 'متمایز');
@endphp

<div 
    class="card-advertisement 
           {{ $isDistinguished ? 'distinguished-card' : '' }} 
           {{ $ad->status === 'expired' ? 'card-expired' : 'card-open' }}"
    dir="rtl"
>

@if($ad->status === 'expired')
    <span class="ad-status expired">منقضی شده</span>
@else
    <span class="ad-status open">فعال</span>
@endif
@if($ad->status === 'expired')
    <div class="renew-overlay">
<button class="renew-btn" onclick="location.href='{{ route('Newadvertisement', ['renew' => $ad->id]) }}'">
    تمدید آگهی
</button>

    </div>
@endif

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
        </div>

        <!-- بدنه کارت -->
        <div class="card-body-advertisement">
            <h5>{{ $ad->title }}</h5>
            <h6>{{ $ad->service_type }}</h6>
<p style="min-height: 113px">
    {!! nl2br(e(Str::limit($ad->description, 200))) !!}
</p>
        </div>

        <!-- فوتر کارت: قیمت -->
        <div class="card-body-bottom">
            <h6>
        از {{ $ad->price  }}      <span class="price-label"></span>
            </h6>
        </div>

    </div>
@endforeach
@else
<div class="card bg-danger align-items-center m-3">
                                            <p class="m-0" id="rtl">تا کنون آگهی ثبت نکردید</p>
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

// وقتی صفحه لود شد مقدار اولیه رو هم به‌روز کنه
document.addEventListener('DOMContentLoaded', updateCharCount);

                function goToPortfolio(id) {
                    window.location.href = `/portfolio/${id}`;
                }
            
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
            
                        document.addEventListener('DOMContentLoaded', function() {
    const openFilePicker = document.getElementById('openFilePicker');
    const fileInput = document.getElementById('profilePicInput');

    openFilePicker.addEventListener('click', function() {
        fileInput.click(); // باز کردن input هنگام کلیک روی آیکون
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const el = document.getElementById('birthDateDisplay');
    const birthDate = el.textContent.trim();

    // اگر مقدار خالی نبود و تاریخ معتبر بود
    if (birthDate && birthDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
        // جدا کردن سال، ماه، روز میلادی
        const [gy, gm, gd] = birthDate.split('-').map(Number);

        // تبدیل به شمسی با jalaali-js
        const j = jalaali.toJalaali(gy, gm, gd);
        let shamsi = `${j.jy}/${String(j.jm).padStart(2, '0')}/${String(j.jd).padStart(2, '0')}`;

        // تبدیل اعداد انگلیسی به فارسی
        shamsi = shamsi.replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);

        // نمایش در HTML
        el.textContent = shamsi;
    }
});

        document.getElementById("gender-select").addEventListener("change", function () {
            let militaryStatusWrapper = document.getElementById("military-status-wrapper");

            if (this.value === "زن") {
                militaryStatusWrapper.style.display = "none"; // مخفی کردن
            } else {
                militaryStatusWrapper.style.display = "block"; // نمایش
            }
        });

        // اطمینان از تنظیم وضعیت اولیه هنگام بارگذاری صفحه
        window.onload = function () {
            document.getElementById("gender-select").dispatchEvent(new Event("change"));
        };

        document.getElementById("InfoBtn").onclick = function() {
            document.getElementById("editPopup").style.display = "flex";
        };

        document.getElementById("close").onclick = function() {
            document.getElementById("editPopup").style.display = "none";
        };
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // جلوگیری از ارسال سنتی فرم

            document.getElementById('editPopup').style.display = 'none';
            document.getElementById("loading-screen").style.display = "flex";

            // ایجاد یک آبجکت با ساختاری که کنترلر انتظار دارد
            const formData = {
                PersonalStatus: {
                    residenceCity: document.querySelector("input[name='residence_city']").value,
                    gender: document.querySelector("select[name='gender']").value,
                    birthDate: document.querySelector("input[name='birth_date']").value,
                    nationalID: document.querySelector("input[name='personal_id']").value,
                    militaryStatus: document.querySelector("select[name='military_status']")?.value || null,
                    phone: document.querySelector("input[name='phone']").value,
                    email: document.querySelector("input[name='email']").value,
                }
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
                console.log("Server response:", xhr.responseText); // **لاگ گرفتن از پاسخ سرور**

                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log("Parsed response:", response); // **لاگ گرفتن از JSON پارس شده**

                        if (response.success) {
                            showAlert("اطلاعات شخصی شما با موفقیت ذخیره شد", "success");
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
            xhr.send(JSON.stringify(formData));
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

        // ذخیره تغییرات پروفایل
        document.getElementById('editProfilePopup').querySelector('.save-btn').addEventListener('click', function(event) {
            event.preventDefault(); // جلوگیری از ارسال سنتی فرم

            document.getElementById('editProfilePopup').style.display = 'none';
            document.getElementById("loading-screen").style.display = "flex";

            // جمع‌آوری داده‌ها از فیلدهای فرم
            const profileData = {
                fullName: document.getElementById('fullName').value, // نام و نام خانوادگی
                workField: document.getElementById('workArea').value, // حوضه کاری
                aboutMe: document.getElementById('aboutMe').value,  // درباره من
                profileImage: document.getElementById('profilePic').src // تصویر پروفایل (Base64 یا مسیر فایل)
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
                            location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود

                        }
                    } catch (error) {
                        showAlert("خطا در ارسال درخواست", "error");
                        console.error("Error parsing response:", error, "Raw response:", xhr.responseText);
                        location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود

                    }
                } else {
                    showAlert("خطا در ارسال درخواست", "error");
                    console.error("Error sending data:", xhr.status, xhr.statusText, "Response:", xhr.responseText);
                    location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود

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

        // نمایش پاپ آپ
        document.querySelector('.LanguageAddBtn').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'flex';
        });

        // بستن پاپ آپ
        function LanguageclosePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // ارسال فرم (اینجا می‌توانید داده‌ها را ارسال کنید یا هر عملی انجام دهید)
        function saveLanguageLevel() {
            // جلوگیری از ارسال فرم به صورت سنتی
            event.preventDefault();

            document.getElementById('popup').style.display = 'none';
            document.getElementById("loading-screen").style.display = "flex";


            // جمع‌آوری داده‌ها از سلکت باکس‌ها
            const language = document.getElementById('language').value;
            const level = document.getElementById('level').value;

            // ساخت آرایه برای ارسال به سرور
            const languageData = {
                language: language,
                level: level
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

                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            showAlert("زبان مورد نظر با موفقیت ثبت شد", "success");
                            location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                        } else {
                            showAlert("خطا در ارسال درخواست", "error");
                            location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                        }
                    } catch (error) {
                        showAlert("خطا در ارسال درخواست", "error");
                        console.error("Error parsing response:", error, "Raw response:", xhr.responseText);
                        location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                    }
                } else {
                    showAlert("خطا در ارسال درخواست", "error");
                    console.error("Error sending data:", xhr.status, xhr.statusText, "Response:", xhr.responseText);
                    location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                }
            };

            // مدیریت خطای اتصال به سرور
            xhr.onerror = function() {
                showAlert("خطا در برقراری ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید", "error");
                console.error("Network error");
            };

            // ارسال داده به سرور
            xhr.send(JSON.stringify({ StatusLanguages: [languageData] }));
        }

        // اضافه کردن رویداد کلیک به دکمه‌های حذف
        document.querySelectorAll('.remove-language').forEach(button => {
            button.addEventListener('click', function(event) {

                document.getElementById("loading-screen").style.display = "flex";

                const languageId = event.target.getAttribute('data-id'); // شناسه زبان را از data-id بگیرید

                // ارسال درخواست حذف به سرور
                fetch(`/delete-language/${languageId}`, {
                    method: 'DELETE',  // استفاده از متد DELETE
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // اگر حذف موفق بود، زبان را از لیست حذف کنید
                            event.target.closest('.language').remove();
                            showAlert("زبان مورد نظر با موفقیت حذف شد", "success");
                            location.reload(); // صفحه را مجدداً بارگذاری کن

                        } else {
                            showAlert("خطا در ارسال درخواست", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert("خطا در ارسال درخواست", "error");
                    });
            });
        });


        // تابع برای باز کردن پاپ آپ
        function openEduPopup() {
            document.getElementById("EduPopup").style.display = "flex";
        }

        // تابع برای بستن پاپ آپ
        function closeEduPopup() {
            document.getElementById("EduPopup").style.display = "none";
        }

        // برای اضافه کردن رویداد به دکمه
        document.querySelector('.EduAddBtn').addEventListener('click', openEduPopup);

        function saveEducationData() {
            // جلوگیری از ارسال فرم به صورت سنتی
            event.preventDefault();

            document.getElementById("EduPopup").style.display = "none";
            document.getElementById("loading-screen").style.display = "flex";


            // جمع‌آوری داده‌ها از پاپ آپ
            const degree = document.getElementById('degree').value;
            const fieldOfStudy = document.getElementById('field').value;
            const university = document.getElementById('university').value;
            const city = document.getElementById('city').value;

            // ساخت آبجکت برای ارسال به سرور
            const educationData = {
                degree: degree,
                fieldOfStudy: fieldOfStudy,
                university: university,
                city: city
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
                console.log("Server response:", xhr.responseText); // **لاگ گرفتن از پاسخ سرور**

                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log("Parsed response:", response); // **لاگ گرفتن از JSON پارس شده**

                        if (response.success) {
                            showAlert("سابقه تحصیلی با موفقیت ذخیره شد", "success");
                            closeEduPopup(); // بستن پاپ آپ بعد از ارسال موفقیت‌آمیز
                            location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                        } else {
                            showAlert("خطا در ارسال درخواست", "error");
                            location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                        }
                    } catch (error) {
                        alert("خطایی در پردازش پاسخ سرور رخ داد.");
                        console.error("Error parsing response:", error, "Raw response:", xhr.responseText);
                        location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                    }
                } else {
                    alert("خطا در ارسال اطلاعات! لطفاً دوباره امتحان کنید.");
                    console.error("Error sending data:", xhr.status, xhr.statusText, "Response:", xhr.responseText);
                    location.reload(); // صفحه را مجدداً بارگذاری کن تا اطلاعات جدید نمایش داده شود
                }
            };

            // مدیریت خطای اتصال به سرور
            xhr.onerror = function() {
                showAlert("خطا در برقراری ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی کنید", "error");
                console.error("Network error");
            };

            // ارسال داده‌ها به سرور
            xhr.send(JSON.stringify({ StatusEducation: [educationData] }));
        }

        // افزودن رویداد برای دکمه ارسال اطلاعات
        document.getElementById('EduSubmit').addEventListener('click', saveEducationData);

        // تابع برای حذف اطلاعات تحصیلی
        function deleteEducation(button) {
            const id = button.getAttribute('data-id'); // گرفتن ID از data-id

            customConfirm("آیا مطمئن هستید که می‌خواهید این سابقه تحصیلی را حذف کنید؟", function (confirmed) {
                if (confirmed) {
                    // نمایش لودینگ
                    document.getElementById("loading-screen").style.display = "flex";

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // ایجاد درخواست AJAX
                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', `/education/${id}`, true);

                    // تنظیم هدرهای مورد نیاز
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.setRequestHeader('Content-Type', 'application/json');

                    // مدیریت پاسخ سرور
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    showAlert("سابقه تحصیلی با موفقیت حذف شد", "success");
                                } else {
                                    showAlert("خطا در حذف سابقه تحصیلی", "error");
                                }
                            } catch (error) {
                                console.error("Error parsing response:", error);
                                showAlert("خطا در پردازش پاسخ سرور", "error");
                            }
                            location.reload();
                        } else {
                            showAlert("خطا در حذف اطلاعات", "error");
                            location.reload();
                        }
                    };

                    // ارسال درخواست حذف
                    xhr.send();
                }
            });
        }


        // اضافه کردن رویداد به تمام دکمه‌های حذف
        document.querySelectorAll('.Edudeletebtn').forEach(button => {
            button.addEventListener('click', function() {
                deleteEducation(this);
            });
        });

        // وقتی روی دکمه Edit کلیک می‌شود
        $(document).on('click', '#editEduBtn', function() {
            // پیدا کردن مقادیر مربوطه
            var educationId = $(this).closest('.study-card').find('.Edudeletebtn').data('id');
            var degree = $(this).closest('.study-card').find('h5').text();
            var field = $(this).closest('.study-card').find('h6').first().text();
            var university = $(this).closest('.study-card').find('h6').eq(1).text();
            var city = $(this).closest('.study-card').find('h6').last().text();

            // تنظیم مقادیر در پاپ‌آپ
            $('#editedegree').val(degree);
            $('#editefield').val(field);
            $('#editeuniversity').val(university);
            $('#editecity').val(city);

            // ذخیره شناسه برای ارسال به کنترلر
            $('#editeEduSubmit').data('id', educationId);

            // نمایش پاپ‌آپ
            $('#EditEduPopup').css('display', 'flex');
        });

        // بستن پاپ‌آپ
        function closeEditEduPopup() {
            $('#EditEduPopup').hide();
        }

        // ارسال فرم
        $('#editeEduSubmit').on('click', function(event) {
            event.preventDefault();

            document.getElementById("EditEduPopup").style.display = "none";
            document.getElementById("loading-screen").style.display = "flex";


            var id = $(this).data('id');  // اطمینان از اینکه شناسه به درستی دریافت می‌شود
            var degree = $('#editedegree').val();
            var field = $('#editefield').val();
            var university = $('#editeuniversity').val();
            var city = $('#editecity').val();

            console.log('Sending data:', { id, degree, field, university, city });

            $.ajax({
                url: '/educational/update',
                type: 'PUT',
                data: {
                    id: id,
                    degree: degree,
                    field: field,
                    university: university,
                    city: city,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        closeEditEduPopup();
                        showAlert("سابقه مورد نظر با موفقیت ویرایش شد", "success");
                        location.reload();
                    } else {
                        showAlert("خطا در ارسال درخواست", "error");

                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    showAlert("خطا در ارسال درخواست", "error");
                }
            });
        });

        // دریافت المان‌ها
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

        // دکمه باز کردن پاپ‌آپ
        const openPopupBtn = document.getElementById('openPopupBtn');
        const jobPopup = document.getElementById('jobPopup');
        const closePopupBtn = document.getElementById('closePopupBtn');

        // باز کردن پاپ‌آپ
        openPopupBtn.addEventListener('click', () => {
            jobPopup.style.display = 'flex'; // نمایش پاپ‌آپ
        });

        // بستن پاپ‌آپ
        closePopupBtn.addEventListener('click', () => {
            jobPopup.style.display = 'none'; // پنهان کردن پاپ‌آپ
        });

        // ارسال داده‌ها
        document.getElementById('jobForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            document.getElementById("jobPopup").style.display = "none";

            document.getElementById("loading-screen").style.display = "flex";

            const jobTitle = document.getElementById('jobTitle').value.trim();
            const jobPosition = document.getElementById('jobPosition').value.trim();
            const organizationName = document.getElementById('organizationName').value.trim();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!jobTitle || !jobPosition || !organizationName || !startDate) {
                showAlert("لطفاً تمامی فیلدهای ضروری را پر کنید", "error");
                return;
            }

            const jobData = {
                StatusJobs: [{
                    jobTitle,
                    jobPosition,
                    organizationName,
                    startDate,
                    endDate
                }]
            };

            try {
                const response = await fetch('/submit-profile', { // مسیر نسبی استفاده شده
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },
                    credentials: "include",
                    body: JSON.stringify(jobData)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                showAlert("سابقه شغلی با موفقیت ثبت شد", "success");
                location.reload();
            } catch (error) {
                console.error("Error:", error);
                showAlert("خطا در ارسال درخواست", "error");
            }
        });


        document.querySelectorAll('.JobDeleteBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                const jobId = this.getAttribute('data-job-id'); // شناسه شغل را از دکمه دریافت می‌کنیم



                customConfirm("آیا مطمئن هستید که می‌خواهید این شغل را حذف کنید؟", function (result) {

                    if (result) {
                        document.getElementById("loading-screen").style.display = "flex";

                        fetch(`/job-history/${jobId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message === 'سابقه شغلی با موفقیت حذف شد') {
                                    document.getElementById("jobPopup").style.display = "none";
                                    showAlert("سوابق شغلی با موفقیت حذف شد", "success");
                                    location.reload()
                                } else {
                                    showAlert("خطا در حذف سوابق شغلی", "error");
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showAlert("خطا در ارسال درخواست", "error");
                            });
                    }
                });

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // پاپ‌آپ‌ها
            const editJobPopup = document.getElementById('EditJobPopup');

            // دکمه‌های بسته
            const closeEditJobPopupBtn = document.getElementById('closeEditJobPopupBtn');

            // دکمه‌های ویرایش
            const editButtons = document.querySelectorAll('.JobEditBtn');

            // فرم ویرایش شغل
            const editJobForm = document.getElementById('editJobForm');

            // نمایش پاپ‌آپ ویرایش شغل
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-job-id');  // شناسه شغل
                    const jobTitle = this.getAttribute('data-job-title');
                    const jobPosition = this.getAttribute('data-job-position');
                    const companyName = this.getAttribute('data-company-name');
                    const startDate = this.getAttribute('data-start-date');
                    const endDate = this.getAttribute('data-end-date');

                    // قرار دادن مقادیر در فرم ویرایش
                    document.getElementById('editJobTitle').value = jobTitle;
                    document.getElementById('editJobPosition').value = jobPosition;
                    document.getElementById('editOrganizationName').value = companyName;
                    document.getElementById('editStartDate').value = startDate;
                    document.getElementById('editEndDate').value = endDate;

                    // نمایش پاپ‌آپ ویرایش
                    editJobPopup.style.display = 'flex';

                    // ذخیره شناسه شغل برای ارسال در درخواست AJAX
                    editJobForm.setAttribute('data-job-id', jobId);
                });
            });

            // بستن پاپ‌آپ ویرایش شغل
            closeEditJobPopupBtn.addEventListener('click', function() {
                editJobPopup.style.display = 'none';
            });

            // ارسال فرم ویرایش شغل
            const submitButton = document.getElementById('editJobSubmit'); // دکمه ارسال

            submitButton.addEventListener('click', function(event) {
                event.preventDefault();



                const jobId = editJobForm.getAttribute('data-job-id');
                const jobTitle = document.getElementById('editJobTitle').value;
                const jobPosition = document.getElementById('editJobPosition').value;
                const companyName = document.getElementById('editOrganizationName').value;
                const startDate = document.getElementById('editStartDate').value;
                const endDate = document.getElementById('editEndDate').value;

                document.getElementById("EditJobPopup").style.display = "none";
                document.getElementById("loading-screen").style.display = "flex";
                // ارسال داده‌ها با استفاده از AJAX
                $.ajax({
                    url: '/job/update/' + jobId,  // اضافه کردن شناسه شغل به URL
                    type: 'PUT',
                    data: {
                        job_title: jobTitle,
                        job_position: jobPosition,
                        company_name: companyName,
                        start_date: startDate,
                        end_date: endDate,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success) {
                            // بستن پاپ‌آپ ویرایش
                            editJobPopup.style.display = 'none';
                            showAlert("اطلاعات شغلی با موفقیت ویرایش شد", "success");
                            location.reload();  // بارگذاری مجدد صفحه برای نمایش تغییرات
                        } else {
                            showAlert("خطا در ارسال درخواست", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        showAlert("خطا در ارسال درخواست", "error");
                    }
                });
            });

        });


        document.getElementById("portfolioAddBtn").addEventListener("click", function() {
            document.getElementById("portfolioPopup").style.display = "flex";
        });

        function portfolioClosePopup() {
            document.getElementById("portfolioPopup").style.display = "none";
        }

        function previewFile() {
            const file = document.getElementById('projectFile').files[0];
            const portfolioPreview = document.getElementById('portfolioPreview');

            if (!file) return;

            const fileURL = URL.createObjectURL(file);
            const fileType = file.type;

            if (fileType.startsWith('image/')) {
                // نمایش تصویر
                portfolioPreview.innerHTML = `<img src="${fileURL}" alt="Preview">`;
                portfolioPreview.style.display = 'flex';
            } else if (fileType.startsWith('video/')) {
                // نمایش ویدئو
                portfolioPreview.innerHTML = `<video src="${fileURL}" controls></video>`;
                portfolioPreview.style.display = 'flex';
            } else if (fileType.startsWith('audio/')) {
                // نمایش فایل صوتی
                portfolioPreview.innerHTML = `<audio src="${fileURL}" controls style="width: 100%;"></audio>`;
                portfolioPreview.style.display = 'flex';
            } else if (fileType === 'text/html' || file.name.endsWith('.html')) {
                // نمایش فایل HTML
                portfolioPreview.innerHTML = `<iframe src="${fileURL}" style="width: 100%; height: 100%; border: none; overflow: hidden;"></iframe>`;
                portfolioPreview.style.display = 'block';
            } else {
                // نمایش پیام خطا در صورت عدم پشتیبانی از نوع فایل
                portfolioPreview.innerHTML = `<p class="text-center text-danger info-text">پیش‌نمایش برای این نوع فایل موجود نیست</p>`;
                portfolioPreview.style.display = 'block';
            }
        }

        document.getElementById("portfolioSendBtn").addEventListener("click", function() {
            document.getElementById("projectFile").click();
        });

        function checkProjectLink() {
            const link = document.getElementById("projectLink").value.trim();
            const buttonsContainer = document.getElementById("buttonsContainer");

            let buttonsHTML = "";

            if (link.includes("github.com")) {
                buttonsHTML += `<a href="${link}" id="githubBtn" class="socialBtn">
                                  <svg class="github-svgIcon" viewBox="0 0 496 512" height="1.4em" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8z"></path>
                                  </svg>
                                  <span class="text">Github</span>
                                </a>`;
            }

            if (link.includes("soundcloud.com")) {
                buttonsHTML += `<a href="${link}" id="soundcloudBtn" class="socialBtn" >
                                    <svg  class="soundcloud-svgIcon"  viewBox="0 0 640 512" height="25px" xmlns="http://www.w3.org/2000/svg" fill="#ff8800" class="soundcloud"><path d="M111.4 256.3l5.8 65-5.8 68.3c-.3 2.5-2.2 4.4-4.4 4.4s-4.2-1.9-4.2-4.4l-5.6-68.3 5.6-65c0-2.2 1.9-4.2 4.2-4.2 2.2 0 4.1 2 4.4 4.2zm21.4-45.6c-2.8 0-4.7 2.2-5 5l-5 105.6 5 68.3c.3 2.8 2.2 5 5 5 2.5 0 4.7-2.2 4.7-5l5.8-68.3-5.8-105.6c0-2.8-2.2-5-4.7-5zm25.5-24.1c-3.1 0-5.3 2.2-5.6 5.3l-4.4 130 4.4 67.8c.3 3.1 2.5 5.3 5.6 5.3 2.8 0 5.3-2.2 5.3-5.3l5.3-67.8-5.3-130c0-3.1-2.5-5.3-5.3-5.3zM7.2 283.2c-1.4 0-2.2 1.1-2.5 2.5L0 321.3l4.7 35c.3 1.4 1.1 2.5 2.5 2.5s2.2-1.1 2.5-2.5l5.6-35-5.6-35.6c-.3-1.4-1.1-2.5-2.5-2.5zm23.6-21.9c-1.4 0-2.5 1.1-2.5 2.5l-6.4 57.5 6.4 56.1c0 1.7 1.1 2.8 2.5 2.8s2.5-1.1 2.8-2.5l7.2-56.4-7.2-57.5c-.3-1.4-1.4-2.5-2.8-2.5zm25.3-11.4c-1.7 0-3.1 1.4-3.3 3.3L47 321.3l5.8 65.8c.3 1.7 1.7 3.1 3.3 3.1 1.7 0 3.1-1.4 3.1-3.1l6.9-65.8-6.9-68.1c0-1.9-1.4-3.3-3.1-3.3zm25.3-2.2c-1.9 0-3.6 1.4-3.6 3.6l-5.8 70 5.8 67.8c0 2.2 1.7 3.6 3.6 3.6s3.6-1.4 3.9-3.6l6.4-67.8-6.4-70c-.3-2.2-2-3.6-3.9-3.6zm241.4-110.9c-1.1-.8-2.8-1.4-4.2-1.4-2.2 0-4.2.8-5.6 1.9-1.9 1.7-3.1 4.2-3.3 6.7v.8l-3.3 176.7 1.7 32.5 1.7 31.7c.3 4.7 4.2 8.6 8.9 8.6s8.6-3.9 8.6-8.6l3.9-64.2-3.9-177.5c-.4-3-2-5.8-4.5-7.2zm-26.7 15.3c-1.4-.8-2.8-1.4-4.4-1.4s-3.1.6-4.4 1.4c-2.2 1.4-3.6 3.9-3.6 6.7l-.3 1.7-2.8 160.8s0 .3 3.1 65.6v.3c0 1.7.6 3.3 1.7 4.7 1.7 1.9 3.9 3.1 6.4 3.1 2.2 0 4.2-1.1 5.6-2.5 1.7-1.4 2.5-3.3 2.5-5.6l.3-6.7 3.1-58.6-3.3-162.8c-.3-2.8-1.7-5.3-3.9-6.7zm-111.4 22.5c-3.1 0-5.8 2.8-5.8 6.1l-4.4 140.6 4.4 67.2c.3 3.3 2.8 5.8 5.8 5.8 3.3 0 5.8-2.5 6.1-5.8l5-67.2-5-140.6c-.2-3.3-2.7-6.1-6.1-6.1zm376.7 62.8c-10.8 0-21.1 2.2-30.6 6.1-6.4-70.8-65.8-126.4-138.3-126.4-17.8 0-35 3.3-50.3 9.4-6.1 2.2-7.8 4.4-7.8 9.2v249.7c0 5 3.9 8.6 8.6 9.2h218.3c43.3 0 78.6-35 78.6-78.3.1-43.6-35.2-78.9-78.5-78.9zm-296.7-60.3c-4.2 0-7.5 3.3-7.8 7.8l-3.3 136.7 3.3 65.6c.3 4.2 3.6 7.5 7.8 7.5 4.2 0 7.5-3.3 7.5-7.5l3.9-65.6-3.9-136.7c-.3-4.5-3.3-7.8-7.5-7.8zm-53.6-7.8c-3.3 0-6.4 3.1-6.4 6.7l-3.9 145.3 3.9 66.9c.3 3.6 3.1 6.4 6.4 6.4 3.6 0 6.4-2.8 6.7-6.4l4.4-66.9-4.4-145.3c-.3-3.6-3.1-6.7-6.7-6.7zm26.7 3.4c-3.9 0-6.9 3.1-6.9 6.9L227 321.3l3.9 66.4c.3 3.9 3.1 6.9 6.9 6.9s6.9-3.1 6.9-6.9l4.2-66.4-4.2-141.7c0-3.9-3-6.9-6.9-6.9z"></path></svg>
                                  <span class="text">Soundcloud</span>
                                </a>`;
            }

            buttonsContainer.innerHTML = buttonsHTML;
        }



        // رویداد برای بررسی لینک هنگام تایپ
        document.getElementById("projectLink").addEventListener("input", checkProjectLink);

        function submitProject() {
    const title = document.getElementById("projectTitle").value.trim();
    const description = document.getElementById("projectDescription").value.trim();
    const link = document.getElementById("projectLink").value.trim();
    const file = document.getElementById('projectFile').files[0];

    // بررسی خالی بودن مقادیر
    if (!title) {
        showAlert("لطفاً عنوان پروژه را وارد کنید", "error");
        return;
    }
        if (!file) {
        showAlert("لطفاً فایل پروژه را انتخاب کنید", "error");
        return;
    }
    if (!description) {
        showAlert("لطفاً توضیحات پروژه را وارد کنید", "error");
        return;
    }
 


    // نمایش لودینگ بعد از اعتبارسنجی موفق
    document.getElementById("portfolioPopup").style.display = "none";
    document.getElementById("loading-screen").style.display = "flex";

    // ساخت FormData برای ارسال به سرور
    let formData = new FormData();
    formData.append('portfolioData[title]', title);
    formData.append('portfolioData[description]', description);
    formData.append('portfolioData[link]', link);
    formData.append('portfolioData[file]', file);

    // ارسال داده‌ها با fetch
    fetch('/submit-profile', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert("نمونه کار با موفقیت ارسال شد", "success");
            location.reload();  // رفرش برای نمایش تغییرات
        } else {
            showAlert("خطا در ارسال نمونه کار", "error");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert("خطا در ارتباط با سرور", "error");
    });
}


        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#portoflioDeleteBtn").forEach(button => {
                button.addEventListener("click", function () {
                    let portfolioId = this.getAttribute("data-id");

                    customConfirm("آیا از حذف این نمونه کار مطمئن هستید؟", function(result) {
                        if (result) {
                            document.getElementById("loading-screen").style.display = "flex";
                            fetch(`/delete/portfolio/${portfolioId}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                                    "Content-Type": "application/json"
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showAlert("نمونه کار با موفقیت حذف شد", "success");
                                        let portfolioElement = document.getElementById(`portfolio-${portfolioId}`);
                                        if (portfolioElement) {
                                            portfolioElement.remove();
                                        }
                                        setTimeout(() => location.reload(), 500);
                                    } else {
                                        showAlert("مشکلی پیش آمد، لطفاً دوباره تلاش کنید", "error");
                                    }
                                    document.getElementById("loading-screen").style.display = "none";
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                    showAlert("خطا در ارتباط با سرور، لطفاً دوباره تلاش کنید", "error");
                                    document.getElementById("loading-screen").style.display = "none";
                                });
                        }
                    });





                });
            });
        });

        function showAlert(message, type = "success", duration = 3000) {
            const alertBox = document.getElementById('custom-alert');
            const alertMessage = document.getElementById('alert-message');

            alertMessage.textContent = message;
            alertBox.style.display = 'block';

            // حذف کلاس‌های قبلی
            alertBox.classList.remove("success-alert", "error-alert");

            // اضافه کردن کلاس بر اساس نوع پیام
            if (type === "success") {
                alertBox.classList.add("success-alert");
            } else if (type === "error") {
                alertBox.classList.add("error-alert");
            }

            // پنهان کردن بعد از مدت زمان مشخص
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, duration);
        }

        function customConfirm(message, callback) {
            const confirmDialog = document.createElement("div");
            confirmDialog.className = "confirm-popup";
            confirmDialog.innerHTML = `
            <div class="confirm-content">
                <p>${message}</p>
                <div class="confirm-buttons">
                    <button class="confirm-btn yes">بله</button>
                    <button class="confirm-btn no">خیر</button>
                </div>
            </div>
        `;
            document.body.appendChild(confirmDialog);
            confirmDialog.style.display = "flex";

            confirmDialog.querySelector(".yes").onclick = function () {
                callback(true);
                confirmDialog.remove();
            };

            confirmDialog.querySelector(".no").onclick = function () {
                callback(false);
                confirmDialog.remove();
            };
        }


        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get("popup") === "open") {
                document.getElementById('editProfilePopup').style.display = 'flex';
            }
        });

        //کد های مربوط به تقویم
        $('.persian-datepicker').persianDatepicker({
            "inline": false,
            "format": "L",
            "viewMode": "year",
            "initialValue": true,
            "minDate": null,
            "maxDate": null,
            "autoClose": true,
            "position": "auto",
            "altFormat": "l",
            "altField": "#altfieldExample",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "inputDelay": 800,
            "observer": false,
            "calendar": {
                "persian": {
                    "locale": "fa",
                    "showHint": true,
                    "leapYearMode": "algorithmic"
                },
                "gregorian": {
                    "locale": "fa",
                    "showHint": false
                }
            },
            "navigator": {
                "enabled": true,
                "scroll": {
                    "enabled": true
                },
                "text": {
                    "btnNextText": "<",
                    "btnPrevText": ">"
                }
            },
            "toolbox": {
                "enabled": false,
                "calendarSwitch": {
                    "enabled": false,
                    "format": "MMMM"
                },
                "todayButton": {
                    "enabled": false,
                    "text": {
                        "fa": "امروز",
                        "en": "Today"
                    }
                },
                "submitButton": {
                    "enabled": false,
                    "text": {
                        "fa": "تایید",
                        "en": "Submit"
                    }
                },
                "text": {
                    "btnToday": "امروز"
                }
            },
            "timePicker": {
                "enabled": false,
                "step": 1,
                "hour": {
                    "enabled": false,
                    "step": null
                },
                "minute": {
                    "enabled": false,
                    "step": null
                },
                "second": {
                    "enabled": false,
                    "step": null
                },
                "meridian": {
                    "enabled": false
                }
            },
            "dayPicker": {
                "enabled": true,
                "titleFormat": "YYYY MMMM"
            },
            "monthPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "yearPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "responsive": true
        });
    </script>
</body>
</html>
