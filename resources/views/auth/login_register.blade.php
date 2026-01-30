<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập / Đăng ký</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('frontend/css/Dangnhap.css') }}">
    <link rel="icon" href="{{ asset('frontend/img/ngonPlus_favicon.ico') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="back-button">
        <a href="{{ route('home') }}"><i class='bx bx-arrow-back' style="color: black;"></i></a>
    </div>

    @if (session('error'))
        <div
            style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background: #ffdddd; padding: 10px 20px; border-radius: 5px; color: red; z-index: 100;">
            {{ session('error') }}
        </div>
    @endif

    <div class="container {{ $errors->any() ? 'active' : '' }}">
        <div class="form-box login">
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <h1>Đăng nhập</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forgot-link"><a href="#">Quên mật khẩu?</a></div>
                <button type="submit" class="btn">Đăng nhập</button>
            </form>
        </div>

        <div class="form-box register">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Đăng ký</h1>

                <div class="input-box">
                    <input type="text" name="name" placeholder="Tên hiển thị" value="{{ old('name') }}"
                        required>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="tel" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"
                        required>
                    <i class='bx bxs-phone'></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Mật khẩu (min 6 ký tự)" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn">Đăng ký</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Xin chào!</h1>
                <p>Bạn chưa có tài khoản sao?</p>
                <button class="btn register-btn">Đăng ký</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Chào bạn!</h1>
                <p>Bạn đã có tài khoản rồi chứ?</p>
                <button class="btn login-btn">Đăng nhập</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/Dangnhap.js') }}"></script>
</body>

</html>
