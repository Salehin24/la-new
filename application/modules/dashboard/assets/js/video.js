$(document).ready(function() {
	$("#loader-icon").hide();
	$('.fileuploader').change(function () {
		
		event.preventDefault();
	    var	base_url=$('#base_url').val();
	//    course disable button and tab 
		$(".btnNext").hide();
		$('#coursesave_btn').hide();
		$("#v-pills-pricing-tab").prop("disabled", true);
        $("#v-pills-pricing-tab").addClass("price_disable");
     //    course disable button and tab end

		$("#phppot-message").removeClass("error");
		$("#phppot-message").removeClass("success");
		$("#phppot-message").text("");
		$("#btnUpload").hide();
		$("#loader-icon").show();
        var video_file = $("#pro_url").val();
		var CSRF_TOKEN = $("#CSRF_TOKEN").val();
		var enterprise_shortname = $("#enterprise_shortname").val();
		var fd = new FormData();
		fd.append("video_file", $("#pro_url")[0].files[0]);
        fd.append('csrf_test_name', (CSRF_TOKEN));
		
		$.ajax({ 
			url :base_url + enterprise_shortname + "/promo-video-upload",
			type : "POST",
			dataType : 'json',
			data : fd,
			contentType : false,
			processData : false,
			success : function(data) {

				if (data.type == "error") {
					$("#btnUpload").show();
					$("#loader-icon").hide();
					$("#phppot-message").addClass("error");
					$("#phppot-message").text(data.error_message);
					toastr.success(data.error_message);
				} else if (data.type == "success") {
					var type_id = $("#course_type").val();
					if (type_id == 2 || type_id == 3 || type_id == 4) {
						// $('#v-pills-pricing-tab').hide();  
						$("#v-pills-pricing-tab").prop("disabled", true);
						$('.btnNext').hide();
						$('#coursesave_btn').show();
						$("#v-pills-pricing-tab").addClass("price_disable");
					} else {
						
						$("#v-pills-pricing-tab").prop("disabled", false);
						$("#v-pills-pricing-tab").removeClass("price_disable");
						$('.btnNext').show();
						$('.finishoff').hide();
					}

					$("#btnUpload").show();
					$("#loader-icon").hide();
					// $("#phppot-message").addClass("success");
					// $("#phppot-message").text("Video uploaded. " + data.link);
					toastr.success("Upload successfully");
                    
      
					let str=data.link;
					myArr = str.split("/");
					video_id=myArr[3];
                    $('#url').val(data.link);





					
				}
			}
		});
	});


	// $('.fileuploader').change(function () {
	// 	// Create new FileReader as a variable
	// 	var reader = new FileReader();
	
	// 	// Onload Function will run after video has loaded
	// 	reader.onload = function (file) {
	// 		var fileContent = file.target.result;
	// 		$('.video-upload').append('<video src="' + fileContent + '" controls></video>');
	// 	}
	
	// 	// Get the selected video from Dialog
	// 	reader.readAsDataURL(this.files[0]);
	
	// });

});

