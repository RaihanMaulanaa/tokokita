<!-- Container utama dengan margin atas -->
<div class="container mt-5">
    <!-- Kartu utama untuk menampilkan konten produk -->
    <div class="card">
        <div class="card-body p-4">
            <div class="row">
                <!-- Kolom kiri: Gambar produk -->
                <div class="col-md-5 text-center">
                    <!-- Gambar produk dari direktori uploads/produk -->
                    <img src="<?php echo base_url('uploads/produk/' . $produk->gambar_produk); ?>" 
                         class="img-fluid rounded" 
                         style="max-height: 400px;" 
                         alt="<?php echo $produk->nama_produk; ?>">
                </div>

                <!-- Kolom kanan: Informasi produk -->
                <div class="col-md-7">
                    <!-- Nama produk -->
                    <h2><?php echo $produk->nama_produk; ?></h2>
                    
                    <!-- Harga produk (format rupiah) -->
                    <h3 class="my-3 text-success fw-bold">
                        Rp <?php echo number_format($produk->harga, 0, ',', '.'); ?>
                    </h3>

                    <!-- Informasi stok yang tersedia -->
                    <p>
                        <strong>Stok Tersedia:</strong> 
                        <span class="badge bg-info"><?php echo $produk->stok; ?></span>
                    </p>
                    
                    <hr>

                    <!-- Deskripsi produk -->
                    <h5>Deskripsi Produk</h5>
                    <p>
                        <?php 
                        // htmlspecialchars untuk mencegah XSS, 
                        // nl2br agar baris baru di deskripsi tampil dengan <br>
                        echo nl2br(htmlspecialchars($produk->deskripsi)); 
                        ?>
                    </p>
                    
                    <hr>

                    <!-- Tombol Tambah ke Keranjang -->
                    <div class="mt-4">
                        <a href="<?php echo site_url('cart/tambah/' . $produk->id_produk); ?>" 
                           class="btn btn-success btn-lg">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </a>
                    </div>
                </div> <!-- Akhir kolom kanan -->
            </div> <!-- Akhir row -->
        </div> <!-- Akhir card-body -->
    </div> <!-- Akhir card -->
</div> <!-- Akhir container -->