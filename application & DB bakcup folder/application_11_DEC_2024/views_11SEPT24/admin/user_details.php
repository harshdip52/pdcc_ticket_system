
  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
     <ol class="breadcrumb pull-right"> 
       <li class="breadcrumb-item "><a href="<?= base_url();?>admin">  Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>admin/users_list"> Users List</a></li>
      <li class="breadcrumb-item active">View User Details </li>
    </ol>
    <h1 class="page-header">View User Details </h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">User Details</h4>
      </div> 
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>User Name :- </label>
            <?=$userData['name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Email :- </label>
            <?=$userData['email']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Mobile :- </label>
            <?=$userData['mobile']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Role :- </label>
            <?=$userData['role_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Taluka :- </label>
            <?=$userData['taluka_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Zone :- </label>
            <?=$userData['zone_name']?>
          </div>
          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>Branch :- </label>
            <?php if (isset($branch)) 
            {
              foreach ($branch as $key => $value) {
                echo '<br>';
                echo $value['branch_name'];

              }
                
            }
            else
            {
              echo $userData['branch_name'];
            } ?>
          </div>
           
          
        </div>
         
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          
          <a href="<?= base_url()?>admin/users_list" class="btn btn-sm btn-danger">Back</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
  
  </div>
</div>
 