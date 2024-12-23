<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>reports">Reports</a></li>
    <li class="breadcrumb-item active">Ticket Reports</li>
  </ol>
  <h1 class="page-header">Ticket Reports</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
       
      <?= $this->session->flashdata('message_name'); ?>
      <h4 style="color: white">Ticket Reports</h4>
    </div> 
      <div class="panel-body">
        <div class="row mb-3">
            <div class="col-md-3 input-padd">
            <label>From Date<sup class="text-danger">*</sup></label>
                <input type="date" class="form-control" name="from_date" id="from_date">
            </div>

            <div class="col-md-3 input-padd">
            <label>To Date<sup class="text-danger">*</sup></label>
                <input type="date" class="form-control" name="to_date" id="to_date">
            </div>

            <div class="col-md-3 input-padd">
            Category
            <select class="form-select from-font" id="cat_id" name="cat_id" required="" onchange="getSubCategory(this.value)">
            </select>
          </div>
          <div class="col-md-3 input-padd">
            <label>Sub Category<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="sub_cat_id" name="sub_cat_id" required="">
            </select>
          </div>
          <div class="col-md-3 input-padd">
            <label>Taluka<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" onchange="getZone(this.value)" name="taluka_id" id="taluka_id">
            </select> 
          </div>
          
          <div class="col-md-3 input-padd">
            <label>Zone<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" required="" name="zone_id" id="zone_id" onchange="getBranch(this.value)">
            </select>
          </div>
          <div class="col-md-3 input-padd">
            <label>Branch<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="branch_id" name="branch_id" required="">
            </select> 
          </div>
          <div class="col-md-2 input-padd">
            <label>Status<sup class="text-danger">*</sup></label>
            <select class="form-select from-font" id="status" name="status" required="">
                <option value=""selected>Select Status</option>
                <option value="New">New</option>
                <option value="Inprogress">Inprogress</option>
                <option value="Forwarded">Forwarded</option>
                <option value="Resolved">Resolved</option>
                <!-- <option value="Pending">Pending</option> -->
            </select> 
          </div>

          <div class="col-md-1 input-padd">
          <label>&nbsp;</label>
          <button class="btn btn-info panel-title" id="search" name="search" onclick="SearchData()">Search</button>
          
          </div>

           
        </div>

        <div class="row">

          <div class="table-responsive">
            <table id="eventsTable"
              class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
              width="100%">
              <thead>
              <tr>
                <th width="1%">Sr. No.</th>
                
                <th class="text-nowrap">Taluka</th>
                <th class="text-nowrap">Zone</th>
                <th class="text-nowrap">Branch</th>
                <th class="text-nowrap">Category</th>
                <th class="text-nowrap">Sub Category</th>
                <th class="text-nowrap">Brand Name</th>
                <th class="text-nowrap">Ticket id</th>
                <th class="text-nowrap">Assign to</th>
                <th class="text-nowrap">Ticket Title</th>
                <th class="text-nowrap">Ticket Description</th>
                <th class="text-nowrap">Date</th> 
                <th class="text-nowrap">Created By</th> 
                <th class="text-nowrap">Status</th> 
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
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
     
  </div>
</div>

 
</div>
</div>
</div>

 
<script type="text/javascript">
  $(document).ready(function() {
    getAllTalukaList();
    getAllCategoryList();

    var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        var cat_id=$('#cat_id').val();
        var sub_cat_id=$('#sub_cat_id').val();
        var taluka_id=$('#taluka_id').val();
        var zone_id=$('#zone_id').val();
        var branch_id=$('#branch_id').val();
        var status=$('#status').val();
        callDatatable(from_date, to_date, cat_id, sub_cat_id,taluka_id,zone_id,branch_id,status)
    // getStatus(); 
  });

  function callDatatable(from_date, to_date, cat_id, sub_cat_id,taluka_id,zone_id,branch_id,status) {
    var myTable = $('#eventsTable').DataTable({

        dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ],
      dom: "Bfrtip",
      "bDestroy": true,
      "autoWidth": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>Reports/getTicketReports/",
        dataSrc: '',
        dataType:"JSON",
        type: "POST",
        data: 
        {
            from_date: from_date,
            to_date: to_date,  
            cat_id: cat_id, 
            sub_cat_id: sub_cat_id, 
            taluka_id: taluka_id, 
            zone_id: zone_id, 
            branch_id: branch_id, 
            status: status, 
        }
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
      "columns": [
        {
                    "data": "ticket_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                
                {"data": "taluka_name"},
                {"data": "zone_name"},
                {"data": "branch_name"},
                {"data": "cat_name"},
                {"data": "sub_cat_name"},
                {"data": "brand_name"},
                {"data": "ticket_no"},
                {"data": "name"},
                {"data": "ticket_title"},
                {"data": "description"},
                { data: "created_on", render: $.fn.dataTable.render.moment( 'DD-MM-YYYY' ) },   
                {"data": "created_by_name"}, 
                {"data": "status"}  
        
        

      ]
    });
    myTable
      .order([0, 'asc'])
      .draw();
  }
</script>
<script>

  
 
</script>
 

<script>
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

     function getZone(taluka_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+taluka_id, function (data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Zone --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend); 
    });
    }
    function getBranch(zone_id) 
    {
      $.getJSON("<?php echo base_url();?>Ajax/getBranchAjaxNew/"+zone_id, function (data) 
      {
        var stringToAppend = "<option disabled selected value=''>-- Select Branch --</option> ";
        $.each(data, function (key, val)
        {
          stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
        });
        $("#branch_id").html(stringToAppend);
      });
    }

    // function getStatus() 
    // {
    //   $.getJSON("<?php echo base_url();?>Ajax/getStatus/", function (data) 
    //   {
    //     var stringToAppend = "<option disabled selected value=''>-- Select Status --</option> ";
    //     $.each(data, function (key, val)
    //     {
    //       stringToAppend += "<option value='" + val.id + "'>" + val.status_name + "</option>";
    //     });
    //     $("#status").html(stringToAppend);
    //   });
    // }

    

</script>
<script>
      function  SearchData()
      {
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        var cat_id=$('#cat_id').val();
        var sub_cat_id=$('#sub_cat_id').val();
        var taluka_id=$('#taluka_id').val();
        var zone_id=$('#zone_id').val();
        var branch_id=$('#branch_id').val();
        var status=$('#status').val();
        callDatatable(from_date, to_date, cat_id, sub_cat_id,taluka_id,zone_id,branch_id,status)
      }
      </script>