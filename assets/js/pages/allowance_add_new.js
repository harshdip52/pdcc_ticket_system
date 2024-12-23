

$(document).ready(function () {
    // pincode validation
    $("#pensioner_id").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("#ppo_id").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("#allowance_amount").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $("#allowance_percentage").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    $('#add_form  .errorbox').css('display', 'none');
    $('#add_form .successbox').css('display', 'none');
   
    $("#add_form input[type='text'],select,textarea").on("keyup change", function () {
       // alert("= " +$(this).val() );
        if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0 && $("#starting_month").val() != "" && $("#ending_month").val() != "") {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });
    
//     $('#add_form').on('change', '#starting_month', function (e) {
       
//        if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0 && 
//        $("#add_form input[type='text']").val() != "" && $("#ending_month").val() != "" ) {
//            $("#DoSubmit").removeAttr("disabled");
//        } else {
//            $("#DoSubmit").attr("disabled", "disabled");
//        }
//    });
//    $('#add_form').on('change', '#ending_month', function (e) {
   
//     if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0 && 
//     $("#add_form input[type='text']").val() != "" && $("#starting_month").val() != "" ) {
//        $("#DoSubmit").removeAttr("disabled");
//    } else {
//        $("#DoSubmit").attr("disabled", "disabled");
//    }
// });
    $('#add_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
        var pensioner_type =   $('input[name=pensioners_type]:checked', '#add_form').val();
       
        if(pensioner_type == 2){
            var ppo_id = $("#ppo_id").val();
            ppo_id = ppo_id.trim();
        }
        // if (!$("input[name='add_amount_by']:checked").val()) {
        //     alert('Nothing is checked!');
        //      return false;
        //  }
        //  else {
        //    alert('One of the radio buttons is checked!');
        //  }
        if ($("input[name='add_amount_by']:checked").val()){
            var val = $("input[name='add_amount_by']:checked").val()
            if(val == 1){
                var allowance_percentage = $("#allowance_percentage").val();
                allowance_percentage = allowance_percentage.trim();
            }else{
                var allowance_amount = $("#allowance_amount").val();
                allowance_amount = allowance_amount.trim();
            }
        }        
        var allowance_type = $("#allowance_type").val();       
        var description = $("#description").val();       
        var starting_month = $("#starting_month").val();     
        var ending_month = $("#ending_month").val();   
        description = description.trim();
        if(pensioner_type == 2){
            if (ppo_id == 0 || ppo_id == "") {
                if ($("#ppo_id").next(".validation").length == 0) // only add if not added
                {
                    $("#ppo_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter ppo id.</div>");
    
                }
                // e.preventDefault(); // prevent form  POST to server
                allFields = false;
                if (!focusSet) {
                    $("#ppo_id").focus();
                }
            } else {
                $("#ppo_id").next(".validation").remove(); // remove it
            }
        }       
       
        if (!$("input[name='add_amount_by']:checked").val()){
           // alert('Nothing is checked!');
            if ($("#add_amount_by").next(".validation").length == 0) // only add if not added
                {
                    $("#add_amount_by").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select calculation type</div>");           
                
                allFields = false;
                if (!focusSet) {
                    $("#add_amount_by").focus();
                }
            }        
            else {
                $("#add_amount_by").next(".validation").remove(); // remove it
            }
        }else{
           // alert('checked!');
            $("#add_amount_by").next(".validation").remove(); // remove it
            var val = $("input[name='add_amount_by']:checked").val()
            if(val == 2){
                if (allowance_amount == 0 || allowance_amount == "") {
                    if ($("#allowance_amount").next(".validation").length == 0) // only add if not added
                    {
                        $("#allowance_amount").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter allowance amount.</div>");
        
                    }
                    // e.preventDefault(); // prevent form  POST to server
                    allFields = false;
                    if (!focusSet) {
                        $("#allowance_amount").focus();
                    }
                } else {
                    $("#allowance_amount").next(".validation").remove(); // remove it
                }
            }else{
                if (allowance_percentage == 0 || allowance_percentage == "") {
                    if ($("#allowance_percentage").next(".validation").length == 0) // only add if not added
                    {
                        $("#allowance_percentage").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter allowance percentage.</div>");    
                    }
                    // e.preventDefault(); // prevent form  POST to server
                    allFields = false;
                    if (!focusSet) {
                        $("#allowance_percentage").focus();
                    }
                } else {
                    $("#allowance_percentage").next(".validation").remove(); // remove it
                }
            }
        }
        
        if (!description.length) {
            if ($("#description").next(".validation").length == 0) // only add if not added
            {
                $("#description").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter description. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#description").focus();
            }
        } else {
            $("#description").next(".validation").remove(); // remove it
        }       
        if (starting_month == "") {
            if ($("#starting_month").next(".validation").length == 0) // only add if not added
            {
                $("#starting_month").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select starting month</div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#starting_month").focus();
            }
        } else {
            $("#starting_month").next(".validation").remove(); // remove it
        }
        if (ending_month == "") {
            if ($("#ending_month").next(".validation").length == 0) // only add if not added
            {
                $("#ending_month").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select ending month</div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#ending_month").focus();
            }
        } else {
            $("#ending_month").next(".validation").remove(); // remove it
        }
        //var d = Date.parse("2011-01-26 13:51:50 GMT") / 1000;
      
        /*var sdate = starting_month;        
        sdate  = sdate.replaceAll('-', '/');        
        sdate = '01/'+sdate;       
        const startDate = new Date(sdate);

        var edate = ending_month;        
        edate  = edate.replaceAll('-', '/');        
        edate = '01/'+edate;       
        const endDate = new Date(edate);

       
        const diffTime = (endDate - startDate);*/
       // alert (diffTime);
        //const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        //console.log(diffTime + " milliseconds");
        //console.log(diffDays + " days");
       /* if(diffTime <= 0  ){
            alert("Please select end date greater than start date ");
            allFields = false;
            $("#DoSubmit").removeAttr("disabled");
        }else{
            //alert("no error");
            $("#DoSubmit").removeAttr("disabled");
            allFields = true;
        }*/
        
        if (allFields) {
            var url = $('#add_form').attr('action');
            var formdata = document.getElementById("add_form");
            var fd = new FormData(formdata);

            jQuery.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status == 0) {
                        $('.errorbox').show().text(res.message);
                    } else {   
                        $('.successbox').show().text(res.message);

                        var base_url = $('#base_url').val();
                        window.location.href = base_url;
                    }
                },
                error: function (xhr, status, error) {
                    //toastr.error('Failed to add '+xData.name+' in wishlist.');
                    console.log(error);
                }
            });
        }

    });


    $('#search_form').on('click', '#searchBtn', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
        var pensioner_id = $("#pensioner_id").val();
       
        if (pensioner_id == "" || pensioner_id == "0") {
            if ($("#pensioner_id").next(".validation").length == 0) // only add if not added
            {
                $("#pensioner_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter pensioner id. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#pensioner_id").focus();
            }
        } else {
            $("#pensioner_id").next(".validation").remove(); // remove it
        }
        if (allFields) {
            var url = $('#search_form').attr('action');
            var formdata = document.getElementById("search_form");
            var fd = new FormData(formdata);
            jQuery.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status == 0) {
                        $('#error').show().text(res.message);
                    } else if (res.status == 1) {
                        $('#error').css({ 'display': 'none' });
                        $('#add_allowance_block').css({ 'display': 'block' });

                        var selectbox = $('#allowance_type');
                        selectbox.empty();
                        // $('#allowance_type').append('<option value="" selected disabled>' + "Select Reason" + '</option>');
                        $.each(res.allowanceTypes, function (index, value) {
                            $('#allowance_type').append('<option value="' + value.allowance_type_id + '">' + value.allowance_type_name + '</option>');
                        });
                        var p = res.pensionerDetails;
                        var name = p.first_name+ " " + p.middle_name+ " " +p.last_name;
                       
                        $('#pensionerId').val(pensioner_id);
                        $('#pensioner_name').val(name);
                        $('#ppo_no').val(p.ppo_id);
                        $('#pensioner_id').attr("disabled", "disabled");
                    }

                },
                error: function (xhr, status, error) {
                    //toastr.error('Failed to add '+xData.name+' in wishlist.');
                    console.log(error);
                }
            });
        }

    });

    $('input[type=radio][name=pensioners_type]').change(function() {
        if (this. value == 2) {
           
            $("#ppo_id_pensioner").show();
        }else{
            $("#ppo_id_pensioner").hide();
        }           
    });  
    
    $('input[type=radio][name=add_amount_by]').change(function() {
        if (this. value == 1) {           
            $("#formula").show();
            $("#fixed_amount").hide();
        }else{
            $("#formula").hide();
            $("#fixed_amount").show();
        }           
    });  
   
});