@extends('layouts.admin')
@section('header_title', 'Thêm Nhân Viên Mới')

@section('content')
    <div class="card shadow-sm" style="max-width: 700px; margin: auto;">
        <div class="card-body p-4">
            <form action="{{ route('admin.staff.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Ví dụ: Nguyễn Văn A">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Chức vụ <span class="text-danger">*</span></label>
                        <select name="job_title" class="form-select">
                            <option value="Pha chế">Pha chế</option>
                            <option value="Thu ngân">Thu ngân</option>
                            <option value="Phục vụ">Phục vụ</option>
                            <option value="Bảo vệ">Bảo vệ</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email đăng nhập <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Địa chỉ</label>
                    <input type="text" name="address" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">Lưu thông tin</button>
                </div>
            </form>
        </div>
    </div>
@endsection
