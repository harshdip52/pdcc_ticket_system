window.onload = function () {
    $(document).ready(function () {
        $('#table_pagination').DataTable();
    });
    $('#searchdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
        // onSelect: function(dateText) {
        //     console.log("Selected date: " + dateText + "; input's current value: " + this.value);
        // }
    });
}
//check size of doc and type of image 
$('#grievance_form #document').on('change', function () {
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
    var validExtensions = ['jpg', 'jpeg', 'png','pdf','PDF']; //array of valid extensions
    var fileName = $("#document").val();;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        //alert("Invalid file type");
        if ($("#imgError").next(".validation").length == 0) // only add if not added
        {
            $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg /.jpeg/.png /.pdf file </div>");
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

    // $('#dateSearch').on('change', function() {
    //     var dateVal =  this.value ;
    //    //alert (" dateVal = "+  dateVal);5/10/2021
    // });
    $('#grievance_type').on('change', function () {
        var id = this.value;
        $.post("grievance/getGrievanceSubjectsByType/", {
            id: id           
        }, function (res) {
            var selectbox = $('#subject');
            selectbox.empty();
            var res = JSON.parse(res);
            var subjects = res.subjects;
            //console.log(subjects);
            $('#subject').append('<option value="" selected disabled hidden>'+"Select Subject"+'</option>');
            $.each(subjects, function(index, value){
              $('#subject').append('<option value="'+ value.subject_name +'">'+ value.subject_name+'</option>');
            });            
        });   
    });

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

    $('#grievance_form  .errorbox').css('display', 'none');
    $('#grievance_form .successbox').css('display', 'none');
    $("input[type='text'], textarea,select").on("keyup", function () {
        if ($(this).val() != "" && $("textarea").val() != "" && $("select").val() != 0) {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
        }
    });
    $('#grievance_form').on('click', '#DoSubmit', function (e) {
        e.preventDefault();
        $(this).val('Please wait ...')
            .attr('disabled', 'disabled');
        var focusSet = false;
        var allFields = true;
        var grievance_type = $("#grievance_type").val();
        var subject = $("#subject").val();
        var issue = $("#issue").val();

        grievance_type = grievance_type.trim();
        subject = subject.trim();
        issue = issue.trim();

        if (grievance_type == 0) {
            if ($("#grievance_type").next(".validation").length == 0) // only add if not added
            {
                $("#grievance_type").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select  grievance type</div>");

            }
            //e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#grievance_type").focus();
            }
        } else {
            $("#grievance_type").next(".validation").remove(); // remove it
        }


        if (subject == 0) {
            if ($("#subject").next(".validation").length == 0) // only add if not added
            {
                $("#subject").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter subject.</div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#subject").focus();
            }
        } else {
            $("#subject").next(".validation").remove(); // remove it
        }


        if (!issue.length) {
            if ($("#issue").next(".validation").length == 0) // only add if not added
            {
                $("#issue").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter issue. </div>");

            }
            // e.preventDefault(); // prevent form  POST to server
            allFields = false;
            if (!focusSet) {
                $("#issue").focus();
            }
        } else {
            $("#issue").next(".validation").remove(); // remove it
        }

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
            var validExtensions = ['jpg', 'jpeg', 'png','pdf','PDF']; //array of valid extensions
            var fileName = $("#document").val();;
            var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
            if ($.inArray(fileNameExt, validExtensions) == -1) {
                //alert("Invalid file type");
                if ($("#imgError").next(".validation").length == 0) // only add if not added
                {
                    $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png/pdf file </div>");
                }
                allFields = false;
                if (!focusSet) {
                    $("#document").focus();
                }
            } else {
                $("#imgError").next(".validation").remove(); // remove it
            }
        }

        if (allFields) {
            var url = $('#grievance_form').attr('action');
            var griForm = document.getElementById("grievance_form");
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
                    if (res.status == 0) {
                        $('.errorbox').show().text("Error,Please try again.");
                    } else if (res.status == 1) {
                        // console.log(res);
                        $('.successbox').show().text("New grievance has been added successfully.");
                        $('#grievance_form').each(function () {
                            this.reset();
                        });
                        setTimeout(function () { $('#newRequest').modal('hide'); }, 2000);
                        setTimeout(function () { $('#grievance_form .successbox').css('display', 'none'); }, 2000);
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


    $('.allGrievance').on('click', '.getDetails', function (e) {
        e.preventDefault();
        const $root = $(this);
        var griReqId = $root.data('grireqid');
        var type = $root.data('type');
        var subject = $root.data('subject');
        var issue = $root.data('issue');
        var image = $root.data('image')
        var solution = $root.data('solution');
        var solutionpc = $root.data('solutionpc');
        var closeddate = $root.data('closeddate');
        var gristatus = $root.data('gristatus');
        $('#detail-modal-content').html('');
        $('#detailViewModal').modal({
            show: true
        });
        const $loader = $('#detailViewModal .ajax-loader');
        $loader.show();

        $.post("grievance/getGrievanceDetails/", {
            griReqId: griReqId,
            type: type,
            subject: subject,
            issue: issue,
            image: image,
            solution: solution,
            solutionpc: solutionpc,
            closeddate: closeddate,
            gristatus: gristatus
        }, function (data) {
            $loader.hide();
            $('#detail-modal-content').html(data);
        });

    });



});