<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $code = $request->coupon_code;

        // 1. Tìm mã trong DB
        $coupon = \App\Models\Promotion::where('code', $code)->first();

        // 2. Kiểm tra tồn tại và ngày tháng
        if (!$coupon) {
            return back()->with('error', 'Mã giảm giá không tồn tại!');
        }
        $today = now();
        if ($coupon->start_date && $today < $coupon->start_date) {
            return back()->with('error', 'Mã chưa đến ngày áp dụng!');
        }
        if ($coupon->end_date && $today > $coupon->end_date) {
            return back()->with('error', 'Mã đã hết hạn!');
        }

        // 3. XÁC ĐỊNH LOẠI GIẢM GIÁ (Đoạn này quan trọng nhất)
        $sessionData = [
            'code' => $coupon->code,
        ];

        // Ưu tiên check giảm tiền mặt trước
        if ($coupon->discount_amount > 0) {
            $sessionData['type'] = 'money'; // Đánh dấu là giảm tiền
            $sessionData['value'] = $coupon->discount_amount;
        }
        // Nếu không thì check giảm phần trăm
        elseif ($coupon->discount_percent > 0) {
            $sessionData['type'] = 'percent'; // Đánh dấu là giảm %
            $sessionData['value'] = $coupon->discount_percent; // Ví dụ: 10 (tức là 10%)
        } else {
            return back()->with('error', 'Mã này không có giá trị giảm!');
        }

        // 4. Lưu vào Session
        session()->put('discount', $sessionData);

        return back()->with('success', 'Áp dụng mã thành công!');
    }

    // 3. Thêm hàm Xóa mã
    public function removeCoupon()
    {
        session()->forget('discount');
        return back()->with('success', 'Đã gỡ bỏ mã giảm giá.');
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $qty = $request->quantity ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $qty,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back();
    }
}
