<h2 class="mb-4">Tambah Produk Baru</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Menampilkan error upload jika ada -->
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <!-- Menampilkan error validasi form -->
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open_multipart('penjual/proses_tambah'); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" value="<?php echo set_value('nama_produk'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="4"><?php echo set_value('deskripsi'); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" name="harga" value="<?php echo set_value('harga'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" value="<?php echo set_value('stok'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" name="gambar_produk" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    <a href="<?php echo site_url('penjual/dashboard'); ?>" class="btn btn-secondary">Batal</a>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>