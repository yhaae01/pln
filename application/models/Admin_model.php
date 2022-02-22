<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
    public function getAllUser()
    {
        return $this->db->get('user')->row_array();
    }
    
    public function getAllTarif()
    {
        return $this->db->get('tarif')->result_array();
    }

    public function getTarifById($id_tarif)
    {
        return $this->db->get_where('tarif', ['id_tarif' => $id_tarif])->row_array();
    }

    public function tambah_tarif()
    {
        $data = [
            'daya'          => htmlspecialchars($this->input->post('daya', true)),
            'tarif_perkwh'  => htmlspecialchars($this->input->post('tarif_perkwh', true)),
        ];

        $this->db->insert('tarif', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data tarif berhasil ditambahkan.
        </div>');
        redirect('admin/tarif');
    }

    public function ubah_tarif()
    {
        $id_tarif = $this->input->post('id_tarif', true);
        $data = [
            'daya'          => $this->input->post('daya', true),
            'tarif_perkwh'  => $this->input->post('tarif_perkwh', true),
        ];

        $this->db->where('id_tarif', $id_tarif);
        $this->db->update('tarif', $data);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data Tarif berhasil diubah.
            </div>'
        );
        redirect('admin/tarif');
    }

    public function hapus_tarif($id_tarif)
    {
        $this->db->delete('tarif', ['id_tarif' => $id_tarif]);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Data tarif berhasil dihapus.
            </div>'
        );
        redirect('admin/tarif');
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
            'bulan'         => date('m'),
            'tahun'         => date('Y'),
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

    public function getDataPelById($id)
    {
        //Join tabel pelanggan dan tarif where = id
        $queryDataPel = "SELECT *
                           FROM `pelanggan` JOIN `tarif`
                             ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`
                          WHERE `pelanggan`.`id_pelanggan` = $id";
        //Tampilkan data dari hasil join pelanggan dengan tarif berdasarkan id
        return $this->db->query($queryDataPel)->row_array();
    }

    public function getAllPenggunaan()
    {
        $data = "SELECT `penggunaan`.*,`pelanggan`.`nomor_kwh`, `pelanggan`.`nama_pelanggan`, `tarif`.`daya` 
                   FROM `penggunaan` 
                   JOIN `pelanggan` ON `penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`
                   JOIN `tarif` ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        return $this->db->query($data)->result_array();
    }

    public function getAllTagihan()
    {
        $queryTagihan = "SELECT `tagihan`.*, 
                                `pelanggan`.`nomor_kwh`, 
                                `pelanggan`.`nama_pelanggan`, 
                                `penggunaan`.`meter_awal`, 
                                `penggunaan`.`meter_akhir` 
                           FROM `tagihan` 
                           JOIN `penggunaan` ON `tagihan`.`id_penggunaan` = `penggunaan`.`id_penggunaan`
                           JOIN `pelanggan` ON `penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`";
        return $this->db->query($queryTagihan)->result_array();
    }
}

/* End of file Admin_model.php */

?>