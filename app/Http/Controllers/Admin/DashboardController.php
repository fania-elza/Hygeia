<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User; // customer
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama

        $totalRevenue = Order::sum('total_amount'); // total pendapatan
        $pendingOrders = Order::where('status', 'Pending')->count(); // pending
        $processedOrders = Order::where('status', 'Diproses')->count(); // diproses
        $newRegistrations = User::where('created_at', '>=', now()->subDays(30))->count(); // registrasi 30 hari terakhir
        $lowStockAlerts = Product::where('stock', '<=', 10)->count(); // stok <= 10

        // Status produk
        $products = Product::all();
        $activeProducts = $products->where('status', true)->count();
        $inactiveProducts = $products->where('status', false)->count();
        $activePercent = $products->count() > 0
            ? round(($activeProducts / $products->count()) * 100)
            : 0;

        // Revenue per hari (30 hari terakhir)
        $revenuePerDay = collect();
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $dailyRevenue = Order::where('status', 'Completed')
                ->whereDate('created_at', $date)
                ->sum('total_amount');

            $revenuePerDay->push([
                'date' => $date,
                'revenue' => $dailyRevenue
            ]);
        }

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalRevenue',
            'pendingOrders',
            'processedOrders',
            'newRegistrations',
            'lowStockAlerts',
            'products',
            'activeProducts',
            'inactiveProducts',
            'activePercent',
            'revenuePerDay'
        ));
    }
}
