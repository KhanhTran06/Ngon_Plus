<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // hiển thị danh sách
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Tìm kiếm theo tên & chia 10 món trên/trang
        $products = Product::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // Form thêm mới
    public function create()
    {
        return view('admin.products.create');
    }

    // lưu món mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'required|image|max:2048', // bắt buộc có tên,giá,loại, ảnh băng required
        ]);

        $data = $request->all();

        // Xử lý upload ảnh vào trong public/frontend/img
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/img'), $filename);// dichuyen anh vao public/frontend/img
            $data['image'] = $filename;
        }

        Product::create($data);// Lưu dữ liệu vào db

        return redirect()->route('admin.products.index')->with('success', 'Thêm món mới thành công!');
    }

    //  From chỉnh sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // xử lý cập nhật
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $data = $request->all();

        // Nếu có chọn ảnh mới thì thay thế,không thì giữ nguyên
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/img'), $filename);
            $data['image'] = $filename;
        } else {
            unset($data['image']); // Loại bỏ trường image khỏi mảng data để không bị ghi đè thành null
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa món
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Đã xóa món ăn!');
    }
}
