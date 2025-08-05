<!-- Container utama dengan margin atas -->
<div class="container mt-5">
    <!-- Judul halaman keranjang -->
    <h2 class="mb-4">Keranjang Belanja Anda</h2>

    <!-- Kartu untuk membungkus isi keranjang -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Cek apakah keranjang tidak kosong -->
            <?php if (!empty($cart_items)): ?>

                <!-- Tabel responsif untuk menampilkan item di keranjang -->
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50%;">Produk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center" style="width: 15%;">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Inisialisasi total harga -->
                            <?php $total_harga = 0; ?>

                            <!-- Loop semua item di keranjang -->
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Gambar produk -->
                                            <img src="<?php echo base_url('uploads/produk/' . $item->gambar_produk); ?>" width="80" class="me-3 rounded" alt="<?php echo $item->nama_produk; ?>">
                                            <div>
                                                <!-- Nama produk -->
                                                <h6 class="mb-0"><?php echo $item->nama_produk; ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Harga satuan produk -->
                                    <td class="text-center">Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></td>

                                    <!-- Form untuk mengubah jumlah produk -->
                                    <td class="text-center">
                                        <?php echo form_open('cart/update', ['class' => 'd-flex justify-content-center']); ?>
                                            <!-- Hidden ID cart -->
                                            <input type="hidden" name="id_cart" value="<?php echo $item->id_cart; ?>">
                                            <!-- Input jumlah -->
                                            <input type="number" class="form-control text-center" name="jumlah" value="<?php echo $item->jumlah; ?>" min="1" style="width: 70px;">
                                            <!-- Tombol update jumlah -->
                                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        <?php echo form_close(); ?>
                                    </td>

                                    <!-- Hitung subtotal dan tampilkan -->
                                    <td class="text-end">
                                        <?php
                                        $subtotal = $item->harga * $item->jumlah;
                                        $total_harga += $subtotal;
                                        echo 'Rp ' . number_format($subtotal, 0, ',', '.');
                                        ?>
                                    </td>

                                    <!-- Tombol hapus item dari keranjang -->
                                    <td class="text-center">
                                        <a href="<?php echo site_url('cart/hapus/' . $item->id_cart); ?>" onclick="return confirm('Yakin ingin menghapus item ini?')" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Ringkasan belanja di bagian bawah -->
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <h4>Ringkasan Belanja</h4>
                        <ul class="list-group list-group-flush">
                            <!-- Total harga semua item -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total Harga</span>
                                <strong class="fs-5 text-success">Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></strong>
                            </li>
                        </ul>

                        <!-- Tombol checkout -->
                        <div class="d-grid mt-3">
                            <a href="<?php echo site_url('checkout'); ?>" class="btn btn-primary btn-lg">Lanjutkan ke Checkout</a>
                        </div>
                    </div>
                </div>

            <!-- Jika keranjang kosong -->
            <?php else: ?>
                <div class="text-center p-5">
                    <!-- Icon keranjang kosong -->
                    <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
                    <h4 class="mt-3">Keranjang Anda Masih Kosong</h4>
                    <p>Yuk, mulai belanja dan temukan produk impian Anda!</p>
                    <!-- Tombol kembali ke halaman utama -->
                    <a href="<?php echo site_url('home'); ?>" class="btn btn-primary">Mulai Belanja</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>