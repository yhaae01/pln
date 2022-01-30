<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Pelanggan_model', 'pelanggan');
        
        if (!$this->session->userdata('id_pelanggan')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan login terlebih dahulu!
            </div>');
            redirect('auth/login_pelanggan');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['title'] = 'Dashboard Pelanggan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tagihan()
    {
        $data['user'] = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['title'] = 'Tagihan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/tagihan/index', $data);
        $this->load->view('templates/footer');
    }

}

/* End of file pelanggan.php */

?>