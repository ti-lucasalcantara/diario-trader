var $image = $(".image-crop > img")
$($image).cropper({
    aspectRatio: 16 / 9,
    preview: ".img-preview",
    done: function(data) {
    }
});

var $inputImage = $("#inputImage");
if (window.FileReader) {
    $inputImage.change(function() {
        var fileReader = new FileReader(),
                files = this.files,
                file;

        if (!files.length) {
            return;
        }

        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
            fileReader.readAsDataURL(file);
            fileReader.onload = function () {
                $inputImage.val("");
                $image.cropper("reset", true).cropper("replace", this.result);
            };
            //document.getElementById("cropper_controls").style.display = 'block';
            $("#cropper-controls").show();
            $("#save-image").show();

        } else {
            showMessage("Please choose an image file.");
        }
    });
} else {
    $inputImage.addClass("hide");
}




$("#download").click(function() {
    window.open($image.cropper("getDataURL"));
});

$("#zoomIn").click(function() {
    $image.cropper("zoom", 0.1);
});

$("#zoomOut").click(function() {
    $image.cropper("zoom", -0.1);
});

$("#rotateLeft").click(function() {
    $image.cropper("rotate", 45);
});

$("#rotateRight").click(function() {
    $image.cropper("rotate", -45);
});

$("#setDrag").click(function() {
    $image.cropper("setDragMode", "crop");
});