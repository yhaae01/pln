<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        echo 'Halo, ' . $data['user']['nama_admin'];
    }

}

/* End of file Admin.php */

?>