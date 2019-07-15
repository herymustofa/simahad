<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Form Pengajuan Ijin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('santri/index', $data);
        $this->load->view('templates/footer');
    }

    public function inputIjin()
    {
        $data['title'] = 'Form Pengajuan Ijin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required|trim');
        $this->form_validation->set_rules('hp', 'Handphone', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('santri/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nim = $this->session->userdata('nim');

            if ($this->countHistoriPulang() == true) {
                $data = [
                    'nim'           => htmlspecialchars($nim, true),
                    'keperluan'     => htmlspecialchars($this->input->post('keperluan', true)),
                    'no_hp'         => htmlspecialchars($this->input->post('hp', true)),
                    'jam_keluar'    => time(),
                    'jam_masuk'    => 0
                ];

                $this->db->insert('ijin', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ijin Berhasil </div>');
                redirect('santri/historiIjin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Ijin gagal, masih dalam status ijin keluar</div>');
                redirect('santri');
            }
        }
    }

    public function historiIjin()
    {

        $data['title'] = 'History Pengajuan Ijin';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();
        $this->load->model('Santri_model', 'ijin');
        $nim = $this->session->userdata('nim');

        //PAGINATION
        $this->load->library('pagination');
        $config['base_url'] = base_url('santri/historiIjin');
        $config['total_rows'] = $this->ijin->countAllHistory();
        $config['per_page'] = 5;
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['ijin'] = $this->ijin->getHistori($config['per_page'], $data['start'], $nim);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('santri/histori', $data);
        $this->load->view('templates/footer');
    }

    public function pulang()
    {
        $menu = $this->uri->segment(2);
        $id = $this->uri->segment(3);
        $jam_masuk = time();

        $this->load->model('Santri_model', 'ijin');
        $this->ijin->setPulang($id, $jam_masuk);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Absen Pulang Berhasil</div>');
        redirect('santri/historiIjin');
    }

    public function countHistoriPulang()
    {
        $this->load->model('Santri_model', 'ijin');
        $nim = $this->session->userdata('nim');

        $data = $this->ijin->countHistoriPulang($nim);
        // print_r($data);
        // echo "<hr>";
        // echo $data->tot;
        // die;
        if ($data->tot < 1) {
            return true;
        } else {
            return false;
        }
    }
    public function inputIjinKhusus()
    {
        $data['title'] = 'Form Pengajuan Ijin Khusus';
        $data['user'] = $this->db->get_where('user', ['nim' => $this->session->userdata('nim')])->row_array();

        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required|trim');
        $this->form_validation->set_rules('hp', 'Handphone', 'required|trim|numeric');
        $this->form_validation->set_rules('p_pulang', 'Pulang', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('santri/ijinKhusus', $data);
            $this->load->view('templates/footer');
        } else {
            $nim = $this->session->userdata('nim');

            if ($this->countHistoriPulang() == true) {

                $pjm = htmlspecialchars($this->input->post('p_pulang', true));
                $myTime = strtotime($pjm); 
                // var_dump($myTime);
                // die;
                
                $data = [
                    'nim'           => htmlspecialchars($nim, true),
                    'keperluan'     => htmlspecialchars($this->input->post('keperluan', true)),
                    'no_hp'         => htmlspecialchars($this->input->post('hp', true)),
                    'jam_keluar'    => time(),
                    'p_jam_masuk'   => $myTime,
                    'jam_masuk'    => 0
                ];

                $this->db->insert('ijin', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ijin Berhasil </div>');
                redirect('santri/historiIjin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Ijin gagal, masih dalam status ijin keluar</div>');
                redirect('santri');
            }
        }
    }

    public function test() {
        echo "test";
        echo "<hr>";
        
        $pulang = "08/19/2014";
        echo $pulang."<br>";
        $myTime = strtotime($pulang); 
        echo $myTime;
        echo "<hr>";

        echo date("Y-m-d H:i:s", $myTime);
    }
    
}
