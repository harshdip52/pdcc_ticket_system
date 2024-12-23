<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin"> Dashboard</a></li>
    <li class="breadcrumb-item active">Ticket Dashboard </li>
  </ol>
  <?php if ($this->session->flashdata()): ?>
    <div class="flashData" id="flashData">
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('error') ?>
        </div>
      <?php endif ?>
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success') ?>
        </div>
      <?php endif ?>
    </div>
  <?php endif ?>
  <h1 class="page-header">Ticket Dashboard</h1>

  <div class="row">
    <?php $login_role = $this->session->userdata('login_role'); ?>

    <?php //if ($login_role == 1) { 
    // echo $login_role;die;
     if (in_array(trim($login_role), admin_permission())) {?>

      <!-- this block Display only Branch manager And Help Desk -->

      <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-grey-darker">
          <div class="stats-icon"><i class="fa fa-user"></i></div>
          <div class="stats-info">
            <h4> Ticket Title</h4>
          </div>
          <div class="stats-link">
            <a href="<?= base_url() ?>admin/masterTitle">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
      </div>
    <?php } ?>


    <?php if ($login_role == 3 || $login_role == 4) { ?>

      <!-- this block Display only Branch manager And Help Desk -->

      <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-grey-darker">
          <div class="stats-icon"><i class="fa fa-user"></i></div>
          <div class="stats-info">
            <h4>Create Ticket</h4>
          </div>
          <div class="stats-link">
            <a href="<?= base_url() ?>admin/newTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
      </div>
    <?php } ?>

    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>All Ticket</h4>
          <h4><?= $total['totalTicket'] ?></h4>

        </div>
        <div class="stats-link">
          <a href="<?= base_url() ?>admin/totalTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-gradient-black">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>New Tickets</h4>
          <h4><?= $todaytotalticket['todaytotalticket'] ?></h4>
        </div>
        <div class="stats-link">
          <a href="<?= base_url() ?>admin/todaysTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>Inprogres Ticket</h4>
          <h4><?= $Inprogresstotalticket['Inprogresstotalticket'] ?></h4>
        </div>

        <div class="stats-link">
          <a href="<?= base_url() ?>admin/inprogresTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>Pending Ticket</h4>
          <h4><?= $Pendingtotalticket['Pendingtotalticket'] ?></h4>
        </div>

        <div class="stats-link">
          <a href="<?= base_url() ?>admin/pendingTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>Closed Ticket</h4>
          <h4><?= $Closetotalticket['Closetotalticket'] ?></h4>
        </div>

        <div class="stats-link">
          <a href="<?= base_url() ?>admin/closedTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>Reopen Ticket</h4>
          <h4><?= $Queriedticket['Queriedticket'] ?></h4>
        </div>

        <div class="stats-link">
          <!-- <a href="<?= base_url() ?>admin/closedTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a> -->
          <a href="<?= base_url() ?>admin/reopenTickets">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="widget widget-stats bg-grey-darker">
        <div class="stats-icon"><i class="fa fa-user"></i></div>
        <div class="stats-info">
          <h4>Forwarded Ticket</h4>
          <h4><?= $Forwardedticket['Forwardedticket'] ?></h4>
        </div>

        <div class="stats-link">
          <a href="<?= base_url() ?>admin/forwardedTicket">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
      </div>
    </div>

    <?php if ($login_role == 4) { ?>
      <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-gradient-black">
          <div class="stats-icon"><i class="fa fa-book"></i></div>
          <div class="stats-info">
            <h4>Call Connected Transfer</h4>
          </div>
          <div class="stats-link">
            <a href="<?= base_url() ?>admin/call_log_master">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
      </div>
    <?php } ?>


  </div>
  <hr style="color: black; background: black; height: 3px;">
  <div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
      <h4 class="panel-title">Total Ticket List</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3">
          <label for="cars">Select Taluka</label>
          <select class="form-select from-font" onchange="getZone(this.value)" required="" name="taluka_id" id="taluka_id">
          </select>
        </div>
        <div class="col-md-2">

          <label for="cars">Select Zone</label>
          <select class="form-select from-font" required="" name="zone_id" id="zone_id" onchange="getBranch(this.value)">
          </select>
        </div>
        <div class="col-md-2">
          <label for="cars">Select Branch</label>
          <select class="form-select from-font" id="branch_id" name="branch_id" required="">
          </select>
        </div>
        <div class="col-md-2">
          <label for="cars">Select Date</label>
          <input type="date" id="sel_date" name="sel_date" class="form-control input-sm sel_date" />
        </div>
        <div class="col-md-2">
          <br>
          <button class="btn btn-info" onclick="SearchVal()">Search</button>
        </div>


      </div>
    </div>
    <br>

    <div class="table-responsive">
      <table id="eventsTable"
        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
        width="100%">
        <thead>
          <tr>
            <th width="1%">Sr. No.</th>
            <th class="text-nowrap">Ticket id</th>
            <th class="text-nowrap">Assigned to</th>
            <th class="text-nowrap">Taluka</th>
            <th class="text-nowrap">Zone</th>
            <th class="text-nowrap">Branch</th>
            <th class="text-nowrap">Ticket Title</th>
            <th class="text-nowrap">Date</th>
            <th class="text-nowrap">Close Date</th>
            <th class="text-nowrap">Status</th>
            <th class="text-nowrap">Ticket Priority</th>
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
<!-- end row -->
<script type="text/javascript">
  // $(document).ready(function () 
  // {
  //   getAllTalukaList(); 

  //    var role="<?php echo $login_role = $this->session->userdata('login_role'); ?>";
  //   var zone_id="<?php echo $zone = $this->session->userdata('login_zone_id'); ?>";
  //   var taluka_id="<?php echo $taluka_id = $this->session->userdata('login_taluka_id'); ?>";
  //   var branch_id="<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";

  //   if(role=2)
  //   {
  //     $("taluka_id").val('taluka_id');
  //     $("#taluka_id").attr("disabled","disabled");
  //     getZone(taluka_id) 
  //     setTimeout(function()
  //     {
  //       $('#zone_id').val(zone_id);
  //       $("#zone_id").attr("disabled","disabled");
  //     }, 500);

  //     setTimeout(function()
  //     {
  //       getBranch(zone_id)
  //     }, 500);
  //   }

  //   if(role=3)
  //   {
  //     $("taluka_id").val('taluka_id');
  //     $("#taluka_id").attr("disabled","disabled");
  //     getZone(taluka_id) 
  //     setTimeout(function()
  //     {
  //       $('#zone_id').val(zone_id);
  //       $("#zone_id").attr("disabled","disabled");
  //     }, 500);

  //     setTimeout(function()
  //     {
  //       getBranch(zone_id)
  //     }, 500);

  //     setTimeout(function()
  //     {
  //       $('#branch_id').val(branch_id);
  //       $("#branch_id").attr("disabled","disabled");
  //     }, 500);
  //   }

  //     var taluka_id =0;
  //     var branch_id =0;
  //     var zone_id =0; 
  //     callDatatable(taluka_id,zone_id,branch_id);
  // });

  $(document).ready(function() {
    loader();
    var timeout = 3000;
    $('#flashData').delay(timeout).fadeOut(400);

    getAllTalukaList();

    var role = "<?php echo $login_role = $this->session->userdata('login_role'); ?>";
    var zone_id = "<?php echo $zone = $this->session->userdata('login_zone_id'); ?>";
    var taluka_id = "<?php echo $taluka_id = $this->session->userdata('login_taluka_id'); ?>";
    var branch_id = "<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";

    if (role == 2) {
      $("taluka_id").val('taluka_id');
      $("#taluka_id").attr("disabled", "disabled");
      getZone(taluka_id)
      setTimeout(function() {
        $('#zone_id').val(zone_id);
        $("#zone_id").attr("disabled", "disabled");
      }, 500);

      setTimeout(function() {
        getBranch(zone_id)
      }, 500);
    }

    if (role == 3) {
      $("taluka_id").val('taluka_id');
      $("#taluka_id").attr("disabled", "disabled");
      getZone(taluka_id)
      setTimeout(function() {
        $('#zone_id').val(zone_id);
        $("#zone_id").attr("disabled", "disabled");
      }, 500);

      setTimeout(function() {
        getBranch(zone_id)
      }, 500);

      setTimeout(function() {
        $('#branch_id').val(branch_id);
        $("#branch_id").attr("disabled", "disabled");
      }, 500);
    }

    // callDatatable(taluka_id, zone_id, branch_id,sel_date="")

  });


  function callDatatable(taluka_id, zone_id, branch_id,sel_date) {
    loader();
    var myTable = $('#eventsTable').DataTable({
      dom: "Bfrtip",
      "bDestroy": true,
      "autoWidth": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>Ajax/getTicketListwithIds/",
        dataSrc: '',
        dataType: "JSON",
        type: "POST",
        data: {
          taluka_id: taluka_id,
          zone_id: zone_id,
          branch_id: branch_id,
          sel_date: sel_date,
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
      }, 'colvis'],
      "columns": [{
          "data": "ticket_id",
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {
          "data": "ticket_no"
        },
        {
          "data": "name",
          render:function(data,type,row){
              return row.name.toUpperCase();
          }
        },
        {
          "data": "taluka_name",
          render:function(data,type,row){
              return row.taluka_name.toUpperCase();
          }
          
        },

        {
          "data": "zone_name",
          render:function(data,type,row){
              return row.zone_name.toUpperCase();
          }          
          
        },
        {
          "data": "branch_name",
          render:function(data,type,row){
              return row.branch_name.toUpperCase();
          }           
          
        },
        {
          "data": "ticket_title",
          render:function(data,type,row){
              return row.ticket_title.toUpperCase();
          }
        },
        {
          data: "created_on",
          render: $.fn.dataTable.render.moment('DD-MM-YYYY')
        },
        {"data": "status",
                    "render": function ( data, type, row ){
                        if(row["status"] == "Resolved"){
                            return row['updated_on'];
                        }else{
                            return '';
                        }
                    },
                 },
        {
          "data": "status"
        },
        {
          "data": "ticket_priority"
        },
        {
          "data": "ticket_id",
          "render": function(data, type, row, meta) {
            if (type === 'display') {
              data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url(); ?>admin/ticketView/' + data + '">View / Reply</a>';
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



<script type="text/javascript">
  <?php if ($login_role == 1 || $login_role == 2 || $login_role == 4) { ?>
    var SelectVal = "selected";
  <?php } ?>
  <?php if ($login_role == 3 || $login_role == 8) { ?>
    var SelectVal = "";
  <?php } ?>


  function getBranch(zone_id) {
    // $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjax/" + zone_id, function(data) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjaxFotTicketDashboard/" + zone_id, function(data) {
      // var stringToAppend = "<option disabled " + SelectVal + " value=''>-- Select Branch --</option> ";
      var stringToAppend = "<option  value=''>-- Select Branch --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
      });
      $("#branch_id").html(stringToAppend);
    });
  }

  function getZone(taluka_id) {
    $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/" + taluka_id, function(data) {
      // var stringToAppend = "<option disabled " + SelectVal + " value=''>-- Select Zone --</option> ";
      var stringToAppend = "<option  value=''>-- Select Zone --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend);
    });
  }

  function getAllTalukaList() {
    $.getJSON("<?php echo base_url(); ?>Ajax/getAllTalukaList/", function(data) {
      // var stringToAppend = "<option disabled " + SelectVal + " value=''>-- Select Taluka --</option> ";
      var stringToAppend = "<option  value=''>-- Select Taluka --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
      });
      $("#taluka_id").html(stringToAppend);
    });
  }
</script>

<script type="text/javascript">
  function SearchVal() {
    var taluka_id = $("#taluka_id").val();
    var branch_id = $("#branch_id").val();
    var zone_id = $("#zone_id").val();
    var sel_date = $("#sel_date").val();
    callDatatable(taluka_id, zone_id, branch_id,sel_date);
    // body...
  }
</script>