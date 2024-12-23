$(document).on("click", "i.del", function() {
    $(this).parent().remove();
});
$(function() {
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
});

$(document).ready(function() {
    App.init();
    $("#Discipline_oth").hide();

});

var slides = document.querySelectorAll('#slides .slide');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 4000);

function nextSlide() {
    slides[currentSlide].className = 'slide';
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].className = 'slide showing';
}

var playing = true;
var pauseButton = document.getElementById('pause');
var playButton = document.getElementById('play');

function pauseSlideshow() {
    //pauseButton.innerHTML = 'Play';
    playing = false;
    clearInterval(slideInterval);
}

function playSlideshow() {
    //pauseButton.innerHTML = 'Pause';
    playing = true;
    slideInterval = setInterval(nextSlide, 4000);
}

pauseButton.onclick = function() {
    if (playing) {
        pauseSlideshow();
    }

};
playButton.onclick = function() {

    if (!playing) {
        playSlideshow();
    }
};

$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});