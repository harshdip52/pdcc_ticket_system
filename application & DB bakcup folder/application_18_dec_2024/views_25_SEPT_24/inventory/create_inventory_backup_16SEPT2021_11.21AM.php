<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory"> Inventory Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory/assign_inventory"> Inventory List</a></li>
    <li class="breadcrumb-item active">Inventory Details</li>
  </ol>
  <h1 class="page-header">Add Inventory</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Add Inventory</h4>
    </div>
    <form method="post" action="<?= base_url() ?>Inventory/create_inventory" id="create_inventory">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-4">
            <label>Taluka </label>
            <select class="form-select from-font" onchange="getZone(this.value)" required="" name="taluka_id" id="taluka_id">
              <option selected disabled="" value="">--select Taluka--</option>
              <?php
              if (count($AllTaluka) == count($AllTaluka, COUNT_RECURSIVE)) {
                foreach ($AllTaluka as $key => $Taluka) { ?>
                  <option value="<?= $key; ?>"><?= $Taluka; ?></option>
                <?php }
              } else {
                foreach ($AllTaluka as $key => $Taluka) { ?>
                  <option value="<?= $Taluka['taluka_id'] ?>"><?= $Taluka['taluka_name'] ?></option>
              <?php }
              } ?>
            </select>
          </div>

          <div class="col-sm-4" id="user_id_div">
            <label>Zone </label>
            <select class="form-select from-font" required="" name="zone_id" id="zone_id" onchange="getBranch(this.value)">
            </select>
          </div>

          <div class="col-sm-4" id="user_id_div">
            <label>Branch </label>
            <select class="form-select from-font" id="branch_id" name="branch_id" required="">
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="cat_id" name="cat_id" onchange="getSubCategory(this.value)">
              <option selected value="" disabled="">--select Category--</option>
              <?php foreach ($getAllCategory as $key => $Category) { ?>
                <option value="<?= $Category['cat_id'] ?>"><?= $Category['cat_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Sub-Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id" onchange="changeDiv(this.value);getItem(this.value)">
            </select>
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
            <!-- <input class="form-control" type="text" name="item" id="item"> -->
            <select class="form-select from-font" id="item" name="item">
            </select>
          </div>
          <div class="col-md-4 input-padd" id="atm_id_div">
            <label>ATM Id<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="atm_id" id="atm_id">
          </div>

          <div class="col-md-4 input-padd" id="serial_div">
            <label>Serial No.</label>
            <input class="form-control" type="text" name="serial_no" id="serial_no">
            <div class="text-danger " id="serial_no_err" style="font-weight:bold;"></div>
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
            <label>PO Date</label>
            <input class="form-control" type="date" name="po_date" id="po_date">
          </div>
          <div class="col-md-4 input-padd" id="po_no_div">
            <label>PO No</label>
            <input class="form-control" type="text" name="po_no" id="po_no">
          </div>
          <div class="col-md-4 input-padd" id="supplier_div">
            <label>Supplier Name</label>
            <!-- <input class="form-control" type="text" name="supplier" id="supplier"> -->
            <select class="form-select from-font" name="supplier" id="supplier">

            </select>
          </div>
          <div class="col-md-4 input-padd" id="warranty_div">
            <label>Warranty Period(in Months) </label>
            <input class="form-control" type="text" name="warranty" id="warranty" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
          </div>
          <div class="col-md-4 input-padd" id="make_date_div">
            <label>Receive / Make Date</label>
            <input class="form-control" type="date" name="make_date" id="make_date">
          </div>


          <div class="col-md-4 input-padd" id="os_div">
            <label>Operating System<sup class="text-danger">*</sup></label>
            <select class="form-control" name="os" id="os">
              <option value="" disabled selected>Select your OS</option>
              <option value="Windows 7">Windows 7</option>
              <option value="Windows 8">Windows 8</option>
              <option value="Windows 10">Windows 10</option>
              <option value="Windows 11">Windows 11</option>

            </select>
          </div>
          <div class="col-md-4 input-padd" id="install_date_div">
            <label>Installation Date</label>
            <input class="form-control" type="date" name="install_date" id="install_date">
          </div>

          <div class="col-md-4 input-padd" id="indoor_outdoot_option">
            <label>Indoor/Outdoor</label>
            <select class="form-control indoor_outdoot_option" id="indoor_outdoot_option" name="indoor_outdoot_option">
              <option value="">Select Indoor/Outdoor</option>
              <option value="0">Indoor</option>
              <option value="1">Outdoor</option>
            </select>
          </div>
          <div class="col-md-4 input-padd" id="department_div">
            <label>Department / User</label>
            <input class="form-control" type="text" name="department" id="department">
          </div>

          <div class="col-md-4 input-padd" id="hdd_ram_size_div">
            <label>Size Of HDD / Ram</label>
            <input class="form-control" type="text" name="hdd_ram_size" id="hdd_ram_size">
          </div>

          <div class="col-md-4 input-padd" id="cpu_item_model_name">
            <label>CPU Item Model Name</label>
            <select class="form-control cpu_item_model_name_input" id="cpu_item_model_name_input" name="cpu_item_model_name_input">
              <option value="">CPU Item Model Name</option>
              <?php foreach ($getItemNamesList as $key => $ItemNames): ?>
                <option value="<?php echo $ItemNames['id']; ?>"><?php echo $ItemNames['item_name']; ?></option>
              <?php endforeach; ?>
            </select>

          </div>
          <div class="col-md-4 input-padd" id="cpu_serial_no">
            <label>CPU Serial No</label>
            <select class="form-control cpu_serial_no_input" id="cpu_serial_no_input" name="cpu_serial_no_input">
              <option value="">CPU Serial No</option>
              <?php foreach ($getCPUSerialNoList as $key => $value): ?>
                <option value="<?php echo $value['serial_no']; ?>"><?php echo $value['serial_no']; ?></option>
              <?php endforeach; ?>
            </select>
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
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();



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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();



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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

    } else if (subcat == 7) {
      // cctv 

      // recently we hide these input fields indoor_camera_div, outdoor_camera_div ,total_camera_div and serial_div -> show

      $("#os_div").hide();
      // $("#serial_div").hide();
      $("#serial_div").show();
      $("#ip_address_div").hide();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").show();
      $("#make_date_div").show();
      $("#install_date_div").show();
      $("#ups_capacity_div").hide();
      $("#no_of_batteries_div").hide();
      // $("#indoor_camera_div").show();
      // $("#outdoor_camera_div").show();
      // $("#total_camera_div").show();
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
      $("#network_rack_div").hide();
      $("#indoor_outdoot_option").show();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();


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
      $("#network_rack_div").hide();
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#network_rack_div").hide();
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

    } else if (subcat == 12) {
      $("#department_div").show();
      $("#brand_div").show();
      $("#item_div").show();

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
      $("#indoor_outdoot_option").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();


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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

    } else if (subcat == 16) {
      $("#os_div").hide();
      // recently make changes with po_date_div , po_no_div,make_date_div for show these input fields 

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
      // $("#po_date_div").hide();
      // $("#po_no_div").hide();
      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();
      $("#warranty_div").hide();
      // $("#make_date_div").hide();
      $("#make_date_div").show();
      $("#install_date_div").show();
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();


    } else if (subcat == 25 || subcat == 26) {

      $("#brand_div").show();
      $("#item_div").show();
      $("#serial_div").show();

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
      $("#ip_address_div").hide();
      // $("#po_date_div").hide();
      // $("#po_no_div").hide();
      // $("#supplier_div").hide();
      // $("#warranty_div").hide();
      // $("#make_date_div").hide();

      $("#po_date_div").show();
      $("#po_no_div").show();
      $("#supplier_div").show();

      $("#warranty_div").show();
      $("#make_date_div").show();

      $("#install_date_div").hide();
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").show();
      $("#cpu_item_model_name").show();
      $("#cpu_serial_no").show();
      $("#os_div").hide();
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
      $("#indoor_outdoot_option").hide();
      $("#department_div").hide();
      $("#hdd_ram_size_div").hide();
      $("#cpu_item_model_name").hide();
      $("#cpu_serial_no").hide();

    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#cpu_item_model_name_input").select2();
    $("#cpu_serial_no_input").select2();
    getVendors();

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
    $("#indoor_outdoot_option").hide();
    $("#department_div").hide();
    $("#hdd_ram_size_div").hide();
    $("#cpu_item_model_name").hide();
    $("#cpu_serial_no").hide();

  });
</script>

<script>
  function getBranch(zone_id) {
    $("#branch_id").empty();
    // $.getJSON("<?php echo base_url(); ?>Inventory/getBranchAjaxNew/" + taluka_id, function(data) {
    //   var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
    //   $.each(data, function(key, val) {
    //     stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
    //   });
    //   $("#branch_id").html(stringToAppend);
    // });
    var zone_id = $("#zone_id").val();
    $.ajax({
      url: "<?php echo base_url(); ?>Inventory/getBranchAjaxNew/",
      type: 'POST',
      data: {
        zone_id: zone_id
      },
      cache: false,
      success: function(data) {
        data = JSON.parse(data);
        var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
        for (let index = 0; index < data.length; index++) {
          stringToAppend += "<option value='" + data[index].branch_id + "'>" + data[index].branch_name + "</option>";
        }
        $("#branch_id").html(stringToAppend);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert(textStatus, errorThrown);
      }
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
    $.getJSON("<?php echo base_url(); ?>Ajax/getSubCategoryForInventory/" + cat_id, function(data) {
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
  $('#btnsubmitdata').click(function(e) {
    e.preventDefault();

    var focusSet = false;
    var allfields = true;
    var ip_address_new = $("#ip_address").val();
    // localStorage.removeItem('isDuplicateSerialNo');

    // $.getJSON("<?php echo base_url(); ?>Inventory/checkIpAddress/" + ip_address_new, function(data) {
    //   var ip_address_old = data.ip_address;
    //   if (ip_address_old) {
    //     alert("Ip Address Duplicate");
    //     allfields = false;
    //   }
    // });

    // alert($("#sub_cat_id").val());
    
    var serial_no = $("#serial_no").val();

    var serialNoValidationCheckSubIdArr = ['1', '2', '3', '4', '24'];
    var sub_cat_id = $("#sub_cat_id").val();
    if (jQuery.inArray(sub_cat_id, serialNoValidationCheckSubIdArr) != -1) {

      var serial_no_new = $("#serial_no").val();
      $.getJSON("<?php echo base_url(); ?>Inventory/chechDuplicateSerial/" + serial_no_new, function(data) {
        // localStorage.removeItem('isDuplicateSerialNo');
        // var serial_no_old = data.serial_no;
        if (serial_no = data.serial_no) {
          localStorage.setItem('isDuplicateSerialNo', data.serial_no);
          $("#serial_no_err").html("Serial no duplicate");
          alert("Serial No Duplicate");
          allfields = false;
          return;
        } else {
          localStorage.setItem('isDuplicateSerialNo',"");
          allfields = true;
        }
      });

      if (ip_address_new != '' && ip_address_new != null) {
        $.getJSON("<?php echo base_url(); ?>Inventory/checkIpAddress/" + ip_address_new, function(data) {
          var ip_address_old = data.ip_address;
          if (ip_address_old) {
            alert("Ip Address Duplicate");
            allfields = false;
          } else {
            allfields = true;
          }
        });
      }

    }

    var cat_id = $("#cat_id").val();
    if (cat_id == "" || cat_id == null) {
      if ($("#cat_id").next(".validation").length == 0) // only add if not added
      {
        $("#cat_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#cat_id").focus();
      }
      allfields = false;
    } else {
      $("#cat_id").next(".validation").remove(); // remove it
      allfields = true;
    }

    var sub_cat_id = $("#sub_cat_id").val();
    if (sub_cat_id == "" || sub_cat_id == null) {
      if ($("#sub_cat_id").next(".validation").length == 0) // only add if not added
      {
        $("#sub_cat_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#sub_cat_id").focus();
      }
      allfields = false;
    } else {
      $("#sub_cat_id").next(".validation").remove(); // remove it
      allfields = true;
    }
    // allfields = true;

    var sub_cat_id = $("#sub_cat_id").val();
    

    var sessionSerialNo = JSON.stringify(localStorage.getItem('isDuplicateSerialNo'));

    if (serial_no != '' || serial_no != null) {
      // if (serial_no == JSON.stringify(localStorage.getItem('isDuplicateSerialNo'))) {
      if (serial_no == localStorage.getItem('isDuplicateSerialNo')) {
        $("#serial_no_err").html("Serial no duplicate");
        allfields = false;
        return false;
      }
    }
    alert("session value - "+localStorage.getItem('isDuplicateSerialNo'));
    // return;
    // 
    if (serial_no != '' || serial_no != null) {
      if (serial_no == localStorage.getItem('isDuplicateSerialNo')) {
        $("#serial_no_err").html("Serial no duplicate");
      } else {
        if (allfields) {
          // $('#create_inventory').submit(e);
          $('#create_inventory').submit();
          alert("Inventory added successfully ");
          // e.preventDefault();
        } else {
          alert("Error While adding inventory");
          return false;
        }
      }
    }else{
      if (allfields) {
        $('#create_inventory').submit();
        alert("Inventory added successfully ");
      } else {
        alert("Error While adding inventory");
        return false;
      }
    }
    // if (allfields) {
    //   // $('#create_inventory').submit(e);
    //   $('#create_inventory').submit();
    //   alert("Create");
    //   // e.preventDefault();
    // } else {
    //   alert("false noted ");
    //   return false;
    // }
  });
</script>

<!-- <script>
    $(document).ready(function() {
        $('#item').select2({
            placeholder: 'Select an item/model',
            allowClear: true
        });

        // Focus on the search box when the dropdown is opened
        $('#item').on('select2:open', function() {
            setTimeout(function() {
                document.querySelector('.select2-container--open .select2-search__field').focus();
            }, 0);
        });
    });
</script> -->