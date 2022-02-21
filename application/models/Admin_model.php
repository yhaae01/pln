<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
    public function getAllUser()
    {
        return $this->db->get('user')->row_array();
    }
    
    public function getTarif()
    {
        return $this->db->get('tarif')->result_array();
    }

    public function tambah_pelanggan()
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

    public function ubah_pelanggan()
    {
        $id_pelanggan = $this->input->post('id_pelanggan', true);
        $data = [
            'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
            'nomor_kwh'      => $this->input->post('nomor_kwh', true),
            'id_tarif'       => $this->input->post('id_tarif'),
            'alamat'         => $this->input->post('alamat', true),
        ];

        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('pelanggan', $data);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data pelanggan berhasil diubah.
            </div>'
        );
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

    public function getDataPenggunaan()
    {
        return $this->db->get('penggunaan')->result_array();
    }

    public function getPenggunaanById($id_penggunaan)
    {
        return $this->db->get_where('penggunaan', ['id_penggunaan' => $id_penggunaan])->row_array();
    }

    public function tambah_penggunaan()
    {
        $data = [
            'id_pelanggan'  => $this->input->post('id_pelanggan', true),
            'tahun'         => date('Y'),
            'bulan'         => date('m'),
            'meter_awal'    => $this->input->post('meter_awal', true),
            'meter_akhir'   => $this->input->post('meter_akhir', true),
        ];

        $this->db->insert('penggunaan', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data penggunaan berhasil ditambahkan.
        </div>');
        redirect('admin/penggunaan');
    }

    public function ubah_penggunaan()
    {
        $id_penggunaan = $this->input->post('id_penggunaan', true);
        $data = [
            'meter_awal'    => $this->input->post('meter_awal', true),
            'meter_akhir'   => $this->input->post('meter_akhir', true),
        ];

        $this->db->where('id_penggunaan', $id_penggunaan);
        $this->db->update('penggunaan', $data);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data penggunaan berhasil diubah.
            </div>'
        );
        redirect('admin/penggunaan');
    }

    public function hapus_penggunaan($id_penggunaan)
    {
        $this->db->delete('penggunaan', ['id_penggunaan' => $id_penggunaan]);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data penggunaan berhasil dihapus.
            </div>'
        );
        redirect('admin/penggunaan');
    }

}

/* End of file Admin_model.php */

?>