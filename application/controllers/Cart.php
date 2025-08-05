<?php
// Cegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi class Cart yang mewarisi MY_Controller
class Cart extends MY_Controller
{
    // Konstruktor: dijalankan otomatis saat class dipanggil
    public function __construct()
    {
        parent::__construct(); // Panggil konstruktor dari parent (MY_Controller)
        $this->load->model('Cart_model'); // Memuat model keranjang
        $this->_cek_role('pembeli'); // Mengecek apakah user berperan sebagai 'pembeli'
    }

    // Method untuk menampilkan halaman keranjang belanja
    public function index()
    {
        $data['judul'] = 'Keranjang Belanja'; // Judul halaman

        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Ambil data item dalam keranjang berdasarkan id_user
        $data['cart_items'] = $this->Cart_model->get_cart_by_user($id_user);

        // Tampilkan tampilan keranjang
        $this->load->view('templates/header', $data);
        $this->load->view('pembeli/keranjang', $data); // View khusus pembeli
        $this->load->view('templates/footer');
    }

    // Method untuk menambahkan produk ke keranjang
    public function tambah($id_produk)
    {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Siapkan data yang akan ditambahkan ke keranjang
        $data = [
            'id_user'   => $id_user,
            'id_produk' => $id_produk,
            'jumlah'    => 1 // Default jumlah: 1 item
        ];

        // Simpan data ke database melalui model
        $this->Cart_model->tambah_ke_keranjang($data);

        // Set pesan sukses
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke keranjang!');

        // Arahkan kembali ke halaman home
        redirect('home');
    }

    /**
     * Method untuk menghapus item dari keranjang berdasarkan ID item.
     * @param int $id_cart ID dari item keranjang yang akan dihapus
     */
    public function hapus($id_cart)
    {
        // Hapus item dari database menggunakan model
        $this->Cart_model->hapus_item($id_cart);

        // Tampilkan notifikasi sukses
        $this->session->set_flashdata('success', 'Item berhasil dihapus dari keranjang.');

        // Redirect kembali ke halaman keranjang
        redirect('cart');
    }

    // Method untuk mengupdate jumlah item dalam keranjang
    public function update()
    {
        // Ambil data dari form POST
        $id_cart = $this->input->post('id_cart');     // ID item keranjang yang ingin diubah
        $jumlah  = $this->input->post('jumlah');      // Jumlah baru

        // Siapkan data update
        $data = ['jumlah' => $jumlah];

        // Update data di database melalui model
        $this->Cart_model->update_item($id_cart, $data);

        // Tampilkan pesan sukses dan redirect ke keranjang
        $this->session->set_flashdata('success', 'Jumlah item berhasil diperbarui.');
        redirect('cart');
    }
}