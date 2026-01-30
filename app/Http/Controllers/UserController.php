<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display user profile
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        // Lấy user đang đăng nhập
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
        ]);

        // Chuẩn bị dữ liệu để update
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Xử lý avatar nếu chọn ảnh mới
        if ($request->hasFile('avatar')) {

            // Xóa ảnh cũ nếu không phải ảnh mặc định
            $path = $request->file('avatar')->store('avatars', 'public');

            $data['avatar'] = $path;
        }

        //Thực hiện Update
        $user->update($data);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }

    //Gỡ avatar
    public function removeAvatar()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Kiểm tra nếu user đang có avatar (khác null)
        if ($user->avatar) {
            // Xóa file ảnh thật trong thư mục storage (để tiết kiệm dung lượng)
            if (Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Set dữ liệu trong database về null
            $user->avatar = null;
            $user->save();
        }

        return back()->with('success', 'Đã gỡ ảnh đại diện, quay về mặc định!');
    }

}
