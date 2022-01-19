<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_level')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan login terlebih dahulu!
            </div>');
            redirect('auth/login_admin');
        } elseif ($this->session->userdata('id_tarif')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Oops! Anda tidak punya akses.
            </div>');
            redirect('pelanggan');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Dashboard Admin';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
        
    }

}

/* End of file Admin.php */

?>