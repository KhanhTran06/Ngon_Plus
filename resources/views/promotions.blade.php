@extends('layouts.master')
@section('title', 'Khuyến Mãi')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5" style="color: #e2aa4a; font-weight: bold;">CHƯƠNG TRÌNH KHUYẾN MÃI</h2>

    <div class="row">
        @forelse($promotions as $promo)
        <div class="col-md-6 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body text-center">
                    <h3 class="card-title display-6 fw-bold">{{ $promo->code }}</h3>
                    <p class="card-text fs-4">Giảm {{ $promo->discount_percent ? $promo->discount_percent.'%' : number_format($promo->discount_amount).'đ' }}</p>
                    <p>Áp dụng từ: {{ date('d/m/Y', strtotime($promo->start_date)) }} - {{ date('d/m/Y', strtotime($promo->end_date)) }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <img src="{{ asset('frontend/img/ale.jpg') }}" class="img-fluid rounded shadow mb-3" style="max-height: 400px;">
            <h4>Hiện đang cập nhật các chương trình khuyến mãi mới nhất!</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection
