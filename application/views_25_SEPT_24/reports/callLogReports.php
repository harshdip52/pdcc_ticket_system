<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>reports">Reports</a></li>
    <li class="breadcrumb-item active">Call Log Reports</li>
  </ol>
  <h1 class="page-header">Call Log Reports</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
       
      <?= $this->session->flashdata('message_name'); ?>
      <h4 style="color: white">Call Log Reports</h4>
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
                <th class="text-nowrap">Call from</th> 
                <th class="text-nowrap">Call To</th> 
                <th class="text-nowrap">Call Comments</th> 
                <th class="text-nowrap">Date Time</th>  
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
    var from_date=$('#from_date').val();
        var to_date=$('#to_date').val(); 
        callDatatable(from_date, to_date)
  });

  function callDatatable(from_date, to_date) {
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
        "url": "<?php echo base_url(); ?>Reports/getcallLogReports/",
        dataSrc: '',
        dataType:"JSON",
        type: "POST",
        data: 
        {
            from_date: from_date,
            to_date: to_date 
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
            "data": "id",
            render: function (data, type, row, meta) 
            {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
            }, 
            {"data": "call_from"},
            {"data": "call_to"},
            {"data": "description"},
            {"data": "created_at"},  
        
        

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
      function  SearchData()
      {
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val(); 
        callDatatable(from_date, to_date)
      }
      </script>