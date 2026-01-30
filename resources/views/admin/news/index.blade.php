@extends('layouts.admin')
@section('header_title', 'Quản lý Tin tức')

@section('content')
    <div class="card">
        <div class="card-header bg-white text-end">
            <a href="{{ route('admin.news.create') }}" class="btn btn-success"><i class="fas fa-pen"></i> Viết bài mới</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung tóm tắt</th>
                        <th>Ngày đăng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $n)
                        <tr>
                            <td><img src="{{ asset('frontend/img/' . $n->image) }}" width="80"></td>
                            <td class="fw-bold">{{ $n->title }}</td>
                            <td>{{ Str::limit($n->content, 80) }}</td>
                            <td>{{ $n->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.news.destroy', $n->id) }}" method="POST"
                                    onsubmit="return confirm('Xóa tin này?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $news->links() }}
        </div>
    </div>
@endsection
