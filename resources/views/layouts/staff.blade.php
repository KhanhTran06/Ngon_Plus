<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khu Vực Pha Chế - NGON+</title>
    <link rel="icon" href="{{ asset('frontend/img/ngonPlus_favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .staff-navbar {
            background-color: #1e2849;
            /* Màu xanh thương hiệu */
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .staff-navbar .brand {
            font-weight: bold;
            font-size: 1.2rem;
            color: #ceab8c;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg staff-navbar px-4 py-3">
        <div class="container-fluid">
            <span class="brand"><i class="fas fa-coffee me-2"></i> NGON+ STAFF</span>

            <div class="d-flex align-items-center">
                <span class="me-3">
                    Xin chào, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->job_title }})
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
</body>

</html>
