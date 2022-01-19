<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }
    
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required',[
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required',[
            'required' => 'Password harus diisi!'
        ]);
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer', $data);
        } else {
            // Validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        
        // Usernya ada
        if ($user) {

            // Cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'id_level' => $user['id_level']
                ];
                $this->session->set_userdata($data); // Menyimpan data di session
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Oops! Password salah.
                </div>');
                redirect('auth');
            }

        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Oops! Username tidak terdaftar.
                </div>');
            redirect('auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim',[
            'required' => 'Nama Lengkap harus diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|min_length[6]|max_length[20]',[
            'required' => 'Username harus diisi!',
            'min_length' => 'Minimal 6 karakter!',
            'max_length' => 'Maksimal 20 karakter!',
            'is_unique' => 'Username sudah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
            'matches' => 'Password tidak sama!',
            'min_length' => 'Minimal 8 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'username'   => htmlspecialchars($this->input->post('username')),
                'password'   => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nama_admin' => htmlspecialchars($this->input->post('nama_admin', true)),
                'id_level'   => 1
            ];

            $this->db->insert('user', $data);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil daftar akun! Silahkan login.
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_level');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil logout.
        </div>');
        redirect('auth');
    }
}

/* End of file Auth.php */

?>