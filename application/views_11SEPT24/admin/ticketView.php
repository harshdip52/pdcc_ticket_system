
  <div class="sidebar-bg hide_in_print"></div> 
  <div id="content" class="content">
     <ol class="breadcrumb pull-right"> 
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory"> Inventory Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory/assign_inventory"> Inventory List</a></li>
      <li class="breadcrumb-item active">View Ticket </li>
    </ol>
    <h1 class="page-header">View Ticket </h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Ticket Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>Inventory/new_item_list">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Taluka Name :- </label>
            <?=$ticket['taluka_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Zone  :- </label>
            <?=$ticket['zone_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Branch :- </label>
            <?=$ticket['branch_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Category :- </label>
            <?=$ticket['cat_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Sub-Category :- </label>
            <?=$ticket['sub_cat_name']?>
          </div>

          <?php if(strtolower($ticket['cat_name']) != "network" &&  strtolower($ticket['cat_name']) !== "software"){?>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Brand :- </label>
            <?=$ticket['brand_name']?>
          </div>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Item Name :- </label>
            <?=$ticket['item_name']?>
          </div>
          
          
          
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Serial No. :- </label>
            <?=$ticket['serial_no']?>
          </div>
         <?php } ?>

          <!-- <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Raised By :- </label>
            <?=$ticket['name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Assitn To :- </label>
            <?=$ticket['assignto']?>
          </div> -->
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label> Date :- </label>
            <?=$ticket['created_on']?>
          </div>
          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Title :- </label>
            <?=$ticket['ticket_title']?>
          </div>
          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Description :- </label>
            <?=$ticket['description']?>
          </div>

          <?php if(!empty($ticket['attachment'])) {?>
          
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>View Attachment:- </label>
            <a href="<?=base_url();?><?=$ticket['attachment']?>" target="_blank" class="btn btn-info btn-sm">view</a>
            
          </div>
        <?php } ?>

        <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Status :- </label>
            <?=$ticket['status']?>
          </div>
          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Reply :- </label>
            <?=$ticket['remark']?>
          </div>
          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Priority :- </label>
            <?=$ticket['ticket_priority']?>
          </div>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Raised By :- </label>
            <?=$ticket['name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Assign To :- </label>
            <?=$ticket['assignto']?>
          </div>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward One :- </label>
            <?=$ticket['forward1_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward One Description :- </label>
            <?=$ticket['description_1']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward Two :- </label>
            <?=$ticket['forward2_name']?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward Two Description :- </label>
            <?=$ticket['description_2']?>
          </div>

          

          <!-- <?php if($ticket['forword_from_1'] != '' && $ticket['forward_from_2'] != ''){ ?>
            <div class="col-md-6 input-padd" style="font-size: 16px;">
              <label>Current Working  :- </label>
              <?=$ticket['assignto']?>            
            </div>
           <?php  }?> -->
        </div>
         
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <?php
          
          //  if($this->session->userData('login_role') == 1 || $this->session->userData('login_role') == 8 || $this->session->userData('login_role') == 4){  ?>
              <!-- <a href="<?= base_url()?>Inventory/new_itemList_view" class="btn btn-sm btn-danger">Back</a> -->
              <!-- <a href="" class="btn btn-sm btn-danger">Back</a> -->
              <input type="button" class="btn btn-sm btn-danger" value="Back" onClick="javascript:history.go(-1)"/>
          <!-- <?php #} ?> -->
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
  </div>
</div>
 
 