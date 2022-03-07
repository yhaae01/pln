<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model 
{

    public function register_admin()
    {
        $data = [
            'username'   => htmlspecialchars($this->input->post('username')),
            'password'   => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'nama_admin' => htmlspecialchars($this->input->post('nama_admin', true)),
            'id_level'   => 1
        ];

        $this->db->insert('user', $data);
        
        $this->session->set_flashdata(
            'regadmin', 
            '<div class="alert alert-success" role="alert">
            Berhasil daftar akun! Silahkan login.
            </div>'
        );
        redirect('auth/login_admin');
    }

    public function register_pelanggan()
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
        
        $this->session->set_flashdata(
            'reg_pelanggan', 
            '<div class="alert alert-success" role="alert">
            Berhasil daftar akun! Silahkan login.
            </div>'
        );
        redirect('auth/login_pelanggan');
    }

}

/* End of file Auth_model.php */

?>