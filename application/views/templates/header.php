<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Menampilkan judul halaman secara dinamis dari variabel PHP $judul -->
    <title><?php echo $judul; ?> - TokoKita</title>

    <!-- Link ke Bootstrap CSS (versi 5.3.3) untuk styling responsif dan komponen UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link ke Bootstrap Icons untuk menampilkan ikon-ikon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Link ke file CSS kustom yang disimpan di folder assets/css/style.css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>

    <!-- NAVBAR: Navigasi utama situs -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">

            <!-- Brand/logo toko -->
            <a class="navbar-brand fw-bold" href="<?php echo site_url('home'); ?>">🛒 TokoKita</a>

            <!-- Tombol toggle untuk tampilan mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Daftar menu navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <!-- CEK: Jika pengguna sudah login -->
                    <?php if ($this->session->userdata('is_login')) : ?>

                        <!-- Cek role pengguna dan tampilkan dashboard sesuai rolenya -->
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard Admin</a></li>
                        <?php elseif ($this->session->userdata('role') == 'penjual') : ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('penjual/dashboard'); ?>">Dashboard Penjual</a></li>
                        <?php elseif ($this->session->userdata('role') == 'pembeli') : ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('home'); ?>">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('cart'); ?>"><i class="bi bi-cart-fill"></i> Keranjang</a></li>
                        <?php endif; ?>

                        <!-- MENU DROPDOWN PROFIL -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <!-- Menampilkan nama user dari session -->
                                <i class="bi bi-person-circle"></i> <?php echo $this->session->userdata('nama_user'); ?>
                            </a>

                            <!-- Isi dropdown -->
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo site_url('profil'); ?>">Profil Saya</a></li>

                                <!-- Tambahan menu khusus untuk role pembeli -->
                                <?php if ($this->session->userdata('role') == 'pembeli') : ?>
                                    <li><a class="dropdown-item" href="<?php echo site_url('pesanan'); ?>">Riwayat Pesanan</a></li>
                                <?php endif; ?>

                                <!-- Garis pemisah -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- Logout -->
                                <li><a class="dropdown-item text-danger" href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>

                        <!-- JIKA BELUM LOGIN: Tampilkan tombol login dan register -->
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('auth/login'); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="<?php echo site_url('auth/register'); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA HALAMAN AKAN DIMUAT DI SINI -->
    <div class="main-container container mt-4">