<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="<?=base_url();?>assets/img/fevicon_pdcc.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
    <!-- <link href="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
    <link href="<?=base_url();?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- <link href="<?=base_url();?>assets/plugins/animate/animate.min.css" rel="stylesheet"> -->
    <link href="<?=base_url();?>assets/css/default/style.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/default/style-responsive.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/default/theme/default.css" rel="stylesheet" id="theme">
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- <link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet"> -->
    <!-- <link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"> -->
    <!-- <link href="<?=base_url();?>assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="<?=base_url();?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet"> -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!--  Custom CSS  -->
    <style>
    .button {
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 5px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    }
    </style>
    
    <link href="<?=base_url();?>assets/css/common_css.css" rel="stylesheet">
    <title>PDCC</title>
  </head>
  <body class="  pace-done">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show d-none"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="page-sidebar-fixed page-header-fixed show">
      <!-- begin #header -->
      <div id="header" class="header navbar-default hide_in_print">
        <!-- begin navbar-header -->
        <div class="navbar-header" style="text-align:center;">
          <a href="index" class="navbar-brand"><img src="<?=base_url();?>assets/img/logo/logo_pdcc.jpg"><b class="pdcc_logo_name">PDCC</b>Support Ticketing and Inventory System</a>
          <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <!-- end navbar-header -->
        
        <!-- begin header-nav -->
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
        <!-- end header navigation right -->
      </div>
      
      <!-- begin #sidebar -->
      <div id="sidebar" class="sidebar hide_in_print">
        <!-- begin sidebar scrollbar -->
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
          <div data-scrollbar="true" data-height="100%" data-init="true" style="overflow: hidden; width: auto; height: 100%;">
            <!-- begin sidebar user -->
            <ul class="nav">
              <li>
                <ul class="nav nav-profile">
                  <li><a href="#"><svg class="svg-inline--fa fa-cog fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="cog" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path></svg><!-- <i class="fa fa-cog"></i> Font Awesome fontawesome.com --> Settings</a></li>
                  <li><a href="#"><svg class="svg-inline--fa fa-pencil-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg><!-- <i class="fa fa-pencil-alt"></i> Font Awesome fontawesome.com --> Send Feedback</a></li>
                  <li><a href="#"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <i class="fa fa-question-circle"></i> Font Awesome fontawesome.com --> Helps</a></li>
                </ul>
              </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
              <li class="nav-header">Navigation</li>
              <li class="active">
                <a href="admin_dashboard.html">
                  <svg class="svg-inline--fa fa-th-large fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="th-large" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"></path></svg><!-- <i class="fa fa-th-large"></i> Font Awesome fontawesome.com --><span>Admin Dashboard</span>
                </a>
              </li>
              <!--  -->
              <li class="">
                <a href="<?=base_url();?>Inventory/">
                  <svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg><!-- <i class="fa fa-edit"></i> Font Awesome fontawesome.com -->Inventory Dashboard
                </a>
              </li>
              <li class="">
                <a href="agent_dashboard.html">
                  <svg class="svg-inline--fa fa-truck fa-w-20" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="truck" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path></svg><!-- <i class="fa fa-truck"></i> Font Awesome fontawesome.com -->Agent Dashboard
                </a>
              </li>
              <li class="">
                <a href="support_team_dashboard.html">
                  <svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com -->Support Team
                </a>
              </li>
              <li class="">
                <a href="field_dashboard.html">
                  <svg class="svg-inline--fa fa-book fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"></path></svg><!-- <i class="fa fa-book"></i> Font Awesome fontawesome.com -->Field Visit Report
                </a>
              </li>
            </ul>
          </div>
          <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 107.139px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
          <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg hide_in_print"></div>
        <div id="content" class="content">
          <!-- begin breadcrumb -->
          <ol class="breadcrumb pull-right">
            
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <!-- end breadcrumb -->
          <!-- begin page-header -->
          <h1 class="page-header">Dashboard</h1>
          <!-- end page-header -->
          
          <!-- begin row -->
          <div class="row">
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Total Ticket</h4>
                  <h4>100</h4>
                  
                </div>
                <div class="stats-link">
                  <a href="admin_dashboard/Total_ticket/total_ticket_list.html">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Today Tickets</h4>
                  <h4>50</h4>
                </div>
                <div class="stats-link">
                  <a href="#">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Open Ticket</h4>
                  <h4>30</h4>
                </div>
                
                <div class="stats-link">
                  <a href="#">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-gradient-black">
                <div class="stats-icon"><i class="fa fa-book"></i></div>
                <div class="stats-info">
                  <h4>User</h4>
                </div>
                <div class="stats-link">
                  <a href="#">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                  <h4>Inventory</h4>
                </div>
                <div class="stats-link">
                  <a href="#">Click Here <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <hr style="color: black; background: black; height: 3px;">
          <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
              <div class="panel-heading-btn">
                <a href="$" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><svg class="svg-inline--fa fa-expand fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="expand" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 180V56c0-13.3 10.7-24 24-24h124c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H64v84c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12zM288 44v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12V56c0-13.3-10.7-24-24-24H300c-6.6 0-12 5.4-12 12zm148 276h-40c-6.6 0-12 5.4-12 12v84h-84c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24V332c0-6.6-5.4-12-12-12zM160 468v-40c0-6.6-5.4-12-12-12H64v-84c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v124c0 13.3 10.7 24 24 24h124c6.6 0 12-5.4 12-12z"></path></svg><!-- <i class="fa fa-expand"></i> Font Awesome fontawesome.com --></a>
                <a href="#"class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><svg class="svg-inline--fa fa-redo fa-w-16" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="redo" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M500.33 0h-47.41a12 12 0 0 0-12 12.57l4 82.76A247.42 247.42 0 0 0 256 8C119.34 8 7.9 119.53 8 256.19 8.1 393.07 119.1 504 256 504a247.1 247.1 0 0 0 166.18-63.91 12 12 0 0 0 .48-17.43l-34-34a12 12 0 0 0-16.38-.55A176 176 0 1 1 402.1 157.8l-101.53-4.87a12 12 0 0 0-12.57 12v47.41a12 12 0 0 0 12 12h200.33a12 12 0 0 0 12-12V12a12 12 0 0 0-12-12z"></path></svg><!-- <i class="fa fa-redo"></i> Font Awesome fontawesome.com --></a>
                <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><svg class="svg-inline--fa fa-minus fa-w-14" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="minus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg><!-- <i class="fa fa-minus"></i> Font Awesome fontawesome.com --></a>
                <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg><!-- <i class="fa fa-times"></i> Font Awesome fontawesome.com --></a>
              </div>
              <h4 class="panel-title">Total Ticket List</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
              <div class="row">
                <div class=".col-md-4">
                  
                  
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Taluka -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Branch -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <label for="cars"></label>
                  <select name="cars" id="cars" style="  padding: 5px 32px">
                    <option value="volvo">----- Zone -----</option>
                    <option value="volvo">HO</option>
                    <option value="saab">Baramati</option>
                    <option value="mercedes">Ambegaon </option>
                    <option value="audi">Haveli</option>
                  </select>
                  <button class="button">Search</button>
                </div>
              </div>
              <br>
              
              <div class="table-responsive">
                <table id="table_pagination" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="1%">Sr. No.</th>
                      <th class="text-nowrap">Ticket</th>
                      <th class="text-nowrap">Agent</th>
                      <th class="text-nowrap">Branch</th>
                      <th class="text-nowrap">Taluka</th>
                      <th class="text-nowrap">Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-warning btn-xs btn-block" href="#">
                        On-hold               </a>
                      </td>
                      <!---->
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-success btn-xs btn-block" href="#">
                        Inprogress                </a>
                      </td>
                      <!---->
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-danger btn-xs btn-block" href="#">
                        Closed                </a>
                      </td>
                      <!---->
                    </tr>
                    <tr class="odd gradeX">
                      <td width="1%" class="f-s-600 text-inverse">1</td>
                      <td>Error in updating customer record</td>
                      <td>Anis Mulani</td>
                      <td>Head Office</td>
                      <td>Pune</td>
                      <td>
                        <a class="btn btn-primary btn-xs btn-block" href="#">
                        New               </a>
                      </td>
                      <!---->
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end panel-body -->
          </div>
          <!-- end row -->
          
        </div>
        <!-- begin scroll to top btn -->
        <a href="#" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><svg class="svg-inline--fa fa-angle-up fa-w-10" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="angle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z"></path></svg><!-- <i class="fa fa-angle-up"></i> Font Awesome fontawesome.com --></a>
        <!-- end scroll to top btn -->
      </div>
      <!-- end page container -->
      <script src="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
      <script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?=base_url();?>assets/plugins/fontawesome/js/all.min.js"></script>
      <script src="<?=base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
      <script src="<?=base_url();?>assets/plugins/js-cookie/js.cookie.js"></script>
      <script src="<?=base_url();?>assets/js/theme/default.min.js"></script>
      <script src="<?=base_url();?>assets/js/apps.min.js"></script>
      <!-- ================== END BASE JS ================== -->
      <!-- ================== BEGIN PAGE LEVEL JS ================== -->
      <script src="<?=base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
      <script src="<?=base_url();?>assets/plugins/highlight/highlight.common.js"></script>
      <script src="<?=base_url();?>assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
      <script src="<?=base_url();?>assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
      <script src="<?=base_url();?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
      <script src="<?=base_url();?>assets/js/demo/table-manage-default.demo.min.js"></script>
      <script src="<?=base_url();?>assets/js/demo/render.highlight.js"></script>
      
      
      
      
      
    </body>
  </html>