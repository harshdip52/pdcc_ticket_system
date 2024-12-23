$(document).ready(function () {
    $('#response_form  .errorbox1').css('display', 'none');
    $('#grieresponse_form .successbox1').css('display', 'none');

    $('#allCertificates').on('click', '.getDetails', function (e) {

        e.preventDefault();
        const $root = $(this);
        var lcid = $root.data('lcid');
        var firstname = $root.data('firstname');
        var middlename = $root.data('middlename');
        var lastname = $root.data('lastname');
        var institutename = $root.data('institutename');
        var salutation = $root.data('salutation');
        var image = $root.data('image');
        var status = $root.data('status');

        $('#detail-modal-content').html('');
        $('#detailViewModal').modal({
            show: true
        });
        const $loader = $('#detailViewModal .ajax-loader');
        $loader.show();

        $.post("getCertificateDetailsForPC/", {
            lcid: lcid,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            institutename: institutename,
            salutation: salutation,
            status: status,
            image: image
        }, function (data) {
            $loader.hide();
            $('#detail-modal-content').html(data);
        });

    });

//check size of doc and type of image 
    $('#life_certificate_form #document').on('change', function () {
        // alert(this.files[0].size + "bytes");
        var focusSet = true;
        if (this.files[0].size > 102400) {
            if ($("#document").next(".validation").length == 0) // only add if not added
            {
                $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
            }
            if (!focusSet) {
                $("#document").focus();
            }
        } else {
            $("#document").next(".validation").remove(); // remove it
        }


        // check type  start 
        var validExtensions = ['jpg', 'jpeg', 'png', 'pdf']; //array of valid extensions
        var fileName = $("#document").val();;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt, validExtensions) == -1) {
            //alert("Invalid file type");
            if ($("#document").next(".validation").length == 0) // only add if not added
            {
                $("#document").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png /pdf file </div>");
            }
            if (!focusSet) {
                $("#document").focus();
            }
        } else {
            $("#document").next(".validation").remove(); // remove it
        }
        // check type end

    });

    // pincode validation
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

    // to reset form fields 
    $('#newRequest').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end()
            .find(".errorbox,.successbox")
            .css({ 'display': 'none' })
            .end()
    })

    $('#life_certificate_form  .errorbox').css('display', 'none');
    $('#life_certificate_form .successbox').css('display', 'none');
    $("input[type='text']").on("keyup", function () {
        if ($(this).val() != "") {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });
    $('#life_certificate_form').on('click', '#DoSubmitCertificate', function (e) {

        //alert("heefecscsc");
        e.preventDefault();
        
        // $(this).val('Please wait ...')
        //    .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;

        var doc = $('#document').val();
        var ppo_id = $('#ppo_id').val();
        if (ppo_id == "") {
            if ($("#ppo_id").next(".validation").length == 0) // only add if not added
            {
                $("#ppo_id").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter PPO no </div>");
            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#ppo_id").focus();
            }
        } else {
            $("#ppo_id").next(".validation").remove(); // remove it
        }

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
            var validExtensions = ['jpg', 'jpeg', 'png', 'pdf']; //array of valid extensions
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
            var lifeForm = document.getElementById("life_certificate_form");
            var fd = new FormData(lifeForm);
            $.ajax({
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
                        $('.errorbox').show().text(res.message);
                          console.log(res);
                    } else if (res.status == 1) {
                        console.log(res);
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