<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportsModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function getCPU($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 1);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getMonitor($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 2);
        $data= $this->db->get('tbl_mst_inventory')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getPrinters($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 3);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getScanners($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 4);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getUPS($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 5);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getBatterys($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 6);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getCCTV($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 7);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getKeyboard($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 8);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getMouse($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 9);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getCableWire($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 10);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getCable($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 11);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getPendrive($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 12);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getSwitch($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 13);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getRouter($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 14);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getModem($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 15);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }



    public function getATM($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 16);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getRFConnectivity($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 17);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getCBSSoftware($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 18);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getP2BSoftware($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 19);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getBankEmail($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 20);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }
    public function getBoardMeetingVol($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 21);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }






    public function getOtherSoftware($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 22);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getNetworkProblem($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 23);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }


    public function getLaptop($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 24);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getRam($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 25);
        $data= $this->db->get('tbl_mst_inventory')->row_array();
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    public function getSSD($taluka_id)
    {   $this->db->select('count(id) as CPU');
        $this->db->where('tbl_mst_inventory.taluka_id', $taluka_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
        $this->db->where('tbl_mst_inventory.sub_cat_id', 26);
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
            tbl_mst_status.status_name 
            FROM pdcc_live.tbl_mst_inventory
            left join pdcc_live.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_inventory.brand_id
            left join pdcc_live.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_inventory.cat_id
            left join pdcc_live.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_inventory.supplier
            left join pdcc_live.tbl_inventory_item on tbl_inventory_item.id=tbl_mst_inventory.item
            left join pdcc_live.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_inventory.taluka_id
            left join pdcc_live.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_inventory.branch_id
            left join pdcc_live.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_inventory.zone_id 
            left join pdcc_live.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_inventory.sub_cat_id 
            left join pdcc_live.tbl_mst_status on tbl_mst_status.id=tbl_mst_inventory.status 
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
        FROM pdcc_live.tbl_mst_ticket
        
        left join pdcc_live.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join pdcc_live.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join pdcc_live.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join pdcc_live.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join pdcc_live.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join pdcc_live.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join pdcc_live.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join pdcc_live.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join pdcc_live.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by   
        WHERE tbl_mst_ticket.ticket_id IS NOT null $condition";
    $query = $this->db->query($myQuery);
    return  $result = $query->result_array();exit;
 
    }

    public function getPendingticketReports($from_date,$to_date,$cat_id,$sub_cat_id,$taluka_id,$zone_id,$branch_id,$user_id,$status)
    {
        
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
 

        //  $created_on1 = date('Y-m-d');

         $created_on.="'".date('Y-m-d')."'";

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
        FROM pdcc_live.tbl_mst_ticket
        
        left join pdcc_live.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join pdcc_live.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join pdcc_live.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join pdcc_live.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join pdcc_live.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join pdcc_live.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join pdcc_live.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join pdcc_live.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join pdcc_live.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by   
        WHERE tbl_mst_ticket.ticket_id IS NOT null and  tbl_mst_ticket.status='New' and cast(tbl_mst_ticket.created_on as date) != $created_on $condition";
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

        $created_on.="'".date('Y-m-d')."'";
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
        FROM pdcc_live.tbl_mst_ticket
        
        left join pdcc_live.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_ticket.taluka_id
        left join pdcc_live.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_ticket.zone_id 
        left join pdcc_live.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_ticket.branch_id
        left join pdcc_live.tbl_mst_category on tbl_mst_category.cat_id=tbl_mst_ticket.cat_id
        left join pdcc_live.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_mst_ticket.sub_cat_id 
        left join pdcc_live.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_ticket.brand_id
        left join pdcc_live.tbl_mst_ticket_title on tbl_mst_ticket_title.id=tbl_mst_ticket.ticket_title
        left join pdcc_live.tbl_mst_users on tbl_mst_users.user_id=tbl_mst_ticket.user_id   
        left join pdcc_live.tbl_mst_users as tbl_created_by on tbl_created_by.user_id=tbl_mst_ticket.created_by

        left join pdcc_live.tbl_mst_users as forwarded_by1 on forwarded_by1.user_id=tbl_mst_ticket.forword_from_1   
        left join pdcc_live.tbl_mst_users as forwarded_by2 on forwarded_by2.user_id=tbl_mst_ticket.forward_from_2   
        WHERE tbl_mst_ticket.ticket_id IS NOT null and  (tbl_mst_ticket.forword_from_1 IS NOT null or tbl_mst_ticket.forword_from_1!=0)  $condition";
    $query = $this->db->query($myQuery);
    return  $result = $query->result_array();exit;
 
    }


    public function getcallLogReports($from_date,$to_date)
    {
        $condition='';
        if($from_date && empty($to_date)){ $condition.=' and tbl_mst_call_logs.created_at >'."'".$from_date."'";} 
        if(empty($from_date) && $to_date){ $condition.=' and tbl_mst_call_logs.created_at < '."'".$to_date."'";}


        if(!empty($from_date) && !empty($to_date) && $from_date==$to_date){ $condition.=' and  cast(tbl_mst_call_logs.created_at as date) = '."'".$from_date."'";} 
        if(!empty($from_date) && !empty($to_date) && $from_date!=$to_date){ $condition.=' and tbl_mst_call_logs.created_at BETWEEN '."'".$from_date."'".'and'."'".$to_date."'";} 

         
        $myQuery = "SELECT *  FROM pdcc_live.tbl_mst_call_logs WHERE tbl_mst_call_logs.id IS NOT null   $condition";
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
            FROM pdcc_live.tbl_inventory_movement_log

            left join pdcc_live.tbl_mst_inventory on tbl_mst_inventory.id=tbl_inventory_movement_log.inventory_id
            left join pdcc_live.tbl_mst_taluka on tbl_mst_taluka.taluka_id=tbl_mst_inventory.taluka_id
            left join pdcc_live.tbl_mst_zone on tbl_mst_zone.zone_id=tbl_mst_inventory.zone_id 
            left join pdcc_live.tbl_mst_branch on tbl_mst_branch.branch_id=tbl_mst_inventory.branch_id
            left join pdcc_live.tbl_mst_category on tbl_mst_category.cat_id=tbl_inventory_movement_log.cat_id
            left join pdcc_live.tbl_mst_sub_category on tbl_mst_sub_category.sub_cat_id=tbl_inventory_movement_log.sub_cat_id 
            left join pdcc_live.tbl_mst_brand on tbl_mst_brand.brand_id=tbl_mst_inventory.brand_id

            left join pdcc_live.tbl_mst_taluka as from_taluka on from_taluka.taluka_id=tbl_inventory_movement_log.taluka_id
            left join pdcc_live.tbl_mst_zone as from_zone on from_zone.zone_id=tbl_inventory_movement_log.zone_id 
            left join pdcc_live.tbl_mst_branch  as from_branch on from_branch.branch_id=tbl_inventory_movement_log.branch_id

           
            left join pdcc_live.tbl_mst_users on tbl_mst_users.user_id=tbl_inventory_movement_log.inserted_by
            left join pdcc_live.tbl_inventory_item on tbl_inventory_item.id=tbl_mst_inventory.item 
            WHERE tbl_mst_inventory.id IS NOT null $condition";
        $query = $this->db->query($myQuery);
        return  $result = $query->result_array();exit;
       

       
    }

    public function totalCount($sub_cat_id)
    {
       
        $this->db->select('count(id) as CPU'); 
        $this->db->where('tbl_mst_inventory.sub_cat_id', $sub_cat_id);
        $this->db->where('tbl_mst_inventory.status!=', 4);
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

    public function getTotalTicket($taluka_id)
    {   $this->db->select('count(ticket_id) as CPU');
        $this->db->where('tbl_mst_ticket.taluka_id', $taluka_id); 
        $data= $this->db->get('tbl_mst_ticket')->row_array(); 
        foreach($data as $aa)
        {
            return $aa;
        }
    }

    
    



    
}
