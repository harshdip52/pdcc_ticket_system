  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_sub_category">Sub Category List</a></li>
      <li class="breadcrumb-item active">Add Sub Category </li>
    </ol>
    <h1 class="page-header">Add Sub Category Details</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Sub Category Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/add_sub_category" id="add_sub_category">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Category Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="cat_id" id="cat_id">
            </select>
          </div>
          <div class="col-md-4">
            <label>Sub Category Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="sub_cat_name" id="sub_cat_name">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/master_sub_category" class="btn btn-sm btn-danger">Cancel</a>
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

    var sub_cat_name = $("#sub_cat_name").val();
    if (sub_cat_name == "" || sub_cat_name== null) 
    {
      if ($("#sub_cat_name").next(".validation").length == 0) // only add if not added
      {
        $("#sub_cat_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#sub_cat_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#sub_cat_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#add_sub_category').submit();
    } 
    else 
    {
      return false;
    }

   
    
    });
$(document).ready(function () 
    {
      getAllCategoryList();
    });

 function getAllCategoryList() 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getAllCategoryList/", function (data) {
      var stringToAppend = "<option disabled selected value=''>--Select Category--</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.cat_id + "'>" + val.cat_name + "</option>";
      });
      $("#cat_id").html(stringToAppend); 
    });
    }



  </script>
 