<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Hiển thị các đơn hàng hiện tại
    public function index()
    {

        $orders = Order::where('status', '!=', 'completed')// Không hiện thị đơn đã hoàn thành
            ->where('status', '!=', 'cancelled')// không hiển thị đơn đã huỷ
            ->orderBy('created_at', 'asc')// Cái này để đưa đơn cũ lên đầu
            ->get();

        return view('staff.orders', compact('orders'));
    }

    // 2. Hàm cập nhật trạng thái đơn (Quy trình: Chờ xử lý -> Đã xác nhận -> Đang giao -> Hoàn thành)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        // Kiểm tra trạng thái đơn hàng hiện tại để chuyển sang trạng thái tiếp theo
        if ($order->status == 'pending') {// khách mới đặt thì đơn đang trong quá trình xử lý
            $order->update(['status' => 'confirmed']);// Đã xác nhận đơn hàng(nhân viên chuẩn bị đơn hàng)

        } elseif ($order->status == 'confirmed') {
            // chuẩn bị xong nhân viên nhấn chuyển trạng thái thành đang giao
            $order->update(['status' => 'shipping']);

        } elseif ($order->status == 'shipping') {
            $order->update(['status' => 'completed']);// Khách đã nhận đơn
        }
        //load lại trang kèm thông báo
        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng!');
    }
}
