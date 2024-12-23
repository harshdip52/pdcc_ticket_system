<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory"> Inventory Dashboard</a></li>
        <li class="breadcrumb-item active">Dead / Movement / Repair Inventory Logs </li>
    </ol>
    <h1 class="page-header">Dead / Movement / Repair Inventory Logs</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <?= $this->session->flashdata('message_name'); ?>
            <h4 class="panel-title">Dead /Movement / Repair Inventory Logs</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <select name="taluka_id" id="taluka_id" class="form-control" onchange="getZone(this.value)">
                        <option value="0">--Taluka--</option>
                        <?php foreach ($AllTaluka as $key => $Taluka) { ?>
                            <option value="<?= $Taluka['taluka_id'] ?>"><?= $Taluka['taluka_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="zone_id" id="zone_id" class="form-control" onchange="getBranch(this.value)">
                        <option value="0">--Zone--</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="branch_id" id="branch_id" class="form-control">
                        <option value="0">--Branch--</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="action_status" id="action_status" class="form-control">
                        <option value="">--Status--</option>
                        <option value="3">Movement Stock</option>
                        <option value="4">Dead Stock</option>
                        <option value="7">Repair Stock</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success" id="getValuesBtn" onclick="getValue()">Search</button>
                    <!-- <button class="btn btn-primary btn-sm " id="" onclick="callDatatable()"><i class="fa">&#xf021;</i></button> -->
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
                            <th class="text-nowrap">Item / Model name</th>
                            <th class="text-nowrap">Taluka</th>
                            <th class="text-nowrap">Branch</th>
                            <th class="text-nowrap">Zone</th>
                            <!-- <th class="text-nowrap">Brand</th> -->
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Sub-Category</th>
                            <th class="text-nowrap">Serial No.</th>
                            <th class="text-nowrap">Ip Address</th>
                            <th class="text-nowrap">Inserted By</th>
                            <th class="text-nowrap">Dead Inventory date</th>
                            <th class="text-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>


                <div class="modal fade" id="moveToHoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Stock Move To Head Office</h4>
                                <button type="button" class="btn btn-sm btn-danger close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="container">
                                        <form id="moveToHoForm">
                                            <div class="col-md-12">
                                                <input type="hidden" name="inventory_id" id="inventory_id" class="inventory_id" readonly />
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-control selected_branch select2" id="selected_branch" name="selected_branch" style="width:100%;">
                                                    <option value=""></option>
                                                    <?php foreach ($getallBranches as $branch) { ?>
                                                        <?php if ($branch['branch_name'] == "HEAD OFFICE") {  ?>
                                                            <option selected value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" id="moveToHoBtn">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        loader();
                        // $("#selected_branch").select2();
                        var taluka_id = 0;
                        var branch_id = 0;
                        var zone_id = 0;
                        var action_status = 0;
                        callDatatable(taluka_id, zone_id, branch_id, action_status);
                    });

                    function callDatatable(taluka_id, zone_id, branch_id, action_status) {
                        loader();
                        var myTable = $('#eventsTable').DataTable({
                            dom: "Bfrtip",
                            "bDestroy": true,
                            "autoWidth": true,
                            "scrollX": true,
                            "ajax": {
                                "url": "<?php echo base_url(); ?>Inventory/getInventoryRepairMovementDeadStockLogs/",
                                dataSrc: '',
                                dataType: "JSON",
                                type: "POST",
                                data: {
                                    taluka_id: taluka_id,
                                    branch_id: branch_id,
                                    zone_id: zone_id,
                                    action_status: action_status
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
                                    "data": "id",
                                    render: function(data, type, row, meta) {
                                        return meta.row + meta.settings._iDisplayStart + 1;
                                    }
                                },
                                {
                                    "data": "item_name"
                                },
                                {
                                    "data": "taluka_name"
                                },
                                {
                                    "data": "branch_name"
                                },
                                {
                                    "data": "zone_name"
                                },
                                // {
                                //     "data": "brand_name"
                                // },
                                {
                                    "data": "cat_name"
                                },
                                {
                                    "data": "sub_cat_name"
                                },
                                {
                                    "data": "serial_no"
                                },
                                {
                                    "data": "ip_address"
                                },
                                {
                                    "data": "insertedName"
                                },
                                {
                                    "data": "inserted_on",
                                },
                                {
                                    "data": "action_status",
                                    "render": function(data, type, row, meta) {
                                        if (row.action_status == 3) {
                                            data = 'Movement Stock';
                                        }
                                        if (row.action_status == 4) {
                                            data = 'Dead Stock';
                                        }
                                        if (row.action_status == 7) {
                                            data = 'Repair Stock';
                                        }
                                        if (row.action_status == 1) {
                                            data = 'New';
                                        }
                                        return data;
                                    }
                                },
                            ]
                        });
                        myTable
                            .order([0, 'desc'])
                            .draw();

                        $("#getValuesBtn").prop("disabled", false);
                    }
                </script>
                <script>
                    function getBranch(zone_id) {
                        var zoneId = [zone_id];
                        $("#branch_id").empty();
                        $.ajax({
                            url: "<?php echo base_url(); ?>Ajax/getBranchAjax/", //the page containing php script
                            type: "post", //request type,
                            dataType: 'json',
                            data: {
                                zone_id: zoneId
                            },
                            success: function(data) {

                                var stringToAppend = "<option selected value=''>--Branch--</option> ";
                                $.each(data, function(key, val) {
                                    stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
                                });
                                $("#branch_id").html(stringToAppend);
                            }
                        });

                        // $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjax/"+zone_id, function (data) {
                        //   var stringToAppend = "<option disabled selected value=''>--Branch--</option> ";
                        //   $.each(data, function (key, val) 
                        //   {
                        //     stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
                        //   });
                        //   $("#branch_id").html(stringToAppend); 
                        // });
                    }

                    function getZone(taluka_id) {
                        $("#branch_id").empty();
                        $("#zone_id").empty();
                        $.getJSON("<?php echo base_url(); ?>Ajax/getZoneAjax/" + taluka_id, function(data) {
                            var stringToAppend = "<option disabled selected value=''>--Zone--</option> ";
                            $.each(data, function(key, val) {
                                stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
                            });
                            $("#zone_id").html(stringToAppend);
                        });
                    }

                    function getSubCategory(cat_id) {
                        $.getJSON("<?php echo base_url(); ?>Ajax/getSubCategoryAjax/" + cat_id, function(data) {
                            var stringToAppend = "<option disabled selected value=''> --Sub Category-- </option> ";
                            $.each(data, function(key, val) {
                                stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
                            });
                            $("#sub_cat_id").html(stringToAppend);
                        });
                    }

                    function getValue() {
                        $("#getValuesBtn").prop("disabled", true);
                        var taluka_id = $('#taluka_id').val();
                        var branch_id = $('#branch_id').val();
                        var zone_id = $('#zone_id').val();
                        var action_status = $('#action_status').val();
                        if (taluka_id != null || taluka_id != 0  || zone_id != null || branch_id != null || action_status != null) {
                            callDatatable(taluka_id, zone_id, branch_id, action_status);
                        } else {
                            alert('Please Select Taluka, Zone , Branch');
                        }
                    }

                    function readyStock(id) {
                        var result = confirm("Are you sure the stock is ready ?");
                        if (result) {
                            var formData = {
                                id: id
                            };
                            $.ajax({
                                url: "<?php echo base_url(); ?>Ajax/readyStock/",
                                type: "POST",
                                data: formData,
                                success: function(data, textStatus, jqXHR) {
                                    swal("Success", 'Stock Active Now', "success");
                                    callDatatable();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    swal("Error", 'Error While Activating This Stcok', "error");
                                    return;
                                }
                            });
                        }

                    }

                    function moveToHoBranch(data) {
                        // var selected_branch_id = $("#selected_branch").val();
                        $("#inventory_id").val(data);
                        $("#moveToHoModal").modal('show');
                    }

                    $("#moveToHoBtn").on("click", function() {
                        var result = confirm("Are you sure you want to move this stock Head office ?");
                        if (result) {
                            var selected_branch_id = $("#selected_branch").val();
                            var inventory_id = $("#inventory_id").val();
                            var formData = {
                                branch_id: selected_branch_id,
                                inventory_id: inventory_id
                            };
                            $.ajax({
                                url: "<?php echo base_url(); ?>Ajax/moveToHo/",
                                type: "POST",
                                data: formData,
                                success: function(data, textStatus, jqXHR) {
                                    swal("Success", 'Stock Move To Head Office', "success");
                                    $('#moveToHoModal').modal('hide');
                                    $("#moveToHoModal .close").click()
                                    callDatatable();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    swal("Error", 'Error While Moving Stock To Head Office', "error");
                                    return;
                                }
                            });
                        }
                    });
                </script>