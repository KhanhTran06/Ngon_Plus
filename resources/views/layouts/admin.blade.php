<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Hệ Thống - NGON+</title>
    <link rel="icon" href="{{ asset('frontend/img/ngonPlus_favicon.ico') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #1e2849;
            color: #fff;
            transition: all 0.3s;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #151c33;
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 15px 25px;
            font-size: 1.1em;
            display: block;
            color: #ceab8c;
            text-decoration: none;
            border-left: 4px solid transparent;
        }

        #sidebar ul li a:hover,
        #sidebar ul li a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #ceab8c;
        }

        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Styling */
        #content {
            width: 100%;
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Navbar Admin */
        .admin-navbar {
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding: 15px 30px;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="fw-bold">NGON+ ADMIN</h4>
                <small>Hệ thống quản lý</small>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Tổng quan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.staff.index') }}"
                        class="{{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i> Quản lý Nhân viên
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers.index') }}"
                        class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i> Quản lý Khách hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-receipt"></i> Quản lý Đơn hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-coffee"></i> Quản lý Sản phẩm
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.news.index') }}"
                        class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i> Quản lý Tin tức
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.promotions.index') }}"
                        class="{{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> Quản lý Khuyến mãi
                    </a>
                </li>
            </ul>

            <div class="text-center mt-5">
                <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm w-75">
                    <i class="fas fa-globe"></i> Xem trang web
                </a>
            </div>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg admin-navbar">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light d-lg-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h5 class="ms-3 my-0 text-secondary text-uppercase">@yield('header_title')</h5>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ms-auto align-items-center">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://cdn-icons-png.flaticon.com/512/2206/2206368.png' }}"
                                        class="rounded-circle me-2" width="35" height="35"
                                        style="border: 2px solid #ceab8c;">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end shadow border-0">
                                    <a class="dropdown-item" href="{{ route('admin.avatar.edit') }}">
                                        <i class="fas fa-camera me-2"></i> Đổi avatar
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
