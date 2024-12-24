<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class VendorModel extends CI_Model
{
	 public function totalticket($user_id)
    {
        $this->db->select('count(ticket_id) as totalTicket');   
        // $this->db->where('user_id',$user_id);
        $where = '(user_id='.$user_id.' or forword_from_1 = '.$user_id.' or forward_from_2 = '.$user_id.')';
        $this->db->where($where);
        return $this->db->get('tbl_mst_ticket')->row_array();
    }
 
    public function getBranchSupport($postdata)
    {
        $this->db->select('*');
        $this->db->from('tbl_mst_branch');
        if ($postdata != '' && $postdata != null) {
            $this->db->where('zone_id', $postdata);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getZone($taluka_id)
    {
        $this->db->where('taluka_id', $taluka_id);
        return $this->db->get("tbl_mst_zone")->result_array();
    }

    public function getAllTalukaList()
	{  
        return $this->db->get("tbl_mst_taluka")->result_array();
	} 

    public function todaytotalticket($user_id)
    {
        $this->db->select('count(ticket_id) as todaytotalticket');
        $created_on=date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on',$created_on);
        $this->db->where('user_id',$user_id);
        return $this->db->get('tbl_mst_ticket')->row_array();
    } 
    public function Forwardedticket($user_id)
    {
        $this->db->select('count(ticket_id) as Forwardedticket'); 
        $this->db->where('tbl_mst_ticket.status','Forwarded');
        // $this->db->where('user_id',$user_id);
        $this->db->where('forword_from_1',$user_id);
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function Inprogresstotalticket($user_id)
    {
        $this->db->select('count(ticket_id) as Inprogresstotalticket'); 
        $this->db->where('tbl_mst_ticket.status','Inprogress');
        $this->db->where('user_id',$user_id);
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function Pendingtotalticket($user_id)
    {
        $this->db->select('count(ticket_id) as Pendingtotalticket'); 
        $created_on=date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on !=',$created_on);
        $this->db->where('tbl_mst_ticket.status','New');
        $this->db->where('user_id',$user_id);
        return $this->db->get('tbl_mst_ticket')->row_array();
    }
    public function Closetotalticket($user_id)
    {
        $this->db->select('count(ticket_id) as Closetotalticket'); 
        $this->db->where('tbl_mst_ticket.status','Resolved');
        $this->db->where('user_id',$user_id); 
        return $this->db->get('tbl_mst_ticket')->row_array();
    }

    public function Queriedticket($user_id)
    {
        $this->db->select('count(ticket_id) as Queriedticket'); 
        $this->db->where('tbl_mst_ticket.status','Queried');
        $this->db->where('user_id',$user_id); 
        return $this->db->get('tbl_mst_ticket')->row_array();
    }


public function getTicketListByUser($taluka_id,$zone_id,$branch_id,$user_id)
    {  
    	$this->db->select('tbl_mst_ticket.*,tbl_mst_taluka.taluka_name as taluka_name,tbl_mst_ticket_title.ticket_title as ticket_title,tbl_mst_branch.branch_name as branch_name,tbl_mst_zone.zone_name as zone_name');

        /*if (!empty($taluka_id) && !empty($zone_id) && !empty($branch_id)) 
        {
           $this->db->where('tbl_mst_ticket.taluka_id',$taluka_id);
           $this->db->where('tbl_mst_ticket.zone_id',$zone_id);
           $this->db->where('tbl_mst_ticket.branch_id',$branch_id);
        }
        if (!empty($taluka_id) && !empty($zone_id) && empty($branch_id)) 
        {
           $this->db->where('tbl_mst_ticket.taluka_id',$taluka_id);
           $this->db->where('tbl_mst_ticket.zone_id',$zone_id); 
        } 
        if (!empty($taluka_id) && empty($zone_id) && empty($branch_id)) 
        {
           $this->db->where('tbl_mst_ticket.taluka_id',$taluka_id);  
        } */

        if(!empty($taluka_id)){
            $this->db->where('tbl_mst_ticket.taluka_id',$taluka_id);
        }
        if(!empty($zone_id)){
            $this->db->where('tbl_mst_ticket.zone_id',$zone_id);
        }
        if(!empty($branch_id)){
            $this->db->where('tbl_mst_ticket.branch_id',$branch_id);
        }

        $this->db->where('tbl_mst_ticket.user_id',$user_id);  
        $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getTotalTicket($user_id)
    { 
        $created_on=date('Y-m-d');
    	$this->db->select('tbl_mst_ticket.*,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name');  
        
        // $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        
        $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        $this->db->where('tbl_mst_ticket.user_id',$user_id);
        $this->db->or_where('tbl_mst_ticket.forword_from_1',$user_id);
        $this->db->or_where('tbl_mst_ticket.forward_from_2',$user_id);
        // $this->db->group_by("tbl_mst_ticket.ticket_id");
        // $where = '(user_id='.$user_id.' or forword_from_1 = '.$user_id.' or forward_from_2 = '.$user_id.')';
        // $this->db->where($where);
        
        return $this->db->get('tbl_mst_ticket')->result_array();
    }
    public function getTodaysTicket($user_id)
    { 
        // $created_on =trim(date('Y-m-d'));
        $created_on = new DateTime("now");
        $curr_date = $created_on->format('Y-m-d');

    	// $this->db->select('tbl_mst_ticket.*,tbl_mst_taluka.taluka_name,tbl_mst_ticket_title.ticket_title,tbl_mst_branch.branch_name,tbl_mst_zone.zone_name');          
    	$this->db->select('tbl_mst_ticket.*,tbl_mst_taluka.taluka_name,tbl_mst_ticket_title.ticket_title,tbl_mst_branch.branch_name');          
        $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        // $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');        
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $this->db->where("tbl_mst_ticket.created_on",trim($curr_date)); 
        // $this->db->group_by('tbl_mst_ticket.created_on');
        // $this->db->group_by('tbl_mst_ticket.ticket_no');
        // $this->db->order_by("tbl_mst_ticket.created_on","DESC");
        // $this->db->get("tbl_mst_ticket");
        // echo $this->db->last_query();
        // die;
        return $this->db->get('tbl_mst_ticket')->result_array();
    }
    public function getInprogresTicket($user_id)
    { 
    	$this->db->select('tbl_mst_ticket.*,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name');  
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $this->db->where('tbl_mst_ticket.status','Inprogress'); 
         $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getPendingTicket($user_id)
    { 
    	$this->db->select('tbl_mst_ticket.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name');  
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $created_on=date('Y-m-d');
        $this->db->where('tbl_mst_ticket.created_on !=',$created_on);
        $this->db->where('tbl_mst_ticket.status','New'); 
         $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getForwardedTicket($user_id)
    { 
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');  
        // $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $this->db->where('tbl_mst_ticket.forword_from_1',$user_id); 
        $this->db->where('tbl_mst_ticket.status','Forwarded');
         $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }



    public function getClosedTicket($user_id)
    { 
    	$this->db->select('tbl_mst_ticket.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');  
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $this->db->where('tbl_mst_ticket.status','Resolved');
         $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getQueriedTicket($user_id)
    { 
        $this->db->select('tbl_mst_ticket.*,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_users.name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_zone.zone_name');  
        $this->db->where('tbl_mst_ticket.user_id',$user_id); 
        $this->db->where('tbl_mst_ticket.status','Queried');
         $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_users','tbl_mst_users.user_id = tbl_mst_ticket.queried_by');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id'); 
        return $this->db->get('tbl_mst_ticket')->result_array();
    }

    public function getTicketById($ticket_id)
    {  
        
        $this->db->where('ticket_id',$ticket_id);  
        $this->db->select('tbl_mst_ticket.*,
        tbl_mst_taluka.taluka_name,
        tbl_mst_branch.branch_name,
        tbl_mst_category.cat_name,
        tbl_mst_ticket_title.ticket_title,
        tbl_mst_zone.zone_name,

            tbl_mst_sub_category.sub_cat_name,
            tbl_mst_category.cat_name,
            tbl_mst_brand.brand_name,
            tbl_inventory_item.item_name,
            tbl_mst_inventory.serial_no,  
            tbl_mst_users.name,
            user3.name as forwordby,
            user4.name as forwordby2,
            user2.name as queried_by_name,
            userForward.name as forwardedTo');
        $this->db->join('tbl_mst_ticket_title','tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title');  
        $this->db->join('tbl_mst_taluka','tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id');
        $this->db->join('tbl_mst_branch','tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id');
        $this->db->join('tbl_mst_zone','tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id');
        $this->db->join('tbl_mst_category','tbl_mst_category.cat_id = tbl_mst_ticket.cat_id');

        $this->db->join('tbl_mst_sub_category','tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id'); 
        $this->db->join('tbl_mst_brand','tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id','left'); 

        $this->db->join('tbl_inventory_item','tbl_inventory_item.id = tbl_mst_ticket.inventory_id','left'); 
        $this->db->join('tbl_mst_inventory','tbl_mst_inventory.id = tbl_inventory_item.id','left'); 
         
        $this->db->join('tbl_mst_users','tbl_mst_users.user_id = tbl_mst_ticket.created_by'); 

        $this->db->join('tbl_mst_users as user2','user2.user_id = tbl_mst_ticket.queried_by','left');
        $this->db->join('tbl_mst_users as user3','user3.user_id = tbl_mst_ticket.forword_from_1','left');
        $this->db->join('tbl_mst_users as user4','user4.user_id = tbl_mst_ticket.forward_from_2','left');
        $this->db->join('tbl_mst_users as userForward','userForward.user_id = tbl_mst_ticket.user_id','left');
        // $this->db->get('tbl_mst_ticket');
        // echo $this->db->last_query();die;

        return $this->db->get('tbl_mst_ticket')->row_array();
    }
    public function updateTicket($ticket_id,$formdata)
    {
        $this->db->where('ticket_id', $ticket_id);
        return $this->db->update('tbl_mst_ticket', $formdata);
    }

    public function updateReminder($ticket_id,$formdata)
    {
        $this->db->where('ticket_id', $ticket_id);
        return $this->db->update('tbl_ticket_reminder', $formdata);
    }



}