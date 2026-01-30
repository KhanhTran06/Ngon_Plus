<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // Lọc theo danh mục nếu có
        if ($request->has('cate')) {
            $query->where('category', $request->cate);
        }

        $products = $query->get();

        // Trả về view danh sách sản phẩm
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'like', "%$keyword%")->get();
        return view('products.index', compact('products'));
    }

    // Hàm xem chi tiết sản phẩm
    public function show($id)
    {
        // Tìm sản phẩm theo ID, nếu không thấy thì báo lỗi 404
        $product = \App\Models\Product::findOrFail($id);

        // Trả về view chi tiết
        return view('products.show', compact('product'));
    }
}
