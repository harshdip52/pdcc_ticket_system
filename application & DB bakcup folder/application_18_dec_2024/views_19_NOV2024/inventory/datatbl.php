<div class="sidebar-bg hide_in_print"></div>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active">Inventory Dashboard</li>
    </ol>
    <h1 class="page-header">List</h1>
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <?=$this->session->flashdata('message_name');?>
            <h4 class="panel-title">Inventory List</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class=".col-md-4"> 
                    <select name="taluka_id" id="taluka_id" style="  padding: 5px 20px"onchange="getBranch(this.value)" >
                        <option value="0" selected disabled>--Taluka--</option>
                        <?php foreach ($AllTaluka as $key => $Taluka) {?>
                        <option value="<?=$Taluka['taluka_id']?>"><?=$Taluka['taluka_name']?></option>
                        <?php }?>
                    </select> 
                    <select name="branch_id" id="branch_id" style="  padding: 5px 20px" onchange="getZone(this.value)">
                        <option value="0"selected disabled>--Branch--</option>
                    </select> 
                    <select name="zone_id" id="zone_id" style="  padding: 5px 20px">
                        <option value="0" selected disabled>--Zone--</option>
                    </select> 
                    <select name="brand_id" id="brand_id" style="  padding: 5px 20px">
                        <option value="0">--Brand--</option>
                        <?php foreach ($getAllBrand as $key => $Brand) {?>
                        <option value="<?=$Brand['brand_id']?>"><?=$Brand['brand_name']?></option>
                        <?php }?>
                    </select> 
                    <select name="cat_id" id="cat_id" style="  padding: 5px 20px" onchange="getSubCategory(this.value)">
                        <option value="0">--Category--</option>
                        <?php foreach ($getAllCategory as $key => $Category) {?>
                        <option value="<?=$Category['cat_id']?>"><?=$Category['cat_name']?></option>
                        <?php }?>
                    </select> 
                    <select name="sub_cat_id" id="sub_cat_id" style="  padding: 5px 10px">
                        <option value="0">--Sub Category--</option>
                    </select>
                    <button class="btn btn-success" onclick="getValue()">Search</button>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table id="eventsTable"
                    class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th width="1%">Sr. No.</th>
                            <th class="text-nowrap">Item name</th>
                            <th class="text-nowrap">Taluka</th>
                            <th class="text-nowrap">Branch</th>
                            <th class="text-nowrap">Zone</th>
                            <th class="text-nowrap">Brand</th>
                            <th class="text-nowrap">Category</th>
                            <th class="text-nowrap">Sub-Category</th> 
                            <th class="text-nowrap">Serial No.</th>
                            <th class="text-nowrap">Ip Address</th>
                            <th class="text-nowrap">Make Date</th>
                            <th class="text-nowrap">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
<script type="text/javascript">
    $(document).ready(function () 
    {
        var taluka_id =0;
        var branch_id =0;
        var zone_id =0;
        var brand_id =0;
        var cat_id =0;
        var sub_cat_id =0;
        callDatatable(taluka_id,branch_id,zone_id,brand_id,cat_id,sub_cat_id);
    });

    function callDatatable(taluka_id,branch_id,zone_id,brand_id,cat_id,sub_cat_id)
    {  
        var myTable = $('#eventsTable').DataTable({
            dom: "Bfrtip",
            "bDestroy": true,
            "autoWidth": true,
            "scrollX": true,
            "ajax": 
            {
                "url": "<?php echo base_url();?>Ajax/getInventoryStock/",
                dataSrc: '',
                dataType:"JSON",
                type: "POST",
                data: 
                {
                    taluka_id: taluka_id,
                    branch_id: branch_id, 
                    zone_id: zone_id, 
                    brand_id: brand_id, 
                    cat_id: cat_id, 
                    sub_cat_id: sub_cat_id, 
                }
            },
            "pageLength": 25,
            buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'print',
                    exportOptions:
                    {
                        columns: [0, ':visible']
                    }
                },
                ]
                } , 'colvis'
                ],
                "columns": [
                {
                    "data": "inventory_id",
                    render: function (data, type, row, meta) 
                    {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {"data": "item_name"},
                {"data": "taluka_name"},
                {"data": "branch_name"},
                {"data": "zone_name"},
                {"data": "brand_name"},
                {"data": "cat_name"},
                {"data": "sub_cat_name"},
                {"data": "serial_no"},
                {"data": "ip_address"},
                {"data": "make_date"},
                {
                    "data": "inventory_id",
                    "render": function (data, type, row, meta) 
                    {
                        if (type === 'display') 
                        {
                            data = '<a type="button" class="btn btn-primary" href="<?= base_url();?>Inventory/new_item_view/' + data + '">View</a> <a type="button" class="btn btn-success" href="<?= base_url();?>Inventory/new_item_edit/' + data + '">Edit</a> <button type="button" onclick="DeadStock(' + data + ');"  class="btn btn-warning" data-toggle ="modal" data-target=".bs-example-modal-lg ">Dead Stock </button>';
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
            <script>
    function getBranch(taluka_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getBranchAjax/"+taluka_id, function (data) {
      var stringToAppend = "<option disabled selected value=''>--Branch--</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.branch_id + "'>" + val.branch_name + "</option>";
      });
      $("#branch_id").html(stringToAppend); 
    });
    }

    function getZone(branch_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getZoneAjax/"+branch_id, function (data) {
      var stringToAppend = "<option disabled selected value=''>--Zone--</option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.zone_id + "'>" + val.zone_name + "</option>";
      });
      $("#zone_id").html(stringToAppend); 
    });
    }

    function getSubCategory(cat_id) 
    { 
    $.getJSON("<?php echo base_url();?>Ajax/getSubCategoryAjax/"+cat_id, function (data) {
      var stringToAppend = "<option disabled selected value=''> --Sub Category-- </option> ";
      $.each(data, function (key, val) 
      {
        stringToAppend += "<option value='" + val.sub_cat_id + "'>" + val.sub_cat_name + "</option>";
      });
      $("#sub_cat_id").html(stringToAppend); 
    });
    }
    function getValue()
    {
        var taluka_id= $('#taluka_id :selected').val(); 
        var branch_id= $('#branch_id :selected').val(); 
        var zone_id= $('#zone_id :selected').val(); 
        var brand_id= $('#brand_id :selected').val(); 
        var cat_id= $('#cat_id :selected').val(); 
        var sub_cat_id= $('#sub_cat_id :selected').val();  

        callDatatable(taluka_id,branch_id,zone_id,brand_id,cat_id,sub_cat_id);

    }

    function DeadStock(inventory_id) {
        var result = confirm("Are you sure  want to add in dead stock ?");
        if (result) {
            var formData = {inventory_id: inventory_id};
            $.ajax({
                url: "<?php echo base_url();?>Ajax/deadStock/",
                type: "POST",
                data: formData,
                success: function (data, textStatus, jqXHR) { 
                    alert('Table Updated');
                    callDatatable();
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

    }

</script>