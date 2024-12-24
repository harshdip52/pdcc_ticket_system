 
  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
      <!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
  
          <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Dashboard</h1>
      <!-- end page-header -->
  
      <!-- begin row -->
      <div class="row">
          <!-- begin col-3 -->
          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                  <div class="stats-icon"> <i class="fa fa-user"></i></div>
                  <div class="stats-info">
                      <h4>New Item</h4>
  
                  </div>
                  <div class="stats-link">
                      <a href="<?=base_url();?>Inventory/new_item_list">Click Here<i class="fa fa-arrow-alt-circle-right"></i></a>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                  <div class="stats-icon"><i class="fa fa-edit"></i></div>
                  <div class="stats-info">
                      <h4>Stock List</h4>
                  </div> 
                  <div class="stats-link">
                      <a href="<?=base_url();?>Inventory/new_itemList_view">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-warning">
                  <div class="stats-icon"><i class="fa fa-edit"></i></div>
                  <div class="stats-info">
                      <h4>Dead Stock  List</h4>
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
   