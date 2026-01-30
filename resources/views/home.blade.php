@extends('layouts.master')
@section('title', 'Trang Chủ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/HomePage.css') }}">
    <style>
        /* Chỉnh lại margin để slide không bị che bởi menu fixed */
        #demo {
            margin-top: 75px;
        }
    </style>
@endpush

@section('content')

    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('frontend/img/3cup.jpg') }}" alt="3_cup" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/img/OSK.jpg') }}" alt="latte" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/img/coffeeShop_scene.avif') }}" alt="scene" class="d-block w-100">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container mt-5">
        <h3 class="text-center">Thử NGON_plus ngay!...Tại sao không?</h3>
        <p class="text-center mt-3 mx-5">Ngon_Plus, Một thương hiệu coffee đến từ công ty CCK WEB_06 với tiêu chí khách hàng
            là NUMBER ONE.
            Chúng tôi luôn mong muốn mang đến cho khách hàng những sản phẩm tốt nhất, dịch vụ hoàn hảo nhất.
            Đến với Ngon_Plus, bạn sẽ được trải nghiệm những sản phẩm chất lượng nhất,
            dịch vụ tốt nhất và sự phục vụ tận tình nhất từ đội ngũ nhân viên của chúng tôi.</p>
        <img src="{{ asset('frontend/img/coffee_meeting.avif') }}" alt="people and coffee" class="img mt-3 d-block mx-auto"
            style="width: 75%; height: auto;">
    </div>

    <div class="container-fluid pt-5 pb-5 text-white text-center mt-5" style="background-color: #634832;">
        <h3 class="text-center">MENU NGON_PLUS ĐÂY !</h3>
        <p class="pb-5 pt-3" style="font-style: italic;">Tại sao không thử một ly nhỉ?</p>

        <div class="row text-center g-4 px-5">
            @foreach ($products as $sp)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="h-100 position-relative group-product">
                        <a href="{{ route('products.show', $sp->id) }}" class="text-decoration-none text-white">
                            <img src="{{ asset('frontend/img/' . $sp->image) }}" alt="{{ $sp->name }}"
                                class="menu-img mx-auto d-block"
                                style="width: 100%; max-width: 250px; height: 250px; object-fit: cover; border-radius: 10px;">

                            <h5 class="mt-3 fw-bold">{{ $sp->name }}</h5>

                            <p class="text-warning fw-bold">{{ number_format($sp->price) }} VNĐ</p>
                        </a>

                        <form action="{{ route('cart.add', $sp->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-light rounded-pill btn-sm px-4 fw-bold"
                                style="color: #634832;">
                                <i class="fas fa-cart-plus"></i> Thêm ngay
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-5 mb-4 text-center">
            <a href="{{ route('products.index') }}" class="btn shine-hover"
                style="background: black; border-radius: 19px; width: 200px; color: white; padding: 10px;">
                XEM TOÀN BỘ MENU
            </a>
        </div>
    </div>

    <div class="container-fluid text-white pt-5 pb-5" style="background-color: #927869;">
        <div class="row text-center g-1 pt-4 pb-4 align-items-center">
            <div class="col-md-4 px-5 text-center">
                <h1 class="fw-bold pb-3 pt-3">Giờ mở cửa</h1>
                <p>Thứ 2 - Thứ 6 hàng tuần <br>
                    7am - 11am <br>
                    11am - 10pm <br>
                </p>
                <p>Thứ 7 - CN hàng tuần <br>
                    8am - 1am <br>
                    11am - 9pm <br>
                </p>
                <hr style="border: 1px dashed white;">
                <p>Số điện thoại:</p>
                <h3 class="fw-bold">0909 909 099</h3>
            </div>
            <div class="col-md-7 pt-3">
                <img src="{{ asset('frontend/img/348s.jpg') }}" alt="burger" style="width: 100%; border-radius: 10px;">
            </div>
        </div>
    </div>

@endsection
