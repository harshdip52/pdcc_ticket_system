<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SupportTicketController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('InventoryModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model("SupportTicketModel");

        $login_role = $this->session->userdata('login_role');
        if (!isset($login_role)) {
            redirect(base_url() . "welcome", 'refresh');
        }
    }

    function supportTicket()
    {
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

        $this->load->view('header/header');
        $this->load->view('support/supportTicketView', $data);
        $this->load->view('footer/footer');
    }

    function getDetails(){
        $result = $this->SupportTicketModel->getDetails($this->input->post());
        echo json_encode($result);        
    }
    
    public function getBranchAjax($zone_id)
    { 
        $user_assign_branch = explode(",",$_SESSION['login_branch_id']);
        $user_assign_branch_name = $_SESSION['getBranchList'];
        if(count($user_assign_branch_name) > 1){
            $getBranch=$this->SupportTicketModel->getBranch_new($zone_id,$user_assign_branch); 
        }else{
            $getBranch=$this->SupportTicketModel->getBranch($zone_id); 
        }
        echo json_encode($getBranch);
    }
    public function getBranchAjaxByUser()
    { 
        $getBranch=$this->SupportTicketModel->getBranchAjaxByUser(); 
        echo json_encode($getBranch);
    }

    function getCategoryWiseTitle(){
        $catId = base64_decode($this->input->post('cat_id'));
        $subCatId = base64_decode($this->input->post('subc_cat_id'));
        $categoryWiseTitle=$this->SupportTicketModel->getCategoryWiseTitle($catId,$subCatId); 
        echo json_encode($categoryWiseTitle);
    }

    public function getInventoryStock()
    {
        
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // printData($_REQUEST);die;
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->SupportTicketModel->getInventoryBySearch($taluka_id, $zone_id,$branch_id); 
        echo json_encode($AllInventory);
        
    }

    ## added by Harshdeep 
    ## for stroting new ticket
    ## from forn 
    function addnewTicketAjax()
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
      
        $module_id = 1;
        $CounterData = $this->SupportTicketModel->getCounter($module_id);
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


        // if (!$this->upload->do_upload('sw_attachment')) {
        //     $response = array('status' => false, 'message' => "Error With Selected File", 'code' => 300);
        //     header('Content-Type: application/json');
        //     echo json_encode($response);
        //     exit(1);
        // } else {
        //     $upload_data = $this->upload->data();


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
            // $formdata['brand_id']            = $this->input->post('sw_branch_id');
            $formdata['brand_id']            = $this->input->post('sw_brand_id');
            $formdata['inventory_id']        = "";
            $formdata['ticket_title']        = $this->input->post('sw_ticket_title');
            $formdata['description']         = $this->input->post('sw_description');
            $formdata['attachment']          = $newname;//$upload_data['file_name'];
            $formdata['user_id']             = $this->input->post('sw_user_id');
            $formdata['created_on']          = trim(date('Y-m-d'));
            $formdata['updated_on']          = trim(date('Y-m-d'));
            $formdata['status']              = 'New';
            $formdata['ticket_priority']     = $this->input->post('sw_ticket_priority');
            $formdata['created_by']          = $this->session->userdata('login_user_id');
            // printData($formdata);die;
            $id = $this->SupportTicketModel->addnewTicketAjax($formdata);

            $counter = $CounterData['counter'] + 1;
            $Counterformdata['counter'] = $counter;
            $this->SupportTicketModel->updateCounter($Counterformdata, $module_id);
            if(!empty($id)) {
                $response = array('status' => true, 'message' => "New Ticket added successfully .$ticket_no", 'code' => 200);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            } else {
                $response = array('status' => false, 'message' => "error while adding new ticket", 'code' => 302);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            }
        // }
    }


     ## added by Harshdeep
    ## for Storing Ticket Information From Table Icon Click
    
    function addnewTicketAjaxTable(){
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $module_id = 1;
        $CounterData = $this->SupportTicketModel->getCounter($module_id);
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

        // if (!$this->upload->do_upload('hrd_attachment')) {
        //     $response = array('status' => false, 'message' => "Error With Selected File", 'code' => 300);
        //     header('Content-Type: application/json');
        //     echo json_encode($response);
        //     exit(1);
        // } else {
        //     $upload_data = $this->upload->data();


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
            $formdata['attachment']          = $newname;//$upload_data['file_name'];
            $formdata['user_id']             = $this->input->post('hrd_user_id');
            $formdata['created_on']          = trim(date('Y-m-d'));
            $formdata['updated_on']          = trim(date('Y-m-d'));
            $formdata['status']              = 'New';
            $formdata['ticket_priority']     = $this->input->post('hw_ticket_priority');
            $formdata['created_by']          = $this->session->userdata('login_user_id');

            $id = $this->SupportTicketModel->addnewTicketAjax($formdata);

            $counter = $CounterData['counter'] + 1;
            $Counterformdata['counter'] = $counter;
            $this->SupportTicketModel->updateCounter($Counterformdata, $module_id);
            if(!empty($id)) {
                $response = array('status' => true, 'message' => "new Ticket added successfully .$ticket_no", 'code' => 200);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            } else {
                $response = array('status' => false, 'message' => "error while adding new ticket", 'code' => 302);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit(1);
            }
        #}

    }

       ## Added by Harshdeep 
    ## on 7Th August 2024
    ## for getting Ticket Title List from database
    function getTicketTitle(){
        $result = $this->SupportTicketModel->getTicketTitle($this->input->post());
        echo json_encode($result);
        exit(1);
    }

     ## Added by Harshdeep 
    ## on 7Th August 2024
    ## for getting taluka and zone details by Branch
    function getTalukaByBranch(){
        
        $talukaId = $this->input->post('talukaId');
        $zoneId = $this->input->post('zoneId');
        $result = $this->SupportTicketModel->getTalukaByBranch($talukaId,$zoneId);
        echo json_encode($result);
    }


    public function getSubCategoryAjax($cat_id)
    { 
        $getBranch=$this->SupportTicketModel->getSubCategory($cat_id); 
        echo json_encode($getBranch);
    }

    public function getInventoryDeadStock()
    {
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->SupportTicketModel->getInventoryDeadBySearch($taluka_id, $zone_id, $branch_id); 
        echo json_encode($AllInventory);
        
    }

    public function deleteInventory($id)
    {   
        $id = $this->InventorSupportTicketModelyModel->deleteInventory($id);
        if ($id) 
        {
            $vals =  [ 'code'=> true, 'msg'=>'Updated' ];
            echo json_encode($vals);

        }
        else 
        {
            $vals =  [ 'code' => false, 'msg' =>'Not Updated' ]; 
            echo json_encode($vals);

        }
    }

    public function getTodaysTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportTicketModel->getTodaysTicket($user_id); 
        echo json_encode($getticket);
    }

}
