<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Login');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('captcha');
        // print_r($_SESSION);exit;
        // $this->session->set_userdata('admin_type','1');

        // echo  $sess_admin_type = $this->session->userdata('admin_type');exit;

    }

    public function refresh()
    {
        $config = array(
            'img_url' => base_url() . 'image_for_captcha/',
            'img_path' => 'image_for_captcha/',
            'img_height' => 45,
            'word_length' => 5,
            'img_width' => '45',
            'font_size' => 10
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        echo $captcha['image'];
    }
    public function generateCaptcha()
    {
        // $random_number = substr(number_format(time() * rand(), 0, ", "), 0, 6);
        $random_number = substr(str_replace(',', '', md5(rand())), 0, 6);
        $vals = array(
            'word' => $random_number,
            'img_path' => './captcha/',
            'img_url' => base_url().'captcha/',
            'img_width' => 140,
            'img_height' => 32,
            'expiration' => 7200
        );
        return $vals;
    }
    public function generateCaptchaAjax()
    {
        $this->session->unset_userdata('captchaWord');
        $vals = $this->generateCaptcha();
        $data['captcha'] = create_captcha($vals);
        $newCaptcha =  $this->session->set_userdata('captchaWord', $data['captcha']['word']);
        echo json_encode($data);
        exit(1);
    }

    public function index()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        if ($this->form_validation->run('login') == FALSE) {

            // $vals = $this->generateCaptcha();
            // $data['captcha'] = create_captcha($vals);

            // $this->session->set_userdata('captchaWord', $data['captcha']['word']);
            // $this->session->set_userdata('captcha_filename', $data['captcha']['filename']);
            
            $this->load->view('welcome_message', $data);
        } else {
            // if ($this->input->post('userCaptcha') != "" && $this->input->post('userCaptcha') != null) {
                // $validationCaptch = $this->validate_captcha($this->input->post('userCaptcha'));
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $data = $this->Login->ckeckLogin($username, $password);
                if (!empty($data)) {

                    // if ($validationCaptch) {
                        $getallTalukaList  = $this->Login->getallTalukaList();
                        $getBranchList    = $this->Login->getBranchList();

                        $branch_id_arr = explode(",", $data['branch_id']);
                        $taluka_id_arr = explode(",", $data['taluka_id']);

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
                            "login_status" => $data['status'],
                            "role_name" => $data['role_name']
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
                        unlink("./captcha/" . $this->session->userdata('captcha_filename')); // removing captcha generated file 
                        redirect(base_url() . "admin/index", 'refresh');
                    // } else {
                    //     $this->session->set_flashdata('captcha_error', 'Invalid Captcha.');
                    //     redirect(base_url() . "welcome/index", 'refresh');
                    // }
                } else {
                    $this->session->set_flashdata('login_error', 'Invalid Credentials.');
                    redirect(base_url() . "welcome/index", 'refresh');
                }
            // }
        }
    }


    public function validate_captcha($userCaptcha)
    {
        // echo "validation captcha " . $userCaptcha . "___" . $this->session->userdata('captchaWord');
        if ($userCaptcha != $this->session->userdata('captchaWord')) {
            $this->form_validation->set_message('validate_captcha', 'Cpatcha Code is wrong');
            return false;
        } else {
            return true;
        }
    }
    public function index_old()
    {
        if ($this->form_validation->run('login') == FALSE) {
            $this->load->view('welcome_message');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = $this->Login->ckeckLogin($username, $password);
            
            if ($data) {
                $getallTalukaList  = $this->Login->getallTalukaList();
                $getBranchList    = $this->Login->getBranchList();
                
                $branch_id_arr = explode(",", $data['branch_id']);
                $taluka_id_arr = explode(",", $data['taluka_id']);

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
                // printData($sess_arr);die;
                redirect(base_url() . "admin/index", 'refresh');
            } else {
                redirect(base_url() . "welcome/index", 'refresh');
            }
        }
    }
}
