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
