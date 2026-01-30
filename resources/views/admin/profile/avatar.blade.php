@extends('layouts.admin')
@section('header_title', 'Đổi Ảnh Đại Diện')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 fw-bold text-primary">Cập nhật Avatar</h5>
                </div>
                <div class="card-body text-center p-4">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="mb-4">
                        <img id="preview-avatar"
                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://cdn-icons-png.flaticon.com/512/2206/2206368.png' }}"
                            class="rounded-circle shadow"
                            style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ceab8c;">
                        <p class="text-muted mt-2">Ảnh hiện tại</p>
                    </div>

                    <form action="{{ route('admin.avatar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 text-start">
                            <label class="form-label fw-bold">Chọn ảnh mới</label>
                            <input type="file" name="avatar" class="form-control" required
                                onchange="previewImage(this)">
                            <div class="form-text">Chỉ chấp nhận file ảnh (jpg, png) tối đa 2MB.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning text-white fw-bold">
                                <i class="fas fa-upload"></i> LƯU THAY ĐỔI
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script xem trước ảnh khi chọn
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-avatar').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
