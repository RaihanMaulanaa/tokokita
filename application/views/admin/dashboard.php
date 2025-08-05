<h2 class="mb-4">Dashboard Admin</h2>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Pengguna</h5>
                        <!-- Menggunakan variabel dari controller -->
                        <p class="card-text fs-3 fw-bold"><?php echo $total_users; ?></p>
                    </div>
                    <i class="bi bi-people-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Produk</h5>
                        <!-- Menggunakan variabel dari controller -->
                        <p class="card-text fs-3 fw-bold"><?php echo $total_products; ?></p>
                    </div>
                    <i class="bi bi-box-seam-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Transaksi</h5>
                        <!-- Menggunakan variabel dari controller -->
                        <p class="card-text fs-3 fw-bold"><?php echo $total_transactions; ?></p>
                    </div>
                    <i class="bi bi-receipt-cutoff" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Menu Manajemen</h5>
    </div>
    <div class="card-body">
        <p>Pilih menu di bawah ini untuk mengelola data pada platform TokoKita.</p>
        <div class="list-group">
            <a href="<?php echo site_url('admin/users'); ?>" class="list-group-item list-group-item-action">Kelola Pengguna</a>
            <a href="<?php echo site_url('admin/products'); ?>" class="list-group-item list-group-item-action">Kelola Semua Produk</a>
            <a href="<?php echo site_url('admin/transactions'); ?>" class="list-group-item list-group-item-action">Kelola Semua Transaksi</a>
        </div>
    </div>
</div>