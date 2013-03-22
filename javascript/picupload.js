$('document').ready(function() {
	var randomnumber=Math.floor(Math.random()*1000);
  var uploadPicture = $('#getUserImage').upload({
    name: 'temp',
    enctype: 'multipart/form-data',
    action: 'php-iqengines/query.php?timestamp=' + randomnumber,
    onComplete: function(data) {
      console.log($.parseJSON(data).results[0].metadata);
      $.ajax({
        'url' : 'price.php',
        'dataType': 'json',
        data: $.parseJSON(data).results[0].metadata,
        success: function(data) {
          $('input#price').val(data.Price);
          console.log(data);
        }
      });
      $('#processingRequest').fadeOut('fast');
      $.mobile.changePage('#page2', {transition: 'pop'});
    },
    onSelect: function() {
      var inputFile = $(':file[name="temp"]')[0].files[0];
      var renderedImage = new MegaPixImage(inputFile);
      var printUserPicture = document.getElementById('printUserPicture');
      renderedImage.render(printUserPicture, { maxWidth: 400, maxHeight: 400});
      $('.imagePlaceHolder').hide();
      $('#processingRequest').fadeIn();
      uploadPicture.submit();
			setTimeout(function(){
				$('#userImage').attr('src', 'php-iqengines/uploads/image' + randomnumber + '.jpg');
			}, 2000);
    }
  });
});

