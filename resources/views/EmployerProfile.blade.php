<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css"/>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>

    <link rel="stylesheet" href="/css/profile.css">
    </head>
<body>
    <div class="container">
        <div class="main-body">
            <nav class="breadcrumb">
                <div class="site-name"><img id="img-icon-name" src="{{ asset('images/welcome/name.jpg') }}" alt=""></div>
            </nav>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
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
                                            <span class="closeBtn"  onclick="closePopup()"><i class="bi bi-x sign mt-2"></i></span>
                                            <h4 class="m-0">پروفایل</h4>
                                        </div>
                                        <div class="popup-body">
                                            <div class="left-column">
                                                <div class="profile-container mt-4 mr-1">
                                                    <label for="profilePicInput" class="profile-pic-label">
                                                        <img id="profilePic" src="{{ Auth::user()->profilepic ? asset('storage/' . Auth::user()->profilepic) : asset('images/default.jpg') }}" class="rounded-circle" width="150" height="150" alt="Profile Picture">
                                                    </label>
                                                    <input type="file" id="profilePicInput" class="profile-pic-input" onchange="previewProfilePic(event)">
                                                </div>
                                            </div>
                                            <div class="right-column">
                                                <div class="input-group">
                                                    <label for="fullName">نام برند/شرکت</label>
                                                    <input type="text" id="fullName" value="{{ Auth::user()->name ?? 'نام و نام خانوادگی خود را وارد کنید' }}">
                                                </div>
                                                <div class="input-group">
                                                    <label for="workArea">حوضه کاری</label>
                                                    <input type="text" id="workArea" value="{{ Auth::user()->workarea ?? 'کاربر التا' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="about-me">
                                            <label for="aboutMe">درباره من</label>
                                            <textarea id="aboutMe">{{ Auth::user()->aboutme ?? 'متنی در باره شرکت خود خود برای معرفی بنویسید' }}</textarea>
                                        </div>
                                        <button class="col-md-12 save-btn" >ذخیره</button>
                                    </div>
                                 </div>
                                <div class="mt-1 text-center">
                                    <h4 class="mb-1">{{ Auth::user()->name ?? 'نام و نام خانوادگی خود را وارد کنید'}}</h4>
                                    <p class=" mb-1">{{ Auth::user()->workarea ?? 'کاربر التا'}}</p>
                                    <h6 class="username-card">{{ Auth::user()->username }}</h6>
                                    <p class="font-size-sm px-3 text-center" id="rtl">{{ Auth::user()->aboutme ?? 'متنی درباره شرکت خود برای معرفی بنویسید' }}</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 ">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('images/profile-pages/wallet.png') }}"  width="150">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1">
                                        <div class="d-flex align-items-center mt-2 mb-2">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1">
                                        <div class="d-flex align-items-center mt-2 mb-2">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item justify-content-between d-flex align-items-center p-1">
                                        <div class="d-flex align-items-center mt-2 mb-2">
                                            <h6 class="mr-5">1,300,000 toman</h6>
                                            <h6 id="rtl">:درآمد پروژه های باز</h6>
                                        </div>
                                    </li>
                                </ul>
                                <button class="button x"><img src="{{ asset('images/profile-pages/wallet-icon.png') }}"  width="28" viewBox="0 0 48 48"height="28">برداشت</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                <button  id="InfoBtn" class="addBtn"><i class="bi bi-plus sign"></i></button>
                                <h6 class=" align-items-center my-2" id="rtl"><i class="material-icons my-2">اطلاعات شرکت</i></h6>
                                </div>
                            </div>
                            <hr>
                            <!-- company info pop-up -->
                                <div id="editCompanyPopup" class="popup" style="display:none;">
                                    <div class="popup-content infoPopup" id="rtl">
                                        <div class="d-flex justify-content-between">
                                            <span class="closeBtn" id="close-company"><i class="bi bi-x sign mt-2"></i></span>
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
                                                    <input type="text" class="input" name="established_year " value="{{ Auth::user()->companies->established_year ?? '' }}">                             

                                                    <label>کدپستی</label>
                                                    <input type="text" class="input" name="postal_code" value="{{ Auth::user()->companies->postal_code ?? '' }}">                               

                                                    <label>شهر</label>
                                                    <input type="text" class="input" name="city" value="{{ Auth::user()->companies->city ?? '' }}">
                                                </div>                              
                                                <!-- right inputs -->
                                                <div class="col-md-6">
                                                    <label>آدرس</label>
                                                    <input type="text" class="input" name="address" value="{{ Auth::user()->companies->address ?? '' }}">                               

                                                    <label>شماره تلفن شرکت</label>
                                                    <input type="text" class="input" name="company_phone" value="{{ Auth::user()->companies->company_phone ?? '' }}">                               

                                                    <label>شناسه ملی شرکت</label>
                                                    <input type="text" class="input" name="national_id" value="{{ Auth::user()->companies->national_id ?? '' }}">
                                                </div>
                                            </div>
                                            <button class="col-md-12 save-btn mt-2" >ذخیره</button>
                                        </form>
                                    </div>
                                 </div>
                            <!-- -->
                            <!-- preview info -->
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_type ?? 'نوع شرکت خود را وارد کنید'}}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: نوع شرکت</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->established_year ?? 'سالروز تأسیس شرکت خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: سال تأسیس</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->postal_code ?? 'کدپستی شرکت خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: کدپستی</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->city ?? 'شهر خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شهر</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->address ?? 'آدرس کامل شرکت ثبت نشده است' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: آدرس</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_phone ?? 'اطلاعات تماس ثبت نشده است' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شماره تلفن</h6></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-9 info-value">{{ Auth::user()->companies->national_id ?? 'شناسه ملی شرکت خود را وارد کنید' }}</div>
                                    <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: شناسه ملی شرکت</h6></div>
                                </div>
                            <!--  -->
                        </div>
                    </div>
                    <div class="row gutters-sm">
                        <div class="col-sm-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <button class="addBtn" onclick="openRepresentativePopup()"><i class="bi bi-plus sign"></i></button>
                                        <h6 class=" align-items-center my-2" id="rtl"><i class="material-icons my-2">اطلاعات نماینده شرکت</i></h6>
                                    </div>
                                    <hr>
                                    <div id="representativePopup" class="popup">
                                        <div class="popup-content">
                                            <div class="d-flex justify-content-between">
                                                <span class="closeBtn" onclick="closeRepresentativePopup()"><i class="bi bi-x sign mt-2"></i></span>
                                                <h4>ویرایش نماینده شرکت</h4>
                                            </div>
                                            <form id="representativeForm">
                                                @csrf
                                                <label>نام نماینده شرکت</label>
                                                <input type="text" name="company_representative_name" class="input" value="{{ Auth::user()->companies->company_representative_name ?? '' }}">                                   

                                                <label>کد ملی نماینده</label>
                                                <input type="text" name="representative_national_code" class="input" value="{{ Auth::user()->companies->representative_national_code ?? '' }}">                                 

                                                <label>شماره همراه</label>
                                                <input type="text" name="representative_phone" class="input" value="{{ Auth::user()->companies->representative_phone ?? '' }}">                                 

                                                <label>ایمیل کاری</label>
                                                <input type="email" name="representative_email" class="input" value="{{ Auth::user()->companies->representative_email ?? '' }}">                                    

                                                <button type="submit" class="save-btn mt-3 col-md-12">ذخیره</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->companies->company_representative_name ?? 'نام نماینده شرکت را وارد کنید'}}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: نماینده شرکت</h6></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->companies->representative_national_code ?? 'کدملی نماینده شرکت را وارد کنید' }}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: کدملی</h6></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->companies->representative_phone ?? 'شماره همراه نماینده شرکت را وارد کنید' }}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: تلفن همراه</h6></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-9 info-value">{{ Auth::user()->companies->representative_email ?? 'آدرس ایمیل کاری شرکت ثبت نشده است' }}</div>
                                        <div class="col-sm-3 info-title" id="rtl"><h6 class="mb-0">: ایمیل</h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script>
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

        $(document).ready(function () {
            $('#editCompanyForm').on('submit', function (e) {
                e.preventDefault();  // جلوگیری از ارسال فرم به‌طور معمول
                document.getElementById("loading-screen").style.display = "flex";


                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route('companies.save') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert("اطلاعات شغلی با موفقیت ویرایش شد", "success");
                        location.reload();  // بارگذاری مجدد صفحه برای نمایش تغییرات
                    },
                    error: function(xhr, status, error) {
                        showAlert(" خطا در ارسال درخواست. لطفا دوباره تلاش کنید", "error");
                    }
                });
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
                    url: '{{ route('companies.save') }}',
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