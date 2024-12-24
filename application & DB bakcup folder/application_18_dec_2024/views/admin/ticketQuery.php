
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

        <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Status :- </label>
            <?=$ticket['status']?>
          </div>
          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Ticket Reply :- </label>
            <?=$ticket['remark']?>
          </div>
        </div>

<?php   $login_role = $this->session->userdata('login_role'); ?>
         <?php if($login_role==3 || $login_role==4){ ?>

   <hr style="color: black; background: black; height: 3px;">
      <form method="post" action="<?=base_url()?>Admin/ticketQuery" id="ticketQuery"> 
        <div class="row">
           <div class="col-md-2 input-padd" style="font-size: 16px;">
             <label>Raise query :- </label>
           </div>
           <div class="col-md-10 input-padd" style="font-size: 16px;"> 
              <textarea name="ticket_query" id="ticket_query" class="form-control"></textarea>
              <input type="hidden" name="ticket_id" value=" <?=$ticket['ticket_id']?>">
           </div>
         </div>
        </div>
         <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
           <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
           <a href="<?=base_url();?>admin" class="btn btn-sm btn-danger">Cancel</a> 
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
        </form>
      <?php } ?>
         
        <!-- end panel-body -->
      </div> 
  </div>
</div>
 
 <script type="text/javascript">
  $('#btnsubmitdata').click(function(e) 
  {

    e.preventDefault();
    var focusSet = false;
    var allfields = true;
    var ticket_query = $("#ticket_query").val(); 
    if (ticket_query == "" || ticket_query== null) 
    {
      if ($("#ticket_query").next(".validation").length == 0) // only add if not added
      {
        $("#ticket_query").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#ticket_query").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#ticket_query").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#ticketQuery').submit();
    } 
    else 
    {
      return false;
    }
  });
</script>

 
 