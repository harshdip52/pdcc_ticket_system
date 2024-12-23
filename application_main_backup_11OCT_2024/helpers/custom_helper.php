<?php 


if(!function_exists("printData")){
    function printData($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';        
    }
}

if(!function_exists(('allBranchAccessIds'))){
    function allBranchAccessIds(){
        return array(1);
    }
}

if(!function_exists('create_ticket_access_id')){
    function create_ticket_access_id(){
        return array('4','5');
    }
}

if(!function_exists('create_ticket_not_all_branch_access')){
    function create_ticket_not_all_branch_access(){
        return array('2','3','5','6','7','8');
    }
}
if(!function_exists('ticketStatusList')){
    function ticketStatusList(){
        return array('Forwarded','Inprogress','New','Resolved');
    }
}
if(!function_exists('ticketPriorityList')){
    function ticketPriorityList(){
        return array('Low','Medium','High');
    }
}

