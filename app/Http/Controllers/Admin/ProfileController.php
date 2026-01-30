<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // from đổi avatar
    public function changeAvatar()
    {
        return view('admin.profile.avatar');
    }

    // Lưu ảnh mới
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Lưu ảnh tối đa 2MB
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user(); // đã đăng nhập với vai trò admin

        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            // lưu ảnh mới vào thư mục storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');

            // Cập nhật đường dẫn vào CSDL
            $user->avatar = $path;
            $user->save();
        }

        return back()->with('success', 'Đã đổi ảnh đại diện thành công!');
    }
}
