let formBtn = document.querySelector('#login-btn');
let loginForm = document.querySelector('.login-form-container');
let formClose = document.querySelector('#form-close');
let showpass = document.querySelector('#showpass');
let checkshowpass = false;
window.onscroll = () => {
    loginForm.classList.remove('active');
}
formBtn.addEventListener('click', () => {
    loginForm.classList.add('active');
});

formClose.addEventListener('click', () => {
    loginForm.classList.remove('active');
});
showpass.addEventListener('click', () => {
    if (checkshowpass == false) {
        showpass.classList.remove('fa-eye');
        showpass.classList.add('fa-eye-slash');
        checkshowpass = true;
    } else {
        checkshowpass = false;
        showpass.classList.remove('fa-eye-slash');
        showpass.classList.add('fa-eye');
    }

});
window.addEventListener("load", function() {
    const loginForm = document.querySelector(".login-form");
    const showPasswordIcon =
        loginForm && loginForm.querySelector(".show-password");
    const inputPassword =
        loginForm && loginForm.querySelector('input[type="password"');
    showPasswordIcon.addEventListener("click", function() {
        const inputPasswordType = inputPassword.getAttribute("type");
        inputPasswordType === "password" ?
            inputPassword.setAttribute("type", "text") :
            inputPassword.setAttribute("type", "password");
    });
});