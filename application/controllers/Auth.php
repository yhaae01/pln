<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
    }
    
    public function login_admin()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required',[
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
            'required' => 'Password harus diisi!'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Admin';
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/admin/login_admin');
            $this->load->view('templates/auth_footer', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['username' => $username])->row_array();
            
            // Usernya ada
            if ($user) {
                // Cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'id_user' => $user['id_user']
                    ];
                    $this->session->set_userdata($data); // Menyimpan data di session
                    redirect('admin');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        'Password salah.'
                    );
                    redirect('auth/login_admin');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Username tidak terdaftar.'
                );
                redirect('auth/login_admin');
            }
        }
    }

    public function register_admin()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim',[
            'required'   => 'Nama Lengkap harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|min_length[6]|max_length[20]',[
            'required'   => 'Username harus diisi!',
            'min_length' => 'Minimal 6 karakter!',
            'max_length' => 'Maksimal 20 karakter!',
            'is_unique'  => 'Username sudah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
            'matches'    => 'Password tidak sama!',
            'min_length' => 'Minimal 8 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi Admin';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/admin/register_admin');
            $this->load->view('templates/auth_footer');
        } else {
            $this->auth->register_admin();
        }
    }

    public function login_pelanggan()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required',[
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
            'required' => 'Password harus diisi!'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Pelanggan';
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/pelanggan/login_pelanggan');
            $this->load->view('templates/auth_footer', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('pelanggan', ['username' => $username])->row_array();
            
            // Usernya ada
            if ($user) {
                // Cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_pelanggan' => $user['id_pelanggan'],
                        'username' => $user['username'],
                    ];
                    $this->session->set_userdata($data); // Menyimpan data di session
                    redirect('pelanggan');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        'Password salah.'
                    );
                    redirect('auth/login_pelanggan');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Username salah.'
                );
                redirect('auth/login_pelanggan');
            }
        }
    }

    public function register_pelanggan()
    {
        $data['title'] = 'Registrasi Pelanggan';
        $data['tarif'] = $this->admin->getAllTarif();

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
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|trim|numeric|max_length[11]',[
            'numeric'    => 'Hanya bisa menggunakan angka!',
            'required'   => 'Nomor KWH harus diisi!',
            'max_length' => 'Maksimal 11 karakter!'
        ]);
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|trim|numeric|is_unique[pelanggan.nomor_kwh]',[
            'required'   => 'Nomor KWH harus diisi!',
            'numeric'    => 'Hanya bisa menggunakan angka!',
            'is_unique'  => 'Nomor KWH sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
            'required'   => 'Alamat harus diisi!'
        ]);
        $this->form_validation->set_rules('id_tarif', 'Daya', 'required|trim',[
            'required'   => 'Daya harus diisi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/pelanggan/register_pelanggan');
            $this->load->view('templates/auth_footer');
        } else {
            $this->auth->register_pelanggan();
        }
    }

    public function logout_admin()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_user');
        session_destroy();

        $this->session->set_flashdata(
            'message', 
            'logout.'
        );
        redirect('auth/login_admin');
    }

    public function logout_pelanggan()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_pelanggan');
        session_destroy();

        $this->session->set_flashdata(
            'message', 
            'logout'
        );
        redirect('auth/login_pelanggan');
    }
}

/* End of file Auth.php */

?>