document.addEventListener("DOMContentLoaded", function () {

class StickyHeader {
    constructor() {
        this.header = $('.header');
        this.previousScroll = 0;
        this.stickyAddedOffset = null;
        $(window).scroll(() => { this.onScroll(); });
    }

    onScroll() {
        let currentScroll = $(window).scrollTop();
        let headerOffset = this.header.offset().top;

        if (currentScroll > headerOffset && this.stickyAddedOffset === null) {
            this.header.addClass('sticky');
            this.stickyAddedOffset = currentScroll;
        } else if (currentScroll <= this.stickyAddedOffset) {
            this.header.removeClass('sticky');
            this.stickyAddedOffset = null;
        }

        this.previousScroll = currentScroll;
    }
}

new StickyHeader();



$(document).ready(function () {
    var windowHeight = $(window).height(),
        footerHeight = $('footer').height(),
        heightDocument = windowHeight + $('.content').height() + footerHeight - 20;

    $('#scroll-animate, #scroll-animate-main').css({
        'height': heightDocument + 'px'
    });

    $('header').css({
        'height': windowHeight + 'px',
        'line-height': windowHeight + 'px'
    });

    $('.wrapper-parallax').css({
        'margin-top': windowHeight + 'px'
    });

    function scrollFooter(scrollY, heightFooter) {
        if (scrollY >= heightFooter) {
            $('footer').css({
                'bottom': '0px'
            });
        } else {
            $('footer').css({
                'bottom': '-' + heightFooter + 'px'
            });
        }
    }

    scrollFooter(window.scrollY, footerHeight);

    function showCardsOnScroll() {
        var scrollTop = $(window).scrollTop();
        var cardOffsetTop = $('.card-container').offset().top;

        $('.fade-in').each(function (index, card) {
            var cardTop = $(card).offset().top;

            if (scrollTop + windowHeight > cardTop) {
                $(card).css({
                    'opacity': 1,
                    'transform': 'translateY(0)',
                    'transition': 'opacity 1s ease-out, transform 1s ease-out'
                });
                $(card).css('animation', `fadeIn 1s ease-out forwards ${index * 0.1}s`);
            }
        });
    }

    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();

        $('#scroll-animate-main').css({
            'top': '-' + scroll + 'px'
        });

        $('header').css({
            'background-position-y': 50 - (scroll * 100 / heightDocument) + '%'
        });

        scrollFooter(scroll, footerHeight);

        showCardsOnScroll();
    });
});


    const buttons = document.querySelectorAll(".login-btn");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            const role = this.getAttribute("data-role");

            // ارسال رول به صفحه لاگین
            window.location.href = `elta/login?role=${role}`;
        });
    });

    // اضافه کردن قابلیت اسکرول به بخش جستجو
    const searchSection = document.getElementById('search-section');
    if (searchSection) {
        searchSection.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
});
