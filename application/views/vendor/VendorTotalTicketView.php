<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content"> 
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Vendor Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url();?>Vendor/VendorDashboard">Ticket Dashboard</a></li>
    <li class="breadcrumb-item active">Total Ticket </li>
  </ol> 
  <h1 class="page-header">Total Ticket</h1>
  <div class="panel panel-inverse"> 
    <div class="panel-heading">
      <h4 class="panel-title">Total Ticket List</h4>
    </div> 
    <div class="panel-body">
      <div class="table-responsive">
        <table id="eventsTable"
            class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th width="1%">Sr. No.</th>
                     <th class="text-nowrap">Ticket id</th>
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
</div>
<script type="text/javascript">
  $(document).ready(function () 
  { 
    callDatatable()
  });
  function callDatatable()
  { 
    var myTable = $('#eventsTable').DataTable({
    dom: "Bfrtip",
    "bDestroy": true,
    "autoWidth": true,
    "scrollX": true,
    "ajax":
    {
      "url": "<?php echo base_url();?>Vendor/getTotalTicket/",
      dataSrc: '',
      dataType:"JSON",
      type: "POST",
    },
    "pageLength": 10,
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
    "columns": 
    [
    {
      "data": "ticket_id",
      render: function (data, type, row, meta) 
      {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    }, 
    {"data": "ticket_no"},
    {"data": "taluka_name"},
    {"data": "zone_name"},
    {"data": "branch_name"},
    {"data": "ticket_title"},
     { data: "created_on", render: $.fn.dataTable.render.moment( 'DD-MM-YYYY' ) },
     {"data": "status",
                    "render": function ( data, type, row ){
                        if(row["status"] == "Resolved"){
                            return row['updated_on'];
                        }else{
                            return '';
                        }
                    },
                 },
    {"data": "status"} ,
    {
      "data": "ticket_priority"
    },
    {"data": "ticket_id",
      "render": function (data, type, row, meta) 
      {
        if (type === 'display') 
        {
          data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url();?>Vendor/ticketReply/' + data + '">View / Reply</a>';
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
 