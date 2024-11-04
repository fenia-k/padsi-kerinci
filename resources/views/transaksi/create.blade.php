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
    .img-thumbnail {
        max-height: 100px;
        object-fit: cover;
        cursor: pointer;
    }
    .modal-img {
        width: 100%;
        height: auto;
    }
    .error-message {
        color: red;
        font-size: 0.875rem;
        display: none;
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

            <!-- Pilih Menu -->
            <div class="col-md-6">
                <label for="id_menu" class="form-label">Pilih Menu</label>
                <select name="id_menu" id="id_menu" class="form-select" required>
                    <option value="">Pilih Menu</option>
                    @foreach ($menu as $m)
                        <option value="{{ $m->id }}" data-harga="{{ $m->harga_menu }}" data-gambar="{{ asset('storage/' . $m->gambar_menu) }}">
                            {{ $m->nama_menu }} - Rp {{ number_format($m->harga_menu, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah -->
            <div class="col-md-6">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" placeholder="Masukkan jumlah" required>
            </div>

            <!-- Preview Gambar Menu -->
            <div class="col-md-6">
                <label for="menuImage" class="form-label">Gambar Menu</label>
                <img id="menuImage" src="" alt="Gambar Menu" class="img-thumbnail d-block" style="display: none;" data-bs-toggle="modal" data-bs-target="#imageModal">
            </div>

            <!-- Total Harga -->
            <div class="col-md-6">
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
                <input type="number" name="poin_digunakan" id="poin_digunakan" class="form-control" placeholder="Masukkan jumlah poin yang digunakan" min="0">
                <p id="poinError" class="error-message">Jumlah poin yang digunakan melebihi jumlah poin yang tersedia.</p>
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

<!-- Modal for Image Pop-up -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img id="modalImage" src="" alt="Gambar Menu" class="modal-img">
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Auto Calculations and Image Display -->
<script>

    const menuDropdown = document.getElementById('id_menu');
    const menuImage = document.getElementById('menuImage');
    const modalImage = document.getElementById('modalImage');
    const totalHargaInput = document.getElementById('total_harga');
    const jumlahInput = document.getElementById('jumlah');
    const nominalInput = document.getElementById('nominal');
    const kembalianInput = document.getElementById('kembalian');
    const pelangganDropdown = document.getElementById('id_pelanggan');
    const poinDisplay = document.getElementById('poinDisplay');
    const poinValue = document.getElementById('poinValue');
    const poinDigunakanInput = document.getElementById('poin_digunakan');
    const poinError = document.getElementById('poinError');
    const submitButton = document.getElementById('submitButton');

    function updateMenuImage() {
        const selectedOption = menuDropdown.options[menuDropdown.selectedIndex];
        const imageSrc = selectedOption.getAttribute('data-gambar');
        if (imageSrc) {
            menuImage.src = imageSrc;
            modalImage.src = imageSrc;
            menuImage.style.display = 'block';
        } else {
            menuImage.style.display = 'none';
            modalImage.src = '';
        }
    }

    function calculateTotalHarga() {
        const harga = parseFloat(menuDropdown.options[menuDropdown.selectedIndex].getAttribute('data-harga')) || 0;
        const jumlah = parseInt(jumlahInput.value) || 0;
        const poinUsed = parseInt(poinDigunakanInput.value) || 0;
        const total = (harga * jumlah) - poinUsed;

        totalHargaInput.value = `Rp ${new Intl.NumberFormat('id-ID').format(total > 0 ? total : 0)}`;
        calculateChange();
    }

    function calculateChange() {
        const total = parseInt(totalHargaInput.value.replace(/[^0-9]/g, '')) || 0;
        const nominal = parseInt(nominalInput.value) || 0;
        
        const kembalian = nominal - total;
        kembalianInput.value = kembalian >= 0 ? `Rp ${new Intl.NumberFormat('id-ID').format(kembalian)}` : 'Nominal kurang';
    }

    pelangganDropdown.addEventListener('change', () => {
        const selectedOption = pelangganDropdown.options[pelangganDropdown.selectedIndex];
        const poin = selectedOption.getAttribute('data-poin');
        if (poin) {
            poinValue.textContent = poin;
            poinDisplay.style.display = 'block';
        } else {
            poinValue.textContent = '0';
            poinDisplay.style.display = 'none';
        }
        checkPoinValidity();
    });

    poinDigunakanInput.addEventListener('input', () => {
        checkPoinValidity();
        calculateTotalHarga();
    });

    function checkPoinValidity() {
        const maxPoin = parseInt(poinValue.textContent) || 0;
        const poinUsed = parseInt(poinDigunakanInput.value) || 0;

        if (poinUsed > maxPoin) {
            poinError.style.display = 'block';
            submitButton.disabled = false; // Keep submit button enabled
        } else {
            poinError.style.display = 'none';
        }
    }

    menuDropdown.addEventListener('change', () => {
        updateMenuImage();
        calculateTotalHarga();
    });

    jumlahInput.addEventListener('input', calculateTotalHarga);
    nominalInput.addEventListener('input', calculateChange);
</script>
