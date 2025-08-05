<?php
// Mencegah akses langsung ke file via URL
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi class Produk yang merupakan turunan dari MY_Controller
class Produk extends MY_Controller
{
    /**
     * Menambahkan produk ke keranjang berdasarkan ID produk
     *
     * @param int $id_produk ID dari produk yang ingin ditambahkan ke keranjang
     *
     * Catatan:
     * - Saat ini hanya menampilkan pesan simulasi, belum terhubung ke model Cart_model atau database.
     */
    public function tambah_ke_keranjang($id_produk)
    {
        // Ambil ID user yang sedang login dari session
        $id_user = $this->session->userdata('id_user');

        // Tampilkan pesan sebagai simulasi penambahan produk ke keranjang
        echo "Berhasil! Produk ID $id_produk akan ditambahkan ke keranjang milik User ID $id_user.";
    }
}