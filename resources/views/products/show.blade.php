@extends('layouts.master')
@section('title', $product->name)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('frontend/img/' . $product->image) }}" class="img-fluid rounded shadow-sm"
                    style="max-height: 400px; object-fit: cover;">
            </div>

            <div class="col-md-6">
                <h2 class="fw-bold text-primary">{{ $product->name }}</h2>
                <p class="text-muted">Danh mục: {{ $product->category->name ?? 'Đồ uống' }}</p>

                <h3 class="text-danger fw-bold mb-4">{{ number_format($product->price) }}đ</h3>

                <p class="lead">{{ $product->description }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <label class="me-3 fw-bold">Số lượng:</label>
                        <input type="number" name="quantity" value="1" min="1" class="form-control text-center"
                            style="width: 80px;">
                    </div>

                    <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2">
                        <i class="fas fa-cart-plus me-2"></i> THÊM VÀO GIỎ
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
