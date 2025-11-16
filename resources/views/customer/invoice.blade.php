<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #444;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }
        h4 {
            text-align: center;
            margin-top: 5px;
        }

        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .info-table .label {
            width: 20%;
            font-weight: bold;
        }

        .info-table .value {
            width: 30%;
        }

        .items-table th, .items-table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        .items-table th {
            background: #f0f0f0;
        }

        .right {
            text-align: right;
        }

        .signature-img {
            margin-top: 8px;
            display: block;
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <h2>Toko Alat Kesehatan</h2>
    <h4>Laporan Belanja Anda</h4>

    <!-- ====================== INFORMASI CUSTOMER ====================== -->
    <table class="info-table">
        <tr>
            <td class="label">User ID</td>
            <td class="value">: {{ $order->user->id }}</td>
            <td class="label">Tanggal</td>
            <td class="value">: {{ $order->created_at->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama</td>
            <td class="value">: {{ $order->user->username }}</td>
            <td class="label">Alamat</td>
            <td class="value">: {{ $order->address }}</td>
        </tr>
        <tr>
            <td class="label">No HP</td>
            <td class="value">: {{ $order->user->contact_number ?? '-' }}</td>
            <td class="label">Cara Bayar</td>
            <td class="value">: {{ ucfirst($order->payment_method) }}</td>
        </tr>
    </table>

    <!-- ====================== TABEL PRODUK ====================== -->
    <table class="items-table" style="margin-top: 25px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th class="right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ================= TOTAL ================== -->
    <p style="margin-top: 15px; font-weight: bold;">
        Total belanja (termasuk pajak):
        <span style="float:right;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
    </p>

    <table class="signature" style="margin-top: 25px;">
        <tr>
            <td>TANDATANGAN TOKO</td>
        </tr>
        <tr>
            <!-- ============== GAMBAR TANDA TANGAN ============== -->
            <img src="{{ public_path('image/ttd-toko.png') }}" class="signature-img" style="width:100px; height:auto;">
        </tr>
    </table>

</div>

</body>
</html>