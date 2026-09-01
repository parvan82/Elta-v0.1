// - - - - -  Variables - - - - - //
let ignorePassword = false;
let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Wrapper Area
const wrapper__Area = document.querySelector('#wrapper_Area');

// Login & Sign-Up Forms
const loginForm = document.querySelector('#loginForm');
const signUpForm = document.querySelector('#signUpForm');

// All Login And Sign-Up Forms Inputs
const allLoginFormFields = Array.from(document.querySelectorAll('#loginForm .input__group .field input'));
const allSignUpFormFields = Array.from(document.querySelectorAll('#signUpForm .input__group:not(.confirm__group) .field input'));

// Password And Confirm Password Fields
const passwordField = document.querySelector('#signUpPassword');
const confirmPassword = document.querySelector('#signUpConfirmPassword');

// Show Hide Password Elements
const showHidePassDom = Array.from(document.querySelectorAll('.showHide__Icon i'));

// Regex Patterns
const patterns = {
    "UsernameOrPhone": /^(?:[a-z](?:[a-z0-9]*\.?[a-z0-9]+)*|09\d{9})$/,
    "username": /^[a-z]+\d?/,
    "password": /^[^\d\W]\w+\d?\W?\w?/i,
    "name": /^^/,
    "phone": /^^/
};

// Aside Buttons
const aside__SignUp_Button = document.querySelector('#aside_signUp_Btn');
const aside__SignIn_Button = document.querySelector('#aside_signIn_Btn');

// - - - - -  Events - - - - - //
// Login Form Submit
loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (loginFormValidation()) {
        loginForm.submit();
    }
});

// Sign-Up Form Submit
signUpForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (signUpFormValidation()) {
        signUpForm.submit();
    }
});

// Aside Buttons Click
document.querySelector('#aside_Area').addEventListener('click', chnageFormMode);

// Mobile Buttons
document.querySelector(".mobile-sing-up-btn").addEventListener("click", () => wrapper__Area.classList.add("Mobie_sign-up__Mode-active"));
document.querySelector(".mobile-sing-in-btn").addEventListener("click", () => wrapper__Area.classList.remove("Mobie_sign-up__Mode-active"));

// Show/Hide Password
showHidePassDom.forEach(icon => {
    icon.addEventListener('click', () => {
        const targetInput = icon.closest('.input__group').querySelector('.field input');
        if(icon.className.includes('bx-hide')){
            icon.className = 'bx bx-show';
            targetInput.setAttribute('type','text');
        } else {
            icon.className = 'bx bx-hide';
            targetInput.setAttribute('type','password');
        }
    });
});

// Change Form Mode Function
function chnageFormMode(e){
    if(e.target === aside__SignUp_Button) wrapper__Area.classList.add('sign-up__Mode-active');
    if(e.target === aside__SignIn_Button) wrapper__Area.classList.remove('sign-up__Mode-active');
}

// Login Form Validation
function loginFormValidation(){
    let isValid = true;
    allLoginFormFields.forEach(input => {
        const name = input.name;
        const placeholder = input.placeholder;
        const value = input.value.trim();

        // نادیده گرفتن پسورد در هنگام فراموشی
        if(ignorePassword && name === 'password'){
            setSuccessFor(input);
            return;
        }

        if(!value){
            setErrorFor(input, `${placeholder} الزامی است.`);
            isValid = false;
        } else if(!patterns[name].test(value)){
            setErrorFor(input, `${placeholder} نامعتبر است.`);
            isValid = false;
        } else {
            setSuccessFor(input);
        }
    });
    return isValid;
}

// Sign-Up Form Validation
function signUpFormValidation(){
    let isValid = true;
    allSignUpFormFields.forEach(input => {
        const placeholder = input.placeholder;
        const name = input.name;
        const value = input.value.trim();

        if(!value){
            setErrorFor(input, `فیلد ${placeholder} الزامی است.`);
            isValid = false;
        } else if(!patterns[name].test(value)){
            setErrorFor(input, `${placeholder} نامعتبر است.`);
            isValid = false;
        } else {
            setSuccessFor(input);
        }
    });

    // Confirm Password
    const passVal = passwordField.value.trim();
    const confirmVal = confirmPassword.value.trim();
    if(!confirmVal){
        setErrorFor(confirmPassword,'تکرار رمز عبور الزامی است.');
        isValid = false;
    } else if(passVal !== confirmVal){
        setErrorFor(confirmPassword,'رمز عبور و تکرار آن یکسان نیست.');
        isValid = false;
    } else {
        setSuccessFor(confirmPassword);
    }

    return isValid;
}



// Set Error / Success
function setErrorFor(input,msg){
    const parent = input.closest('.input__group');
    parent.classList.add('formError');
    parent.classList.remove('formSuccess');
    parent.querySelector('.input__error_message').innerHTML = msg;
}
function setSuccessFor(input){
    const parent = input.closest('.input__group');
    parent.classList.remove('formError');
    parent.classList.add('formSuccess');
    parent.querySelector('.input__error_message').innerHTML = '';
}
document.addEventListener('DOMContentLoaded', function () {
    var alertMessage = document.getElementById('alert-message');

    if (alertMessage) {
        // نمایش پیام خطا با انیمیشن fade-in و حرکت از بالا به پایین
        alertMessage.style.display = 'block';
        alertMessage.classList.add('fade-in');

        // بعد از 5 ثانیه، پیام خطا به تدریج ناپدید می‌شود
        setTimeout(function () {
            alertMessage.classList.remove('fade-in');
            alertMessage.classList.add('fade-out');

            // پس از اتمام انیمیشن fade-out، پیام به طور کامل پنهان می‌شود
            // زمان انیمیشن fade-out
        }, 3000); // 5000 میلی‌ثانیه = 5 ثانیه
    }
});
// Forgot Password Button
const forgotBtn = document.getElementById('forgotPasswordBtn');
if(forgotBtn){
    forgotBtn.addEventListener('click', () => {
        const usernameOrPhone = document.getElementById('loginUsername').value.trim();
        if(!usernameOrPhone){
            alert('لطفا نام کاربری یا شماره موبایل را وارد کنید.');
            return;
        }

        ignorePassword = true;

        // ساخت فرم داینامیک با پسورد خالی
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/reset';

        const token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = csrfToken;
        form.appendChild(token);

        const inputUsername = document.createElement('input');
        inputUsername.type = 'hidden';
        inputUsername.name = 'UsernameOrPhone';
        inputUsername.value = usernameOrPhone;
        form.appendChild(inputUsername);

        document.body.appendChild(form);
        form.submit();

        ignorePassword = false;
    });
}
