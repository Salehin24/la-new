
	<!--Start Student Account Settings-->
	<div class="py-5">
		<div class="container-lg">
			<div class="row justify-content-center">
				<div class="col-xl-10">
					<div class="row justify-content-between">
						<div class="col-md-4 col-lg-3 sticky-content">
							<h3 class="fw-semi-bold mb-4">Settings</h3>
							<!--Start Settings Nav-->
							<ul class="settings-nav list-unstyled">
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-account-settings'); ?>" class="active"><i data-feather="key" class="me-2"></i>Account</a></li>
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-notification-settings'); ?>"><i data-feather="bell" class="me-2"></i>Notifications</a></li>
								<!-- <li><a href="#"><i data-feather="pocket" class="me-2"></i>Manage Subscription (Beta)</a></li> -->
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-affiliation-settings'); ?>"><i data-feather="command" class="me-2"></i>Manage Affiliation</a></li>
								<!-- <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"><i data-feather="command" class="me-2"></i>Manage Affiliation</a></li> -->
								<!-- <li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-payment-setting'); ?>"><i data-feather="credit-card" class="me-2"></i>Payments & Payouts (Beta)</a></li> -->
								<li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"><i data-feather="credit-card" class="me-2"></i>Payments & Payouts</a></li>
							</ul>
							<!--End Settings Nav-->
						</div>
						<div class="col-md-8 col-lg-8 sticky-content">
							<h3 class="fw-semi-bold">Account</h3>
							<div>Password, Language, Social media integration, currency</div>
							<hr>
							<div class="row">
								<div class="col-md-4 mb-4 mb-md-0">
									<h5 class="mb-0 fw-semi-bold">Password</h5>
									<em class="text-muted fs-13">(Change Account Password)</em>
								</div>
								<div class="col-md-8">
									<div class="mb-3">
										<label for="cuPass" class="form-label mb-1 fw-medium">Current Password *</label>
										<input type="password" class="form-control form-control-lg" id="cuPass" placeholder="Your Current Password">
										<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('user_id')?>">
									</div>
									<div class="mb-3">
										<label for="nPass" class="form-label mb-1 fw-medium">Password</label>
										<input type="password" class="form-control form-control-lg" id="nPass" placeholder="Your New Password">
									</div>
									<div class="mb-3">
										<label for="coPass" class="form-label mb-1 fw-medium">Password Confirmation</label>
										<input type="password" class="form-control form-control-lg" id="coPass" placeholder="Confirm Your New Password">
									</div>
									<button type="button" class="btn btn-dark-cerulean btn-lg" id="change_passwordbtn"><i data-feather="save" class="me-2"></i>Save</button>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-4 mb-4 mb-md-0">
									<h5 class="mb-0 fw-semi-bold">Language</h5>
									<em class="text-muted fs-13">(Use the interface language)</em>
								</div>
								<div class="col-md-8">
									<div class="mb-3">
										<label for="instructor_language" class="form-label mb-1 fw-medium">Language *</label>
										<select class="form-select form-select-lg" aria-label="Default select example" id="instructor_language">
											<!-- <option value="">Select Language</option> -->
											<option value="english">English</option>
											<!-- <option value="bangla">Bangla</option>
											<option value="hindi">Hindi</option>
											<option value="urdu">Urdu</option> -->
										</select>
									</div>
									<button type="button" class="btn btn-dark-cerulean btn-lg" id="change_language"><i data-feather="save" class="me-2"></i>Save</button>
								</div>
							</div>
							<hr>
							<!-- <div class="row">
								<div class="col-md-4 mb-4 mb-md-0">
									<h5 class="mb-0 fw-semi-bold">Social Media Integration</h5>
									<em class="text-muted fs-13">(Automatically publish & share to Facebook, Twitter and Linkedin)</em>
								</div>
								<div class="col-md-8">
									<div class="mb-3">
										<label class="form-label mb-1 fw-medium d-block">Facebook</label>
										<a class="btn btn-outline-primary btn-lg" href="#"><i class="fab fa-facebook me-1"></i>Connect To Facebook</a>
									</div>
									<div class="mb-3">
										<label class="form-label mb-1 fw-medium d-block">Twitter</label>
										<a class="btn btn-outline-primary btn-lg" href="#"><i class="fab fa-twitter me-1"></i>Connect To Twitter</a>
									</div>
									<div class="mb-3">
										<label class="form-label mb-1 fw-medium d-block">Linkedin</label>
										<a class="btn btn-outline-primary btn-lg" href="#"><i class="fab fa-linkedin-in me-1"></i>Connect To Linkedin</a>
									</div>
								</div>
							</div>
							<hr> -->
							<div class="row">
								<div class="col-md-4 mb-4 mb-md-0">
									<h5 class="mb-0 fw-semi-bold">Currency</h5>
									<em class="text-muted fs-13">(Your Transaction currency)</em>
								</div>
								<div class="col-md-8">
									<select class="form-select form-select-lg" aria-label="Default select example">
										<option selected>৳ - BDT</option>
									</select>
									<div class="text-muted fs-13 mt-1">Not your local currency? 
										<!-- <a href="#" class="text-decoration-underline">Help section</a> or  -->
										<a href="<?php echo base_url($enterprise_shortname.'/contact/'); ?>" class="text-decoration-underline">contact us</a>.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--End Student Account Settings-->

	<script type="text/javascript">
		    $('#change_passwordbtn').on('click', function () {
		    	var base_url         = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
		        var current_password = $("#cuPass").val();
                var new_password     = $("#nPass").val();
                var retype_password  = $("#coPass").val();
                var user_id          = $("#user_id").val();
                if(current_password ==''){
                toastr["error"]('Please Input current Password');
                return false;	
                }
                if(new_password ==''){
                toastr["error"]('Please Input New Password');
                return false;	
                }
                if(retype_password ==''){
                toastr["error"]('Please Input Retype Password');
                return false;	
                }
                var csrf_test_name = $('[name="csrf_test_name"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "/instructor-change-password",
                data: {
                    user_id: user_id,
                    current_password: current_password,
                    new_password: new_password,
                    retype_password: retype_password,
                    csrf_test_name : csrf_test_name
                },
                cache: false,
                success: function(data) {
                	 var obj = JSON.parse(data);
                	if(obj.status == 0){
                	toastr["error"](obj.message);	
                   }else{
	                $("#cuPass").val('');
	                $("#nPass").val('');
	                $("#coPass").val('');
                   toastr["success"](obj.message);	
                  }
              
              console.log(data);

                }
            });

               });



     $('#change_language').on('click', function () {
     	var base_url         = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
     	var csrf_test_name   = $('[name="csrf_test_name"]').val();
     	var user_id          = $("#user_id").val();
     	var language         = $("#instructor_language").val();
     	if(language == ''){
	     	toastr["error"]('Please Select Language');	
	     	return false;
     	 }
     	           $.ajax({
                type: "POST",
                url: base_url + "/instructor-change-language",
                data: {
                    user_id: user_id,
                    language: language,
                    csrf_test_name : csrf_test_name
                },
                cache: false,
                success: function(data) {
                	 var obj = JSON.parse(data);
                	if(obj.status == 0){
                	toastr["error"](obj.message);	
                   }else{
                   toastr["success"](obj.message);	
                  }
              
              console.log(data);

                }
            });
      });

		    
	</script>