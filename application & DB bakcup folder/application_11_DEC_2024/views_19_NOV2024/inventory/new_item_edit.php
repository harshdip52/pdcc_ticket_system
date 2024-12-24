   <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right"> 
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory"> Inventory Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>Inventory/assign_inventory"> Inventory List</a></li>
      <li class="breadcrumb-item active">Edit Inventory </li>
    </ol>
    <h1 class="page-header">Edit Inventory</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Inventory</h4>
      </div>
      <form method="post" action="<?=base_url()?>Inventory/new_item_edit/<?=$AllInventory['inventory_id']?>" id="new_item_edit">
        <input type="hidden" name="inventory_id" value="<?=$AllInventory['inventory_id']?>">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="cat_id" name="cat_id" onchange="getSubCategory(this.value)"> 
              <?php foreach ($getAllCategory as $key => $Category) {?>
                <option value="<?=$Category['cat_id']?>"
                <?php if ($AllInventory['cat_id'] == $Category['cat_id'])  echo 'selected = "selected"'; ?>><?=$Category['cat_name']?></option> 
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4">
            <label>Sub-Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id"> 
            </select>
          </div>
          
          <div class="col-md-4">
            <label>Brand<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="brand_id" id="brand_id">
              <option selected>--select Brand--</option>
              <?php foreach ($getAllBrand as $key => $Brand) {?>

                <option value="<?=$Brand['brand_id']?>"
                <?php if ($AllInventory['brand_id'] == $Brand['brand_id'])  echo 'selected = "selected"'; ?>><?=$Brand['brand_name']?></option> 
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Item / Model Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['item_name']?>" name="item_name" id="item_name">
          </div>
          
          
          <div class="col-md-4 input-padd">
            <label>Serial No.<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" value="<?=$AllInventory['serial_no']?>" name="serial_no" id="serial_no">
          </div>
          <div class="col-md-4 input-padd">
            <label>IP Address</label>
            <input class="form-control" type="text" value="<?=$AllInventory['ip_address']?>" name="ip_address" id="ip_address">
          </div>
          <div class="col-md-4 input-padd">
            <label>PO Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="po_date" id="po_date" value="<?=$AllInventory['po_date']?>">
          </div>
          <div class="col-md-4 input-padd">
            <label>PO No</label>
            <input class="form-control" type="text" name="po_no" id="po_no" value="<?=$AllInventory['po_no']?>">
          </div>

          <div class="col-md-4 input-padd">
            <label>Select Supplier<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="user_id" id="user_id">
              <option selected>--select Supplier--</option>
              <?php foreach ($getUser as $key => $usera) {?>

                <option value="<?=$usera['user_id']?>"
                <?php if ($AllInventory['user_id'] == $usera['user_id'])  echo 'selected = "selected"'; ?>>
                <?=$usera['name']?></option> 
              <?php }?> 
            </select>
          </div>

           
          <div class="col-md-4 input-padd form-group">
            <label>Warranty Period (in months) <sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="warranty_period" id="warranty_period"value="<?=$AllInventory['warranty_period']?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
          </div>

          

          <div class="col-md-4 input-padd">
            <label>Make Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="make_date" value="<?=$AllInventory['make_date']?>" id="make_date">
          </div>
          <div class="col-md-4 input-padd">
            <label>Optional 1</label>
            <input class="form-control" value="<?=$AllInventory['optional_1']?>" type="text" name="optional_1" id="optional_1">
          </div>
          <div class="col-md-4 input-padd">
            <label>Optional 2</label>
            <input class="form-control" type="text" value="<?=$AllInventory['optional_2']?>" name="optional_2" id="optional_2">
          </div>
           
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
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
<script type="text/javascript">
  $('#btnsubmitdata').click(function(e) 
  {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;
    var item_name = $("#item_name").val();
    if (item_name == "" || item_name== null) 
    {
      if ($("#item_name").next(".validation").length == 0) // only add if not added
      {
        $("#item_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#item_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#item_name").next(".validation").remove(); // remove it
    }

    var brand_id = $("#brand_id").val();
    if (brand_id == "" || brand_id== null) 
    {
      if ($("#brand_id").next(".validation").length == 0) // only add if not added
      {
        $("#brand_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#brand_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#brand_id").next(".validation").remove(); // remove it
    }

    var cat_id = $("#cat_id").val();
    if (cat_id == "" || cat_id== null) 
    {
      if ($("#cat_id").next(".validation").length == 0) // only add if not added
      {
        $("#cat_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#cat_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#cat_id").next(".validation").remove(); // remove it
    }
     var sub_cat_id = $("#sub_cat_id").val();
    if (sub_cat_id == "" || sub_cat_id== null) 
    {
      if ($("#sub_cat_id").next(".validation").length == 0) // only add if not added
      {
        $("#sub_cat_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#sub_cat_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#sub_cat_id").next(".validation").remove(); // remove it
    }

     var serial_no = $("#serial_no").val();
    if (serial_no == "" || serial_no== null) 
    {
      if ($("#serial_no").next(".validation").length == 0) // only add if not added
      {
        $("#serial_no").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#serial_no").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#serial_no").next(".validation").remove(); // remove it
    }

    var po_date = $("#po_date").val();
    if (po_date == "" || po_date== null) 
    {
      if ($("#po_date").next(".validation").length == 0) // only add if not added
      {
        $("#po_date").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#po_date").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#po_date").next(".validation").remove(); // remove it
    }

    var po_no = $("#po_no").val();
    if (po_no == "" || po_no== null) 
    {
      if ($("#po_no").next(".validation").length == 0) // only add if not added
      {
        $("#po_no").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#po_no").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#po_no").next(".validation").remove(); // remove it
    }

    var user_id = $("#user_id").val();
    if (user_id == "" || user_id== null) 
    {
      if ($("#user_id").next(".validation").length == 0) // only add if not added
      {
        $("#user_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#user_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#user_id").next(".validation").remove(); // remove it
    }

    var warranty_period = $("#warranty_period").val();
    if (warranty_period == "" || warranty_period== null) 
    {
      if ($("#warranty_period").next(".validation").length == 0) // only add if not added
      {
        $("#warranty_period").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#warranty_period").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#warranty_period").next(".validation").remove(); // remove it
    }


     var make_date = $("#make_date").val();
    if (make_date == "" || make_date== null) 
    {
      if ($("#make_date").next(".validation").length == 0) // only add if not added
      {
        $("#make_date").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#make_date").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#make_date").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#new_item_edit').submit();
    } 
    else 
    {
      return false;
    }
  });
</script>