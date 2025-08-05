<!-- Baris utama dengan posisi tengah dan margin atas -->
<div class="row justify-content-center mt-5">
    <!-- Kolom berukuran sedang (lebar 5 kolom pada layar md ke atas) -->
    <div class="col-md-5">
        <!-- Kartu login dengan bayangan halus -->
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <!-- Judul halaman login -->
                <h3 class="card-title text-center mb-4">Login ke TokoKita</h3>
                
                <!-- Menampilkan pesan sukses jika ada flashdata 'success' -->
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                        <!-- Tombol untuk menutup alert -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Menampilkan pesan error jika ada flashdata 'error' -->
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Form login dimulai -->
                <?php echo form_open('auth/login'); ?>
                    <!-- Input email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Input password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Tombol submit login -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                <?php echo form_close(); ?>
                <!-- Form login selesai -->

                <!-- Link ke halaman registrasi untuk user yang belum punya akun -->
                <p class="text-center mt-4">
                    Belum punya akun? <a href="<?php echo site_url('auth/register'); ?>">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>