@extends('layouts.admin')
@section('header_title', 'Thêm Món Mới')

@section('content')
    <div class="card shadow-sm" style="max-width: 800px; margin: auto;">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên món <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="VD: Cà phê sữa">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá tiền (VNĐ)</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select name="category" class="form-select">
                                    <option value="Coffee">Cà phê</option>
                                    <option value="Tea">Trà & Thức uống</option>
                                    <option value="Snack">Bánh & Đồ ăn nhẹ</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh</label>
                            <input type="file" name="image" class="form-control" required
                                onchange="previewImage(this)">
                            <div class="mt-2 text-center border p-2 bg-light">
                                <img id="preview" src="https://via.placeholder.com/150" class="img-fluid"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                            <label class="form-check-label fw-bold">Đang kinh doanh</label>
                        </div>
                    </div>
                </div>

                <div class="text-end border-top pt-3 mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">Lưu sản phẩm</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script xem trước ảnh khi chọn
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
