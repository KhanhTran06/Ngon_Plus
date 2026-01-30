const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

window.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    if (params.get('action') === 'register') {
        container.classList.add('active');
    } else if (params.get('action') === 'login') {
        container.classList.remove('active');
    }
});

// Kiểm tra email và mật khẩu khi đăng ký
$(document).ready(function () {
    $('.form-box.register form').on('submit', function (e) {
        const email = $('#register-email').val().trim();
        const password = $('#register-password').val();

        if (!email.includes('@')) {
            alert('Email phải chứa ký tự @');
            e.preventDefault();
            return;
        }

        const passwordValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password);
        if (!passwordValid) {
            alert('Mật khẩu phải dài ít nhất 8 ký tự và chứa cả chữ cái và số');
            e.preventDefault();
            return;
        }
    });
});
