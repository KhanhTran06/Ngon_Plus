@extends('layouts.master')
@section('title', 'Thực Đơn')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-uppercase" style="color: #634832; font-weight: bold;">
        {{ request('cate') ? 'DANH MỤC: ' . request('cate') : 'TẤT CẢ SẢN PHẨM' }}
    </h2>

    <div class="row g-4">
        @forelse($products as $sp)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm border-0">
                <a href="{{ route('products.show', $sp->id) }}" class="text-decoration-none">
                    <img src="{{ asset('frontend/img/' . $sp->image) }}" class="card-img-top p-3 rounded-circle" style="object-fit: cover; height: 200px;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark fw-bold">{{ $sp->name }}</h5>
                        <p class="card-text text-danger fw-bold">{{ number_format($sp->price) }} VNĐ</p>
                    </div>
                </a>
                <div class="card-footer bg-white border-0 text-center mb-3">
                    <form action="{{ route('cart.add', $sp->id) }}" method="POST">
                        @csrf <button class="btn btn-warning text-white rounded-pill px-4">Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center">Không tìm thấy sản phẩm nào.</p>
        @endforelse
    </div>
</div>
@endsection
