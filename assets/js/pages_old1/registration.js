$(document).on("click", "i.del", function () {
	$(this).parent().remove();
});
$(function () {
	$(document).on("change", ".uploadFile", function () {
		var uploadFile = $(this);
		const size = (this.files[0].size / 1024 / 1024).toFixed(2);
		if (size > 1.00) {  /* 0.50 */
			alert("File must be at the most of size of 100kb");
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
});

$(document).ready(function () {
	App.init();
	$("#Discipline_oth").hide();

});

$(document).ready(function(){
	$("#addcheckbox").on('change',function(){
	if($("#addcheckbox").prop('checked') == true){
		var add = $("#corr_add").val();
		var states = $("#states").val();
		var district = $("#district").val();
		
		var zip_code=$("#zip_code").val();
		$('#perm_add').val(add);
       	$("#p_states").val(states);

		var state = $("#p_states :selected").val();
		$.post("Registration/citydata", {
				state: state
			},
			function(response) {
				$("#p_district").html(response);
				$('#p_district').val(district);
			});		
		$('#p_zip_code').val(zip_code);
	}else{
		$('#perm_add').val("");
	 $('#p_states').val("");
		 $('#p_district').val("");
		$('#p_zip_code').val("");
	}
	});
})

$('#datepicker-autoClose').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: 'true',
});
$('#datepicker-autoClose1').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: 'true',
});
$('#datepicker-autoClose3').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: 'true',
});
$('#datepicker-autoClose4').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: 'true',
});
$('#datepicker-autoClose5').datepicker({
	format: 'dd-mm-yyyy',
	autoclose: 'true',
});


$(document).ready(function () {
	var sel_p_type = $("#p1_P_type").val();
	if (sel_p_type == "3") {
		$(".Pensioner_info").show();
		withPensionerValidation();
	} else {
		$(".Pensioner_info").hide();
		withoutPensionerValidation();
	}
	$("#p1_P_type").change(function () {
		var p_type = $(this).val();
		if (p_type == "3") {
			$(".Pensioner_info").show();
			//withPensionerValidation();
		} else {
			$(".Pensioner_info").hide();
			//withoutPensionerValidation();
		}
	});
});

var _validFileExtensions = [".jpeg", ".png", ".jpg"]

function ValidateImage() {
	var sFileName = document.getElementById("UploadImg").value;

	var startIndex = (sFileName.indexOf('\\') >= 0 ? sFileName.lastIndexOf('\\') : sFileName.lastIndexOf('/'));
	var filename = sFileName.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	if (sFileName.length > 0) {
		var blnValid = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var sCurExtension = _validFileExtensions[j];
			if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				blnValid = true;
				break;
			}
		}

		if (!blnValid) {
			alert("Sorry, " + filename + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));

			return false;
		}
	}
	return true;
}


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function () {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
}

function openall_panel() {
	if ($(".accordion").hasClass("active")) {
		$(".accordion").addClass("active");
		$(".acc_panel").css("max-height", "400px");
	}
}

$(document).ready(function () {
	$('.dropdown-toggle').dropdown();
	var base_url = $("#js_base_url").val();
	$.get(base_url + "assets/js/state.json", function (data) {
		var state_option = "<option value=''>--select--</option>";
		for (var key in data) {
			if (data.hasOwnProperty(key)) {
				var val = data[key];
				state_option += '<option value="' + val + '">' + val + '</option>';
			}
		}
		$("#state").html(state_option);
	});
});
function getDistrict(state_name) {
	var base_url = $("#js_base_url").val();
	var district_option = '<option value="">--select--</option>';
	if (state_name != "") {
		$.get(base_url + "assets/js/indian_dist.json", function (data) {
			for (var key in data[state_name]) {
				if (data[state_name].hasOwnProperty(key)) {
					var val = data[state_name][key];
					district_option += '<option value="' + val + '">' + val + '</option>';
				}
			}
			$("#district").html(district_option);
		});
	}
	else {
		$("#district").html(district_option);
	}

}
function reinitialiseFormValidation(elementSelector) {
	var validator = $(elementSelector).validate();
	validator.destroy();
	//$.validator.unobtrusive.parse(elementSelector);
};
function withoutPensionerValidation() {
	reinitialiseFormValidation("#researcher_reg_form")
	$("#researcher_reg_form").validate({
		rules: {
			p1_salu: {required: true},
			p1_first_name: {
				required: true,
				minlength: 2,
				maxlength: 75,
				lettersonly: true
			},
			// p1_middle_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			// p1_last_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			p1_gender: {
				required: true
			},
			p1_dob: {
				required: true
			},
			p1_P_type: {
				required: true
			},
			institue_name: {
				required: true,
			},
			post_last: {
				required: true,
			},
			post_cat: {
				required: true
			},
			joining_date: {
				required: true
			},
			Retirement_date: {
				required: true
			},
			u_phone: {
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10
			},
			u_email: {
				required: true,
				email: true
			},
			corr_add: {
				required: true,
				minlength: 5,
				maxlength: 300
			},
			state: {
				required: true,
			},
			district: {
				required: true,
			},
			zip_code: {
				required: true,
				number: true,
				minlength: 6,
				maxlength: 7
			},
			
			perm_add: {
				required: true,
				minlength: 5,
				maxlength: 300
			},
			p_state: {
				required: true,
			},
			p_district: {
				required: true,
			},
			p_zip_code: {
				required: true,
				number: true,
				minlength: 6,
				maxlength: 7
			},
			UploadImg:{
				required: true,
			}
		},
		messages: {
			f_p_salu: "Please select salution",
			// p1_first_name: {
			// 	required: "Please enter a first name",
			// 	minlength: "Your first name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			// p1_1_middle_name: {
			// 	required: "Please enter a middle name",
			// 	minlength: "Your middle name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			p1_1_last_name: {
				required: "Please enter a last name",
				minlength: "Your last name must consist of at least 2 characters",
				maxlength: "Your last name cannot exceed 75 characters",
				lettersonly: "Please enter alphabets only"
			},
			
			p1_gender: "Please select gender",
			datepicker_autoClose3: "Please select dob",
			p1_P_type: "Please select Pensioner Type",

			institue_name: "Please enter a Institute",
			post_last:{
				required: "Please Select The Post Last Held",
			},
			post_cat: "Please select Category",
			datepicker_autoClose: "Please select Joining Date",
			datepicker_autoClose1: "Please select Retirement Date",
			u_phone: {
				required: "Please enter 10 digit mobile number",
				number: "Please enter digits only",
				minlength: "mobile number must consist of 10 digit",
				maxlength: "mobile number must consist of 10 digit"
			},
			u_email: {
				required: "Please enter valid email",
				
			},
			corr_add:{
				required: "Please enter correspondence address",
			},
			states:{
				required: "Please select state",
			},
			district:{
				required: "Please select district",
			},
			
			zip_code: {
				required: "Please enter 6 digit zip code",
				number: "Please enter digits only",
				minlength: " number must consist of 6 digit",
				maxlength: "mobile number must consist of 6 digit"
			},
			per_add:{
				required: "Please enter correspondence address",
			},
			p_states:{
				required: "Please select state",
			},
			p_district:{
				required: "Please select district",
			},
			
			p_zip_code: {
				required: "Please enter 6 digit zip code",
				number: "Please enter digits only",
				minlength: "mobile number must consist of 6 digit",
				maxlength: "mobile number must consist of 6 digit"
			}
		},
		errorElement: "span",
		errorPlacement: function (error, element) {
			// Add the `invalid-feedback` class to the error element
			error.addClass("invalid-feedback text-left");
			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});
}

function withPensionerValidation() {
	reinitialiseFormValidation("#researcher_reg_form")
	$("#researcher_reg_form").validate({
		rules: {
			p1_salu: {required: true},
			p1_first_name: {
				required: true,
				minlength: 2,
				maxlength: 75,
				lettersonly: true
			},
			// p1_1_middle_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			// p1_1_last_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			p1_gender: {
				required: true
			},
			p1_dob: {
				required: true
			},
			p1_P_type: {
				required: true
			},
			p2_salu: {required: true},
			p2_first_name: {
				required: true,
				minlength: 2,
				maxlength: 75,
				lettersonly: true
			},
			// p2_1_middle_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			// p2_1_last_name: {
			// 	required: true,
			// 	minlength: 2,
			// 	maxlength: 75,
			// 	lettersonly: true
			// },
			p2_gender: {
				required: true
			},
			p2_dob: {
				required: true
			},
			institue_name : {
				required: true
			},
			post_last: {
				required: true,
			},
			post_cat: {
				required: true
			},
			joining_date: {
				required: true
			},
			Retirement_date: {
				required: true
			},
			u_phone: {
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10
			},
			u_email: {
				required: true,
				email: true
			},
			corr_add: {
				required: true,
				minlength: 5,
				maxlength: 300
			},
			state: {
				required: true,
			},
			district: {
				required: true,
			},
			zip_code: {
				required: true,
				number: true,
				minlength: 6,
				maxlength: 7
			},
			
			perm_add: {
				required: true,
				minlength: 5,
				maxlength: 300
			},
			p_state: {
				required: true,
			},
			p_district: {
				required: true,
			},
			p_zip_code: {
				required: true,
				number: true,
				minlength: 6,
				maxlength: 7
			},
		},
		messages: {
			f_p_salu: "Please select salution",
			// p1_first_name: {
			// 	required: "Please enter a first name",
			// 	minlength: "Your first name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			// p1_1_middle_name: {
			// 	required: "Please enter a middle name",
			// 	minlength: "Your middle name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			p1_1_last_name: {
				required: "Please enter a last name",
				minlength: "Your last name must consist of at least 2 characters",
				maxlength: "Your last name cannot exceed 75 characters",
				lettersonly: "Please enter alphabets only"
			},
		
			p1_gender: "Please select gender",
			datepicker_autoClose3: "Please select dob",
			p1_P_type: "Please select Pensioner Type",

			p2_salu: "Please select salution",
			p2_first_name: {
				required: "Please enter a first name",
				minlength: "Your first name must consist of at least 2 characters",
				maxlength: "Your last name cannot exceed 75 characters",
				lettersonly: "Please enter alphabets only"
			},
			// p2_middle_name: {
			// 	required: "Please enter a username",
			// 	minlength: "Your middle name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			// p2_last_name: {
			// 	required: "Please enter a username",
			// 	minlength: "Your last name must consist of at least 2 characters",
			// 	maxlength: "Your last name cannot exceed 75 characters",
			// 	lettersonly: "Please enter alphabets only"
			// },
			p2_gender: "Please select gender",
			datepicker_autoClose4: "Please select dob",
			
			institue_name: "Please enter a Institute",
			post_last:{
				required: "Please Select The Post Last Held",
			},
			post_cat: "Please select Category",
			datepicker_autoClose: "Please select Joining Date",
			datepicker_autoClose1: "Please select Retirement Date",
			u_phone: {
				required: "Please enter 10 digit mobile number",
				number: "Please enter digits only",
				minlength: "mobile number must consist of 10 digit",
				maxlength: "mobile number must consist of 10 digit"
			},
			u_email: {
				required: "Please enter valid email",
				
			},
			corr_add:{
				required: "Please enter correspondence address",
			},
			states:{
				required: "Please select state",
			},
			district:{
				required: "Please select district",
			},
			
			zip_code: {
				required: "Please enter 6 digit zip code",
				number: "Please enter digits only",
				minlength: "mobile number must consist of 6 digit",
				maxlength: "mobile number must consist of 6 digit"
			},
			per_add:{
				required: "Please enter correspondence address",
			},
			p_states:{
				required: "Please select state",
			},
			p_district:{
				required: "Please select district",
			},
			
			p_zip_code: {
				required: "Please enter 6 digit zip code",
				number: "Please enter digits only",
				minlength: "mobile number must consist of 6 digit",
				maxlength: "mobile number must consist of 6 digit"
			}
		},
		errorElement: "span",
		errorPlacement: function (error, element) {
			// Add the `invalid-feedback` class to the error element
			error.addClass("invalid-feedback text-left");

			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.next("label"));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});


}

$('#UploadImg').bind('change', function() {

	//this.files[0].size gets the size of your file.
	var size=(this.files[0].size);

	if(size>100000)
	{
		alert("Upload file size should not be more than 100 KB");
		$('#UploadImg').val("");
		$("#imagePreview").attr("style","");
	}

	var sFileName = document.getElementById("UploadImg").value;

	var startIndex = (sFileName.indexOf('\\') >= 0 ? sFileName.lastIndexOf('\\') : sFileName.lastIndexOf('/'));
	var filename = sFileName.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	if (sFileName.length > 0) {
		var blnValid = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var sCurExtension = _validFileExtensions[j];
			if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				blnValid = true;
				break;
			}
		}

		if (!blnValid) {
			alert("Sorry, " + filename + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));

			$('#UploadImg').val("");
			$("#imagePreview").attr("style","");
		}
	}
  
  });

  $('#UploadImg1').bind('change', function() {

	//this.files[0].size gets the size of your file.
	var size=(this.files[0].size);

	if(size>100000)
	{
		alert("Upload file size should not be more than 100 KB");
		$('#UploadImg1').val("");
		$("#imagePreview").attr("style","");
	}

	var sFileName = document.getElementById("UploadImg1").value;

	var startIndex = (sFileName.indexOf('\\') >= 0 ? sFileName.lastIndexOf('\\') : sFileName.lastIndexOf('/'));
	var filename = sFileName.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	if (sFileName.length > 0) {
		var blnValid = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var sCurExtension = _validFileExtensions[j];
			if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				blnValid = true;
				break;
			}
		}

		if (!blnValid) {
			alert("Sorry, " + filename + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));

			$('#UploadImg1').val("");
			$("#imagePreview").attr("style","");
		}
	}
  
  });




