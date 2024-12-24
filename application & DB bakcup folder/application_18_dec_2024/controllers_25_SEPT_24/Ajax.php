<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Ajax extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('AjaxModel');
        $this->load->model('InventoryModel');
        $this->load->library('session');


    }
    // public function getBranchAjax($zone_id)
    public function getBranchAjaxAdmin()
    { 
        // $getBranch=$this->AjaxModel->getBranch(array_filter($this->input->post('zone_id'))); 
        $getBranch=$this->AjaxModel->getBranchAdmin(); 
        echo json_encode($getBranch);
    }
    public function getBranchAjax()
    { 
        $getBranch=$this->AjaxModel->getBranch(array_filter($this->input->post('zone_id'))); 
        echo json_encode($getBranch);
    }
    public function getBranchAjaxFotTicketDashboard($zone_id)
    { 
        $getBranch=$this->AjaxModel->getBranchFotTicketDashboard($zone_id); 
        echo json_encode($getBranch);
    }
    public function getBranchAjaxNew($zone_id)
    { 
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $getBranch=$this->AjaxModel->getBranch($zone_id); 
        echo json_encode($getBranch);
    }
    public function getBranchSupportAjax()
    { 
        $getBranch=$this->AjaxModel->getBranchSupport($this->input->post('zone_id')); 
        echo json_encode($getBranch);
    }
    
    public function getBranchAjaxUsersAdd()
    { 
        $getBranch=$this->AjaxModel->getBranchAjaxUsersAdd(array_filter($this->input->post('taluka_id'))); 
        echo json_encode($getBranch);
    }
    public function getBranchAjaxEditUser()
    { 
        $getBranch=$this->AjaxModel->getBranchEditUser($this->input->post()); 
        echo json_encode($getBranch);
    }
    public function getBranchAjaxUser($zone_id)
    { 
        $getBranch=$this->AjaxModel->getBranchUsers($zone_id); 
        echo json_encode($getBranch);
    }
    public function getZoneAjaxAdmin($taluka_id)
    {         
        $getBranch=$this->AjaxModel->getZoneAdmin($taluka_id); 
        echo json_encode($getBranch);
    }
    public function getZoneAjax($taluka_id)
    {   
        $getBranch=$this->AjaxModel->getZone($taluka_id); 
        echo json_encode($getBranch);
    }
    public function getZoneAjaxEditUser()
    {   
        $getBranch=$this->AjaxModel->getZoneEditUser($this->input->post()); 
        echo json_encode($getBranch);
    }
    public function getZoneAjaxNew()
    { 
        // printData($_POST);die;  
        $getBranch=$this->AjaxModel->getZoneNew($this->input->post()); 
        echo json_encode($getBranch);
    }

    public function getSubCategoryAjax($cat_id)
    { 
        $getBranch=$this->AjaxModel->getSubCategory($cat_id); 
        echo json_encode($getBranch);
    }


    public function getSubCategoryForInventory($cat_id)
    { 
        $getBranch=$this->AjaxModel->getSubCategoryForInventory($cat_id); 
        echo json_encode($getBranch);
    }
    public function getSubCategoryForTicket($cat_id)
    { 
        $getBranch=$this->AjaxModel->getSubCategoryForTicket($cat_id); 
        echo json_encode($getBranch);
    }

    public function getInventoryStockAdmin()
    {
        // printData($_REQUEST);die;
        $branch_id      =$this->input->post('branch_id');
        $taluka_id      =$this->input->post('taluka_id');
        $cat_id         =$this->input->post('cat_id');
        $sub_cat_id     =$this->input->post('sub_cat_id');
        // $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->AjaxModel->getInventoryBySearchAdmin($branch_id, $taluka_id,$cat_id,$sub_cat_id); 
        echo json_encode($AllInventory);
        
    }
    
    public function getInventoryStock()
    {
        
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // printData($_REQUEST);die;
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->AjaxModel->getInventoryBySearch($taluka_id, $zone_id,$branch_id); 
        echo json_encode($AllInventory);
        
    }
    public function getInventoryStockUsers()
    {
        
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        // printData($_REQUEST);die;
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->AjaxModel->getInventoryBySearchUsers($taluka_id, $zone_id,$branch_id); 
        echo json_encode($AllInventory);
        
    }

    ## Added by Harshdeep 
    ## on 7Th August 2024
    ## for getting taluka and zone details by Branch
    function getTalukaByBranch(){
        
        $talukaId = $this->input->post('talukaId');
        $zoneId = $this->input->post('zoneId');
        $result = $this->AjaxModel->getTalukaByBranch($talukaId,$zoneId);
        echo json_encode($result);
    }
    function getTalukaByBranchUsers(){
        
        $talukaId = $this->input->post('talukaId');
        $zoneId = $this->input->post('zoneId');
        $result = $this->AjaxModel->getTalukaByBranchUsers($talukaId,$zoneId);
        echo json_encode($result);
    }

  

    function getDetailsAdmin(){
        $result = $this->AjaxModel->getDetailsAdmin($this->input->post());
        echo json_encode($result);        
    }
    function getDetails(){
        $result = $this->AjaxModel->getDetails($this->input->post());
        echo json_encode($result);        
    }

    function getVrabdLsitByCatSubCat(){
        $result = $this->AjaxModel->getVrabdLsitByCatSubCat($this->input->post());
        echo json_encode($result);        
    }
    public function getInventoryDeadStock() 
    {
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->AjaxModel->getInventoryDeadBySearch($taluka_id, $zone_id, $branch_id); 
        echo json_encode($AllInventory);
        
    }

    function getInventoryRepairStock(){
        $taluka_id=$this->input->post('taluka_id');
        $branch_id=$this->input->post('branch_id');
        $zone_id=$this->input->post('zone_id'); 
        $AllInventory=$this->AjaxModel->getInventoryRepairStock($taluka_id, $zone_id, $branch_id); 
        echo json_encode($AllInventory);
    }

    function readyStock(){
        $inventory_id=$this->input->post('id');
        $status=$this->input->post('status');

        $data = $this->InventoryModel->getInventoryById($inventory_id);

        $insertdata['inventory_id']=$data['id'];
        $insertdata['taluka_id']=$data['taluka_id']; 
        $insertdata['zone_id']=$data['zone_id']; 
        $insertdata['branch_id']=$data['branch_id']; 
        $insertdata['cat_id']=$data['cat_id']; 
        $insertdata['sub_cat_id']=$data['sub_cat_id']; 
        $insertdata['inserted_by']=$this->session->userdata('login_user_id'); 
        $insertdata['inserted_on']=date('Y-m-d H:i:s');
        
        $id = $this->InventoryModel->inventory_movement_log($insertdata);
       
        // $formdata['ip_address'] = "";
        $formdata['updated_on'] = date('Y-m-d H:i:s');
        //$formdata['reasone'] = $this->input->post('reasone');
        $formdata['status'] = 1; 

        $id = $this->InventoryModel->updateInventory($formdata,$inventory_id);
        if ($id){
            $vals =  [ 'code'=> true, 'msg'=>'Updated' ];
            echo json_encode($vals);
        }else{
            $vals =  [ 'code' => false, 'msg' =>'Not Updated' ]; 
            echo json_encode($vals);
        }
    }

    public function deadStock()
    {   
        $inventory_id=$this->input->post('id');
        $status=$this->input->post('status');
        if($status==3)
        {
            $data = $this->InventoryModel->getInventoryById($inventory_id);
            $insertdata['inventory_id']=$data['id'];
            $insertdata['taluka_id']=$data['taluka_id']; 
            $insertdata['zone_id']=$data['zone_id']; 
            $insertdata['branch_id']=$data['branch_id']; 
            $insertdata['cat_id']=$data['cat_id']; 
            $insertdata['sub_cat_id']=$data['sub_cat_id']; 
            $insertdata['inserted_by']=$this->session->userdata('login_user_id'); 
            $insertdata['inserted_on']=date('Y-m-d H:i:s');
            $id = $this->InventoryModel->inventory_movement_log($insertdata);
        }

        ## remove ip address while movine inventory 
        ## as per discuss with Vishal 
        ## on 30 AUG 204
        ## added By Harshdeep 

        if($status==3){
            $formdata['ip_address'] = "";
        }
        
        $formdata['updated_on'] = date('Y-m-d H:i:s');
        $formdata['reasone'] = $this->input->post('reasone');
        $formdata['status'] = $status; 
        // echo "id is -> ".$inventory_id."\n <br>";
        // printData($formdata);die;
        $id = $this->InventoryModel->updateInventory($formdata,$inventory_id);
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


    public function addReminder()
    { 
        $ticket_id=$this->input->post('ticket_id');
        $ticket = $this->AjaxModel->getTicketNo($ticket_id);

        $formdata['ticket_id'] = $ticket_id;
        $formdata['user_id'] = $ticket['user_id'];
        $formdata['ticket_no'] = $ticket['ticket_no'];
        $formdata['created_on'] = date('Y-m-d H:i:s');
        $formdata['created_by']=  $this->session->userdata('login_user_id');
        $formdata['reminder'] = $this->input->post('reminder'); 
        $id = $this->AjaxModel->insertReminder($formdata);
        if ($id) 
        {
           $code = true;
                $msg = " Updated";
                echo $this->sendResponse($code, $msg);

        }
        else 
        {
            $vals =  [ 'code' => false, 'msg' =>'Not Updated' ]; 
            echo json_encode($vals);

        }
    }

    function sendResponse($code, $msg)
    {
        $myObj = new StdClass();
        $myObj->code = $code;
        $myObj->message = $msg;
        return json_encode($myObj);
    }
    public function getInventoryForAssign()
    { 
        $AllInventory=$this->AjaxModel->getInventoryForAssign(); 
        echo json_encode($AllInventory);
        
    }

    public function getAllTalukaList()
    {
         $AllInventory=$this->InventoryModel->getAllTalukaList(); 
        echo json_encode($AllInventory);
    }

    public function getAllZoneList()
    {
        $allZone=$this->AjaxModel->getAllZoneList(); 
        echo json_encode($allZone);
    }
    public function getAllBranchList()
    {
        $allBranch=$this->AjaxModel->getAllBranchList(); 
        echo json_encode($allBranch);
    }
    public function getAllbrandList()
    {
        $allBrand=$this->AjaxModel->getAllbrandList(); 
        echo json_encode($allBrand);
    }
    public function getAllCategoryList()
    {
        $allCategory=$this->AjaxModel->getAllCategoryList(); 
        echo json_encode($allCategory);
    }

    public function getAllSubCategoryList()
    {
        $allSubCategory=$this->AjaxModel->getAllSubCategoryList(); 
        echo json_encode($allSubCategory);
    }
    public function getAllUsers()
    {
        $allSubCategory=$this->AjaxModel->getAllUsers(); 
        echo json_encode($allSubCategory);
    }

    public function getUserDetailedById($user_id='')
    {
        $allSubCategory=$this->AjaxModel->getUserDetailedById($user_id); 
        echo json_encode($allSubCategory);
    }

    public function getAllInventryList()
    {
        $this->input->get('taluka_id');
        $getAllInvent=$this->AjaxModel->getAllInventryList(); 
        echo json_encode($getAllInvent);
    }
    public function getTicketListwithIds()
    { 
        // printData($_REQUEST);die;
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $sel_date=$this->input->post('sel_date');
        $getticket=$this->AjaxModel->getTicketListwithIds($taluka_id,$zone_id,$branch_id,$sel_date); 
        echo json_encode($getticket);
    }

    function getTicketListwithIdsNew(){
        $taluka_id=$this->input->post('taluka_id');
        $status=$this->input->post('status');
        $getticket=$this->AjaxModel->getTicketListwithIdsNew($taluka_id,$status); 
        echo json_encode($getticket);
    }
    public function todaysTickets()
    {
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $getticket=$this->AjaxModel->todaysTickets($taluka_id,$zone_id,$branch_id); 
        echo json_encode($getticket);
    }
    public function inprogressTickets()
    {
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $getticket=$this->AjaxModel->InprogressTickets($taluka_id,$zone_id,$branch_id); 
        echo json_encode($getticket);
    }
    public function PendingTickets()
    {
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $getticket=$this->AjaxModel->PendingTickets($taluka_id,$zone_id,$branch_id); 
        echo json_encode($getticket);
    }

     public function ForwardedTickets()
    { 
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $getticket=$this->AjaxModel->ForwardedTickets($taluka_id,$zone_id,$branch_id); 
        echo json_encode($getticket);
    }

    public function ClosedTickets()
    { 
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $getticket=$this->AjaxModel->ClosedTickets($taluka_id,$zone_id,$branch_id); 
        echo json_encode($getticket);
    }

    public function getUsers($branch_id)
    { 
        $getUsers=$this->AjaxModel->getUsers($branch_id); 
        echo json_encode($getUsers); 
    }
    public function getAllUsersSupport()
    {   $role=5;
        $getUsers=$this->AjaxModel->getUsersByRole($role); 
        echo json_encode($getUsers);
    }

     public function getAssignInventryList()
    {
         $branch_id=$this->input->get('branch_id'); 
        $cat_id=$this->input->get('cat_id'); 
        $sub_cat_id=$this->input->get('sub_cat_id'); 
        $brand_id=$this->input->get('brand_id'); 
        $getAn=$this->AjaxModel->getAssignInventryList($branch_id,$cat_id,$sub_cat_id,$brand_id);
        echo json_encode($getAn);
    }
    public function getVendors()
    { 
        $role=6;
        $getUsers=$this->AjaxModel->getUsersByRole($role);
        echo json_encode($getUsers);
    }

    public function getTicketTitleBySubCatId($sub_cat_id)
    { 
        $role=6;
        $gettile=$this->AjaxModel->getTicketTitleBySubCatId($sub_cat_id);
        echo json_encode($gettile);
    }

      ## Added by Harshdeep 
    ## on 7Th August 2024
    ## for getting Ticket Title List from database
    function getTicketTitle(){
        $result = $this->AjaxModel->getTicketTitle($this->input->post());
        echo json_encode($result);
    }

    public function getBranchAjaxByUser()
    { 
        $getBranch=$this->AjaxModel->getBranchAjaxByUser(); 
        echo json_encode($getBranch);
    }

    public function getStatus()
    {  
        $getBranch=$this->AjaxModel->getStatus(); 
        echo json_encode($getBranch);
    }

     


}
