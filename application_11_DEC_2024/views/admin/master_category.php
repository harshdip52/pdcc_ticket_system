<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item "><a href="<?= base_url();?>admin">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>admin/master_data">Master Data</a></li>
      <li class="breadcrumb-item active">Category List</li>
    </ol>

    
    <h1 class="page-header">Category Details</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn" >
                <!-- <a href="<?php echo  base_url()?>admin/add_category"class="btn btn-info panel-title"  >Add Category</a>  -->
            </div>
            <?=$this->session->flashdata('message_name');?>
            <h4 style="color: white">Category List</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="eventsTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Category name</th> 
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
        callDatatable(admin_permission);
    });

    function callDatatable(admin_permission)
    {  
        var myTable = $('#eventsTable').DataTable({
            dom: "Bfrtip",
            "bDestroy": true,
            "autoWidth": true,
            "scrollX": true,
            "ajax": 
            {
                "url": "<?php echo base_url();?>Ajax/getAllCategoryList/",
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
                    "data": "cat_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, 
                {"data": "cat_name"},
                {
                    "data": "cat_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (admin_permission == 1) {
                            data = '<a type="button" class="btn btn-success" href="<?= base_url();?>admin/edit_category/' + data + '">Edit</a>';
                        } else if (admin_permission == 0) {
                            data = '<a type="button" class="btn btn-danger" title = "Action is not allowed">Not Allowed</a>';
                        } else {
                            data = '<a type="button" class="btn btn-danger" title = "Action is not allowed">Not Allowed</a>';
                        }
                        // if (type === 'display') 
                        // {
                        //     data = '<a type="button" class="btn btn-success" href="<?= base_url();?>admin/edit_category/' + data + '">Edit</a>';
                        // }
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
             