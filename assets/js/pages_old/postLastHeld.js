

$(document).ready(function () {

    // to reset form fields 
    $('#newRequest').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input")
            .val('')
            .end();
    
        $(this)
            .find(".validation")
            .text('');
    })
    
    $('#master_form  .errorbox').css('display', 'none');
    $('#master_form .successbox').css('display', 'none');
    
    $("input[type='text']").on("keyup", function () {
    
        if ($(this).val() != "" && $("select").val() != 0) {
            $("#DoSubmit").removeAttr("disabled");
        } else {
            $("#DoSubmit").attr("disabled", "disabled");
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
    
        var post = $("#post").val();//select   
        post = post.trim();
        if (post == "") {
            if ($("#post").next(".validation").length == 0) // only add if not added
            {
                $("#post").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter  post.</div>");    
            }
            allFields = false;
            if (!focusSet) {
                $("#post").focus();
            }
        } else {
            $("#post").next(".validation").remove(); // remove it
        }    
        ///////////////////////////////////////////////
        if (allFields == true) {
            var url = $('#master_form').attr('action');
            //var url ="<?php echo base_url() ?>pensioncell/addNewpost?>";
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
                    } else if (res.status == 1) {
                        // console.log(res);
                        $('.successbox').show().text(res.message);
                        $('#master_form').each(function () {
                            this.reset();
                        });
                        setTimeout(function () { $('#newRequest').modal('hide'); }, 2000);
                        setTimeout(function () { window.location.reload(); }, 2000);
                        setTimeout(function () { $('#master_form .successbox').css('display', 'none'); }, 2000);
                    }
                },
                error: function (xhr, status, error) {
                    //toastr.error('Failed to add '+xData.name+' in wishlist.');
                    console.log(error);
                }
            });
        }
    
    });
    
    
    $('#allRecords').on('click', '#deleteRecord', function (e) {
        e.preventDefault();
        const $root = $(this);
        var id = $root.data('id');
       
        var c = confirm("Are you sure to delete this post ?");
        if (c == true) {
            $.post("deletePostLastHeld/", {
                id: id,
            }, function (res) {
                if (res.status == 0) {
                    $('.errorbox').show().text("Error,Please try again.");
                } else {
                    $('#row'+id).css({ 'display': 'none' });
                    $('.successbox').show().text("post  deleted successfully.");
                    // setTimeout(function () { $('.successbox').css('display', 'none'); }, 2000);
                }
            });
        }
    });
});