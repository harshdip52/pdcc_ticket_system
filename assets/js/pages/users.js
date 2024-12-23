window.onload = function () {

    $('#table_pagination').DataTable();

    // $('#dob').datepicker({
    //     format: 'dd/mm/yyyy',
    //     autoclose: 'true',
    // });
    $('#searchdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
    });
}
//check size of doc and type of image 
$('#user_form #document').on('change', function () {
    // alert(this.files[0].size + "bytes");
    var focusSet = true;
    if (this.files[0].size > 102400) {
        if ($("#imgError").next(".validation").length == 0) // only add if not added
        {
            $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
        }
        if (!focusSet) {
            $("#document").focus();
        }
    } else {
        $("#imgError").next(".validation").remove(); // remove it
    }
    // check type  start 
    var validExtensions = ['jpg', 'jpeg', 'png']; //array of valid extensions
    var fileName = $("#document").val();;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        //alert("Invalid file type");
        if ($("#imgError").next(".validation").length == 0) // only add if not added
        {
            $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png image </div>");
        }
        if (!focusSet) {
            $("#document").focus();
        }
    } else {
        $("#imgError").next(".validation").remove(); // remove it
    }
    // check type end
});

$(document).ready(function () {
    // var datePickerId = document.getElementById("dob");
    // datePickerId.max = new Date().toISOString().split("T")[0];

    // to reset form fields 
    $('#newRequest').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea")
            .val('')
            .end()
            .find("input[type=checkbox]")
            .prop("checked", "")
            .end();
        $(this)
            .find(".validation")
            .text('');
    })

    $('#user_form  .errorbox').css('display', 'none');
    $('#user_form .successbox').css('display', 'none');

  /*  $("input[type='text'],input[type='email']").on("keyup", function() {
        //alert("dob");
        if ($(this).val() != "") {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });*/
    // $('#user_form').on('change', '#dob', function (e) {
    //      //alert("dob");
    //     //if ($(this).val() != "" && $("select").val() != 0 ) {
    //     if ($(this).val() != "" ) {
    //         $("#DoSubmit").removeAttr("disabled");
    //     } else {
    //         $("#DoSubmit").attr("disabled", "disabled");
    //     }
    // });
    $('input[type=radio][name=user_type]').change(function() {
       
       if ($(this).val() == 4 ||  $(this).val() == 5 ) {
           $("#institute-row").css("display","none");
       } else {
        $("#institute-row").css("display","block");
       }
   });
    $('#user_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        
        $('.successbox1').css('display', 'none');
        var focusSet = false;
        var allFields = true;
        
        var user_type = $('#user_type').val();//radio
        var institute = $("#institute").val();//select

        var salutation = $('salutation').val();
        var first_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();

        var department = $("#department").val();
        var designation = $("#designation").val();
        var email = $("#email").val();

        first_name = first_name.trim();
        middle_name = middle_name.trim();
        last_name = last_name.trim();

        department = department.trim();
        designation = designation.trim();

        email = email.trim();

        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (salutation == "") {
            if ($("#salutation").next(".validation").length == 0) // only add if not added
            {
                $("#salutation").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select salutation.</div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#salutation").focus();
            }
        } else {
            $("#salutation").next(".validation").remove(); // remove it
        }
        if(user_type == 2  || user_type == 3){
            if (institute == 0 || institute == "") {
                if ($("#institute").next(".validation").length == 0) // only add if not added
                {
                    $("#institute").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select institute.</div>");

                }
                //e.preventDefault(); // prevent form  POST to server
                allFields = false;
                if (!focusSet) {
                    $("#institute").focus();
                }
            } else {
                $("#institute").next(".validation").remove(); // remove it
            }
        }

        if (!department.length) {
            if ($("#department").next(".validation").length == 0) // only add if not added
            {
                $("#department").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter department.</div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#department").focus();
            }
        } else {
            $("#department").next(".validation").remove(); // remove it
        }
        if (!designation.length) {
            if ($("#designation").next(".validation").length == 0) // only add if not added
            {
                $("#designation").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter designation.</div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#designation").focus();
            }
        } else {
            $("#designation").next(".validation").remove(); // remove it
        }

        if (!email.length) {
            if ($("#email").next(".validation").length == 0) // only add if not added
            {
                $("#email").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter email </div>");

            }
            e.preventDefault(); // prevent form from POST to server
            allFields = false;
            if (!focusSet) {
                $("#email").focus();
            }

        } else {
            $("#email").next(".validation").remove(); // remove it
        }
        /////////////// email validation //////////
        if (!(email.match(mailformat))) {
            if ($("#email").next(".validation").length == 0) // only add if not added
            {
                $("#email").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter valid email</div>");

            }
            e.preventDefault(); // prevent form from POST to server
            allFields = false;
            if (!focusSet) {
                $("#email").focus();
            }

        } else {
            $("#email").next(".validation").remove(); // remove it
        }

        if (!first_name.length) {
            if ($("#nameError1").next(".validation").length == 0) // only add if not added
            {
                $("#nameError1").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter first name. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#nameError1").focus();
            }
        } else {
            $("#nameError1").next(".validation").remove(); // remove it
        }
        ///////////////////////////////////////////////

       /* if (!middle_name.length) {
            if ($("#nameError2").next(".validation").length == 0) // only add if not added
            {
                $("#nameError2").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter middle name. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#nameError2").focus();
            }
        } else {
            $("#nameError2").next(".validation").remove(); // remove it
        }*/
        ///////////////////////////////////////////////

        /*if (!last_name.length) {
            if ($("#nameError3").next(".validation").length == 0) // only add if not added
            {
                $("#nameError3").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter last name. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#nameError3").focus();
            }
        } else {
            $("#nameError3").next(".validation").remove(); // remove it
        }*/

        //check size of doc and type  if newly uploaded
        if ($("#document").val() != '') {
            var fileSize = $('#document')[0].files[0].size;

            if (fileSize > 102400) {
                if ($("#imgError").next(".validation").length == 0) // only add if not added
                {
                    $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
                }
                allFields = false;
                if (!focusSet) {
                    $("#document").focus();
                }
            } else {
                $("#imgError").next(".validation").remove(); // remove it
            }
            // check type  start 
            var validExtensions = ['jpg', 'jpeg', 'png']; //array of valid extensions
            var fileName = $("#document").val();;
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            if ($.inArray(fileNameExt, validExtensions) == -1) {
                //alert("Invalid file type");
                if ($("#imgError").next(".validation").length == 0) // only add if not added
                {
                    $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png image </div>");
                }
                allFields = false;
                if (!focusSet) {
                    $("#document").focus();
                }
            } else {
                $("#imgError").next(".validation").remove(); // remove it
            }
        }
        var emailField = true;
        if (email.length) {
            jQuery.ajax({
                type: "GET",
                url: 'getUniqueEmail/?email=' + email,
                dataType: 'json',
                // data: xData,
                success: function (res) {
                    if (res.status == 0) {
                        //console.log(res);
                        if ($("#email").next(".validation").length == 0) // only add if not added
                        {
                            $("#email").after("<div class='validation' style='color:red;margin-bottom:15px;'>This email already exist ,please enter unique  email</div>");
                        }
                        emailField = false;
                        if (!focusSet) {
                            $("#email").focus();
                        }
                    } else {
                        emailField = true;
                        $("#email").next(".validation").remove(); // remove it
                    }
                    emailVerifyfunction(emailField);
                },
                error: function (xhr, status, error) {
                    //toastr.signuperr('Failed to add '+xData.name+' in wishlist.');
                    console.log(error);
                }
            });
        }
        function emailVerifyfunction(validEmail) {
            
            if (validEmail == true) {
                ///////////////////////////////////////////////
                if (allFields == true) {
                    var url = $('#user_form').attr('action');
                    var userForm = document.getElementById("user_form");
                    var fd = new FormData(userForm);

                    jQuery.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        data: fd,
                        cache: false,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        success: function (res) {

                            if (res.status == 0) {
                                $('.errorbox').show().text("Error,Please try again.");
                            } else if (res.status == 1) {
                                // console.log(res);
                                $('.successbox').show().text("New user has been added successfully.");
                                $('#user_form').each(function () {
                                    this.reset();
                                });
                                setTimeout(function () { $('#newRequest').modal('hide'); }, 1000);
                                setTimeout(function () { window.location.reload(); }, 1000);
                                setTimeout(function () { $('#user_form .successbox').css('display', 'none'); }, 1000);
                            }
                        },
                        error: function (xhr, status, error) {
                            //toastr.error('Failed to add '+xData.name+' in wishlist.');
                            console.log(error);
                        }
                    });
                }

            }
        }
    });


    $('.allUsers').on('click', '.getDetails', function (e) {
        e.preventDefault();
        const $root = $(this);
        var userid = $root.data('userid');
        var fname = $root.data('fname');
        var department = $root.data('department');
        var designation = $root.data('designation');
        var mname = $root.data('mname');
        var lname = $root.data('lname')
        var salutation = $root.data('salutation');
        var created = $root.data('created');
        var createdby = $root.data('createdby');
        var institute = $root.data('institute');
        var usertype = $root.data('usertype');
        var image = $root.data('image');
        var email = $root.data('email');
        $('#detail-modal-content').html('');
        $('#detailViewModal').modal({
            show: true
        });
        const $loader = $('#detailViewModal .ajax-loader');
        $loader.show();

        $.post("getUsersDetails/", {
            userid: userid,
            fname: fname,
            department: department,
            designation: designation,
            mname: mname,
            lname: lname,
            salutation: salutation,
            created: created,
            createdby: createdby,
            institute: institute,
            usertype: usertype,
            image: image,
            email: email
        }, function (data) {
            $loader.hide();
            $('#detail-modal-content').html(data);
        });

    });

    $('.allUsers').on('click', '.editDetails', function (e) {
        e.preventDefault();
        const $root = $(this);
        var userid = $root.data('userid');
        var fname = $root.data('fname');
        var department = $root.data('department');
        var designation = $root.data('designation');

        var mname = $root.data('mname');
        var lname = $root.data('lname')
        var salutation = $root.data('salutation');
        var created = $root.data('created');
        var createdby = $root.data('createdby');
        var institute = $root.data('institute');
        var usertype = $root.data('usertype');
        var image = $root.data('image');
        var email = $root.data('email');
        $('#detail-modal-content1').html('');
        $('#editViewModal').modal({
            show: true
        });
        const $loader = $('#editViewModal .ajax-loader');
        $loader.show();

        $.post("editUsersDetailsView/", {
            userid: userid,
            fname: fname,
            department: department,
            designation: designation,
            mname: mname,
            lname: lname,
            salutation: salutation,
            created: created,
            createdby: createdby,
            institute: institute,
            usertype: usertype,
            image: image,
            email: email
        }, function (data) {
            $loader.hide();
            $('#detail-modal-content1').html(data);
        });

    });

    $('.allUsers').on('click', '#disableUser', function (e) {
        e.preventDefault();
        const $root = $(this);
        var userid = $root.data('userid');
        var fname = $root.data('fname');

        var mname = $root.data('mname');
        var lname = $root.data('lname')
        var c = confirm("Are you sure to disable this user : " + fname + " " + mname + " " + lname + "?");
        if (c == true) {
            $.post("disableUser/", {
                userid: userid,
            }, function (res) {
                if (res.status == 0) {
                    $('.errorbox1').show().text("Error,Please try again.");
                } else {
                    //$('#row' + userid).css({ 'display': 'none' });
                    $('.successbox1').show().text("User has been disabled successfully.");
                     window.location.reload(); 
                }
            });
        }
    });
    $('.allUsers').on('click', '#enableUser', function (e) {
        e.preventDefault();
        const $root = $(this);
        var userid = $root.data('userid');
        var fname = $root.data('fname');

        var mname = $root.data('mname');
        var lname = $root.data('lname')
        var c = confirm("Are you sure to enable this user : " + fname + " " + mname + " " + lname + "?");
        if (c == true) {
            $.post("enableUser/", {
                userid: userid,
            }, function (res) {
                if (res.status == 0) {
                    $('.errorbox1').show().text("Error,Please try again.");
                } else {
                    //$('#row' + userid).css({ 'display': 'none' });
                    $('.successbox1').show().text("User has been enabled successfully.");
                    window.location.reload(); 
                }
            });
        }
    });
});