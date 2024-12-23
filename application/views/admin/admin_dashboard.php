 <?php $login_role = $this->session->userdata('login_role'); ?>
        <div class="sidebar-bg hide_in_print"></div>
        <div id="content" class="content"> 
          <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol> 
          <h1 class="page-header">Dashboard</h1> 
          <div class="row">

          <?php if($login_role==1 ) {?> 
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Master Data</h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_data">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>
             <?php //|| $login_role==3  
             if($login_role==2 || $login_role==4 || $login_role==1  || $login_role==8 || $login_role==7 ) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Ticket Dashboard</h4> 
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/ticketDashboard">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
          <?php } ?>
             
            <?php if($login_role==1) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-book"></i></div>
                <div class="stats-info">
                  <h4>User</h4>
                </div>
                <div class="stats-link">
                  <a href="<?=base_url()?>admin/users_list">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php if($login_role==1 || $login_role==5 || $login_role==7 || $login_role==8) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Inventory</h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>Inventory">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a> 
                </div>
              </div>
            </div>
            <?php } ?>


             <?php if($login_role==5  || $login_role==9   ) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Ticket Dashboard</h4> 
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>Support/supportDashboard">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>

            <!-- || $login_role==3  -->
            <?php if($login_role==3  ) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Ticket Dashboard</h4> 
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>BranchManagerDashboard/bTicketDashboard">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div> 
            <?php } ?>
              <!--  Showing Ticket Dashboard As per discuss with vishal PDCC  For Vebdir Login  -->
            <?php if($login_role==6  ) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Ticket Dashboard</h4> 
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>Vendor/VendorDashboard">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>

            <?php #if($login_role !=4 && $login_role != 9 && $login_role != 3 ) {
            if($login_role == 1 && $login_role == 4 && $login_role == 8 ) {
            ?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon"><i class="fa fa-book"></i></div>
                <div class="stats-info">
                  <h4>Call Log</h4>
                </div>
                <div class="stats-link">
                  <a href="<?=base_url()?>admin/call_log_master">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <?php }?>

            <?php if($login_role != 9 && $login_role != 6  ) {?>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>All Reports</h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>reports">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
              <?php  } ?>

          </div>
         <?php if($reminder) {?>
         <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: block; padding-left: 0px;">
                <div class="modal-dialog modal-xl" role="dialog" style="display: block; padding-left: 0px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ticket Reminder</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="modelHide()"> <span aria-hidden="true">×</span>
                            </button> 
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                <table id="eventsTable"
                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Tocket id</th> 
                            <th class="text-nowrap">Ticket Title</th>
                            <th class="text-nowrap">Ticket Date</th>
                            <th class="text-nowrap">Reminder</th>
                            <th class="text-nowrap">Reminder Date</th>
                            <th class="text-nowrap">Action</th>
                          </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($reminder as $key => $value) {
                        ?>
                      <tr>
                        <td><?php echo $key=$key+1?></td>
                        <td><?=$value['ticket_no']?></td>
                        <td><?=$value['ticket_title']?></td>
                        <td><?=$value['t_created_date']?></td>
                        <td><?=$value['reminder']?></td>
                        <td><?=$value['created_on']?></td>
                        <td><a type="button" class="btn btn-primary btn-sm" href="<?= base_url();?>support/ticketReply/<?=$value['ticket_id']?>">View / Reply</a></td>
                      </tr>
                    <?php }?>
                    </tbody>
                </table>
              </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"onclick="modelHide()">Close</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            
            

         <!--  <hr style="color: black; background: black; height: 3px;">
          <div class="panel panel-inverse"> 
            <div class="panel-heading">
              <h4 class="panel-title">Total Ticket List</h4>
            </div> 
            <div class="panel-body">
              <div class="row">
                <div class=".col-md-4">
                  
                  
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Taluka -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Branch -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Zone -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <button class="button">Search</button>
                </div>
              </div>
              <br>
              
              <div class="table-responsive">
                <table id="table_pagination" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="1%">Sr. No.</th>
                      <th class="text-nowrap">Ticket</th>
                      <th class="text-nowrap">Agent</th>
                      <th class="text-nowrap">Branch</th>
                      <th class="text-nowrap">Taluka</th>
                      <th class="text-nowrap">Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-warning btn-xs btn-block" href="#">
                        On-hold               </a>
                      </td> 
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-success btn-xs btn-block" href="#">
                        Inprogress                </a>
                      </td> 
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-danger btn-xs btn-block" href="#">
                        Closed                </a>
                      </td>
                      
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-primary btn-xs btn-block" href="#">
                        New               </a>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> 
          </div>  -->
<script>
  function modelHide() {
  
    $('#exampleModal').hide();
    // body...
  }
</script>