<nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-5 fixed-top">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo" class="d-inline-block"
            style="width: 120px; height: 75px;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">

            <li class="nav-item me-3">
                <form action="{{ route('products.search') }}" method="GET" class="d-flex">
                    <input class="form-control form-control-sm me-1" type="search" name="keyword"
                        placeholder="Tìm món..." style="width: 150px; border-radius: 20px;">
                    <button class="btn btn-outline-light btn-sm rounded-circle" type="submit"><i
                            class="fas fa-search"></i></button>
                </form>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">TRANG CHỦ</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('news') }}">NGON+ NEWS</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                    SẢN PHẨM <img src="{{ asset('frontend/img/down-chevron.png') }}" style="width: 15px;">
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('products.index') }}">XEM TẤT CẢ</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('products.index', ['cate' => 'Coffee']) }}">CÀ PHÊ</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('products.index', ['cate' => 'Tea']) }}">TRÀ</a></li>
                    <li><a class="dropdown-item" href="{{ route('products.index', ['cate' => 'Snack']) }}">BÁNH &
                            SNACK</a></li>
                </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ route('address') }}">ĐỊA CHỈ</a></li>

            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('promotions') }}">KHUYẾN MÃI</a></li>
                <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('login') }}">ĐĂNG NHẬP</a></li>
            @else
                @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                    <li class="nav-item"><a class="nav-link" href="{{ route('promotions') }}">KHUYẾN MÃI</a></li>

                    <li class="nav-item ms-2">
                        <a class="nav-link fw-bold text-warning border border-warning rounded px-3"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-user-cog"></i> QUẢN TRỊ
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center h-100">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white text-decoration-none"
                                style="font-size: 0.9rem;">(Đăng xuất)</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('promotions') }}">KHUYẾN MÃI</a></li>

                    <li class="nav-item mx-2">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            @if (session('cart'))
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.6rem;">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                            data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://cdn-icons-png.flaticon.com/512/1077/1077114.png' }}"
                                class="rounded-circle me-2" width="30" height="30">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Trang cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.history') }}">Lịch sử đơn hàng</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            @endguest

        </ul>
    </div>
</nav>
