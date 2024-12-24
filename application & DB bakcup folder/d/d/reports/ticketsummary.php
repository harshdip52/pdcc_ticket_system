<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>reports">Reports</a></li>
    <li class="breadcrumb-item active">Ticket Summary  Reports</li>
  </ol>
  <h1 class="page-header">Ticket Summary  Reports</h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
       
      <?= $this->session->flashdata('message_name'); ?>
      <h4 style="color: white">Ticket Summary  Reports</h4>
    </div> 
      <div class="panel-body">
        

        <div class="row">

          <div class="table-responsive">
            <table id="eventsTable"
              class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
              width="100%">
              <thead>
                <tr>
                  <th width="1%">Node</th> 
                  <th width="1%">New Ticket</th> 
                  <th width="1%">Pending Ticket</th> 
                  <th width="1%">Inprogress  Ticket</th> 
                  <th width="1%">Forwarded Ticket</th> 
                  <th width="1%">Close Ticket</th> 
                  <th width="1%">Queried Ticket</th> 
                  <th width="1%">Total Ticket</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <th>Total</th>
                  <th id="sumNewTicket"></th>
                  <th id="sumPendingTicket"></th>
                  <th id="sumInprogressTicket"></th>                  
                  <th id="sumForwardTicket"></th>
                  <th id="sumClosedTicket"></th>
                  <th id="sumReopenTicket"></th>
                  <th id="sumTotakTicket"></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- end panel-body -->
      </div>
      <div class="panel-heading" style="background-color: #0e6d8c;">
        <div class="panel-heading-btn" style="margin-top: -4px;">
          <input type="button" class="btn btn-sm btn-danger" value="Back" onClick="javascript:history.go(-1)"/>
        </div>
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div>
     
  </div>
</div>

 
</div>
</div>
</div>

 
<script type="text/javascript">
  $(document).ready(function() {
    callDatatable(); 
  });

  function callDatatable() {
    var myTable = $('#eventsTable').DataTable({
      "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
          data;
        var intVal = function(i) {
          return typeof i === 'string' ?
            i.replace(/[\$,]/g, '') * 1 :
            typeof i === 'number' ?
            i : 0;
        };       
        var sumNewTicket = api
          .column(1)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        var sumPendingTicket = api
          .column(2)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        var sumInprogressTicket = api
          .column(3)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        var sumForwardTicket = api
          .column(4)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        var sumClosedTicket = api
          .column(5)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);
        var sumReopenTicket = api
          .column(6)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);
        var sumTotalTickets = api
          .column(7)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);
        // $(api.column(1).footer()).html('Total');
        $(api.column(1).footer()).html(sumNewTicket);
        $(api.column(2).footer()).html(sumPendingTicket);
        $(api.column(3).footer()).html(sumInprogressTicket);
        $(api.column(4).footer()).html(sumForwardTicket);
        $(api.column(5).footer()).html(sumClosedTicket);
        $(api.column(6).footer()).html(sumReopenTicket);
        $(api.column(7).footer()).html(sumTotalTickets);
      },
      "aaSorting": [],
        dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'csv'
    ],
      dom: "Bfrtip",
      "bDestroy": true,
      "autoWidth": true,
      "scrollX": true,
      "ajax": {
        "url": "<?php echo base_url(); ?>reports/getTicketSummery/",
        dataSrc: '',
        
      },
      "pageLength": 10,
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
        { "data": "taluka_name" }, 
        { "data": "newTicket"},
        { "data": "pendingTicket"},
        { "data": "inprogressTicket"}, 
        { "data": "forwardTicket"},   
        { "data": "closeTicket"},   
        { "data": "quiredTicket"},    
        { "data": "totalTicket"}   
         
        
        

      ]
    });
    myTable 
      .draw();
  }
</script>
 
 