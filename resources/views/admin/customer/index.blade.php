@extends('layouts.admin')

@section('content')

<!-- 🔹 SECTION: Statistik Pelanggan -->
<section class="bg-white shadow rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-3">Customer Management</h3>

    <div class="grid grid-cols-4 gap-6 mt-6">
        <!-- Total Customers -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Customers</p>
            <h4 class="text-2xl font-bold text-teal-600">{{ $customers->count() }}</h4>
        </div>

        <!-- Active Customers -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Active Customers</p>
            <h4 class="text-2xl font-bold text-teal-600">
                {{ $customers->where('status', true)->count() }}
            </h4>
        </div>

        <!-- New Registrations (last 7 days) -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">New Registrations</p>
            <h4 class="text-2xl font-bold text-teal-600">
                {{ $customers->filter(fn($c) => $c->created_at->greaterThan(now()->subWeek()))->count() }}
            </h4>
        </div>

        <!-- Total Orders -->
        <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h4 class="text-2xl font-bold text-teal-600">
                {{ $customers->sum('orders_count') }}
            </h4>
        </div>
    </div>
</section>


<!-- 🔹 SECTION: Search -->
<div class="flex items-center justify-between w-full mx-auto p-4 mt-6 bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="flex items-center space-x-2 w-96">
        <input 
            type="text" 
            placeholder="Search customers by name or email......" 
            class="w-full p-2 border border-gray-200 rounded-lg focus:ring-0 bg-transparent text-sm text-gray-900 placeholder-gray-500"
        >
        <button type="button" class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white text-sm font-medium rounded-lg px-4 py-2">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            Search
        </button>
    </div>
</div>

<!-- 🔹 SECTION: Table -->
<section class="bg-white shadow rounded-lg p-6 mt-4">
    <table class="min-w-full border border-teal-200 text-left text-sm">
        <thead class="bg-teal-50 text-gray-800 text-center">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Customer ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Total Orders</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-center text-gray-700">
          @foreach ($customers as $customer)
              <tr>
                  <td class="border border-gray-300 px-4 py-2">{{ $customer->id }}</td>
                  <td class="border border-gray-300 px-4 py-2">{{ $customer->username }}</td>
                  <td class="border border-gray-300 px-4 py-2">{{ $customer->email }}</td>
                  <td class="border border-gray-300 px-4 py-2">{{ $customer->orders_count ?? 0 }}</td>
                  <td class="border border-gray-300 px-4 py-2">
                      @if($customer->status ?? true)
                          <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700">Aktif</span>
                      @else
                          <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">Nonaktif</span>
                      @endif
                  </td>
                  <td class="border border-gray-300 px-4 py-2 flex justify-center gap-2">
                      <!-- Tombol Detail -->
                      <button 
                          data-modal-target="modal-detailcustomer" 
                          data-modal-toggle="modal-detailcustomer"
                          class="detail-customer inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-500 hover:text-blue-600 hover:bg-blue-50"
                          data-id="{{ $customer->id }}"
                          data-username="{{ $customer->username }}"
                          data-email="{{ $customer->email }}"
                          data-phone="{{ $customer->contact_number ?? '-' }}"
                          data-orders-count="{{ $customer->orders_count ?? 0 }}"
                          data-dob="{{ $customer->dob ?? '-' }}"
                          data-gender="{{ $customer->gender ?? '-' }}"
                          data-address="{{ $customer->address ?? '-' }}"
                          data-city="{{ $customer->city ?? '-' }}"
                          data-recent-transactions='@json($customer->recent_transactions ?? [])'
                      >
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

                      <!-- Tombol Hapus -->
                      <button 
                          data-modal-target="modal-hapuscustomer" 
                          data-modal-toggle="modal-hapuscustomer"
                          class="delete-customer inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-50"
                          data-id="{{ $customer->id }}"
                      >
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
          @endforeach
      </tbody>
    </table>
</section>

<!-- 🔹 MODAL: Detail Customer -->
<div id="modal-detailcustomer" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
  <div class="relative p-4 w-full max-w-lg">
    <div class="relative bg-white rounded-lg shadow-lg">
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Detail Pelanggan</h3>
        <button type="button" data-modal-toggle="modal-detailcustomer" class="text-gray-400 hover:text-gray-700 rounded-lg p-1">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M13 1L1 13"/>
          </svg>
        </button>
      </div>
      <!-- Body -->
      <div class="p-6 space-y-6">
        <div class="bg-teal-50 border border-teal-200 rounded-xl p-5">
          <div class="flex items-center gap-4 mb-5">
            <div class="flex-shrink-0">
              <!-- Initials tetap SJ -->
              <div class="w-14 h-14 bg-teal-100 text-teal-600 flex items-center justify-center rounded-full text-xl font-bold" id="detail-initials">
                SJ
              </div>
            </div>
            <div>
              <!-- Value tetap dari server -->
              <h4 class="text-lg font-semibold text-gray-800" id="detail-username">{{ $customer->username }}</h4>
              <p class="text-sm text-gray-600" id="detail-email">{{ $customer->email }}</p>
              <p class="text-sm text-gray-600" id="detail-phone">{{ $customer->contact_number }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
            <div>
              <p><span class="font-semibold">ID Pelanggan:</span> <span id="detail-id">{{ $customer->id }}</span></p>
              <p><span class="font-semibold">Total Pesanan:</span> <span id="detail-orders-count">{{ $customer->orders_count ?? 0 }}</span></p>
            </div>
            <div>
              <p><span class="font-semibold">Tanggal Lahir:</span> <span id="detail-dob">{{ $customer->dob }}</span></p>
            </div>
          </div>
        </div>

        <!-- Recent Transactions -->
        <div>
          <h5 class="text-base font-semibold text-gray-900 mb-2">Transaksi Terbaru</h5>
          <div id="detail-recent-transactions" class="space-y-2">
            <!-- Transaction items akan diisi via JS -->
          </div>
        </div>
      </div>
      <!-- Footer -->
      <div class="flex justify-end items-center gap-3 p-4 border-t border-gray-200">
        <button data-modal-toggle="modal-detailcustomer" type="button" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Tutup</button>
        <button type="button" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium">
          Nonaktifkan Pelanggan
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 MODAL: Hapus Customer -->
<div id="modal-hapuscustomer" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-800/40">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm text-center">
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Hapus Customer?</h3>
    <p class="text-sm text-gray-600 mb-5">Apakah Anda yakin ingin menghapus customer ini? Tindakan ini tidak dapat dibatalkan.</p>
    <form id="form-delete-customer" method="POST">
      @csrf
      @method('DELETE')
      <div class="flex justify-center space-x-3">
        <button type="button" data-modal-toggle="modal-hapuscustomer" class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 text-sm rounded-lg bg-red-600 hover:bg-red-700 text-white">
          Ya, Hapus
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailButtons = document.querySelectorAll('.detail-customer');
    const deleteButtons = document.querySelectorAll('.delete-customer');
    const deleteForm = document.getElementById('form-delete-customer');

    detailButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Set basic info
            document.getElementById('detail-id').textContent = button.dataset.id || '-';
            document.getElementById('detail-username').textContent = button.dataset.username || '-';
            document.getElementById('detail-email').textContent = button.dataset.email || '-';
            document.getElementById('detail-phone').textContent = button.dataset.phone || '-';
            document.getElementById('detail-orders-count').textContent = button.dataset.ordersCount || '0';
            document.getElementById('detail-dob').textContent = button.dataset.dob || '-';
            document.getElementById('detail-gender').textContent = button.dataset.gender || '-';
            document.getElementById('detail-address').textContent = button.dataset.address || '-';
            document.getElementById('detail-city').textContent = button.dataset.city || '-';

            // Initials
            const nameParts = button.dataset.username ? button.dataset.username.split(' ') : [];
            document.getElementById('detail-initials').textContent = nameParts.length ? nameParts.map(n => n[0]).join('').toUpperCase() : 'NA';

            // Recent Transactions
            const container = document.getElementById('detail-recent-transactions');
            container.innerHTML = '';
            const transactions = button.dataset.recentTransactions ? JSON.parse(button.dataset.recentTransactions) : [];
            if(transactions.length === 0){
                container.innerHTML = '<p class="text-sm text-gray-500">Tidak ada transaksi terbaru.</p>';
            } else {
                transactions.forEach(t => {
                    const div = document.createElement('div');
                    div.className = "flex justify-between items-center p-3 border rounded-lg";
                    div.innerHTML = `
                        <div>
                            <p class="font-medium text-gray-800">${t.code || '-'}</p>
                            <p class="text-sm text-gray-500">${t.date || '-'}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">${t.amount || '-'}</p>
                            <span class="text-xs ${t.status === 'Completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'} px-2 py-0.5 rounded-full">
                                ${t.status || '-'}
                            </span>
                        </div>
                    `;
                    container.appendChild(div);
                });
            }
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            deleteForm.action = `/admin/customers/${button.dataset.id}`;
        });
    });
});
</script>
@endsection
