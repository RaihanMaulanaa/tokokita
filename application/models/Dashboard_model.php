<?php
// Mencegah akses langsung ke file melalui URL
defined('BASEPATH') OR exit('No direct script access allowed');

// Deklarasi class Dashboard_model yang mewarisi CI_Model
class Dashboard_model extends CI_Model {

    /**
     * Menghitung jumlah total pengguna di tabel 'users'
     * @return int Jumlah seluruh pengguna
     */
    public function count_users() {
        return $this->db->count_all('users'); // Mengembalikan total baris di tabel users
    }

    /**
     * Menghitung jumlah total produk di tabel 'products'
     * @return int Jumlah seluruh produk
     */
    public function count_products() {
        return $this->db->count_all('products'); // Mengembalikan total baris di tabel products
    }

    /**
     * Menghitung jumlah total transaksi di tabel 'transactions'
     * @return int Jumlah seluruh transaksi
     */
    public function count_transactions() {
        return $this->db->count_all('transactions'); // Mengembalikan total baris di tabel transactions
    }
}
