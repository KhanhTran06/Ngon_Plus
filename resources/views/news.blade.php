@extends('layouts.master')
@section('title', 'Tin Tức')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-5" style="color: #1e2849; font-weight: bold;">NGON+ NEWS</h2>
        <div class="row">
            @foreach ($news_list as $news)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('frontend/img/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($news->content, 100) }}</p>
                            <a href="{{ route('news.detail', $news->id) }}" class="btn btn-primary">
                                Xem chi tiết
                            </a>
                        </div>
                        <div class="card-footer text-muted small">
                            Đăng ngày: {{ $news->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
