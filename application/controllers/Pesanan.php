<?php
// Mencegah akses langsung ke file
defined('BASEPATH') OR exit('No direct script access allowed');

// Deklarasi class Pesanan yang mewarisi MY_Controller
class Pesanan extends MY_Controller {

    /**
     * Konstruktor: Memuat model transaksi dan membatasi akses ke user dengan role 'pembeli'
     */
    public function __construct() {
        parent::__construct(); // Memanggil konstruktor dari MY_Controller

        // Memuat model Transaction_model yang digunakan untuk transaksi
        $this->load->model('Transaction_model');

        // Memastikan hanya user dengan role 'pembeli' yang bisa mengakses controller ini
        $this->_cek_role('pembeli');
    }

    /**
     * Menampilkan halaman riwayat pesanan pengguna (pembeli)
     * - Mengambil transaksi berdasarkan id_user dari session
     * - Untuk setiap transaksi, ambil detail item yang dibeli
     * - Data dikirim ke view 'riwayat_transaksi'
     */
    public function index() {
        $data['judul'] = 'Riwayat Pesanan Saya'; // Judul halaman

        // Ambil ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Ambil semua transaksi yang dilakukan oleh user ini
        $transactions = $this->Transaction_model->get_transactions_by_user($id_user);

        // Untuk setiap transaksi, ambil detail item (produk, jumlah, harga, dsb.)
        foreach ($transactions as $transaction) {
            // Tambahkan properti 'details' pada objek transaksi yang berisi detail item
            $transaction->details = $this->Transaction_model->get_transaction_details($transaction->id_transaksi);
        }

        // Simpan semua transaksi ke variabel yang akan dikirim ke view
        $data['transactions'] = $transactions;

        // Tampilkan halaman riwayat transaksi dengan data yang sudah dipersiapkan
        $this->load->view('templates/header', $data);
        $this->load->view('pembeli/riwayat_transaksi', $data); // View untuk menampilkan data transaksi
        $this->load->view('templates/footer');
    }
}