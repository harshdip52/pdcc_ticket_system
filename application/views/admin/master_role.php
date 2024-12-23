<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_data">Master Data</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/master_role">Add Role</a></li>
        <li class="breadcrumb-item active">Add Role List</li>
    </ol>
    <h1 class="page-header">Add Role</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Add Role</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <!-- <div class="col-md-4">
                    <label>Role Name<sup class="text-danger">*</sup></label>
                    <input class="form-control" type="text" name="role_name" id="role_name">
                </div> -->

                <div class="table-wrap">
                    <button class="btn btn-info btn-sm pull-right" onclick='add_class()'><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <br>
                    <Br>
                    <table id="allRoles" class="table table-hover table-bordered display mb-30">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Role Name</th>
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
<div class="modal fade" id="addNewRole" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Role</h3>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" id="form" action="#">
                    <input type="hidden" value="" name="id" id="id" />
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Role Name:</label>
                        <input type="text" class="form-control role_name" name="role_name" id="role_name">
                    </div>
                    <br>
                </form>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-info" value="Save" onclick="saveRole()">
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
        datatable = $('#allRoles').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 10,
            "lengthMenu": [
                [5, 25, 50, 100, -1],
                [5, 25, 50, 100, "All"]
            ],
            "ajax": {
                url: "<?php echo base_url() ?>RoleController/getdata",
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

    function add_class(id) {
        save_method = 'add';
        $('#form')[0].reset();
        $('#addNewRole').modal('show');
        $('.modal-title').text('Add Role');
    }

    function edit_role(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo base_url() ?>RoleController/getRoleById/"+id,            
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.role_id);
                $('[name="role_name"]').val(data.role_name);
                $('#addNewRole').modal('show');
                $('.modal-title').text('Edit Role');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function saveRole() {


        var role_name = $("#role_name").val();

        if (role_name == "" || role_name == null) {
            alert('Please Enter Role');
            return;
        } else {
            var url;
            if (save_method == 'add') {               
                url = "<?php echo base_url() ?>RoleController/addNewRole";
                var msg = "New Role has been added successfully";
            } else {
                url = "<?php echo base_url() ?>RoleController/updateRole";
                var msg = "Role updated successfully";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                //data: formdata,
                // processData: false,
                // contentType: false,
                dataType: "JSON",
                success: function(data) {
                    alert(msg);
                    $('#addNewRole').modal('hide');
                    $('#allRoles').DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
    }


    function delete_role(id) {
        alert("Action is not Allowed ");
        return;
        /*if (confirm('Are You sure Delete this role?')) {
            $.ajax({
                url: "<?php echo base_url() ?>RoleController/deleteRole/"+id,     
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    alert('Role Deleted');
                    $('#allRoles').DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }*/
    }
</script>