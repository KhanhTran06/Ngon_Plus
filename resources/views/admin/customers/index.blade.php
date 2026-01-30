@extends('layouts.admin')
@section('header_title', 'Quản lý Khách hàng')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Đã mua (đơn)</th>
                        <th>Ngày tham gia</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>
                                <img src="{{ $c->avatar ? asset('storage/' . $c->avatar) : asset('frontend/img/default-user.png') }}"
                                    width="30" class="rounded-circle me-1">
                                {{ $c->name }}
                            </td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->phone }}</td>
                            <td class="text-center"><span class="badge bg-primary rounded-pill">{{ $c->orders_count }}</span>
                            </td>
                            <td>{{ $c->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.customers.destroy', $c->id) }}" method="POST"
                                    onsubmit="return confirm('CẢNH BÁO: Xóa khách hàng sẽ xóa toàn bộ đơn hàng của họ. Tiếp tục?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $customers->links() }}
        </div>
    </div>
@endsection
