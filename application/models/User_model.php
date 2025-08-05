<?php
// Mencegah akses langsung ke file
defined('BASEPATH') or exit('No direct script access allowed');

// Deklarasi class User_model sebagai turunan dari CI_Model
class User_model extends CI_Model
{

    /**
     * Mengambil data user berdasarkan email untuk keperluan login atau pengecekan email.
     * @param string $email Alamat email user
     * @return object Data user (jika ditemukan), berupa satu baris
     */
    public function get_user_by_email($email)
    {
        // Menjalankan query SELECT * FROM users WHERE email = ?
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    /**
     * Menyimpan data user baru ke database, biasanya saat registrasi.
     * @param array $data Data user yang akan dimasukkan (nama, email, password, dll)
     * @return bool Status keberhasilan insert
     */
    public function insert_user($data)
    {
        // Menjalankan query INSERT INTO users (...)
        return $this->db->insert('users', $data);
    }

    /**
     * Mengambil semua data user dari tabel 'users'.
     * Umumnya digunakan untuk admin melihat seluruh pengguna.
     * @return array Daftar seluruh user
     */
    public function get_all_users()
    {
        // SELECT * FROM users
        return $this->db->get('users')->result();
    }

    /**
     * Menghapus data user berdasarkan ID-nya.
     * Biasanya digunakan oleh admin untuk menghapus akun.
     * @param int $id_user ID user yang akan dihapus
     * @return bool Status berhasil/gagal penghapusan
     */
    public function delete_user($id_user)
    {
        // DELETE FROM users WHERE id_user = ?
        return $this->db->delete('users', ['id_user' => $id_user]);
    }

    /**
     * Mengambil data user berdasarkan ID-nya.
     * Berguna untuk menampilkan detail atau edit profil user.
     * @param int $id_user ID user yang ingin diambil
     * @return object Data user berupa satu baris
     */
    public function get_user_by_id($id_user)
    {
        // SELECT * FROM users WHERE id_user = ?
        return $this->db->get_where('users', ['id_user' => $id_user])->row();
    }

    /**
     * Memperbarui data user berdasarkan ID-nya.
     * Umumnya digunakan saat user mengedit profil atau admin memperbarui data.
     * @param int $id_user ID user yang ingin diperbarui
     * @param array $data Data baru yang ingin disimpan
     * @return bool Status update
     */
    public function update_user($id_user, $data)
    {
        // WHERE id_user = ? lalu UPDATE users SET ...
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }
}