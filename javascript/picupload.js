$('document').ready(function(){
	var uploadPicture = $('#getUserImage').upload({
		name: 'temp',
		enctype: 'multipart/form-data',
		action: 'php-iqengines/query.php',
		onComplete: function(){},
		onSelect: function(){
			var inputFile = $(':file[name="temp"]')[0].files[0];
			var renderedImage = new MegaPixImage(inputFile);
			var printUserPicture = document.getElementById('printUserPicture');
			renderedImage.render(printUserPicture, { maxWidth: '100%', maxHeight:'100%'});
			var path = $('#getUserImage').val();
			$('#path').html(path);
			$('.imagePlaceHolder').hide();
			uploadPicture.submit();
		}
	});
});