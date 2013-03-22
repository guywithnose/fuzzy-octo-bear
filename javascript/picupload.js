$('document').ready(function() {
	var randomnumber=Math.floor(Math.random()*1000);
  var uploadPicture = $('#getUserImage').upload({
    name: 'temp',
    enctype: 'multipart/form-data',
    action: 'php-iqengines/query.php?timestamp=' + randomnumber,
    onComplete: function(data) {
      data = $.parseJSON(data).results[0].metadata;
      make = data.make;
      model = data.model;
      $('select#make option[value="' + data.make + '"]').attr('selected', 'selected');
      $('select#model option[value="' + data.model + '"]').attr('selected', 'selected');
      $('#make').selectmenu().selectmenu('refresh');
      $('#model').selectmenu().selectmenu('refresh');
      $('#year').change(function(){
        $.ajax({
          'url' : 'price.php',
          'dataType': 'json',
          data: {
            make:make,
            model:model,
            year:$(this).val()
          },
          success: function(data) {
            $('input#price').val(data['Average Cycletrader.com Price']);
            console.log(data);
          }
        });
      });
      $.ajax({
        'url' : 'price.php',
        'dataType': 'json',
        data: data,
        success: function(data) {
          $('input#price').val(data['Average Cycletrader.com Price']);
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

