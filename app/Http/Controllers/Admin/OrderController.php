<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;// thư viện để xuất file PDF

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        // Lấy danh sách đơn hàng mới nhất, phân trang 10 đơn/trang
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // xem chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // Cập nhật trạng thái đơn (Xác nhận -> Giao hàng -> Hoàn thành)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $statusMap = [
            'pending' => 'confirmed',   // Chờ xử lý -> Đã xác nhận
            'confirmed' => 'shipping',  // Đã xác nhận -> Đang giao
            'shipping' => 'completed'   // Đang giao -> Hoàn thành
        ];

        // chuyển trạng thái đơn nếu nhấn nút
        if (isset($statusMap[$order->status])) {
            $order->update(['status' => $statusMap[$order->status]]);
        }

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng!');
    }

    // Xuất hóa đơn PDF
    public function printOrder($id)
    {
        // lấy thông tin đơn hàng
        $order = Order::with('items.product', 'user')->findOrFail($id);

        // Load View và chuyển dữ liệu vào
        $pdf = Pdf::loadView('admin.orders.print', compact('order'));

        // tải file về máy với tên file là: Hoa-don-ID.pdf
        return $pdf->download('Hoa-don-' . $order->id . '.pdf');
    }
}
