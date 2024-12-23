

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
    $("#amount").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('#allowance_months').on('change', function () {
        var months = this.value;
        var amount = $('#amount').val();
        if(amount == 0 || amount == ""){
            if ($("#amount").next(".validation").length == 0) // only add if not added
            {
                $("#amount").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter amount.</div>");

            }
            $("#amount").focus();
            
        } else {
            $("#amount").next(".validation").remove(); // remove it
        }
        if (amount!= "" && amount != "0" && months !=""){
            var perMonth = Math.ceil(amount/months);
            $('#per_month').val(perMonth);
        }
          
    });
    $('#amount').on('change', function () {
        var amount = this.value;
        var months = $('#allowance_months').val();    
           
        if (amount!= "" && amount != "0" && months !=""){
            var perMonth = Math.ceil(amount/months);
            $('#per_month').val(perMonth);
        }
          
    });


    $('#add_form  .errorbox').css('display', 'none');
    $('#add_form .successbox').css('display', 'none');
    $("#search_form input[type='text']").on("keyup", function () {
        if ($(this).val() != "") {
            $("#searchBtn").removeAttr("disabled");
        } else {
            $("#searchBtn").attr("disabled", "disabled");
        }
    });
    $("#add_form input[type='text'], textarea,select").on("keyup", function () {
        if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0) {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });
    $('#add_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
        var allowance_type = $("#allowance_type").val();
        var allowance_months = $("#allowance_months").val();
        var description = $("#description").val();
        var amount = $("#amount").val();
        var starting_month = $("#starting_month").val();
        
        amount = amount.trim();
        description = description.trim();

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
        if (amount == 0 || amount == "") {
            if ($("#amount").next(".validation").length == 0) // only add if not added
            {
                $("#amount").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter amount.</div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#amount").focus();
            }
        } else {
            $("#amount").next(".validation").remove(); // remove it
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



});