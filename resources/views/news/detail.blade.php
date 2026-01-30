@extends('layouts.master')
@section('title', $news->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{ route('news') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Quay lại tin tức
            </a>

            <div class="card shadow-sm border-0">
                <img src="{{ asset('frontend/img/' . $news->image) }}" class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $news->title }}">

                <div class="card-body p-4">
                    <h1 class="fw-bold text-primary mb-3">{{ $news->title }}</h1>

                    <div class="text-muted fst-italic mb-4">
                        <i class="far fa-clock me-1"></i> Đăng ngày: {{ $news->created_at->format('d/m/Y') }}
                        <span class="mx-2">|</span>
                        <i class="fas fa-user me-1"></i> Tác giả: Chủ quán
                    </div>

                    <hr>

                    <div class="content mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                        {{-- Hiển thị nội dung có xuống dòng --}}
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
