<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">

    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item active">Taluka List</li>
    </ol>
 
    <h1 class="page-header">Taluka Details</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn" >
                <a href="<?php echo  base_url()?>admin/add_taluka"class="btn btn-info panel-title"  >Add Taluka</a> 
            </div>
            <?=$this->session->flashdata('message_name');?>
            <h4 style="color: white">Taluka List</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="eventsTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Taluka name</th> 
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () 
    { 
        callDatatable();
    });
    </script>
 
<script type="text/javascript">
    function callDatatable()
    {
      var myTable = $('#eventsTable').DataTable({
        dom: 'Bfrtip',
        // buttons: [
        // 'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        // dom: "Bfrtip",
        "bDestroy": true,
        "autoWidth": true,
        "scrollX": true,
        "ajax":
        {
         "url": "<?php echo base_url();?>Ajax/getAllTalukaList/",
          dataSrc: ''
        },
        "pageLength": 25,
        buttons:
        [ {
          extend: 'collection',
          text: 'Export',
          buttons: 
          [ 
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
        }
        , 'colvis'
        ],
        "columns": [
                {
                    "data": "taluka_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                {"data": "taluka_name"},
                {
                    "data": "taluka_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (type === 'display') 
                        {
                            data = '<a type="button" class="btn btn-success" href="<?= base_url();?>admin/edit_taluka/' + data + '">Edit</a>';
                        }
                        return data;
                    }
                }
                ]
                });
      myTable.order([0, 'asc']).draw();
    }
</script>
             