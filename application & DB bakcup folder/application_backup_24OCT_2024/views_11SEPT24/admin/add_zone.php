  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_zone">Zone List</a></li>
      <li class="breadcrumb-item active">Add Zone </li>
    </ol>
    <h1 class="page-header">Add Zone Details</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Zone Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/add_zone" id="add_zone">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Taluka Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" onchange="getZone(this.value)" name="taluka_id" id="taluka_id">
            </select>
          </div>
          <div class="col-md-4">
            <label>Zone Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="zone_name" id="zone_name">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/master_zone" class="btn btn-sm btn-danger">Cancel</a>
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

    var zone_name = $("#zone_name").val();
    if (zone_name == "" || zone_name== null) 
    {
      if ($("#zone_name").next(".validation").length == 0) // only add if not added
      {
        $("#zone_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#zone_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#zone_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#add_zone').submit();
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



  </script>
 