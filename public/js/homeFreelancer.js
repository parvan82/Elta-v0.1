
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

document.addEventListener("DOMContentLoaded", () => {

    const slider = document.querySelector(".infinite-slider");
    const track = document.querySelector(".slider-track");

    let isDown = false;
    let startX = 0;
    let startTranslate = 0;
    let currentTranslate = 0;

    let speed = 0.50 ; // سرعت اسکرول اتومات
    let autoMoveId;

    function getTransformValue() {
        const style = window.getComputedStyle(track);
        const matrix = new DOMMatrixReadOnly(style.transform);
        return matrix.m41;
    }

    // حرکت اتومات از هر نقطه‌ای که هست
    function startAutoScroll() {
        cancelAnimationFrame(autoMoveId);

        function step() {
            currentTranslate += speed;
            track.style.transform = `translateX(${currentTranslate}px)`;

            // بازچرخانی بی‌نهایت
            const trackWidth = track.scrollWidth;
            const sliderWidth = slider.clientWidth;

            if (Math.abs(currentTranslate) >= trackWidth) {
                currentTranslate = 0;
            }

            autoMoveId = requestAnimationFrame(step);
        }

        autoMoveId = requestAnimationFrame(step);
    }

    function stopAutoScroll() {
        cancelAnimationFrame(autoMoveId);
    }

    slider.addEventListener("mousedown", (e) => {
        isDown = true;
        slider.classList.add("dragging");

        stopAutoScroll();

        startX = e.pageX;
        startTranslate = getTransformValue();
    });

    slider.addEventListener("touchstart", (e) => {
        isDown = true;
        slider.classList.add("dragging");

        stopAutoScroll();

        startX = e.touches[0].pageX;
        startTranslate = getTransformValue();
    });

function move(pageX) {
    if (!isDown) return;

    const walk = pageX - startX;
    currentTranslate = startTranslate + walk;

    // محدود کردن درگ به داخل کارت‌ها
    const maxTranslate = track.scrollWidth - slider.clientWidth;
    if (currentTranslate < 0) currentTranslate = 0;            // نمی‌ره جلوتر از اول
    if (currentTranslate > maxTranslate) currentTranslate = maxTranslate; // نمی‌ره فراتر از آخرین کارت

    track.style.transform = `translateX(${currentTranslate}px)`;
}


    slider.addEventListener("mousemove", (e) => move(e.pageX));
    slider.addEventListener("touchmove", (e) => move(e.touches[0].pageX));

    function stopDrag() {
        if (!isDown) return;

        isDown = false;
        slider.classList.remove("dragging");

        // ادامه حرکت از همین نقطه
        startAutoScroll();
    }

    slider.addEventListener("mouseup", stopDrag);
    slider.addEventListener("mouseleave", stopDrag);
    slider.addEventListener("touchend", stopDrag);

    // شروع حرکت از ابتدا
    startAutoScroll();

});
