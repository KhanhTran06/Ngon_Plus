<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập/đnăg ký
    public function showLogin()
    {
        return view('auth.login_register');
    }

    // Xử lý Đăng ký tài khoản mới (Dành cho khách hàng)
    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', // Email phải duy nhất trong table user
            'password' => 'required|min:6', // MK có ít nhất 6 ký tự
            'phone' => 'required'
        ]);

        // lưu user mới vào CSDL
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,

            // Mã hoá mk khi lưu vào csdl
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 0 // Mặc định là Khách hàng
        ]);

        Auth::login($user); // đăng nhập luôn sau khi đăng ký xong
        return redirect()->route('home'); // Đưa qua trang chủ
    }

    // Xử lý Đăng nhập & Điều hướng phân quyền
    public function login(Request $request)
    {
        // Lấy thông tin email và password từ form
        $credentials = $request->only('email', 'password');

        // Auth::attempt tự động kiểm tra user có email này,password nhập vào với password đã mã hóa trong csdl
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // nếu như đúng thì lấy thông tin người dùng

            // nếu là admin thi qua giao diện quản trị
            if ($user->role == 2) return redirect()->route('admin.dashboard');

            // nếu là nhân viên thì qua giao diện của nhân viên
            if ($user->role == 1) return redirect()->route('staff.orders.index');

            // Còn Khách hàng thì qua trang chủ của web
            return redirect()->route('home');
        }

        // email/password sai, quay lại báo lỗi
        return back()->with('error', 'Sai thông tin đăng nhập!');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // xoá phiên đăng nhập

        if ($request->hasSession()) {
            $request->session()->invalidate();      // Hủy session
            $request->session()->regenerateToken(); // Tạo CSRF token mới
        }

        return redirect()->route('home'); // Quay về trang chủ
    }
}
