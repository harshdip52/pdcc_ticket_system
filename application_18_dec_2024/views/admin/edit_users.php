<style>
  #branch_div .multiselect-container {
    height: 150px;
    overflow-y: scroll;
  }

  #tal_div .multiselect-container {
    height: 150px;
    overflow-y: scroll;
  }

  #zone_div .multiselect-container {
    height: 150px;
    overflow-y: scroll;
  }

  #branch_div_one .multiselect-container {
    height: 150px;
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
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Add User</h4>
    </div>

    <form method="post" action="<?= base_url() ?>admin/edit_users" id="edit_users">
      <input class="form-control" type="hidden" name="user_id" id="user_id">

      <div class="panel-body">
        <div class="row">
          <div class="col-md-4 input-padd">
            <label>Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="name" id="name">
          </div>
          <div class="col-md-4 input-padd">
            <label>Mobile<sup class="text-danger">*</sup></label>
            <!-- <input class="form-control" type="text" name="mobile" id="mobile"> -->
            <input class="form-control" type="text" name="mobile" id="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10">
          </div>

          <div class="col-md-4 input-padd">
            <label>email id</label>
            <input class="form-control" type="email" name="email" id="email">
          </div>

          <div class="col-md-4 input-padd">
            <label>Emp / Vendor Id<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="emp_id" id="emp_id" readonly>
          </div>
          <div class="col-md-4 input-padd">
            <label>Role<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="role" id="role" onchange="getRole(this.value);getTaluka();">
              <option selected disabled="" value="">--select Role--</option>
              <?php foreach ($getallroles as $roleKey => $roleValue) { ?>
                <option value="<?php echo $roleValue['role_id'] ?>"><?php echo $roleValue['role_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="col-md-4 input-padd" id="tal_div">
            <label>Taluka<sup class="text-danger">*</sup></label>
            <!-- <select class="form-select from-font" onchange="getZone(this.value)" required="" name="taluka_id" id="taluka_id" multiple="multiple"> -->
            <select class="form-select from-font" onchange="getZone(this.value)" required="" name="taluka_id[]" id="taluka_id" multiple="multiple">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="zone_div">
            <label>Zone<sup class="text-danger">*</sup></label>
            <select class="form-select from-font " required="" name="zone_id[]" id="zone_id" onchange="getBranch(this.value)" multiple="multiple">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="branch_div">
            <label>Branch<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="branch_id" name="branch_id[]" required="" height='100%' onfocus='this.size=10;' multiple="">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="branch_div_one">
            <label>Branch<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="branch_id_one" name="branch_id_one" required="" multiple="multiple">
            </select>
          </div>

          <div class="col-md-4 input-padd">
            <label>Status<sup class="text-danger">*</sup></label>
            <select class="form-select user_status" name="user_status" id="user_status">
              <option selected disabled="" value="">--select Status--</option>
              <?php foreach (userStatus() as $statusKey => $statusValue) { ?>
                <option value="<?php echo $statusKey;?>"><?php echo $statusValue; ?></option>
              <?php } ?>
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

<script type="text/javascript">
  function getTaluka() {
    // var data =  "<?php #echo json_encode($userData);
                    ?>";
    // console.log(data);

    // $('#zone_id').multiselect('destroy');
    // $('#zone_id').html(stringToAppend);
    // $('#zone_id').multiselect('refresh');       


    getAllTalukaList();
    // return;
    // body...
  }


  function onEdit() {

    var user_id = "<?php echo $userData['user_id'] ?>";

    $.getJSON("<?php echo base_url(); ?>Ajax/getUserDetailedById/" + user_id, function(data) {
     
        $('#user_id').val(data.user_id);
        $('#name').val(data.name);
        $('#mobile').val(data.mobile);
        $('#email').val(data.email);
        $('#role').val(data.role);
        $('#emp_id').val(data.emp_id);
        $('#user_status').val(data.status);
     
        // $('#taluka_id').val(data.taluka_id);
        // preSeledtedTalukaList.push(data.taluka_id.split(','));

        // localStorage.setItem('preselectedTalukaList', JSON.stringify(data.taluka_id));
        localStorage.setItem('preselectedTalukaList', data.taluka_id);

        // getZone(data.taluka_id)
        getZone(taluka_id = null);
        // getZone(preSeledtedTalukaList);
        setTimeout(function() {
          $('#zone_id').val(data.zone_id);
        }, 500);

        getBranch(data.zone_id)
        setTimeout(function() {
          $('#branch_id_one').val(data.branch_id);
          // alert(data.branch_id)

          var test = data.branch_id;
          var testArray = test.split(',');
          var testArray = testArray.map(function(item) {
            return item.trim();
          });
          // alert(testArray)
          $('#branch_id').val(testArray);

        }, 500);

        // $('#actionId').val("updatemastercenter");
      }

    );

  }
</script>

<script>
  function getBranch(zone_id) {
    var assign_branch_name = <?php echo json_encode($assign_branch_name) ?>;
    var assign_branch_name_obj = JSON.parse(assign_branch_name);
    var taluka_id = $("#taluka_id :selected").map(function(i, el) {
      return $(el).val();
    }).get();
    // console.log('Index : ' + $.inArray('ALL', taluka_id));
    // console.log(taluka_id);
    // alert("from branch list "+typeof(taluka_id));
    // return;  
    $.ajax({
      url: "<?php echo base_url(); ?>Ajax/getBranchAjaxEditUser/",
      type: "POST",
      data: {
        taluka_id: taluka_id
      },
      success: function(data) {
        data = JSON.parse(data);
        var stringToAppend = "<option value=''>Select Branch</<option>";
        stringToAppend += "<option value='ALL'>ALL</<option>";
        // if(taluka_id == "ALL"){
        var checkAllEsist = $.inArray('ALL', taluka_id);
        if (checkAllEsist != -1) {
          $.each(data, function(key, value) {
            stringToAppend += "<option selected='selected' value='" + value.branch_id + "'>" + value.branch_name + "</option>";
          });
        } else {
          $.each(data, function(key, value) {
            var exists = Object.values(assign_branch_name_obj).includes(value.branch_name);
            if (exists) {
              stringToAppend += "<option selected value='" + value.branch_id + "'>" + value.branch_name + "</option>";
            } else {
              // console.log("Not Found " + value.branch_name + "\n");
              stringToAppend += "<option value='" + value.branch_id + "'>" + value.branch_name + "</option>";
            }
          });
        }

        $('#branch_id').multiselect('destroy');
        $('#branch_id').html(stringToAppend);
        $('#branch_id').multiselect('refresh');

        $('#branch_id_one').multiselect('destroy');
        $('#branch_id_one').html(stringToAppend);
        $('#branch_id_one').multiselect('refresh');
      }
    })

  }

  function getZone(taluka_id) {
    var valuesTaluka = $("#taluka_id :selected").map(function(i, el) {
      return $(el).val();
    }).get();

    if ($("#role").val() == 3 || $("#role").val() == 5) {
      valuesTaluka = valuesTaluka;
    } else {
      valuesTaluka = ['ALL'];
    }

    $.ajax({
      url: "<?php echo base_url(); ?>Ajax/getZoneAjaxEditUser/",
      type: "POST",
      data: {
        taluka_id: valuesTaluka
      },
      success: function(data) {
        data = JSON.parse(data);
        var stringToAppend = '';
        // var stringToAppend = "<option  value=''>-- Select Zone --</option> ";

        $.each(data, function(key, val) {
          stringToAppend += "<option selected value='" + val.zone_id + "'>" + val.zone_name + "</option>";
        });
        $('#zone_id').multiselect('destroy');
        $('#zone_id').html(stringToAppend);
        $('#zone_id').multiselect('refresh');

        getBranch(valuesTaluka);
      }
    })
    //  $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/"+taluka_id, function(data) {
    //    var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
    //    $.each(data, function(key, val) {
    //      stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
    //    });
    //    $("#zone_id").html(stringToAppend);
    //  });
  }

  function getAllTalukaList() {
    var assign_taluka_name = <?php echo json_encode($assing_taluka_name) ?>;
    var assign_taluka_name_obj = JSON.parse(assign_taluka_name);

    $.getJSON("<?php echo base_url(); ?>Ajax/getAllTalukaList/", function(data) {
      var stringToAppend = "<option disabled value='' >-- Select Taluka --</option>";
      stringToAppend += "<option value='ALL'>ALL</option>";
      $.each(data, function(key, val) {
        if ($.inArray(val.taluka_name, assign_taluka_name_obj) != -1) {
          stringToAppend += "<option selected='selected' value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
        } else {
          stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
        }
      });

      //  $("#taluka_id").html(stringToAppend);

      $('#taluka_id').multiselect('destroy');
      $('#taluka_id').html(stringToAppend);
      $('#taluka_id').multiselect('refresh');
    });
  }
  $(document).ready(function() {
    // valuesTaluka = [];  
    // $("#branch_id").multiselect({
    //   columns: 3,
    //   texts: {
    //     placeholder: 'Select Branch',
    //     search: 'Search Branch'
    //   },
    //   search: true,
    //   selectAll: true
    // });


    

    $('#branch_id').multiselect({
      search: true,
      selectAll: true,
    });

    getAllTalukaList();
    setTimeout(function() {
      onEdit();

    }, 300);
    setTimeout(function() {
      var roles = $('#role').val();
      getRole(roles);

    }, 500);



    // $("#tal_div").hide();
    // $("#zone_div").hide();
    // $("#branch_div").hide();
    // $("#branch_div_one").hide();
  });
</script>
<script type="text/javascript">
  function getZoneDetails() {
    var assign_zone_name = '<?php echo json_encode($assign_zone_name) ?>';
    assign_zone_name = JSON.parse(assign_zone_name);
    var stringToAppend = "<option  value=''>-- Select Zone --</option> ";
    for (let index = 0; index < assign_zone_name.length; index++) {
      stringToAppend += "<option selected value='" + assign_zone_name[index].zone_id + "'>" + assign_zone_name[index].zone_name + "</option>";
    }
    $('#zone_id').multiselect('destroy');
    $('#zone_id').html(stringToAppend);
    $('#zone_id').multiselect('refresh');
    return;
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



    var email = $("#email").val();
    if (email == "" || email == null) {
      if ($("#email").next(".validation").length == 0) // only add if not added
      {
        $("#email").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#email").focus();
      }
      allfields = false;
    } else {
      $("#email").next(".validation").remove(); // remove it
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

      var zone_id_check = $("#zone_id").val();
      if (zone_id_check == "" || zone_id_check == null) {
        getZoneDetails();
        var zone_id = $("#zone_id").val();
      } else {
        var zone_id = $("#zone_id").val();
      }

      // var zone_id = zone_id_check || "getZoneDetails()";     
      // alert("zone_id"+zone_id);
      // return;
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
      $('#edit_users').submit();
    } else {
      return false;
    }
  });
</script>
<script type="text/javascript">
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
    if (role == 5) {
      $("#tal_div").show();
      $("#zone_div").show();
      $("#branch_div").show();
      $("#branch_div_one").hide();

    }


    if (role == 6 || role == 4 || role == 1 || role == 7) {
      $("#tal_div").hide();
      $("#zone_div").hide();
      $("#branch_div").hide();
      $("#branch_div_one").hide();
    }



  }
</script>>