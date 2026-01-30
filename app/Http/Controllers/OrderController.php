<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //  Hiển thị trang Thanh toán
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền gốc
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        //  TÍNH TOÁN GIẢM GIÁ
        $discountAmount = 0;
        if (session()->has('discount')) {
            $coupon = session('discount');
            if (isset($coupon['type']) && $coupon['type'] == 'money') {
                $discountAmount = $coupon['value'];
            } elseif (isset($coupon['type']) && $coupon['type'] == 'percent') {
                $discountAmount = $total * ($coupon['value'] / 100);
            }
        }

        // Tính tổng cuối cùng
        $totalPayment = $total - $discountAmount;
        if ($totalPayment < 0) $totalPayment = 0;

        return view('cart.checkout', compact('cart', 'total', 'discountAmount', 'totalPayment'));
    }

    // Xử lý Đặt hàng (Lưu vào Database)
    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        // Tính lại tổng tiền gốc
        $total_money = 0;
        foreach ($cart as $item) {
            $total_money += $item['price'] * $item['quantity'];
        }

        //  TÍNH TOÁN GIẢM GIÁ
        $discountAmount = 0;
        if (session()->has('discount')) {
            $coupon = session('discount');
            if (isset($coupon['type']) && $coupon['type'] == 'money') {
                $discountAmount = $coupon['value'];
            } elseif (isset($coupon['type']) && $coupon['type'] == 'percent') {
                $discountAmount = $total_money * ($coupon['value'] / 100);
            }
        }

        // Trừ tiền đi
        $total_money -= $discountAmount;
        if ($total_money < 0) $total_money = 0;

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_money' => $total_money,
            'status' => 'pending',
            'note' => $request->note,
            'address' => Auth::user()->address,
            'phone' => Auth::user()->phone,

            'promotion_code' => session()->has('discount') ? session('discount')['code'] : null,
        ]); 

        // Lưu chi tiết đơn hàng
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa Session
        session()->forget('cart');
        session()->forget('discount');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công! Cảm ơn bạn.');
    }

    // Xem lịch sử đơn hàng
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('orders'));
    }

    // Khách xác nhận đã nhận hàng (Hoàn thành đơn)
    public function confirmReceived($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'shipping')
            ->firstOrFail();

        $order->status = 'completed';
        $order->save();

        return back()->with('success', 'Cảm ơn bạn đã xác nhận nhận hàng!');
    }

    // Hủy đơn hàng (Chỉ khi trạng thái vẫn đang trong xử lý(status = pending))
    public function cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($order->status == 'pending') {
            $order->status = 'cancelled';
            $order->save();
            return back()->with('success', 'Đã hủy đơn hàng thành công!');
        }

        return back()->with('error', 'Đơn hàng đã được xử lý, không thể hủy!');
    }

    // 6. SỬA ĐƠN HÀNG (Hủy đơn cũ -> lặp lại giỏ hàng)
    public function editOrder($id)
    {
        // Tìm đơn hàng pending của user
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        // Xóa giỏ hàng hiện tại & mã giảm giá cũ
        session()->forget('cart');
        session()->forget('discount');

        // Tạo lại giỏ hàng từ đơn hàng cũ
        $cart = [];
        foreach ($order->items as $item) {
            if ($item->product) {
                $cart[$item->product_id] = [
                    "name" => $item->product->name,
                    "quantity" => $item->quantity,
                    "price" => $item->product->price, // Lấy giá hiện tại
                    "image" => $item->product->image
                ];
            }
        }

        // Lưu vào Session
        session()->put('cart', $cart);

        // Hủy đơn hàng cũ
        $order->status = 'cancelled';
        $order->note = $order->note . ' (Đã hủy để sửa lại)';
        $order->save();

        // Chuyển hướng về trang giỏ hàng để sửa
        return redirect()->route('cart.index')->with('success', 'Đơn cũ đã hủy. Bạn hãy cập nhật món và đặt lại nhé!');
    }
}
