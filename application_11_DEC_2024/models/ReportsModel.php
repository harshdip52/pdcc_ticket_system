<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }




    public function getSummeryData($taluka_id,$sub_cat_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.sub_cat_id', $sub_cat_id);
        $this->db->where('tbl_mst_inventory.status !=', 6);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
 
    public function getInventoryReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status)
    {
 
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_mst_inventory.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_mst_inventory.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_mst_inventory.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_mst_inventory.zone_id='.$zone_id;   }
        if($branch_id) { $condition.=' and tbl_mst_inventory.branch_id='.$branch_id;}
        if($status) { $condition.=' and tbl_mst_inventory.status='.$status;}

        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_inventory.inserted_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_inventory.inserted_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and cast(tbl_mst_inventory.inserted_on as date) =  '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_inventory.inserted_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
 

        $myQuery = "SELECT tbl_mst_inventory.*,  
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_inventory_item.item_name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_sub_category.sub_cat_name,
            assignBy.name as assign_by_name, 
            updated_user.name as updated_user_name, 
            tbl_mst_status.status_name 
            FROM ticket_support.tbl_mst_inventory
            left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_inventory.brand_id
            left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_inventory.cat_id
            left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_inventory.supplier
            left join ticket_support.tbl_inventory_item on tbl_inventory_item.id=tbl_mst_inventory.item
            left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_inventory.taluka_id
            left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_inventory.branch_id
            left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_inventory.zone_id 
            left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_inventory.sub_cat_id 
            left join ticket_support.tbl_mst_status on tbl_mst_status.id=tbl_mst_inventory.status 
            left join ticket_support.tbl_mst_users as updated_user on updated_user.user_id=tbl_mst_inventory.updated_by 
            left join ticket_support.tbl_mst_users as assignBy on assignBy.user_id=tbl_mst_inventory.assign_by 
            WHERE tbl_mst_inventory.id IS NOT null $condition";
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();exit;
       

       
    }

    public function getTicketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$user_id,$status)
    {
        
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_mst_ticket.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_mst_ticket.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_mst_ticket.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_mst_ticket.zone_id='.$zone_id;   }
        if($branch_id) { $condition.=' and tbl_mst_ticket.branch_id='.$branch_id;}
        if($user_id) { $condition.=' and tbl_mst_ticket.user_id='.$user_id;}
        if($status) { $condition.=' and tbl_mst_ticket.status='."'".$status."'";}

        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_ticket.created_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_ticket.created_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and  cast(tbl_mst_ticket.created_on as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_ticket.created_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
 
        $myQuery = "SELECT tbl_mst_ticket.*,  
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name,
            tbl_mst_branch.branch_name,
            tbl_mst_category.cat_name, 
            tbl_mst_sub_category.sub_cat_name, 
            tbl_mst_brand.brand_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_users.name, 
            tbl_created_by.name as created_by_name 
        FROM ticket_support.tbl_mst_ticket
        
        left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join ticket_support.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join ticket_support.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by   
        WHERE ticket_support.tbl_mst_ticket.ticket_id IS NOT null $condition";
    $query = $this->db->query($myQuery);
    return  $result = $query->result_array();exit;
 
    }

    public function getPendingticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$user_id,$status)
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_mst_ticket.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_mst_ticket.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_mst_ticket.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_mst_ticket.zone_id='.$zone_id;   }

        if($branch_id) { $condition.=' and tbl_mst_ticket.branch_id='.$branch_id;}
        if($user_id) { $condition.=' and tbl_mst_ticket.user_id='.$user_id;}
        // if($status) { $condition.=' and tbl_mst_ticket.status='."'".$status."'";}

        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_ticket.created_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_ticket.created_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and cast(tbl_mst_ticket.created_on as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_ticket.created_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
 

         $created_on = date('Y-m-d');
        $myQuery = "SELECT tbl_mst_ticket.*,  
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name,
            tbl_mst_branch.branch_name,
            tbl_mst_category.cat_name, 
            tbl_mst_sub_category.sub_cat_name, 
            tbl_mst_brand.brand_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_users.name, 
            tbl_created_by.name as created_by_name 
        FROM ticket_support.tbl_mst_ticket
        
        left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join ticket_support.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join ticket_support.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by   
        WHERE tbl_mst_ticket.ticket_id IS NOT null and  tbl_mst_ticket.status='New' and tbl_mst_ticket.created_on != '$created_on' $condition";
    $query = $this->db->query($myQuery);
    return  $result = $query->result_array();exit;
 
    }


    
    public function getforwardedticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status)
    {
        
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_mst_ticket.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_mst_ticket.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_mst_ticket.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_mst_ticket.zone_id='.$zone_id;   }
        if($branch_id) { $condition.=' and tbl_mst_ticket.branch_id='.$branch_id;}
        // if($status) { $condition.=' and tbl_mst_ticket.status='."'".$status."'";}

        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_ticket.created_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_ticket.created_on < '."'".$to_date."'";}

        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and cast(tbl_mst_ticket.created_on as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_ticket.created_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 

         $created_on = date('Y-m-d');
        $myQuery = "SELECT tbl_mst_ticket.*,  
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name,
            tbl_mst_branch.branch_name,
            tbl_mst_category.cat_name, 
            tbl_mst_sub_category.sub_cat_name, 
            tbl_mst_brand.brand_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_users.name, 
            tbl_created_by.name as created_by_name, 
            forwarded_by1.name as forwarded_by1_name, 
            forwarded_by2.name as forwarded_by2_name 
        FROM ticket_support.tbl_mst_ticket
        
        left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join ticket_support.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join ticket_support.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by

        left join ticket_support.tbl_mst_users as forwarded_by1 on forwarded_by1.user_id=tbl_mst_ticket.forword_from_1   
        left join ticket_support.tbl_mst_users as forwarded_by2 on forwarded_by2.user_id=tbl_mst_ticket.forward_from_2   
        WHERE tbl_mst_ticket.ticket_id IS NOT null and  (tbl_mst_ticket.forword_from_1 IS NOT null or tbl_mst_ticket.forword_from_1!=0)  $condition";
    $query = $this->db->query($myQuery);
    return  $result = $query->result_array();exit;
 
    }


    public function getcallLogReports($from_date,$to_date,$user_id)
    {
        $condition='';
        if($user_id) { $condition.=' and  tbl_mst_call_logs.created_by='.$user_id;  }
        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_call_logs.created_at >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_call_logs.created_at < '."'".$to_date."'";}


        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and  cast(tbl_mst_call_logs.created_at as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_call_logs.created_at BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 

         
        $myQuery = "SELECT tbl_mst_call_logs.*,tbl_mst_users.name  FROM ticket_support.tbl_mst_call_logs left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_call_logs.created_by  WHERE tbl_mst_call_logs.id IS NOT null   $condition";
      
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();exit;
 
    }


    public function getinventoryMovementReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status)
    {
 
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_inventory_movement_log.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_inventory_movement_log.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_inventory_movement_log.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_inventory_movement_log.zone_id='.$zone_id;   }
        if($branch_id) { $condition.=' and tbl_inventory_movement_log.branch_id='.$branch_id;}
        // if($status) { $condition.=' and tbl_inventory_movement_log.status='.$status;}

        if($from_date && empty($to_date)){ $condition.=' and tbl_inventory_movement_log.inserted_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_inventory_movement_log.inserted_on < '."'".$to_date."'";}
        

        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and cast(tbl_inventory_movement_log.inserted_on as date) =  '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_inventory_movement_log.inserted_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 

        $myQuery = "SELECT tbl_inventory_movement_log.*,
        tbl_mst_inventory.serial_no,  
        tbl_mst_inventory.po_date,  
        tbl_mst_inventory.po_no,  
        tbl_mst_inventory.warranty,  
        tbl_mst_inventory.make_date,  
        tbl_mst_inventory.ip_address,
        tbl_mst_taluka.taluka_name, 
        tbl_mst_zone.zone_name, 
        tbl_mst_branch.branch_name,
        tbl_mst_category.cat_name,
        tbl_mst_sub_category.sub_cat_name,
        tbl_mst_brand.brand_name,
        tbl_mst_users.name as supplier_name,
        tbl_inventory_item.item_name,

        from_taluka.taluka_name as taluka_name_from, 
        from_zone.zone_name as zone_name_from, 
        from_branch.branch_name as branch_name_from
            
            
            
              
            FROM ticket_support.tbl_inventory_movement_log

            left join ticket_support.tbl_mst_inventory on tbl_mst_inventory.id=tbl_inventory_movement_log.inventory_id
            left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_inventory.taluka_id
            left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_inventory.zone_id 
            left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_inventory.branch_id
            left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_inventory_movement_log.cat_id
            left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_inventory_movement_log.sub_cat_id 
            left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_inventory.brand_id

            left join ticket_support.tbl_mst_taluka as from_taluka on from_taluka.taluka_id=tbl_inventory_movement_log.taluka_id
            left join ticket_support.tbl_mst_zone as from_zone on from_zone.zone_id=tbl_inventory_movement_log.zone_id 
            left join ticket_support.tbl_mst_branch  as from_branch on from_branch.branch_id=tbl_inventory_movement_log.branch_id

           
            left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_inventory_movement_log.inserted_by
            left join ticket_support.tbl_inventory_item on tbl_inventory_item.id=tbl_mst_inventory.item 
            WHERE tbl_mst_inventory.id IS NOT null $condition";
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();exit;
       

       
    }

    public function totalCount($sub_cat_id)
    {
       
        $this->db->select('count(id) as CPU'); 
        $this->db->where('tbl_mst_inventory.sub_cat_id', $sub_cat_id);
        $this->db->where('tbl_mst_inventory.status !=', 6);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    
    public function getTicketBystatus($taluka_id,$status)
    {   $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_ticket.status=', $status); 
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getnewTicketBystatus($taluka_id,$status)
    {
        $created_on = date('Y-m-d');
        $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_ticket.status=', $status); 
        $this->db->where('tbl_mst_ticket.created_on=', $created_on); 
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function pendingTicket($taluka_id,$status)
    { 
        $created_on = date('Y-m-d');
        $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_ticket.status=', $status); 
        $this->db->where('tbl_mst_ticket.created_on !=', $created_on); 
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getTotalTicket($taluka_id)
    {   $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id); 
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getTicketBystatus2($taluka_id,$status,$from_date,$to_date)
    { 
         
        if($from_date && empty($to_date)){ $condition.=' tbl_mst_ticket.created_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' tbl_mst_ticket.created_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' cast(tbl_mst_ticket.created_on as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' tbl_mst_ticket.created_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
 
        $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_ticket.status=', $status); 
        // $this->db->where('tbl_mst_ticket.ticket_id IS NOT null');
        if($condition!=null)
        {
            $this->db->where($condition);
        }
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getTotalTicket2($taluka_id,$from_date,$to_date)
    { 
        
        if($from_date && empty($to_date)){ $condition.=' tbl_mst_ticket.created_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' tbl_mst_ticket.created_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' cast(tbl_mst_ticket.created_on as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' tbl_mst_ticket.created_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
        
        $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id); 
        if($condition!=null)
        {
            $this->db->where($condition);
        }
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 

        
        foreach($data as $aa)
        {
            return $aa;
        }
    }


    function getAllCbsSupportHelpDeskUsers(){
        $this->db->select("tbl_mst_users.*");
        $this->db->where_in('role',[4,5,9]);
        return $this->db->get("tbl_mst_users")->result_array();
    }
    
    


    public function getassignInventoryReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$status)
    {
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
        $condition='';
        // $condition='id IS NOT null';
        if($cat_id) { $condition.=' and  tbl_mst_inventory.cat_id='.$cat_id;  }
        if($sub_cat_id) { $condition.=' and tbl_mst_inventory.sub_cat_id='.$sub_cat_id; }
        if($taluka_id) { $condition.=' and  tbl_mst_inventory.taluka_id='.$taluka_id;   }
        if($zone_id) { $condition.=' and tbl_mst_inventory.zone_id='.$zone_id;   }
        if($branch_id) { $condition.=' and tbl_mst_inventory.branch_id='.$branch_id;}
        if($status) { $condition.=' and tbl_mst_inventory.status='.$status;}

        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_inventory.assign_on >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_inventory.assign_on < '."'".$to_date."'";}
        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and cast(tbl_mst_inventory.assign_on as date) =  '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_inventory.assign_on BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 
 

         $myQuery = "SELECT tbl_mst_inventory.*,  
            tbl_mst_brand.brand_name,
            tbl_mst_category.cat_name,
            tbl_mst_users.name as supplier_name,
            tbl_inventory_item.item_name,
            tbl_mst_taluka.taluka_name,
            tbl_mst_branch.branch_name,
            tbl_mst_zone.zone_name,
            tbl_mst_sub_category.sub_cat_name,
            assignBy.name as assign_by_name, 
            updated_user.name as updated_user_name, 
            tbl_mst_status.status_name 
            FROM ticket_support.tbl_mst_inventory
            left join ticket_support.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_inventory.brand_id
            left join ticket_support.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_inventory.cat_id
            left join ticket_support.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_inventory.supplier
            left join ticket_support.tbl_inventory_item on tbl_inventory_item.id=tbl_mst_inventory.item

            left join ticket_support.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_inventory.taluka_id
            left join ticket_support.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_inventory.branch_id
            left join ticket_support.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_inventory.zone_id 
            left join ticket_support.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_inventory.sub_cat_id 
            left join ticket_support.tbl_mst_status on tbl_mst_status.id=tbl_mst_inventory.status 
            left join ticket_support.tbl_mst_users as updated_user on updated_user.user_id=tbl_mst_inventory.updated_by 
            left join ticket_support.tbl_mst_users as assignBy on assignBy.user_id=tbl_mst_inventory.assign_by 
            WHERE tbl_mst_inventory.id IS NOT null $condition";
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();exit;       

    }

    public function getUserwiseTicketCreateReport($from_date, $to_date, $cat_id, $sub_cat_id, $taluka_id, $zone_id, $branch_id, $user_id, $status)
    {
        // echo "Hello from model file  ";die;
        $condition = '';
        $this->db->select('tbl_mst_ticket.*,  
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name,
            tbl_mst_branch.branch_name,
            tbl_mst_category.cat_name, 
            tbl_mst_sub_category.sub_cat_name, 
            tbl_mst_brand.brand_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_users.name, 
            tbl_created_by.name as created_by_name ');
        $this->db->from("tbl_mst_ticket");
        $this->db->join("tbl_mst_taluka", "tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id", "left");
        $this->db->join("tbl_mst_zone", "tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id ", "left");
        $this->db->join("tbl_mst_branch", "tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id", "left");
        $this->db->join("tbl_mst_category", "tbl_mst_category.cat_id = tbl_mst_ticket.cat_id", "left");
        $this->db->join("tbl_mst_sub_category", "tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id ", "left");
        $this->db->join("tbl_mst_brand", "tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id", "left");
        $this->db->join("tbl_mst_ticket_title", "tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title", "left");
        $this->db->join("tbl_mst_users", "tbl_mst_users.user_id = tbl_mst_ticket.user_id", "left");
        $this->db->join("tbl_mst_users as tbl_created_by", "tbl_created_by.user_id = tbl_mst_ticket.created_by", "left");

    //    echo $cat_id."--".$sub_cat_id;die;
        if (($cat_id != '' || $cat_id != null || $cat_id != 0) && !empty($cat_id)) {
            $this->db->where('tbl_mst_ticket.cat_id', $cat_id);
        }
        if ($sub_cat_id != '' || $sub_cat_id != null || $sub_cat_id != 0 && !empty($sub_cat_id)) {
            $this->db->where('tbl_mst_ticket.sub_cat_id', $sub_cat_id);
        }
       
        if ($taluka_id != '' || $taluka_id != null || $taluka_id != 0 && !empty($taluka_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        if ($zone_id != '' || $zone_id != null || $zone_id != 0 && !empty($zone_id)) {
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if ($branch_id != '' || $branch_id != null || $branch_id != 0 && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }

        if ($user_id != '' || $user_id != null || $user_id != 0 && !empty($user_id)) {
            // $this->db->where('tbl_mst_ticket.user_id', $user_id);
            // $this->db->where('tbl_mst_ticket.created_by', $user_id);
            $this->db->where('tbl_mst_ticket.created_by', $user_id);
        }
        if ($status != '' || $status != null || $status != 0 && !empty($status)) {        
            $this->db->where('tbl_mst_ticket.status', $status);
        }
        if ($from_date != '' && $from_date != null && $from_date != 0 && $from_date != "0000-00-00") {
            $this->db->where('tbl_mst_ticket.created_on >=', $from_date);
        }

        if ($to_date != '' && $to_date != null && $to_date != 0 && $to_date != "0000-00-00" ) {
            $this->db->where('tbl_mst_ticket.created_on <=', $to_date);
        }
        $query = $this->db->get();       
        // echo $this->db->last_query();
        // die;
        return  $query->result_array();
    }
    public function getUserwiseTicketCreateReport_old($from_date, $to_date, $cat_id, $sub_cat_id, $taluka_id, $zone_id, $branch_id, $user_id, $status)
    {
        // echo "Hello from model file  ";die;
        $condition = '';
        $this->db->select('tbl_mst_ticket.*,  
            tbl_mst_taluka.taluka_name,
            tbl_mst_zone.zone_name,
            tbl_mst_branch.branch_name,
            tbl_mst_category.cat_name, 
            tbl_mst_sub_category.sub_cat_name, 
            tbl_mst_brand.brand_name,
            tbl_mst_ticket_title.ticket_title,
            tbl_mst_users.name, 
            tbl_created_by.name as created_by_name ');
        $this->db->from("tbl_mst_ticket");
        $this->db->join("tbl_mst_taluka", "tbl_mst_taluka.taluka_id = tbl_mst_ticket.taluka_id", "left");
        $this->db->join("tbl_mst_zone", "tbl_mst_zone.zone_id = tbl_mst_ticket.zone_id ", "left");
        $this->db->join("tbl_mst_branch", "tbl_mst_branch.branch_id = tbl_mst_ticket.branch_id", "left");
        $this->db->join("tbl_mst_category", "tbl_mst_category.cat_id = tbl_mst_ticket.cat_id", "left");
        $this->db->join("tbl_mst_sub_category", "tbl_mst_sub_category.sub_cat_id = tbl_mst_ticket.sub_cat_id ", "left");
        $this->db->join("tbl_mst_brand", "tbl_mst_brand.brand_id = tbl_mst_ticket.brand_id", "left");
        $this->db->join("tbl_mst_ticket_title", "tbl_mst_ticket_title.id = tbl_mst_ticket.ticket_title", "left");
        $this->db->join("tbl_mst_users", "tbl_mst_users.user_id = tbl_mst_ticket.user_id", "left");
        $this->db->join("tbl_mst_users as tbl_created_by", "tbl_created_by.user_id = tbl_mst_ticket.created_by", "left");

        if (($cat_id != '' || $cat_id != null || $cat_id != 0) && !empty($cat_id)) {
            $this->db->where('tbl_mst_ticket.cat_id', $cat_id);
        }
        if ($sub_cat_id != '' || $sub_cat_id != null || $sub_cat_id != 0 && !empty($sub_cat_id)) {
            $this->db->where('tbl_mst_ticket.sub_cat_id', $sub_cat_id && !empty($sub_cat_id));
        }
        if ($taluka_id != '' || $taluka_id != null || $taluka_id != 0 && !empty($taluka_id)) {
            $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id);
        }
        if ($zone_id != '' || $zone_id != null || $zone_id != 0 && !empty($zone_id)) {
            $this->db->where('tbl_mst_ticket.zone_id', $zone_id);
        }
        if ($branch_id != '' || $branch_id != null || $branch_id != 0 && !empty($branch_id)) {
            $this->db->where('tbl_mst_ticket.branch_id', $branch_id);
        }
        if ($user_id != '' || $user_id != null || $user_id != 0 && !empty($user_id)) {
            // $this->db->where('tbl_mst_ticket.user_id', $user_id);
            // $this->db->where('tbl_mst_ticket.created_by', $user_id);
            $this->db->where('tbl_mst_ticket.created_by', $user_id);
        }
        if ($status != '' || $status != null || $status != 0 && !empty($status)) {
        
            $this->db->where('tbl_mst_ticket.status', $status);
        }
        if ($from_date != '' && $from_date != null && $from_date != 0 && $from_date != "0000-00-00") {
            $this->db->where('tbl_mst_ticket.created_on >=', $from_date);
        }

        if ($to_date != '' && $to_date != null && $to_date != 0 && $to_date != "0000-00-00" ) {
            $this->db->where('tbl_mst_ticket.created_on <=', $to_date);
        }
        $query = $this->db->get();       
        // echo $this->db->last_query();
        // die;
        return  $query->result_array();
    }

    
    



    
}
