<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_data">Master Data</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_role">Add Module</a></li>
        <li class="breadcrumb-item active">Add Module List</li>
    </ol>
    <h1 class="page-header">Add Module</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Add Module</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <!-- <div class="col-md-4">
                    <label>Role Name<sup class="text-danger">*</sup></label>
                    <input class="form-control" type="text" name="role_name" id="role_name">
                </div> -->

                <div class="table-wrap">
                    <button class="btn btn-info btn-sm pull-right" onclick='addModule()'><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <br>
                    <Br>
                    <table id="allModules" class="table table-hover table-bordered display mb-30">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Module Name</th>
                                <th>Module Display Name</th>
                                <th>Module Link</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="panel-heading" style="background-color: #0e6d8c;">
            <div class="panel-heading-btn" style="margin-top: -4px;">               
                <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#" id="btnsubmitdata">Submit</a>
                <a href="<?= base_url(); ?>admin/master_brand" class="btn btn-sm btn-danger">Cancel</a>
            </div>
            <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4> -->
    </div>

</div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="addNewModule" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Module</h3>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" id="form" action="#">
                    <input type="hidden" value="" name="id" id="id" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Module Name:</label>
                        <input type="text" class="form-control module_name" name="module_name" id="module_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Module Display Name:</label>
                        <input type="text" class="form-control module_display_name" name="module_display_name" id="module_display_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Module Link:</label>
                        <input type="text" class="form-control module_link" name="module_link" id="module_link">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Module Class Name:</label>
                        <input type="text" class="form-control module_class_name" name="module_class_name" id="module_class_name">
                    </div>
                    <br>
                </form>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Save" onclick="saveModule()">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<script>
    var datatable;
    $(document).ready(function() {
        $('.allstudents').addClass('pull-right');
        datatable = $('#allModules').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 15,
            "lengthMenu": [
                [5, 25, 50, 100, -1],
                [5, 25, 50, 100, "All"]
            ],
            "ajax": {
                url: "<?php echo base_url() ?>ModuleController/getdata",
                "type": "POST",
                "data": {
                    "YOUR CUSTOM POST NAME": "YOUR VALUE"
                }
            },
            "columnDefs": [{
                "targets": [0, 1],
                "orderable": false
            }],

            "fnInitComplete": function(oSettings, response) {

                $("#countData").text(response.recordsTotal);
            }
        });
    });

    var save_method; //for save method string
    var table;

    function addModule(id) {
        save_method = 'add';
        $('#form')[0].reset();
        $('#addNewModule').modal('show');
        $('.modal-title').text('Add Module');
    }

    function edit_module(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo base_url() ?>ModuleController/getModuleById/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);               
                $('[name="module_name"]').val(data.module_name);
                $('[name="module_display_name"]').val(data.module_display_name);
                $('[name="module_link"]').val(data.module_link);
                $('[name="module_class_name"]').val(data.module_class_name);

                $('#addNewModule').modal('show');
                $('.modal-title').text('Edit Module');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function saveModule() {

        var module_name = $("#module_name").val();
        var module_display_name = $("#module_display_name").val();
        var module_link = $("#module_link").val();
        var module_class_name = $("#module_class_name").val();

        if (module_name == "" || module_name == null) {
            alert('Please Enter Module Name');
            return;
        }
        if (module_display_name == "" || module_display_name == null) {
            alert('Please Enter Module Display Name');
            return;
        }
        if (module_link == "" || module_link == null) {
            alert('Please Enter Module Link');
            return;
        }
        if (module_class_name == "" || module_class_name == null) {
            alert('Please Enter Module Class Name');
            return;
        }

        var url;
        if (save_method == 'add') {
            url = "<?php echo base_url() ?>ModuleController/addNewModule";
            var msg = "New Module has been added successfully";
        } else {
            url = "<?php echo base_url() ?>ModuleController/updateModule";
            var msg = "Module updated successfully";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                alert(msg);
                $('#addNewModule').modal('hide');
                $('#allModules').DataTable().ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }


    function delete_role(id) {
        alert("Action is not Allowed ");
        return;
        /*if (confirm('Are You sure Delete this role?')) {
            $.ajax({
                url: "<?php echo base_url() ?>ModuleController/deleteRole/"+id,     
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    alert('Role Deleted');
                    $('#allModules').DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }*/
    }
</script>