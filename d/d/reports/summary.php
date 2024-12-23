 <div class="sidebar-bg hide_in_print"></div>
 <div id="content" class="content">
   <ol class="breadcrumb pull-right">
     <li class="breadcrumb-item "><a href="<?= base_url(); ?>reports">Reports</a></li>
     <li class="breadcrumb-item active">Summary Reports</li>
   </ol>
   <h1 class="page-header">Summary Reports</h1>
   <div class="panel panel-inverse">
     <div class="panel-heading">

       <?= $this->session->flashdata('message_name'); ?>
       <h4 style="color: white">Summary Reports</h4>

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
                 <th width="1%">CPU</th>
                 <th width="1%">Monitor</th>
                 <th width="1%">Printers</th>
                 <th width="1%">Scanners</th>
                 <th width="1%">UPS</th>
                 <th width="1%">Batterys</th>
                 <th width="1%">CCTV</th>
                 <th width="1%">Keyboard</th>
                 <th width="1%">Mouse</th>
                 <th width="1%">Cable & Wire</th>
                 <th width="1%">Cable</th>
                 <th width="1%">Pen drive</th>
                 <th width="1%">Switch</th>
                 <th width="1%">Router</th>
                 <th width="1%">Modem</th>
                 <th width="1%">ATM</th>
                 <th width="1%">RF Connectivity</th>
                 <th width="1%">CBS Software</th>
                 <th width="1%">P2B Software</th>
                 <th width="1%">Bank Email</th>
                 <th width="1%">Board Meeting - Vol</th>
                 <th width="1%">Other Software</th>
                 <th width="1%">Network Problem</th>
                 <th width="1%">Laptop</th>
                 <th width="1%">Ram</th>
                 <th width="1%">HDD/SSD</th>
               </tr>
             </thead>
             <tbody>
             </tbody>
           </table>
         </div>
       </div>
       <!-- end panel-body -->
     </div>
     <!-- <div class="panel-heading" style="background-color: #0e6d8c;">
        <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
      </div> -->

     <div class="panel-heading" style="background-color: #0e6d8c;">
       <div class="panel-heading-btn" style="margin-top: -4px;">

         <!-- <a href="<?= base_url() ?>Inventory/new_itemList_view" class="btn btn-sm btn-danger">Back</a> -->
         <input type="button" class="btn btn-sm btn-danger" value="Back" onClick="javascript:history.go(-1)" />
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
         "url": "<?php echo base_url(); ?>reports/getSummery/",
         dataSrc: '',

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
           "data": "taluka_name"
         },
         {
           "data": "CPU"
         },
         {
           "data": "Monitor"
         },

         {
           "data": "Printers"
         },
         {
           "data": "Scanners"
         },
         {
           "data": "UPS"
         },
         {
           "data": "Batterys"
         },
         {
           "data": "CCTV"
         },
         {
           "data": "Keyboard"
         },
         {
           "data": "Mouse"
         },
         {
           "data": "CableWire"
         },
         {
           "data": "Cable"
         },
         {
           "data": "Pendrive"
         },
         {
           "data": "Switch"
         },
         {
           "data": "Router"
         },
         {
           "data": "Modem"
         },

         {
           "data": "ATM"
         },
         {
           "data": "RFConnectivity"
         },
         {
           "data": "CBSSoftware"
         },
         {
           "data": "P2BSoftware"
         },
         {
           "data": "BankEmail"
         },
         {
           "data": "BoardMeetingVol"
         },
         {
           "data": "OtherSoftware"
         },
         {
           "data": "NetworkProblem"
         },
         {
           "data": "Laptop"
         },
         {
           "data": "Ram"
         },
         {
           "data": "SSD"
         },
       ]
     });
     myTable
       .draw();
   }
 </script>