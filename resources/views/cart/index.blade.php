@extends('layouts.master')
@section('title', 'Giỏ Hàng')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #1e2849; font-weight: bold;">GIỎ HÀNG CỦA BẠN</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('cart') && count(session('cart')) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50%">Sản phẩm</th>
                                        <th style="width:15%">Giá</th>
                                        <th style="width:15%">Số lượng</th>
                                        <th style="width:20%" class="text-end">Thành tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('cart') as $id => $details)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('frontend/img/' . $details['image']) }}"
                                                        width="60" height="60" class="rounded me-3"
                                                        style="object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $details['name'] }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($details['price']) }}đ</td>
                                            <td>
                                                <input type="number" value="{{ $details['quantity'] }}"
                                                    class="form-control text-center" min="1" style="width: 60px;"
                                                    readonly>
                                            </td>
                                            <td class="text-end fw-bold text-danger">
                                                {{ number_format($details['price'] * $details['quantity']) }}đ</td>
                                            <td class="text-end">
                                                <a href="{{ route('cart.remove', $id) }}"
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Xóa món này?');">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Cộng giỏ hàng</h5>
                            <hr>

                            <form action="{{ route('cart.coupon') }}" method="POST" class="mb-3">
                                @csrf
                                <label class="form-label fw-bold">Mã giảm giá</label>
                                <div class="input-group mb-2">
                                    <input type="text" name="coupon_code" class="form-control"
                                        placeholder="Nhập mã tại đây..." required>
                                    <button class="btn btn-dark" type="submit">Áp dụng</button>
                                </div>

                                {{-- Hiện thông báo lỗi màu đỏ --}}
                                @if (session('error'))
                                    <div class="alert alert-danger py-2" style="font-size: 0.9rem;">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                                    </div>
                                @endif

                                {{-- Hiện thông báo thành công màu xanh --}}
                                @if (session('success'))
                                    <div class="alert alert-success py-2" style="font-size: 0.9rem;">
                                        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                                    </div>
                                @endif
                            </form>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>{{ number_format($total) }}đ</strong>
                            </div>


                            @if (session('discount'))
                                @php
                                    // Tính toán lại số tiền giảm ngay tại View để hiển thị
                                    $discountData = session('discount');
                                    $moneyReduce = 0;

                                    if ($discountData['type'] == 'money') {
                                        $moneyReduce = $discountData['value'];
                                    } elseif ($discountData['type'] == 'percent') {
                                        $moneyReduce = $total * ($discountData['value'] / 100);
                                    }
                                @endphp

                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>
                                        Giảm giá ({{ $discountData['code'] }})
                                        @if ($discountData['type'] == 'percent')
                                            <span class="badge bg-success ms-1">-{{ $discountData['value'] }}%</span>
                                        @endif :
                                    </span>
                                    <strong>-{{ number_format($moneyReduce) }}đ</strong>
                                </div>

                                {{-- Tính lại tổng tiền sau khi trừ để hiển thị --}}
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold fs-5">Tổng thanh toán:</span>
                                    <strong class="text-danger fs-4">
                                        {{ number_format($total - $moneyReduce > 0 ? $total - $moneyReduce : 0) }}đ
                                    </strong>
                                </div>

                                <div class="mb-3 text-end">
                                    <a href="{{ route('cart.coupon.remove') }}" class="text-danger small">Xoá mã</a>
                                </div>
                            @else
                                {{-- Nếu không có mã thì hiện tổng gốc --}}
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold fs-5">Tổng thanh toán:</span>
                                    <strong class="text-danger fs-4">{{ number_format($total) }}đ</strong>
                                </div>
                            @endif

                            <a href="{{ route('checkout') }}" class="btn btn-warning w-100 py-2 fw-bold text-white mb-2">
                                TIẾN HÀNH THANH TOÁN
                            </a>

                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-left me-1"></i> Tiếp tục mua hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="120" class="opacity-50 mb-3">
                <h4 class="text-muted">Giỏ hàng của bạn đang trống!</h4>
                <p class="text-muted">Hãy thêm vài món ngon vào đây nhé.</p>
                <a href="{{ route('home') }}" class="btn btn-warning text-white mt-3 px-4 py-2 fw-bold">Quay lại thực
                    đơn</a>
            </div>
        @endif
    </div>
@endsection
