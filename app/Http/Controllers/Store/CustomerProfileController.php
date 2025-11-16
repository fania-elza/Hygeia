<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Address;

class CustomerProfileController extends Controller
{
    /**
     * Halaman profil pelanggan beserta alamat.
     */
    public function index()
    {
        $user = Auth::user();
        // Statistik pesanan
        $totalOrders = $user->orders()->count();
        $completedOrders = $user->orders()->where('status', 'Selesai')->count();
        $processingOrders = $user->orders()->where('status', 'Diproses')->count();

        return view('customer.profile.index', compact(
            'user',
            'totalOrders',
            'completedOrders',
            'processingOrders'
        ));
        return view('customer.profile.index', compact('user'));
    }

    /**
     * Update data profil pelanggan.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username'       => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:20',
            'dob'            => 'nullable|date',
            'gender'         => 'nullable|in:male,female',
        ]);

        $user->update($validated);

        return redirect()->route('store.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Halaman daftar pesanan pelanggan.
     */
    public function orders()
    {
        $user = Auth::user();

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
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        $order->load('orderItems.product');

        return view('customer.profile.order-detail', compact('order'));
    }

    /**
     * Tampilkan semua alamat pelanggan.
     */
    public function showAddresses()
    {
        $user = Auth::user();
        $addresses = Address::where('customer_id', $user->id)->get();

        return view('customer.profile.address', compact('user', 'addresses'));
    }

    /**
     * Tambah alamat baru.
     */
    public function storeAddress(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'full_address'  => 'required|string',
            'city'          => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'notes'         => 'nullable|string',
        ]);

        Address::create([
            'customer_id'   => $user->id,
            'receiver_name' => $validated['receiver_name'],
            'phone_number'  => $validated['phone_number'],
            'full_address'  => $validated['full_address'],
            'city'          => $validated['city'],
            'postal_code'   => $validated['postal_code'],
            'notes'         => $validated['notes'] ?? null,
        ]);

        return redirect()->route('store.profile.address')
            ->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Update alamat.
     */
    public function updateAddress(Request $request, Address $address)
    {
        if ($address->customer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke alamat ini.');
        }

        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone_number'  => 'required|string|max:20',
            'full_address'  => 'required|string',
            'city'          => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'notes'         => 'nullable|string',
        ]);

        $address->update($validated);

        return redirect()->route('store.profile.address')
            ->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Hapus alamat.
     */
    public function deleteAddress(Address $address)
    {
        if ($address->customer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke alamat ini.');
        }

        $address->delete();

        return redirect()->route('store.profile.address')
            ->with('success', 'Alamat berhasil dihapus!');
    }

    public function createAddress()
    {
        $user = auth()->user();
        return view('customer.profile.address-create', compact('user'));
    }

    /**
     * Update foto profil pelanggan.
     */
    public function updatePhoto(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                \Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

}
