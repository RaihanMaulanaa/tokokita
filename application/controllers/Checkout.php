<?php
// Cegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi class Checkout yang mewarisi MY_Controller
class Checkout extends MY_Controller
{
    // Konstruktor: dijalankan saat class diinisialisasi
    public function __construct()
    {
        parent::__construct(); // Panggil konstruktor parent
        $this->load->model('Cart_model');         // Load model untuk mengakses data keranjang
        $this->load->model('Transaction_model');  // Load model untuk mengelola transaksi
        $this->_cek_role('pembeli');              // Hanya user dengan role "pembeli" yang boleh akses controller ini
    }

    // Menampilkan halaman checkout
    public function index()
    {
        $data['judul'] = 'Checkout'; // Judul halaman

        // Ambil ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Ambil semua item dalam keranjang user
        $cart_items = $this->Cart_model->get_cart_by_user($id_user);

        // Jika keranjang kosong, tampilkan pesan error dan redirect ke halaman keranjang
        if (empty($cart_items)) {
            $this->session->set_flashdata('error', 'Keranjang Anda kosong, tidak bisa checkout.');
            redirect('cart');
        }

        // Hitung total harga dari semua item dalam keranjang
        $total_harga = 0;
        foreach ($cart_items as $item) {
            $total_harga += $item->harga * $item->jumlah; // Total = harga satuan x jumlah beli
        }

        // Siapkan data untuk dikirim ke view
        $data['cart_items']  = $cart_items;
        $data['total_harga'] = $total_harga;

        // Tampilkan halaman checkout
        $this->load->view('templates/header', $data);
        $this->load->view('pembeli/checkout', $data); // View khusus untuk pembeli
        $this->load->view('templates/footer');
    }

    // Memproses pesanan saat tombol "Pesan Sekarang" ditekan
    public function proses()
    {
        // Ambil ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Ambil kembali item keranjang user
        $cart_items = $this->Cart_model->get_cart_by_user($id_user);

        // Hitung total harga ulang (agar tidak bisa dimanipulasi dari sisi client)
        $total_harga = 0;
        foreach ($cart_items as $item) {
            $total_harga += $item->harga * $item->jumlah;
        }

        // Panggil model untuk membuat transaksi baru
        $sukses = $this->Transaction_model->create_transaction($cart_items, $total_harga, $id_user);

        // Cek apakah transaksi berhasil disimpan
        if ($sukses) {
            // Tampilkan pesan sukses dan redirect ke halaman utama (atau bisa diarahkan ke halaman riwayat)
            $this->session->set_flashdata('success', 'Pesanan Anda berhasil dibuat!');
            redirect('home');
        } else {
            // Tampilkan pesan error jika gagal
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses pesanan Anda.');
            redirect('checkout');
        }
    }
}