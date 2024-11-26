<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Laporan Transaksi</h2>
    <p class="text-center">Tanggal: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    <table class="table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Detail Produk</th>
                <th>Poin Digunakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $trans)
            <tr>
                <td>{{ $trans->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                <td>{{ \Carbon\Carbon::parse($trans->tanggal_transaksi)->format('d M Y') }}</td>
                <td>Rp {{ number_format($trans->total_harga, 0, ',', '.') }}</td>
                <td>
                    @if($trans->detailTransaksi->isNotEmpty())
                        <ul>
                            @foreach ($trans->detailTransaksi as $detail)
                                <li>{{ $detail->menu->nama_menu }} x {{ $detail->jumlah_pesanan }}</li>
                            @endforeach
                        </ul>
                    @else
                        Tidak ada detail produk
                    @endif
                </td>
                <td>{{ $trans->poin_digunakan ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
