<h2 class="mb-4"><?php echo $judul; ?></h2>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tampilkan error validasi -->
                <?php echo validation_errors('<div class="alert alert-danger p-2">', '</div>'); ?>

                <!-- Form mengarah ke method proses_tambah_user -->
                <?php echo form_open('admin/proses_tambah_user'); ?>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?php echo set_value('nama_user'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Peran (Role)</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
                            <option value="penjual" <?php echo set_select('role', 'penjual'); ?>>Penjual</option>
                            <option value="pembeli" <?php echo set_select('role', 'pembeli'); ?>>Pembeli</option>
                        </select>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Pengguna
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
