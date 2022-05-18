	
  <link rel="stylesheet" href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/intlTelInput.css'); ?>">
  <style>
.iti--allow-dropdown{
	width: 100%;
}
	  </style>
	<!--Start Course Preview Header-->
	<div class="hero-header text-white position-relative bg-img"
	    data-image-src="<?php echo base_url(!empty(getappsettings($enterprise_id)->contactus_header_image) ? getappsettings($enterprise_id)->contactus_header_image : default_600_400()); ?>">
	    <div class="container-lg hero-header_wrap position-relative">
	        <div class="row align-items-end my-5">
	            <div class="col-12">
	                <h1 class="fw-semi-bold my-4">Contact Us</h1>
	            </div>
	        </div>
	    </div>
	</div>
	<!--End Course Preview Header-->
	<!--Start F.A.Q-->
	<div class="bg-alice-blue py-5">
	    <div class="container-fluid px-xl-7">
	        <div class="row g-5">
	            <div class="col-lg-6">
	                <div class="mapbox">
	                    <!-- <div id="mapBox" class="" style="height: 450px" data-lat="23.751611" data-lon="90.370381"
	                        data-zoom="10" data-info="Rd No. 8A, Dhaka 1209,Q92C+J5R Dhaka."
	                        data-marker="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/marker.png');?>"
	                        data-mlat="23.751611" data-mlon="90.370381"> -->
							<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d912.9703229713159!2d90.3698338!3d23.7516122!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd3460d9ff26ccb52!2zMjPCsDQ1JzA1LjgiTiA5MMKwMjInMTMuNCJF!5e0!3m2!1sen!2sbd!4v1640149738105!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29210.643275171566!2d90.35475333804875!3d23.77124578799027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bfb5d6152cc3%3A0x9917bc21ced59176!2sLead%20Academy!5e0!3m2!1sen!2sbd!4v1640227494208!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							<!-- </div> -->
	                </div>
	            </div>
	            <div class="col-lg-6">
	                <div class="contact_form">


	                    <form class="contact_form_box" method="post" id="contactForm" novalidate="novalidate">
	                        <div class="row">
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="fullName" class="form-label">Full Name <i class="text-danger"> *
	                                        </i></label>
	                                    <input type="text" class="form-control form-control-lg" id="fullName"
	                                        placeholder="Enter Your Name">
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="phoneNumber" class="form-label">Phone No.</label>
	                                    <input type="number" class="form-control form-control-lg" id="phoneNumber" min="0">
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="emailAddress" class="form-label">Your Email <i class="text-danger"> *
	                                        </i></label>
	                                    <input type="email" class="form-control form-control-lg" id="emailAddress"
	                                        placeholder="Enter Your Email address">
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="whoAmI" class="form-label">I am</label>
	                                    <select class="form-select form-select-lg" aria-label="Default select example"
	                                        id="whoAmI">
	                                        <option value="Student" selected>Student</option>
	                                        <option value="Instructor">Instructor</option>
	                                        <option value="Company">Company</option>
	                                    </select>
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="organizationName" class="form-label">Organization Name</label>
	                                    <input type="text" class="form-control form-control-lg" id="organizationName"
	                                        placeholder="">
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="mb-3">
	                                    <label for="prefferedDate" class="form-label">Preffered date and Time</label>
	                                    <input type="datetime-local" class="form-control form-control-lg" id="prefferedDate">
	                                </div>
	                            </div>
	                            <div class="col-lg-12">
	                                <div class="mb-3">
	                                    <label for="reasonForCall" class="form-label">Reason for a call <i
	                                            class="text-danger"> * </i></label>
	                                    <textarea class="form-control" id="reasonForCall" rows="5"
	                                        placeholder="write message"></textarea>
	                                </div>
	                            </div>
	                        </div>
	                        <button type="button" class="btn btn-lg btn-dark-cerulean" id="submit_contact">Send
	                            Message</button>



	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	<!--End F.A.Q-->

    <script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/intlTelInput.js'); ?>"></script>
	<!--gmaps Js-->
	<!-- AIzaSyB13ZAvCezMx5TETYIiGlzVIq65Mc2FG5g -->
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCiXxFU3GJiFz35LlWrj_HgehXtHUmFPY"></script> -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCiXxFU3GJiFz35LlWrj_HgehXtHUmFPY"></script>
	<script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/gmaps.min.js'); ?>"></script>
	<script  src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/utils.js'); ?>"></script>
	<script>
if ($("#mapBox").length) {
    var $lat = $("#mapBox").data("lat");
    var $lon = $("#mapBox").data("lon");
    var $zoom = $("#mapBox").data("zoom");
    var $marker = $("#mapBox").data("marker");
    var $info = $("#mapBox").data("info");
    var $markerLat = $("#mapBox").data("mlat");
    var $markerLon = $("#mapBox").data("mlon");
    var map = new GMaps({
        el: "#mapBox",
        lat: $lat,
        lng: $lon,
        scrollwheel: false,
        scaleControl: true,
        streetViewControl: false,
        panControl: true,
        disableDoubleClickZoom: true,
        mapTypeControl: false,
        zoom: $zoom,
    });
    map.addMarker({
        lat: $markerLat,
        lng: $markerLon,
        icon: $marker,
        infoWindow: {
            content: $info,
        },
    });
}
	</script>

	<script>
$('#submit_contact').on('click', function() {
    var name = $('#fullName').val();
    var phoneNumber = $('#phoneNumber').val();
    var emailAddress = $('#emailAddress').val();
    var whoAmI = $('#whoAmI').val();
    var organizationName = $('#organizationName').val();
    var prefferedDate = $('#prefferedDate').val();
    var reasonForCall = $('#reasonForCall').val();
	// alert(phoneNumber);return false;
    if (name == '') {
        toastrErrorMsg("Name must be required!");
        $("#fullName").focus();
        return false;
    }
    if (emailAddress == '') {
        toastrErrorMsg("Email must be required!");
        $("#emailAddress").focus();
        return false;
    }
    if (IsEmail(emailAddress) == false) {
        toastrErrorMsg("Your mail is invalid");
        return false;
    }

    if (reasonForCall == '') {
        toastrErrorMsg("Message must be required!");
        $("#reasonForCall").focus();
        return false;
    }

    $.ajax({
        url: base_url + enterprise_shortname + "/submit-contact",
        type: "POST",
        data: {
            'csrf_test_name': CSRF_TOKEN,
            name: name,
            emailAddress: emailAddress,
            phoneNumber: phoneNumber,
            whoAmI: whoAmI,
            organizationName: organizationName,
            prefferedDate: prefferedDate,
            reasonForCall: reasonForCall,
            enterprise_shortname: enterprise_shortname
        },
        success: function(r) {
            // console.log(r);return false;
            toastrSuccessMsg(r);
        }
    });

});

var input = document.querySelector("#phoneNumber");
	var utilslink = 'application/modules/frontend/views/themes/default/assets/js/';

    window.intlTelInput(input, {
		
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    //   onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      preferredCountries: ['bd'],
      // separateDialCode: true,
	  	// Change the country selection
 		// instance.selectCountry("gb"),
		 

 
      utilsScript: utilslink+"utils.js",
    });

("use strict");

function IsEmail(email) {
    var regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}
	</script>