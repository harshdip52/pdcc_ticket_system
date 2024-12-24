<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_data">Master Data</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_role">Assign Permission</a></li>
        <li class="breadcrumb-item active">Assign Permission List</li>
    </ol>
    <h1 class="page-header">Assign Permission</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Assign Permission</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="table-wrap">
                    <!-- <button class="btn btn-info btn-sm pull-right" onclick='addModule()'><i class="fa fa-plus" aria-hidden="true"></i></button> -->
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Assign Permission</button>
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <div class="collapse" id="demo">
                                <form method="post" id="form" action="#">
                                    <div class="row">
                                        <input type="hidden" value="" name="id" id="id" />

                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label mb-10">Users:</label>
                                            <select class="form-control user_id select2" id="user_id" name="user_id" required style="width: 100%;">
                                                <option value="">Select User</option>
                                                <?php foreach ($allusers as $keyUser => $user) { ?>
                                                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label">Module Name:</label>
                                            <select class="form-control module_id select2" multiple id="module_id" name="module_id" required style="width: 100%;z-index: 999;">
                                                <option value="">Select Module</option>
                                                <?php foreach ($getallModules as $keyModule => $module) { ?>
                                                    <option value="<?php echo $module['id']; ?>"><?php echo $module['module_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label mb-10">Can Edit:</label>
                                            <select class="form-control can_edit" id="can_edit" name="can_edit" required style="width: 100%;z-index: 999;">
                                                <option value="">Select Option</option>
                                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label mb-10">Can View:</label>
                                            <select class="form-control can_view can_view" id="can_view" name="can_view" required style="width: 100%;z-index: 999;">
                                                <option value="">Select Option</option>
                                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label mb-10">Can Delete:</label>
                                            <select class="form-control can_view can_delete" id="can_delete" name="can_delete" required style="width: 100%;z-index: 999;">
                                                <option value="">Select Option</option>
                                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="control-label mb-10" style="visibility:hidden;">Can Delete:</label><br>
                                            <input type="submit" class="btn btn-info" value="Save" onclick="saveModule()">
                                            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo">Close</button>
                                        </div>
                                        <br>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <br>
                    <Br>
                    <table id="allModules" class="table table-hover table-bordered display mb-30">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>User</th>
                                <th>Assign Modules</th>
                                <th>Can Edit</th>
                                <th>Can View</th>
                                <th>Can Delete</th>
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
    </div>
</div>
</div>

<!-- Bootstrap modal -->
<!-- <div class="modal fade" id="addNewModule" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Module</h3>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" id="form" action="#">
                    <div class="row">
                        <input type="hidden" value="" name="id" id="id" />

                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label mb-10">Users:</label>
                            <select class="form-control user_id select2" id="user_id" name="user_id" required style="width: 100%;">
                                <option value="">Select User</option>
                                <?php foreach ($allusers as $keyUser => $user) { ?>
                                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label">Module Name:</label>
                            <select class="form-control module_id select2" id="module_id" name="module_id" required style="width: 100%;z-index: 999;">
                                <option value="">Select Module</option>
                                <?php foreach ($getallModules as $keyModule => $module) { ?>
                                    <option value="<?php echo $module['id']; ?>"><?php echo $module['module_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label mb-10">Can Edit:</label>
                            <select class="form-control can_edit" id="can_edit" name="can_edit" required style="width: 100%;z-index: 999;">
                                <option value="">Select Option</option>
                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label mb-10">Can View:</label>
                            <select class="form-control can_view can_view" id="can_view" name="can_view" required style="width: 100%;z-index: 999;">
                                <option value="">Select Option</option>
                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label mb-10">Can Delete:</label>
                            <select class="form-control can_view can_delete" id="can_delete" name="can_delete" required style="width: 100%;z-index: 999;">
                                <option value="">Select Option</option>
                                <?php foreach (permissionStatus() as $pKey => $pValue) { ?>
                                    <option value="<?php echo $pKey; ?>"><?php echo $pValue; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                    </div>
                </form>
                </form>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Save" onclick="saveModule()">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<script src="<?= base_url(); ?>assets/css/jquery.min.js"></script>
<script>
    var datatable;
    $(document).ready(function() {
        $('.allstudents').addClass('pull-right');
        $("#module_id").select2({
            closeOnSelect: true,
            // placeholder: "Select Module",
            allowHtml: true,
            allowClear: true,
            tags: true
        });
        $("#user_id").select2({});
        // $("#user_id").select2({
        //     closeOnSelect: true,
        //     // placeholder: "Select User",
        //     allowHtml: true,
        //     allowClear: true,
        //     tags: true
        // });

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
                url: "<?php echo base_url() ?>AssignPermission/getdata",
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
            url: "<?php echo base_url() ?>AssignPermission/getModuleById/" + id,
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
            url = "<?php echo base_url() ?>AssignPermission/addNewModule";
            var msg = "New Module has been added successfully";
        } else {
            url = "<?php echo base_url() ?>AssignPermission/updateModule";
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
                url: "<?php echo base_url() ?>AssignPermission/deleteRole/"+id,     
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