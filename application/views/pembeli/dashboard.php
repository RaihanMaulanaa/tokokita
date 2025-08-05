<!-- Section Hero / Banner dengan latar terang dan padding -->
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <!-- Judul sambutan -->
        <h1 class="display-5 fw-bold">Selamat Datang di TokoKita</h1>
        <!-- Deskripsi singkat toko -->
        <p class="col-md-8 fs-4">Temukan berbagai produk berkualitas dari penjual terpercaya di seluruh negeri.</p>
    </div>
</div>

<!-- Judul untuk daftar produk -->
<h3 class="mb-4">Produk Terbaru</h3>

<!-- Grid produk: responsif untuk 1 kolom di mobile, 2 di tablet, 4 di desktop -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

    <!-- Loop menampilkan 8 produk dummy -->
    <?php for ($i = 0; $i < 8; $i++): ?>
        <div class="col">
            <div class="card h-100">
                <!-- Gambar produk dummy -->
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Gambar Produk">

                <!-- Konten kartu produk -->
                <div class="card-body">
                    <!-- Nama produk -->
                    <h5 class="card-title">Nama Produk Keren</h5>
                    <!-- Deskripsi singkat -->
                    <p class="card-text text-muted">Deskripsi singkat produk yang menarik perhatian pembeli.</p>
                    <!-- Harga produk -->
                    <h6 class="fw-bold">Rp 199.000</h6>
                </div>

                <!-- Tombol lihat detail di bagian footer card -->
                <div class="card-footer bg-transparent border-top-0">
                    <a href="<?php echo site_url('produk/detail/1'); ?>" class="btn btn-primary w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</div>