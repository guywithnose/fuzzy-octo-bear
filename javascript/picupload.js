$('document').ready(function(){
	var uploadPicture = $('#getUserImage').upload({
		name: 'temp',
		enctype: 'multipart/form-data',
		action: 'php-iqengines/query.php',
		onComplete: function(data){
			console.log($.parseJSON(data).results[0].metadata);
			$('#processingRequest').fadeOut('fast');
			$.mobile.changePage('#page2', {transition: 'pop'});
		},
		onSelect: function(){
			var inputFile = $(':file[name="temp"]')[0].files[0];
			document.getElementById('userImage').innerHTML = "<img src='" + $(':file[name="temp"]')[0].files[0] + "' />" ;
			var renderedImage = new MegaPixImage(inputFile);
			var printUserPicture = document.getElementById('printUserPicture');
			renderedImage.render(printUserPicture, { maxWidth: 400, maxHeight: 400});
			$('.imagePlaceHolder').hide();
			$('#processingRequest').fadeIn();
			var reader = new FileReader();
			reader.onload = function(e){
				 $('#userImage').attr('src', e.target.result);
				}
			reader.readAsDataURL($(':file[name="temp"]')[0].files[0]);
			uploadPicture.submit();
		}
	});
});