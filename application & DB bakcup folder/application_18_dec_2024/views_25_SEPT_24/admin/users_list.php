<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li> 
      <li class="breadcrumb-item active">Users List</li>
    </ol>
    <h1 class="page-header">Users Details</h1>
    <?php if ($this->session->flashdata()): ?>
        <div class="flashData">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success') ?>
                </div>
            <?php endif ?>
      </div>
      <?php endif ?>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn" >
                <a href="<?php echo  base_url()?>admin/users"class="btn btn-info panel-title"  >Add Users</a> 
            </div>
            
            <h4 style="color: white">Users List</h4> 
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="eventsTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Emp / Vendor id</th> 
                            <th class="text-nowrap">User name</th> 
                            <th class="text-nowrap">Email</th> 
                            <th class="text-nowrap">Mobile</th> 
                            <th class="text-nowrap">Role</th> 
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
        setTimeout(function()
        {
            $(".flashData").hide(); 
        }, 2000);
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
                "url": "<?php echo base_url();?>Ajax/getAllUsers/",
                dataSrc: '', 
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
                    "data": "user_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                {"data": "emp_id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "mobile"},
                {"data": "role_name"},
                {
                    "data": "user_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (type === 'display') 
                        {
                            data = '<a type="button" class="btn btn-success" href="<?= base_url();?>admin/edit_users/' + data + '">Edit</a> <a type="button" class="btn btn-info" href="<?= base_url();?>admin/user_details/' + data + '">View Details</a>';
                        }
                        return data;
                    }
                }
                ]
                });
                myTable
                .order([0, 'asc'])
                .draw();
            }
        </script>
             