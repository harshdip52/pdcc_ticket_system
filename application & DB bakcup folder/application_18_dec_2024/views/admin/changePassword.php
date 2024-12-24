<style>
    /* .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }

    .container {
        padding-top: 100px;
        margin: auto;
    } */
    /* .toggle-password {
    float: right;
    cursor: pointer;
    margin-right: 10px;
    margin-top: -25px;
} */
</style>
<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Profile</a></li>
        <li class="breadcrumb-item active">Change Password </li>
    </ol>
    <h1 class="page-header">Change Password </h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <?= $this->session->flashdata('message_name'); ?>
            <h5 style="color: white">Change Password </h5>
        </div>
        <div class="panel-body">

            <div class="panel-body">

                <section style="!background-color: #eee;">
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Enter New Password</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="text-muted mb-0">
                                                    <input type="password" name="new_password" id="new_password" class="form-control new_password" placeholder="Enter New Password" />
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="toggle-password btn btn-primary btn-sm"><i class="fa fa-eye-slash"></i></button>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Confirm Password</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="text-muted mb-0">
                                                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control confirm_new_password" placeholder="Enter Confirm Password">
                                                </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="toggle-c-password btn btn-primary btn-sm"><i class="fa fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <center>
                                                <div class="col-sm-3">
                                                    <p class="mb-0">
                                                        <button type="submit" class="btn btn-sm btn-info change_password_btn" id="change_password_btn">Update Password</button>
                                                    </p>
                                                </div>
                                            </center>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <!-- end panel-body -->
        </div>
        <div class="panel-heading" style="background-color: #0e6d8c;">
            <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
        </div>

    </div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            // $(this).toggleClass("fa fa-eye");
            $(".toggle-password i").toggleClass("fa fa-eye");
            let inputField = $('#new_password');
            let type = inputField.attr('type') === 'password' ? 'text' : 'password';
            inputField.attr('type', type);
        });

        $(".toggle-c-password").click(function() {
            // $(this).toggleClass("fa fa-eye");
            $(".toggle-c-password i").toggleClass("fa fa-eye");
            let inputField = $('#confirm_new_password');
            let type = inputField.attr('type') === 'password' ? 'text' : 'password';
            inputField.attr('type', type);
        });

        $("#change_password_btn").on("click", function() {
            var user_id_pwd = "<?php echo $this->session->userdata('login_user_id') ?>";
            // alert(user_id_pwd);return;
            var new_password = $("#new_password").val();

            var confirm_new_password = $("#confirm_new_password").val();

            if (new_password == '' || new_password == null || new_password == 0) {
                swal("Error", "Please enter password", "error");
                return;
            }
            if (confirm_new_password == '' || confirm_new_password == null || confirm_new_password == 0) {
                swal("Error", "Please enter password", "error");
                return;
            }
            var result = confirm("Are you sure  want to change passsword ?");
            if (result) {
                if (new_password == confirm_new_password) {
                    var formData = {
                        user_id: user_id_pwd,
                        newPassword: new_password,
                        confirm_newPassword: confirm_new_password
                    };
                    $.ajax({
                        url: "<?php echo base_url(); ?>Admin/changePassword/",
                        type: "POST",
                        data: formData,
                        success: function(data, textStatus, jqXHR) {
                            // swal("Success", "Password Updated Successfully! ", "success");
                            swal({
                                title: "Success",
                                text: "Password Updated Successfully!!",
                                type: "success"
                            }).then(function() {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            });

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal("Error", "Error While Updating Password ", "error");
                        }
                    });
                } else {
                    swal("Error", "Password do not match ", "error");
                    return false;
                }
            }
        });
    });
</script>