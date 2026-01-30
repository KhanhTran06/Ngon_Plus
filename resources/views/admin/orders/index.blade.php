@extends('layouts.admin')
@section('header_title', 'Quản lý Đơn hàng')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">Danh sách Đơn hàng</h5>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                {{ $order->user->name }} <br>
                                <small class="text-muted">{{ $order->user->phone }}</small>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold text-danger">{{ number_format($order->total_money) }}đ</td>
                            <td>
                                @if ($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge bg-primary">Đã xác nhận</span>
                                @elseif($order->status == 'shipping')
                                    <span class="badge bg-info text-dark">Đang giao</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @else
                                    <span class="badge bg-secondary">Đã huỷ</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
