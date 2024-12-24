  <div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_taluka">Taluka List</a></li>
      <li class="breadcrumb-item active">Edit Taluka </li>
    </ol>
    <h1 class="page-header">Edit Taluka</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Edit Taluka</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/edit_taluka" id="edit_taluka">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <label>Taluka Name<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="taluka_name" id="taluka_name" value="<?=$talukadata['taluka_name']?>">
            <input class="form-control" type="hidden" name="taluka_id" id="taluka_id" value="<?=$talukadata['taluka_id']?>">
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/master_taluka" class="btn btn-sm btn-danger">Cancel</a>
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
    var taluka_name = $("#taluka_name").val();
    if (taluka_name == "" || taluka_name== null) 
    {
      if ($("#taluka_name").next(".validation").length == 0) // only add if not added
      {
        $("#taluka_name").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#taluka_name").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#taluka_name").next(".validation").remove(); // remove it
    }
    if (allfields) 
    {
      $('#edit_taluka').submit();
    } 
    else 
    {
      return false;
    }
    
    });</script>
 