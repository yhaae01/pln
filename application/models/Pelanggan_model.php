<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model 
{

    public function getData()
    {
        return $this->db->get('pelanggan')->result_array();
    }

    public function getUserById($id_pelanggan)
    {
        return $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array();
    }

    public function tambah_penggunaan()
    {
        $data = [
            'id_pelanggan'  => $this->session->userdata('id_pelanggan'),
            'tahun'         => $this->input->post('tahun'),
            'bulan'         => $this->input->post('bulan'),
            'meter_awal'    => $this->input->post('meter_awal'),
            'meter_akhir'   => $this->input->post('meter_akhir'),
        ];

        $this->db->insert('penggunaan', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data penggunaan berhasil ditambahkan.
        </div>');
        redirect('pelanggan/penggunaan');
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
        redirect('pelanggan/penggunaan');
    }
}

/* End of file Pelanggan_model.php */

?>