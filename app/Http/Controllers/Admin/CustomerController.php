<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        // Role = 0 là Khách
        $customers = User::where('role', 0)->withCount('orders')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'Đã xóa khách hàng và toàn bộ lịch sử mua hàng.');
    }
}
