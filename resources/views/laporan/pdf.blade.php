<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h2 {
            text-align: center;
            font-size: 18px;
            color: #4CAF50;
            margin-top: 20px;
        }
        .header-info {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        .table td {
            background-color: #f9f9f9;
        }
        .table td, .table th {
            padding: 10px;
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .total-row td {
            text-align: right;
            font-size: 14px;
        }
        .total {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 8px;
            font-weight: bold;
        }
        .total-row td {
            color: black; /* Set the font color of the total to black */
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>Transaction Report</h2>
    <p class="header-info">Date: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    
    <table class="table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>Product Details</th>
                <th>Points Used</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $trans)
                <tr>
                    <td>{{ $trans->pelanggan->nama_pelanggan ?? 'General' }}</td>
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
                            No product details
                        @endif
                    </td>
                    <td>{{ $trans->poin_digunakan ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Transactions -->
    @if($totalTransaksi > 0)
        <table class="table">
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Total Transactions</td>
                    <td class="total">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p class="text-center">No transactions for this period.</p>
    @endif

    <div class="footer">
        <p>This report is automatically generated. Thank you for your cooperation.</p>
    </div>
</body>
</html>
