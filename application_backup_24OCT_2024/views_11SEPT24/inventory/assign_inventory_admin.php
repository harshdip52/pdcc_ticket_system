<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory"> Inventory Dashboard</a></li>
    <li class="breadcrumb-item active">Inventory Details</li>
  </ol>
  <h1 class="page-header">Inventory Details</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <a href="<?php echo  base_url() ?>Inventory/create_inventory" class="btn btn-info panel-title">Add Inventory</a>
      </div>
      <?= $this->session->flashdata('message_name'); ?>
      <h4 style="color: white">Assign Inventory</h4>
    </div>
    <form method="post" action="<?= base_url() ?>Inventory/assign_inventory" id="assign_inventory">
      <div class="panel-body">
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-1 col-form-label">Taluka <sup class="text-danger">*</sup></label>
          <div class="col-sm-3">
            <select class="form-select from-font" onchange="getZone(this.value)" required="" name="taluka_id" id="taluka_id">
              <option selected disabled="" value="">--select Taluka--</option>
              <?php foreach ($AllTaluka as $key => $Taluka) { ?>
                <option value="<?= $Taluka['taluka_id'] ?>"><?= $Taluka['taluka_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <label for="inputEmail3" class="col-sm-1 col-form-label">Zone <sup class="text-danger">*</sup></label>
          <div class="col-sm-3" id="user_id_div">
            <select class="form-select from-font" required="" name="zone_id" id="zone_id" onchange="getBranch(this.value)">
            </select>
          </div>
          <label for="inputEmail3" class="col-sm-1 col-form-label">Branch <sup class="text-danger">*</sup></label>
          <div class="col-sm-3" id="user_id_div">
            <select class="form-select from-font" id="branch_id" name="branch_id" required="">
            </select>
          </div>
        </div>

        <div class="row">

          <div class="table-responsive">
            <table id="eventsTable"
              class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th width="1%">Select</th>
                  <th class="text-nowrap">Item / Model name</th>
                  <th class="text-nowrap">Brand</th>
                  <th class="text-nowrap">Category</th>
                  <th class="text-nowrap">Sub-Category</th>
                  <th class="text-nowrap">Serial No.</th>
                  <th class="text-nowrap">PO date.</th>
                  <th class="text-nowrap">Po No.</th>
                  <th class="text-nowrap">Supplier Name</th>
                  <th class="text-nowrap">Warranty Period</th>
                  <th class="text-nowrap">Make Date</th>
                  <th class="text-nowrap">Expiry Date</th>
                  <th class="text-nowrap">Status</th>
                  <th class="text-nowrap">Action</th>


                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <!-- <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a> -->
          
          <input type="submit" class="btn btn-success btn-sm text-white" id="btnsubmitdata" value="Submit" />
          <a href="<?= base_url(); ?>Inventory" class="btn btn-sm btn-danger">Cancel</a>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Dead Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idnew" name="idnew" class="form-control">
        <select name="status" id="status" class="form-control">
          <option selected value="" disabled>Select Option</option>
          <option value="3">Movement Stock</option>
          <option value="4">Dead Stock</option>
        </select><br>
        <textarea name="reasone" id="reasone" class="form-control">NA</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="DeadStock()">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<script>
  function getBranch(zone_id) {
    // $("#zone_id").empty();
    $.ajax({
      url: "<?php echo base_url(); ?>Inventory/getBranchAjax/", //the page containing php script
      type: "POST",
      dataType: 'json',
      data: {
        zone_id: zone_id
      },
      success: function(data) {
        var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
        $.each(data, function(key, val) {
          stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
        });

        $("#branch_id").html(stringToAppend);
      }
    });
  }

  function getZone(taluka_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/" + taluka_id, function(data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend);
    });
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    loader();
    callDatatable();
  });

  function callDatatable(taluka_id, branch_id, zone_id, brand_id, cat_id, sub_cat_id) {
    loader();
    var myTable = $('#eventsTable').DataTable({
      dom: "Bfrtip",
      "bDestroy": true,
      "autoWidth": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>Ajax/getInventoryForAssign/",
        dataSrc: '',
        // dataType:"JSON",
        // type: "POST",
        // data: 
        // {
        //     taluka_id: taluka_id,
        //     branch_id: branch_id, 
        //     zone_id: zone_id, 
        //     brand_id: brand_id, 
        //     cat_id: cat_id, 
        //     sub_cat_id: sub_cat_id, 
        // }
      },
      "pageLength": 25,
      buttons: [{
        extend: 'collection',
        text: 'Export',
        buttons: [{
            extend: 'copyHtml5',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
          {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
          {
            extend: 'print',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
        ]
      }, ],
      "columns": [{
          "data": "id",
          "render": function(data, type, row, meta) {
            if (type === 'display') {
              data = '<input type="checkbox" id="id" name="id[]" value="' + data + '">';
            }
            return data;
          }
        },
        {
          "data": "item_name"
        },
        {
          "data": "brand_name"
        },
        {
          "data": "cat_name"
        },
        {
          "data": "sub_cat_name"
        },
        {
          "data": "serial_no"
        },
        {
          "data": "po_date"
        },
        {
          "data": "po_no"
        },
        {
          "data": "supplier_name"
        },
        {
          "data": "warranty"
        },
        {
          data: "make_date",
          render: $.fn.dataTable.render.moment('DD-MM-YYYY')
        },
        {
          data: "exp_date",
          render: $.fn.dataTable.render.moment('DD-MM-YYYY')
        },
        {
          "data": "status_name"
        },
        {
          "data": "id",
          "render": function(data, type, row, meta) {
            if (type === 'display') {
              data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url(); ?>Inventory/new_item_view/' + data + '">View</a> <a type="button" class="btn btn-success btn-sm" href="<?= base_url(); ?>Inventory/edit_inventory/' + data + '">Edit</a> <button type="button" onclick="deleteData(' + data + ');"  class="btn btn-danger btn-sm">Delete </button> ';
            }
            return data;
          }
        }

      ]
    });
    myTable
      .order([0, 'desc'])
      .draw();
  }
</script>
<script>
  // function getBranch(taluka_id) 
  // { 
  // $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjax/"+taluka_id, function (data) {
  //   var stringToAppend = "<option disabled selected value=''>--Branch--</option> ";
  //   $.each(data, function (key, val) 
  //   {
  //     stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
  //   });
  //   $("#branch_id").html(stringToAppend); 
  // });
  // }

  function getZone(branch_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/" + branch_id, function(data) {
      var stringToAppend = "<option disabled selected value=''>--Zone--</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend);
    });
  }

  function getSubCategory(cat_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getSubCategoryAjax/" + cat_id, function(data) {
      var stringToAppend = "<option disabled selected value=''> --Sub Category-- </option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
      });
      $("#sub_cat_id").html(stringToAppend);
    });
  }

  function getValue() {
    var taluka_id = $('#taluka_id :selected').val();
    var branch_id = $('#branch_id :selected').val();
    var zone_id = $('#zone_id :selected').val();
    var brand_id = $('#brand_id :selected').val();
    var cat_id = $('#cat_id :selected').val();
    var sub_cat_id = $('#sub_cat_id :selected').val();

    callDatatable(taluka_id, branch_id, zone_id, brand_id, cat_id, sub_cat_id);

  }

  function DeadStock() {
    var result = confirm("Are you sure  want to add in dead stock ?");
    var id = $("#idnew").val();
    var status = $("#status").val();
    var reasone = $("#reasone").val();
    if (result) {
      var formData = {
        id: id,
        status: status,
        reasone: reasone,
      };
      $.ajax({
        url: "<?php echo base_url(); ?>Ajax/deadStock/",
        type: "POST",
        data: formData,
        success: function(data, textStatus, jqXHR) {
          $('#exampleModal').modal('toggle');
          alert('Table Updated');
          callDatatable();
        },
        error: function(jqXHR, textStatus, errorThrown) {

        }
      });
    }

  }

  function deleteData(id) {
    var result = confirm("Are you sure to deleted it ?");
    if (result) {
      $.ajax({
        url: "<?php echo base_url(); ?>Inventory/deleteInventory/" + id,
        success: function(data, textStatus, jqXHR) {
          alert('Deleted');
          callDatatable();
        },
        error: function(jqXHR, textStatus, errorThrown) {

        }
      });
    }
  }


  function DeadStock1(id) {
    $("#idnew").val(id);
  }
</script>

<script type="text/javascript">
  $('#btnsubmitdata').click(function(e) {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;
    
    var searchIDs = $('input:checked').map(function() {
      return $(this).val();
    });
    var myid = searchIDs.get();
    
    if (myid.length == 0) {
      alert('Plese select atleast one item');
      allfields = false;
    }
    
    var taluka_id = $("#taluka_id").val();
    if (taluka_id == "" || taluka_id == null) {
      if ($("#taluka_id").next(".validation").length == 0) // only add if not added
      {
        $("#taluka_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#taluka_id").focus();
      }
      allfields = false;
    } else {
      $("#taluka_id").next(".validation").remove(); // remove it
    }
    
    var zone_id = $("#zone_id").val();
    if (zone_id == "" || zone_id == null) {
      if ($("#zone_id").next(".validation").length == 0) // only add if not added
      {
        $("#zone_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#zone_id").focus();
      }
      allfields = false;
    } else {
      $("#zone_id").next(".validation").remove(); // remove it
    }

    var branch_id = $("#branch_id").val();
    if (branch_id == "" || branch_id == null) {
      if ($("#branch_id").next(".validation").length == 0) // only add if not added
      {
        $("#branch_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#branch_id").focus();
      }
      allfields = false;
    } else {
      $("#branch_id").next(".validation").remove(); // remove it
    }
    if (allfields) {
      alert("Please submit");
      $('#assign_inventory').submit();
    } else {
      return false;
    }
  });
</script>