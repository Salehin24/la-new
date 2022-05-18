jQuery(document).ready(function ($) {

	// Once something is selected the change function will run
	$('.fileuploader').change(function () {

		 var $source = $('#video_here');
		  //$source[0].src = URL.createObjectURL(this.files[0]);
		  $('.video-upload').html('<video src="' + URL.createObjectURL(this.files[0]) + '" controls></video>');
		  // $source.parent()[0].load();

	});

	// Once something is selected the change function will run
	$('.fileuploader2').change(function () {

		// Create new FileReader as a variable
		var reader = new FileReader();

		// Onload Function will run after video has loaded
		reader.onload = function (file) {
			var fileContent = file.target.result;
			// style="max-height: 310px;max-widht:1903px;"
			// max-height: 409px; width: 100%;
			$('.video-upload2').html('<img src="' + fileContent + '" class="img-fluid" style="max-height: 409px;width:100%;" alt=""/>');
		}

		// Get the selected video from Dialog
		reader.readAsDataURL(this.files[0]);

	});

	// Once something is selected the change function will run
	$('.imguploader').change(function () {

		// Create new FileReader as a variable
		var reader = new FileReader();

		// Onload Function will run after video has loaded
		reader.onload = function (file) {
			var fileContent = file.target.result;
			// style="max-width: 398px" 
			$('.img-upload').html('<img src="' + fileContent + '" class=" border"  style="height: 171px;min-width: 312px;max-width: 312px;"  alt=""/>');
		}

		// Get the selected video from Dialog
		reader.readAsDataURL(this.files[0]);

	});

	// Once something is selected the change function will run
	$('.imguploader2').change(function () {

		// Create new FileReader as a variable
		var reader = new FileReader();

		// Onload Function will run after video has loaded
		reader.onload = function (file) {
			var fileContent = file.target.result;
			$('.img-upload2').html('<img src="' + fileContent + '"  class="img-fluid border"  style="min-height:349px;max-width: 312px;" alt=""/>');
		}

		// Get the selected video from Dialog
		reader.readAsDataURL(this.files[0]);

	});

	// Once something is selected the change function will run
	$('.imguploader3').change(function () {

		// Create new FileReader as a variable
		var reader = new FileReader();

		// Onload Function will run after video has loaded
		reader.onload = function (file) {
			var fileContent = file.target.result;
			$('.img-upload3').append('<img src="' + fileContent + '" class="img-fluid w-100" alt=""/>');
		}

		// Get the selected video from Dialog
		reader.readAsDataURL(this.files[0]);

	});

});
