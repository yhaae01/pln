<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model 
{

    public function getData()
    {
        $this->db->get('pelanggan')->result_array();
    }

}

/* End of file Pelanggan_model.php */

?>