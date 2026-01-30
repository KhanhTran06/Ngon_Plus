@extends('layouts.admin')
@section('header_title', 'Quản lý Nhân sự')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="m-0 text-primary fw-bold">Danh sách Nhân viên</h5>
            <a href="{{ route('admin.staff.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm nhân viên</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Chức vụ</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td class="fw-bold">{{ $s->name }}</td>
                            <td><span class="badge bg-info text-dark">{{ $s->job_title }}</span></td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->phone }}</td>
                            <td>
                                <a href="{{ route('admin.staff.edit', $s->id) }}"
                                    class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.staff.destroy', $s->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa nhân viên này?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $staffs->links() }}
        </div>
    </div>
@endsection
