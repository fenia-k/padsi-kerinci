<!-- Tambahkan link Bootstrap jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .form-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: auto;
    }
    .form-label {
        font-weight: bold;
        color: #495057;
    }
    .form-control,
    .form-select {
        border-radius: 8px;
    }
    .produk-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .img-thumbnail {
        max-height: 150px;
        max-width: 150px;
        object-fit: cover;
        margin-top: 10px;
        display: none;
    }
    .error-message {
        color: red;
        font-size: 0.875rem;
        display: none;
    }
    #addRow {
        font-size: 14px;
        padding: 8px 12px;
        max-width: 150px;
    }
    .menu-container {
        flex: 5;
    }
    .jumlah-container {
        flex: 2;
    }
    .hapus-container {
        flex: 1;
    }
</style>

<div class="form-container bg-white shadow p-4 rounded">
    <h2 class="text-center mb-4 text-primary">Tambah Transaksi Baru</h2>

    <!-- Error Notification -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
        @csrf

        <div class="row g-3">
            <!-- Tanggal Transaksi -->
            <div class="col-md-12">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <!-- Produk Dinamis -->
            <div id="produk-container" class="col-md-12">
                <div class="produk-row mb-3">
                    <!-- Dropdown Produk -->
                    <div class="menu-container">
                        <label for="produk[0][id_menu]" class="form-label">Produk</label>
                        <select name="produk[0][id_menu]" class="form-select menu-select" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($menu as $m)
                                <option value="{{ $m->id }}" data-harga="{{ $m->harga_menu }}" data-gambar="{{ asset('storage/' . $m->gambar_menu) }}" data-jumlah="{{ $m->jumlah_menu }}">
                                    {{ $m->nama_menu }} - Rp {{ number_format($m->harga_menu, 0, ',', '.') }} (Stok: {{ $m->jumlah_menu }})
                                </option>
                            @endforeach
                        </select>
                        <!-- Gambar Preview di bawah dropdown -->
                        <img src="" alt="Gambar Produk" class="menu-preview img-thumbnail mt-2">
                    </div>
                    <!-- Kolom Jumlah -->
                    <div class="jumlah-container">
                        <label for="produk[0][jumlah]" class="form-label">Jumlah</label>
                        <input type="number" name="produk[0][jumlah]" class="form-control jumlah-input" min="1" required>
                    </div>
                    <!-- Tombol Hapus -->
                    <div class="hapus-container">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="button" class="btn btn-danger w-100 remove-row">Hapus</button>
                    </div>
                </div>
            </div>
            <button type="button" id="addRow" class="btn btn-success mb-3">Tambah Produk</button>

            <!-- Total Harga -->
            <div class="col-md-12">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="text" name="total_harga" id="total_harga" class="form-control" placeholder="Total harga akan otomatis dihitung" readonly>
            </div>

            <!-- Nominal yang Dibayar -->
            <div class="col-md-6">
                <label for="nominal" class="form-label">Nominal yang Dibayar</label>
                <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal pembayaran (kosongkan jika menggunakan poin)">
            </div>

            <!-- Kembalian -->
            <div class="col-md-6">
                <label for="kembalian" class="form-label">Kembalian</label>
                <input type="text" id="kembalian" class="form-control" placeholder="Kembalian akan otomatis dihitung" readonly>
            </div>

            <!-- Pelanggan -->
            <div class="col-md-12">
                <label for="id_pelanggan" class="form-label">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-select">
                    <option value="">Pilih Pelanggan (Opsional)</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" data-poin="{{ $p->poin }}">{{ $p->nama_pelanggan }} - {{ $p->poin }} Poin</option>
                    @endforeach
                </select>
                <small id="poinDisplay" class="text-muted" style="display: none;">Poin: <span id="poinValue">0</span></small>
            </div>

            <!-- Input Poin yang Digunakan -->
            <div class="col-md-12">
                <label for="poin_digunakan" class="form-label">Poin yang Digunakan <small>(untuk diskon)</small></label>
                <input type="number" name="poin_digunakan" id="poin_digunakan" class="form-control" placeholder="Masukkan jumlah poin yang digunakan" min="0" disabled>
                <p id="poinError" class="error-message">Jumlah poin yang digunakan melebihi jumlah transaksi.</p>
            </div>

            <!-- Kode Referral -->
            <div class="col-md-12">
                <label for="kode_referal" class="form-label">Kode Referral <small>(opsional)</small></label>
                <input type="text" name="kode_referal" id="kode_referal" class="form-control" placeholder="Masukkan kode referral">
            </div>

            <!-- Kasir -->
            <div class="col-md-12">
                <label for="id_pengguna" class="form-label">Kasir / Pegawai</label>
                <select name="id_pengguna" id="id_pengguna" class="form-select" required>
                    <option value="">Pilih Kasir</option>
                    @foreach ($pengguna as $user)
                        <option value="{{ $user->id }}">{{ $user->nama_pengguna }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary w-100" id="submitButton">Tambah Transaksi</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary w-100">Batal</a>
        </div>
    </form>
</div>

<script>
    let produkCount = 1;

    function calculateTotalHarga() {
        let totalHarga = 0;
        document.querySelectorAll('.produk-row').forEach(row => {
            const harga = parseFloat(row.querySelector('.menu-select option:checked').dataset.harga || 0);
            const jumlahInput = row.querySelector('.jumlah-input');
            const jumlah = parseInt(jumlahInput.value || 0);
            const stokMaksimum = parseInt(row.querySelector('.menu-select option:checked').dataset.jumlah || 0);

            // Jika jumlah melebihi stok, set ke stok maksimum dan tampilkan pesan
            if (jumlah > stokMaksimum) {
                jumlahInput.value = stokMaksimum;
                alert(`Jumlah yang diinputkan melebihi stok. ${stokMaksimum}`);
            }

            totalHarga += harga * parseInt(jumlahInput.value || 0);
        });

        const poinUsed = parseInt(document.getElementById('poin_digunakan').value || 0);
        if (poinUsed > totalHarga) {
            document.getElementById('poinError').style.display = 'block';
            document.getElementById('submitButton').disabled = true;
        } else {
            document.getElementById('poinError').style.display = 'none';
            document.getElementById('submitButton').disabled = false;
        }

        document.getElementById('total_harga').value = `Rp ${new Intl.NumberFormat('id-ID').format(totalHarga)}`;
        calculateChange(totalHarga);
    }

    function calculateChange(total) {
        const nominal = parseInt(document.getElementById('nominal').value || 0);
        const kembalian = nominal - total;

        document.getElementById('kembalian').value = kembalian >= 0 ? `Rp ${new Intl.NumberFormat('id-ID').format(kembalian)}` : 'Nominal kurang';
    }

    function updatePreviewImage(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const previewImage = selectElement.closest('.produk-row').querySelector('.menu-preview');
        const imageSrc = selectedOption.dataset.gambar || '';

        if (imageSrc) {
            previewImage.src = imageSrc;
            previewImage.style.display = 'block';
        } else {
            previewImage.src = '';
            previewImage.style.display = 'none';
        }
    }

    document.getElementById('addRow').addEventListener('click', () => {
        const container = document.getElementById('produk-container');
        const row = document.createElement('div');
        row.classList.add('produk-row', 'mb-3');
        row.innerHTML = `
            <div class="menu-container">
                <label class="form-label">Produk</label>
                <select name="produk[${produkCount}][id_menu]" class="form-select menu-select" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($menu as $m)
                        <option value="{{ $m->id }}" data-harga="{{ $m->harga_menu }}" data-gambar="{{ asset('storage/' . $m->gambar_menu) }}" data-jumlah="{{ $m->jumlah_menu }}">
                            {{ $m->nama_menu }} - Rp {{ number_format($m->harga_menu, 0, ',', '.') }} (Stok: {{ $m->jumlah_menu }})
                        </option>
                    @endforeach
                </select>
                <img src="" alt="Gambar Produk" class="menu-preview img-thumbnail mt-2">
            </div>
            <div class="jumlah-container">
                <label class="form-label">Jumlah</label>
                <input type="number" name="produk[${produkCount}][jumlah]" class="form-control jumlah-input" min="1" required>
            </div>
            <div class="hapus-container">
                <label class="form-label d-block">&nbsp;</label>
                <button type="button" class="btn btn-danger w-100 remove-row">Hapus</button>
            </div>`;
        container.appendChild(row);
        produkCount++;
    });

    document.getElementById('produk-container').addEventListener('change', (e) => {
        if (e.target.classList.contains('menu-select')) {
            updatePreviewImage(e.target);
        }
    });

    document.getElementById('produk-container').addEventListener('click', e => {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.produk-row').remove();
            calculateTotalHarga();
        }
    });

    document.getElementById('produk-container').addEventListener('input', calculateTotalHarga);

    document.getElementById('nominal').addEventListener('input', () => {
        const nominal = parseInt(document.getElementById('nominal').value || 0);
        const poinInput = document.getElementById('poin_digunakan');

        if (nominal > 0) {
            poinInput.value = '';
            poinInput.disabled = true;
        } else {
            poinInput.disabled = false;
        }

        calculateTotalHarga();
    });

    document.getElementById('poin_digunakan').addEventListener('input', () => {
        const poinInput = parseInt(document.getElementById('poin_digunakan').value || 0);
        const nominalInput = document.getElementById('nominal');
        const totalHarga = parseInt(document.getElementById('total_harga').value.replace(/\D/g, '') || 0);

        if (poinInput > 0) {
            nominalInput.value = '';
            nominalInput.disabled = true;

            if (poinInput > totalHarga) {
                document.getElementById('poinError').style.display = 'block';
                const poinExcess = poinInput - totalHarga;
                document.getElementById('poin_digunakan').value = totalHarga; // Set poin digunakan sama dengan total harga
                alert(`Poin berlebih akan dikembalikan: ${poinExcess}`);
            } else {
                document.getElementById('poinError').style.display = 'none';
            }
        } else {
            nominalInput.disabled = false;
        }
    });

    document.getElementById('id_pelanggan').addEventListener('change', () => {
        const selectedOption = document.getElementById('id_pelanggan').options[document.getElementById('id_pelanggan').selectedIndex];
        const poin = parseInt(selectedOption.dataset.poin || 0);
        document.getElementById('poinValue').textContent = poin;
        document.getElementById('poin_digunakan').disabled = false;
    });

    // Disable form submission if conditions are not met
    document.getElementById('transaksiForm').addEventListener('submit', (e) => {
        const totalHarga = parseInt(document.getElementById('total_harga').value.replace(/\D/g, '') || 0);
        const nominal = parseInt(document.getElementById('nominal').value || 0);
        const poinDigunakan = parseInt(document.getElementById('poin_digunakan').value || 0);

        if ((nominal < totalHarga) && (poinDigunakan < totalHarga)) {
            e.preventDefault();
            alert("Nominal pembayaran atau poin yang digunakan harus mencukupi total harga transaksi.");
        }
    });
</script>
