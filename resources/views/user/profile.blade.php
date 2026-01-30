@extends('layouts.master')
@section('title', 'Thông Tin Cá Nhân')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0 text-primary fw-bold text-center">HỒ SƠ CÁ NHÂN</h4>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ url('/ca-nhan') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img id="avatar-preview"
                                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('frontend/img/default-user.png') }}"
                                        class="rounded-circle border border-3 border-light shadow-sm" width="120"
                                        height="120" style="object-fit: cover;">

                                    <label for="avatar"
                                        class="position-absolute bottom-0 end-0 bg-white p-1 rounded-circle shadow border pointer"
                                        style="cursor: pointer; width: 35px; height: 35px; line-height: 25px;">
                                        <i class="fas fa-camera text-primary"></i>
                                    </label>

                                    @if ($user->avatar)
                                        <a href="{{ route('avatar.remove') }}"
                                            class="position-absolute top-0 end-0 bg-danger text-white p-1 rounded-circle shadow border border-white"
                                            style="cursor: pointer; width: 30px; height: 30px; line-height: 20px; text-decoration: none;"
                                            onclick="return confirm('Bạn có chắc muốn gỡ ảnh đại diện này không?')"
                                            title="Gỡ ảnh">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>

                                <input type="file" id="avatar" name="avatar" class="d-none"
                                    onchange="previewImage(this)">
                                <p class="text-muted mt-2 small">Chạm vào icon máy ảnh để đổi avatar</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Họ và tên</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email (Không thể đổi)</label>
                                <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary fw-bold py-2">LƯU THAY ĐỔI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            // Kiểm tra xem người dùng có chọn file chưa
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }

                // Đọc file ảnh dưới dạng URL
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
