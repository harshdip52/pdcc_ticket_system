<!doctype html>
<html lang="en" style="font-size:0.605em">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?= base_url(); ?>assets/img/fevicon_pdcc.jpg">
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/default/style.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/default/style-responsive.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/default/theme/default.css" rel="stylesheet" id="theme">
    <!-- ================== END BASE CSS STYLE ================== -->
    <link href="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet">
    <!-- <link href="<?= base_url(); ?>assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="<?= base_url(); ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet"> -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/pace/pace.min.js"></script>

    <!-- ================== END BASE JS ================== -->

    <!-- DataTable Css -->

    <link href="<?= base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="<?= base_url(); ?>assets/css/buttons.dataTables.min.css" rel="stylesheet">  -->
    <script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script> -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/searchBuilder.dataTables.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/dataTables.dateTime.min.css"> -->


    <!-- Bootstrap dddd -->
    <link href="<?= base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />
    <script src="<?= base_url(); ?>assets/css/jquery.min.js"></script>

    <!-- <script src="<?= base_url(); ?>assets/css/select2.min.js" defer></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/select.dataTables.min.css"> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->

    <!-- SEARCHBLE DROP DOWN----->
    <link href="<?= base_url(); ?>assets/css/selectdropdown.min.css" rel="stylesheet" />
    <script src="<?= base_url(); ?>assets/js/jquerydropdown.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/selectdropdown.min.js"></script>

    <!-- <link href="<?= base_url(); ?>assets/css/jquery.multiselect.css" rel="stylesheet" /> -->


    <!--  Custom CSS  -->
    <link href="<?= base_url(); ?>assets/css/common_css.css" rel="stylesheet">

    <title>PDCC!</title>
</head>

<style>
    div.dt-buttons {
        position: relative;
        float: left !important;
        margin-left: 10px !important;
    }

    .dt-button-collection {
        margin-top: 5px !important;
    }

    #overlay{	
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>

<body class="  pace-done">
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
    <div id="page-loader" class="fade show d-none"><span class="spinner"></span></div>
    <div id="page-container" class="page-sidebar-fixed page-header-fixed show">
        <div id="header" class="header navbar-default hide_in_print">
            <div class="navbar-header" style="text-align:center;">
                <a href="index" class="navbar-brand"><img src="<?= base_url(); ?>assets/img/logo/logo_pdcc.jpg"><b class="pdcc_logo_name">PDCC</b>Support Ticketing and Inventory System</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="d-none d-md-inline">Welcome:- <?php echo  $this->session->userdata('login_name'); ?></span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url() ?>UsersProfileController" class="dropdown-item">Profile</a>
                        <a href="<?= base_url()?>UsersProfileController/changePassword" class="dropdown-item">Change Password</a>
                        <a href="<?= base_url() ?>admin/logout" class="dropdown-item">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar hide_in_print">
            <!-- begin sidebar scrollbar -->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div data-scrollbar="true" data-height="100%" data-init="true" style="overflow: hidden; width: auto; height: 100%;">
                    <ul class="nav">
                        <li class="nav-header">Navigations</li>
                        <?php $login_role = $this->session->userdata('login_role'); ?>

                        <?php if ($login_role == 1) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Admin Dashboard</span>
                                </a>
                            </li>
                            <!-- <li >
                            <a href="<?= base_url() ?>Inventory">
                                <i class="fa fa-edit"></i> Inventory Dashboard
                            </a>
                        </li> -->
                        <?php } ?>

                        <?php if ($login_role == 2) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Zonal officer dashboard</span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php if ($login_role == 3) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Branch Mang. Dashboard</span>
                                </a>
                            </li>

                        <?php } ?>
                        <?php if ($login_role == 4) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Help Desk Dashboard</span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php if ($login_role == 5) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Support Dashboard</span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php if ($login_role == 7) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>Store Keeper</span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php if ($login_role == 8) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>IT Manager </span>
                                </a>
                            </li>

                        <?php } ?>
                        <?php if ($login_role == 9) { ?>
                            <li class="active">
                                <a href="<?= base_url() ?>admin">
                                    <i class="fa fa-th-large"></i> <span>CBS Support Dashboard </span>
                                </a>
                            </li>

                        <?php } ?>


                        <!-- <li class="">
                            <a href="file:///<?= base_url(); ?>app/agent_dashboard.html">
                                <i class="fa fa-truck"></i> Agent Dashboard
                            </a>
                        </li>
                        <li class="">
                            <a href="file:///<?= base_url(); ?>app/support_team_dashboard.html">
                                <i class="fa fa-book"></i>Support Team
                            </a>
                        </li>
                        <li class="">
                            <a href="file:///<?= base_url(); ?>app/field_dashboard.html">
                                <i class="fa fa-book"></i>Field Visit Report
                            </a>
                        </li> -->

                    </ul>
                    <!-- end sidebar nav -->
                </div>
            </div>
            <!-- end sidebar scrollbar -->
        </div>