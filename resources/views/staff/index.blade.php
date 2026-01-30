@extends('layouts.staff')
@section('title', 'Trang nhân viên')

@section('content')
<div class="container-fluid py-4">

    {{-- THANH MENU TAB --}}
    <ul class="nav nav-tabs mb-4" id="staffTab" role="tablist">


        {{-- Tab 1: Đơn mới --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold text-danger" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab">
                <i class="fas fa-bell"></i> ĐƠN MỚI ({{ $pendingOrders->count() }})
            </button>
        </li>


        {{-- Tab 2: Đơn đã nhận --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-primary" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing" type="button" role="tab">
                <i class="fas fa-mug-hot"></i> ĐƠN ĐÃ NHẬN ({{ $myProcessingOrders->count() }})
            </button>
        </li>


        {{-- Tab 3: Lịch sử --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-success" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                <i class="fas fa-check-circle"></i> LỊCH SỬ PHA CHẾ
            </button>
        </li>
    </ul>

    {{-- NỘI DUNG CÁC TAB --}}
    <div class="tab-content" id="staffTabContent">

        <div class="tab-pane fade show active" id="new" role="tabpanel">
            <div class="row">
                @forelse($pendingOrders as $order)
                    <div class="col-md-4 mb-3">
                        <div class="card border-danger shadow-sm h-100">
                            <div class="card-header bg-danger text-white d-flex justify-content-between">
                                <span class="fw-bold">#{{ $order->id }}</span>
                                <span>{{ $order->created_at->format('H:i') }}</span>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $order->user->name }}</h6>
                                <ul class="small mb-3 ps-3">
                                    @foreach($order->items as $item)
                                        <li>{{ $item->quantity }}x {{ $item->product->name }}</li>
                                    @endforeach
                                </ul>
                                @if($order->note)
                                    <div class="alert alert-warning p-1 small mb-2">{{ $order->note }}</div>
                                @endif

                                {{-- Nút : NHẬN ĐƠN --}}
                                <form action="{{ route('staff.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="confirm">
                                    <button class="btn btn-danger w-100 fw-bold">
                                        <i class="fas fa-hand-paper"></i> NHẬN ĐƠN
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <h4>Hiện không có đơn hàng mới nào.</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="processing" role="tabpanel">
            <div class="row">
                @forelse($myProcessingOrders as $order)
                    <div class="col-md-6 mb-3">
                        <div class="card border-primary shadow h-100">
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold">Đơn #{{ $order->id }} - {{ $order->user->name }}</h5>
                                    @if($order->status == 'confirmed')
                                        <span class="badge bg-light text-primary">Đang pha chế</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Đang giao</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- Danh sách món --}}
                                <table class="table table-sm table-borderless mb-2">
                                    @foreach($order->items as $item)
                                        <tr class="border-bottom">
                                            <td class="fw-bold fs-5 text-primary">{{ $item->quantity }}x</td>
                                            <td class="fs-5">{{ $item->product->name }}</td>
                                        </tr>
                                    @endforeach
                                </table>

                                @if($order->note)
                                    <div class="alert alert-warning"><i class="fas fa-sticky-note"></i> Note: {{ $order->note }}</div>
                                @endif

                                <hr>

                                {{-- CÁC HÀNH ĐỘNG THEO TRÌNH TỰ --}}
                                <div class="d-flex gap-2">
                                    {{-- 1. In Hóa Đơn (Luôn hiện để in lúc nào cũng được) --}}
                                    <a href="{{ route('admin.orders.print', $order->id) }}" target="_blank" class="btn btn-secondary flex-grow-1">
                                        <i class="fas fa-print"></i> In Hoá Đơn
                                    </a>

                                    {{-- 2. Xong pha chế / Gửi đơn --}}
                                    @if($order->status == 'confirmed')
                                        <form action="{{ route('staff.orders.update', $order->id) }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            <input type="hidden" name="action" value="ship">
                                            <button class="btn btn-success w-100 fw-bold">
                                                <i class="fas fa-check"></i> Xong pha chế (Gửi)
                                            </button>
                                        </form>
                                    @elseif($order->status == 'shipping')
                                        <button class="btn btn-warning w-100 disabled text-dark fw-bold">
                                            <i class="fas fa-shipping-fast"></i> Đang chờ khách nhận...
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <h4>Bạn đang rảnh rỗi, hãy qua tab "Đơn mới" để nhận việc!</h4>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Thời gian xong</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myHistoryOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                    <td class="fw-bold">{{ number_format($order->total_money) }}đ</td>
                                    <td><span class="badge bg-success">Khách đã nhận</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Chưa có đơn hàng nào hoàn thành.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Phân trang --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $myHistoryOrders->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Script để tự động reload trang (Realtime đơn giản) --}}
<script>
    setTimeout(function(){
       // Chỉ reload nếu đang ở tab Đơn mới để cập nhật đơn khách vừa đặt
       if (document.querySelector('#new-tab').classList.contains('active')) {
           location.reload();
       }
    }, 15000); // 15 giây reload 1 lần
</script>
@endsection
