<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Pelanggan_model', 'pelanggan');
        
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan login terlebih dahulu!
            </div>');
            redirect('auth/login_admin');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function pelanggan()
    {
        $data['title'] = 'Data Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['pelanggan'] = $this->pelanggan->getData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pelanggan()
    {
        $data['title'] = 'Tambah Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();

        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim',[
            'required'   => 'Nama Lengkap harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pelanggan.username]|min_length[6]|max_length[20]',[
            'required'   => 'Username harus diisi!',
            'min_length' => 'Minimal 6 karakter!',
            'max_length' => 'Maksimal 20 karakter!',
            'is_unique'  => 'Username sudah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
            'matches'    => 'Password tidak sama!',
            'min_length' => 'Minimal 8 karakter!',
            'required'   => 'Password harus diisi!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|trim|numeric|max_length[11]|is_unique[pelanggan.nomor_kwh]',[
            'numeric'    => 'Hanya bisa menggunakan angka!',
            'required'   => 'Nomor KWH harus diisi!',
            'max_length' => 'Maksimal 11 karakter!',
            'is_unique'  => 'Nomor KWH sudah digunakan!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
            'required'   => 'Alamat harus diisi!'
        ]);
        $this->form_validation->set_rules('id_tarif', 'ID Tarif', 'required|trim',[
            'required'   => 'ID Tarif harus diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pelanggan/tambah_pelanggan');
            $this->load->view('templates/footer');
        } else {
            $this->admin->tambah_pelanggan();
        }
    }

    public function ubah_pelanggan($id_pelanggan)
    {
        $data['title'] = 'Ubah Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['pelanggan'] = $this->pelanggan->getUserById($id_pelanggan);
        
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim',[
            'required'   => 'Nama Lengkap harus diisi!'
        ]);
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|trim|numeric|max_length[11]|is_unique[pelanggan.nomor_kwh]',[
            'numeric'    => 'Hanya bisa menggunakan angka!',
            'required'   => 'Nomor KWH harus diisi!',
            'max_length' => 'Maksimal 11 karakter!',
            'is_unique'  => 'Nomor KWH sudah digunakan!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
            'required'   => 'Alamat harus diisi!'
        ]);
        $this->form_validation->set_rules('id_tarif', 'ID Tarif', 'required|trim',[
            'required'   => 'ID Tarif harus diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pelanggan/ubah_pelanggan');
            $this->load->view('templates/footer');
        } else {
            $this->admin->ubah_pelanggan();
        }
    }

    public function detail_pelanggan($id_pelanggan)
    {
        $data['title'] = 'Detail Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['pelanggan'] = $this->pelanggan->getUserById($id_pelanggan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pelanggan/detail_pelanggan');
        $this->load->view('templates/footer');
    }

    public function hapus_pelanggan($id_pelanggan)
    {
        $this->admin->hapus_pelanggan($id_pelanggan);
    }

}

/* End of file Admin.php */

?>