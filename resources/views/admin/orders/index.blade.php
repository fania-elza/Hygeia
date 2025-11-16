@extends('layouts.admin')

@section('content')

{{-- SUCCESS & ERROR ALERT --}}
@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <span>{{ session('error') }}</span>
    </div>
@endif

{{-- STATISTIK --}}
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Orders Management</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $totalOrders }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Completed Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $completedOrders }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Pending Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $pendingOrders }}</h4>
        </div>
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h4 class="text-2xl font-bold text-teal-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
        </div>
    </div>
</section>

{{-- SEARCH + FILTER --}}
<form action="{{ route('admin.orders.index') }}" method="GET">
    <div class="flex flex-wrap items-center justify-between w-full mx-auto p-2 my-4 bg-white rounded-xl border border-gray-200 shadow-sm gap-2">
        <div class="flex items-center space-x-2 flex-grow">
            <input type="text" name="search" placeholder="Search by Order ID or Customer Name..."
                value="{{ request('search') }}"
                class="w-full p-2 border border-gray-200 rounded-lg bg-transparent text-sm text-gray-900 placeholder-gray-500">

            <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
                Search
            </button>
        </div>

        <select name="status" onchange="this.form.submit()"
            class="ml-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium">
            <option value="">All Status</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </div>
</form>

{{-- TABLE --}}
<section class="bg-white shadow rounded-lg p-6 mt-4">
    <div class="overflow-x-auto">
        <table class="min-w-full border border-teal-200 text-left text-sm">
            <thead class="bg-teal-50 text-center">
                <tr>
                    <th class="border px-4 py-2">Order ID</th>
                    <th class="border px-4 py-2">Customer Name</th>
                    <th class="border px-4 py-2">Total Amount</th>
                    <th class="border px-4 py-2">Payment Method</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Order Date</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @forelse ($orders as $order)
                <tr>
                    <td class="border px-4 py-2 font-medium text-teal-700">{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ $order->user->username }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                    <td class="border px-4 py-2">{{ $order->payment_method }}</td>

                    <td class="border px-4 py-2">
                        @if ($order->status == 'selesai')
                            <span class="px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-700">Selesai</span>
                        @elseif ($order->status == 'diproses')
                            <span class="px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700">Diproses</span>
                        @elseif ($order->status == 'dikirim')
                            <span class="px-3 py-1.5 rounded-full bg-blue-100 text-blue-700">Dikirim</span>
                        @elseif ($order->status == 'cancel')
                            <span class="px-3 py-1.5 rounded-full bg-red-100 text-red-700">Dibatalkan</span>
                        @else
                            <span class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-700">{{ $order->status }}</span>
                        @endif
                    </td>

                    <td class="border px-4 py-2">{{ $order->created_at->format('d F Y') }}</td>

                    <td class="border px-4 py-2">
                        {{-- BUTTON DETAIL --}}
                        <button
                            type="button"
                            class="btn-detail inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:text-blue-600 hover:bg-blue-50"
                            data-order='@json($order->load("user","orderItems.product"))'
                            data-update-url="{{ route('admin.orders.update', $order->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 48 48">
                              <defs>
                                  <mask id="SVG544unEnd">
                                      <g fill="#1a1a1a" stroke="#fff" stroke-linejoin="round" stroke-width="4">
                                          <path d="M24 36c11.046 0 20-12 20-12s-8.954-12-20-12S4 24 4 24s8.954 12 20 12Z"/>
                                          <path d="M24 29a5 5 0 1 0 0-10a5 5 0 0 0 0 10Z"/>
                                      </g>
                                  </mask>
                              </defs>
                              <path fill="#3B82F6" d="M0 0h48v48H0z" mask="url(#SVG544unEnd)" />
                          </svg>
                        </button>

                        {{-- BUTTON DELETE --}}
                        <button
                            class="btn-hapus inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50"
                            data-delete-url="{{ route('admin.orders.destroy',$order->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M3 6h18"/>
                              <path d="M19 6l-1 14H6L5 6"/>
                              <path d="M10 11v6"/>
                              <path d="M14 11v6"/>
                              <path d="M9 6V4h6v2"/>
                          </svg>
                        </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="border px-4 py-4 text-gray-500">Tidak ada data pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</section>

{{-- ==================== MODAL DETAIL ==================== --}}
<div id="modal-detailorder" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-gray-800/40">
  <div class="bg-white rounded-lg shadow-lg p-4 w-full max-w-xl">

    <div class="flex justify-between p-4 border-b">
      <h3 class="font-semibold">Order Details</h3>
      <button data-modal-hide="modal-detailorder" class="text-gray-500 hover:text-gray-700">✖</button>
    </div>

    <form id="form-update-status" action="" method="POST">
      @csrf
      @method('PUT')

      <div class="p-5 space-y-4 max-h-[70vh] overflow-y-auto">

        <div class="bg-teal-50 border border-teal-200 rounded-xl p-5">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            <div>
              <h5 class="font-semibold mb-1">Order Information</h5>
              <p><b>Order ID:</b> <span id="modal-order-id"></span></p>
              <p><b>Date:</b> <span id="modal-order-date"></span></p>
              <p><b>Payment:</b> <span id="modal-payment-method"></span></p>
            </div>

            <div>
              <h5 class="font-semibold mb-1">Customer Information</h5>
              <p><b>Name:</b> <span id="modal-customer-name"></span></p>
              <p><b>Email:</b> <span id="modal-customer-email"></span></p>
              <p><b>Address:</b> <span id="modal-customer-address"></span></p>
            </div>

          </div>
        </div>

        <div>
          <h5 class="font-semibold mb-2">Ordered Products</h5>
          <div id="modal-products-list" class="space-y-2"></div>
        </div>

        <div class="flex justify-between pt-3 border-t">
          <p class="font-semibold">Total:</p>
          <p id="modal-total-amount" class="font-bold"></p>
        </div>

        <div class="pt-2">
            <label class="font-medium">Update Status</label>
            <select id="modal-order-status" name="status" class="border rounded-lg p-2 w-full">
                <option value="diproses">Diproses</option>
                <option value="dikirim">Dikirim</option>
                <option value="selesai">Selesai</option>
                <option value="cancel">Dibatalkan</option>
            </select>
        </div>
      </div>

      <div class="flex justify-end gap-3 p-4 border-t">
        <button data-modal-hide="modal-detailorder" type="button" class="px-4 py-2 border rounded-lg">
          Close
        </button>
        <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-lg">
          Save Changes
        </button>
      </div>

    </form>
  </div>
</div>

{{-- ==================== MODAL DELETE ==================== --}}
<div id="modal-hapuspesanan" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-gray-800/40">
  <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">

    <h3 class="font-semibold mb-3">Hapus Pesanan?</h3>
    <p class="text-sm text-gray-600 mb-5">Tindakan ini tidak dapat dibatalkan.</p>

    <form id="form-hapus" method="POST" action="">
      @csrf
      @method('DELETE')

      <div class="flex justify-center gap-3">
        <button data-modal-hide="modal-hapuspesanan" type="button" class="px-4 py-2 bg-gray-200 rounded-lg">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">
          Ya, Hapus
        </button>
      </div>

    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const rupiah = (n) => new Intl.NumberFormat('id-ID',{style:'currency',currency:'IDR'}).format(n);
    const tanggal = (d) => new Date(d).toLocaleDateString('id-ID',{year:'numeric',month:'long',day:'numeric'});

    // MODAL DETAIL
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = JSON.parse(btn.dataset.order);
            const url = btn.dataset.updateUrl;

            document.getElementById('form-update-status').action = url;

            document.getElementById('modal-order-id').textContent = data.id;
            document.getElementById('modal-order-date').textContent = tanggal(data.created_at);
            document.getElementById('modal-payment-method').textContent = data.payment_method;

            document.getElementById('modal-customer-name').textContent = data.user?.name ?? 'N/A';
            document.getElementById('modal-customer-email').textContent = data.user?.email ?? 'N/A';
            document.getElementById('modal-customer-address').textContent = data.user?.address ?? 'N/A';

            document.getElementById('modal-total-amount').textContent = rupiah(data.total_amount);

            document.getElementById('modal-order-status').value = data.status;

            const list = document.getElementById('modal-products-list');
            list.innerHTML = "";
            if (data.order_items) {
                data.order_items.forEach(i => {
                    list.innerHTML += `
                        <div class="flex justify-between">
                            <span>${i.product.name} x ${i.quantity}</span>
                            <span>${rupiah(i.price * i.quantity)}</span>
                        </div>
                    `;
                });
            }

            document.getElementById('modal-detailorder').classList.remove('hidden');
        });
    });

    // MODAL DELETE
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('form-hapus').action = btn.dataset.deleteUrl;
            document.getElementById('modal-hapuspesanan').classList.remove('hidden');
        });
    });

    // CLOSE MODAL
    document.querySelectorAll('[data-modal-hide]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById(btn.dataset.modalHide).classList.add('hidden');
        });
    });
});
</script>
@endpush
