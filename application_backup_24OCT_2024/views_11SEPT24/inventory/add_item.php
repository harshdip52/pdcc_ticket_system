  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>inventory">inventory Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>inventory/inventory_item">Item List</a></li>
      <li class="breadcrumb-item active">Add Items / Model </li>
    </ol>
    <h1 class="page-header">Add Items / Model Details</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Items / Model Details</h4>
      </div>
      <form method="post" action="<?=base_url()?>inventory/add_item" id="add_item">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Category Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" onchange="getSubCategory(this.value)" name="cat_id" id="cat_id">
            </select>
          </div>
          <div class="col-md-4">
            <label>Sub category Name<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" name="sub_cat_id" id="sub_cat_id">
            </select>
          </div>
          <div class="col-md-4">
            <label>Item / Model Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="item_name" id="item_name">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>inventory/inventory_item" class="btn btn-sm btn-danger">Cancel</a>
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
    if (allfields) 
    {
      $('#add_item').submit();
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



  </script>
 