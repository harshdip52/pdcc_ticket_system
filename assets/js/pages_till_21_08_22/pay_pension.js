$(document).ready(function () {
    $('.errorbox').css('display', 'none');
    $('.successbox').css('display', 'none');
    $("#master_form input[type='text']").on("keyup", function () {
        if ($(this).val() != "") {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
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
    $("#basic_pension").keydown(function (e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $('#master_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();

        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');

        $('.errorbox').css('display', 'none');
        $('.successbox').css('display', 'none');
        var focusSet = false;
        var allFields = true;
        var month = $("#month").val();//select  
       
        month = month.trim();
        if (month == "") {
            if ($("#month").next(".validation").length == 0) // only add if not added
            {
                $("#month").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select month.</div>");
            }
            allFields = false;
            if (!focusSet) {
                $("#month").focus();
            }
        } else {
            $("#month").next(".validation").remove(); // remove it
        }
        ///////////////////////////////////////////////
        if (allFields == true) {
            var c = confirm("Are you sure to pay pension for  this month ?");
            if (c == true) {
                var url = $('#master_form').attr('action');
                var userForm = document.getElementById("master_form");
                var fd = new FormData(userForm);

                const $loader = $('.panel .ajax-loader');
				$loader.show();

                jQuery.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,

                    success: function (res) {
                        $loader.hide();
                        if (res.status == 0) {
                            $('.errorbox').show().text(res.message);
                           // alert(res.message);
                            $("#DoSubmit").removeAttr("disabled");
                        } else if (res.status == 1) {                           
                            $('.successbox').show().text(res.message);
                           // alert(res.message);
                            $("#DoSubmit").removeAttr("disabled");
                            // $('#master_form').each(function () {this.reset();});
                            setTimeout(function () { window.location.reload() }, 10000);
                        }
                    },
                    error: function (xhr, status, error) {
                        //toastr.error('Failed to add '+xData.name+' in wishlist.');
                        console.log(error);
                    }
                });
            }else{
                $("#DoSubmit").removeAttr("disabled");
            }
        }
    });
    $('#allRecords').on('click', '.lockRecord', function (e) {
        e.preventDefault();
        const $root = $(this);
        var month = $root.data('month');
        var year = $root.data('year');
        var c = confirm("Are you sure to lock this month pension?");

        if (c == true) {
            const $loader = $('.panel .ajax-loader');
			$loader.show();
            $.post("lockPensionMonth/", {
                month: month,year:year
            }, function (res) {
                $loader.hide();
                if (res.status == 0) {
                    $('.errorbox').show().text("Error,Please try again.");
                } else {
                                    
                    $('.successbox').show().text("Selected month locked successfully.");

                    setTimeout(function () { window.location.reload() }, 1000);
                }
            });
        }
    });
    /*    $('#edit_form').on('click', '#DoEdit', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
      
        var ppo_id = $("#ppo_id").val();
            ppo_id = ppo_id.trim();
        
        var basic_pension = $("#basic_pension").val();
        basic_pension = basic_pension.trim();
       
        var starting_month = $("#month").val();
       
        if (ppo_id == 0 || ppo_id == "") {
            if ($("#ppo_id").next(".validation").length == 0) // only add if not added
            {
                $("#ppo_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter ppo_id.</div>");
            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#ppo_id").focus();
            }
        } else {
            $("#ppo_id").next(".validation").remove(); // remove it
        }
        
        if (basic_pension == 0 || basic_pension == "") {
        
            if ($("#basic_pension").next(".validation").length == 0) // only add if not added
            {
                $("#basic_pension").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please  enter basic pension</div>");

                allFields = false;
                if (!focusSet) {
                    $("#basic_pension").focus();
                }
            }
            else {
                $("#basic_pension").next(".validation").remove(); // remove it
            }
        } 
       
        if (month == "") {
            if ($("#month").next(".validation").length == 0) // only add if not added
            {
                $("#month").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select  month</div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#month").focus();
            }
        } else {
            $("#month").next(".validation").remove(); // remove it
        }
       
        if (allFields) {
            var url = $('#edit_form').attr('action');
            var formdata = document.getElementById("edit_form");
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
    */
});