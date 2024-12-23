<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersProfileController extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        session_start();
        $this->load->model('UsersProfileModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        // echo "sadsadsad";die;

        $login_role = $this->session->userdata('login_role');
        if (!isset($login_role)) {
            redirect(base_url() . "welcome", 'refresh');
        }
    }

    public function index()
    {   
        $this->load->view('header/header');
        $this->load->view('admin/users_profile');
        $this->load->view('footer/footer');
    }

    public function changePassword()
    {   
        $this->load->view('header/header');
        $this->load->view('admin/changePassword');
        $this->load->view('footer/footer');
    }
}