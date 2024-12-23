$(document).on("click", "i.del", function() {
    $(this).parent().remove();
});
/*$(function() {
    $(document).on("change", ".uploadFile", function() {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
            }
        }

    });
});*/

$(document).ready(function() {
    App.init();
    $("#Discipline_oth").hide();

});

var message = "Not Allowed Right Click";

function rtclickcheck(keyp) {
    if (navigator.appName == "Netscape" && keyp.which == 3) {
        alert(message);
        return false;
    }
    if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) {
        alert(message);
        return false;
    }
}
document.onmousedown = rtclickcheck;

function submitButton() {

    var uname = $("#u_email").val();
    var pass = $("#u_pass").val();
    var textBox = $("#textBox").val();
    textBox = textBox.trim();
    var is_valid = true;
    var random = $("#random").val();
    random = random.trim();
    

    if (uname == "") {
        $("#err_email").text("Please Enter email");
        $("#u_email").focus();
        is_valid = false;
    } else if (!(uname.length > 2)) {
        $("#err_email").text("Please Enter minimum 3 Characters");
        $("#u_email").focus();
        is_valid = false;
    } else {
        $("#err_email").text("");
    }
    if (pass == "") {
        $("#err_pass").text("Please Enter Password");
        $("#u_pass").focus();
        is_valid = false;
    } else if ((pass.length < 6)) {
        $("#err_pass").text("Please Enter minimum 6 Characters");
        $("#u_pass").focus();
        is_valid = false;
    } else {
        $("#err_pass").text("");
    }  

    if (textBox == "") {
        $("#output").text("Please Enter Captcha");
        $("#textBox").focus();
        is_valid = false;
    } else if ((textBox != random)) {
        $("#output").text("Captcha not match");
        $("#textBox").focus();
        is_valid = false;
    } else {
        $("#output").text("");
    }

    if (is_valid) {

        // var u_email = $("#u_email").val();
        // var pass = $("#u_pass").val();       
    
        // var u = btoa(u_email);
        // var p = btoa(pass);       
    
        // $("#u_email").val(u);
        // $("#u_pass").val(p);
        return true;
    } else {
        return false;
    }
};

function submitButtonPPO() {

    var uname = $("#ppo_id").val();
    var pass = $("#dob").val();
    var textBox = $("#textBox").val();
    textBox = textBox.trim();
    var is_valid = true;
    var random = $("#random").val();
    random = random.trim();
    

    if (uname == "") {
        $("#err_ppo").text("Please Enter PPO");
        $("#ppo_id").focus();
        is_valid = false;
    }else {
        $("#err_ppo").text("");
    }
    if (pass == "") {
        $("#err_dob").text("Please Enter DOB");
        $("#dob").focus();
        is_valid = false;
    }  else {
        $("#err_dob").text("");
    }  

    if (textBox == "") {
        $("#output").text("Please Enter Captcha");
        $("#textBox").focus();
        is_valid = false;
    } else if ((textBox != random)) {
        $("#output").text("Captcha not match");
        $("#textBox").focus();
        is_valid = false;
    } else {
        $("#output").text("");
    }

    if (is_valid) {

    //     var u_email = $("#ppo_id").val();
    //     var pass = $("#dob").val();       
    
    //     var u = btoa(u_email);
    //    var p = btoa(pass);       
    
    //     $("#ppo_id").val(u);
    //     $("#dob").val(p);
        return true;
    } else {
        return false;
    }
};
window.onload = function() {
    $('form').attr('autocomplete', 'off');
}
$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('#refreshButton').click(function() {
               
            location.reload();
            });
});

// var slides = document.querySelectorAll('#slides .slide');
// var currentSlide = 0;
// var slideInterval = setInterval(nextSlide, 4000);

// function nextSlide() {
//     slides[currentSlide].className = 'slide';
//     currentSlide = (currentSlide + 1) % slides.length;
//     slides[currentSlide].className = 'slide showing';
// }

// var playing = true;
// var pauseButton = document.getElementById('pause');
// var playButton = document.getElementById('play');

// function pauseSlideshow() {
//     //pauseButton.innerHTML = 'Play';
//     playing = false;
//     clearInterval(slideInterval);
// }

// function playSlideshow() {
//     //pauseButton.innerHTML = 'Pause';
//     playing = true;
//     slideInterval = setInterval(nextSlide, 4000);
// }

// pauseButton.onclick = function() {
//     if (playing) {
//         pauseSlideshow();
//     }

// };
// playButton.onclick = function() {

//     if (!playing) {
//         playSlideshow();
//     }
// };


$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});