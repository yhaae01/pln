<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{

    public function tambah_pengguna()
    {
        $data = [
            'username'       => htmlspecialchars($this->input->post('username', true)),
            'password'       => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'nomor_kwh'      => htmlspecialchars($this->input->post('nomor_kwh', true)),
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'alamat'         => htmlspecialchars($this->input->post('alamat', true)),
            'id_tarif'       => $this->input->post('id_tarif')
        ];

        $this->db->insert('pelanggan', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil daftar akun! Silahkan login.
        </div>');
        redirect('admin/pelanggan');
    }

    public function hapus_pelanggan($id_pelanggan)
    {
        $this->db->delete('pelanggan', ['id_pelanggan' => $id_pelanggan]);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data pelanggan berhasil dihapus.
            </div>'
        );
        redirect('admin/pelanggan');
    }

}

/* End of file Admin_model.php */

?>