<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;
use App\Models\Promotion;

class HomeController extends Controller
{
    // Trang chủ
    public function index()
    {
        // Lấy 8 sản phẩm hiển thị ra trang chủ
        $products = Product::where('is_active', true)->latest()->take(8)->get();
        return view('home', compact('products'));
    }

    // Trang Tin tức
    public function news()
    {
        $news_list = News::latest()->get();
        return view('news', compact('news_list'));
    }

    public function newsDetail($id)
    {
        $news = News::findOrFail($id);

        return view('news.detail', compact('news'));
    }

    // Trang Địa chỉ
    public function address()
    {
        return view('address');
    }

    // Trang Khuyến mãi
    public function promotions()
    {
        $promotions = Promotion::all();
        return view('promotions', compact('promotions'));
    }
}
