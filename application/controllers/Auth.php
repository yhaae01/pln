<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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
                        'id_level' => $user['id_level']
                    ];
                    $this->session->set_userdata($data); // Menyimpan data di session
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Oops! Password salah.
                    </div>');
                    redirect('auth/login_admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Oops! Username tidak terdaftar.
                    </div>');
                redirect('auth/login_admin');
            }
        }
    }

    public function register_admin()
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
            $data['title'] = 'Registrasi Admin';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/admin/register_admin');
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
            redirect('auth/login_admin');
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
                        'username' => $user['username'],
                    ];
                    $this->session->set_userdata($data); // Menyimpan data di session
                    redirect('pelanggan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Oops! Password salah.
                    </div>');
                    redirect('auth/login_pelanggan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Oops! Username tidak terdaftar.
                    </div>');
                redirect('auth/login_pelanggan');
            }
        }
    }

    public function register_pelanggan()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim',[
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
        $this->form_validation->set_rules('nomor_kwh', 'Nomor KWH', 'required|trim|numeric|max_length[20]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('id_tarif', 'ID Tarif', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Registrasi Pelanggan';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/pelanggan/register_pelanggan');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'username'       => htmlspecialchars($this->input->post('username', true)),
                'password'       => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nomor_kwh'      => htmlspecialchars($this->input->post('nomor_kwh', true)),
                'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
                'alamat'         => htmlspecialchars($this->input->post('alamat', true)),
                'id_tarif'       => $this->input->post('id_tarif')
            ];

            $this->db->insert('pelanggan', $data);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil daftar akun! Silahkan login.
            </div>');
            redirect('auth/login_pelanggan');
        }
    }

    public function logout_admin()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_level');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil logout.
        </div>');
        redirect('auth/login_admin');
    }

    public function logout_pelanggan()
    {
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil logout.
        </div>');
        redirect('auth/login_pelanggan');
    }
}

/* End of file Auth.php */

?>