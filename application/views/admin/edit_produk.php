<h2 class="mb-4"><?php echo $judul; ?></h2>

<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <!-- Form menggunakan multipart karena ada upload file -->
        <form action="<?php echo site_url('admin/proses_edit_produk/' . $produk->id_produk); ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?php echo set_value('nama_produk', $produk->nama_produk); ?>">
                <?php echo form_error('nama_produk', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?php echo set_value('deskripsi', $produk->deskripsi); ?></textarea>
                <?php echo form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga" id="harga" class="form-control" value="<?php echo set_value('harga', $produk->harga); ?>">
                    </div>
                    <?php echo form_error('harga', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="<?php echo set_value('stok', $produk->stok); ?>">
                    <?php echo form_error('stok', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Ganti Gambar Produk (Opsional)</label>
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Gambar Saat Ini:</strong></p>
                        <img src="<?php echo base_url('uploads/produk/' . $produk->gambar_produk); ?>" class="img-thumbnail" alt="Gambar Produk">
                    </div>
                    <div class="col-md-9">
                        <p><strong>Upload Gambar Baru:</strong></p>
                        <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Maksimal 2MB (jpg, png, gif).</small>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end">
                <a href="<?php echo site_url('admin/products'); ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>
