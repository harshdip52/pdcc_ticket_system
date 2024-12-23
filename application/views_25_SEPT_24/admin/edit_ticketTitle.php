<div class="sidebar-bg hide_in_print"></div>
  <div id="content" class="content">
    <ol class="breadcrumb pull-right"> 
       <li class="breadcrumb-item "><a href="<?= base_url();?>admin"> Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>admin/ticketDashboard"> Ticket Dashboard</a></li>
       <li class="breadcrumb-item "><a href="<?= base_url();?>admin/masterTitle"> Ticket list</a></li> 
      <li class="breadcrumb-item active">Ticket Title</li>
    </ol>
    <h1 class="page-header">Add Ticket Title</h1>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Ticket Title</h4>
      </div>
      <form method="post" action="<?=base_url()?>admin/ticketTitle" id="ticketTitle">
      <div class="panel-body">
        <div class="row"> 
          <div class="col-md-4">
            <label>Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="cat_id" name="cat_id" onchange="getSubCategory(this.value)">
              <option selected value="" disabled="" >--select Category--</option>
              <?php foreach ($getAllCategory as $key => $Category) {?>
                <option value="<?=$Category['cat_id']?>"><?=$Category['cat_name']?></option>
              <?php }?> 
            </select>
          </div>
          <div class="col-md-4">
            <label>Sub-Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id"> 
            </select>
          </div>
          <div class="col-md-4">
            <label>Ticket Title<sup class="text-danger">*</sup></label>
            <input class="form-control" type="text" name="ticket_title" id="ticket_title">
          </div>
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
          <a href="<?=base_url();?>Inventory" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function () 
    {
       
    });
  </script>

  <script>
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

     var ticket_title = $("#ticket_title").val();
    if (ticket_title == "" || ticket_title== null) 
    {
      if ($("#ticket_title").next(".validation").length == 0) // only add if not added
      {
        $("#ticket_title").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#ticket_title").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#ticket_title").next(".validation").remove(); // remove it
    }

     
    if (allfields) 
    {
      $('#ticketTitle').submit();
    } 
    else 
    {
      return false;
    }
  });
</script>