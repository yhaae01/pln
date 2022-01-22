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

    public function penggunaan()
    {
        $data['user'] = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['title'] = 'Penggunaan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/penggunaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_penggunaan()
    {
        $data['user'] = $this->db->get_where('pelanggan', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['title'] = 'Tambah Penggunaan';

        $this->form_validation->set_rules('bulan', 'Bulan', 'required|trim',[
            'required'   => 'Bulan harus diisi!'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim',[
            'required'   => 'Tahun harus diisi!'
        ]);
        $this->form_validation->set_rules('meter_awal', 'meter_awal', 'required|trim|numeric',[
            'required'   => 'Nama Lengkap harus diisi!',
            'numeric'    => 'Meter Awal harus angka!'
        ]);
        $this->form_validation->set_rules('meter_akhir', 'meter_akhir', 'required|trim|numeric',[
            'required'   => 'Nama Lengkap harus diisi!',
            'numeric'    => 'Meter Akhir harus angka!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelanggan/penggunaan/tambah_penggunaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->pelanggan->tambah_penggunaan();
        }
    }

    public function hapus_penggunaan($id_penggunaan)
    {
        $this->pelanggan->hapus_penggunaan($id_penggunaan);
    }

}

/* End of file pelanggan.php */

?>