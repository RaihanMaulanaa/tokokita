<?php
// Cegah akses langsung ke file
defined('BASEPATH') OR exit('No direct script access allowed');

// Controller untuk halaman utama
class Home extends CI_Controller {

    // Konstruktor: dijalankan saat class diinisialisasi
    public function __construct() {
        parent::__construct(); // Panggil konstruktor dari CI_Controller
        $this->load->model('Produk_model'); // Load model produk
    }

    // ==========================
    // Fungsi: Tampilkan Beranda
    // ==========================
    public function index() {
        $data['judul'] = 'Selamat Datang di TokoKita'; // Judul halaman

        // Ambil semua produk dari database melalui model
        $data['produk'] = $this->Produk_model->get_all_produk();

        // Load view beranda
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    // ======================================
    // Fungsi: Tampilkan Detail Produk Spesifik
    // @param int $id_produk -> ID dari produk
    // ======================================
    public function detail($id_produk) {
        // Ambil data produk berdasarkan ID dari model
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        // Jika produk tidak ditemukan, tampilkan halaman 404
        if (!$data['produk']) {
            show_404();
        }

        // Gunakan nama produk sebagai judul halaman
        $data['judul'] = $data['produk']->nama_produk;

        // Tampilkan view detail produk
        $this->load->view('templates/header', $data);
        $this->load->view('home/detail', $data);
        $this->load->view('templates/footer');
    }
}