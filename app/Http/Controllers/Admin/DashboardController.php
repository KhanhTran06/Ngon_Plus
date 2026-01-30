<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống kê tổng quan
        $totalRevenue = Order::where('status', 'completed')->sum('total_money'); // Doanh thu
        $totalOrders = Order::count(); // Tổng đơn hàng đã được đặt
        $totalProducts = Product::count(); // Tổng số món
        $totalCustomers = User::where('role', 0)->count(); // Tổng khách hàng

        // 2. Lấy 5 đơn hàng mới nhất
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        // 3. Dữ liệu biểu đồ (Doanh thu 7 ngày gần nhất)
        $revenueData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_money) as total'))
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(7))// Tìm doanh thu trong 7 ngyaf tính từ hiện tại
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $revenueData->pluck('date');
        $data = $revenueData->pluck('total');

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'labels',
            'data'
        ));
    }
}
