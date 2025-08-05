<h2 class="mb-4"><?php echo $judul; ?></h2>

<!-- Notifikasi -->
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
<?php if (validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Kolom Kiri: Profil Pribadi & Ubah Password -->
    <div class="col-lg-6">
        <!-- Kartu Profil Pribadi -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Informasi Pribadi</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('profil/update_profil'); ?>" method="post">
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" value="<?php echo set_value('nama_user', $user->nama_user); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email', $user->email); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Info Pribadi</button>
                </form>
            </div>
        </div>

        <!-- Kartu Ubah Password -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('profil/update_password'); ?>" method="post">
                    <div class="mb-3">
                        <label for="password_lama" class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" id="password_lama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password_baru" class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" id="password_baru" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Profil Toko (HANYA UNTUK PENJUAL) -->
    <?php if ($this->session->userdata('role') == 'penjual') : ?>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Profil Toko Anda</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('profil/update_profil_toko'); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_toko" class="form-label">Nama Toko</label>
                            <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="<?php echo set_value('nama_toko', isset($toko->nama_toko) ? $toko->nama_toko : ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_toko" class="form-label">Deskripsi Toko</label>
                            <textarea name="deskripsi_toko" id="deskripsi_toko" class="form-control" rows="5"><?php echo set_value('deskripsi_toko', isset($toko->deskripsi_toko) ? $toko->deskripsi_toko : ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="logo_toko" class="form-label">Logo Toko</label>
                            <?php if (isset($toko->logo_toko) && $toko->logo_toko != 'default_logo.png') : ?>
                                <img src="<?php echo base_url('uploads/logo/' . $toko->logo_toko); ?>" alt="Logo Toko" class="img-thumbnail d-block mb-2" width="150">
                            <?php endif; ?>
                            <input type="file" name="logo_toko" id="logo_toko" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah logo. (Maks 1MB)</small>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Profil Toko</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>