@extends('layouts.master')
@section('title', 'Lịch sử đơn hàng')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-uppercase"><i class="fas fa-history me-2"></i> Lịch sử đơn hàng</h2>

        @if ($orders->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th style="width: 25%;">Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        {{-- 1. Mã đơn --}}
                                        <td><span class="fw-bold text-primary">#{{ $order->id }}</span></td>

                                        {{-- 2. Ngày đặt --}}
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>

                                        {{-- 3. Tổng tiền --}}
                                        <td class="fw-bold text-danger">{{ number_format($order->total_money) }}đ</td>

                                        {{-- 4. HIỂN THỊ GHI CHÚ --}}
                                        <td>
                                            @if ($order->note)
                                                <span class="text-muted fst-italic small"><i
                                                        class="fas fa-sticky-note me-1"></i> {{ $order->note }}</span>
                                            @else
                                                <span class="text-muted small">- Không có -</span>
                                            @endif
                                        </td>

                                        {{-- 5. TRẠNG THÁI --}}
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                            @elseif($order->status == 'confirmed')
                                                <span class="badge bg-primary">Đang chuẩn bị</span>
                                            @elseif($order->status == 'shipping')
                                                <span class="badge bg-info text-dark">Đang giao</span>
                                            @elseif($order->status == 'completed')
                                                <span class="badge bg-success">Hoàn thành</span>
                                            @else
                                                <span class="badge bg-secondary">Đã hủy</span>
                                            @endif
                                        </td>

                                        {{-- 6. HÀNH ĐỘNG --}}
                                        <td>
                                            {{-- TRƯỜNG HỢP 1: Đơn mới -> Cho phép SỬA và HỦY --}}
                                            @if ($order->status == 'pending')
                                                <div class="d-flex gap-1">
                                                    
                                                    {{-- NÚT SỬA ĐƠN HÀNG (Mới thêm) --}}
                                                    <form action="{{ route('orders.edit', $order->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-warning text-dark fw-bold shadow-sm"
                                                            title="Sửa món">
                                                            <i class="fas fa-edit"></i> Sửa
                                                        </button>
                                                    </form>

                                                    {{-- NÚT HỦY ĐƠN HÀNG (Cũ) --}}
                                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-outline-danger shadow-sm"
                                                            onclick="return confirm('Bạn chắc chắn muốn hủy đơn này chứ?')"
                                                            title="Hủy đơn">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                {{-- TRƯỜNG HỢP 2: Đang giao -> Cho phép xác nhận ĐÃ NHẬN --}}
                                            @elseif($order->status == 'shipping')
                                                <form action="{{ route('orders.received', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success fw-bold shadow-sm"
                                                        onclick="return confirm('Bạn đã nhận được món chưa?')">
                                                        <i class="fas fa-check-circle"></i> Đã nhận hàng
                                                    </button>
                                                </form>

                                                {{-- TRƯỜNG HỢP 3: Đã nhận --}}
                                            @elseif($order->status == 'completed')
                                                <span class="text-success small fw-bold"><i class="fas fa-check"></i>
                                                    Đã nhận</span>

                                                {{-- TRƯỜNG HỢP 4: Đã hủy --}}
                                            @elseif($order->status == 'cancelled')
                                                <span class="text-muted small">Đã hủy</span>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            {{-- Giao diện khi chưa có đơn nào --}}
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="100" class="mb-3 opacity-50">
                <h4 class="text-muted">Bạn chưa có đơn hàng nào!</h4>
                <a href="{{ route('home') }}" class="btn btn-warning text-white fw-bold mt-3">
                    Đặt món ngay
                </a>
            </div>
        @endif
    </div>
@endsection
