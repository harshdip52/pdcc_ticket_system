 <div class="sidebar-bg hide_in_print"></div>
 <div id="content" class="content">
     <ol class="breadcrumb pull-right">
         <li class="breadcrumb-item "><a href="<?= base_url(); ?>Inventory"> Inventory Dashboard Admin IT</a></li>

         <li class="breadcrumb-item active">Assign Inventory List </li>
     </ol>
     <h1 class="page-header">Assign Inventory List</h1>
     <div class="panel panel-inverse">
         <div class="panel-heading">
             <?= $this->session->flashdata('message_name'); ?>
             <h4 class="panel-title">Assign Inventory List</h4>
         </div>
         <div class="container">

             <div class="panel-body">
                 <div class="row">
                     <div class="col-md-3">
                         <!-- <select style="width: 100%;;" name="branch_id" id="branch_id" class="form-control select2" onchange="getTalukaByBranch(),getValue()"> -->
                         <select style="width: 100%;;" name="branch_id" id="branch_id" class="form-control select2" >
                             <option value="0" selected>--Branch--</option>
                         </select>
                     </div>
                     <div class="col-md-2">
                         <!-- <label name="taluka_id" id="taluka_id" class="form-control"></label> -->
                          <select class="form-control sel_taluka_id" id="sel_taluka_id" name="sel_taluka_id">
                                <option value="">Select Taluka</option>
                                <?php foreach($AllTaluka as $talukaKey => $talukaValue){?>
                                    <option value="<?php echo $talukaValue['taluka_id'];?>"><?php echo $talukaValue['taluka_name'];?></option>
                                <?php } ?>
                          </select>
                     </div>
                     <!-- <div class="col-md-3">
                         <label name="zone_id" id="zone_id" class="form-control"></label>
                     </div> -->

                     <div class="col-md-2">
                         <select style="width: 100%;;" name="sel_category_id" id="sel_category_id" class="form-control select2" >
                             <option value="0" selected>--Select Category--</option>
                             <?php foreach($getAllCategory as $CatKey => $CatValue){?>
                                <option value="<?php echo $CatValue['cat_id']?>"><?php echo $CatValue['cat_name']?></option>
                            <?php }?>
                         </select>
                     </div>
                     <div class="col-md-2">
                         <select style="width: 100%;;" name="sel_sub_category_id" id="sel_sub_category_id" class="form-control sel_sub_category_id select2">
                             <option value="0" selected>--Select SubCategory--</option>
                             <?php foreach($getAllSubCategory as $SubCatKey => $SubCatValue){?>
                                <option value="<?php echo $SubCatValue['sub_cat_id']?>"><?php echo $SubCatValue['sub_cat_name']?></option>
                            <?php }?>
                             <?php ?>
                         </select>
                     </div>
                     <div class="col-md-2">
                             <button class="btn btn-info btn-sm" id="showInventoryData" onclick="getValue()">Show</button>
                         </div>
                     
                     <?php if ($_SESSION['login_role'] != 1 && $_SESSION['login_role'] != 8 && $_SESSION['login_role'] != 7) { ?>
                         <div class="col-md-2">
                             <!-- <button class="btn btn-success" data-toggle="modal" data-target="#ModalSWNK" title="Create Ticket For Only Software & Network">Create Ticket</button> -->
                             <button class="btn btn-success" id="ModalSWNKForm" title="Create Ticket For Only Software & Network">Create Ticket</button>
                         </div>
                     <?php } ?>
                 </div>
             </div>

         </div>

         <br>
         <div class="container">
             <div class="table-responsive">
                 <table id="eventsTable" class="table table-striped table-condensed table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                     <thead>
                         <tr>
                             <th width="1%">Sr. No.</th>

                             <th class="text-nowrap">Item / Model name</th>
                             <th class="text-nowrap">Taluka</th>
                             <th class="text-nowrap">Branch</th>
                             <th class="text-nowrap">Zone</th>
                             <th class="text-nowrap">Brand</th>
                             <th class="text-nowrap">Category</th>
                             <th class="text-nowrap">Sub-Category</th>
                             <th class="text-nowrap">Serial No.</th>
                             <th class="text-nowrap">Ip Address</th>
                             <th class="text-nowrap">PO date.</th>
                             <th class="text-nowrap">Po No.</th>
                             <th class="text-nowrap">Supplier Name</th>
                             <th class="text-nowrap">Warranty Period</th>
                             <th class="text-nowrap">Make Date</th>
                             <th class="text-nowrap">Expiry Date</th>
                             <th class="text-nowrap">Action</th>

                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>
             </div>

         </div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Add Dead / Movement Stock</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <input type="hidden" id="idnew" name="idnew" class="form-control">
                         <select name="status" id="status" class="form-control">
                             <option selected value="" disabled>Select Option</option>
                             <option value="3">Movement Stock</option>
                             <option value="4">Dead Stock</option>
                             <option value="7">Repair Stock</option>
                         </select>
                         <br>
                         <textarea name="reasone" id="reasone" class="form-control">NA</textarea>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-primary" onclick="DeadStock()">Save changes</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>

 <!-- The Modal Software and Network -->
 <div class="fade modal" id="ModalSWNK">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <h5 class="modal-title">Create Ticket For Software & Network</h5>
                 <button type="button" class="btn btn-danger btn-sm close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <!-- <form method="post" id="newTicketFormSWNK" enctype="multipart/form-data"> -->
                 <form id="newTicketFormSWNK" enctype="multipart/form-data">

                     <input type="hidden" id="sw_talukaId" name="sw_talukaId" />
                     <input type="hidden" id="sw_branch_id" name="sw_branch_id" />
                     <input type="hidden" id="sw_zoneId" name="sw_zoneId" />

                     <div class="row">
                         <div class="col-md-4 input-padd">
                             <label>Category<sup class="text-danger">*</sup></label>
                             <select class="form-control sw_cat_id  " id="sw_cat_id" name="sw_cat_id" required>
                                 <option value="">Select Category</option>
                                 <?php foreach ($onlyeSWNKCategortList as $key => $category) { ?>
                                     <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name'] ?></option>
                                 <?php } ?>
                             </select>
                         </div>

                         <div class="col-md-4 input-padd">
                             <label>Sub Category<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="sw_sub_cat_id" name="sw_sub_cat_id" required>
                                 <option>Select subcategory</option>
                                 <?php foreach ($onlyeSWNKSUBCategortList as $subcatKey => $subcategoryList) {  ?>
                                     <option value="<?php echo $subcategoryList['sub_cat_id'] ?>"><?php echo $subcategoryList['sub_cat_name'] ?></option>
                                 <?php } ?>
                             </select>
                         </div>

                         <div class="col-md-4 input-padd" id="brand_div">
                             <label>Brand<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="sw_brand_id" name="sw_brand_id" required>
                                 <option value="">Select Brand</option>
                                 <?php foreach ($getAllBrand as $brandKey => $brandValue) {  ?>
                                     <option value="<?php echo $brandValue['brand_id'] ?>"><?php echo $brandValue['brand_name'] ?></option>
                                 <?php } ?>
                             </select>
                         </div>

                         <div class="col-md-6 input-padd">
                             <label>Attachment</label>
                             <input type="file" class="form-control" id="sw_attachment" name="sw_attachment" required="" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" />
                         </div>

                         <div class="col-md-6 form-group">
                             <br>
                             <label>Select Support Team<sup class="text-danger">*</sup></label>
                             <select style="width: 100%;z-index: 999;" class="form-control select2 sw_user_id" id="sw_user_id" name="sw_user_id" required>
                                 <!-- <option value="" selected>--Users--</option>
                                 <?php #foreach ($allusers as $uid => $user) { 
                                    ?>
                                     <option value="<?php #echo $user['user_id'] 
                                                    ?>"><?php #echo $user['name'] 
                                                        ?></option>
                                 <?php #} 
                                    ?> -->
                                 <option selected value="<?php echo $_SESSION['login_user_id']; ?>"><?php echo $_SESSION['login_name']; ?></option>
                             </select>
                         </div>

                         <div class="col-md-12 ">
                             <label>Ticket Title<sup class="text-danger">*</sup></label>

                             <select class="form-control select2 sw_ticket_title" id="sw_ticket_title" name="sw_ticket_title" required style="width: 100%;">
                                 <option value="">Select Title</option>
                             </select>

                         </div>
                         <div class="col-md-12 ">
                             <label>Ticket Description</label>
                             <textarea class="form-control" name="sw_description" id="sw_description"></textarea>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Add Ticket</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 </div>
 <!-- The Modal Hardware and ATM and Tower RF -->
 <div class="fade modal" id="ModalHRDATM">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <h5 class="modal-title">Create Ticket For Harware & ATM</h5>
                 <button type="button" class="btn btn-danger btn-sm close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <form id="newTicketFormHWATM" enctype="multipart/form-data">

                     <input type="hidden" id="hw_talukaId" name="hw_talukaId" />
                     <input type="hidden" id="hw_branch_id" name="hw_branch_id" />
                     <input type="hidden" id="hw_zoneId" name="hw_zoneId" />

                     <div class="row">
                         <div class="col-md-4 input-padd">
                             <label>Category<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="hrd_cat_id" name="hrd_cat_id" required>
                             </select>
                         </div>

                         <div class="col-md-4 input-padd">
                             <label>Sub Category<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="hrd_sub_cat_id" name="hrd_sub_cat_id" required>
                             </select>
                         </div>

                         <div class="col-md-4 input-padd" id="brand_div">
                             <label>Brand<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="hrd_brand_id" name="hrd_brand_id" required="">
                             </select>
                         </div>

                         <div class="col-md-4 input-padd" id="item_div">
                             <label>Item<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="hrd_inventory_id" name="hrd_inventory_id" required="">
                             </select>
                         </div>
                         <div class="col-md-4 input-padd">
                             <label>Attachment</label>
                             <input type="file" class="form-control" id="hrd_attachment" name="hrd_attachment" required="" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
                         </div>
                         <div class="col-md-4 input-padd">
                             <label>Select Support Team<sup class="text-danger">*</sup></label>
                             <select class="form-control" id="hrd_user_id" name="hrd_user_id" required="">
                                 <option value="<?php echo $_SESSION['login_user_id']; ?>"><?php echo $_SESSION['login_name']; ?></option>
                             </select>
                         </div>

                         <div class="col-md-12 input-padd">
                             <label>Ticket Title<sup class="text-danger">*</sup></label>

                             <select class="form-control" id="hrd_ticket_title" name="hrd_ticket_title" required="" onchange="">
                             </select>

                         </div>
                         <div class="col-md-12 input-padd">
                             <label>Ticket Description</label>
                             <textarea class="form-control" name="hrd_description" id="hrd_description"></textarea>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Add Ticket</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script type="text/javascript">
     $(document).ready(function() {
         $("#branch_id").select2({
             placeholder: "Select Branch"
         });

        //  $(document).ajaxSend(function() {
        //         $("#overlay").fadeIn(300);　
        //     });

        loader();

         $("#branch_id").empty();
         var sel_taluka_id = 0;
         var branch_id = 0;
         var zone_id = 0;
         var sel_category_id=0;
         var sel_sub_category_id=0;
        //  callDatatable(sel_taluka_id,zone_id, branch_id);

        //  callDatatable(branch_id,sel_taluka_id, sel_category_id,sel_sub_category_id);
        
         getBranch(zone_id);

        //  $("#showInventoryData").on("click",function(){
        //     var branch_id           = $("#branch_id").val();
        //     var sel_taluka_id       = $("#sel_taluka_id").val();
        //     var sel_category_id     = $("#sel_category_id").val();
        //     var sel_sub_category_id = $("#sel_sub_category_id").val();
        //     alert("Show Inventory"+branch_id+sel_taluka_id+sel_category_id+sel_sub_category_id);
        //     callDatatable(branch_id,sel_taluka_id, sel_category_id,sel_sub_category_id);
        //  });
     });

     $("#sw_cat_id").change(function() {
         var cat_id = $("#sw_cat_id").val();
         var subcategorydata = <?php echo json_encode($onlyeSWNKSUBCategortList); ?>;
         var output = '<option value="">Select Subcategory</option>';
         $("#sw_sub_cat_id").empty();
         for (let index = 0; index < subcategorydata.length; index++) {
             if (subcategorydata[index].cat_id == cat_id) {
                 output += "<option value='" + subcategorydata[index].sub_cat_id + "'>" + subcategorydata[index].sub_cat_name + "</option>";
             }
         }
         $("#sw_sub_cat_id").html(output);
     });

    //  function callDatatable(taluka_id, zone_id, branch_id) {
     function callDatatable(branch_id,sel_taluka_id, sel_category_id,sel_sub_category_id){

       loader();

         var myTable = $('#eventsTable').DataTable({
             dom: "Bfrtip",
             "bDestroy": true,
             "autoWidth": true,
             "scrollX": true,
             "ajax": {
                 "url": "<?php echo base_url(); ?>Ajax/getInventoryStockAdmin/",
                 dataSrc: '',
                 dataType: "JSON",
                 type: "POST",
                 data: {
                     taluka_id: sel_taluka_id,
                     branch_id: branch_id,
                     cat_id: sel_category_id,
                     sub_cat_id: sel_sub_category_id,
                 }
             },
             "pageLength": 25,
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
                     "data": "id",
                     render: function(data, type, row, meta) {
                         return meta.row + meta.settings._iDisplayStart + 1;
                     }
                 },
                 {
                     "data": "item_name"
                 },
                 {
                     "data": "taluka_name"
                 },
                 {
                     "data": "branch_name"
                 },
                 {
                     "data": "zone_name"
                 },
                 {
                     "data": "brand_name"
                 },
                 {
                     "data": "cat_name"
                 },
                 {
                     "data": "sub_cat_name"
                 },
                 {
                     "data": "serial_no"
                 },
                 {
                     "data": "ip_address"
                 },

                 {
                     data: "po_date",
                     render: $.fn.dataTable.render.moment('DD-MM-YYYY')
                 },
                 {
                     "data": "po_no"
                 },
                 {
                     "data": "supplier_name"
                 },
                 {
                     "data": "warranty"
                 },
                 {
                     "data": "make_date",
                     //  render: $.fn.dataTable.render.moment('DD-MM-YYYY')
                 },
                 {
                     data: "exp_date",
                     render: $.fn.dataTable.render.moment('DD-MM-YYYY')
                 },
                 {
                     "data": "id",
                     "render": function(data, type, row, meta) {
                         if (type === 'display') {
                             data = '<a type="button" class="btn btn-primary btn-sm" href="<?= base_url(); ?>Inventory/new_item_view/' + data + '">View</a> <a type="button" class="btn btn-success  btn-sm" href="<?= base_url(); ?>Inventory/edit_inventory/' + data + '">Edit</a> <button type="button" onclick="DeadStock1(' + data + ');"  class="btn btn-warning btn-sm"data-toggle="modal" data-target="#exampleModal">Dead / Movement Stock </button> <button type="button" onclick="deleteData(' + data + ');"  class="btn btn-danger btn-sm">Delete </button>';


                         }
                         return data;
                     }
                 }
             ]
         });
         myTable
             .order([0, 'desc'])
             .draw();
     }

     function getTalukaByBranch() {
         var talukaId = $('#branch_id option:selected').attr('data-talukaId');
         var zoneId = $('#branch_id option:selected').attr('data-zoneId');
         if ($('#branch_id').val() != '' || $('#branch_id').val() != null) {
             $.ajax({
                 url: "<?php echo base_url(); ?>Ajax/getTalukaByBranch/", //the page containing php script
                 type: "post", //request type,
                 dataType: 'json',
                 data: {
                     talukaId: talukaId,
                     zoneId: zoneId
                 },
                 success: function(result) {
                     $("#taluka_id").attr("data-talukaId", result[0].taluka_id).html("Taluka : " + result[0].taluka_name);
                     $("#zone_id").attr("data-zoneId", result[0].zone_id).html("Zone : " + result[0].zone_name);
                 }
             });
         }

     }
 </script>
 <script>
     function getBranch(zone_id) {
         $("#branch_id").empty();
         //  $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjax/" + zone_id, function(data) {
         $.getJSON("<?php echo base_url(); ?>Ajax/getBranchAjaxAdmin/", function(data) {
             var stringToAppend = "<option disabled selected value='' >--Branch--</option> ";
             $.each(data, function(key, val) {
                 stringToAppend += "<option value='" + val.branch_id + "' data-talukaId='" + val.taluka_id + "' data-zoneId='" + val.zone_id + "'>" + val.branch_code + " - " + val.branch_name + "</option>";
             });
             //  $("#branch_id").html(stringToAppend);
             $("#branch_id").append(stringToAppend);
         });
     }
     function getSubCategory(cat_id) {
         $.getJSON("<?php echo base_url(); ?>Ajax/getSubCategoryAjax/" + cat_id, function(data) {
             var stringToAppend = "<option disabled selected value=''> --Sub Category-- </option> ";
             $.each(data, function(key, val) {
                 stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
             });
             $("#sub_cat_id").html(stringToAppend);
         });
     }

     function getValue() {
        //  var taluka_id = $('#taluka_id').val();
        //  var branch_id = $('#branch_id').val();
        //  var zone_id = $('#zone_id').val();

         var branch_id           = $("#branch_id").val();
         var sel_taluka_id       = $("#sel_taluka_id").val();
         var sel_category_id     = $("#sel_category_id").val();
         var sel_sub_category_id = $("#sel_sub_category_id").val();
        //  alert("Show Inventory"+branch_id+sel_taluka_id+sel_category_id+sel_sub_category_id);
        
         //  if (taluka_id != null && zone_id != null && branch_id != null) {
         if (branch_id != null || sel_taluka_id != '' || sel_category_id != '' || sel_sub_category_id !='') {
            //  callDatatable(taluka_id, zone_id, branch_id);
            callDatatable(branch_id,sel_taluka_id, sel_category_id,sel_sub_category_id);
         } else {
             //  alert('Please Select Taluka, Zone , Branch');
             //  alert('Please Select Branch');
         }
     }

     function DeadStock() {
         var id = $("#idnew").val();
         var status = $("#status").val();
         var reasone = $("#reasone").val();
       
         var allfields = true;

         if (status == "" || status == null) {
             if ($("#status").next(".validation").length == 0) // only add if not added
             {
                 $("#status").after("<div class='validation' style='color:red;margin-bottom:15px;'>This value is required </div>");
             }
             if (!focusSet) {
                 $("#status").focus();
             }
             allfields = false;
         } else {
             $("#status").next(".validation").remove(); // remove it
         }


         if (allfields) {
            if(status == 3){
                var result = confirm("Are you sure  want to Move this stock ?");
            }
            if(status == 4){
             var result = confirm("Are you sure  want to add in dead stock ?");
            }
            if(status == 7){
             var result = confirm("Are you sure  want to repair this stock ?");
            }
             if (result) {
                 var formData = {
                     id: id,
                     status: status,
                     reasone: reasone,
                 };
               
                 $.ajax({
                     url: "<?php echo base_url(); ?>Ajax/deadStock/",
                     type: "POST",
                     data: formData,
                     success: function(data, textStatus, jqXHR) {
                        //  $('#exampleModal').modal('toggle');
                         $("[data-dismiss=modal]").trigger({ type: "click" });
                         alert('Updated');
                         callDatatable();
                     },
                     error: function(jqXHR, textStatus, errorThrown) {

                     },
                    //  complete: function(){
                    //     setTimeout(function(){
                    //         $("#overlay").fadeOut(300);
                    //     },300);
                    // },
                 });
             }  

         }

     }

     function DeadStock1(id) {
         $("#idnew").val(id);
     }

     function deleteData(id) {
         var result = confirm("Are you sure to deleted it ?");
         if (result) {
             $.ajax({
                 url: "<?php echo base_url(); ?>Inventory/deleteInventory/" + id,
                 success: function(data, textStatus, jqXHR) {
                     alert('Deleted');
                     callDatatable();
                 },
                 error: function(jqXHR, textStatus, errorThrown) {

                 }
             });
         }
     }
 </script>