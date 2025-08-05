<div class="container mt-5">
    <!-- Container utama dengan margin atas -->
    <h2 class="mb-4">Checkout Pesanan 📦</h2>
    <!-- Judul halaman checkout dengan margin bawah -->

    <div class="row g-5">
        <!-- Baris dengan jarak antar kolom (gutters 5) -->

        <!-- Kolom kiri: Formulir data pengiriman & pembayaran -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Pengiriman & Pembayaran</h5>
                </div>
                <div class="card-body">
                    <!-- Form untuk memproses checkout -->
                    <?php echo form_open('checkout/proses'); ?>

                    <!-- Input: Nama Penerima -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Penerima</label>
                        <!-- Diisi otomatis dari session nama_user -->
                        <input type="text" class="form-control" name="nama_penerima" 
                            value="<?php echo $this->session->userdata('nama_user'); ?>" required>
                    </div>

                    <!-- Input: Alamat Pengiriman -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman Lengkap</label>
                        <!-- Textarea untuk alamat detail -->
                        <textarea class="form-control" name="alamat" rows="4" required 
                            placeholder="Contoh: Jl. Merdeka No. 17, Kelurahan, Kecamatan, Kota, Kode Pos"></textarea>
                    </div>

                    <!-- Pilihan Metode Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Pembayaran</label>
                        <select class="form-select" name="metode_pembayaran" required>
                            <option value="bca_va">Transfer Bank - BCA Virtual Account</option>
                            <option value="gopay">GoPay</option>
                            <option value="cod">Bayar di Tempat (COD)</option>
                        </select>
                    </div>

                    <!-- Tombol Submit untuk membuat pesanan -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-shield-check"></i> Buat Pesanan Sekarang
                        </button>
                    </div>

                    <!-- Tutup form -->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Kolom kanan: Ringkasan Pesanan -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <!-- List ringkasan produk yang dibeli -->
                    <ul class="list-group list-group-flush">

                        <!-- Loop: Tampilkan setiap item dari keranjang -->
                        <?php foreach ($cart_items as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="my-0"><?php echo $item->nama_produk; ?></h6>
                                    <small class="text-muted">Jumlah: <?php echo $item->jumlah; ?></small>
                                </div>
                                <!-- Hitung total harga per item (harga * jumlah) -->
                                <span class="text-muted">
                                    Rp <?php echo number_format($item->harga * $item->jumlah, 0, ',', '.'); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                        <!-- Akhir dari loop -->

                        <!-- Baris total harga keseluruhan -->
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span class="fw-bold">Total</span>
                            <strong class="fw-bold text-success">
                                Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>