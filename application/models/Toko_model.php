<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko_model extends CI_Model
{
    /**
     * Mengambil data toko berdasarkan ID user (penjual).
     * @param int $id_user ID user pemilik toko
     * @return object Data toko jika ditemukan
     */
    public function get_toko_by_user($id_user)
    {
        return $this->db->get_where('toko', ['id_user' => $id_user])->row();
    }

    /**
     * Menyimpan atau memperbarui data toko.
     * Jika toko belum ada, akan dibuat (insert). Jika sudah ada, akan diperbarui (update).
     * @param int $id_user ID user pemilik toko
     * @param array $data Data toko yang akan disimpan
     * @return bool Status keberhasilan operasi
     */
    public function save_toko($id_user, $data)
    {
        // Cek apakah user sudah punya data toko
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('toko');

        if ($query->num_rows() > 0) {
            // Jika sudah ada, update data
            $this->db->where('id_user', $id_user);
            return $this->db->update('toko', $data);
        } else {
            // Jika belum ada, tambahkan data baru
            // Pastikan id_user juga dimasukkan ke dalam data
            $data['id_user'] = $id_user;
            return $this->db->insert('toko', $data);
        }
    }
}