<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    	session_start();
        $this->load->model('Login');
        $this->load->library('form_validation');
        $this->load->library('session');
        // print_r($_SESSION);exit;
        // $this->session->set_userdata('admin_type','1');

        // echo  $sess_admin_type = $this->session->userdata('admin_type');exit;

    }
    public function index()
    {
        // echo 11;exit;
               
        if ($this->form_validation->run('login') == FALSE) {
            $this->load->view('welcome_message');
        } else {

 	//error_reporting(E_ALL);
        //ini_set('display_errors', '1'); 
        //printData($_POST);
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = $this->Login->ckeckLogin($username, $password);
            // printData($data);
            // die;
            if (!empty($data)) {
                $getallTalukaList  = $this->Login->getallTalukaList();
                $getBranchList    = $this->Login->getBranchList();
                //printData($data);die;
                $branch_id_arr = explode(",", $data['branch_id']);
                $taluka_id_arr = explode(",", $data['taluka_id']);
		//var_dump($branch_id_arr);die;
                $sess_arr = array(
                    "login_user_id" => $data['user_id'],
                    "login_name" => $data['name'],
                    "login_email" => $data['email'],
                    "login_mobile" => $data['mobile'],
                    "login_role" => $data['role'],
                    "login_taluka_id" => $data['taluka_id'],
                    "login_zone_id" => $data['zone_id'],
                    "login_taluka_name" => $data['taluka_name'],
                    "login_branch_name" => $data['branch_name'],
                    "login_branch_id" => $data['branch_id'],
                    "login_username" => $data['username'],
                    "login_password" => $data['password'],
                    "login_status" => $data['status']
                );
               
                $session_branch_id_arr = [];
                $session_taluka_id_arr = [];
                foreach ($branch_id_arr as $key => $value) {
                    $index = array_search($value, array_column($getBranchList, 'branch_id'));
                    $session_branch_id_arr[$key] = $getBranchList[$index]['branch_name'];
                }
                foreach ($taluka_id_arr as $tkey => $tvalue) {
                    $indexTaluka = array_search($tvalue, array_column($getallTalukaList, 'taluka_id'));
                    $session_taluka_id_arr[$tkey] = $getallTalukaList[$indexTaluka]['taluka_name'];
                }

                $sess_arr['getallTalukaList'] = $session_taluka_id_arr;
                $sess_arr['getBranchList'] = $session_branch_id_arr;
                $this->session->set_userdata($sess_arr);
                //printData($sess_arr);die;
		//printData($this->session->userdata);die;
		//echo site_url()."Admin/index";die;
                //redirect(base_url()."/admin/index", 'refresh');
		redirect(base_url()."admin/index", 'refresh');
		//redirect(base_url()."admin/index", 'location',301);		
            } else {
                redirect(base_url()."welcome/index", 'refresh');
            }
        }
    }
}