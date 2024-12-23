$(document).ready(function () {
  $("#DOB_datepicker").datepicker({
    format: "dd/mm/yyyy",
    autoclose: "true",
  });

  $('#pen_comm_date').datepicker({
    format: 'mm-yyyy',
    autoclose: 'true',
    startView: "months",
    minViewMode: "months"
  });
});

/*$(function () {
  $(document).on("change", ".uploadFile", function () {
    var uploadFile = $(this);

    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    alert("size = " + size);
    if (size > 0.5) {  /* 0.50 
      alert("File size must be less than  500kb");
      return false;
    }
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

    if (/^image/.test(files[0].type)) { // only image file
      var reader = new FileReader(); // instance of the FileReader
      reader.readAsDataURL(files[0]); // read the local file

      reader.onloadend = function () { // set image data as background of div
        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
      }
    }

  });
});*/

document.getElementById("tab0").click();
function openCity(evt, tabName) {
  //alert(value)
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

$(document).ready(function () {
  $("#prop_dear").keydown(function(e) {

    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});



  $("input[name='milit']").click(function () {
    if ($(this).val() === "yes") {
      $("#milit").show();
    } else if ($(this).val() === "no") {
      $("#milit").hide();
    }
  });

  $(".datepicker").datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true
  });

  $(".monthpicker").datepicker({
    format: "mm/yyyy",
    autoclose: "true",
    startView: "months",
    minViewMode: "months",
  });
});

//check size of doc 
$('#frmLastPayRequset #pay_slip_doc').on('change', function () {
  // alert(this.files[0].size + "bytes");
  var focusSet = true;
  if (this.files[0].size > 102400) {
       if ($("#imgError").next(".validation").length == 0) // only add if not added
    {
      $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select file size less than 100 KB </div>");
    }
    if (!focusSet) {
      $("#pay_slip_doc").focus();
    }
  } else {
    $("#imgError").next(".validation").remove(); // remove it
  }


  // check type  start 
  var validExtensions = ['jpg', 'jpeg', 'png','pdf']; //array of valid extensions
  var fileName = $("#pay_slip_doc").val();;
  var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
  if ($.inArray(fileNameExt, validExtensions) == -1) {
    //alert("Invalid file type");
    if ($("#imgError").next(".validation").length == 0) // only add if not added
    {
           $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png /.pdf file </div>");
    }
    
      if (!focusSet) {
      $("#pay_slip_doc").focus();
    }
  } else {
    $("#imgError").next(".validation").remove(); // remove it
  }
  // check type end

});

function saveLastPayRequest() {
  var url = $('#frmLastPayRequset').attr('action');
  /********************************************* */
  //New code Added start
  /********************************************** */
  var focusSet = false;
  var allFields = true;
  var basic_pay_in_level = $("#basic_pay_in_level").val();
  var particulars = $("#particulars").val();
  var basic_pay = $("#basic_pay").val();
  var dearness_allowance = $("#dearness_allowance").val();
  var pay_slip_doc = $("#pay_slip_doc").val();
  // alert("doc="+ typeof  pay_slip_doc);
  basic_pay_in_level = basic_pay_in_level.trim();
  particulars = particulars.trim();
  basic_pay = basic_pay.trim();
  dearness_allowance = dearness_allowance.trim();
  if (basic_pay_in_level == 0) {
    if ($("#basic_pay_in_level").next(".validation").length == 0) // only add if not added
    {
      $("#basic_pay_in_level").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select   pay  level</div>");

    }
    //e.preventDefault(); // prevent form  POST to server
    allFields = false;
    if (!focusSet) {
      $("#basic_pay_in_level").focus();
    }
  } else {
    $("#basic_pay_in_level").next(".validation").remove(); // remove it
  }

  if (particulars.length === 0) {
    if ($("#particulars").next(".validation").length == 0) // only add if not added
    {
      $("#particulars").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter month </div>");

    }
    // e.preventDefault(); // prevent form  POST to server
    allFields = false;
    if (!focusSet) {
      $("#particulars").focus();
    }
  } else {
    $("#particulars").next(".validation").remove(); // remove it
  }

  if (!basic_pay.length) {
    if ($("#basic_pay").next(".validation").length == 0) // only add if not added
    {
      $("#basic_pay").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter basic pay</div>");

    }
    // e.preventDefault(); // prevent form  POST to server
    allFields = false;
    if (!focusSet) {
      $("#basic_pay").focus();
    }
  } else {
    $("#basic_pay").next(".validation").remove(); // remove it
  }

  if (!dearness_allowance.length) {
    if ($("#dearness_allowance").next(".validation").length == 0) // only add if not added
    {
      $("#dearness_allowance").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please enter dearness allowance</div>");

    }
    // e.preventDefault(); // prevent form  POST to server
    allFields = false;
    if (!focusSet) {
      $("#dearness_allowance").focus();
    }
  } else {
    $("#dearness_allowance").next(".validation").remove(); // remove it
  }

  // if file is not already uploaded 
  if ($("#pay_slipcheck").val() == '') {
    if (!pay_slip_doc.length) {
      if ($("#imgError").next(".validation").length == 0) // only add if not added
      {
        $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload image </div>");
      }
      allFields = false;
      if (!focusSet) {
        $("#pay_slip_doc").focus();
      }
    } else {
      $("#imgError").next(".validation").remove(); // remove it
    }
  }

  /////////////////////// to check type of image start
  if (pay_slip_doc.length) {
    var validExtensions = ['jpg', 'jpeg', 'png','pdf']; //array of valid extensions
    var fileName = $("#pay_slip_doc").val();;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
      alert("Invalid file type");
      if ($("#imgError").next(".validation").length == 0) // only add if not added
      {
        alert("no error");
        $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please upload .jpg / .jpeg/.png /.pdf </div>");
      }
      allFields = false;
      if (!focusSet) {
        $("#pay_slip_doc").focus();
      }
    } else {
      $("#imgError").next(".validation").remove(); // remove it
    }
  }
//////////////////////to check type of image end

//check size of doc if newly uploaded
if ($("#frmLastPayRequset #pay_slip_doc").val() != '') {
    var fileSize = $('#pay_slip_doc')[0].files[0].size;
  
  if (fileSize > 102400) {
       if ($("#imgError").next(".validation").length == 0) // only add if not added
    {

      $("#imgError").after("<div class='validation' style='color:red;margin-bottom:15px;'>Please select image size less than 100 KB </div>");
    }
    allFields = false;
    if (!focusSet) {
      $("#pay_slip_doc").focus();
    }
  } else {
    $("#imgError").next(".validation").remove(); // remove it
  }
}
/********************************************* */
//New code  end 
/********************************************** */
if (allFields) {
  var form_data = new FormData($('#frmLastPayRequset')[0])
  $.ajax({
    type: 'POST',
    url: url,
    data: form_data,
    processData: false,
    contentType: false,
    success: function (result) {
      if (result.status == 'success') {
        $("#alertMessage").removeClass("hide");
        $("#alertMessage").removeClass("alert alert-success");
        $("#alertMessage").removeClass("alert alert-danger");
        $("#alertMessage").addClass("alert alert-success");
        $("#alertMessage").html(result.message);
        document.getElementById("tab3").click();
      } else if (result.status == 'error') {
        $("#alertMessage").removeClass("hide");
        $("#alertMessage").removeClass("alert alert-success");
        $("#alertMessage").removeClass("alert alert-danger");
        $("#alertMessage").addClass("alert alert-danger");
        $("#alertMessage").html(result.message);
      }
    },
    error: function (result, errMsg) {
      $("#alertMessage").html("Sorry, Error occurred while submitting data. Please contact ICFRE");
      $("#alertMessage").addClass("alert alert-danger");
      $("#alertMessage").removeClass("hide");

    }
  });

}//allFields
}//main
// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (
    (charCode != 190 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
    (charCode < 48 || charCode > 57) && charCode != 8
  ) {
    return false;
  }
  return true;
}