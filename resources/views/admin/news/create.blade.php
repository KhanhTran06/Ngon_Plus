@extends('layouts.admin')
@section('header_title', 'Đăng Tin Tức Mới')

@section('content')
    <div class="card" style="max-width: 800px; margin: auto;">
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Tiêu đề bài viết</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Hình ảnh minh họa</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nội dung chi tiết</label>
                    <textarea name="content" class="form-control" rows="6" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Đăng bài</button>
            </form>
        </div>
    </div>
@endsection
