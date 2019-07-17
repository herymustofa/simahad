<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        //var_dump($data);
        //echo "selamat datang ". $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Accesss';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $data['role'] = $this->db->get_where('user_role', [
            'id' => $role_id
        ])->row_array();

        $this->db->where('id != ', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Access changed!</div>');
    }

    public function inputIjin()
    {
        $data['title'] = 'Form Pengajuan Ijin | ADMIN';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $data['nim'] = $this->input->post('nim');
        $data['nama'] = $this->input->post('nama');

        $this->form_validation->set_rules('nim', 'nim', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required|trim');
        $this->form_validation->set_rules('hp', 'Handphone', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/inputIjin', $data);
            $this->load->view('templates/footer');
            //var_dump($data);
            //die;
        } else {
            if ($this->countHistoriPulang() == true) {
                $data = [
                    'nim'           => htmlspecialchars($this->input->post('nim', true)),
                    'keperluan'     => htmlspecialchars($this->input->post('keperluan', true)),
                    'no_hp'         => htmlspecialchars($this->input->post('hp', true)),
                    'jam_keluar'    => time(),
                    'jam_masuk'    => 0
                ];

                $this->db->insert('ijin', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ijin Berhasil </div>');
                redirect('admin/historiIjin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Ijin gagal, masih dalam status ijin keluar</div>');
                redirect('admin/inputIjin');
            }
        }
    }

    public function getMahasiswa()
    {
        $this->load->model('Admin_model', 'mhs');
        $nim = $this->input->post('nim');
        $data = $this->mhs->getMahasiswaByNim($nim);
        echo json_encode($data);
    }

    public function countHistoriPulang()
    {
        $this->load->model('Admin_model', 'mhs');
        $nim = $this->input->post('nim');

        $data = $this->mhs->countHistoriPulang($nim);
        if ($data->tot < 1) {
            return true;
        } else {
            return false;
        }
    }

    public function historiIjin()
    {

        $data['title'] = 'History Pengajuan Ijin | ADMIN';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $this->load->model('Admin_model', 'ijin');
        $nim = $this->session->userdata('nim');

        //PAGINATION
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/historiIjin');
        $config['total_rows'] = $this->ijin->countAllHistory();
        $config['per_page'] = 10;
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['ijin'] = $this->ijin->getAllHistori($config['per_page'], $data['start']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/histori', $data);
        $this->load->view('templates/footer');
    }
}
