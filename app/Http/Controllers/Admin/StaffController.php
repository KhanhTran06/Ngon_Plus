<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    // Danh sách nhân viên
    public function index()
    {
        // Lấy user có role = 1 là Nhân viên
        $staffs = User::where('role', 1)->latest()->paginate(10);
        return view('admin.staff.index', compact('staffs'));
    }

    // Form thêm mới nhân viên
    public function create()
    {
        return view('admin.staff.create');
    }

    // Lưu nhân viên mới
    public function store(Request $request)
    {
        // Validate dư liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required',
            'job_title' => 'required'
        ]);

        //Thêm nhân viên mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,

            // lưu mật khẩu dưới dạng mã hoá(đề xuất của chatgpt để làm bảo mật đơn giản)
            'password' => Hash::make($request->password),

            'phone' => $request->phone,
            'address' => $request->address,
            'job_title' => $request->job_title,
            'role' => 1 // Role 1 là Nhân viên
        ]);
        // chuyển qua danh sách nhân viên
        return redirect()->route('admin.staff.index')->with('success', 'Thêm nhân viên thành công!');
    }

    // Form sửa thông tin nhân viên
    public function edit($id)
    {
        // Tìm nv theo id, không thấy thì báo lỗi
        $staff = User::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    // Cập nhật nhân viên
    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'name' => 'required',

            // Kiểm tra nếu trùng email trong bảng user ở dòng của id hiện tại
            // thì bỏ qua khi nhân nv vẫn dùng email cũ
            'email' => 'required|email|unique:users,email,' . $id,

            'phone' => 'required',
            'job_title' => 'required'
        ]);

        //tạo 1 array dữ liệu cần update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'job_title' => $request->job_title,
        ];

        // Nếu có nhập mật khẩu mới thì mới cập nhật, không thì giữ nguyên
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);//nếu đổi mk mới thì mã hoá mk mới rồi cập nhật
        }
        // Tiến hành update dữ liệu của nv
        $staff->update($data);

        //Trả về danh sáchh nhân viên kèm thông báo
        return redirect()->route('admin.staff.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // Xóa nhân viên
    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();//xoá khỏi database
        return back()->with('success', 'Đã xóa nhân viên!');
    }
}
