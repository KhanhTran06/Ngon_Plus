@extends('layouts.admin')
@section('header_title', 'Chỉnh Sửa Món Ăn')

@section('content')
    <div class="card shadow-sm" style="max-width: 800px; margin: auto;">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên món</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá tiền</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select name="category" class="form-select">
                                    <option value="Coffee" {{ $product->category == 'Coffee' ? 'selected' : '' }}>Cà phê
                                    </option>
                                    <option value="Tea" {{ $product->category == 'Tea' ? 'selected' : '' }}>Trà</option>
                                    <option value="Snack" {{ $product->category == 'Snack' ? 'selected' : '' }}>Snack
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thay ảnh mới (Nếu cần)</label>
                            <input type="file" name="image" class="form-control" onchange="previewImage(this)">
                            <div class="mt-2 text-center border p-2 bg-light">
                                <img id="preview" src="{{ asset('frontend/img/' . $product->image) }}" class="img-fluid"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                        <div class="form-check form-switch mt-4">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold">Có sẵn nguyên liệu</label>
                        </div>
                    </div>
                </div>

                <div class="text-end border-top pt-3 mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-warning text-white px-4">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
