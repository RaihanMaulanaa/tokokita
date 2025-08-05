<h2 class="mb-4">Kelola Semua Produk</h2>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produk)) : ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <td><img src="<?php echo base_url('uploads/produk/' . $p->gambar_produk); ?>" width="80" class="rounded"></td>
                                <td><?php echo htmlspecialchars($p->nama_produk); ?></td>
                                <td><?php echo htmlspecialchars($p->nama_penjual); ?></td>
                                <td>Rp <?php echo number_format($p->harga, 0, ',', '.'); ?></td>
                                <td><?php echo $p->stok; ?></td>
                                <td>
                                    <!-- TOMBOL EDIT BARU -->
                                    <a href="<?php echo site_url('admin/edit_produk/' . $p->id_produk); ?>" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                    
                                    <a href="<?php echo site_url('admin/hapus_produk_admin/' . $p->id_produk); ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada produk di marketplace.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>