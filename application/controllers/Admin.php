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
        $data['pelanggan'] = $this->pelanggan->getAllDataPelanggan();

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
        $data['pelanggan'] = $this->admin->getDataPelById($id_pelanggan);

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

    public function tagihan()
    {
        $data['title'] = 'Data Tagihan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['tagihan'] = $this->admin->getAllTagihan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tagihan/index', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_tagihan($id_tagihan)
    {
        $this->admin->hapus_tagihan($id_tagihan);
    }

    public function penggunaan()
    {
        $data['title'] = 'Penggunaan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['penggunaan'] = $this->admin->getAllPenggunaan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penggunaan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_penggunaan()
    {
        $data['title'] = 'Tambah Penggunaan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['pelanggan'] = $this->pelanggan->getAllDataPelanggan();
        $data['penggunaan'] = $this->admin->getAllPenggunaan();

        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required|trim|is_unique[penggunaan.id_pelanggan]',[
            'required'   => 'Pelanggan harus diisi!',
            'is_unique'  => 'Pelanggan sudah ditambahkan!'
        ]);
        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'required|trim|numeric',[
            'required'   => 'Meter Awal harus diisi!',
            'numeric'    => 'Meter Awal harus angka!'
        ]);
        $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'required|trim|numeric|greater_than[' . $this->input->post('meter_awal') . ']',[
            'required'     => 'Meter Akhir harus diisi!',
            'greater_than' => 'Tidak boleh lebih kecil dari Meter Awal!',
            'numeric'      => 'Meter Akhir harus angka!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penggunaan/tambah_penggunaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->tambah_penggunaan();
        }
    }

    public function ubah_penggunaan($id_penggunaan)
    {
        $data['title'] = 'Ubah Penggunaan';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['penggunaan'] = $this->admin->getPenggunaanById($id_penggunaan);

        $this->form_validation->set_rules('meter_awal', 'Meter Awal', 'required|trim|numeric',[
            'required'   => 'Meter Awal harus diisi!',
            'numeric'    => 'Meter Awal harus angka!'
        ]);
        $this->form_validation->set_rules('meter_akhir', 'Meter Akhir', 'required|trim|numeric',[
            'required'   => 'Meter Akhir harus diisi!',
            'numeric'    => 'Meter Akhir harus angka!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penggunaan/ubah_penggunaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->ubah_penggunaan();
        }
    }

    public function hapus_penggunaan($id_penggunaan)
    {
        $this->admin->hapus_penggunaan($id_penggunaan);
    }

    public function tarif()
    {
        $data['title'] = 'Tarif';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['tarif'] = $this->admin->getAllTarif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tarif/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_tarif()
    {
        $data['title'] = 'Tambah Tarif';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();

        $this->form_validation->set_rules('daya', 'Daya', 'required|trim',[
            'required'   => 'Daya harus diisi!',
        ]);
        $this->form_validation->set_rules('tarif', 'Tarif', 'required|trim|numeric',[
            'required'   => 'Tarif harus diisi!',
            'numeric'    => 'Tarif harus angka!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tarif/tambah_tarif', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->tambah_tarif();
        }
    }

    public function ubah_tarif($id_tarif)
    {
        $data['title'] = 'Ubah Tarif';
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        $data['tarif'] = $this->admin->getTarifById($id_tarif);

        $this->form_validation->set_rules('daya', 'Daya', 'required|trim',[
            'required'   => 'Daya harus diisi!',
        ]);

        $this->form_validation->set_rules('tarif', 'Tarif', 'required|trim|numeric',[
            'required'   => 'Tarif harus diisi!',
            'numeric'    => 'Tarif harus angka!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tarif/ubah_tarif', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->ubah_tarif();
        }
    }

    public function hapus_tarif($id_tarif)
    {
        $this->admin->hapus_tarif($id_tarif);
    }
}

/* End of file Admin.php */

?>