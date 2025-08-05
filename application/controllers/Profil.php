<?php
/**
 * Controller Profil
 *
 * Menangani tampilan dan pembaruan data profil pengguna maupun toko.
 * Hanya dapat diakses jika user telah login.
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Pastikan user sudah login untuk mengakses halaman ini
        if (!$this->session->userdata('is_login')) {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Toko_model');
    }

    /**
     * Menampilkan halaman utama profil pengguna.
     * Data pengguna diambil berdasarkan ID user dari session.
     */
    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $id_user = $this->session->userdata('id_user');

        // Ambil data terbaru pengguna dari database
        $data['user'] = $this->User_model->get_user_by_id($id_user);

        // Jika user tidak ditemukan, redirect ke login
        if (!$data['user']) {
            redirect('auth/login');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('profil/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Memproses pembaruan profil pengguna (nama lengkap & email).
     * Jika email berubah, divalidasi agar unik.
     */
    public function update_profil()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->User_model->get_user_by_id($id_user);

        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');

        // Jika email diubah, terapkan validasi is_unique
        if ($this->input->post('email') != $user->email) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
                'is_unique' => 'Email ini sudah terdaftar!'
            ]);
        }

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'nama_user' => $this->input->post('nama_user'),
                'email'     => $this->input->post('email')
            ];

            if ($this->User_model->update_user($id_user, $data)) {
                // Update juga session jika nama berubah
                $this->session->set_userdata('nama_user', $data['nama_user']);
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('profil');
        }
    }

    /**
     * Memproses pembaruan password.
     * Password lama harus sesuai sebelum diganti dengan password baru.
     */
    public function update_password()
    {
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[6]|matches[konfirmasi_password]', [
            'min_length' => '%s minimal 6 karakter.',
            'matches' => '%s tidak cocok dengan konfirmasi password.'
        ]);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim|matches[password_baru]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id_user = $this->session->userdata('id_user');
            $user = $this->User_model->get_user_by_id($id_user);

            if (password_verify($this->input->post('password_lama'), $user->password)) {
                $new_password = password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT);
                $data = ['password' => $new_password];

                $this->User_model->update_user($id_user, $data);
                $this->session->set_flashdata('success', 'Password berhasil diubah.');
            } else {
                $this->session->set_flashdata('error', 'Password lama yang Anda masukkan salah.');
            }
            redirect('profil');
        }
    }

    /**
     * Memproses pembaruan informasi profil toko (khusus role penjual).
     * Termasuk upload logo baru dengan validasi ukuran & format file.
     */
    public function update_profil_toko()
    {
        // Pastikan hanya penjual yang bisa mengakses
        if ($this->session->userdata('role') != 'penjual') {
            redirect('home');
        }

        $id_user = $this->session->userdata('id_user');

        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required|trim');
        $this->form_validation->set_rules('deskripsi_toko', 'Deskripsi Toko', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'nama_toko' => $this->input->post('nama_toko'),
                'deskripsi_toko' => $this->input->post('deskripsi_toko'),
            ];

            // Logika upload logo toko
            if (!empty($_FILES['logo_toko']['name'])) {
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = 1024;
                $config['file_name']     = 'logo_' . $id_user . '_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo_toko')) {
                    // Hapus logo lama jika ada
                    $toko_lama = $this->Toko_model->get_toko_by_user($id_user);
                    if ($toko_lama && $toko_lama->logo_toko != 'default_logo.png') {
                        @unlink('./uploads/logo/' . $toko_lama->logo_toko);
                    }
                    $data['logo_toko'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('profil');
                    return;
                }
            }

            // Simpan data ke database
            if ($this->Toko_model->save_toko($id_user, $data)) {
                $this->session->set_flashdata('success', 'Profil toko berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil toko.');
            }
            redirect('profil');
        }
    }
}