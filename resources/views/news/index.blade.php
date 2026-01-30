@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center mb-5" style="color: #1e2849; font-weight: bold;">NGON+ NEWS</h2>
    <div class="row">
       <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex">
            <div class="card h-100 d-flex flex-column shadow-sm border-0">
                <img src="{{ asset('frontend/img/cafe-san-vuon-co-dien.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Tại sao nên chọn Ngon Plus?</h5>
                    <p class="card-text text-muted">Khuôn viên quán mang lại cho quý khách một cảm giác không nơi nào có được.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex">
            <div class="card h-100 d-flex flex-column shadow-sm border-0">
                <img src="{{ asset('frontend/img/nhanvienphache.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Nhân viên tận tâm</h5>
                    <p class="card-text text-muted">Đội ngũ nhân viên luôn phục vụ niềm nở và chuyên nghiệp.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
