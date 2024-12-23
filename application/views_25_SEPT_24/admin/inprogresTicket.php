<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content"> 
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url();?>admin"> Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url();?>admin/ticketDashboard">Ticket Dashboard</a></li>
    <li class="breadcrumb-item active">Inprogress Ticket </li>
  </ol>  
          <h1 class="page-header">Inprogress Ticket</h1>  
          <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
              <h4 class="panel-title">Inprogress Ticket List</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
               <br>
              
              <div class="table-responsive">
                <table id="eventsTable"
                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Tocket id</th>
                            <th class="text-nowrap">assign to</th>
                            <th class="text-nowrap">Taluka</th>
                            <th class="text-nowrap">Zone</th>
                            <th class="text-nowrap">Branch</th>
                            <th class="text-nowrap">Ticket Title</th>
                            <th class="text-nowrap">Date</th>
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
 
    $(document).ready(function () 
    {
      loader();
      getAllTalukaList();
     
      var role="<?php echo $login_role = $this->session->userdata('login_role'); ?>";
      var zone_id="<?php echo $zone = $this->session->userdata('login_zone_id'); ?>";
      var taluka_id="<?php echo $taluka_id = $this->session->userdata('login_taluka_id'); ?>";
      var branch_id="<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";
      
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
      
      
// var taluka_id1 =0;
//         var branch_id1 =0;
//         var zone_id1 =0; 
        callDatatable(taluka_id,zone_id,branch_id)

    });


    function callDatatable(taluka_id,zone_id,branch_id)
    {  
      loader();
      // var status=''
        var myTable = $('#eventsTable').DataTable({
            dom: "Bfrtip",
            "bDestroy": true,
            "autoWidth": true,
            "scrollX": true,
            "ajax": 
            {
                "url": "<?php echo base_url();?>Ajax/inprogressTickets/",
                dataSrc: '',
                dataType:"JSON",
                type: "POST",
                data: 
                {
                    taluka_id: taluka_id,
                    zone_id: zone_id,
                    branch_id: branch_id
                  }
            },
            "pageLength": 25,
            buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'print',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                ]
                } , 'colvis'
                ],
                "columns": [
                {
                    "data": "ticket_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                {"data": "ticket_no"},
                {"data": "name"},
                {"data": "taluka_name"},
                
                {"data": "zone_name"},
                {"data": "branch_name"},
                {"data": "ticket_title"},
                { data: "created_on", render: $.fn.dataTable.render.moment( 'DD-MM-YYYY' ) },
                {"data": "status"} ,
                {"data": "ticket_priority"} ,
                {
                    "data": "ticket_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (type === 'display') 
                        {
                            data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url();?>admin/ticketView/' + data + '">View / Reply</a> ';
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
      function getBranch(zone_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getBranchAjax/"+zone_id, function (data) {
      var stringToAppend = "<option disabled  value=''>-- Select Branch --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
      });
      $("#branch_id").html(stringToAppend); 
    });
    }

    function getZone(taluka_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+taluka_id, function (data) {
      var stringToAppend = "<option disabled  value=''>-- Select Zone --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend); 
    });
    }



    function getAllTalukaList() 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getAllTalukaList/", function (data) {
      var stringToAppend = "<option disabled  value=''>-- Select Taluka --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
      });
      $("#taluka_id").html(stringToAppend); 
    });
    }


function SearchVal() {
   var taluka_id = $("#taluka_id").val();
        var branch_id = $("#branch_id").val();
        var zone_id = $("#zone_id").val(); 
        callDatatable(taluka_id,zone_id,branch_id);
  // body...
}


</script>