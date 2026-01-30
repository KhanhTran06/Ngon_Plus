@extends('layouts.master')
@section('title', 'Thanh Toán')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4 text-uppercase" style="color: #1e2849; font-weight: bold;">Xác nhận đơn hàng</h2>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 fw-bold text-primary"><i class="fas fa-map-marker-alt me-2"></i> Thông tin giao
                                hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Người nhận</label>
                                <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" class="form-control bg-light" value="{{ Auth::user()->phone }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control bg-light" value="{{ Auth::user()->address }}"
                                    readonly>
                                <small class="text-muted fst-italic">*Muốn đổi địa chỉ, vui lòng cập nhật trong trang cá
                                    nhân.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ghi chú cho quán (Tuỳ chọn)</label>
                                <textarea name="note" class="form-control" rows="3" placeholder="Ví dụ: Ít đường, nhiều đá..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-header bg-white py-3">
                            <h5 class="m-0 fw-bold text-primary"><i class="fas fa-receipt me-2"></i> Đơn hàng của bạn</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3" style="max-height: 300px; overflow-y: auto;">
                                @foreach ($cart as $item)
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                                        <span>
                                            <span class="badge bg-secondary me-2">{{ $item['quantity'] }}x</span>
                                            {{ $item['name'] }}
                                        </span>
                                        <span>{{ number_format($item['price'] * $item['quantity']) }}đ</span>
                                    </li>
                                @endforeach
                            </ul>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Mã khuyến mãi</label>
                                <form action="{{ route('cart.coupon') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="coupon_code" class="form-control"
                                            placeholder="Nhập mã giảm giá" >
                                        <button class="btn btn-dark" type="submit">Áp dụng</button>
                                    </div>
                                </form>

                                {{-- Hiển thị thông báo lỗi hoặc thành công của mã --}}
                                @if (session('error'))
                                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i>
                                        {{ session('error') }}</div>
                                @endif
                                @if (session('success'))
                                    <div class="text-success small mt-1"><i class="fas fa-check-circle"></i>
                                        {{ session('success') }}</div>
                                @endif
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>{{ number_format($total) }}đ</strong>
                            </div>

                            {{-- Chỉ hiện dòng này nếu có mã giảm giá --}}
                            @if (isset($discountAmount) && $discountAmount > 0)
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>
                                        Giảm giá
                                        @if (session('discount'))
                                            ({{ session('discount')['code'] }})
                                        @endif:
                                    </span>
                                    <strong>-{{ number_format($discountAmount) }}đ</strong>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('cart.coupon.remove') }}"
                                        class="text-danger small text-decoration-none" style="font-size: 0.85rem;">[Gỡ bỏ
                                        mã]</a>
                                </div>
                            @endif

                            <hr>

                            <div class="d-flex justify-content-between mb-4 align-items-center">
                                <span class="fs-5 fw-bold">Tổng thanh toán:</span>
                                <span class="fs-3 fw-bold text-danger">
                                    {{ number_format($totalPayment) }}đ
                                </span>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 py-3 fw-bold text-white fs-5 shadow-sm"
                                style="background-color: #e2aa4a; border: none;">
                                ĐẶT HÀNG NGAY
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
