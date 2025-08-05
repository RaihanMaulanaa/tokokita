-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2025 pada 07.25
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokokita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_produk`, `jumlah`) VALUES
(2, 3, 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar_produk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_produk`, `id_user`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar_produk`, `created_at`) VALUES
(1, 2, 'MELISSA SOLAR TWIST AD', 'Produk sandal Melissa original.', '850000.00', 8, 'produk_1.jpg', '2025-07-31 03:00:00'),
(2, 2, 'MELISSA SOLAR TWIST AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_2.jpg', '2025-07-31 03:00:00'),
(3, 2, 'MELISSA SOLAR TWIST AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_3.jpg', '2025-07-31 03:00:00'),
(4, 2, 'MELISSA SOLAR TWIST AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_4.jpg', '2025-07-31 03:00:00'),
(5, 2, 'MELISSA HEAT SANDAL AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_5.jpg', '2025-07-31 03:00:00'),
(6, 2, 'MELISSA HEAT SANDAL AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_6.jpg', '2025-07-31 03:00:00'),
(7, 2, 'MELISSA HEAT SANDAL AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_7.jpg', '2025-07-31 03:00:00'),
(8, 2, 'MELISSA HEAT SANDAL AD', 'Produk sandal Melissa original.', '850000.00', 10, 'produk_8.jpg', '2025-07-31 03:00:00'),
(9, 2, 'MELISSA CASSIE AD', 'Produk sandal Melissa original.', '720000.00', 10, 'produk_9.jpg', '2025-07-31 03:00:00'),
(10, 2, 'MELISSA CASSIE AD', 'Produk sandal Melissa original.', '720000.00', 10, 'produk_10.jpg', '2025-07-31 03:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id_transaksi` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','delivered') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id_transaksi`, `id_pembeli`, `total_harga`, `status`, `created_at`) VALUES
(1, 3, '850000.00', 'pending', '2025-07-31 11:19:12'),
(2, 3, '1700000.00', 'pending', '2025-07-31 11:43:45'),
(3, 3, '850000.00', 'pending', '2025-08-01 10:19:11'),
(4, 4, '850000.00', 'pending', '2025-08-02 07:13:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga_satuan`) VALUES
(1, 1, 4, 1, '850000.00'),
(2, 2, 3, 1, '850000.00'),
(3, 2, 8, 1, '850000.00'),
(4, 3, 1, 1, '850000.00'),
(5, 4, 1, 1, '850000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','penjual','pembeli') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin Utama', 'admin@tokokita.com', '$2y$10$S/8jhzH/.1JZPHxb2IokieCtZPnLVBHu5e/PHrCxUFq.4ho4/moHa', 'admin', '2025-07-30 08:48:45'),
(2, 'penjual1', 'penjual1@gmail.com', '$2y$10$YDGTRhQV6SFhErJT4o.UzeFomOPWdfJPIrrMijkqlnnJiX7jfL2Wm', 'penjual', '2025-07-30 14:36:31'),
(3, 'pembeli1', 'pembeli1@gmail.com', '$2y$10$VmM/oLr7GweAVKyAifbY.u/SGt.EnkqKOYeKaJkyiVy78BTCWtm0y', 'pembeli', '2025-07-31 10:51:34'),
(4, 'pembeli2', 'pembeli2@gmail.com', '$2y$10$OwF0UGUlfzkCyxD6bMZVCOlKcdQqxD8RusATrt9D37gn8OgV45vKa', 'pembeli', '2025-08-02 07:01:48'),
(5, 'pembeli3', 'pembeli3@gmail.com', '$2y$10$KS86raVmgjR/8falSmLNQexFDSmUgCHzJZ2MyFED3.r444Utkj5EG', 'pembeli', '2025-08-04 02:11:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `fk_cart_user` (`id_user`),
  ADD KEY `fk_cart_produk` (`id_produk`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_produk_user` (`id_user`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_user` (`id_pembeli`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_transaksi` (`id_transaksi`),
  ADD KEY `fk_detail_produk` (`id_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_produk` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_produk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`id_pembeli`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transactions` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
