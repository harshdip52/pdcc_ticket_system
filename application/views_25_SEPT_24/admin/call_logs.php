<div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li> 
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/call_log_master">Call log List</a></li>
      <li class="breadcrumb-item active">Add Call Log </li>
    </ol>
    <h1 class="page-header">Add Call Log</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Call Log</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/call_logs" id="call_logs">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 input-padd">
            <label>Call From<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="call_from" id="call_from">
          </div>

          <div class="col-md-6 input-padd">
            <label>Call to<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="call_to" id="call_to">
          </div>

          <div class="col-md-12 input-padd">
            <label>Call Comments<sup class="text-danger">*</sup></label>
            <textarea class="form-control" type="text" name="description" id="description"> </textarea>
           
          </div>
        </div> 
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;"> 
          <!-- <input type="submit" name="submit" value="submit" class="btn btn-sm btn-success" >  -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>admin/call_log_master" class="btn btn-sm btn-danger">Cancel</a>
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
    var call_from = $("#call_from").val();
    if (call_from == "" || call_from== null) 
    {
      if ($("#call_from").next(".validation").length == 0) // only add if not added
      {
        $("#call_from").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#call_from").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#call_from").next(".validation").remove(); // remove it
    }


    var call_to = $("#call_to").val();
    if (call_to == "" || call_to== null) 
    {
      if ($("#call_to").next(".validation").length == 0) // only add if not added
      {
        $("#call_to").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#call_to").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#call_to").next(".validation").remove(); // remove it
    }

    if (allfields) 
    {
      $('#call_logs').submit();
    } 
    else 
    {
      return false;
    }
    
    });</script>
 