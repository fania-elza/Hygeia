<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan halaman manajemen pesanan beserta data statistik dan filter.
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->when($request->search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        // Tambahkan atribut JSON untuk setiap order agar Blade aman
        $orders->getCollection()->transform(function ($order) {
            $order->json_data = [
                'id' => $order->id,
                'created_at' => $order->created_at->toISOString(),
                'payment_method' => $order->payment_method,
                'status' => $order->status,
                'total_amount' => $order->total_amount,
                'user' => [
                    'name' => $order->user->username ?? null,
                    'email' => $order->user->email ?? null,
                    'address' => $order->full_address ?? null,
                ],
                'order_items' => $order->orderItems->map(function ($item) {
                    return [
                        'product' => ['name' => $item->product->name ?? null],
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ];
                })->values()->toArray(),
            ];
            return $order;
        });

        // Statistik berdasarkan enum
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        // Total revenue dihitung dari total_amount untuk order completed
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        return view('admin.orders.index', [
            'orders'            => $orders,
            'totalOrders'       => $totalOrders,
            'completedOrders'   => $completedOrders,
            'pendingOrders'     => $pendingOrders,
            'processingOrders'  => $processingOrders,
            'cancelledOrders'   => $cancelledOrders,
            'totalRevenue'      => $totalRevenue,
        ]);
    }

    /**
     * Update status pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,cancel',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', "Status pesanan (ID: {$order->id}) berhasil diperbarui.");
    }

    /**
     * Hapus pesanan.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', "Pesanan (ID: {$order->id}) berhasil dihapus.");
    }
}
