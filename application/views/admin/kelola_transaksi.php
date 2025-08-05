<h2 class="mb-4">Kelola Semua Transaksi</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $trx): ?>
                            <tr>
                                <td>#INV-<?php echo date('Y', strtotime($trx->created_at)) . '-' . $trx->id_transaksi; ?></td>
                                <td><?php echo htmlspecialchars($trx->nama_pembeli); ?></td>
                                <td><?php echo date('d F Y', strtotime($trx->created_at)); ?></td>
                                <td>Rp <?php echo number_format($trx->total_harga, 0, ',', '.'); ?></td>
                                <td>
                                    <span class="badge 
                                    <?php if ($trx->status == 'pending') echo 'bg-warning text-dark';
                                    elseif ($trx->status == 'paid') echo 'bg-primary';
                                    else echo 'bg-success'; ?>">
                                        <?php echo ucfirst($trx->status); ?>
                                    </span>
                                </td>
                                <td><a href="<?php echo site_url('admin/detail_transaksi/' . $trx->id_transaksi); ?>" class="btn btn-sm btn-info">Detail</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-4">Belum ada transaksi di marketplace.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>