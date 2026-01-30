@extends('layouts.admin')
@section('header_title', 'Quản lý Mã Giảm Giá')

@section('content')
    <div class="card">
        <div class="card-header bg-white text-end">
            <a href="{{ route('admin.promotions.create') }}" class="btn btn-warning text-white"><i class="fas fa-tag"></i> Tạo
                mã mới</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Mã Code</th>
                        <th>Giảm Tiền</th>
                        <th>Giảm %</th>
                        <th>Ngày Bắt Đầu</th>
                        <th>Ngày Hết Hạn</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $p)
                        <tr>
                            <td class="fw-bold text-success">{{ $p->code }}</td>
                            <td>{{ $p->discount_amount ? number_format($p->discount_amount) . 'đ' : '-' }}</td>
                            <td>{{ $p->discount_percent ? $p->discount_percent . '%' : '-' }}</td>
                            <td>{{ date('d/m/Y', strtotime($p->start_date)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($p->end_date)) }}</td>
                            <td>
                                <form action="{{ route('admin.promotions.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Xóa mã này?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
