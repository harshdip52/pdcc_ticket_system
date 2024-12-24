<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
	    session_start();
        $this->load->model('InventoryModel');
        $this->load->model('ReportsModel');
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
        $this->load->view('reports/dashboard');
        $this->load->view('footer/footer');
    }
    public function inventoryReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/inventoryReports');
        $this->load->view('footer/footer');
    }

    public function summary()
    {
        $this->load->view('header/header');
        $this->load->view('reports/summary');
        $this->load->view('footer/footer');
    }
    public function getSummery()
    {
        $data=$this->InventoryModel->getAllTalukaList(); 
        $usercountdetails = array();
        $id=0;
        foreach ($data as $row) {
          $id++;
          $taluka_name=  $row["taluka_name"] ;
          $taluka_id = $row["taluka_id"] ;  
          $id=  $id++;
          $CPU =  $this->ReportsModel->getCPU($taluka_id);
          $Monitor =  $this->ReportsModel->getMonitor($taluka_id);

          $Printers =  $this->ReportsModel->getPrinters($taluka_id);
          $Scanners =  $this->ReportsModel->getScanners($taluka_id);
          $UPS =  $this->ReportsModel->getUPS($taluka_id);
          $Batterys =  $this->ReportsModel->getBatterys($taluka_id);
          $CCTV =  $this->ReportsModel->getCCTV($taluka_id);
          $Keyboard =  $this->ReportsModel->getKeyboard($taluka_id);
          $Mouse =  $this->ReportsModel->getMouse($taluka_id);
          $CableWire =  $this->ReportsModel->getCableWire($taluka_id);
          $Cable =  $this->ReportsModel->getCable($taluka_id);
          $Pendrive =  $this->ReportsModel->getPendrive($taluka_id);
          $Switch =  $this->ReportsModel->getSwitch($taluka_id);
          $Router =  $this->ReportsModel->getRouter($taluka_id);
          $Modem =  $this->ReportsModel->getModem($taluka_id);

          $ATM =  $this->ReportsModel->getATM($taluka_id);
          $RFConnectivity =  $this->ReportsModel->getRFConnectivity($taluka_id);
          $CBSSoftware =  $this->ReportsModel->getCBSSoftware($taluka_id);
          $P2BSoftware =  $this->ReportsModel->getP2BSoftware($taluka_id);
          $BankEmail =  $this->ReportsModel->getBankEmail($taluka_id);
          $BoardMeetingVol =  $this->ReportsModel->getBoardMeetingVol($taluka_id);
          $OtherSoftware =  $this->ReportsModel->getOtherSoftware($taluka_id);
          $NetworkProblem =  $this->ReportsModel->getNetworkProblem($taluka_id);
          $Laptop =  $this->ReportsModel->getLaptop($taluka_id);
          $Ram =  $this->ReportsModel->getRam($taluka_id);
          $SSD =  $this->ReportsModel->getSSD($taluka_id);

          $myboj = new stdClass();
          $myboj->taluka_name=$taluka_name;
          $myboj->taluka_id=$taluka_id;
          $myboj->id=$id; 
          $myboj->CPU=$CPU;  
          $myboj->Monitor=$Monitor;  

          $myboj->Printers=$Printers;   
          $myboj->Scanners=$Scanners;   
          $myboj->UPS=$UPS;   
          $myboj->Batterys=$Batterys;   
          $myboj->CCTV=$CCTV;   
          $myboj->Keyboard=$Keyboard;   
          $myboj->Mouse=$Mouse;   
          $myboj->CableWire=$CableWire;   
          $myboj->Cable=$Cable;   
          $myboj->Pendrive=$Pendrive;   
          $myboj->Switch=$Switch;   
          $myboj->Router=$Router;   
          $myboj->Modem=$Modem; 
          
          $myboj->ATM=$ATM;      
          $myboj->RFConnectivity=$RFConnectivity;      
          $myboj->CBSSoftware=$CBSSoftware;      
          $myboj->P2BSoftware=$P2BSoftware;      
          $myboj->BankEmail=$BankEmail;      
          $myboj->BoardMeetingVol=$BoardMeetingVol;      
          $myboj->OtherSoftware=$OtherSoftware;      
          $myboj->NetworkProblem=$NetworkProblem;      
          $myboj->Laptop=$Laptop;      
          $myboj->Ram=$Ram;      
          $myboj->SSD=$SSD;      
          
          array_push($usercountdetails, $myboj);
      }
      $results = ["sEcho" => 1,
      "iTotalRecords" => count($usercountdetails),
      "iTotalDisplayRecords" => count($usercountdetails),
      "aaData" => $usercountdetails ];
      echo json_encode($usercountdetails); 
    }

    function getInventoryReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date');
        $cat_id= $this->input->post('cat_id');
        $sub_cat_id= $this->input->post('sub_cat_id');
        $taluka_id= $this->input->post('taluka_id');
        $zone_id= $this->input->post('zone_id');
        $branch_id= $this->input->post('branch_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getInventoryReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status); 
        echo json_encode($getAllInvent);
    }

    public function ticketReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/ticketReports');
        $this->load->view('footer/footer');
    }

    function getTicketReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date');
        $cat_id= $this->input->post('cat_id');
        $sub_cat_id= $this->input->post('sub_cat_id');
        $taluka_id= $this->input->post('taluka_id');
        $zone_id= $this->input->post('zone_id');
        $branch_id= $this->input->post('branch_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getTicketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status); 
        echo json_encode($getAllInvent);
    }

    public function pendingticketReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/pendingticketReports');
        $this->load->view('footer/footer');
    }

    function getPendingticketReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date');
        $cat_id= $this->input->post('cat_id');
        $sub_cat_id= $this->input->post('sub_cat_id');
        $taluka_id= $this->input->post('taluka_id');
        $zone_id= $this->input->post('zone_id');
        $branch_id= $this->input->post('branch_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getPendingticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status); 
        echo json_encode($getAllInvent);
    }

    public function forwardedticketReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/forwardedticketReports');
        $this->load->view('footer/footer');
    }

    function getforwardedticketReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date');
        $cat_id= $this->input->post('cat_id');
        $sub_cat_id= $this->input->post('sub_cat_id');
        $taluka_id= $this->input->post('taluka_id');
        $zone_id= $this->input->post('zone_id');
        $branch_id= $this->input->post('branch_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getforwardedticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status); 
        echo json_encode($getAllInvent);
    }

    public function callLogReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/callLogReports');
        $this->load->view('footer/footer');
    }

    function getcallLogReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date'); 
    
        $getAllInvent=$this->ReportsModel->getcallLogReports($from_date,$to_date); 
        echo json_encode($getAllInvent);
    }

    public function inventoryMovementReports()
    {
        $this->load->view('header/header');
        $this->load->view('reports/inventoryMovementReports');
        $this->load->view('footer/footer');
    }

    function getinventoryMovementReports() 
    {
        $from_date= $this->input->post('from_date');
        $to_date= $this->input->post('to_date');
        $cat_id= $this->input->post('cat_id');
        $sub_cat_id= $this->input->post('sub_cat_id');
        $taluka_id= $this->input->post('taluka_id');
        $zone_id= $this->input->post('zone_id');
        $branch_id= $this->input->post('branch_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getinventoryMovementReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status); 
        echo json_encode($getAllInvent);
    }



}