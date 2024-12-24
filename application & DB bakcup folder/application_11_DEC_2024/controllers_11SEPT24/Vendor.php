<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('InventoryModel'); 
        $this->load->model('AdminModel'); 
        $this->load->model('VendorModel'); 
        $this->load->library('form_validation');
        $this->load->library('session');

        $login_role = $this->session->userdata('login_role'); 
        
        if (!isset($login_role)) 
        { 
             redirect(base_url() . "welcome", 'refresh');
        }
    }

    public function index()
    {
        return view('welcome_message');
        // echo 1;
    }

    public function VendorDashboard()
     {
            $user_id = $this->session->userdata('login_user_id');
        $total['total']= $this->VendorModel->totalticket($user_id); 
        $total['todaytotalticket']= $this->VendorModel->todaytotalticket($user_id);
        $total['Inprogresstotalticket']= $this->VendorModel->Inprogresstotalticket($user_id);
        $total['Pendingtotalticket']= $this->VendorModel->Pendingtotalticket($user_id);
        $total['Closetotalticket']= $this->VendorModel->Closetotalticket($user_id); 
        $total['Queriedticket']= $this->VendorModel->Queriedticket($user_id); 
        $total['Forwardedticket']= $this->VendorModel->Forwardedticket($user_id); 
        
        $this->load->view('header/header'); 
        $this->load->view('vendor/VendorDashboard',$total);  
        $this->load->view('footer/footer'); 
     }
     public function getBranchSupportAjax()
     { 
         $getBranch=$this->VendorModel->getBranchSupport($this->input->post('zone_id')); 
         echo json_encode($getBranch);
     }

     public function getZoneAjax($taluka_id)
     {   
         $getBranch=$this->VendorModel->getZone($taluka_id); 
         echo json_encode($getBranch);
     }

     public function getAllTalukaList()
    {
         $AllInventory=$this->VendorModel->getAllTalukaList(); 
        echo json_encode($AllInventory);
    }

    public function getTicketListByUser()
    {
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $user_id = $this->session->userdata('login_user_id'); 
        $getticket=$this->VendorModel->getTicketListByUser($taluka_id,$zone_id,$branch_id,$user_id); 
        echo json_encode($getticket);
    }
    public function vendorTotalTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/VendorTotalTicketView');  
        $this->load->view('footer/footer');
    }
    public function getTotalTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getTotalTicket($user_id); 
        echo json_encode($getticket);
    }

    public function getForwardedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getForwardedTicket($user_id); 
        echo json_encode($getticket);
    }

    public function vendorTodaysTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('Vendor/VendorTodaysTicketView');  
        $this->load->view('footer/footer');
    }
    public function getTodaysTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getTodaysTicket($user_id); 
        echo json_encode($getticket);
    }

    public function VendorInprogresTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/vendortInprogresTicketView');  
        $this->load->view('footer/footer');
    }
    public function getInprogresTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getInprogresTicket($user_id); 
        echo json_encode($getticket);
    }
    public function vendorPendingTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/VendorPendingTicketView');  
        $this->load->view('footer/footer');
    }
    public function getPendingTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getPendingTicket($user_id); 
        echo json_encode($getticket);
    }
    public function vendorClosedTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/vendorClosedTicketView');  
        $this->load->view('footer/footer');
    }

    public function getClosedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getClosedTicket($user_id); 
        echo json_encode($getticket);
    }

    public function reopenTickets()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/queriedTicketView');  
        $this->load->view('footer/footer');
    }

    public function forwardedTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('vendor/forwardedTicketView');  
        $this->load->view('footer/footer');
    }
    public function getQueriedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->VendorModel->getQueriedTicket($user_id); 
        echo json_encode($getticket);
    }
    public function ticketReply($ticket_id='')
    {
        $data['ticket']=$this->VendorModel->getTicketById($ticket_id);
        printData($data);die;
        $this->load->view('header/header');
        $this->load->view('vendor/vendorTicketReplyView',$data); 
        $this->load->view('footer/footer');
     }



    public function ticketReplyNew($ticket_id='')
    { 
        $ticket_id = $this->input->post('ticket_id');  
        $formdata['remark'] = $this->input->post('remark');  
        $formdata['status'] = $this->input->post('status');
        $formdata2['status'] = $this->input->post('status');
        $formdata['updated_on'] = date('Y-m-d');
        $this->VendorModel->updateReminder($ticket_id,$formdata2); 
        $id = $this->VendorModel->updateTicket($ticket_id,$formdata);
        if ($id)
        {
            $msg='Ticket status updated successfully';
            $this->session->set_flashdata("success",$msg);
            redirect(base_url() . "Vendor/VendorDashboard", 'refresh');
        } 
        else
        {   $this->session->set_flashdata("error"," Record Not Added");
            redirect(base_url() . "Vendor/VendorDashboard", 'refresh');
        }
    }

    public function forwardTicket($ticket_id='')
    {  
        $data['ticket']=$this->VendorModel->getTicketById($ticket_id); 
        $forward_count=$data['ticket']['forward_count'];
        
        $ticket_id = $this->input->post('ticket_id');
        if($forward_count==0)
        {
            $formdata['forword_applicable'] = 'Yes'; 
            $formdata['forword_from_1'] = $this->session->userdata('login_user_id');
            $formdata['description_1'] = $this->input->post('description'); 
            $formdata['forword_from_date_1'] = date('Y-m-d'); 
        }
        if($forward_count==1)
        {
            $formdata['forword_applicable'] = 'No'; 
            $formdata['forward_from_2'] = $this->session->userdata('login_user_id');
            $formdata['description_2'] = $this->input->post('description'); 
            $formdata['forword_from_date_2'] = date('Y-m-d'); 
        }


        $forward_count=$forward_count+1;
        $formdata['updated_on'] = date('Y-m-d'); 
        $formdata['user_id'] = $this->input->post('user_id'); 
        $formdata['forward_count'] = $forward_count;  
        $formdata['status'] ='Forwarded';

        $formdata2['user_id'] = $this->input->post('user_id');
        // echo $ticket_id."\n";
        // echo "---------------------------------- \n";
        // echo "formdata \n";
        // printData($formdata);
        // echo "---------------------------------- \n";
        // echo "formdata2 \n";
        // printData($formdata2);
        // die;
        $this->VendorModel->updateReminder($ticket_id,$formdata2);
        $id = $this->VendorModel->updateTicket($ticket_id,$formdata);
        if ($id)
        {
            $msg='Ticket status updated successfully';
            $this->session->set_flashdata("success",$msg);
            redirect(base_url() . "Vendor/VendorDashboard", 'refresh');
        } 
        else
        {   $this->session->set_flashdata("error"," Record Not Added");
            redirect(base_url() . "Vendor/VendorDashboard", 'refresh');
        }
    }

    
    public function supportTicket()
    {
         $module_id=1;
        $CounterData=$this->AdminModel->getCounter($module_id); 

        $this->load->view('header/header'); 
        if ($this->form_validation->run('newTicket') == FALSE) 
        { 
            $this->load->view('Support/supportTicket');
        }
        else
        {
            $ticket_no = date('Ymd').$CounterData['counter']+1;    
            $branch_id = $this->input->post('branch_id');
            
            if(empty($branch_id))
                {$branch_id=$this->session->userdata('login_branch_id');}


            $getBranch=$this->AdminModel->getZoneIdByBranch($branch_id);
        
            $formdata['taluka_id'] = $getBranch['taluka_id'];  
            $formdata['zone_id'] = $getBranch['zone_id'];  
            $formdata['branch_id'] = $branch_id;


            $formdata['ticket_no'] = $ticket_no;  
            $formdata['cat_id'] = $this->input->post('cat_id');  
            $formdata['sub_cat_id'] = $this->input->post('sub_cat_id');  
            $formdata['brand_id'] = $this->input->post('brand_id');  
            $formdata['inventory_id'] = $this->input->post('inventory_id');  
            $formdata['ticket_title'] = $this->input->post('ticket_title');  
            $formdata['description'] = $this->input->post('description');
            $formdata['user_id'] = $this->session->userdata('login_user_id');
            $formdata['created_on'] = date('Y-m-d');
            $formdata['updated_on'] = date('Y-m-d');
            $formdata['status'] = 'New';
            $formdata['created_by'] = $this->session->userdata('login_user_id');

            if (!file_exists('uploads/ticket')) { mkdir('uploads/ticket', 0777, true); }

            $attachmentsize=$_FILES['attachment']['tmp_name'];  
            if ($attachmentsize) 
            {
                $attachmentpath = 'uploads/ticket/'; 
                $attachmentlocation = $attachmentpath . time() .'attachment'. $_FILES['attachment']['name']; 
                move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentlocation);
            }
             else
            {
                $attachmentlocation=''; 
            }
             $formdata['attachment'] = $attachmentlocation;

 
            $id = $this->AdminModel->insertNewTicket($formdata);
              

            $counter=$CounterData['counter']+1;
            $Counterformdata['counter'] = $counter;
           $this->AdminModel->updateCounter($Counterformdata,$module_id);
            if ($id)
            {
                $this->session->set_flashdata("success","1 Record Added");
                redirect(base_url() . "Support/supportDashboard", 'refresh');

            } 
            else
            {   $this->session->set_flashdata("error"," Record Not Added");
                redirect(base_url() . "Support/supportDashboard", 'refresh');
            }
        }
         $this->load->view('footer/footer');
     }




    
}
