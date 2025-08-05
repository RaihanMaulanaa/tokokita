<?php
// Melindungi file agar tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Controller untuk otentikasi pengguna
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat model User_model untuk akses data pengguna
        $this->load->model('User_model');
    }

    // ========================= LOGIN =========================

    public function login()
    {
        // Cek apakah user sudah login, jika iya langsung redirect
        if ($this->session->userdata('is_login')) {
            redirect('home');
        }

        // Validasi input email dan password
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login
            $data['judul'] = 'Login';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, proses login
            $this->login_process();
        }
    }

    public function login_process()
    {
        // Ambil input dari form
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        // Cari user berdasarkan email
        $user = $this->User_model->get_user_by_email($email);

        // Verifikasi password dan keberadaan user
        if ($user && password_verify($password, $user->password)) {
            // Buat data session
            $session_data = [
                'id_user'   => $user->id_user,
                'nama_user' => $user->nama_user,
                'email'     => $user->email,
                'role'      => $user->role,
                'is_login'  => TRUE
            ];
            $this->session->set_userdata($session_data);

            // Redirect berdasarkan peran pengguna
            if ($user->role == 'admin')    redirect('admin/dashboard');
            if ($user->role == 'penjual')  redirect('penjual/dashboard');
            if ($user->role == 'pembeli')  redirect('home');
        } else {
            // Jika gagal login, tampilkan error
            $this->session->set_flashdata('error', 'Email atau password salah.');
            redirect('auth/login');
        }
    }

    // ========================= REGISTER =========================

    public function register()
    {
        // Jika sudah login, redirect ke home
        if ($this->session->userdata('is_login')) {
            redirect('home');
        }

        // Validasi input form registrasi
        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password_confirm]', [
            'min_length' => '%s minimal 6 karakter.',
            'matches'    => '%s tidak cocok dengan konfirmasi password.'
        ]);
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|trim|matches[password]', [
            'matches' => '%s tidak cocok dengan password.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan form registrasi jika validasi gagal
            $data['judul'] = 'Registrasi Akun';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            // Simpan data user ke database jika validasi berhasil
            $data = [
                'nama_user' => htmlspecialchars($this->input->post('nama_user', true)),
                'email'     => htmlspecialchars($this->input->post('email', true)),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'      => $this->input->post('role', true),
            ];

            $this->User_model->insert_user($data);

            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth/login');
        }
    }

    // ========================= LOGOUT =========================

    public function logout()
    {
        // Hapus semua data session saat logout
        $this->session->sess_destroy();
        redirect('home');
    }
}