
  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
     <ol class="breadcrumb pull-right"> 
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory"> Inventory Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory/assign_inventory"> Inventory List</a></li>
      <li class="breadcrumb-item active">View Inventory </li>
    </ol>
    <h1 class="page-header">View Inventory </h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Inventory Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>Inventory/new_item_list">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Category :- </label>
            <?=$AllInventory['cat_name']?> 
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Sub-Category :- </label>
            <?=$AllInventory['sub_cat_name']?>
          </div>

          <?php if($AllInventory['brand_name']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Brand :- </label>
            <?=$AllInventory['brand_name']?>
          </div>
        <?php }?>
          

            <?php if($AllInventory['item']) {?>
            <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Item / Model Name :- </label>
            <?=$AllInventory['item_name']?>
          </div>
        <?php }?>



        
          
          
          <?php if($AllInventory['serial_no']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Serial No. :- </label>
            <?=$AllInventory['serial_no']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['os']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Operating System :- </label>
            <?=$AllInventory['os']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['ups_capacity']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>UPS Capacity in KVA :- </label>
            <?=$AllInventory['ups_capacity']?>
          </div>
          <?php } ?>






          <?php if($AllInventory['indoor_camera']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>No of Indoor Camera :- </label>
            <?=$AllInventory['indoor_camera']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['outdoor_camera']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>No of Outdoor Cammera :- </label>
            <?=$AllInventory['outdoor_camera']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['total_camera']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Total of Cammera :- </label>
            <?=$AllInventory['total_camera']?>
          </div>
          <?php } ?>


          <?php if($AllInventory['backup_connectivity']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Backup Connectivity :- </label>
            <?=$AllInventory['backup_connectivity']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['network_rack']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Network Rack :- </label>
            <?=$AllInventory['network_rack']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['network_card']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Network Card :- </label>
            <?=$AllInventory['network_card']?>
          </div>
          <?php } ?>









          <?php if($AllInventory['atm_id']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>ATM id :- </label>
            <?=$AllInventory['atm_id']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['atm_grounting']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>ATM Grounting :- </label>
            <?=$AllInventory['atm_grounting']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['atm_switch']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>ATM Switch & N/W Board:- </label>
            <?=$AllInventory['atm_switch']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['atm_cctv']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>CCTV NVR:- </label>
            <?=$AllInventory['atm_cctv']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['atm_side']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Side:- </label>
            <?=$AllInventory['atm_side']?>
          </div>
          <?php } ?>










          <?php if($AllInventory['no_of_batteries']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>No Of Batteries :- </label>
            <?=$AllInventory['no_of_batteries']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['ip_address']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>IP Address :- </label>
            <?=$AllInventory['ip_address']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['po_date']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>PO date :- </label>
            <?=$AllInventory['po_date']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['po_no']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>PO No :- </label>
            <?=$AllInventory['po_no']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['supplier_name']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Supplier Name :- </label>
            <?=$AllInventory['supplier_name']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['install_date']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Installation Date :- </label>
            <?=$AllInventory['install_date']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['warranty']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Warranty Period :- </label>
            <?=$AllInventory['warranty']?>
          </div>
          <?php } ?>


          <?php if($AllInventory['make_date']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Make Date :- </label>
            <?=$AllInventory['make_date']?>
          </div>
          <?php } ?>


          <?php if($AllInventory['exp_date']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Expiry Date :- </label>
            <?=$AllInventory['exp_date']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['op_1']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Optional 1 :- </label>
            <?=$AllInventory['op_1']?>
          </div>
          <?php } ?>

          <?php if($AllInventory['op_2']) {?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Optional 2 :- </label>
            <?=$AllInventory['op_2']?>
          </div>
        <?php } ?>
          
        </div>
         
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          
          <!-- <a href="<?= base_url()?>Inventory/new_itemList_view" class="btn btn-sm btn-danger">Back</a> -->
          <input type="button" class="btn btn-sm btn-danger" value="Back" onClick="javascript:history.go(-1)"/>
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