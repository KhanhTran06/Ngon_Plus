<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    //Hiển thị danh sách khuyến mãi bằng cách lấy các mã mới nhất đưa ra view
    public function index()
    {
        $promotions = Promotion::latest()->get(); //sắp cái mới lên đầu
        return view('admin.promotions.index', compact('promotions')); //trả về view admin.promotions.index kèm biến promotions
    }
    // Hiển thị form tạo chương trình giảm giá mới
    public function create()
    {
        return view('admin.promotions.create');
    }

    // Lưu mã vào database
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promotions', //bắt buộc nhập mgg,không được trùng trong table promotions
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'//ngày kết thúc phải lớn hơn ngày bắt đầu
        ]);
        // sau khi nhập thì lưu vào cơ sở dữ liệu
        Promotion::create($request->all());//$request->all() lấy toàn bộ data từ form

        //quay về trang khuyến mãi kèm theo thông báo
        return redirect()->route('admin.promotions.index')->with('success', 'Tạo mã giảm giá thành công');
    }

    // Xoá mã khuyến mãi
    public function destroy($id)
    {
        // Xoá mã theo ID
        Promotion::destroy($id);

        //Load lại trang hiện tại
        return back()->with('success', 'Đã xóa mã khuyến mãi');
    }
}
