<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"> -->

<style>
  .multiselect-container {
    max-height: 150px !important;
    overflow-y: scroll;
  }
</style>

<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin"> Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin/users_list"> User List</a></li>
    <li class="breadcrumb-item active">User Details</li>
  </ol>
  <h1 class="page-header">Add User</h1>
  <?php if ($this->session->flashdata()): ?>
    <div class="flashData">
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('error') ?>
        </div>
      <?php endif ?>
    </div>
  <?php endif ?>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Add User</h4>
    </div>
    <form method="post" action="<?= base_url() ?>admin/users" id="add_users">
      <div class="panel-body">
        <div class="row">


          <div class="col-md-4 input-padd">
            <label>Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="name" id="name">
          </div>


          <div class="col-md-4 input-padd">
            <label>Emp ID / Vendor ID<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="emp_id" id="emp_id">
          </div>

          <div class="col-md-4 input-padd">
            <label>Mobile<sup class="text-danger">*</sup></label>
            <!-- <input class="form-control" type="text" name="mobile" id="mobile"> -->
            <input class="form-control" type="text" name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10">
          </div>


          <div class="col-md-4 input-padd">
            <label>Email</label>
            <input class="form-control" type="email" name="email" id="email">
          </div>

          <div class="col-md-4 input-padd">
            <label>Role<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="role" id="role" onchange="getRole(this.value)">
              <option selected disabled="" value="">--select Role--</option>
              <?php foreach ($getallroles as $roleKey => $roleValue) { ?>
                <option value="<?php echo $roleValue['role_id'] ?>"><?php echo $roleValue['role_name'] ?></option>
              <?php } ?>
              <!-- <option value="1">Admin</option>
              <option value="2">Zonal Officer</option>
              <option value="3">Branch Manager</option>
              <option value="4">Helpdesk</option>
              <option value="5">Support Engineer</option>
              <option value="6">Vendor</option>
              <option value="7">Store keeper</option>
              <option value="8">IT Manager</option> -->
            </select>
          </div>

          <div class="col-md-4 input-padd" id="tal_div" stye="width:100%;">
            <label>Taluka<sup class="text-danger">*</sup></label>
            <br>
            <!-- <select style="width: 100%;" class="form-control taluka_id" onchange="getZone(this.value)" required name="taluka_id" id="taluka_id" multiple="multiple"> -->
            <select style="width: 100%;" class="form-control taluka_id" required name="taluka_id[]" id="taluka_id" multiple="multiple">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="zone_div">
            <label>Zone<sup class="text-danger">*</sup></label>
            <!-- <select class="form-select from-font" required="" name="zone_id" id="zone_id" onchange="getBranch(this.value)" multiple="multiple"> -->
            <select class="form-select from-font" required="" name="zone_id[]" id="zone_id" multiple="multiple">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="branch_div">
            <label>Branch<sup class="text-danger">*</sup></label>
            <!-- <select style="width: 100%;" class="form-select branch_id from-font" id="branch_id" name="branch_id[]" required="" height='100%' onfocus='this.size=10;' multiple="multiple"> -->
            <select style="width: 100%;" class="form-select branch_id from-font" id="branch_id" name="branch_id[]" required multiple="multiple" size="30" style="height: 100%;">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="branch_div_one">
            <label>Branch<sup class="text-danger">*</sup></label>
            <select style="height: 100px;overflow-y:scroll;overflow-x:scroll;" class="form-select branch_id_one from-font" id="branch_id_one" name="branch_id_one[]" required multiple="multiple">
            </select>
          </div>



        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <!-- <a id="submit_pop" class="btn btn-sm btn-success">Submit</a> -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>

          <a href="<?= base_url(); ?>admin" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {

    // $("#taluka_id").select2({
    //   // tags: true,
    //   // maximumSelectionSize: 10,
    //   // multiple: true,
    //   // width: '100%',
    //   allowClear: true,
    //   closeOnSelect: true,
    //   // width: 600
    // });

    getAllTalukaList();
    $("#tal_div").hide();
    $("#zone_div").hide();
    $("#branch_div").hide();
    $("#branch_div_one").hide();



    $('.taluka_id').multiselect({
      search: true,
      selectAll: true,
    });

    $('.branch_id').multiselect({
      search: true,
      selectAll: true,
    });
    $('.branch_id_one').multiselect({
      search: true,
      selectAll: true,
    });
    $('.zone_id').multiselect({
      search: true,
      selectAll: true,
    });

  });

  // function getBranch(taluka_id) {
  function getBranch(taluka_id) {
    // alert(zone_id);
    // var values = [];
    // var $selectedOptions = $("#zone_id").find('option:selected');
    // $selectedOptions.each(function() {
    //   // values.push($(this).text());
    //   values.push($(this).val());
    // });

    // console.log(JSON.stringify(values));

    // $("#zone_id").empty();

    if (taluka_id.length > 0) {
      $.ajax({
        // url: "<?php echo base_url(); ?>Ajax/getBranchAjax/", //the page containing php script
        url: "<?php echo base_url(); ?>Ajax/getBranchAjaxUsersAdd/", //the page containing php script
        type: "post",
        dataType: 'json',
        data: {
          taluka_id: taluka_id
        },
        success: function(data) {
          var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
          stringToAppend += "<option value='All'>All</option> ";
          if (taluka_id == "All") {
            $.each(data, function(key, val) {
              stringToAppend += "<option selected='selected' value='" + val.branch_id + "'>" + val.branch_name + "</option>";
            });
          } else {
            $.each(data, function(key, val) {
              stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
            });
          }


          $('.branch_id').multiselect('destroy');
          $('.branch_id').html(stringToAppend);
          $('.branch_id').multiselect('refresh');

          $('.branch_id_one').multiselect('destroy');
          $('.branch_id_one').html(stringToAppend);
          $('.branch_id_one').multiselect('refresh');

        }
      });
    } else {
      var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
      $('.branch_id').multiselect('destroy');
      $('.branch_id').html(stringToAppend);
      $('.branch_id').multiselect('refresh');

      $('.branch_id_one').multiselect('destroy');
      $('.branch_id_one').html(stringToAppend);
      $('.branch_id_one').multiselect('refresh');
    }
  }

  function getZone(taluka_id) {

    $("#zone_id").empty();
    $.ajax({
      url: "<?php echo base_url(); ?>Ajax/getZoneAjaxNew/", //the page containing php script
      type: "post",
      dataType: 'json',
      data: {
        taluka_id: taluka_id
      },
      success: function(data) {
        var stringToAppend = "<option value=''>-- Select Zone --</option> ";
        $.each(data, function(key, val) {
          stringToAppend += "<option  selected='selected' value='" + val.zone_id + "'>" + val.zone_name + "</option>";
        });
        $('#zone_id').multiselect('destroy');
        $('#zone_id').html(stringToAppend);
        $('#zone_id').multiselect('refresh');
      }
    });
  }


  $('#zone_id').on('change', function() {
    var values = [];
    var $selectedOptions = $(this).find('option:selected');
    $selectedOptions.each(function() {
      // values.push($(this).text());
      values.push($(this).val());
    });
    getBranch(values);
  });

  $('#taluka_id').on('change', function() {
    var values = [];
    var $selectedOptions = $(this).find('option:selected');
    $selectedOptions.each(function() {
      // values.push($(this).text());
      values.push($(this).val());
    });
    getZone(values);
    getBranch(values);
  });

  function getAllTalukaList() {
    $.getJSON("<?php echo base_url(); ?>Ajax/getAllTalukaList/", function(data) {
      // var stringToAppend = "<option disabled selected value=''>-- Select Taluka --</option> ";
      var stringToAppend = "<option  value=''>-- Select Taluka --</option> ";
      var stringToAppend = "<option  value='All'>All</option> ";
      // var stringToAppend = "";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
      });
      // $("#taluka_id").append(stringToAppend);
      // $('#taluka_id').multiselect(); 

      $('.taluka_id').multiselect('destroy');

      $('.taluka_id').html(stringToAppend);
      $('.taluka_id').multiselect('refresh');
      // $('#taluka_id').multiselect('rebuild');
    });
  }


  $('#btnsubmitdata').click(function(e) {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;

    var name = $("#name").val();
    if (name == "" || name == null) {
      if ($("#name").next(".validation").length == 0) // only add if not added
      {
        $("#name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#name").focus();
      }
      allfields = false;
    } else {
      $("#name").next(".validation").remove(); // remove it
    }

    var mobile = $("#mobile").val();
    if (mobile == "" || mobile == null) {
      if ($("#mobile").next(".validation").length == 0) // only add if not added
      {
        $("#mobile").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#mobile").focus();
      }
      allfields = false;
    } else {
      $("#mobile").next(".validation").remove(); // remove it
    }



    var emp_id = $("#emp_id").val();
    if (emp_id == "" || emp_id == null) {
      if ($("#emp_id").next(".validation").length == 0) // only add if not added
      {
        $("#emp_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#emp_id").focus();
      }
      allfields = false;
    } else {
      $("#emp_id").next(".validation").remove(); // remove it
    }

    var role = $("#role").val();
    if (role == "" || role == null) {
      if ($("#role").next(".validation").length == 0) // only add if not added
      {
        $("#role").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#role").focus();
      }
      allfields = false;
    } else {
      $("#role").next(".validation").remove(); // remove it
    }


    if (role == 2) {
      $("#branch_id_one").next(".validation").remove();
      $("#branch_id").next(".validation").remove();
      var taluka_id = $("#taluka_id").val();
      if (taluka_id == "" || taluka_id == null) {
        if ($("#taluka_id").next(".validation").length == 0) // only add if not added
        {
          $("#taluka_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#taluka_id").focus();
        }
        allfields = false;
      } else {
        $("#taluka_id").next(".validation").remove(); // remove it
      }


      var zone_id = $("#zone_id").val();
      if (zone_id == "" || zone_id == null) {
        if ($("#zone_id").next(".validation").length == 0) // only add if not added
        {
          $("#zone_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#zone_id").focus();
        }
        allfields = false;
      } else {
        $("#zone_id").next(".validation").remove(); // remove it
      }
    }
    if (role == 3) {
      $("#branch_id").next(".validation").remove();
      var taluka_id = $("#taluka_id").val();
      if (taluka_id == "" || taluka_id == null) {
        if ($("#taluka_id").next(".validation").length == 0) // only add if not added
        {
          $("#taluka_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#taluka_id").focus();
        }
        allfields = false;
      } else {
        $("#taluka_id").next(".validation").remove(); // remove it
      }


      var zone_id = $("#zone_id").val();
      if (zone_id == "" || zone_id == null) {
        if ($("#zone_id").next(".validation").length == 0) // only add if not added
        {
          $("#zone_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#zone_id").focus();
        }
        allfields = false;
      } else {
        $("#zone_id").next(".validation").remove(); // remove it
      }
      var branch_id_one = $("#branch_id_one").val();
      if (branch_id_one == "" || branch_id_one == null) {
        if ($("#branch_id_one").next(".validation").length == 0) // only add if not added
        {
          $("#branch_id_one").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#branch_id_one").focus();
        }
        allfields = false;
      } else {
        $("#branch_id_one").next(".validation").remove(); // remove it
      }

    }
    if (role == 5) {
      $("#branch_id_one").next(".validation").remove();
      var taluka_id = $("#taluka_id").val();
      if (taluka_id == "" || taluka_id == null) {
        if ($("#taluka_id").next(".validation").length == 0) // only add if not added
        {
          $("#taluka_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#taluka_id").focus();
        }
        allfields = false;
      } else {
        $("#taluka_id").next(".validation").remove(); // remove it
      }


      var zone_id = $("#zone_id").val();
      if (zone_id == "" || zone_id == null) {
        if ($("#zone_id").next(".validation").length == 0) // only add if not added
        {
          $("#zone_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#zone_id").focus();
        }
        allfields = false;
      } else {
        $("#zone_id").next(".validation").remove(); // remove it
      }


      var branch_id = $("#branch_id").val();
      if (branch_id == "" || branch_id == null) {
        if ($("#branch_id").next(".validation").length == 0) // only add if not added
        {
          $("#branch_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) {
          $("#branch_id").focus();
        }
        allfields = false;
      } else {
        $("#branch_id").next(".validation").remove(); // remove it
      }

    }
    if (role == 6 || role == 4 || role == 1 || role == 7) {
      $("#taluka_id").next(".validation").remove();
      $("#branch_id").next(".validation").remove();
      $("#zone_id").next(".validation").remove();
      $("#branch_id_one").next(".validation").remove();
    }


    if (allfields) {
      $('#add_users').submit();
    } else {
      return false;
    }
  });


  function copyText() {
    var input1 = document.getElementById('emp_id');
    var input2 = document.getElementById('email');
    input2.value = input1.value;
    input2.disabled = true;
  }


  function getRole(role) {
    if (role == 2) {
      $("#tal_div").show();
      $("#zone_div").show();
      $("#branch_div").hide();
      $("#branch_div_one").hide();
    }
    if (role == 3) {
      $("#tal_div").show();
      $("#zone_div").show();
      $("#branch_div_one").show();
      $("#branch_div").hide();

    }
    if (role == 5 || role == 9) {
      $("#tal_div").show();
      $("#zone_div").show();
      $("#branch_div").show();
      $("#branch_div_one").hide();

    }
    if (role == 6 || role == 4 || role == 1 || role == 7 || role == 8) {
      $("#tal_div").hide();
      $("#zone_div").hide();
      $("#branch_div").hide();
      $("#branch_div_one").hide();
    }

  }
  // }
</script>