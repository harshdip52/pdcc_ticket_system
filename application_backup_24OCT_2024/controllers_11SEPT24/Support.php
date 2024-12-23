<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('InventoryModel'); 
        $this->load->model('AdminModel'); 
        $this->load->model('SupportModel'); 
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

    public function supportDashboard()
     {
        $user_id = $this->session->userdata('login_user_id');
        $total['total']= $this->SupportModel->totalticket($user_id); 
        $total['todaytotalticket']= $this->SupportModel->todaytotalticket($user_id);
        $total['Inprogresstotalticket']= $this->SupportModel->Inprogresstotalticket($user_id);
        $total['Pendingtotalticket']= $this->SupportModel->Pendingtotalticket($user_id);
        $total['Closetotalticket']= $this->SupportModel->Closetotalticket($user_id); 
        $total['Queriedticket']= $this->SupportModel->Queriedticket($user_id); 
        $total['Forwardedticket']= $this->SupportModel->Forwardedticket($user_id); 
       
        $this->load->view('header/header'); 
        $this->load->view('support/supportDashboard',$total);  
        $this->load->view('footer/footer'); 
     }

    public function getTicketListByUser()
    {
        $taluka_id=$this->input->post('taluka_id');
        $zone_id=$this->input->post('zone_id');
        $branch_id=$this->input->post('branch_id');
        $user_id = $this->session->userdata('login_user_id'); 
        $getticket=$this->SupportModel->getTicketListByUser($taluka_id,$zone_id,$branch_id,$user_id); 
        echo json_encode($getticket);
    }
    public function supportTotalTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/supportTotalTicket');  
        $this->load->view('footer/footer');
    }
    public function getTotalTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getTotalTicket($user_id); 
        echo json_encode($getticket);
    }

    public function getForwardedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getForwardedTicket($user_id); 
        echo json_encode($getticket);
    }

    public function supportTodaysTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/supportTodaysTicket');  
        $this->load->view('footer/footer');
    }
    public function getTodaysTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getTodaysTicket($user_id); 
        // printData($getticket);
        // die;
        echo json_encode($getticket);
    }

    public function supportInprogresTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/supportInprogresTicket');  
        $this->load->view('footer/footer');
    }
    public function getInprogresTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getInprogresTicket($user_id); 
        echo json_encode($getticket);
    }
    public function supportPendingTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/supportPendingTicket');  
        $this->load->view('footer/footer');
    }
    public function getPendingTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getPendingTicket($user_id); 
        echo json_encode($getticket);
    }
    public function supportClosedTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/supportClosedTicket');  
        $this->load->view('footer/footer');
    }

    public function getClosedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getClosedTicket($user_id); 
        echo json_encode($getticket);
    }

    // public function queriedTicket()
    public function reopenTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/queriedTicket');  
        $this->load->view('footer/footer');
    }

    public function forwardedTicket()
    {
       $this->load->view('header/header'); 
        $this->load->view('support/forwardedTicket');  
        $this->load->view('footer/footer');
    }
    public function getQueriedTicket()
    { 
        $user_id = $this->session->userdata('login_user_id');
        $getticket=$this->SupportModel->getQueriedTicket($user_id); 
        echo json_encode($getticket);
    }
    public function ticketReply($ticket_id='')
    {
        $data['ticket']=$this->SupportModel->getTicketById($ticket_id);
        // printData($data);die;
        $this->load->view('header/header');
        $this->load->view('Support/ticketReply',$data); 
        $this->load->view('footer/footer');
     }



    public function ticketReplyNew($ticket_id='')
    { 
        $ticket_id = $this->input->post('ticket_id');  
        $formdata['remark'] = $this->input->post('remark');  
        $formdata['status'] = $this->input->post('status');
        $formdata2['status'] = $this->input->post('status');
        $formdata['updated_on'] = date('Y-m-d');
        $this->SupportModel->updateReminder($ticket_id,$formdata2); 
        $id = $this->SupportModel->updateTicket($ticket_id,$formdata);
        if ($id)
        {
            $msg='Ticket status updated successfully';
            $this->session->set_flashdata("success",$msg);
            redirect(base_url() . "Support/supportDashboard", 'refresh');
        } 
        else
        {   $this->session->set_flashdata("error"," Record Not Added");
            redirect(base_url() . "Support/supportDashboard", 'refresh');
        }
    }

    public function forwardTicket($ticket_id='')
    {  
        $data['ticket']=$this->SupportModel->getTicketById($ticket_id); 
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

        $this->SupportModel->updateReminder($ticket_id,$formdata2);
        $id = $this->SupportModel->updateTicket($ticket_id,$formdata);
        if ($id)
        {
            $msg='Ticket status updated successfully';
            $this->session->set_flashdata("success",$msg);
            redirect(base_url() . "Support/supportDashboard", 'refresh');
        } 
        else
        {   $this->session->set_flashdata("error"," Record Not Added");
            redirect(base_url() . "Support/supportDashboard", 'refresh');
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
