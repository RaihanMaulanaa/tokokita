<!-- Baris utama dengan posisi tengah dan margin atas -->
<div class="row justify-content-center mt-5">
    <!-- Kolom dengan lebar 6 dari 12 kolom grid pada layar md -->
    <div class="col-md-6">
        <!-- Kartu form registrasi dengan bayangan -->
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <!-- Judul form -->
                <h3 class="card-title text-center mb-4">Daftar Akun Baru</h3>
                
                <!-- Menampilkan error validasi jika ada (dibungkus dalam alert berwarna merah) -->
                <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                
                <!-- Form registrasi dimulai. Data dikirim ke controller 'auth' method 'register' -->
                <?php echo form_open('auth/register'); ?>
                    
                    <!-- Input nama lengkap -->
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_user" value="<?php echo set_value('nama_user'); ?>" required>
                    </div>

                    <!-- Input email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" required>
                    </div>

                    <!-- Input password dan konfirmasi password dalam dua kolom -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirm" required>
                        </div>
                    </div>

                    <!-- Dropdown untuk memilih peran (role) sebagai pembeli atau penjual -->
                    <div class="mb-3">
                        <label class="form-label">Daftar Sebagai</label>
                        <select class="form-select" name="role" required>
                            <option value="">-- Pilih Peran --</option>
                            <option value="pembeli" <?php echo set_select('role', 'pembeli'); ?>>Pembeli</option>
                            <option value="penjual" <?php echo set_select('role', 'penjual'); ?>>Penjual</option>
                        </select>
                    </div>

                    <!-- Tombol submit untuk mendaftar -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>

                <?php echo form_close(); ?>
                <!-- Form registrasi selesai -->

                <!-- Link ke halaman login jika pengguna sudah punya akun -->
                <p class="text-center mt-4">
                    Sudah punya akun? <a href="<?php echo site_url('auth/login'); ?>">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>