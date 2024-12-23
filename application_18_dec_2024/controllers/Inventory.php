<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends  CI_Controller
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
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('inventory/inventory_dashboard');
        $this->load->view('footer/footer');
    }

    public function getBranchAjaxNew()
    {
        $getBranch = $this->InventoryModel->getBranchInventory($this->input->post('zone_id'));
        echo json_encode($getBranch);
    }

    public function new_item_list()
    {
        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();


        if ($this->form_validation->run('new_item_list') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('inventory/new_item_list', $data);
            $this->load->view('footer/footer');
        } else {

            $formdata['item_name'] = $this->input->post('item_name');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['id'] = $this->input->post('sub_cat_id');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['po_date'] = $this->input->post('po_date');
            $formdata['po_no'] = $this->input->post('po_no');
            $formdata['user_id'] = $this->input->post('user_id');
            $formdata['warranty_period'] = $this->input->post('warranty_period');
            $formdata['optional_1'] = $this->input->post('optional_1');
            $formdata['optional_2'] = $this->input->post('optional_2');
            $formdata['inserted_on'] = date('Y-m-d H:i:s');

            $warranty_period = $this->input->post('warranty_period');
            $year = '+' . $warranty_period . ' months';
            $make_date = $this->input->post('make_date');
            $expiry_date = date('Y-m-d', strtotime($year, strtotime($make_date)));
            $formdata['expiry_date'] = $expiry_date;

            //    $warranty_period=$this->input->post('warranty_period');
            //   $year='+'.$warranty_period;
            //   $make_date=$this->input->post('make_date');
            // echo $new_date = date('Y-m-d', strtotime($year, strtotime($make_date)));  
            $id = $this->InventoryModel->insertInventory($formdata);
            if ($id) {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                redirect(base_url() . "Inventory/assign_inventory", 'refresh');
            } else {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                redirect(base_url() . "Inventory/new_item_list", 'refresh');
            }
        }
    }
    public function new_itemList_view()
    {
        // $data['AllInventory']=$this->InventoryModel->getAllInventory();

        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['allusers'] = $this->InventoryModel->allusers();

        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['getAllSubCategory'] = $this->InventoryModel->getAllSubCategoryList();
        $data['usersSessionData'] = $_SESSION;
        // printData($_SESSION);
        // printData($data['getAllSubCategory']);
        // die;
        //new_itemList_viewAdmin
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
        }
        $data['onlyeSWNKCategortList'] =  $categorySWSN;
        $data['onlyeSWNKSUBCategortList'] =  $this->InventoryModel->onlyeSWNKSUBCategortList();
        // printData($_SESSION);die;
        $this->load->view('header/header');
        if ($_SESSION['login_role'] == 1 || $_SESSION['login_role'] == 8 || $_SESSION['login_role'] == 7) {
            $this->load->view('inventory/new_itemList_viewAdmin', $data);
        } else {
            $this->load->view('inventory/new_itemList_view', $data);
        }
        $this->load->view('footer/footer');
    }

    public function new_item_view($inventory_id)
    {
        $data['AllInventory'] = $this->InventoryModel->getInventoryById($inventory_id);

        $this->load->view('header/header');
        $this->load->view('inventory/new_item_view', $data);
        $this->load->view('footer/footer');
    }

    public function new_item_edit($inventory_id = '')
    {
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['AllInventory'] = $this->InventoryModel->getInventoryById($inventory_id);
        $role = 6;
        $data['getUser'] = $this->InventoryModel->getUsersByRole($role);


        if ($this->form_validation->run('new_item_list') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('inventory/new_item_edit', $data);
            $this->load->view('footer/footer');
        } else {
            $inventory_id = $this->input->post('inventory_id');
            $formdata['item_name'] = $this->input->post('item_name');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['po_date'] = $this->input->post('po_date');
            $formdata['po_no'] = $this->input->post('po_no');
            $formdata['user_id'] = $this->input->post('user_id');
            $formdata['warranty_period'] = $this->input->post('warranty_period');
            $formdata['optional_1'] = $this->input->post('optional_1');
            $formdata['optional_2'] = $this->input->post('optional_2');
            $formdata['updated_on'] = date('Y-m-d H:i:s');

            $warranty_period = $this->input->post('warranty_period');
            $year = '+' . $warranty_period . ' months';
            $make_date = $this->input->post('make_date');
            $expiry_date = date('Y-m-d', strtotime($year, strtotime($make_date)));
            $formdata['expiry_date'] = $expiry_date;

            //    $warranty_period=$this->input->post('warranty_period');
            //   $year='+'.$warranty_period;
            //   $make_date=$this->input->post('make_date');
            // echo $new_date = date('Y-m-d', strtotime($year, strtotime($make_date)));
            $id = $this->InventoryModel->updateInventory($formdata, $inventory_id);
            if ($id) {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                redirect(base_url() . "Inventory/assign_inventory", 'refresh');
            } else {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                redirect(base_url() . "Inventory/new_item_list", 'refresh');
            }
        }
    }

    public function dead_stock_list()
    {
        $data['AllInventory'] = $this->InventoryModel->getAllInventory();

        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['getallBranches'] = $this->InventoryModel->getallBranches();
        $this->load->view('header/header');
        $this->load->view('inventory/dead_stock_list', $data);
        $this->load->view('footer/footer');
    }

    function repair_stock_list(){
        $data['AllInventory'] = $this->InventoryModel->getAllInventory();

        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['getallBranches'] = $this->InventoryModel->getallBranches();

        $this->load->view('header/header');
        $this->load->view('inventory/repair_stock_list', $data);
        $this->load->view('footer/footer');
    }

    public function getSubCategory()
    { 
        $cat_id = $this->input->post('cat_id',true);
        $subCategory=$this->InventoryModel->getSubCategory($cat_id);
        echo json_encode($subCategory);
        exit(1);
        // if(!empty($subCategory)){
        //     echo json_encode(array('status'=>true,"data"=>$subCategory,'code'=>200));
        //     exit(1);
        // }else{
        //     echo json_encode(array('status'=>false,"data"=>array(),'code'=>200));
        //     exit(1);
        // }
    }
    
    public function getBranchAjax()
    {
        $getBranch = $this->InventoryModel->getBranch($this->input->post('zone_id'));
        echo json_encode($getBranch);
    }
    public function assign_inventory()
    {
        // $allTalukaArr = ['4','5','6','7'];
        $allTalukaArr = ['4', '5', '6'];
        if (in_array($_SESSION['login_role'], $allTalukaArr)) {
            $merge_taluka_id_with_taluka_list_arr = array_combine(explode(",", $_SESSION['login_taluka_id']), $_SESSION['getallTalukaList']);

            $data['AllTaluka'] =  $merge_taluka_id_with_taluka_list_arr;
        } else {
            $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        }
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
       
        if ($_SESSION['login_role'] == 1) {
            $viewname = "assign_inventory_admin";
        } else {
            $viewname = "assign_inventory";
        }

        if ($this->form_validation->run('assign_inventory') == FALSE) {
            // if ($this->form_validation->run($viewname) == FALSE) {            
                $this->load->view('header/header');
                if ($_SESSION['login_role'] == 1 || $_SESSION['login_role'] == 7) {
                    $this->load->view('inventory/assign_inventory_admin', $data);
                } else {
                    $this->load->view('inventory/assign_inventory', $data);
                }
                $this->load->view('footer/footer');
            } else {
                // printData($_POST);
                // die;
                $inventory_data = $this->input->post('id');
            foreach ($inventory_data as $key => $inventoryData) {
                $branch_id = $this->input->post('branch_id');
                $zone_id = $this->input->post('zone_id');
                $taluka_id = $this->input->post('taluka_id');
                $formdata['branch_id'] = $branch_id;
                $formdata['zone_id'] = $zone_id;
                $formdata['taluka_id'] = $taluka_id;
                $formdata['id'] = $inventoryData;
                $id['id'] = $inventoryData;
                $formdata2['branch_id'] = $branch_id;
                $formdata2['zone_id'] = $zone_id;
                $formdata2['taluka_id'] = $taluka_id;
                $formdata2['status'] = 2;
                // $id = $this->InventoryModel->insertAssignInventory($formdata);
                $id2 = $this->InventoryModel->updateAssignInventory($id, $formdata2);
            }
            if ($id2) {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                redirect(base_url() . "Inventory/assign_inventory", 'refresh');
            } else {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                redirect(base_url() . "Inventory/assign_inventory", 'refresh');
            }
        }
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function create_inventory()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $array_check_Serial_no_validation = ['1', '2', '3', '4', '24'];

        $allTalukaArr = ['4', '5', '6', '7'];
        if (in_array($_SESSION['login_role'], $allTalukaArr)) {
            $merge_taluka_id_with_taluka_list_arr = array_combine(explode(",", $_SESSION['login_taluka_id']), $_SESSION['getallTalukaList']);
            $data['AllTaluka'] =  $merge_taluka_id_with_taluka_list_arr;
        } else {
            $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        }

        // $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();

        $data['getItemNamesList'] = $this->InventoryModel->getItemNamesList();
        $data['getCPUSerialNoList'] = $this->InventoryModel->getCPUSerialNoList();

        if ($this->form_validation->run('create_inventory') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('inventory/create_inventory', $data);
            $this->load->view('footer/footer');
        } else {
            $response = [];
            // echo "<pre>";
            // printData($_POST);
            // die;

            $serialNo = $this->input->post('serial_no');
            $ip_address = $this->input->post('ip_address');

            if($serialNo != '' || $serialNo != null ){
                $checkSerialExists = $this->InventoryModel->checkSerialNumberExists($serialNo);
                if (!empty($checkSerialExists)) {
                    echo json_encode(array('status'=>false,"message"=>'Duplicate serial number Found in inventory','code'=>500));
                    exit(1);                 
                }
            }
            if($ip_address != '' || $ip_address != null ){
                $chechDuplicateIp = $this->InventoryModel->chechDuplicateIp($ip_address);
                if (!empty($chechDuplicateIp)) {
                    echo json_encode(array('status'=>false,"message"=>'Duplicate IP Address Found in inventory','code'=>500));
                    exit(1);                 
                }
            }

            $formdata['taluka_id'] = $this->input->post('taluka_id');
            $formdata['branch_id'] = $this->input->post('branch_id');
            $formdata['zone_id'] = $this->input->post('zone_id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['item'] = $this->input->post('item');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['atm_id'] = $this->input->post('atm_id');
            $formdata['ups_capacity'] = $this->input->post('ups_capacity');
            $formdata['no_of_batteries'] = $this->input->post('no_of_batteries');


            //indoor_outdoot_option
            // sub_cat_id == 7
            if ($this->input->post('sub_cat_id') == 7) {
                if ($this->input->post('indoor_outdoot_option') == "0") {
                    $formdata['indoor_camera'] = $this->input->post('indoor_outdoot_option');
                } else if ($this->input->post('indoor_outdoot_option') == "1") {
                    $formdata['outdoor_camera'] = $this->input->post('indoor_outdoot_option');
                }
            } else {
                $formdata['indoor_camera'] = $this->input->post('indoor_camera');
                $formdata['outdoor_camera'] = $this->input->post('outdoor_camera');
            }

            if ($this->input->post('sub_cat_id') == 12) {
                $formdata['department_name'] = $this->input->post('department');
            } else {
                $formdata['department_name'] = "";
            }

            if ($this->input->post('sub_cat_id') == 25 || $this->input->post('sub_cat_id') == 26) {
                $formdata['ram_hdd_size'] = $this->input->post('hdd_ram_size');
                $formdata['cpu_item_model_name'] = $this->input->post('cpu_item_model_name_input');
                $formdata['cpu_serial_no'] = $this->input->post('cpu_serial_no_input');
            } else {
                $formdata['ram_hdd_size'] = "";
                $formdata['cpu_item_model_name'] = "";
                $formdata['cpu_serial_no'] = "";
            }

            $formdata['total_camera'] = $this->input->post('total_camera');
            $formdata['backup_connectivity'] = $this->input->post('backup_connectivity');
            $formdata['network_rack'] = $this->input->post('network_rack');
            $formdata['network_card'] = $this->input->post('network_card');
            $formdata['atm_grounting'] = $this->input->post('atm_grounting');
            $formdata['atm_switch'] = $this->input->post('atm_switch');
            $formdata['atm_cctv'] = $this->input->post('atm_cctv');
            $formdata['atm_side'] = $this->input->post('atm_side');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['warranty'] = $this->input->post('warranty');
            $formdata['po_date'] = $this->input->post('po_date');
            $formdata['po_no'] = $this->input->post('po_no');
            $formdata['supplier'] = $this->input->post('supplier');
            $formdata['os'] = $this->input->post('os');
            $formdata['install_date'] = $this->input->post('install_date');
            $formdata['op_1'] = $this->input->post('op_1');
            $formdata['op_2'] = $this->input->post('op_2');
            $formdata['inserted_on'] = date('Y-m-d H:i:s');

            if ($this->input->post('branch_id')) {
                $formdata['status'] = 2;
            } else {
                $formdata['status'] = 1;
            }

            $warranty = $this->input->post('warranty');
            if ($warranty) {
                $year = '+' . $warranty . ' months';
                $make_date = $this->input->post('make_date');
                $exp_date = date('Y-m-d', strtotime($year, strtotime($make_date)));
                $formdata['exp_date'] = $exp_date;
            }

            // printData($formdata);
            // die;
            $id = $this->InventoryModel->createInventory($formdata);
            if ($id != '') {
                
                // redirect(base_url() . "Inventory/create_inventory", 'refresh');
                
                $response = [
                    'status' => true, "message" => "Inventory added successfully", 'code' => 200
                ];
                
            } else {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                // redirect(base_url() . "Inventory/new_item_list", 'refresh');
                // redirect(base_url() . "Inventory/create_inventory", 'refresh');

                 $response = [
                    'status' => false, "message" => "Error While adding inventory ", 'code' => 500
                ];
            }
            // printData($response);
            echo json_encode($response);
            exit(1);
        }
    }

    function checkSerialNumberExists($serial_no)
    {
        $result = $this->InventoryModel->checkSerialNumberExists($serial_no);
        return $result;
    }

    public function edit_inventory($id = '')
    {
       
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['AllInventory'] = $this->InventoryModel->getInventoryById($id);
        $role = 6;
        $data['getUser'] = $this->InventoryModel->getUsersByRole($role);

        if ($this->form_validation->run('edit_inventory') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('inventory/edit_inventory', $data);
            $this->load->view('footer/footer');
        } else {
            //  printData($_POST);
            //  die;
            $formdata['brand_id'] = $this->input->post('brand_id');
            $formdata['item'] = $this->input->post('item');
            $formdata['serial_no'] = $this->input->post('serial_no');
            $formdata['ip_address'] = $this->input->post('ip_address');
            $formdata['atm_id'] = $this->input->post('atm_id');
            $formdata['ups_capacity'] = $this->input->post('ups_capacity');
            $formdata['no_of_batteries'] = $this->input->post('no_of_batteries');
            $formdata['indoor_camera'] = $this->input->post('indoor_camera');
            $formdata['outdoor_camera'] = $this->input->post('outdoor_camera');
            $formdata['total_camera'] = $this->input->post('total_camera');
            $formdata['backup_connectivity'] = $this->input->post('backup_connectivity');
            $formdata['network_rack'] = $this->input->post('network_rack');
            $formdata['network_card'] = $this->input->post('network_card');
            $formdata['atm_grounting'] = $this->input->post('atm_grounting');
            $formdata['atm_switch'] = $this->input->post('atm_switch');
            $formdata['atm_cctv'] = $this->input->post('atm_cctv');
            $formdata['atm_side'] = $this->input->post('atm_side');
            $formdata['make_date'] = $this->input->post('make_date');
            $formdata['warranty'] = $this->input->post('warranty');
            $formdata['po_date'] = $this->input->post('po_date');
            $formdata['po_no'] = $this->input->post('po_no');
            $formdata['supplier'] = $this->input->post('supplier');
            $formdata['os'] = $this->input->post('os');
            $formdata['install_date'] = $this->input->post('install_date');
            $formdata['op_1'] = $this->input->post('op_1');
            $formdata['op_2'] = $this->input->post('op_2');
            $formdata['updated_on'] = date('Y-m-d H:i:s');

            // if ($this->input->post('branch_id')) 
            // {
            //    $formdata['status'] = 2;  
            // }
            // else
            // {
            //     $formdata['status'] = 1; 
            // }
            $warranty = $this->input->post('warranty');
            $id = $this->input->post('id');
            if ($warranty) {
                $year = '+' . $warranty . ' months';
                $make_date = $this->input->post('make_date');
                $exp_date = date('Y-m-d', strtotime($year, strtotime($make_date)));
                $formdata['exp_date'] = $exp_date;
            }

            $id = $this->InventoryModel->updateInventory($formdata, $id);
            if ($id) {
                // $this->session->set_flashdata('message_name', 'This is my message'); 
                // redirect(base_url() . "Inventory/assign_inventory", 'refresh');
                $response = [
                    'status' => true, "message" => "Inventory updated successfully", 'code' => 200
                ];
                //redirect(base_url() . "Inventory/new_itemList_view", 'refresh');
            } else {
                // $this->session->set_flashdata('MSG', ShowAlert("Failed to create new post/ live session, Please try again", "DD"));
                //redirect(base_url() . "Inventory/new_item_list", 'refresh');
                $response = [
                    'status' => false, "message" => "Error While updating inventory ", 'code' => 500
                ];
            }
            echo json_encode($response);
            exit(1);
        }
    }

    public function inventory_item()
    {
        $this->load->view('header/header');
        $this->load->view('inventory/inventory_item');
        $this->load->view('footer/footer');
    }
    public function getallitem()
    {
        $getallitem = $this->InventoryModel->getallitem();
        echo json_encode($getallitem);
    }
    public function add_item()
    {
        if ($this->form_validation->run('add_item') == FALSE) {
            $this->load->view('header/header');
            $this->load->view('inventory/add_item');
            $this->load->view('footer/footer');
        } else {
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['item_name'] = $this->input->post('item_name');
            $id = $this->InventoryModel->addItem($formdata);
            if ($id) {
                redirect(base_url() . "inventory/inventory_item", 'refresh');
            } else {
                redirect(base_url() . "inventory/add_item", 'refresh');
            }
        }
    }

    public function edit_item($id = '')
    {
        if ($this->form_validation->run('add_item') == FALSE) {
            // echo $id;exit;
            $data['id'] = $id;
            $this->load->view('header/header');
            $this->load->view('inventory/edit_item', $data);
            $this->load->view('footer/footer');
        } else {
            $id = $this->input->post('id');
            $formdata['cat_id'] = $this->input->post('cat_id');
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');
            $formdata['item_name'] = $this->input->post('item_name');
            $id = $this->InventoryModel->updateItem($formdata, $id);
            if ($id) {
                redirect(base_url() . "inventory/inventory_item", 'refresh');
            } else {
                redirect(base_url() . "inventory/edit_item", 'refresh');
            }
        }
    }

    public function getItemById($id = '')
    {
        $getItembyId = $this->InventoryModel->getItemById($id);
        echo json_encode($getItembyId);
    }

    public function getItemBySubCat($sub_cat_id)
    {
        $getItemBySubCat = $this->InventoryModel->getItemBySubCat($sub_cat_id);
        echo json_encode($getItemBySubCat);
    }

    public function getInventoryByIds($id)
    {
        $getItemBySubCat = $this->InventoryModel->getInventoryById($id);
        echo json_encode($getItemBySubCat);
    }


    public function deleteInventory($id)
    {
        $id = $this->InventoryModel->deleteInventory($id);
        if ($id) {
            $vals =  ['code' => true, 'msg' => 'Updated'];
            echo json_encode($vals);
        } else {
            $vals =  ['code' => false, 'msg' => 'Not Updated'];
            echo json_encode($vals);
        }
    }

    public function inventory_list()
    {
        // $data['AllInventory']=$this->InventoryModel->getAllInventory();

        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();

        $this->load->view('header/header');
        $this->load->view('inventory/inventory_list', $data);
        $this->load->view('footer/footer');
    }

    public function checkIpAddress()
    {
        $ip_address = base64_decode(($this->input->post('ip_address', TRUE)));
        if ($ip_address != '' && $ip_address != null) {
            $duplicateIp = $this->InventoryModel->chechDuplicateIp($ip_address);
            if (!empty($duplicateIp)) {
                echo json_encode($duplicateIp);
                exit(1);
            } else {
                echo json_encode(array());
                exit(1);
            }
        } else {
            echo json_encode(array());
            exit(1);
        }
    }

    public function chechDuplicateSerial()
    {
        $serial_no = base64_decode(($this->input->post('serial_no', TRUE)));
        $duplicateSerial = $this->InventoryModel->chechDuplicateSerial($serial_no);
        if (!empty($duplicateSerial)) {
            echo json_encode($duplicateSerial);
            exit(1);
        } else {
            echo json_encode(array());
            exit(1);
        }
    }

    function dead_movemeent_repair_logs(){
        $data['AllInventory'] = $this->InventoryModel->getAllInventory();

        $data['AllTaluka'] = $this->InventoryModel->getAllTalukaList();
        $data['getAllBrand'] = $this->InventoryModel->getAllBrandList();
        $data['getAllCategory'] = $this->InventoryModel->getAllCategoryList();
        $data['getallBranches'] = $this->InventoryModel->getallBranches();

        $this->load->view('header/header');
        $this->load->view('inventory/dead_movemeent_repair_logs', $data);
        $this->load->view('footer/footer');
    }

    function getInventoryRepairMovementDeadStockLogs(){
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $action_status=$this->input->post('action_status'); 
        $AllInventory=$this->InventoryModel->getInventoryRepairMovementDeadStockLogs($taluka_id, $zone_id, $branch_id,$action_status); 
        echo json_encode($AllInventory);
    }
}
