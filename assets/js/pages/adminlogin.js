$(document).ready(function() {
    $( "#admin_login" ).validate({
		rules: {
			lg_type:"required",
			u_email:{
				required: true,
				email: true
			},
			u_pass:{
				required: true,
				minlength: 3
			}
		},
		errorElement: "span",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback text-left" );

			if ( element.prop( "type" ) === "radio" ) {
				error.appendTo( element.parents('.radiobtn') );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
	});
	
});
// reset pw pensioner .IA ID,PCA PCD,SA
function submitButton() {

    var password = $("#password").val();
    var repassword = $("#repassword").val();
    // var textBox = $("#textBox").val();
    // textBox = textBox.trim();
    var is_valid = true;
    // var random = $("#random").val();
    // random = random.trim();
    

    if (password == "") {
        $("#err_password").text("Please Enter Password");
        $("#password").focus();
        is_valid = false;
    }else {
        $("#err_password").text("");
    }
    if (repassword == "") {
        $("#err_repassword").text("Please Enter repassword");
        $("#repassword").focus();
        is_valid = false;
    }  else {
        $("#err_repassword").text("");
    }  

    // if (textBox == "") {
    //     $("#output").text("Please Enter Captcha");
    //     $("#textBox").focus();
    //     is_valid = false;
    // } else if ((textBox != random)) {
    //     $("#output").text("Captcha not match");
    //     $("#textBox").focus();
    //     is_valid = false;
    // } else {
    //     $("#output").text("");
    // }

    if (is_valid) {

    //     var password = $("#password").val();
    //     var repassword = $("#repassword").val();       
    
    //     var u = btoa(password);
    //    var p = btoa(repassword);       
    
    //     $("#password").val(u);
    //     $("#repassword").val(p);
        return true;
    } else {
        return false;
    }
};