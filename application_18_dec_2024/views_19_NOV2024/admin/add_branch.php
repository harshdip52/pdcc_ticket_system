  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_branch">Branch List</a></li>
      <li class="breadcrumb-item active">Add Branch </li>
    </ol>
    <h1 class="page-header">Add Branch Details</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Branch Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/add_branch" id="add_branch">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 input-padd">
            <label>Taluka Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" onchange="getZone(this.value)" name="taluka_id" id="taluka_id">
            </select>
          </div>
          <div class="col-md-6 input-padd">
            <label>Zone Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="zone_id" id="zone_id">
            </select>
          </div>
          <div class="col-md-6 input-padd">
            <label>Branch Code<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="branch_code" id="branch_code">
          </div>
          <div class="col-md-6 input-padd">
            <label>Branch Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="branch_name" id="branch_name">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/master_branch" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
    </div>
  </div>
  
<script type="text/javascript">
  $('#btnsubmitdata').click(function(e) 
  {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;
    var taluka_id = $("#taluka_id").val();
    if (taluka_id == "" || taluka_id== null) 
    {
      if ($("#taluka_id").next(".validation").length == 0) // only add if not added
      {
        $("#taluka_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#taluka_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#taluka_id").next(".validation").remove(); // remove it
    }

    var zone_id = $("#zone_id").val();
    if (zone_id == "" || zone_id== null) 
    {
      if ($("#zone_id").next(".validation").length == 0) // only add if not added
      {
        $("#zone_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#zone_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#zone_id").next(".validation").remove(); // remove it
    }

    var branch_code = $("#branch_code").val();
    if (branch_code == "" || branch_code== null) 
    {
      if ($("#branch_code").next(".validation").length == 0) // only add if not added
      {
        $("#branch_code").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#branch_code").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#branch_code").next(".validation").remove(); // remove it
    }

    var branch_name = $("#branch_name").val();
    if (branch_name == "" || branch_name== null) 
    {
      if ($("#branch_name").next(".validation").length == 0) // only add if not added
      {
        $("#branch_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#branch_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#branch_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#add_branch').submit();
    } 
    else 
    {
      return false;
    }

   
    
    });
$(document).ready(function () 
    {
      getAllTalukaList();
    });

 function getAllTalukaList() 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getAllTalukaList/", function (data) {
      var stringToAppend = "<option disabled selected value=''>--Taluka--</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
      });
      $("#taluka_id").html(stringToAppend); 
    });
    }

     function getZone(taluka_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+taluka_id, function (data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend); 
    });
    }



  </script>
 