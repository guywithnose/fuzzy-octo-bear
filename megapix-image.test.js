window.onload = function() {
  var fileInput = document.getElementById('fileInput');
  fileInput.onchange = function() {
    var file = fileInput.files[0];
    // MegaPixImage constructor accepts File/Blob object.
    mpImg = new MegaPixImage(file);

    // Render resized image into image element using quality option.
    // Quality option is valid when rendering into image element.
    var resImg = document.getElementById('resultImage');
    mpImg.render(resImg, { maxWidth: 300, maxHeight: 300, quality: 0.5 });

    // Render resized image into canvas element.
    var resCanvas1 = document.getElementById('resultCanvas1');
    mpImg.render(resCanvas1, { maxWidth: 300, maxHeight: 300 });

    // Render resized image into canvas element, rotating orientation = 6 (90 deg rotate right)
    // Types of orientation is defined in EXIF specification.
    // To detect orientation of JPEG file in JS, you can use exif.js from https://github.com/jseidelin/exif-js
    var resCanvas2 = document.getElementById('resultCanvas2');
    mpImg.render(resCanvas2, { maxWidth: 300, maxHeight: 300, orientation: 6 });

                  mpImg.onrender = function(image){
                    try {
im = image;
                      mpImg.onrender = null;
                      mpImg.render(photoImg[0], { maxWidth: 96, maxHeight: 96, quality: 0.9 });
                      $.ajax({
                        url: '/photos/create?base64=true',
                        data: JSON.stringify({file:image.src}),
                        type: 'POST',
                        success: function(response){
                          try {
                            var oResult = $.parseJSON(response);
                            if (oResult.length <= 0) {
                            }
                          } catch (e) {
                          }
                        },
                        error: function(){
                        }
                      });
                    } catch (e) {
                    }
                  }
  };
};
