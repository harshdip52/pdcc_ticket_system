<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('InventoryModel');
        $this->load->library('form_validation');
        $this->load->library('session');

        $login_role = $this->session->userdata('login_role');
        if (!isset($login_role)) {
            redirect(base_url() . "welcome", 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
        exit();
    }

    public function index()
    {
        $login_user_id = $this->session->userdata('login_user_id');
        // printData($_SESSION);
        // die;
        $reminder['reminder'] = $this->AdminModel->getReminder($login_user_id);
        $this->load->view('header/header');
        $this->load->view('admin/admin_dashboard', $reminder);
        $this->load->view('footer/footer');
    }
    public function master_data()
    {
        $count['totalTq'] = $this->AdminModel->totalTq();
        $count['totalZone'] = $this->AdminModel->totalZone();
        $count['totalBr'] = $this->AdminModel->totalBr();
        $count['totalCat'] = $this->AdminModel->totalCat();
        $count['totalSubCat'] = $this->AdminModel->totalSubCat();
        $count['totalBrnd'] = $this->AdminModel->totalBrnd();
        $count['totalRole'] = $this->AdminModel->totalRole();
       
        $this->load->view('header/header');
        $this->load->view('admin/master_data', $count);
        $this->load->view('footer/footer');
    }

    public function master_taluka()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_taluka',$data);
        $this->load->view('footer/footer');
    }

    public function add_taluka()
    {
        if ($this->form_validation->run('add_taluka') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_taluka');
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_name'] = $this->input->post('taluka_name');
            $id = $this->AdminModel->insertTaluka($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_taluka", 'refresh');
            } else {
                redirect(base_url() . "admin/add_taluka", 'refresh');
            }
        }
    }

    public function edit_taluka($taluka_id = '')
    {
        $data['talukadata'] = $this->AdminModel->getTalukaById($taluka_id);

        if ($this->form_validation->run('add_taluka') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_taluka', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_name'] = $this->input->post('taluka_name');
            $taluka_id = $this->input->post('taluka_id');
            $id = $this->AdminModel->updateTaluka($formdata, $taluka_id);
            if ($id) {
                redirect(base_url() . "admin/master_taluka", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_taluka/$taluka_id", 'refresh');
            }
        }
    }


    // Master Zone Details

    public function master_zone()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_zone',$data);
        $this->load->view('footer/footer');
    }

    public function add_zone()
    {
        if ($this->form_validation->run('add_zone') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_zone');
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['zone_name'] = $this->input->post('zone_name');
            // printData($formdata);
            // die;
            $id = $this->AdminModel->insertZone($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_zone", 'refresh');
            } else {
                redirect(base_url() . "admin/add_zone", 'refresh');
            }
        }
    }

    public function edit_zone($zone_id = '')
    {
        $data['zonedata'] = $this->AdminModel->getZoneById($zone_id);
        $data['taluka'] = $this->AdminModel->getAllTalukaList();

        if ($this->form_validation->run('add_zone') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_zone', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['zone_name'] = $this->input->post('zone_name');
            $zone_id = $this->input->post('zone_id');
            $id = $this->AdminModel->updateZone($formdata, $zone_id);
            if ($id) {
                redirect(base_url() . "admin/master_zone", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_zone/$zone_id", 'refresh');
            }
        }
    }
    // Master Zone End


    // Master Branch start
    public function master_branch()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_branch',$data);
        $this->load->view('footer/footer');
    }

    public function add_branch()
    {
        if ($this->form_validation->run('add_branch') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_branch');
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['zone_id'] = $this->input->post('zone_id');
            $formdata['branch_code'] = $this->input->post('branch_code');
            $formdata['branch_name'] = $this->input->post('branch_name');
            $id = $this->AdminModel->insertBranch($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_branch", 'refresh');
            } else {
                redirect(base_url() . "admin/add_branch", 'refresh');
            }
        }
    }

    public function edit_branch($branch_id = '')
    {
        $data['branchdata'] = $this->AdminModel->getBranchById($branch_id);
        // print_r($data);exit;
        $tq_id = $data['branchdata']['taluka_id'];
        $data['taluka'] = $this->AdminModel->getAllTalukaList();
        $data['zoneList'] = $this->AdminModel->getAllZoneByTalukaId($tq_id);

        if ($this->form_validation->run('add_branch') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_branch', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['zone_id'] = $this->input->post('zone_id');
            $formdata['branch_name'] = $this->input->post('branch_name');
            $formdata['branch_code'] = $this->input->post('branch_code');
            $branch_id = $this->input->post('branch_id');
            $id = $this->AdminModel->updateBranch($formdata, $branch_id);
            if ($id) {
                redirect(base_url() . "admin/master_branch", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_branch/$branch_id", 'refresh');
            }
        }
    }
    // Master Branch End

    // Master Brand Entry

    public function master_brand()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_brand',$data);
        $this->load->view('footer/footer');
    }

    public function add_brand()
    {
        if ($this->form_validation->run('add_brand') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_brand');
            $this->load->view('footer/footer');
        } else {
            $formdata['brand_name'] = $this->input->post('brand_name');
            $id = $this->AdminModel->insertBrand($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_brand", 'refresh');
            } else {
                redirect(base_url() . "admin/add_brand", 'refresh');
            }
        }
    }

    public function edit_brand($brand_id = '')
    {
        $data['branddata'] = $this->AdminModel->getBrandById($brand_id);

        if ($this->form_validation->run('add_brand') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_brand', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['brand_name'] = $this->input->post('brand_name');
            $brand_id = $this->input->post('brand_id');
            $id = $this->AdminModel->updateBrand($formdata, $brand_id);
            if ($id) {
                redirect(base_url() . "admin/master_brand", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_brand/$brand_id", 'refresh');
            }
        }
    }
    // master brand End

    // Master Category Entry

    public function master_category()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_category',$data);
        $this->load->view('footer/footer');
    }

    public function add_category()
    {
        if ($this->form_validation->run('add_category') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_category');
            $this->load->view('footer/footer');
        } else {
            $formdata['cat_name'] = $this->input->post('cat_name');
            $id = $this->AdminModel->insertCategory($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_category", 'refresh');
            } else {
                redirect(base_url() . "admin/add_category", 'refresh');
            }
        }
    }

    public function edit_category($cat_id = '')
    {
        $data['categorydata'] = $this->AdminModel->getCategoryById($cat_id);

        if ($this->form_validation->run('add_category') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_category', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['cat_name'] = $this->input->post('cat_name');
            $cat_id = $this->input->post('cat_id');
            $id = $this->AdminModel->updateCategory($formdata, $cat_id);
            if ($id) {
                redirect(base_url() . "admin/master_category", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_category/$cat_id", 'refresh');
            }
        }
    }
    // master Category End

    // Master Sub category Details

    public function master_sub_category()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_sub_category',$data);
        $this->load->view('footer/footer');
    }
    public function master_role()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_role',$data);
        $this->load->view('footer/footer');
    }
    public function master_assign_permisssion()
    {
        $data['admin_permission'] = $this->isAdminPermission;
        $this->load->view('header/header');
        $this->load->view('admin/master_assign_permisssion',$data);
        $this->load->view('footer/footer');
    }

    

    public function add_sub_category()
    {
        if ($this->form_validation->run('add_sub_category') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/add_sub_category');
            $this->load->view('footer/footer');
        } else {
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_name'] = $this->input->post('sub_cat_name');
            $id = $this->AdminModel->insertSubCategory($formdata);
            if ($id) {
                redirect(base_url() . "admin/master_sub_category", 'refresh');
            } else {
                redirect(base_url() . "admin/add_sub_category", 'refresh');
            }
        }
    }

    public function edit_sub_category($sub_cat_id = '')
    {
        $data['subcatdata'] = $this->AdminModel->getSubCategoryById($sub_cat_id);
        $data['category'] = $this->AdminModel->getAllCategoryList();

        if ($this->form_validation->run('add_sub_category') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/edit_sub_category', $data);
            $this->load->view('footer/footer');
        } else {
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_name'] = $this->input->post('sub_cat_name');
            $sub_cat_id = $this->input->post('sub_cat_id');
            $id = $this->AdminModel->updateSubCategory($formdata, $sub_cat_id);
            if ($id) {
                redirect(base_url() . "admin/master_sub_category", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_sub_category/$sub_cat_id", 'refresh');
            }
        }
    }
    // Master Zone End

    public function users()
    {

        $assign_Arr = [];
        // $foreachloop = '';
        $data['getallroles']  = $this->AdminModel->getAllroles(); 
       
        $this->load->view('header/header');
        if ($this->form_validation->run('users') == FALSE) {
            $this->load->view('admin/users',$data);
        } else {
            //  error_reporting(E_ALL);
            // ini_set('display_errors', '1');
            
            if ($this->input->post('role') != 6) {

                if (in_array("All", $this->input->post('taluka_id'))) {
                    $allTaluks = $this->AdminModel->getAllTalukas();
                    $_POST['taluka_id'] = array_column($allTaluks, "taluka_id");
                } else {
                    $_POST['taluka_id'] = $this->input->post('taluka_id');
                }

                if (isset($_POST['branch_id'])) {
                    if (in_array("All", $this->input->post('branch_id'))) {

                        $allbranch_id = $this->AdminModel->getAllBranchListTalikaWise($this->input->post('taluka_id'));
                        $_POST['branch_id'] = array_column($allbranch_id, "branch_id");
                    } else {
                        $_POST['branch_id'] = $this->input->post('branch_id');
                    }
                }


                if (isset($_POST['branch_id_one'])) {
                    if (in_array("All", $this->input->post('branch_id_one'))) {

                        $allbranch_id = $this->AdminModel->getAllBranchListTalikaWise($this->input->post('taluka_id'));
                        $_POST['branch_id_one'] = array_column($allbranch_id, "branch_id");
                    } else {
                        $_POST['branch_id_one'] = $this->input->post('branch_id_one');
                    }
                }

                if ($this->input->post('role') == 5) {
                    if (in_array('All', $this->input->post('branch_id'))) {
                        $get_branch_by_taluka_id = $this->AdminModel->get_branch_by_taluka_id($this->input->post('taluka_id'));
                        $_POST['branch_id'] = array_column($get_branch_by_taluka_id, "branch_id");
                    }
                }
                if ($this->input->post('role') == 9) {
                    if (in_array('All', $this->input->post('branch_id'))) {
                        $get_branch_by_taluka_id = $this->AdminModel->get_branch_by_taluka_id($this->input->post('taluka_id'));
                        $_POST['branch_id'] = array_column($get_branch_by_taluka_id, "branch_id");
                    }
                }
                if ($this->input->post('role') == 3) {
                    if (in_array('All', $this->input->post('branch_id_one'))) {
                        $get_branch_by_taluka_id = $this->AdminModel->get_branch_by_taluka_id($this->input->post('taluka_id'));
                        $_POST['branch_id_one'] = array_column($get_branch_by_taluka_id, "branch_id");
                    }
                }
            }

            // printData($_POST);
            // die;

            $taluka_id_implode = '';
            $branch_id_implode = '';
            $branch_id_one_implode = '';

            $formdata['name'] = $this->input->post('name');
            $formdata['email'] = $this->input->post('email');
            $formdata['mobile'] = $this->input->post('mobile');
            $formdata['role'] = $this->input->post('role');
            $formdata['emp_id'] = $this->input->post('emp_id');
            $formdata['username'] = $this->input->post('emp_id');
            $formdata['password'] = "Vidya@123"; //$this->input->post('mobile');

            if (is_array($this->input->post('taluka_id'))) {
                $taluka_id_implode = implode(",", $this->input->post('taluka_id'));
            } else {
                $taluka_id_implode = $this->input->post('taluka_id');
            }

            if (is_array($this->input->post('branch_id'))) {
                $branch_id_implode = implode(",", $this->input->post('branch_id'));
            } else {
                $branch_id_implode = $this->input->post('branch_id');
            }
            if (is_array($this->input->post('branch_id_one'))) {
                $branch_id_one_implode = implode(",", $this->input->post('branch_id_one'));
            } else {
                $branch_id_one_implode = $this->input->post('branch_id_one');
            }

            $role = $this->input->post('role');
            if ($role != 6 || $role != 4) {
                #$formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['taluka_id']  = $taluka_id_implode;
                // $formdata['zone_id'] = $this->input->post('zone_id');

                if (is_array($this->input->post('zone_id'))) {
                    $zone_id_implode = implode(",", $this->input->post('zone_id'));
                } else {
                    $zone_id_implode = $this->input->post('zone_id');
                }
                $formdata['zone_id'] = $zone_id_implode;
            }
            if ($role == 3) {

                #$formdata['branch_id'] = $this->input->post('branch_id_one');
                $formdata['branch_id']  = $branch_id_one_implode;

                #$formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['taluka_id']  = $taluka_id_implode;
                // $formdata['zone_id'] = $this->input->post('zone_id');
                if (is_array($this->input->post('zone_id'))) {
                    $zone_id_implode = implode(",", $this->input->post('zone_id'));
                } else {
                    $zone_id_implode = $this->input->post('zone_id');
                }
                $formdata['zone_id'] = $zone_id_implode;
            }
            if ($role == 5) {
                #$formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['taluka_id']  = $taluka_id_implode;
                // $formdata['zone_id'] = $this->input->post('zone_id');

                if (is_array($this->input->post('zone_id'))) {
                    $zone_id_implode = implode(",", $this->input->post('zone_id'));
                } else {
                    $zone_id_implode = $this->input->post('zone_id');
                }
                $formdata['zone_id'] = $zone_id_implode;

                $branches = $this->input->post('branch_id');
                $branch_id = implode(",", $branches);
                // $formdata['branch_id'] = $branch_id;
                $formdata['branch_id']  = $branch_id_implode;
            }
            if ($role == 9) {
                $formdata['taluka_id']  = $taluka_id_implode;
                if (is_array($this->input->post('zone_id'))) {
                    $zone_id_implode = implode(",", $this->input->post('zone_id'));
                } else {
                    $zone_id_implode = $this->input->post('zone_id');
                }
                $formdata['zone_id'] = $zone_id_implode;
                $branches = $this->input->post('branch_id');
                $branch_id = implode(",", $branches);               
                $formdata['branch_id']  = $branch_id_implode;
            }

            if (array_key_exists('branch_id', $this->input->post())) {
                if (count($this->input->post('branch_id')) > 0) {
                    $foreachloop = 'branch_id';
                }
            }
            if (array_key_exists('branch_id_one', $this->input->post())) {
                if (count($this->input->post('branch_id_one')) > 0) {
                    $foreachloop = 'branch_id_one';
                }
            }
            // print_r($this->input->post($foreachloop));

            // printData($formdata);die;
            $id = $this->AdminModel->insertUsers($formdata);
            // echo $id;die;
            // foreach ($this->input->post('branch_id') as $key => $value) {
            foreach ($this->input->post($foreachloop) as $key => $value) {
                $assign_Arr[$key]['id'] = '';
                $assign_Arr[$key]['user_id'] = $id;
                $assign_Arr[$key]['branch_id'] = $value;
                $assign_Arr[$key]['assign_by'] = $_SESSION['login_user_id'];
                $assign_Arr[$key]['assign_date'] = date("Y-m-d");
            }

            if ($id) {
                $users_assign_branches = $this->AdminModel->users_assign_branches($assign_Arr);
                $this->session->set_flashdata("success", "1 Record Added");
                redirect(base_url() . "admin/users_list", 'refresh');
            } else {
                $this->session->set_flashdata("error", " Record Not Added");
                redirect(base_url() . "admin/users", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }

    public function users_old()
    {
        $this->load->view('header/header');
        if ($this->form_validation->run('users') == FALSE) {
            $this->load->view('admin/users');
        } else {
            $formdata['name'] = $this->input->post('name');
            $formdata['email'] = $this->input->post('email');
            $formdata['mobile'] = $this->input->post('mobile');
            $formdata['role'] = $this->input->post('role');
            $formdata['username'] = $this->input->post('email');
            $formdata['password'] = $this->input->post('mobile');


            $role = $this->input->post('role');
            if ($role != 6) {
                $formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['zone_id'] = $this->input->post('zone_id');
            }
            if ($role == 3) {
                $formdata['branch_id'] = $this->input->post('branch_id_one');
            }
            if ($role == 4 || $role == 5) {
                $branches = $this->input->post('branch_id');
                $branch_id = implode(",", $branches);
                $formdata['branch_id'] = $branch_id;
            }

            $id = $this->AdminModel->insertUsers($formdata);
            if ($id) {
                $this->session->set_flashdata("success", "1 Record Added");
                redirect(base_url() . "admin/users_list", 'refresh');
            } else {
                $this->session->set_flashdata("error", " Record Not Added");
                redirect(base_url() . "admin/users", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }
    public function users_list()
    {
        $this->load->view('header/header');
        $this->load->view('admin/users_list');
        $this->load->view('footer/footer');
    }
    public function user_details($user_id = '')
    {
        $data['userData'] = $this->AdminModel->getUserDetaildById($user_id);
        if ($data['userData']['role'] == 4) {
            $branches_id = $data['userData']['branch_id'];
            $data['branch'] = $this->AdminModel->getBranchesById($branches_id);
        }
        // print_r($data['branch']);exit;

        $this->load->view('header/header');
        $this->load->view('admin/user_details', $data);
        $this->load->view('footer/footer');
    }

    public function edit_users($user_id = '')
    {

        $data['userData'] = $this->AdminModel->getUserDetaildById($user_id);

        $talukanameStr = array_unique(explode(",", $data['userData']['taluka_name']));
        $branchanameStr = array_unique(explode(",", $data['userData']['branch_name']));

        ## remove duplicate values from taluka and branc name and get unique values from both
        $data['userData']['taluka_name'] = $talukanameStr;

        $data['userData']['branch_name'] = $branchanameStr;

        $data['assing_taluka_name'] = json_encode(array_unique($talukanameStr));
        $data['assign_branch_name'] = json_encode(array_unique($branchanameStr));
        $data['assign_zone_name'] = $this->AdminModel->assign_zone_name($data['userData']['zone_id']);

        $this->load->view('header/header');
        if ($this->form_validation->run('users') == FALSE) {
            $this->load->view('admin/edit_users', $data);
        } else {

            if (isset($_POST['branch_id'])) {
                if (in_array("ALL", $this->input->post('taluka_id'))) {
                    $allTaluks = $this->AdminModel->getAllTalukas();
                    $_POST['taluka_id'] = array_column($allTaluks, "taluka_id");
                } else {
                    $_POST['taluka_id'] = $this->input->post('taluka_id');
                }
            }


            if (isset($_POST['branch_id'])) {
                if (in_array("ALL", $this->input->post('branch_id'))) {
                    $allbranch_id = $this->AdminModel->getAllBranchListTalikaWise($this->input->post('taluka_id'));
                    $_POST['branch_id'] = array_column($allbranch_id, "branch_id");
                    $_POST['branch_id_one'] = array_column($allbranch_id, "branch_id");
                } else {
                    $_POST['branch_id'] = $this->input->post('branch_id');
                }
            }

            if (isset($_POST['branch_id_one']) && is_array($_POST['branch_id_one'])) {
                if (in_array("ALL", $this->input->post('branch_id_one'))) {

                    $allbranch_id = $this->AdminModel->getAllBranchListTalikaWise($this->input->post('taluka_id'));
                    $_POST['branch_id_one'] = array_column($allbranch_id, "branch_id");
                } else {
                    $_POST['branch_id_one'] = $this->input->post('branch_id_one');
                }
            }


            $user_id = $this->input->post('user_id');

            $formdata['name'] = $this->input->post('name');
            $formdata['email'] = $this->input->post('email');
            $formdata['emp_id'] = $this->input->post('emp_id');
            $formdata['mobile'] = $this->input->post('mobile');

            $formdata['username'] = $this->input->post('emp_id');
            $formdata['password'] = $this->input->post('mobile');

            $role = $this->input->post('role');

            $formdata['role'] = $role;
            if ($role == 2) {
                $formdata['taluka_id'] = implode(',', $this->input->post('taluka_id'));
                $formdata['taluka_id'] = implode(',', $this->input->post('taluka_id'));
                $formdata['zone_id'] = implode(',', $this->input->post('zone_id'));
            }
            if ($role == 3) {
                $formdata['branch_id'] = implode(',', $this->input->post('branch_id_one'));
                $formdata['taluka_id'] = implode(',', $this->input->post('taluka_id'));
                $formdata['zone_id'] = implode(',', $this->input->post('zone_id'));
            }
            if ($role == 5) {
                $formdata['branch_id'] = $this->input->post('branch_id_one');
                $formdata['zone_id'] = implode(',', $this->input->post('zone_id'));
                $formdata['taluka_id'] = implode(',', $this->input->post('taluka_id'));
                $branches = $this->input->post('branch_id');
                $branch_id = implode(",", $branches);
                $formdata['branch_id'] = $branch_id;
            }
            // printData($formdata);
            // die;
            $id = $this->AdminModel->updateUsers($formdata, $user_id);
            if ($id) {
                redirect(base_url() . "admin/users_list", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_users", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }

    public function edit_users_old($user_id = '')
    {
        $data['userData'] = $this->AdminModel->getUserDetaildById($user_id);
        $this->load->view('header/header');
        if ($this->form_validation->run('users') == FALSE) {
            $this->load->view('admin/edit_users', $data);
        } else {
            $user_id = $this->input->post('user_id');
            $formdata['name'] = $this->input->post('name');
            $formdata['email'] = $this->input->post('email');
            $formdata['mobile'] = $this->input->post('mobile');
            $role = $this->input->post('role');
            $formdata['role'] = $role;
            if ($role == 2) {
                $formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['zone_id'] = $this->input->post('zone_id');
            }
            if ($role == 3) {
                $formdata['branch_id'] = $this->input->post('branch_id_one');
                $formdata['taluka_id'] = $this->input->post('taluka_id');
                $formdata['zone_id'] = $this->input->post('zone_id');
            }
            if ($role == 4) {
                $formdata['branch_id'] = $this->input->post('branch_id_one');
                $formdata['taluka_id'] = $this->input->post('taluka_id');
                $branches = $this->input->post('branch_id');
                $branch_id = implode(",", $branches);
                $formdata['branch_id'] = $branch_id;
            }
            $id = $this->AdminModel->updateUsers($formdata, $user_id);
            if ($id) {
                redirect(base_url() . "admin/users_list", 'refresh');
            } else {
                redirect(base_url() . "admin/edit_users", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }
    public function ticketDashboard()
    {
        $total['total'] = $this->AdminModel->totalticket();
        $total['todaytotalticket'] = $this->AdminModel->todaytotalticket();
        $total['Inprogresstotalticket'] = $this->AdminModel->Inprogresstotalticket();
        $total['Pendingtotalticket'] = $this->AdminModel->Pendingtotalticket();
        $total['Closetotalticket'] = $this->AdminModel->Closetotalticket();
        $total['Queriedticket'] = $this->AdminModel->Queriedticket();
        $total['Forwardedticket'] = $this->AdminModel->Forwardedticket();
       
        $this->load->view('header/header');
        $this->load->view('admin/ticketDashboard', $total);
        $this->load->view('footer/footer');
    }

    public function reopenTickets()
    {
        $this->load->view('header/header');
        $this->load->view('admin/queriedTicketAdminView');
        $this->load->view('footer/footer');
    }

    public function getQueriedTicketAdmin()
    {
        $user_id = $this->session->userdata('login_user_id');
        $getticket = $this->AdminModel->getQueriedTicketAdmin($user_id);
        echo json_encode($getticket);
    }

    public function newTicket()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // $data['AllInventory']=$this->InventoryModel->getAllInventory();
        // printData($data['AllInventory']);
        // printData($_SESSION);
        // die;
        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['allusers'] = $this->InventoryModel->allusers();

        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $categorySWSN = [];
        foreach ($data['getAllCategory'] as $key => $category) {
            if ($data['getAllCategory'][$key]['cat_id'] == 2) {
                $categorySWSN[$key]['cat_id'] = $category['cat_id'];
                $categorySWSN[$key]['cat_name'] = $category['cat_name'];
            }
            if ($data['getAllCategory'][$key]['cat_id'] == 5) {
                $categorySWSN[$key]['cat_id'] = $category['cat_id'];
                $categorySWSN[$key]['cat_name'] = $category['cat_name'];
            }
            if ($data['getAllCategory'][$key]['cat_id'] == 6) {
                $categorySWSN[$key]['cat_id'] = $category['cat_id'];
                $categorySWSN[$key]['cat_name'] = $category['cat_name'];
            }
        }
        $data['onlyeSWNKCategortList'] =  $categorySWSN;
        $data['onlyeSWNKSUBCategortList'] =  $this->InventoryModel->onlyeSWNKSUBCategortList();
        // printData($data['onlyeSWNKSUBCategortList']);
        // die;


        $this->load->view('header/header');
        $this->load->view('admin/newTicket', $data);
        $this->load->view('footer/footer');
    }
    public function newTicket_old()
    {
        $module_id = 1;
        $CounterData = $this->AdminModel->getCounter($module_id);

        $this->load->view('header/header');
        if ($this->form_validation->run('newTicket') == FALSE) {
            $this->load->view('admin/newTicket');
        } else {
            $ticket_no = date('Ymd') . $CounterData['counter'] + 1;
            $taluka_id = $this->input->post('taluka_id');
            $zone_id = $this->input->post('zone_id');
            $branch_id = $this->input->post('branch_id');
            if (empty($taluka_id)) {
                $taluka_id = $this->session->userdata('login_taluka_id');
            }
            if (empty($zone_id)) {
                $zone_id = $this->session->userdata('login_zone_id');
            }
            if (empty($branch_id)) {
                $branch_id = $this->session->userdata('login_branch_id');
            }

            $formdata['taluka_id'] = $taluka_id;
            $formdata['zone_id'] = $zone_id;
            $formdata['branch_id'] = $branch_id;


            $formdata['ticket_no'] = $ticket_no;
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['inventory_id'] = $this->input->post('inventory_id');
            $formdata['ticket_title'] = $this->input->post('ticket_title');
            $formdata['description'] = $this->input->post('description');
            $formdata['user_id'] = $this->input->post('user_id');
            $formdata['created_on'] = date('Y-m-d');
            $formdata['updated_on'] = date('Y-m-d');
            $formdata['status'] = 'New';
            $formdata['created_by'] = $this->session->userdata('login_user_id');

            if (!file_exists('uploads/ticket')) {
                mkdir('uploads/ticket', 0777, true);
            }

            $attachmentsize = $_FILES['attachment']['tmp_name'];
            if ($attachmentsize) {
                $attachmentpath = 'uploads/ticket/';
                $attachmentlocation = $attachmentpath . time() . 'attachment' . $_FILES['attachment']['name'];
                move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentlocation);
            } else {
                $attachmentlocation = '';
            }
            $formdata['attachment'] = $attachmentlocation;


            $id = $this->AdminModel->insertNewTicket($formdata);


            $counter = $CounterData['counter'] + 1;
            $Counterformdata['counter'] = $counter;
            $this->AdminModel->updateCounter($Counterformdata, $module_id);
            if ($id) {
                $this->session->set_flashdata("success", "1 Record Added");
                redirect(base_url() . "admin/ticketDashboard", 'refresh');
            } else {
                $this->session->set_flashdata("error", " Record Not Added");
                redirect(base_url() . "admin/newTicket", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }



    public function ticketView($ticket_id)
    {
        $this->load->model('AdminModel');
        $data['ticket'] = $this->AdminModel->getTicketById($ticket_id);
        // printData($data);die;
        $this->load->view('header/header');
        $this->load->view('admin/ticketView', $data);
        $this->load->view('footer/footer');
    }
    public function ticketReply($ticket_id)
    {
        $this->load->model('AdminModel');
        $data['ticket'] = $this->AdminModel->getTicketById($ticket_id);
        $this->load->view('header/header');
        $this->load->view('admin/ticketReply', $data);
        $this->load->view('footer/footer');
    }
    public function totalTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/totalTicket');
        $this->load->view('footer/footer');
    }
    public function todaysTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/todaysTicket');
        $this->load->view('footer/footer');
    }
    public function inprogresTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/inprogresTicket');
        $this->load->view('footer/footer');
    }
    public function pendingTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/pendingTicket');
        $this->load->view('footer/footer');
    }
    public function closedTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/closedTicket');
        $this->load->view('footer/footer');
    }

    public function forwardedTicket()
    {
        $this->load->view('header/header');
        $this->load->view('admin/forwardedTicket');
        $this->load->view('footer/footer');
    }

    public function ticketQuery($ticket_id = '')
    {
        $this->load->view('header/header');
        $this->load->model('AdminModel');
        $data['ticket'] = $this->AdminModel->getTicketById($ticket_id);
        if ($this->form_validation->run('ticketQuery') == FALSE) {
            $this->load->view('admin/ticketQuery', $data);
        } else {
            $formdata['ticket_query'] = $this->input->post('ticket_query');
            $formdata['queried_by'] = $this->session->userdata('login_user_id');
            $formdata['status'] = 'Queried';
            $ticket_id = $this->input->post('ticket_id');
            $formdata['queried_on'] = date('Y-m-d');

            $id = $this->AdminModel->updateTicket($ticket_id, $formdata);
            if ($id) {
                $this->session->set_flashdata("success", "Ticket Query Updated");
                redirect(base_url() . "Admin/ticketDashboard", 'refresh');
            } else {
                $this->session->set_flashdata("error", " Ticket Query Not Updated");
                redirect(base_url() . "Admin/ticketDashboard", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }


    public function ticketTitle($ticket_id = '')
    {
        $this->load->view('header/header');
        $this->load->model('AdminModel');
        $data['getAllCategory'] = $this->AdminModel->getAllCategoryList();
        if ($this->form_validation->run('ticketTitle') == FALSE) {
            $this->load->view('admin/ticketTitle', $data);
        } else {
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['ticket_title'] = $this->input->post('ticket_title');
            $id = $this->AdminModel->addTicketTitle($formdata);
            if ($id) {
                $this->session->set_flashdata("success", "Inserted Successfylly");
                redirect(base_url() . "Admin/ticketDashboard", 'refresh');
            } else {
                $this->session->set_flashdata("error", " Not Inserted");
                redirect(base_url() . "Admin/titcketTitle", 'refresh');
            }
        }
        $this->load->view('footer/footer');
    }

    public function masterTitle()
    {
        $this->load->view('header/header');
        $this->load->view('admin/masterTitle');
        $this->load->view('footer/footer');
    }
    public function getTcketTitle()
    {
        $getTicketTitle = $this->AdminModel->getTicketTitle();
        echo json_encode($getTicketTitle);
    }

    public function call_log_master()
    {
        $this->load->view('header/header');
        $this->load->view('admin/call_log_master');
        $this->load->view('footer/footer');
    }

    public function getCallLogs()
    {
        $callLog = $this->AdminModel->getCallLogs();
        echo json_encode($callLog);
    }


    public function call_logs()
    {
        if ($this->form_validation->run('call_logs') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('admin/call_logs');
            $this->load->view('footer/footer');
        } else {
            $formdata['call_from'] = $this->input->post('call_from');
            $formdata['call_to'] = $this->input->post('call_to');
            $formdata['description'] = $this->input->post('description');
            $id = $this->AdminModel->insertCallLog($formdata);
            if ($id) {
                redirect(base_url() . "admin/call_log_master", 'refresh');
            } else {
                redirect(base_url() . "admin/call_logs", 'refresh');
            }
        }
    }

    ## added by Harshdeep 
    ## for stroting new ticket
    ## from forn 
    function addnewTicketAjax()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // printData($_POST);
        // die;
        $module_id = 1;
        $CounterData = $this->AdminModel->getCounter($module_id);
        $ticket_no = date('Ymd') . $CounterData['counter'] + 1;

        $config['upload_path'] = './uploads/ticket/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx|txt'; // Adjust based on your requirements
        $config['max_size'] = 5048; // 5MB
        $config['encrypt_name'] = FALSE; // To generate a unique name for the file
        $file_extension = pathinfo($_FILES['sw_attachment']['name'], PATHINFO_EXTENSION);
        // Generate a custom file name
        $new_name = $ticket_no . '_' . time() . '.' . $file_extension;
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if (empty($_FILES['sw_attachment']['name'])) {
            $newname = "";
        } else {
            if (!$this->upload->do_upload('sw_attachment')) {
                $response = array('status' => false, 'message' => "Error With Selected File", 'code' => 300);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            }

            $upload_data = $this->upload->data();
            $newname = $upload_data['file_name'];
        }

        $taluka_id = $this->input->post('sw_talukaId');
        $zone_id = $this->input->post('sw_zoneId');
        $branch_id = $this->input->post('sw_branch_id');

        if (empty($taluka_id)) {
            $taluka_id = $this->session->userdata('login_taluka_id');
        }
        if (empty($zone_id)) {
            $zone_id = $this->session->userdata('login_zone_id');
        }
        if (empty($branch_id)) {
            $branch_id = $this->session->userdata('login_branch_id');
        }


        $formdata['taluka_id']           = $taluka_id;
        $formdata['zone_id']             = $zone_id;
        $formdata['branch_id']           = $branch_id;
        $formdata['ticket_no']           = $ticket_no;
        $formdata['cat_id']              = $this->input->post('sw_cat_id');
        $formdata['sub_cat_id']          = $this->input->post('sw_sub_cat_id');
        $formdata['brand_id']            = $this->input->post('sw_branch_id');
        $formdata['inventory_id']        = "";
        $formdata['ticket_title']        = $this->input->post('sw_ticket_title');
        $formdata['description']         = $this->input->post('sw_description');
        $formdata['attachment']          = $newname;
        $formdata['user_id']             = $this->input->post('sw_user_id');
        $formdata['created_on']          = trim(date('Y-m-d'));
        $formdata['updated_on']          = trim(date('Y-m-d'));
        $formdata['status']              = 'New';
        $formdata['ticket_priority']     = $this->input->post('sw_ticket_priority');
        $formdata['created_by']          = $this->session->userdata('login_user_id');
        // printData($formdata);
        // die;
        $id = $this->AdminModel->addnewTicketAjax($formdata);

        $counter = $CounterData['counter'] + 1;
        $Counterformdata['counter'] = $counter;
        $this->AdminModel->updateCounter($Counterformdata, $module_id);
        if (!empty($id)) {
            $response = array('status' => true, 'message' => "New Added Successfully And Ticket Id - .$ticket_no", 'code' => 200);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(1);
        } else {
            $response = array('status' => false, 'message' => "error while adding new ticket", 'code' => 302);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(1);
        }
    }
    ## added by Harshdeep
    ## for Storing Ticket Information From Table Icon Click

    function addnewTicketAjaxTable()
    {
        // printData($_POST);
        // die;
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // die;
        $module_id = 1;
        $CounterData = $this->AdminModel->getCounter($module_id);
        $ticket_no = date('Ymd') . $CounterData['counter'] + 1;

        $config['upload_path'] = './uploads/ticket/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx|txt'; // Adjust based on your requirements
        $config['max_size'] = 5048; // 5MB
        $config['encrypt_name'] = FALSE; // To generate a unique name for the file
        $file_extension = pathinfo($_FILES['hrd_attachment']['name'], PATHINFO_EXTENSION);
        // Generate a custom file name
        $new_name = $ticket_no . '_' . time() . '.' . $file_extension;
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        if (empty($_FILES['hrd_attachment']['name'])) {
            $newname = "";
        } else {
            if (!$this->upload->do_upload('hrd_attachment')) {
                $response = array('status' => false, 'message' => "Error With Selected File", 'code' => 300);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            }

            $upload_data = $this->upload->data();
            $newname = $upload_data['file_name'];
        }


        $upload_data = $this->upload->data();


        $taluka_id = $this->input->post('hw_talukaId');
        $zone_id = $this->input->post('hw_zoneId');
        $branch_id = $this->input->post('hw_branch_id');

        if (empty($taluka_id)) {
            $taluka_id = $this->session->userdata('login_taluka_id');
        }
        if (empty($zone_id)) {
            $zone_id = $this->session->userdata('login_zone_id');
        }
        if (empty($branch_id)) {
            $branch_id = $this->session->userdata('login_branch_id');
        }


        $formdata['taluka_id']           = $taluka_id;
        $formdata['zone_id']             = $zone_id;
        $formdata['branch_id']           = $branch_id;
        $formdata['ticket_no']           = $ticket_no;
        $formdata['cat_id']              = $this->input->post('hrd_cat_id');
        $formdata['sub_cat_id']          = $this->input->post('hrd_sub_cat_id');
        $formdata['brand_id']            = $this->input->post('hrd_brand_id');
        $formdata['inventory_id']        = $this->input->post('hrd_inventory_id');
        $formdata['ticket_title']        = $this->input->post('hrd_ticket_title');
        $formdata['description']         = $this->input->post('hrd_description');
        $formdata['attachment']          = $newname; //$upload_data['file_name'];
        $formdata['user_id']             = $this->input->post('hrd_user_id');
        $formdata['created_on']          = trim(date('Y-m-d'));
        $formdata['updated_on']          = trim(date('Y-m-d'));
        $formdata['status']              = 'New';
        $formdata['ticket_priority']              = $this->input->post('hw_ticket_priority');
        $formdata['created_by']          = $this->session->userdata('login_user_id');

        $id = $this->AdminModel->addnewTicketAjax($formdata);

        $counter = $CounterData['counter'] + 1;
        $Counterformdata['counter'] = $counter;
        $this->AdminModel->updateCounter($Counterformdata, $module_id);
        if (!empty($id)) {
            $response = array('status' => true, 'message' => "New Ticket Added Successfully And Ticket Id- .$ticket_no", 'code' => 200);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(1);
        } else {
            $response = array('status' => false, 'message' => "error while adding new ticket", 'code' => 302);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit(1);
        }
    }
}
