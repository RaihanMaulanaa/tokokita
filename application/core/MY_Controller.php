<?php
// Mencegah akses langsung ke file
defined('BASEPATH') OR exit('No direct script access allowed');

// Deklarasi class MY_Controller sebagai controller induk (base controller) untuk controller lain
class MY_Controller extends CI_Controller {

    // Konstruktor: Akan otomatis dijalankan saat objek dibuat (saat controller anak dijalankan)
    public function __construct() {
        // Memanggil konstruktor induk (CI_Controller)
        parent::__construct();

        // Mengecek apakah pengguna sudah login dengan memeriksa session 'is_login'
        if (!$this->session->userdata('is_login')) {
            // Jika belum login, set pesan error ke flashdata
            $this->session->set_flashdata('error', 'Anda harus login terlebih dahulu.');

            // Arahkan pengguna ke halaman login
            redirect('auth/login');
        }
    }

    /**
     * Fungsi tambahan untuk membatasi akses berdasarkan peran (role).
     * Cocok digunakan untuk membedakan hak akses admin, kasir, manajer, dll.
     * @param mixed $roles Peran tunggal (string) atau array peran yang diizinkan
     */
    protected function _cek_role($roles) {
        // Ubah menjadi array jika input bukan array
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        // Ambil role pengguna dari session
        $user_role = $this->session->userdata('role');

        // Jika role pengguna tidak termasuk dalam daftar role yang diizinkan
        if (!in_array($user_role, $roles)) {
            // Tampilkan error 403 Forbidden (akses ditolak)
            show_error(
                'Anda tidak memiliki hak akses untuk mengunjungi halaman ini.',
                403,
                'Akses Ditolak'
            );
        }
    }
}
