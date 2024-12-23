<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Dashboard</a></li>
        <li class="breadcrumb-item active">Users List</li>
    </ol>
    <h1 class="page-header">Users Details</h1>
    <?php if ($this->session->flashdata()): ?>
        <div class="flashData">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success') ?>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="<?php echo  base_url() ?>admin/users" class="btn btn-info panel-title">Add Users</a>
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
                            <th class="text-nowrap">Status</th>
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

<!-- Modal -->
<div class="modal fade" id="passwordModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chnage User Password</h4>
                <button type="button" class="btn btn-sm btn-info close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="changedUSerPassword">
                    <div class="row">
                        <div class="container">
                            <div class="col-md-12">
                                <input type="hidden" id="user_id_pwd" class="user_id_pwd " />
                                <label>Enter New Password </label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="user_id_pwd" class="user_id_pwd " />
                                <label>Confirm New Password </label>
                                <input type="text" class="form-control confirm_newPassword" id="confirm_newPassword" name="confirm_newPassword" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary chnagePasswordBtn" id="chnagePasswordBtn" value="Update Password " />
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        callDatatable();
        setTimeout(function() {
            $(".flashData").hide();
        }, 2000);
    });

    function openPasswordModal(id) {
        $("#newPassword").val("");
        $("#confirm_newPassword").val("");

        var result = confirm("Are you sure  want to change passsword ?");
        if (result) {
            $('#passwordModal').modal('show');
            $("#user_id_pwd").val(id);
        }
    }

    $("#chnagePasswordBtn").on('click', function() {

        var newPassword = $("#newPassword").val();
        var confirm_newPassword = $("#confirm_newPassword").val();
        if (newPassword == confirm_newPassword) {
            var user_id_pwd = $("#user_id_pwd").val();
            var formData = {
                user_id: user_id_pwd,
                newPassword: newPassword,
                confirm_newPassword: confirm_newPassword
            };
            $.ajax({
                url: "<?php echo base_url(); ?>Admin/changePassword/",
                type: "POST",
                data: formData,
                success: function(data, textStatus, jqXHR) {
                    $('#passwordModal').modal('hide');
                    $("#passwordModal .close").click()
                    swal("Success", "Password Updated Successfully! ", "success");
                    callDatatable();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error", "Error While Updating Password ", "error");
                }
            });
        } else {
            swal("Error", "Passwords do not match ", "error");
            return false;
        }
    });


    function callDatatable() {

        var myTable = $('#eventsTable').DataTable({
            dom: "Bfrtip",
            "bDestroy": true,
            "autoWidth": true,
            "scrollX": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>Ajax/getAllUsers/",
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
            }, 'colvis'],
            "columns": [{
                    "data": "user_id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "emp_id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "mobile"
                },
                {
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        var userStatus = <?php echo json_encode(userStatus());?>;
                        var checkUserStatus = JSON.parse(JSON.stringify(userStatus));
                        return checkUserStatus[row.status];                       
                    }
                },
                {
                    "data": "role_name"
                },
                {
                    "data": "user_id",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = '<a type="button" class="btn btn-success" href="<?= base_url(); ?>admin/edit_users/' + data + '"><i class="fa fa-pen"></i></a>  <a type="button" class="btn btn-info" href="<?= base_url(); ?>admin/user_details/' + data + '"><i class="fa fa-eye"></i></a>  <a type="button" class="btn btn-danger" id="changePasswordModal" onclick="openPasswordModal(' + row.user_id + ')" title="Change Password" ><i class="fa fa-lock"></i></a>';
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