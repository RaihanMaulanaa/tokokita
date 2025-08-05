<?php
// Cegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Controller untuk role penjual
class Penjual extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek apakah user memiliki role "penjual"
        if ($this->session->userdata('role') != 'penjual') {
            show_error('Anda tidak memiliki hak akses ke halaman ini.', 403, 'Akses Ditolak');
        }

        $this->load->model('Produk_model');
    }

    // =======================
    // Dashboard Penjual
    // =======================
    public function dashboard()
    {
        $data['judul'] = 'Dashboard Penjual';
        $id_user = $this->session->userdata('id_user');
        $data['produk'] = $this->Produk_model->get_produk_by_user($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('penjual/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // =======================
    // Form Tambah Produk
    // =======================
    public function tambah_produk()
    {
        $data['judul'] = 'Tambah Produk Baru';
        $this->load->view('templates/header', $data);
        $this->load->view('penjual/tambah_produk');
        $this->load->view('templates/footer');
    }

    // =============================
    // Proses Tambah Produk Baru
    // =============================
    public function proses_tambah()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_produk();
        } else {
            $config['upload_path'] = './uploads/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar_produk')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('penjual/tambah_produk');
            } else {
                $upload_data = $this->upload->data();
                $data = [
                    'id_user' => $this->session->userdata('id_user'),
                    'nama_produk' => $this->input->post('nama_produk'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'harga' => $this->input->post('harga'),
                    'stok' => $this->input->post('stok'),
                    'gambar_produk' => $upload_data['file_name']
                ];
                $this->Produk_model->insert_produk($data);
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
                redirect('penjual/dashboard');
            }
        }
    }

    // ===========================
    // Form Edit Produk
    // ===========================
    public function edit_produk($id_produk)
    {
        $data['judul'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        if (!$data['produk'] || $data['produk']->id_user != $this->session->userdata('id_user')) {
            show_error('Produk tidak ditemukan atau Anda tidak memiliki hak akses.', 404);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('penjual/edit_produk', $data);
        $this->load->view('templates/footer');
    }

    // ================================
    // Proses Edit Produk
    // ================================
    public function proses_edit($id_produk)
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_produk($id_produk);
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'deskripsi' => $this->input->post('deskripsi'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
            ];

            // Jika ada gambar baru diupload
            if (!empty($_FILES['gambar_produk']['name'])) {
                $config['upload_path'] = './uploads/produk/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_produk')) {
                    $produk_lama = $this->Produk_model->get_produk_by_id($id_produk);
                    if ($produk_lama->gambar_produk != 'default.jpg') {
                        @unlink('./uploads/produk/' . $produk_lama->gambar_produk);
                    }
                    $data['gambar_produk'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('penjual/edit_produk/' . $id_produk);
                }
            }

            $this->Produk_model->update_produk($id_produk, $data);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('penjual/dashboard');
        }
    }

    // ============================
    // Hapus Produk
    // ============================
    public function hapus_produk($id_produk)
    {
        $produk = $this->Produk_model->get_produk_by_id($id_produk);
        if ($produk && $produk->gambar_produk != 'default.jpg') {
            @unlink('./uploads/produk/' . $produk->gambar_produk);
        }

        $this->Produk_model->delete_produk($id_produk);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('penjual/dashboard');
    }
}