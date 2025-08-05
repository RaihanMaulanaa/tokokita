<?php
// Mencegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi class Transaction_model sebagai turunan dari CI_Model
class Transaction_model extends CI_Model
{
    /**
     * Membuat transaksi baru: menyimpan ke tabel 'transactions',
     * 'transaction_details', mengurangi stok produk, dan mengosongkan keranjang.
     *
     * @param array $cart_items Daftar item dalam keranjang
     * @param float $total_harga Total harga keseluruhan transaksi
     * @param int $id_pembeli ID user pembeli
     * @return bool Status keberhasilan transaksi
     */
    public function create_transaction($cart_items, $total_harga, $id_pembeli)
    {
        // Memulai transaksi database (atomic transaction)
        $this->db->trans_start();

        // 1. Simpan transaksi utama ke tabel 'transactions'
        $transaction_data = [
            'id_pembeli'  => $id_pembeli,
            'total_harga' => $total_harga,
            'status'      => 'pending' // default status saat awal transaksi
        ];
        $this->db->insert('transactions', $transaction_data);
        // Ambil ID transaksi yang baru saja dibuat
        $id_transaksi = $this->db->insert_id();

        // 2. Simpan setiap item dari keranjang ke tabel 'transaction_details' 
        //    dan kurangi stok di tabel produk
        foreach ($cart_items as $item) {
            // Simpan detail produk ke dalam transaction_details
            $detail_data = [
                'id_transaksi' => $id_transaksi,
                'id_produk'    => $item->id_produk,
                'jumlah'       => $item->jumlah,
                'harga_satuan' => $item->harga
            ];
            $this->db->insert('transaction_details', $detail_data);

            // Kurangi stok dari produk tersebut di tabel 'products'
            $this->db->set('stok', 'stok - ' . (int)$item->jumlah, FALSE); // FALSE agar nilai tidak di-escape
            $this->db->where('id_produk', $item->id_produk);
            $this->db->update('products');
        }

        // 3. Kosongkan keranjang milik user yang telah melakukan transaksi
        $this->db->where('id_user', $id_pembeli);
        $this->db->delete('cart');

        // Selesaikan transaksi database
        $this->db->trans_complete();

        // Return status berhasil atau gagal transaksi
        return $this->db->trans_status();
    }

    /**
     * Mengambil semua transaksi milik user tertentu (pembeli).
     * @param int $id_pembeli ID user pembeli
     * @return array Daftar transaksi user tersebut
     */
    public function get_transactions_by_user($id_pembeli)
    {
        // Filter berdasarkan ID pembeli
        $this->db->where('id_pembeli', $id_pembeli);
        // Urutkan berdasarkan waktu dibuat secara descending (terbaru di atas)
        $this->db->order_by('created_at', 'DESC');
        // Ambil semua transaksi dan kembalikan sebagai array objek
        return $this->db->get('transactions')->result();
    }

    /**
     * Mengambil detail item dari suatu transaksi tertentu.
     * Menggunakan JOIN ke tabel produk untuk menampilkan nama produk.
     *
     * @param int $id_transaksi ID transaksi yang ingin diambil detailnya
     * @return array Daftar item produk dalam transaksi tersebut
     */
    public function get_transaction_details($id_transaksi)
    {
        // Ambil data dari tabel 'transaction_details' dengan alias 'td'
        $this->db->select('td.*, p.nama_produk');
        $this->db->from('transaction_details td');
        // Join dengan tabel 'products' untuk ambil nama produk
        $this->db->join('products p', 'td.id_produk = p.id_produk');
        // Filter berdasarkan ID transaksi
        $this->db->where('td.id_transaksi', $id_transaksi);
        // Eksekusi query dan kembalikan hasil
        return $this->db->get()->result();
    }

    /**
     * Mengambil semua data transaksi dari database untuk admin.
     * @return array
     */
    public function get_all_transactions()
    {
        $this->db->select('transactions.*, users.nama_user as nama_pembeli');
        $this->db->from('transactions');
        $this->db->join('users', 'transactions.id_pembeli = users.id_user');
        $this->db->order_by('created_at', 'DESC'); // Tampilkan yang terbaru di atas
        return $this->db->get()->result();
    }

    /**
     * Mengambil satu data transaksi berdasarkan ID-nya
     *
     * @param int $id_transaksi
     * @return object|null
     */
    public function get_transaction_by_id($id_transaksi)
    {
        $this->db->select('transactions.*, users.nama_user as nama_pembeli, users.email as email_pembeli'); // ← tambahkan users.email
        $this->db->from('transactions');
        $this->db->join('users', 'transactions.id_pembeli = users.id_user');
        $this->db->where('transactions.id_transaksi', $id_transaksi);
        return $this->db->get()->row();
    }

    /**
     * Mengupdate data transaksi di database.
     *
     * @param int $id_transaksi ID transaksi yang akan diupdate
     * @param array $data Data baru yang akan disimpan
     * @return bool
     */
    public function update_transaction($id_transaksi, $data)
    {
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('transactions', $data);
    }
}