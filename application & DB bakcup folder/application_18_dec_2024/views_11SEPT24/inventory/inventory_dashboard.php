 
  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
      <!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>/admin">Dashboard</a></li>
        <li class="breadcrumb-item active">Inventory Dashboard</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Dashboard</h1>
      <!-- end page-header -->
  
      <!-- begin row -->
      <div class="row">
        <?php $login_role = $this->session->userdata('login_role'); ?>
          <!-- begin col-3 -->
           <?php if($login_role!=8) {?>
          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                  <div class="stats-icon"> <i class="fa fa-user"></i></div>
                  <div class="stats-info">
                      <h4>inventory item / model</h4>
                    </div>
                  <div class="stats-link">
                      <a href="<?=base_url();?>Inventory/inventory_item">Click Here<i class="fa fa-arrow-alt-circle-right"></i></a>
                  </div>
              </div>
          </div>
       
          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                  <div class="stats-icon"> <i class="fa fa-user"></i></div>
                  <div class="stats-info">
                      <h4>Add / Assign Inventory</h4>
                    </div>
                  <div class="stats-link">
                      <a href="<?=base_url();?>Inventory/assign_inventory">Click Here<i class="fa fa-arrow-alt-circle-right"></i></a>
                  </div>
              </div>
          </div>
           <?php }?>
          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                  <div class="stats-icon"><i class="fa fa-edit"></i></div>
                  <div class="stats-info">
                      <h4>Assigned Inventory List</h4>
                  </div> 
                  <div class="stats-link">
                    <!-- Removing this condition as discuss with Vishal PDCC Bcoz They Want Show All Branches TO IT Manager -->
                    <?php #if($login_role!=8) {?>
                      <a href="<?=base_url();?>Inventory/new_itemList_view">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                    <?php #} else  {?> 
                    <!-- <a href="<?=base_url();?>Inventory/inventory_list">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a> -->
                    <?php #}?>

                    <!-- <?php #if($login_role!=8) {?>
                      <a href="<?=base_url();?>Inventory/new_itemList_view">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                    <?php #} else  {?> 
                     <a href="<?=base_url();?>Inventory/inventory_list">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a> 
                    <?php #}?> -->
                    
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-warning">
                  <div class="stats-icon"><i class="fa fa-edit"></i></div>
                  <div class="stats-info">
                      <h4>Dead Inventory  List</h4>
                  </div> 
                  <div class="stats-link">
                      <a href="<?=base_url();?>Inventory/dead_stock_list">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                  </div>
              </div>
          </div>
           <!-- end col-3 -->
  
      </div>
      <!-- end row -->
  
  </div>
   