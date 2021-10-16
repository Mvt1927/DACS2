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
let videoBtn = document.querySelectorAll('.vid-btn');
videoBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src = btn.getAttribute('data-src');
        document.querySelector('#video-slider').src = src;
    });
});