<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?=base_url();?>assets/img/fevicon_pdcc.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/default/style.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/default/style-responsive.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/default/theme/default.css" rel="stylesheet" id="theme">
    <!-- ================== END BASE CSS STYLE ================== -->
    <link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet">
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/pace/pace.min.js"></script>

    <!-- ================== END BASE JS ================== -->

    <!-- DataTable Css -->

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.7.0/css/searchBuilder.dataTables.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">

 <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
 <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js" ></script>

 <script src="https://cdn.datatables.net/searchbuilder/1.7.0/js/dataTables.searchBuilder.js" ></script>
 <script src="https://cdn.datatables.net/searchbuilder/1.7.0/js/searchBuilder.dataTables.js" ></script>
 <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js" ></script> --> 






    <!-- Bootstrap dddd -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <link href="../theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->

    <link href="../theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- NProgress -->

    <link href="../theme/vendors/nprogress/nprogress.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>



 
 

    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css"

          href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css"

          href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css">

     


    
    <!--  Custom CSS  -->
    <link href="<?=base_url();?>assets/css/common_css.css" rel="stylesheet">
    <title>PDCC!</title>
  </head>
  <body class="  pace-done">
    <div id="page-loader" class="fade show d-none"><span class="spinner"></span></div>
    <div id="page-container" class="page-sidebar-fixed page-header-fixed show">
        <div id="header" class="header navbar-default hide_in_print">
            <div class="navbar-header" style="text-align:center;">
                <a href="index" class="navbar-brand"><img src="<?=base_url();?>assets/img/logo/logo_pdcc.jpg"><b class="pdcc_logo_name">PDCC</b>Support Ticketing and Inventory System</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="d-none d-md-inline">Admin Dashboard</span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Change Password</a>
                        <a href="#" class="dropdown-item">Log Out</a>
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
                        <li>
                            <a href="file:///<?=base_url();?>app/admin_dashboard.html">
                                <i class="fa fa-th-large"></i> <span>Admin Dashboard</span>
                            </a>
                        </li>
                        <!--  -->
                        <li class="active">
                            <a href="<?= base_url()?>Inventory">
                                <i class="fa fa-edit"></i> Inventory Dashboard
                            </a>
                        </li>
                        <li class="">
                            <a href="file:///<?=base_url();?>app/agent_dashboard.html">
                                <i class="fa fa-truck"></i> Agent Dashboard
                            </a>
                        </li>
                        <li class="">
                            <a href="file:///<?=base_url();?>app/support_team_dashboard.html">
                                <i class="fa fa-book"></i>Support Team
                            </a>
                        </li>
                        <li class="">
                            <a href="file:///<?=base_url();?>app/field_dashboard.html">
                                <i class="fa fa-book"></i>Field Visit Report
                            </a>
                        </li>
                        
                    </ul>
                    <!-- end sidebar nav -->
                </div>
            </div>
                <!-- end sidebar scrollbar -->
            </div>