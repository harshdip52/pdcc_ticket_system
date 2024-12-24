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
      $myboj1 = new stdClass();
      $myboj1->taluka_name='TOTAL';
      
      $myboj1->CPU=$this->ReportsModel->totalCount(1);  
      $myboj1->Monitor=$this->ReportsModel->totalCount(2);   

      $myboj1->Printers=$this->ReportsModel->totalCount(3);   
      $myboj1->Scanners=$this->ReportsModel->totalCount(4);   
      $myboj1->UPS=$this->ReportsModel->totalCount(5);   
      $myboj1->Batterys=$this->ReportsModel->totalCount(6);   
      $myboj1->CCTV=$this->ReportsModel->totalCount(7);   
      $myboj1->Keyboard=$this->ReportsModel->totalCount(8);  
      $myboj1->Mouse=$this->ReportsModel->totalCount(9);  
      $myboj1->CableWire=$this->ReportsModel->totalCount(10);  
      $myboj1->Cable=$this->ReportsModel->totalCount(11);
      $myboj1->Pendrive=$this->ReportsModel->totalCount(12);
      $myboj1->Switch=$this->ReportsModel->totalCount(13);
      $myboj1->Router=$this->ReportsModel->totalCount(14); 
      $myboj1->Modem=$this->ReportsModel->totalCount(15);
      
      $myboj1->ATM=$this->ReportsModel->totalCount(16);      
      $myboj1->RFConnectivity=$this->ReportsModel->totalCount(17);     
      $myboj1->CBSSoftware=$this->ReportsModel->totalCount(18);     
      $myboj1->P2BSoftware=$this->ReportsModel->totalCount(19);     
      $myboj1->BankEmail=$this->ReportsModel->totalCount(20);    
      $myboj1->BoardMeetingVol=$this->ReportsModel->totalCount(21);   
      $myboj1->OtherSoftware=$this->ReportsModel->totalCount(22);     
      $myboj1->NetworkProblem=$this->ReportsModel->totalCount(23);    
      $myboj1->Laptop=$this->ReportsModel->totalCount(24);     
      $myboj1->Ram=$this->ReportsModel->totalCount(25);    
      $myboj1->SSD=$this->ReportsModel->totalCount(26); 
     

      array_push($usercountdetails, $myboj1);
      

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
        $user_id= $this->input->post('user_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getTicketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$user_id,$status); 
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
        $user_id= $this->input->post('user_id');
        $status= $this->input->post('status');
    
        $getAllInvent=$this->ReportsModel->getPendingticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$user_id,$status); 
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


    public function ticketsummary()
    {
        $this->load->view('header/header');
        $this->load->view('reports/ticketsummary');
        $this->load->view('footer/footer');
    }
    public function getTicketSummery()
    {
        $data=$this->InventoryModel->getAllTalukaList(); 
        $usercountdetails = array();
        $id=0;
        foreach ($data as $row) {
          $id++;
          $taluka_name=  $row["taluka_name"] ;
          $taluka_id = $row["taluka_id"] ;  
          $id=  $id++;
          $newTicket =  $this->ReportsModel->getTicketBystatus($taluka_id,'New');
          $inprogressTicket =  $this->ReportsModel->getTicketBystatus($taluka_id,'Inprogress');
          $forwardTicket =  $this->ReportsModel->getTicketBystatus($taluka_id,'Forwarded');
          $closeTicket =  $this->ReportsModel->getTicketBystatus($taluka_id,'Resolved');
          $quiredTicket =  $this->ReportsModel->getTicketBystatus($taluka_id,'Queried');
          $totalTicket =  $this->ReportsModel->getTotalTicket($taluka_id); 

          $myboj = new stdClass();
          $myboj->taluka_name=$taluka_name;
          $myboj->taluka_id=$taluka_id;
          $myboj->id=$id;
          $myboj->newTicket=$newTicket;  
          $myboj->inprogressTicket=$inprogressTicket;  
           
 ;        
          $myboj->forwardTicket=$forwardTicket;      
          $myboj->closeTicket=$closeTicket;      
          $myboj->quiredTicket=$quiredTicket;      
          $myboj->totalTicket=$totalTicket;         
          
          array_push($usercountdetails, $myboj);
      }
      

      $results = ["sEcho" => 1,
      "iTotalRecords" => count($usercountdetails),
      "iTotalDisplayRecords" => count($usercountdetails),
      "aaData" => $usercountdetails ];
      echo json_encode($usercountdetails); 
    }




}