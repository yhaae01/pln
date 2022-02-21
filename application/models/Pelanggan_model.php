<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model 
{

    public function getAllDataPelanggan()
    {
        $data = "SELECT *
                     FROM `pelanggan` JOIN `tarif`
                       ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        return $this->db->query($data)->result_array();
    }

    public function getUserById($id_pelanggan)
    {
        return $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array();
    }

    public function getAllPembayaran()
    {
        $queryPembayaran = "SELECT `pembayaran`.*, 
                                   `pelanggan`.`nomor_kwh`, 
                                   `pelanggan`.`nama_pelanggan`, 
                                   `tagihan`.`jumlah_meter`, 
                                   `tagihan`.`status`,
                                   `user`.`nama_admin`,
                                   `tarif`.`tarif_perkwh`
                              FROM `pembayaran` 
                              JOIN `tagihan` ON `pembayaran`.`id_tagihan` = `tagihan`.`id_tagihan`
                              JOIN `pelanggan` ON `tagihan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`
                              JOIN `user` ON `pembayaran`.`id_user` = `user`.`id_user`
                              JOIN `tarif` ON `pelanggan`.`id_tarif` = `tarif`.`id_tarif`";
        return $this->db->query($queryPembayaran)->result_array();
    }

    public function pembayaran()
    {
        $data = [
            'id_tagihan'    => $this->input->post('id_tagihan', true),
            'id_pelanggan'  => $this->input->post('id_pelanggan', true),
            'tgl_bayar'     => time(),
            'bulan'         => time(),
            'biaya_admin'   => $this->input->post('biaya_admin', true),
            'total_bayar'   => $this->input->post('total_bayar', true),
            'id_user'       => $this->input->post('id_user', true),
        ];
        $this->db->insert('pembayaran', $data);
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

    public function cekTagihanPel($where = null)
    {
        return $this->db->get_where('v_tagihan', $where)->row_array();
    }
}

/* End of file Pelanggan_model.php */

?>