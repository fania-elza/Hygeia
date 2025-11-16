<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerProfileController extends Controller
{
    /**
     * Halaman profil pelanggan.
     */
    public function index()
    {
        $user = Auth::user();

        return view('customer.profile.index', compact('user'));
    }

    /**
     * Update data profil pelanggan.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:20',
            'dob'            => 'nullable|date',
            'gender'         => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Halaman daftar pesanan pelanggan.
     */
    public function orders()
    {
        $user = auth()->user();

        // Query pesanan milik user
        $orders = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('customer.profile.orders', compact('user', 'orders'));
    }

    /**
     * Halaman detail dari satu pesanan.
     */
    public function orderDetail(Order $order)
    {
        // Cegah user lain melihat pesanan orang lain
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Pastikan relasi dimuat
        $order->load('orderItems.product');

        return view('customer.profile.order-detail', compact('order'));
    }
}
