<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content"> 
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url();?>admin"> Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url();?>admin/ticketDashboard">Ticket Dashboard</a></li>
    <li class="breadcrumb-item active">Total Ticket </li>
  </ol> 
          <h1 class="page-header">Total Ticket</h1>  
          <div class="panel panel-inverse"> 
            <div class="panel-heading">
              <h4 class="panel-title">Total Ticket List</h4>
            </div> 
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-3">
                    <select class="form-control taluka_id_Sel" id="taluka_id_Sel" name="taluka_id_Sel">                  
                    </select>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control ticket_status_value" id="ticket_status_value" name="ticket_status_value">
                      <option value="">Select Ticket Status</option> 
                      <?php foreach(ticketStatusList() as $key => $status){?>
                        <option value="<?php echo $status;?>"><?php echo $status;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-md-3">
                   <input type="submit" class="btn btn-sm btn-info getDataTalukaStatusWise" id="getDataTalukaStatusWise" value="Show" />
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
                            <th class="text-nowrap">Assign to</th>
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

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="ticket_id" name="ticket_id" class="form-control">
                            <textarea name="reminder" id="reminder"class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"onclick="Remaider()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
  <script type="text/javascript">
    $(document).ready(function () 
    {
      loader();

      getAllTalukaList();
     
      var role="<?php echo $login_role = $this->session->userdata('login_role'); ?>";
      var zone_id="<?php echo $zone = $this->session->userdata('login_zone_id'); ?>";
      var taluka_id="<?php echo $taluka_id = $this->session->userdata('login_taluka_id'); ?>";
      var branch_id="<?php echo $taluka_id = $this->session->userdata('login_branch_id'); ?>";

      
     /* if(role==2)
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
      } */
      // callDatatable(taluka_id,zone_id,branch_id)
      callDatatable(taluka_id="",status="")

      $("#getDataTalukaStatusWise").on("click",function(){
        var taluka_id_Sel       = $("#taluka_id_Sel").val();
        var ticket_status_value = $("#ticket_status_value").val();
        // if(taluka_id_Sel != '' && ticket_status_value != ''){
          callDatatable(taluka_id_Sel,ticket_status_value);
        // }
      })
    });

    // function callDatatable(taluka_id,zone_id,branch_id)
    function callDatatable(taluka_id,status)
    {  
      loader();

        var myTable = $('#eventsTable').DataTable({
            dom: "Bfrtip",
            "bDestroy": true,
            "autoWidth": true,
            "scrollX": true,
            "ajax": 
            {
                "url": "<?php echo base_url();?>Ajax/getTicketListwithIdsNew/",
                dataSrc: '',
                dataType:"JSON",
                type: "POST",
                data: 
                {
                    taluka_id: taluka_id,
                    status: status,
                    // branch_id: branch_id
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
                {"data": "ticket_priority"} ,
                
                {
                    "data": "ticket_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (type === 'display') 
                        {
                            data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url();?>admin/ticketView/' + data + '">View / Reply</a>  ';
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
      var stringToAppend = "<option value=''>-- Select Taluka --</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.taluka_id + "'>" + val.taluka_name + "</option>";
      });
      $("#taluka_id").html(stringToAppend); 
      $("#taluka_id_Sel").html(stringToAppend); 
    });
    }


function SearchVal() 
{
  var taluka_id = $("#taluka_id").val();
  var branch_id = $("#branch_id").val();
  var zone_id = $("#zone_id").val(); 
  callDatatable(taluka_id,zone_id,branch_id);
}

 function OnReminder(ticket_id) 
    {
         $("#ticket_id").val(ticket_id); 
    }

     function Remaider() {
        
        var ticket_id=$("#ticket_id").val(); 
        var reminder=$("#reminder").val();

        var allfields = true;

        if (reminder == "" || reminder== null) 
        {
          if ($("#reminder").next(".validation").length == 0) // only add if not added
          {
            $("#reminder").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
          }
          if (!focusSet) { $("#reminder").focus(); }
          allfields = false;
        } 
        else 
        {
          $("#reminder").next(".validation").remove(); // remove it
        }


if (allfields) 
    {
        var result = confirm("Are you sure want to send Reminder ?");
        if (result) {
            var formData = {
                ticket_id: ticket_id,
                reminder: reminder, 
            };
            $.ajax({
                url: "<?php echo base_url();?>Ajax/addReminder/",
                type: "POST",
                data: formData,
                success: function (data, textStatus, jqXHR) 
                {
                
                var myObject = JSON.parse( data );
                  

                     $('#exampleModal').modal('toggle');
                    alert('Reminder Added');
                    callDatatable();
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

    }

    }

</script>