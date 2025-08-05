<!-- Container utama dengan margin atas -->
<div class="container mt-5">
    <!-- Judul halaman -->
    <h2 class="mb-4">Riwayat Transaksi Anda</h2>

    <!-- Komponen accordion Bootstrap untuk menampilkan setiap transaksi -->
    <div class="accordion" id="accordionHistory">

        <!-- Cek apakah ada data transaksi -->
        <?php if (!empty($transactions)): ?>

            <!-- Loop semua transaksi -->
            <?php foreach ($transactions as $index => $trx): ?>
                <div class="accordion-item">
                    <!-- Header setiap transaksi sebagai tombol untuk expand/collapse -->
                    <h2 class="accordion-header" id="heading<?php echo $trx->id_transaksi; ?>">
                        <button class="accordion-button <?php echo $index == 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $trx->id_transaksi; ?>">

                            <!-- Informasi ringkas transaksi di bagian tombol -->
                            <div class="d-flex w-100 justify-content-between">
                                <!-- ID Pesanan dengan format INV-Tahun-ID -->
                                <span><strong>ID Pesanan:</strong> #INV-<?php echo date('Y', strtotime($trx->created_at)) . '-' . $trx->id_transaksi; ?></span>

                                <!-- Total harga transaksi -->
                                <span><strong>Total:</strong> Rp <?php echo number_format($trx->total_harga, 0, ',', '.'); ?></span>

                                <!-- Badge status pesanan -->
                                <span class="badge me-3  
                                    <?php 
                                    if ($trx->status == 'pending') echo 'bg-warning text-dark';
                                    elseif ($trx->status == 'paid') echo 'bg-primary';
                                    else echo 'bg-success'; ?>">
                                    <?php echo ucfirst($trx->status); ?>
                                </span>
                            </div>
                        </button>
                    </h2>

                    <!-- Konten yang ditampilkan saat accordion dibuka -->
                    <div id="collapse<?php echo $trx->id_transaksi; ?>" class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : ''; ?>" data-bs-parent="#accordionHistory">
                        <div class="accordion-body">
                            <!-- Tanggal transaksi -->
                            <strong>Tanggal Pesanan:</strong> <?php echo date('d F Y H:i', strtotime($trx->created_at)); ?> <br>

                            <!-- Detail item dalam transaksi -->
                            <strong>Detail Item:</strong>
                            <ul>
                                <?php foreach ($trx->details as $detail): ?>
                                    <li>
                                        <?php echo $detail->nama_produk; ?> 
                                        (<?php echo $detail->jumlah; ?> x Rp <?php echo number_format($detail->harga_satuan, 0, ',', '.'); ?>)
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <!-- Jika belum ada transaksi sama sekali -->
        <?php else: ?>
            <div class="text-center p-5">
                <!-- Icon kosong -->
                <i class="bi bi-receipt" style="font-size: 5rem; color: #ccc;"></i>
                <h4 class="mt-3">Anda Belum Memiliki Riwayat Transaksi</h4>
                <p>Semua pesanan yang Anda buat akan muncul di sini.</p>

                <!-- Tombol kembali ke halaman utama -->
                <a href="<?php echo site_url('home'); ?>" class="btn btn-primary">Mulai Belanja</a>
            </div>
        <?php endif; ?>
    </div>
</div>