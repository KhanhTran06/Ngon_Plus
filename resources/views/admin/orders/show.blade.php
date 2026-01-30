@extends('layouts.admin')
@section('header_title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3 d-flex justify-content-between">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> In hóa đơn
                </button>
            </div>

            <div class="card shadow border-0" id="print-area">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-uppercase" style="color: #6f4e37;">NGON+ COFFEE</h2>
                        <p class="text-muted">Địa chỉ: Da Nang, VKU, Khu K</p>
                        <p class="text-muted">Hotline: 0909.123.456</p>
                        <hr>
                        <h4 class="fw-bold">HÓA ĐƠN BÁN HÀNG</h4>
                        <span>Mã đơn: #{{ $order->id }}</span> <br>
                        <small>Ngày tạo: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <h6 class="fw-bold">Khách hàng:</h6>
                            <p class="mb-0">{{ $order->user->name }}</p>
                            <p class="mb-0">{{ $order->user->phone }}</p>
                            <p class="mb-0">{{ $order->user->address }}</p>
                        </div>
                        <div class="col-6 text-end">
                            <h6 class="fw-bold">Trạng thái:</h6>
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                            @elseif($order->status == 'confirmed')
                                <span class="badge bg-primary">Đã xác nhận</span>
                            @elseif($order->status == 'shipping')
                                <span class="badge bg-info text-dark">Đang giao</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Hoàn thành</span>
                            @else
                                <span class="badge bg-secondary">Đã hủy</span>
                            @endif
                        </div>

                        <div class="col-12 mt-4">
                            <div class="p-3 rounded border" style="background-color: #f8f9fa;">
                                <h6 class="fw-bold text-primary"><i class="fas fa-user-tie"></i> Nhân viên phụ trách đơn
                                    này:</h6>

                                @if ($order->staff)
                                    {{-- Nếu có nhân viên nhận đơn thì hiện tên --}}
                                    <span class="fs-5 fw-bold text-dark">{{ $order->staff->name }}</span>
                                    <span class="text-muted small ms-2">(Mã NV: {{ $order->staff_id }})</span>
                                @else
                                    {{-- Nếu chưa ai nhận --}}
                                    <span class="text-danger fst-italic"> Chưa có nhân viên nhận đơn </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tên món</th>
                                <th class="text-center">SL</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price) }}đ</td>
                                    <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="mb-1"><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                        </div>
                        <div class="col-6 text-end">
                            <h5 class="fw-bold text-danger">TỔNG CỘNG: {{ number_format($order->total_money) }}đ</h5>
                        </div>
                    </div>

                    <div class="text-center mt-5 mb-3 fst-italic text-muted">
                        <p>Cảm ơn quý khách và hẹn gặp lại!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none !important;
                border: none !important;
            }

            .btn {
                display: none;
            }
        }
    </style>
@endsection
