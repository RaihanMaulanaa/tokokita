<?php
/**
 * Controller Admin
 * 
 * Mengelola dashboard, pengguna, produk, dan transaksi untuk role admin.
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat model yang digunakan di controller ini
        $this->load->model('User_model');
        $this->load->model('Produk_model');
        $this->load->model('Transaction_model');

        // Membatasi akses hanya untuk pengguna dengan role admin
        $this->_cek_role('admin');
    }

    /**
     * Menampilkan halaman dashboard admin.
     */
    public function dashboard()
    {
        $data['judul'] = 'Dashboard Admin';
        $this->load->model('Dashboard_model');

        // Mengambil data statistik untuk dashboard
        $data['total_users'] = $this->Dashboard_model->count_users();
        $data['total_products'] = $this->Dashboard_model->count_products();
        $data['total_transactions'] = $this->Dashboard_model->count_transactions();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Menampilkan daftar semua pengguna.
     */
    public function users()
    {
        $data['judul'] = 'Kelola Pengguna';
        $data['users'] = $this->User_model->get_all_users();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/kelola_user', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Menampilkan form tambah pengguna.
     */
    public function tambah_user()
    {
        $data['judul'] = 'Tambah Pengguna Baru';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/tambah_user');
        $this->load->view('templates/footer');
    }

    /**
     * Memproses penyimpanan pengguna baru.
     */
    public function proses_tambah_user()
    {
        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('role', 'Peran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_user();
        } else {
            $data = [
                'nama_user'  => htmlspecialchars($this->input->post('nama_user', true)),
                'email'      => htmlspecialchars($this->input->post('email', true)),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role'       => $this->input->post('role'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Pengguna baru berhasil ditambahkan.');
            redirect('admin/users');
        }
    }

    /**
     * Menghapus pengguna tertentu.
     */
    public function hapus_user($id_user)
    {
        if ($id_user == $this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            redirect('admin/users');
        }

        $this->User_model->delete_user($id_user);
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus.');
        redirect('admin/users');
    }

    /**
     * Menampilkan form edit pengguna.
     */
    public function edit_user($id_user)
    {
        $data['judul'] = 'Edit Pengguna';
        $data['user']  = $this->User_model->get_user_by_id($id_user);

        if (!$data['user']) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Memproses perubahan data pengguna.
     */
    public function proses_edit_user($id_user)
    {
        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('role', 'Peran', 'required');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit_user($id_user);
        } else {
            $data = [
                'nama_user' => $this->input->post('nama_user'),
                'email'     => $this->input->post('email'),
                'role'      => $this->input->post('role')
            ];

            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->User_model->update_user($id_user, $data);
            $this->session->set_flashdata('success', 'Data pengguna berhasil diperbarui.');
            redirect('admin/users');
        }
    }

    /**
     * Menampilkan semua produk dari semua penjual.
     */
    public function products()
    {
        $data['judul'] = 'Kelola Semua Produk';
        $data['produk'] = $this->Produk_model->get_all_produk();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/kelola_produk', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Menampilkan form edit produk tertentu.
     */
    public function edit_produk($id_produk)
    {
        $data['judul'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        if (!$data['produk']) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_produk', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Memproses perubahan data produk.
     */
    public function proses_edit_produk($id_produk)
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_produk($id_produk);
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'deskripsi'   => $this->input->post('deskripsi'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok'),
            ];

            if (!empty($_FILES['gambar_produk']['name'])) {
                $config['upload_path']   = './uploads/produk/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 2048;
                $config['file_name']     = 'produk_' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_produk')) {
                    $produk_lama = $this->Produk_model->get_produk_by_id($id_produk);
                    if ($produk_lama->gambar_produk != 'default.jpg') {
                        @unlink('./uploads/produk/' . $produk_lama->gambar_produk);
                    }
                    $data['gambar_produk'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/edit_produk/' . $id_produk);
                    return;
                }
            }

            $this->Produk_model->update_produk($id_produk, $data);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('admin/products');
        }
    }

    /**
     * Menghapus produk tertentu.
     */
    public function hapus_produk_admin($id_produk)
    {
        $produk = $this->Produk_model->get_produk_by_id($id_produk);
        if ($produk && $produk->gambar_produk != 'default.jpg') {
            @unlink('./uploads/produk/' . $produk->gambar_produk);
        }

        $this->Produk_model->delete_produk($id_produk);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('admin/products');
    }

    /**
     * Menampilkan semua transaksi.
     */
    public function transactions()
    {
        $data['judul'] = 'Kelola Semua Transaksi';
        $data['transactions'] = $this->Transaction_model->get_all_transactions();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/kelola_transaksi', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Menampilkan detail transaksi tertentu.
     */
    public function detail_transaksi($id_transaksi)
    {
        $data['judul'] = 'Detail Transaksi';
        $data['transaksi'] = $this->Transaction_model->get_transaction_by_id($id_transaksi);
        $data['detail_items'] = $this->Transaction_model->get_transaction_details($id_transaksi);

        if (!$data['transaksi']) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/detail_transaksi', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Memperbarui status transaksi.
     */
    public function update_status()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $status_baru = $this->input->post('status');

        $update = $this->Transaction_model->update_transaction($id_transaksi, ['status' => $status_baru]);

        if ($update) {
            $this->session->set_flashdata('success', 'Status transaksi berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status transaksi.');
        }

        redirect('admin/detail_transaksi/' . $id_transaksi);
    }
}