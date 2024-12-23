<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
  <ol class="breadcrumb pull-right">
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>admin"> Vendor Dashboard</a></li>
    <li class="breadcrumb-item "><a href="<?= base_url(); ?>Vendor/VendorDashboard"> Ticket Dashboard</a></li>
    <li class="breadcrumb-item active">View Ticket </li>
  </ol>
  <h1 class="page-header">Vendor View Ticket </h1>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">Vendor Ticket Details</h4>
    </div>

    <div class="panel-body">
      <div class="row">

        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Ticket Id :- </label>
          <?= $ticket['ticket_no'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Taluka Name :- </label>
          <?= $ticket['taluka_name'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Zone :- </label>
          <?= $ticket['zone_name'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Branch :- </label>
          <?= $ticket['branch_name'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Category :- </label>
          <?= $ticket['cat_name'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Sub-Category :- </label>
          <?= $ticket['sub_cat_name'] ?>
        </div>

        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Brand :- </label>
          <?= $ticket['brand_name'] ?>
        </div>

        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Item /Model Name :- </label>
          <?= $ticket['item_name'] ?>
        </div>



        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Serial No. :- </label>
          <?= $ticket['serial_no'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label>Raised By :- </label>
          <?= $ticket['name'] ?>
        </div>
        <div class="col-md-12 input-padd" style="font-size: 16px;">
          <label>Ticket Priority :- </label>
          <?= $ticket['ticket_priority'] ?>
        </div>
        <div class="col-md-6 input-padd" style="font-size: 16px;">
          <label> Date :- </label>
          <?= $ticket['created_on'] ?>
        </div>
        <div class="col-md-12 input-padd" style="font-size: 16px;">
          <label>Ticket Title :- </label>
          <?= $ticket['ticket_title'] ?>
        </div>
        <div class="col-md-12 input-padd" style="font-size: 16px;">
          <label>Ticket Description :- </label>
          <?= $ticket['description'] ?>
        </div>

        <?php if (!empty($ticket['attachment'])) { ?>

          <div class="col-md-4 input-padd" style="font-size: 16px;">
            <label>View Attachment:- </label>
            <a href="<?= base_url() . "uploads/ticket/" ?><?= $ticket['attachment'] ?>" target="_blank" class="btn btn-info btn-sm">view</a>
          </div>
        <?php } ?>

        <div class="col-md-12 input-padd" style="font-size: 16px;">
          <label>Ticket Reply:- </label>
          <?= $ticket['remark'] ?>
        </div>

        <div class="col-md-12 input-padd" style="font-size: 16px;">
          <label>Status:- </label>
          <?= $ticket['status'] ?>
        </div>

        <?php if ($ticket['forword_from_1'] != '') { ?>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward By 1:- </label>
            <?= $ticket['forwordby'] ?>
          </div>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward By 1 Description:- </label>
            <?= $ticket['description_1'] ?>
          </div>

        <?php } ?>

        <?php if ($ticket['forward_from_2'] != '') { ?>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward By 2:- </label>
            <?= $ticket['forwardedTo']; #$ticket['forwordby2']
            ?>
          </div>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Forward By 2 Description:- </label>
            <?= $ticket['description_2'] ?>
          </div>

        <?php } ?>


        <?php if ($ticket['status'] == 'Queried') { ?>

          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Queried By:- </label>
            <?= $ticket['queried_by_name'] ?>
          </div>
          <div class="col-md-6 input-padd" style="font-size: 16px;">
            <label>Queried On:- </label>
            <?= $ticket['queried_on'] ?>
          </div>

          <div class="col-md-12 input-padd" style="font-size: 16px;">
            <label>Query:- </label>
            <?= $ticket['ticket_query'] ?>
          </div>
        <?php } ?>
      </div>
      <?php
      $login_role = $this->session->userdata('login_role');
      $login_user = $this->session->userdata('login_user_id');


      if ($login_role == 6 && $ticket['status'] != 'Resolved' && $login_user == $ticket['user_id']) { ?>
        <!--  -->
        <hr style="color: black; background: black; height: 3px;">
        <div class="row" id="btnDiv">
          <div class="col-md-12">
            <div class="panel-heading-btn" style="margin-top: -4px;">
              <a class="btn btn-success btn-sm text-white" id="btnsubmitdata" onclick="replyFun()"><i class="fa fa-reply" aria-hidden="true"></i> Ticket Reply</a>
              <?php if ($ticket['forword_applicable'] == 'Yes') { ?>
                <a class="btn btn-warning btn-sm text-white" id="btnsubmitdata" onclick="forwardFun()"> Forward Reply <i class="fa fa-forward" aria-hidden="true"></i></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div id="forwardTicketDiv">
          <form method="post" action="<?= base_url() ?>Vendor/forwardTicket/<?= $ticket['ticket_id'] ?>" id="forwardTicket">
            <input type="hidden" name="ticket_id" value="<?= $ticket['ticket_id'] ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2 input-padd" style="font-size: 16px;">
                    <label>Select Support:- </label>
                  </div>
                  <div class="col-md-10 input-padd" style="font-size: 16px;">
                    <select class="form-select from-font" id="user_id" name="user_id"> </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 input-padd" style="font-size: 16px;">
                    <label>Description :- </label>
                  </div>
                  <div class="col-md-10 input-padd" style="font-size: 16px;">
                    <textarea name="description" id="description" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="panel-heading-btn" style="margin-top: -4px;"><br>
                  <a class="btn btn-success text-white" id="forwardTicketbtn"> Submit</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div id="ticketReplyDiv">
          <form method="post" action="<?= base_url() ?>Vendor/ticketReplyNew/<?= $ticket['ticket_id'] ?>" id="ticketReply">
            <input type="hidden" name="ticket_id" value="<?= $ticket['ticket_id'] ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2 input-padd" style="font-size: 16px;">
                    <label>Description :- </label>
                  </div>
                  <div class="col-md-10 input-padd" style="font-size: 16px;">
                    <textarea name="remark" id="remark" class="form-control"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 input-padd" style="font-size: 16px;">
                    <label>Status :- </label>
                  </div>
                  <div class="col-md-10 input-padd" style="font-size: 16px;">
                    <input type="radio" id="Resolved" name="status" value="Resolved">
                    <label for="html">Resolved</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="Inprogress" name="status" value="Inprogress">
                    <label for="html">In-Progress</label>
                    <span id="sts"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="panel-heading-btn" style="margin-top: -4px;"><br>
                  <a class="btn btn-success text-white" id="ticketReplybtn"> Submit</a>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>


  <?php } ?>
  <div class="row">
    <div class="panel-heading" style="background-color: #0e6d8c;">
      <div class="panel-heading-btn" style="margin-top: -4px;">
        <input type="button" class="btn btn-sm btn-danger pull-right" value="Back" onClick="javascript:history.go(-1)" />
      </div>
      <h4 class="panel-title" style="visibility: hidden;">Total Ticket List</h4>
    </div>

  </div>
  </div>


  <!-- end panel-body -->
</div>


</div>
</div>

<script type="text/javascript">
  $('#ticketReplybtn').click(function(e) {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;


    $("#sts").next(".validation").remove();
    if ($('input[name="status"]:checked').length == 0) {
      $("#sts").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      if (!focusSet) {
        $("#sts").focus();
      }
      allfields = false;
    } else {
      $("#sts").next(".validation").remove(); // remove it
    }

    var remark = $("#remark").val();
    if (remark == "" || remark == null) {
      if ($("#remark").next(".validation").length == 0) // only add if not added
      {
        $("#remark").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#remark").focus();
      }
      allfields = false;
    } else {
      $("#description").next(".validation").remove(); // remove it
    }
    if (allfields) {
      $('#ticketReply').submit();
    } else {
      return false;
    }
  });


  $('#forwardTicketbtn').click(function(e) {
    e.preventDefault();
    var focusSet = false;
    var allfields = true;

    var user_id = $("#user_id").val();
    if (user_id == "" || user_id == null) {
      if ($("#user_id").next(".validation").length == 0) // only add if not added
      {
        $("#user_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#user_id").focus();
      }
      allfields = false;
    } else {
      $("#user_id").next(".validation").remove(); // remove it
    }

    var description = $("#description").val();
    if (description == "" || description == null) {
      if ($("#description").next(".validation").length == 0) // only add if not added
      {
        $("#description").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
      }
      if (!focusSet) {
        $("#description").focus();
      }
      allfields = false;
    } else {
      $("#description").next(".validation").remove(); // remove it
    }
    if (allfields) {
      $('#forwardTicket').submit();
    } else {
      return false;
    }
  });


  function getUsers() {
    $.getJSON("<?php echo base_url(); ?>Ajax/getAllUsersSupport/", function(data) {
      var stringToAppend = "<option disabled selected value=''>-- Select Support Team --</option> ";
      $.each(data, function(key, val) {
        stringToAppend += "<option value='" + val.user_id + "'>" + val.name + "</option>";
      });
      $("#user_id").html(stringToAppend);
    });
  }

  $(document).ready(function() {
    getUsers();
    $("#forwardTicketDiv").hide();
    $("#ticketReplyDiv").hide();


  });
</script>

<script>
  function replyFun() {
    $("#btnDiv").hide();
    $("#forwardTicketDiv").hide();
    $("#ticketReplyDiv").show();
  }

  function forwardFun() {
    $("#btnDiv").hide();
    $("#forwardTicketDiv").show();
    $("#ticketReplyDiv").hide();
  }
</script>