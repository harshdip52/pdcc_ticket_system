$(document).ready(function () {
    $('.errorbox1').css('display', 'none');
    $('.successbox1').css('display', 'none');
    $("#master_form input[type='text']").on("keyup", function () {
        if ($(this).val() != "") {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });
   
    $('#master_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();

        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');

        $('.errorbox1').css('display', 'none');
        $('.successbox1').css('display', 'none');
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
           
                var url = $('#master_form').attr('action');
                var userForm = document.getElementById("master_form");
                var fd = new FormData(userForm);

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
                            $("#DoSubmit").removeAttr("disabled");
                        } else if (res.status == 1) {                           
                            $('.successbox').show().text(res.message);
                            $("#DoSubmit").removeAttr("disabled");
                            // $('#master_form').each(function () {this.reset();});
                            setTimeout(function () { window.location.reload() }, 2000);
                        }
                    },
                    error: function (xhr, status, error) {
                        //toastr.error('Failed to add '+xData.name+' in wishlist.');
                        console.log(error);
                    }
                });
            
        }
    });
    $('#allRecords').on('click', '.lockRecord', function (e) {
        e.preventDefault();
        const $root = $(this);
        var month = $root.data('month');
        var year = $root.data('year');
        var c = confirm("Are you sure to lock this month pension?");

        if (c == true) {
            $.post("lockPensionMonth/", {
                month: month,year:year
            }, function (res) {
                if (res.status == 0) {
                    $('.errorbox').show().text("Error,Please try again.");
                } else {
                                    
                    $('.successbox').show().text("Selected month locked successfully.");

                    setTimeout(function () { window.location.reload() }, 1000);
                }
            });
        }
    });
   
});