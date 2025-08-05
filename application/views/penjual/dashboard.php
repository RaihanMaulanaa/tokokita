<h2 class="mb-4">Dashboard Penjual</h2>
<a href="<?php echo site_url('penjual/tambah_produk'); ?>" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah Produk Baru</a>

<!-- Notifikasi -->
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header">
        <h5>Daftar Produk Anda</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produk)): ?>
                        <?php foreach($produk as $p): ?>
                        <tr>
                            <td><img src="<?php echo base_url('uploads/produk/' . $p->gambar_produk); ?>" width="80" class="rounded"></td>
                            <td><?php echo htmlspecialchars($p->nama_produk); ?></td>
                            <td>Rp <?php echo number_format($p->harga, 0, ',', '.'); ?></td>
                            <td><?php echo $p->stok; ?></td>
                            <td>
                                <a href="<?php echo site_url('penjual/edit_produk/' . $p->id_produk); ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="<?php echo site_url('penjual/hapus_produk/' . $p->id_produk); ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Anda belum memiliki produk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>