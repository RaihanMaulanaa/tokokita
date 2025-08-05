<!-- Container utama dengan margin atas -->
<div class="container mt-4">

    <!-- Menampilkan alert sukses jika ada pesan flashdata 'success' dari session -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <!-- Tombol untuk menutup alert -->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Menampilkan alert error jika ada pesan flashdata 'error' dari session -->
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Banner Carousel Produk -->
    <div id="productBanner" class="carousel slide mb-4" data-bs-ride="carousel">
        <!-- Indikator Slide (titik di bawah) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#productBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#productBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#productBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <!-- Konten Slide -->
        <div class="carousel-inner rounded-3">
            <!-- Slide 1 -->
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://placehold.co/1200x400/007BFF/FFFFFF?text=Promo+Spesial" class="d-block w-100" alt="Banner Promo">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Koleksi Elektronik Terbaru</h5>
                    <p>Dapatkan diskon hingga 30% untuk semua produk elektronik.</p>
                    <a href="#" class="btn btn-light">Lihat Promo</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item" data-bs-interval="5000">
                <img src="https://placehold.co/1200x400/28A745/FFFFFF?text=Fashion+Terkini" class="d-block w-100" alt="Banner Fashion">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Gaya Fashion Pria & Wanita</h5>
                    <p>Update penampilanmu dengan koleksi fashion terkini dari kami.</p>
                     <a href="#" class="btn btn-light">Belanja Sekarang</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item" data-bs-interval="5000">
                <img src="https://placehold.co/1200x400/DC3545/FFFFFF?text=Peralatan+Rumah+Tangga" class="d-block w-100" alt="Banner Rumah Tangga">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Lengkapi Kebutuhan Rumah Anda</h5>
                    <p>Semua yang Anda butuhkan untuk rumah yang nyaman dan modern.</p>
                     <a href="#" class="btn btn-light">Cari Produk</a>
                </div>
            </div>
        </div>
        <!-- Tombol Kontrol Kiri & Kanan -->
        <button class="carousel-control-prev" type="button" data-bs-target="#productBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Judul Daftar Produk -->
    <h3 class="mb-4">Produk Tersedia</h3>

    <!-- Grid produk menggunakan Bootstrap row dan responsive column -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach($produk as $p): ?>
        <div class="col">
            <!-- Kartu produk -->
            <div class="card h-100 d-flex flex-column shadow-sm">
                <!-- Gambar produk -->
                <img src="<?php echo base_url('uploads/produk/' . $p->gambar_produk); ?>" 
                     class="card-img-top" 
                     style="height: 200px; object-fit: cover;" 
                     alt="<?php echo $p->nama_produk; ?>">
                
                <!-- Informasi produk -->
                <div class="card-body flex-grow-1">
                    <h5 class="card-title"><?php echo $p->nama_produk; ?></h5>
                    <!-- Menampilkan sebagian deskripsi produk (maks 50 karakter) -->
                    <p class="card-text text-muted small"><?php echo substr($p->deskripsi, 0, 50) . '...'; ?></p>
                    <h6 class="fw-bold">Rp <?php echo number_format($p->harga, 0, ',', '.'); ?></h6>
                </div>
                
                <!-- Tombol aksi -->
                <div class="card-footer bg-transparent border-top-0 p-3">
                    <!-- Tombol lihat detail produk -->
                    <a href="<?php echo site_url('home/detail/' . $p->id_produk); ?>" 
                       class="btn btn-outline-primary w-100 mb-2">Lihat Detail</a>

                    <!-- Tombol tambah ke keranjang -->
                    <a href="<?php echo site_url('cart/tambah/' . $p->id_produk); ?>" 
                       class="btn btn-success w-100">
                        <i class="bi bi-cart-plus"></i> Tambah Keranjang
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div> <!-- Akhir container -->
