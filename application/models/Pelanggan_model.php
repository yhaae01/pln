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
}

/* End of file Pelanggan_model.php */

?>