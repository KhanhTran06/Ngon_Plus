@extends('layouts.admin')

@section('header_title', 'Tổng quan hệ thống')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(45deg, #1e2849, #2c3e50);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1" style="color: #ceab8c;">Doanh thu</h6>
                            <h3 class="fw-bold">{{ number_format($totalRevenue) }}đ</h3>
                        </div>
                        <i class="fas fa-coins fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white border-start border-4 border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Đơn hàng</h6>
                            <h3 class="fw-bold text-dark">{{ $totalOrders }}</h3>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white border-start border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Sản phẩm</h6>
                            <h3 class="fw-bold text-dark">{{ $totalProducts }}</h3>
                        </div>
                        <i class="fas fa-coffee fa-2x text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-white border-start border-4 border-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Khách hàng</h6>
                            <h3 class="fw-bold text-dark">{{ $totalCustomers }}</h3>
                        </div>
                        <i class="fas fa-users fa-2x text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fas fa-chart-area me-2"></i>Biểu đồ doanh thu (7 ngày
                        qua)</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-primary"><i class="fas fa-bell me-2"></i>Đơn hàng mới nhất</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentOrders as $order)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">#{{ $order->id }} - {{ $order->user->name }}</div>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </div>
                                <span
                                    class="badge {{ $order->status == 'pending' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $order->status == 'pending' ? 'Chờ xử lý' : $order->status }}
                                </span>
                            </div>
                        @empty
                            <div class="p-3 text-center text-muted">Chưa có đơn hàng nào.</div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white text-center">
                    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none small fw-bold">
                        Xem tất cả đơn hàng <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!}, // Lấy ngày từ Controller
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: {!! json_encode($data) !!}, // Lấy tiền từ Controller
                    backgroundColor: 'rgba(206, 171, 140, 0.2)',
                    borderColor: '#1e2849',
                    borderWidth: 2,
                    tension: 0.3, // Bo cong đường biểu đồ
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
