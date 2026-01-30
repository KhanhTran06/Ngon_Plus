@extends('layouts.admin')

@section('header_title', 'Quản lý Thực Đơn')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col-6">
                    <h5 class="m-0 fw-bold text-primary">Danh sách món ăn</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Thêm món
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên món</th>
                        <th>Giá</th>
                        <th>Danh mục</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td><img src="{{ asset('frontend/img/' . $p->image) }}" width="50"></td>
                            <td>{{ $p->name }}</td>
                            <td>{{ number_format($p->price) }}đ</td>
                            <td>{{ $p->category }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Xóa?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
