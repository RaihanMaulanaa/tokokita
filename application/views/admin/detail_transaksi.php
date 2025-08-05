<h2 class="mb-4">Detail Transaksi #INV-<?php echo date('Y', strtotime($transaksi->created_at)) . '-' . $transaksi->id_transaksi; ?></h2>

<!-- Menampilkan notifikasi sukses/error -->
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<div class="row g-4">
    <!-- Kolom Detail Item -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Item yang Dibeli</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_items as $item) : ?>
                                <tr>
                                    <td><?php echo $item->nama_produk; ?></td>
                                    <td class="text-center"><?php echo $item->jumlah; ?></td>
                                    <td class="text-end">Rp <?php echo number_format($item->harga_satuan, 0, ',', '.'); ?></td>
                                    <td class="text-end">Rp <?php echo number_format($item->harga_satuan * $item->jumlah, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total Harga</td>
                                <td class="text-end fs-5 text-success">Rp <?php echo number_format($transaksi->total_harga, 0, ',', '.'); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Kolom Informasi & Aksi Admin -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Informasi & Tindakan</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Pembeli:</strong><br>
                    <?php echo htmlspecialchars($transaksi->nama_pembeli); ?><br>
                    <small class="text-muted"><?php echo htmlspecialchars($transaksi->email_pembeli); ?></small>
                </p>
                <p>
                    <strong>Tanggal Pesanan:</strong><br>
                    <?php echo date('d F Y H:i', strtotime($transaksi->created_at)); ?>
                </p>
                <p>
                    <strong>Status Saat Ini:</strong><br>
                    <span class="badge fs-6
                        <?php if ($transaksi->status == 'pending') echo 'bg-warning text-dark';
                        elseif ($transaksi->status == 'paid') echo 'bg-primary';
                        elseif ($transaksi->status == 'delivered') echo 'bg-success';
                        else echo 'bg-danger'; ?>">
                        <?php echo ucfirst($transaksi->status); ?>
                    </span>
                </p>
                <hr>

                <!-- FORM AKSI ADMIN -->
                <form action="<?php echo site_url('admin/update_status'); ?>" method="post">
                    <input type="hidden" name="id_transaksi" value="<?php echo $transaksi->id_transaksi; ?>">
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Ubah Status Menjadi:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" <?php echo ($transaksi->status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="paid" <?php echo ($transaksi->status == 'paid') ? 'selected' : ''; ?>>Paid</option>
                            <option value="delivered" <?php echo ($transaksi->status == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Status</button>
                </form>
                <!-- AKHIR FORM AKSI ADMIN -->

                <a href="<?php echo site_url('admin/transactions'); ?>" class="btn btn-secondary w-100 mt-2">Kembali</a>
            </div>
        </div>
    </div>
</div>
