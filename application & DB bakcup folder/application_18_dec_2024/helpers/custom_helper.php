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
        return array('4','5','9','3');
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

if (!function_exists('esc')) {
    function esc($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

/* - - - - - -    Permission Functions  - - - - -  - -*/ 

if (!function_exists('admin_permission')) {
    function admin_permission() {
        return array('1');
    }
}
if (!function_exists('supportRolePermission')) {
    function supportRolePermission() {
        return array('1');
    }
}



if (!function_exists('permissionStatus')) {
    function permissionStatus() {
        return array('1' => 'Yes','2'=> 'No');
    }
}

if (!function_exists('userStatus')) {
    function userStatus($key=null) {
        $userStatus =  array('1' => 'Active','2'=> 'Inactive');

        return isset($userStatus[$key]) ? $userStatus[$key] : $userStatus;
    }
}