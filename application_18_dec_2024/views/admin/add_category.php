  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_zone">Category List</a></li>
      <li class="breadcrumb-item active">Add Category </li>
    </ol>
    <h1 class="page-header">Add Category</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Category</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/add_category" id="add_category">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Category Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="cat_name" id="cat_name">
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
    var cat_name = $("#cat_name").val();
    if (cat_name == "" || cat_name== null) 
    {
      if ($("#cat_name").next(".validation").length == 0) // only add if not added
      {
        $("#cat_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#cat_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#cat_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#add_category').submit();
    } 
    else 
    {
      return false;
    }
    
    });</script>
 