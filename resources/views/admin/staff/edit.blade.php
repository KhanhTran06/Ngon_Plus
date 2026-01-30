@extends('layouts.admin')
@section('header_title', 'Cập nhật Nhân Viên')

@section('content')
    <div class="card shadow-sm" style="max-width: 700px; margin: auto;">
        <div class="card-body p-4">
            <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Họ và tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Chức vụ</label>
                        <select name="job_title" class="form-select">
                            <option value="Pha chế" {{ $staff->job_title == 'Pha chế' ? 'selected' : '' }}>Pha chế</option>
                            <option value="Thu ngân" {{ $staff->job_title == 'Thu ngân' ? 'selected' : '' }}>Thu ngân
                            </option>
                            <option value="Phục vụ" {{ $staff->job_title == 'Phục vụ' ? 'selected' : '' }}>Phục vụ</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu mới (Để trống nếu không đổi)</label>
                    <input type="password" name="password" class="form-control" placeholder="******">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ $staff->address }}">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-warning text-white px-4">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
