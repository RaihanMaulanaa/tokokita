<?php
// Mencegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi model Cart_model yang mewarisi CI_Model
class Cart_model extends CI_Model
{
    /**
     * Menambahkan item baru ke dalam tabel keranjang.
     * @param array $data Data yang berisi id_user, id_produk, dan jumlah.
     * @return bool True jika insert berhasil, false jika gagal.
     */
    public function tambah_ke_keranjang($data)
    {
        // Catatan: jika ingin mencegah duplikasi produk, bisa tambahkan logika cek sebelum insert.
        return $this->db->insert('cart', $data); // Menyisipkan data ke tabel cart
    }

    /**
     * Mengambil semua item keranjang untuk user tertentu,
     * disertai detail produk (nama, harga, gambar).
     * @param int $id_user ID user yang sedang login.
     * @return array Array objek berisi data keranjang dan produk.
     */
    public function get_cart_by_user($id_user)
    {
        // Menentukan kolom yang akan diambil
        $this->db->select('
            cart.id_cart,
            cart.jumlah,
            products.id_produk,
            products.nama_produk,
            products.harga,
            products.gambar_produk
        ');
        $this->db->from('cart'); // Tabel utama: cart

        // Gabungkan tabel products berdasarkan id_produk
        $this->db->join('products', 'cart.id_produk = products.id_produk');

        // Filter data berdasarkan id_user (pemilik keranjang)
        $this->db->where('cart.id_user', $id_user);

        // Ambil hasil sebagai array objek
        return $this->db->get()->result();
    }

    /**
     * Menghapus 1 item dari keranjang berdasarkan ID keranjang.
     * @param int $id_cart ID unik item keranjang yang ingin dihapus.
     * @return bool True jika berhasil dihapus.
     */
    public function hapus_item($id_cart)
    {
        // Eksekusi DELETE berdasarkan id_cart
        return $this->db->delete('cart', ['id_cart' => $id_cart]);
    }

    /**
     * Memperbarui jumlah produk pada item keranjang tertentu.
     * @param int $id_cart ID item keranjang yang akan diperbarui.
     * @param array $data Data baru, biasanya hanya ['jumlah' => nilai_baru].
     * @return bool True jika update berhasil.
     */
    public function update_item($id_cart, $data)
    {
        // Tentukan item berdasarkan id_cart
        $this->db->where('id_cart', $id_cart);

        // Update kolom berdasarkan data baru
        return $this->db->update('cart', $data);
    }

    /**
     * Menghapus semua item keranjang milik user tertentu.
     * @param int $id_user ID user yang keranjangnya ingin dikosongkan.
     * @return bool True jika berhasil dihapus.
     */
    public function hapus_semua_item($id_user)
    {
        return $this->db->delete('cart', ['id_user' => $id_user]);
    }
}