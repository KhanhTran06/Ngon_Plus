@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center mb-5" style="color: #e2aa4a; font-weight: bold;">ƯU ĐÃI THÁNG NÀY</h2>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card bg-dark text-white border-0 shadow">
                <img src="{{ asset('frontend/img/ale.jpg') }}" class="card-img" alt="..." style="opacity: 0.6">
                <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                    <h3 class="card-title fw-bold">MUA 1 TẶNG 1</h3>
                    <p class="card-text">Áp dụng cho toàn bộ menu Trà vào thứ 3 hàng tuần.</p>
                    <p class="card-text"><small>Code: TUESDAY_JOY</small></p>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
