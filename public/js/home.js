document.addEventListener("DOMContentLoaded", () => {
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

    //navbar methods

    let previousScroll = 0;
    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > 70) {
            navHead.style.position = 'fixed';
            navHead.style.top = '0';
            if (currentScroll > previousScroll) {
                navHead.style.top = '-70px'; // هدر هنگام اسکرول به پایین مخفی می‌شود
            } else {
                navHead.style.top = '0'; // هدر هنگام اسکرول به بالا نمایش داده می‌شود
            }
        } else {
            navHead.style.position = 'absolute';
            navHead.style.top = '0';
        }
        previousScroll = currentScroll;
    });

});

//scroll parallaxing
const rows = document.querySelectorAll(".rows");
const floatingCard = document.querySelector(".floating-card");

function updateRows() {
    rows.forEach((item, index) => {
        let rect = item.getBoundingClientRect();
        let visibility = Math.max(0, 1 - rect.top / window.innerHeight);
        visibility = Math.min(visibility, 1);
        let direction = index % 2 === 0 ? 1 : -1;
        let translateX = (visibility * 300 - 200) * direction;
        item.style.transform = `translateX(${translateX}px)`;
    });
}

// floating card methods
function updateFloatingCard() {
    let scrollY = window.scrollY;
    let maxMoveUp = 150;
    let moveUp = Math.min(maxMoveUp, scrollY * 2);

    floatingCard.style.transform = `translateY(-${moveUp}px)`;
}


window.addEventListener("scroll", () => {
    updateRows();
    updateFloatingCard();
});
window.addEventListener("load", () => {
    updateRows();
    updateFloatingCard();
});

// input auto typing...
const input = document.querySelector('.search-input');
const text = "برنامه نویس بک اند"; // متنی که تایپ می‌شود
let currentIndex = 0;
let isTyping = true; // برای تشخیص اینکه در حال تایپ هستیم یا حذف
let isWaiting = false; // برای جلوگیری از تداخل تایم‌ها

// تایپ کردن یا حذف کردن حرف به حرف
function typeText() {
    if (isTyping) {
        input.placeholder = text.substring(0, currentIndex); // تایپ حرف به حرف
        currentIndex++;

        // وقتی به انتهای متن رسید، برای چند ثانیه تایپ شده می‌ماند
        if (currentIndex > text.length) {
            isTyping = false; // متوقف کردن تایپ
            isWaiting = true; // فعال کردن وضعیت انتظار
            setTimeout(() => {
                isWaiting = false; // تمام شدن زمان انتظار
                currentIndex = text.length; // شروع به حذف حرف
            }, 2000); // نگه داشتن تایپ شده برای 2 ثانیه
        }
    } else if (!isWaiting) {
        input.placeholder = text.substring(0, currentIndex); // حذف حرف به حرف
        currentIndex--;

        // وقتی به ابتدای متن رسید، دوباره تایپ می‌کنیم
        if (currentIndex <= 0) {
            isTyping = true; // شروع مجدد تایپ
        }
    }
}

// تکرار تایپ و حذف هر 100 میلی‌ثانیه
setInterval(typeText, 200);

// suggest cards
document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector(".suggest-card-container");
    let isDown = false;
    let startX;
    let scrollLeft;
    let autoScroll;

    // جلوگیری از انتخاب آیتم‌ها هنگام درگ
    container.style.userSelect = "none";

    // اسکرول خودکار به سمت چپ
    function startAutoScroll() {
        autoScroll = setInterval(() => {
            container.scrollLeft += 1; // افزایش مقدار اسکرول
        }, 20);
    }

    function stopAutoScroll() {
        clearInterval(autoScroll);
    }

    // شروع اسکرول خودکار
    startAutoScroll();

    // متوقف کردن اسکرول هنگام هاور
    container.addEventListener("mouseenter", stopAutoScroll);
    container.addEventListener("mouseleave", startAutoScroll);

    // اسکرول با موس (کشیدن)
    container.addEventListener("mousedown", (e) => {
        isDown = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
        e.preventDefault(); // جلوگیری از گرفتن آیتم‌ها هنگام درگ
    });

    container.addEventListener("mouseleave", () => {
        isDown = false;
    });

    container.addEventListener("mouseup", () => {
        isDown = false;
    });

    container.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 2; // مقدار سرعت اسکرول
        container.scrollLeft = scrollLeft - walk;
    });
});

//show back elta card
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".view-details-button").forEach(button => {
        button.addEventListener("click", function() {
            const card = this.closest(".eltaCard"); // پیدا کردن کارت والد مربوط به این دکمه
            const frontCard = card.querySelector(".front-elta-card");
            const backCard = card.querySelector(".back-elta-card");

            // تغییر کلاس‌ها برای نمایش یا مخفی کردن جزئیات کارت
            if (frontCard.classList.contains("active")) {
                frontCard.classList.remove("active", "blur");
                backCard.classList.remove("active");
                this.innerText = "نمایش جزئیات"; // تغییر متن دکمه به حالت اولیه
            } else {
                frontCard.classList.add("active", "blur");
                backCard.classList.add("active");
                this.innerText = "نمایش کارت"; // تغییر متن دکمه بعد از کلیک
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch('/unread-messages')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.notification-badge');
            if (data.unread > 0) {
                badge.textContent = data.unread;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        });
});

document.addEventListener('DOMContentLoaded', function () {
    const suggestItems = document.querySelectorAll('.suggest');
    const searchInput = document.querySelector('.search-input');
    const searchForm = document.querySelector('#search-section').closest('form');

    if (!searchInput || !searchForm || suggestItems.length === 0) {
        return;
    }

    suggestItems.forEach(item => {
        item.addEventListener('click', function () {
            const keyword = this.textContent.trim();
            searchInput.value = keyword;
            searchForm.submit();
        });
    });
});
