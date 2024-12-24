  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_brand">Brand List</a></li>
      <li class="breadcrumb-item active">Edit Brand </li>
    </ol>
    <h1 class="page-header">Edit Brand</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Edit Brand</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/edit_brand" id="edit_brand">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Brand Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="brand_name" id="brand_name" value="<?=$branddata['brand_name']?>">
            <input class="form-control" type="hidden" name="brand_id" id="brand_id" value="<?=$branddata['brand_id']?>">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/master_brand" class="btn btn-sm btn-danger">Cancel</a>
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
    var brand_name = $("#brand_name").val();
    if (brand_name == "" || brand_name== null) 
    {
      if ($("#brand_name").next(".validation").length == 0) // only add if not added
      {
        $("#brand_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#brand_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#brand_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#edit_brand').submit();
    } 
    else 
    {
      return false;
    }
    
    });</script>
 