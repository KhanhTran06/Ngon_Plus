<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hóa đơn #{{ $order->id }}</title>
    <style>
        /* Cấu hình Font chữ hỗ trợ Tiếng Việt cho DOMPDF */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }

        /* CSS cho bảng và layout */
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; text-transform: uppercase; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        .total-section { margin-top: 20px; text-align: right; font-size: 14px; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; font-style: italic; font-size: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>CAFE CỦA TÔI</h2>
            <p>ĐC: Da Nang, VKU, Khu K</p>
            <p>Điện thoại: 01 234 567 88</p>
            <h3>HÓA ĐƠN THANH TOÁN</h3>
        </div>

        <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
        <p><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        @if($order->note)
            <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Món</th>
                    <th class="text-center">SL</th>
                    <th class="text-right">Đơn giá</th>
                    <th class="text-right">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price) }}đ</td>
                    <td class="text-right">{{ number_format($item->price * $item->quantity) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <p>TỔNG CỘNG: {{ number_format($order->total_money) }} VND</p>
        </div>

        <div class="footer">
            <p>Cảm ơn quý khách và hẹn gặp lại!</p>
            <p>(Hóa đơn được xuất tự động từ hệ thống)</p>
        </div>
    </div>

</body>
</html>
