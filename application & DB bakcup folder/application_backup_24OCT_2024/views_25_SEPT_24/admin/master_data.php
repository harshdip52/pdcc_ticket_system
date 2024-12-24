 
        <div class="sidebar-bg hide_in_print"></div>
        <div id="content" class="content">
          <!-- begin breadcrumb -->
          <ol class="breadcrumb pull-right">
             <li class="breadcrumb-item"><a href="<?php echo base_url()?>/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Master Data Dashboard</li>
          </ol>
          <!-- end breadcrumb -->
          <!-- begin page-header -->
          <h1 class="page-header">Master Data Dashboard</h1>
          <!-- end page-header -->
          
          <!-- begin row -->
          <div class="row">
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Taluka</h4>
                  <h4><?=$totalTq['totalTq']?></h4>
                  
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_taluka">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Zone</h4>
                  <h4><?=$totalZone['totalZone']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_zone">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Branch</h4>
                  <h4><?=$totalBr['totalBr']?></h4>
                </div>
                
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_branch">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon"><i class="fa fa-book"></i></div>
                <div class="stats-info">
                  <h4>Add Brand</h4>
                  <h4><?=$totalBrnd['totalBrnd']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_brand">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Category</h4>
                  <h4><?=$totalCat['totalCat']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_category">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Sub Category</h4>
                  <h4><?=$totalSubCat['totalSubCat']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_sub_category">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Add Role</h4>
                  <h4><?=$totalRole['totalRole']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>admin/master_role">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
           <!-- <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Modules List</h4>
                  <h4><?=$totalRole['totalRole']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>ModuleController">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Assign Permission</h4>
                  <h4><?=$totalRole['totalRole']?></h4>
                </div>
                <div class="stats-link">
                  <a href="<?php echo base_url()?>assignPermission">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>  -->
          </div>
          
       