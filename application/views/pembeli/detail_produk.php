<!-- Kartu utama untuk menampilkan detail produk -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Kolom kiri: gambar produk -->
            <div class="col-md-5">
                <!-- Gambar produk dummy (nanti bisa diganti dengan gambar dari database) -->
                <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Gambar Produk">
            </div>

            <!-- Kolom kanan: informasi produk -->
            <div class="col-md-7">
                <!-- Nama produk -->
                <h2>Nama Produk Sangat Detail</h2>

                <!-- Nama penjual (bisa dijadikan link ke profil penjual) -->
                <p class="text-muted">Dijual oleh: <a href="#">Budi Penjual</a></p>
                
                <!-- Harga produk ditampilkan dengan gaya mencolok -->
                <h3 class="my-3 text-primary fw-bold">Rp 199.000</h3>

                <!-- Info stok tersisa -->
                <p><strong>Stok:</strong> 45 Tersisa</p>
                
                <hr>

                <!-- Deskripsi lengkap produk -->
                <h5>Deskripsi Produk</h5>
                <p>Ini adalah deskripsi lengkap dari produk yang menjelaskan semua fitur, keunggulan, bahan, dan cara penggunaan. Dibuat semenarik mungkin untuk meyakinkan pembeli.</p>
                
                <hr>

                <!-- Form untuk menambahkan produk ke keranjang -->
                <?php echo form_open('pembeli/tambah_ke_keranjang'); ?>
                    <!-- ID produk disimpan dalam hidden input -->
                    <input type="hidden" name="id_produk" value="1">

                    <!-- Input jumlah produk yang ingin dibeli -->
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" name="jumlah" class="form-control" value="1" min="1" max="45">
                        </div>

                        <!-- Tombol untuk submit ke keranjang -->
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btn-lg mt-3">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>