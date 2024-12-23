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
    <h1 class="page-header">Add New Item</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Total Ticket List</h4>
      </div>
      <form method="post" action="<?=base_url()?>Inventory/new_item_edit/<?=$AllInventory['inventory_id']?>">
        <input type="hidden" name="inventory_id" value="<?=$AllInventory['inventory_id']?>">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 input-padd">
            <label>Taluka<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" onchange="getBranch(this.value)" name="taluka_id" id="taluka_id">
              <?php foreach ($AllTaluka as $key => $Taluka) {?>
                <option value="<?=$Taluka['taluka_id']?>"
                <?php if ($AllInventory['taluka_id'] == $Taluka['taluka_id'])  echo 'selected = "selected"'; ?>><?=$Taluka['taluka_name']?></option>
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Branch<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="branch_id" name="branch_id" onchange="getZone(this.value)">
              <option value="">Select</option>
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Zone<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="zone_id" id="zone_id">
            </select>
          </div>
          <div class="col-md-4">
            <label>Item Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['item_name']?>" name="item_name" id="item_name">
          </div>
          <div class="col-md-4">
            <label>Brand<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="brand_id" id="brand_id">
              <option selected>--select Brand--</option>
              <?php foreach ($getAllBrand as $key => $Brand) {?>

                <option value="<?=$Brand['brand_id']?>"
                <?php if ($AllInventory['brand_id'] == $Brand['brand_id'])  echo 'selected = "selected"'; ?>><?=$Brand['brand']?></option> 
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4">
            <label>Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="cat_id" name="cat_id" onchange="getSubCategory(this.value)"> 
              <?php foreach ($getAllCategory as $key => $Category) {?>
                <option value="<?=$Category['cat_id']?>"
                <?php if ($AllInventory['cat_id'] == $Category['cat_id'])  echo 'selected = "selected"'; ?>><?=$Category['cat_name']?></option> 
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Sub-Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id"> 
            </select>
          </div>
          
          
          
          <div class="col-md-4 input-padd">
            <label>Serial No.<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['serial_no']?>" name="serial_no" id="serial_no">
          </div>
          <div class="col-md-4 input-padd">
            <label>IP Address<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['ip_address']?>" name="ip_address" id="ip_address">
          </div>
          <div class="col-md-4 input-padd">
            <label>Make Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="make_date" value="<?=$AllInventory['make_date']?>" id="make_date">
          </div>
          <div class="col-md-4 input-padd">
            <label>Optional 1<sup class="text-danger">*</sup></label>
            <input class="form-control" value="<?=$AllInventory['optional_1']?>" type="text" name="optional_1" id="optional_1">
          </div>
          <div class="col-md-4 input-padd">
            <label>Optional 2<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['optional_2']?>" name="optional_2" id="optional_2">
          </div>
           
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <!-- <a id="submit_pop" class="btn btn-sm btn-success">Submit</a> -->
          <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >
          <a href="#" class="btn btn-sm btn-warning">Reset</a>
          <a href="<?=base_url();?>Inventory" class="btn btn-sm btn-danger">Cancel</a>
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
      var stringToAppend = "<option disabled selected value=''> -- Select Sub Category -- </option>";
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
      var stringToAppend = "<option value=''> -- Select Sub Category -- </option>";
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

    $(document).ready(function () { 
      var taluka_id= $('#taluka_id :selected').val();
      getBranch1(taluka_id)
      setTimeout(function()
      {
        $('#branc_id').val(data.branc_id);
      }, 500);
      setTimeout(function()
      {
        var branch_id= $('#branch_id :selected').val(); 
        getZone1(branch_id)
        $('#zone_id').val(data.zone_id);
      }, 700);

      setTimeout(function()
      {
        var cat_id= $('#cat_id :selected').val(); 
        getSubCategory1(cat_id)
        $('#sub_cat_id').val(data.sub_cat_id);
      }, 700);

    });

     function getBranch1(taluka_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getBranchAjax/"+taluka_id, function (data) {
      var stringToAppend = "";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
      });
      $("#branch_id").html(stringToAppend); 
    });
    }

    function getZone1(branch_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+branch_id, function (data) {
      var stringToAppend = "";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend); 
    });
    }
    function getSubCategory1(cat_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getSubCategoryAjax/"+cat_id, function (data) {
      var stringToAppend = "";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
      });
      $("#sub_cat_id").html(stringToAppend); 
    });
    }
</script>