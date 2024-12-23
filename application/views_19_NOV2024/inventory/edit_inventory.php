<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory"> Inventory Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory/assign_inventory"> Inventory List</a></li>
    <li class="breadcrumb-item active">Inventory Details</li>
  </ol>
  <h1 class="page-header">Edit Inventory</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Edit Inventory</h4>
    </div>
    <!-- <form method="post" action="<?= base_url() ?>Inventory/edit_inventory" id="edit_inventory"> -->
      <button?php 
      // printData($AllInventory);
      // die;
      ?>
    <form method="post"  id="edit_inventory">
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="cat_id" id="cat_id" value="<?php echo ($AllInventory['cat_id']); ?>">
      <input type="hidden" name="sub_cat_id" id="sub_cat_id" value="<?php echo ($AllInventory['sub_cat_id']); ?>">
      <div class="panel-body">
        <div class="row">

          <?php if ($AllInventory['taluka_name']) { ?>
            <div class="col-sm-4 input-padd">
              <label>Taluka :- </label>
              <?php echo ($AllInventory['taluka_name']); ?>
            </div>
          <?php } ?>

          <?php if ($AllInventory['zone_name']) { ?>
            <div class="col-sm-4 input-padd">
              <label>Zone :- </label>
              <?php echo ($AllInventory['zone_name']); ?>
            </div>
          <?php } ?>

          <?php if ($AllInventory['branch_name']) { ?>
            <div class="col-sm-4 input-padd">
              <label>Branch :- </label>
              <?php echo ($AllInventory['branch_name']); ?>
            </div>
          <?php } ?>

          <?php if ($AllInventory['cat_name']) { ?>
            <div class="col-sm-4 input-padd">
              <label>Category :- </label>
              <?php echo ($AllInventory['cat_name']); ?>
            </div>
          <?php } ?>

          <?php if ($AllInventory['sub_cat_name']) { ?>
            <div class="col-sm-4 input-padd">
              <label>Sub Category :- </label>
              <?php echo ($AllInventory['sub_cat_name']); ?>
            </div>
          <?php } ?><br><br><br>

          <div class="panel-heading" style="background-color: #0e6d8c;">
            <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
          </div>



          <div class="col-md-4 input-padd" id="brand_div">
            <label>Brand<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="brand_id" id="brand_id">
              <option selected value="" disabled="">--select Brand--</option>
              <?php foreach ($getAllBrand as $key => $Brand) { ?>
                <option value="<?= $Brand['brand_id'] ?>"><?= $Brand['brand_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4 input-padd" id="item_div">
            <label>Item / Model Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="item" name="item">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="atm_id_div">
            <label>ATM Id<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="atm_id" id="atm_id">
          </div>




          <div class="col-md-4 input-padd" id="serial_div">
            <label>Serial No.<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="serial_no" id="serial_no">
          </div>

          <div class="col-md-4 input-padd" id="ups_capacity_div">
            <label>UPS Capacity in KVA<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="ups_capacity" id="ups_capacity">
          </div>

          <div class="col-md-4 input-padd" id="no_of_batteries_div">
            <label>No Of Batteries<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="no_of_batteries" id="no_of_batteries">
          </div>


          <div class="col-md-4 input-padd" id="indoor_camera_div">
            <label>No of Indoor Camera<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="indoor_camera" id="indoor_camera">
          </div>

          <div class="col-md-4 input-padd" id="outdoor_camera_div">
            <label>No of Outdoor Camera<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="outdoor_camera" id="outdoor_camera">
          </div>

          <div class="col-md-4 input-padd" id="total_camera_div">
            <label>Total of Cammera<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="total_camera" id="total_camera">
          </div>





          <div class="col-md-4 input-padd" id="backup_div">
            <label>Backup Connectivity <sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="backup_connectivity" id="backup_connectivity">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="VPN">VPN</option>
              <option value="Broadband">Broadband</option>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="network_rack_div">
            <label>Network Rack <sup class="text-danger">*</sup></label>

            <select class="form-select from-font" name="network_rack" id="network_rack">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="network_card_div">
            <label>Network Card<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="network_card" id="network_card">
          </div>

          <div class="col-md-4 input-padd" id="ip_address_div">
            <label>IP Address</label>
            <input class="form-control" type="text" name="ip_address" id="ip_address">
          </div>

          <div class="col-md-4 input-padd" id="atm_grounting_div">
            <label>ATM Grounting :- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select class="form-select from-font" name="atm_grounting" id="atm_grounting">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="atm_switch_div">
            <label>ATM Switch & N/W Board </label>
            <select class="form-select from-font" name="atm_switch" id="atm_switch">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="Coverd by box">Coverd by box</option>
              <option value="In Back Room">In Back Room</option>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="atm_cctv_div">
            <label>CCTV NVR</label>
            <select class="form-select from-font" name="atm_cctv" id="atm_cctv">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="atm_side_div">
            <label>Side</label>
            <select class="form-select from-font" name="atm_side" id="atm_side">
              <option disabled="" selected="" value=""> -- Select--</option>
              <option value="Onside">Onside</option>
              <option value="OffSide">OffSide</option>
            </select>
          </div>


          <div class="col-md-4 input-padd" id="po_date_div">
            <label>PO Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="po_date" id="po_date">
          </div>
          <div class="col-md-4 input-padd" id="po_no_div">
            <label>PO No</label>
            <input class="form-control" type="text" name="po_no" id="po_no">
          </div>

          <div class="col-md-4 input-padd" id="supplier_div">
            <label>Supplier Name<sup class="text-danger">*</sup></label>
            <!-- <input class="form-control" type="text" name="supplier" id="supplier"> -->
            <select class="form-select from-font" name="supplier" id="supplier">

            </select>
          </div>
          <div class="col-md-4 input-padd" id="warranty_div">
            <label>Warranty Period(in Months) <sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="warranty" id="warranty" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
          </div>
          <div class="col-md-4 input-padd" id="make_date_div">
            <label>Receive / Make Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="make_date" id="make_date">
          </div>

          <div class="col-md-4 input-padd" id="os_div">
            <label>Operating System<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="os" id="os">
          </div>

          <div class="col-md-4 input-padd" id="install_date_div">
            <label>Installation Date<sup class="text-danger">*</sup></label>
            <input class="form-control" type="date" name="install_date" id="install_date">
          </div>

          <div class="col-md-4 input-padd">
            <label>Optional 1</label>
            <input class="form-control" type="text" name="op_1" id="op_1">
          </div>
          <div class="col-md-4 input-padd">
            <label>Optional 2</label>
            <input class="form-control" type="text" name="op_2" id="op_2">
          </div>

        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <button class="btn btn-success btn-sm text-white"  id="btnsubmitdata">Submit</button>
          <a href="<?= base_url(); ?>Inventory" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function changeDiv(subcat) {
    if (subcat == 1 || subcat == 24) {
      $("#os_div").show();


      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();

      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();



    } else if (subcat == 2) {
      $("#os_div").hide();


      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();

      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();



    } else if (subcat == 3) {
      $("#os_div").hide();


      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();

      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();

    } else if (subcat == 4) {
      $("#os_div").hide();


      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();

      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();

    } else if (subcat == 5) {
      $("#os_div").hide();


      $("#serial_div").show();
      $("#ip_address_div").hide();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#ups_capacity_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();

    } else if (subcat == 6) {
      // battry
      $("#os_div").hide();
      $("#serial_div").hide();
      $("#ip_address_div").hide();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#ups_capacity_div").hide();

      $("#no_of_batteries_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();

      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();

    } else if (subcat == 7) {
      // cctv 
      $("#os_div").hide();
      $("#serial_div").hide();
      $("#ip_address_div").hide();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#ups_capacity_div").hide();

      $("#no_of_batteries_div").hide();


      $("#indoor_camera_div").show();
      $("#outdoor_camera_div").show();
      $("#total_camera_div").show();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();

    } else if (subcat == 8) {

      // Keyboard
      $("#os_div").hide();
      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#ups_capacity_div").hide();

      $("#no_of_batteries_div").hide();


      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();;

    }
    // Mouse
    else if (subcat == 9) {
      $("#os_div").hide();
      $("#serial_div").show();
      $("#ip_address_div").show();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();

      $("#ups_capacity_div").hide();

      $("#no_of_batteries_div").hide();


      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();;

    } else if (subcat == 13) {
      $("#os_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#serial_div").show();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").show();
      $("#network_card_div").show();
      $("#network_rack_div").show();
      $("#ip_address_div").hide();
      $("#po_date_div").hide();
      $("#po_no_div").hide();
      $("#supplier_div").show();
      $("#warranty_div").hide();
      $("#make_date_div").hide();
      $("#install_date_div").show();

    } else if (subcat == 14) {
      $("#os_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#serial_div").show();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").show();
      $("#network_card_div").show();
      $("#network_rack_div").show();
      $("#ip_address_div").hide();
      $("#po_date_div").hide();
      $("#po_no_div").hide();
      $("#supplier_div").show();
      $("#warranty_div").hide();
      $("#make_date_div").hide();
      $("#install_date_div").show();


    } else if (subcat == 15) {
      $("#os_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#serial_div").show();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").show();
      $("#network_card_div").show();
      $("#network_rack_div").show();
      $("#ip_address_div").hide();
      $("#po_date_div").hide();
      $("#po_no_div").hide();
      $("#supplier_div").show();
      $("#warranty_div").hide();
      $("#make_date_div").hide();
      $("#install_date_div").show();

    } else if (subcat == 16) {
      $("#os_div").hide();


      $("#atm_id_div").show();
      $("#atm_grounting_div").show();
      $("#atm_switch_div").show();
      $("#atm_cctv_div").show();
      $("#atm_side_div").show();
      $("#serial_div").show();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();
      $("#ip_address_div").show();
      $("#po_date_div").hide();
      $("#po_no_div").hide();
      $("#supplier_div").show();
      $("#warranty_div").hide();
      $("#make_date_div").hide();
      $("#install_date_div").show();

    } else {
      $("#os_div").hide();

      $("#atm_id_div").hide();
      $("#atm_grounting_div").hide();
      $("#atm_switch_div").hide();
      $("#atm_cctv_div").hide();
      $("#atm_side_div").hide();
      $("#serial_div").hide();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      $("#indoor_camera_div").hide();
      $("#outdoor_camera_div").hide();
      $("#total_camera_div").hide();
      $("#backup_div").hide();
      $("#network_card_div").hide();
      $("#network_rack_div").hide();
      $("#ip_address_div").hide();
      $("#po_date_div").hide();
      $("#po_no_div").hide();
      $("#supplier_div").hide();
      $("#warranty_div").hide();
      $("#make_date_div").hide();
      $("#install_date_div").hide();

    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    getVendors();

    var subcat = "<?php echo  $AllInventory['sub_cat_id'] ?>";
    var id = "<?php echo  $AllInventory['id'] ?>";
    onEdit(id)
    changeDiv(subcat)
    getItem(subcat)

  });
</script>
<script>
  function onEdit(id) {


    $.getJSON("<?php echo base_url(); ?>Inventory/getInventoryByIds/" + id, function(data) {
        $("#os").val(data.os);


        $("#atm_id").val(data.atm_id);
        $("#atm_grounting").val(data.atm_grounting);
        $("#atm_switch").val(data.atm_switch);
        $("#atm_cctv").val(data.atm_cctv);
        $("#atm_side").val(data.atm_side);
        $("#serial_no").val(data.serial_no);
        $("#ups_capacity").val(data.ups_capacity);
        $("#no_of_batteries").val(data.no_of_batteries);
        $("#indoor_camera").val(data.indoor_camera);
        $("#outdoor_camera").val(data.outdoor_camera);
        $("#total_camera").val(data.total_camera);
        $("#backup_connectivity").val(data.backup_connectivity);
        $("#network_card").val(data.network_card);
        $("#network_rack").val(data.network_rack);
        $("#ip_address").val(data.ip_address);
        $("#po_date").val(data.po_date);
        $("#po_no").val(data.po_no);
        $("#warranty").val(data.warranty);
        $("#make_date").val(data.make_date);
        $("#install_date").val(data.install_date);
        $("#op_1").val(data.op_1);
        $("#op_2").val(data.op_2);
        $("#id").val(data.id);

        setTimeout(function() {
          $('#item').val(data.item);
        }, 500);

        setTimeout(function() {
          $('#brand_id').val(data.brand_id);
        }, 500);

        setTimeout(function() {
          $('#supplier').val(data.supplier);
        }, 500);


      }

    );

  }
</script>


<script>
  function getBranch(taluka_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjax/" + taluka_id, function(data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
      });
      $("#branch_id").html(stringToAppend);
    });
  }

  function getZone(branch_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/" + branch_id, function(data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend);
    });
  }

  function getSubCategory(cat_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getSubCategoryAjax/" + cat_id, function(data) {
      var stringToAppend = "<option disabled selected value=''> -- Select Sub Category -- </option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
      });
      $("#sub_cat_id").html(stringToAppend);
    });
  }

  function getItem(sub_cat_id) {
    $.getJSON("<?php echo base_url(); ?>Inventory/getItemBySubCat/" + sub_cat_id, function(data) {
      var stringToAppend = "<option disabled selected value=''> -- Select Item -- </option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.id + "'>" + val.item_name + "</option>";
      });
      $("#item").html(stringToAppend);
    });
  }

  function getVendors() {
    $.getJSON("<?php echo base_url(); ?>Ajax/getVendors", function(data) {
      var stringToAppend = "<option disabled selected value=''> -- Select Suppliers -- </option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.user_id + "'>" + val.name + "</option>";
      });
      $("#supplier").html(stringToAppend);
    });
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
   
    $("#serial_no").on('change paste focusout', function() {
    var serial_no = $("#serial_no").val();
    var sub_cat_id = $("#sub_cat_id").val();

    if(serial_no != '' || serial_no != null) {
      var serialNoValidationCheckSubIdArr = ['1', '2', '3', '4', '24'];
     // if (jQuery.inArray(sub_cat_id, serialNoValidationCheckSubIdArr) != -1) {
        $.ajax({
          url: "<?= base_url() ?>Inventory/chechDuplicateSerial",
          type: "post",
          dataType: 'json',
          data: {
            serial_no: btoa(serial_no)
          },
          success: function(result) {
            if (Object.entries(result).length > 0) {              
              $("#serial_no_err").html("Duplicate Serial No Found In Inventory");
              swal("Error", "Duplicate Serial No Found In Inventory", "error");
              $("#btnsubmitdata").prop('disabled', true);
              return false;
            } else {
              $("#btnsubmitdata").prop('disabled', false);
            }
          }
        });
      //}
    }
  });
  });
  // $('#btnsubmitdata').click(function(e) {
  //   e.preventDefault();
  //   var focusSet = false;
  //   var allfields = true;

  //   if (allfields) {
  //     $('#edit_inventory').submit();
  //   } else {
  //     return false;
  //   }
  // });

  $("#btnsubmitdata").on("click", function(e) {
    e.preventDefault();
    var cat_id = $("#cat_id").val();
    var sub_cat_id = $("#sub_cat_id").val();
    var brand_id = $("#brand_id").val();
    var item = $("#item").val();
    var ip_address_new = $("#ip_address").val();
    var serial_no = $("#serial_no").val();

    var errorArray = {};

    if (cat_id == "" || cat_id == null) {
      swal("Error", "Please select Category", "error");      
      return;
    }
    if (sub_cat_id == "" || sub_cat_id == null) {
      swal("Error", "Please select SubCategory", "error");
      return;
    }
    var redirectUrl = "<?php echo base_url() ?>Inventory/new_itemList_view";
    if (cat_id != '' && sub_cat_id != '') {
      $.ajax({
        url: "<?= base_url() ?>Inventory/edit_inventory",
        type: "post",
        dataType: 'json',
        data: $('#edit_inventory').serialize(),
        success: function(result) {        
          if (result.status) {        
            swal({
              title: "Success",
              text: result.message,
              type: "success"
            }).then(function() {
              setTimeout(function() {                
                window.location.replace(redirectUrl);
              }, 2000);
            });
          } else {
            swal("Error", result.message, "error");
            return false;
          }
        }
      });
    } else {
      swal("Error", "Please check input", "Error");
      return false;
    }
  });
</script>