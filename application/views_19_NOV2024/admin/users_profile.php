<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin">Profile</a></li>
        <li class="breadcrumb-item active">User Profile </li>
    </ol>
    <h1 class="page-header">User Profile </h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">

            <?= $this->session->flashdata('message_name'); ?>
            <h4 style="color: white">User Profile </h4>
        </div>
        <div class="panel-body">

            <div class="panel-body">

                <section style="background-color: #eee;">
                    <div class="container py-5">
                        

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="<?php echo base_url()?>assets/img/product/user.png" alt="avatar"
                                            class="rounded-circle img-fluid" style="width: 150px;">
                                        <h5 class="my-3"><?php echo  $this->session->userdata('login_name');?></h5>
                                        <p class="text-muted mb-1"><?php echo $this->session->userdata('role_name'); ?></p>
                                        <!-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="card mb-4 mb-lg-0">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="">Name </i>
                                                <p class="mb-0"><?php echo $this->session->userdata('login_name');?></p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="">Mobile</i>
                                                <p class="mb-0"><?php echo $this->session->userdata('login_mobile');?></p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="" >Email</i>
                                                <p class="mb-0"><?php echo $this->session->userdata('login_email');?></p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i >Username</i>
                                                <p class="mb-0"><?php echo $this->session->userdata('login_username');?></p>
                                            </li>
                                            <!-- -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><p class="mb-0"><?php echo $this->session->userdata('login_name');?></p></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><p class="mb-0"><?php echo $this->session->userdata('login_email');?></p></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><p class="mb-0"><?php echo $this->session->userdata('login_mobile');?></p></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Username </p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><p class="mb-0"><?php echo $this->session->userdata('login_username');?></p></p>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Assign Taluka's</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><p class="mb-0"><?php echo implode(",",$this->session->userdata('getallTalukaList'));?></p></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Assign Branches</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0"><?php echo implode(",",$this->session->userdata('getBranchList'));?></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                </p>
                                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                <div class="progress rounded mb-2" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                </p>
                                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                <div class="progress rounded" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                <div class="progress rounded mb-2" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
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