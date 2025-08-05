<h2 class="mb-4">Edit Pengguna: <?php echo htmlspecialchars($user->nama_user); ?></h2>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <?php echo form_open('admin/proses_edit_user/' . $user->id_user); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_user" value="<?php echo $user->nama_user; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Peran (Role)</label>
                        <select class="form-select" name="role" required>
                            <option value="admin" <?php if($user->role == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="penjual" <?php if($user->role == 'penjual') echo 'selected'; ?>>Penjual</option>
                            <option value="pembeli" <?php if($user->role == 'pembeli') echo 'selected'; ?>>Pembeli</option>
                        </select>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" name="password">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-secondary">Batal</a>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
