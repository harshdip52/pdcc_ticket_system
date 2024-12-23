<?php $login_role = $this->session->userdata('login_role'); ?>
<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content"> 
  <ol class="breadcrumb pull-right"> 
  <li class="breadcrumb-item "><a href="<?= base_url();?>admin"> Dashboard</a></li>
  <li class="breadcrumb-item "><a href="<?= base_url();?>Support/supportDashboard">Ticket Dashboard</a></li>
    <li class="breadcrumb-item active">New Ticket </li>
  </ol> 
  <h1 class="page-header">New Ticket</h1> 
     <?php if ($this->session->flashdata()): ?>
      <div class="flashData">
        <?php if($this->session->flashdata('error')): ?>
           <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error') ?>
           </div>
        <?php endif ?> 
      </div>
      <?php endif ?>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Add Ticket</h4>
      </div>
      <form method="post" action="<?=base_url()?>Support/supportTicket" id="supportTicket" enctype="multipart/form-data">
      <div class="panel-body">
        <div class="row"> 
            <div class="col-md-4 input-padd" >
            <label>Branch<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="branch_id" name="branch_id" required="" onchange="getUser(this.value);">
            </select>
          </div>

          <div class="col-md-4 input-padd">
            <label>Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="cat_id" name="cat_id" required="" onchange="getSubCategory(this.value);showFields(this.value)">
            </select>
          </div>

          <div class="col-md-4 input-padd">
            <label>Sub Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id" required=""onchange="getItem(this.value);getTicketTitle(this.value)">
            </select>
          </div>

           <div class="col-md-4 input-padd" id="brand_div">
            <label>Brand<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="brand_id" name="brand_id" required="">
            </select>
          </div>

          <div class="col-md-4 input-padd" id="item_div">
            <label>Item<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="inventory_id" name="inventory_id" required="">
            </select>
          </div>
          <div class="col-md-4 input-padd">
            <label>Attachment</label>
            <input type="file" class="form-control" id="attachment" name="attachment" required="" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
          </div>
           

           <div class="col-md-12 input-padd">
            <label>Ticket Title<sup class="text-danger">*</sup></label>
             
            <select class="form-select from-font" id="ticket_title" name="ticket_title" required=""onchange="">
            </select>
            
          </div>
          <div class="col-md-12 input-padd">
            <label>Ticket Description</label>
           
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          


        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <!-- <a id="submit_pop" class="btn btn-sm btn-success">Submit</a> -->
          <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
         
          <a href="<?=base_url();?>Support/supportDashboard" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
    </div>
  </div>

<script type="text/javascript">
  <?php if($login_role==1 || $login_role==2 || $login_role==4) 
  { ?>
    var SelectVal = "selected";  
    // setTimeout(function()
    // {
    //   getAllUser();
    // }, 500)
  <?php }?>
  <?php if($login_role==3) { ?>
    var SelectVal = "";
    var branch_id="<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";
   
    setTimeout(function()
    {
      getUser(branch_id);
    }, 500);

  <?php }?>

function getTicketTitle(sub_cat_id) 
    {
      $.getJSON("<?php echo base_url();?>Ajax/getTicketTitleBySubCatId/"+sub_cat_id, function (data) 
      {
        var stringToAppend = "<option disabled selected value=''>-- Select Title --</option> ";
        $.each(data, function (key, val)
        {
          stringToAppend += "<option value='" + val.id + "'>" + val.ticket_title + "</option>";
        });
        $("#ticket_title").html(stringToAppend);
      });
    }

  function getBranchByUser() 
    {
      $.getJSON("<?php echo base_url();?>Ajax/getBranchAjaxByUser/", function (data) 
      {
        var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
        $.each(data, function (key, val)
        {
          stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
        });
        $("#branch_id").html(stringToAppend);
      });
    }
 
    
</script>

  <script>

$(document).ready(function () 
    {
       $("#brand_div").hide();
          $("#item_div").hide();
          getBranchByUser();

      
      getAllCategoryList();
      getAllbrandList();
      var role="<?php echo $login_role = $this->session->userdata('login_role'); ?>";
      var zone_id="<?php echo $zone = $this->session->userdata('login_zone_id'); ?>";
      var taluka_id="<?php echo $taluka_id = $this->session->userdata('login_taluka_id'); ?>";
      var branch_id="<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";
      // alert(role)
      
      if(role==2)
      {
        $("taluka_id").val('taluka_id');
        $("#taluka_id").attr("disabled","disabled");
        getZone(taluka_id) 
        setTimeout(function()
        {
          $('#zone_id').val(zone_id);
          $("#zone_id").attr("disabled","disabled");
        }, 500);

        setTimeout(function()
        {
          getBranch(zone_id)
        }, 500);
      }

      if(role==3)
      {
        $("taluka_id").val('taluka_id');
        $("#taluka_id").attr("disabled","disabled");
        getZone(taluka_id) 
        setTimeout(function()
        {
          $('#zone_id').val(zone_id);
          $("#zone_id").attr("disabled","disabled");
        }, 500);

        setTimeout(function()
        {
          getBranch(zone_id)
        }, 500);

        setTimeout(function()
        {
          $('#branch_id').val(branch_id);
          $("#branch_id").attr("disabled","disabled");
        }, 500);
      }
      
      


    });

 function getAllCategoryList() 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getAllCategoryList/", function (data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Category --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.cat_id + "'>" + val.cat_name + "</option>";
      });
      $("#cat_id").html(stringToAppend); 
    });
    }


    function getSubCategory(cat_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getSubCategoryForTicket/"+cat_id, function (data) {
      var stringToAppend = "<option disabled selected value=''> -- Select Sub Category -- </option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
      });
      $("#sub_cat_id").html(stringToAppend); 
    });
    }
    function getAllbrandList() 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getAllbrandList/", function (data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Brand --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.brand_id + "'>" + val.brand_name + "</option>";
      });
      $("#brand_id").html(stringToAppend); 
    });
    }



    function getItem(sub_cat_id) 
    { 
    $.getJSON("<?php echo base_url();?>Inventory/getItemBySubCat/"+sub_cat_id, function (data) {
      var stringToAppend = "<option disabled selected value=''> -- Select Item -- </option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.id + "'>" + val.item_name + "</option>";
      });
      $("#inventory_id").html(stringToAppend); 
    });
    }

    // function getItem() 
    // { 
    //   var taluka_id=$("#taluka_id").val();
    //   var zone_id=$("#zone_id").val();
    //   var branch_id=$("#branch_id").val();
    //   var cat_id=$("#cat_id").val();
    //   var sub_cat_id=$("#sub_cat_id").val();
    //   var brand_id=$("#brand_id").val();
    //   // alert(taluka_id); 
    //   if (taluka_id !=null && zone_id !=null && branch_id !=null && cat_id !=null && sub_cat_id !=null && brand_id !=null && taluka_id !='' && zone_id !='' && branch_id !='' && cat_id !='' && sub_cat_id !='' && brand_id !='') 
    //   {
    //     // $.getJSON("<?php echo base_url();?>Ajax/getAllInventryList?&taluka_id="+taluka_id, function (data) {

    //       $.getJSON("<?php echo base_url();?>Ajax/getAssignInventryList?&branch_id="+branch_id+"&cat_id="+cat_id+"&sub_cat_id="+sub_cat_id+"&brand_id="+brand_id, function (data) {
    //       var stringToAppend = "<option disabled selected value=''>-- Select inventory --</option> ";
    //       $.each(data, function (key, val) 
    //       {
    //         stringToAppend += "<option value='" + val.inventory_id + "'>" + val.item_name+'--'+val.serial_no + "</option>";
    //       });
    //       $("#inventory_id").html(stringToAppend); 
    //     });
    //   }
    // }

 

     
</script>
<script type="text/javascript">
  $('#btnsubmitdata').click(function(e) 
  {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;
    var taluka_id = $("#taluka_id").val();
    
 

    var branch_id = $("#branch_id").val();
    if (branch_id == "" || branch_id== null) 
    {
      if ($("#branch_id").next(".validation").length == 0) // only add if not added
      {
        $("#branch_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) { $("#branch_id").focus(); }
      allfields = false;
    } 
    else 
    {
      $("#branch_id").next(".validation").remove(); // remove it
    }

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



    if (cat_id==1  || cat_id==3) 
    {
      var brand_id = $("#brand_id").val();
      if (brand_id == "" || brand_id== null) 
      { 
        if ($("#brand_id").next(".validation").length == 0) // only add if not added
        {
          $("#brand_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) { $("#brand_id").focus(); }
        allfields = false;
      } 
      else 
      {
        $("#brand_id").next(".validation").remove(); // remove it
      }

      var inventory_id = $("#inventory_id").val();
      if (inventory_id == "" || inventory_id== null) 
      { 
        if ($("#inventory_id").next(".validation").length == 0) // only add if not added
        {
          $("#inventory_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
        }
        if (!focusSet) { $("#inventory_id").focus(); }
        allfields = false;
      } 
      else 
      {
        $("#inventory_id").next(".validation").remove(); // remove it
      }
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
    // var description = $("#description").val();
    // if (description == "" || description== null) 
    // { 
    //   if ($("#description").next(".validation").length == 0) // only add if not added
    //   {
    //     $("#description").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
    //   }
    //   if (!focusSet) { $("#description").focus(); }
    //   allfields = false;
    // } 
    // else 
    // {
    //   $("#description").next(".validation").remove(); // remove it
    // }

  
    if (allfields) 
    {
      $('#supportTicket').submit();
    } 
    else 
    {
      return false;
    }
  });

   function showFields(cat_id) 
   { 
      if (cat_id==1 || cat_id==3) 
      {
          $("#brand_div").show();
          $("#item_div").show();
      }
      else
         {
          $("#brand_div").hide();
          $("#item_div").hide();
      }

   }
</script> 
   