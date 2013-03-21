$('document').ready(function(){
	$('#getUserImage').change(function(){
			var inputFile = document.getElementById('getUserImage').files[0];
			var renderedImage = new MegaPixImage(inputFile);
			var printUserPicture = document.getElementById('printUserPicture');
			renderedImage.render(printUserPicture, { maxWidth: 400, maxHeight: 400 });
			var path = $('#getUserImage').val();
			$('#path').html(path)
			$.ajax({
					
			});
	});
});