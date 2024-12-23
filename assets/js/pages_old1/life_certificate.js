//check size of doc and type of image 
$('#life_certificate_form #document').on('change', function () {
    //alert(this.files[0].size + "bytes");
    var focusSet = true;
    if (this.files[0].size > 102400) {
    //     if ($("#document").next(".validation").length == 0) // only add if not added
    //     {
    //         $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
    //     }
    //     if (!focusSet) {
    //         $("#document").focus();
    //     }
    // } else {
    //     $("#document").next(".validation").remove(); // remove it
    // }
    alert("File size = " +this.files[0].size + "bytes. Please select image size less than 100 KB");
    
    }
    // check type  start 
    var validExtensions = ['jpg', 'jpeg', 'png','pdf']; //array of valid extensions
    var fileName = $("#document").val();;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        //alert("Invalid file type");
    //     if ($("#document").next(".validation").length == 0) // only add if not added
    //     {
    //         $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png /pdf file </div>");
    //     }
    //     if (!focusSet) {
    //         $("#document").focus();
    //     }
    // } else {
    //     $("#document").next(".validation").remove(); // remove it
    // }
    alert("Please upload .jpg / .jpeg/.png /pdf file");
    }
    // check type end

});
$(document).ready(function () {

    // to reset form fields 
    $('#newRequest').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    })

    $('#life_certificate_form  .errorbox').css('display', 'none');
    $('#life_certificate_form .successbox').css('display', 'none');
    // $("input[type='text'], textarea,select").on("keyup", function () {
    //     if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0) {
    //         $("#DoSubmit").removeAttr("disabled");
    //     } else {
    //         $("#DoSubmit").attr("disabled", "disabled");
    //     }
    // });
    $('#life_certificate_form').on('click', '#DoSubmitCertificate', function (e) {
        e.preventDefault();
        //alert("sdvfdvd");
        // $(this).val('Please wait ...')
        //     .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
       
        var doc = $('#document').val();
        

        if (doc == "") {
            if ($("#document").next(".validation").length == 0) // only add if not added
            {
            $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload document </div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#document").focus();
            }
        } else {
            $("#document").next(".validation").remove(); // remove it
        }      

        //check size of doc and type  if newly uploaded
        if ($("#document").val() != '') {
            var fileSize = $('#document')[0].files[0].size;
            if (fileSize > 102400) {
                if ($("#document").next(".validation").length == 0) // only add if not added
                {
                    $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
                }
                allFields = false;
                if (!focusSet) {
                    $("#document").focus();
                }
            } else {
                $("#document").next(".validation").remove(); // remove it
            }
            // check type  start 
            var validExtensions = ['jpg', 'jpeg', 'png','pdf']; //array of valid extensions
            var fileName = $("#document").val();;
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            if ($.inArray(fileNameExt, validExtensions) == -1) {
                //alert("Invalid file type");
                if ($("#document").next(".validation").length == 0) // only add if not added
                {
                    $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png /.pdf file  </div>");
                }
                allFields = false;
                if (!focusSet) {
                    $("#document").focus();
                }
            } else {
                $("#document").next(".validation").remove(); // remove it
            }
        }

        if (allFields) {
            var url = $('#life_certificate_form').attr('action');
            var griForm = document.getElementById("life_certificate_form");
            var fd = new FormData(griForm);

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
                   // res = JSON.parse(res);
                    if (res.status == 0) {
                           console.log(res);
                        $('.errorbox').show().text(res.message);

                    } else if (res.status == 1) {
                        // console.log(res);
                         //alert(res.age);
                        $('.successbox').show().text(res.message);
                        $('#life_certificate_form').each(function () {
                            this.reset();
                        });
                        setTimeout(function () { $('#newRequest').modal('hide'); }, 3000);
                        setTimeout(function () { $('#life_certificate_form .successbox').css('display', 'none'); }, 3000);
                        window.location.reload();
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