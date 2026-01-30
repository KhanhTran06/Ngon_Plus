<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StaffOrderController extends Controller
{
    public function index()
    {
        // 1. DANH SÁCH ĐƠN MỚI (Status = pending)
        $pendingOrders = Order::where('status', 'pending')
            ->orderBy('created_at', 'asc')// xếp theo đơn được toạ trước lên trên
            ->get();

        // 2. ĐƠN ĐÃ NHẬN & ĐANG LÀM (Status = confirmed hoặc shipping)
        $myProcessingOrders = Order::where('staff_id', Auth::id())
            ->whereIn('status', ['confirmed', 'shipping'])
            ->orderBy('updated_at', 'asc')// xếp theo đơn theo thời gian cập nhật cũ lên trước
            ->get();

        // 3. LỊCH SỬ ĐÃ HOÀN THÀNH (Status = completed)
        $myHistoryOrders = Order::where('staff_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')// xếp theo đơn theo thời gian cập nhật cũ lên trước
            ->paginate(10);

        // Truyền cả 3 sang View
        return view('staff.index', compact('pendingOrders', 'myProcessingOrders', 'myHistoryOrders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $action = $request->action;

        // Xử lý: NHẬN ĐƠN
        if ($action == 'confirm') {
            if ($order->status != 'pending') {
                return back()->with('error', 'Đơn này đã có người khác nhận rồi!');
            }
            $order->status = 'confirmed';
            $order->staff_id = Auth::id(); // Đánh dấu người nhận đơn
            $order->save();
            return back()->with('success', 'Đã nhận đơn! Chuyển sang tab "Đơn đã nhận" để xử lý.');
        }

        // Xử lý: GỬI ĐƠN (Xong phần pha chế)
        if ($action == 'ship') {
            if ($order->staff_id != Auth::id()) {
                return back()->with('error', 'Bạn không có quyền sửa đơn này.');
            }
            $order->status = 'shipping';
            $order->save();
            return back()->with('success', 'Đã cập nhật trạng thái: Đang giao hàng!');
        }

        return back();
    }

    //  Lịch sử đơn hoàn thành
    public function history()
    {
        $orders = Order::where('status', 'completed')->orderBy('updated_at', 'desc')->paginate(10);
        return view('staff.orders.history', compact('orders'));
    }
}
