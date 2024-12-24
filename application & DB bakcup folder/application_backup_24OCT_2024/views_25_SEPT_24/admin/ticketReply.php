
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
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Raised By :- </label>
            <?=$ticket['name']?>
          </div>
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
      </div>
 <?php $login_role = $this->session->userdata('login_role'); ?>
 <?php if($login_role==5){ ?>
      <form>
         <br>
        <div class="row">

          <div class="col-md-1 input-padd" style="font-size: 16px;">
             <label>Reply :- </label>
           </div>
           <div class="col-md-11 input-padd" style="font-size: 16px;"> 
              <textarea name="remakr" class="form-control"></textarea>
           </div>

           <div class="col-md-1 input-padd" style="font-size: 16px;">
             <label>Status :- </label>
           </div>
           <div class="col-md-11 input-padd" style="font-size: 16px;">
            <input type="radio" id="Resolved" name="fav_language" value="Resolved">
            <label for="html">Resolved</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="Inprogress" name="fav_language" value="In-Progress"> 
            <label for="html">In-Progress</label>
           </div>
         </div>
        </div>
         <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <!-- <a id="submit_pop" class="btn btn-sm btn-success">Submit</a> -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
         
          <a href="<?=base_url();?>admin" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
        </form>
      <?php } ?>
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
 
 