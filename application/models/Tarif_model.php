<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif_model extends CI_Model 
{

    public function getAllData()
    {
        return $this->db->get('tarif')->result_array();
    }

}

/* End of file Tarif_model.php */

?>