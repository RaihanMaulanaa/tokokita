<?php
// Mencegah akses langsung ke file melalui URL
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi model Produk_model, turunan dari CI_Model
class Produk_model extends CI_Model
{
    /**
     * Mengambil semua data produk dari tabel 'products',
     * termasuk nama penjual dari tabel 'users'.
     * @return array Daftar produk beserta nama penjual
     */
    public function get_all_produk()
    {
        // Ambil semua kolom dari tabel products dan nama_user dari tabel users
        $this->db->select('products.*, users.nama_user as nama_penjual');
        $this->db->from('products');
        // Lakukan join dengan tabel users untuk mendapatkan nama penjual
        $this->db->join('users', 'products.id_user = users.id_user');
        // Eksekusi query dan kembalikan hasilnya dalam bentuk array objek
        return $this->db->get()->result();
    }

    /**
     * Mengambil satu data produk berdasarkan ID produk.
     * @param int $id_produk ID produk yang dicari
     * @return object Data produk dalam bentuk objek
     */
    public function get_produk_by_id($id_produk)
    {
        // Ambil baris dari tabel products yang memiliki ID sesuai
        return $this->db->get_where('products', ['id_produk' => $id_produk])->row();
    }

    /**
     * Mengambil semua data produk yang dimiliki oleh user/penjual tertentu.
     * @param int $id_user ID user pemilik produk
     * @return array Daftar produk milik user tersebut
     */
    public function get_produk_by_user($id_user)
    {
        // Ambil semua produk yang dibuat oleh user tertentu
        return $this->db->get_where('products', ['id_user' => $id_user])->result();
    }

    /**
     * Menambahkan produk baru ke dalam tabel 'products'.
     * @param array $data Data produk yang akan disimpan
     * @return bool True jika berhasil, False jika gagal
     */
    public function insert_produk($data)
    {
        // Simpan data ke tabel products
        return $this->db->insert('products', $data);
    }

    /**
     * Memperbarui data produk berdasarkan ID produk.
     * @param int $id_produk ID produk yang ingin diperbarui
     * @param array $data Data baru untuk produk tersebut
     * @return bool True jika berhasil, False jika gagal
     */
    public function update_produk($id_produk, $data)
    {
        // Tentukan ID produk sebagai kondisi WHERE
        $this->db->where('id_produk', $id_produk);
        // Lakukan update terhadap data yang diberikan
        return $this->db->update('products', $data);
    }

    /**
     * Menghapus data produk berdasarkan ID-nya.
     * @param int $id_produk ID produk yang ingin dihapus
     * @return bool True jika berhasil, False jika gagal
     */
    public function delete_produk($id_produk)
    {
        // Hapus data dari tabel products berdasarkan ID produk
        return $this->db->delete('products', ['id_produk' => $id_produk]);
    }
}