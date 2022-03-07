<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Pelanggan_model', 'pelanggan');
        $this->load->model('Admin_model', 'admin');
        
        if (!$this->session->userdata('id_pelanggan')) {
            $this->session->set_flashdata(
                'message', 
                'Silahkan login!'
            );
            redirect('auth/login_pelanggan');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['tagihan'] = $this->pelanggan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);
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
        $data['tagihan'] = $this->pelanggan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);
        $data['title'] = 'Tagihan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/tagihan/index', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran()
    {
        $data['user']    = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['tagihan'] = $this->pelanggan->cekTagihanPel(['id_pelanggan' => $this->session->userdata('id_pelanggan')]);
        $data['admin']   = $this->admin->getAllUser('id_user' == 1);
        $data['title']   = 'Pembayaran';

        $this->form_validation->set_rules('nominal', 'Nominal', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelanggan/pembayaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->pelanggan->pembayaran();
            $this->session->set_flashdata(
                'message', 
                'bayar tagihan.'
            );
            redirect('pelanggan/tagihan');
        }
    }

}

/* End of file pelanggan.php */

?>