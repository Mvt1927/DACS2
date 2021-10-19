var menu_bar = document.querySelector("#menu-bar");
var nav_bar = document.querySelector("#nav-bar");
var login = document.querySelector("#login-btn");
var showpass = document.querySelector("#showpass");
var password = document.querySelector('#input_pass');
var login_form = document.querySelector('.login-form-container');
var login_close = document.querySelector('#login-close');
window.onscroll = () => {
    menu_bar.classList.remove("fa-times");
    nav_bar.classList.remove('active');
}
menu_bar.addEventListener('click', () => {
    menu_bar.classList.toggle('fa-times');
    nav_bar.classList.toggle('active');
});
login.addEventListener('click', () => {
    login_form.classList.toggle('active');
});
login_close.addEventListener('click', () => {
    login_form.classList.toggle('active');
});
showpass.addEventListener('click', () => {
    showpass.classList.toggle('fa-eye');
    showpass.classList.toggle('fa-eye-slash');
    var typepass = password.getAttribute("type");
    typepass == 'password' ?
        password.setAttribute("type", "text") :
        password.setAttribute("type", "password");
});
var num = 0;
let videoBtn = document.querySelectorAll('.vid-btn');
videoBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src = btn.getAttribute('data-src');
        document.querySelector('#video-slider').src = src;
    });
});

/* chuyen dong video */

var temp = 0;
var speed = 20000;

function rotateVideos() {
    videoBtn = document.querySelectorAll('.vid-btn');
    num++;
    if (num >= videoBtn.length) {
        num = -1;
        rotateVideos();
    } else {
        document.querySelector('.controls .active').classList.remove('active');
        document.querySelectorAll('.vid-btn').item(num).classList.add('active')
        document.querySelector('#video-slider').src = videoBtn.item(num).getAttribute('data-src');
        speed = videoBtn.item(num).getAttribute('data-time');
        setTimeout(function() { rotateVideos() }, speed);
    }
}

if (window.addEventListener) {
    window.addEventListener('load', function() { setTimeout(function() { rotateVideos() }, speed) }, false);
} else {
    if (window.attachEvent) {
        window.attachEvent('onload', function() { setTimeout(function() { rotateVideos() }, speed) });
    }
}

/* more rooms */
let moreBtn = document.querySelectorAll('.more-btn');
moreBtn.forEach(btn2 => {
    btn2.addEventListener('click', () => {
        var n = 3;
        let noactive = document.querySelectorAll(".box.noactive");
        if (noactive.length < 4) {
            n = noactive.length;
            btn2.classList.add('clicked');
        };
        for (let i = 0; i < n; i++) {
            noactive.item(i).classList.remove('noactive');
            noactive.item(i).classList.add('active');

        };
    });
});
var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".brand-slider", {
    spaceBetween: 20,
    loop: true,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        450: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 5,
        },
    },
});