<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // Hiện thị các bài báo
    public function index()
    {
        $news = News::latest()->paginate(5);// chia thành  5 bài 1 trang
        return view('admin.news.index', compact('news'));
    }

    //Hiển thị form để tạo bài viết
    public function create()
    {
        return view('admin.news.create');
    }

    //Lưu bài viết
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image'
        ]);

        $filename = time() . '_' . $request->file('image')->getClientOriginalName();//thêm thời gian vào tên ảnh nếu ảnh giống nhau
        $request->file('image')->move(public_path('frontend/img'), $filename);

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $filename,
            'user_id' => Auth::id() // Người đăng bài viết(mặc định là admin)
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Đăng tin thành công!');//Quay về trang danh sách
    }
    //Xoá bài viêts
    public function destroy($id)
    {
        News::destroy($id);
        return back()->with('success', 'Đã xóa bài viết');
    }
}
