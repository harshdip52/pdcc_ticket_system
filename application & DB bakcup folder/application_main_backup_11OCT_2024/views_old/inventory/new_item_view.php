<body class="  pace-done">
  <div id="page-loader" class="fade show d-none"><span class="spinner"></span></div>
  <div id="page-container" class="page-sidebar-fixed page-header-fixed show">
    <div id="header" class="header navbar-default hide_in_print">
      <div class="navbar-header" style="text-align:center;">
        <a href="index" class="navbar-brand"><img src="<?=base_url();?>assets/img/logo/logo_pdcc.jpg"><b class="pdcc_logo_name">PDCC</b>Support Ticketing and Inventory System</a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div>
      <ul class="navbar-nav navbar-right">
        <li class="dropdown navbar-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="d-none d-md-inline">Admin Dashboard</span> <b class="caret"></b>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item">Profile</a>
            <a href="#" class="dropdown-item">Change Password</a>
            <a href="#" class="dropdown-item">Log Out</a>
          </div>
        </li>
      </ul>
    </div>
    <div id="sidebar" class="sidebar hide_in_print">
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <ul class="nav">
          <li class="nav-header">Navigation</li>
          <li class="active">
            <a href="<?=base_url();?>inventery/dashboard"> <i class="fas fa-edit"></i> Inventory Dashboard
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item ">Inventory Dashboard</li>
      <li class="breadcrumb-item active">New Item</li>
    </ol>
    <h1 class="page-header">View New Item</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Inventory</h4>
      </div>
      <form method="post" action="<?=base_url()?>Inventory/new_item_list">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4 input-padd" style="font-size: 16px;">
              <label>Taluka :- </label>
              <?=$AllInventory['taluka_name']?>
            </div>
            <div class="col-md-4 input-padd" style="font-size: 16px;">
              <label>Branch :- </label>
              <?=$AllInventory['branch_name']?>
            </select>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Zone :- </label>
            <?=$AllInventory['zone_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Item Name :- </label>
            <?=$AllInventory['item_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Brand :- </label>
            <?=$AllInventory['brand']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Category :- </label>
            <?=$AllInventory['cat_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Sub-Category :- </label>
            <?=$AllInventory['sub_cat_name']?>
          </div>
          
          
          
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Serial No. :- </label>
            <?=$AllInventory['serial_no']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>IP Address :- </label>
            <?=$AllInventory['ip_address']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Make Date :- </label>
            <?=$AllInventory['make_date']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Optional 1 :- </label>
            <?=$AllInventory['optional_1']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Optional 2 :- </label>
            <?=$AllInventory['optional_1']?>
          </div>
          
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          
          <a href="<?= base_url()?>Inventory/new_itemList_view" class="btn btn-sm btn-danger">Back</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
  </div>
</div>
<script>
function getBranch(taluka_id)
{
$.getJSON("<?php echo base_url();?>Ajax/getBranchAjax/"+taluka_id, function (data) {
var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
$.each(data, function (key, val)
{
stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
});
$("#branch_id").html(stringToAppend);
});
}
function getZone(branch_id)
{
$.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+branch_id, function (data) {
var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
$.each(data, function (key, val)
{
stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
});
$("#zone_id").html(stringToAppend);
});
}
function getSubCategory(cat_id)
{
$.getJSON("<?php echo base_url();?>Ajax/getSubCategoryAjax/"+cat_id, function (data) {
var stringToAppend = "<option disabled selected value=''> -- Select Sub Category -- </option> ";
$.each(data, function (key, val)
{
stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
});
$("#sub_cat_id").html(stringToAppend);
});
}
</script>