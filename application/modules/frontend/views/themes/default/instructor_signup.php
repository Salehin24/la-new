<link rel="stylesheet" href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/intlTelInput.css'); ?>">

<style>
.iti--allow-dropdown{
	width: 100%;
}

ul li {
    list-style: none;
}

#pswd_info {
    position: absolute;
    top: calc(100% + 12px);
    bottom: -115px\9;
    left: 0;
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
    z-index: 11;
}
}

#pswd_info h4 {
    margin: 0 0 10px 0;
    padding: 0;
    font-weight: normal;
}

#pswd_info::before {
    content: "\25B2";
    position: absolute;
    top: -12px;
    left: 45%;
    font-size: 14px;
    line-height: 14px;
    color: #ddd;
    text-shadow: none;
    display: block;
}

#confirm-pswd_info {
    position: absolute;
    top: calc(100% + 12px);
    bottom: -115px\9;
    left: 0;
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
    z-index: 11;
}

#confirm-pswd_info h4 {
    margin: 0 0 10px 0;
    padding: 0;
    font-weight: normal;
}

#confirm-pswd_info::before {
    content: "\25B2";
    position: absolute;
    top: -12px;
    left: 45%;
    font-size: 14px;
    line-height: 14px;
    color: #ddd;
    text-shadow: none;
    display: block;
}

.invalid {
    background: url(../assets/invalid.png) no-repeat 0 50%;
    padding-left: 22px;
    line-height: 24px;
    color: #ec3f41;
}

.valid {
    background: url(../assets/valid.png) no-repeat 0 50%;
    padding-left: 28px;
    line-height: 24px;
    color: #3a7d34;
}

#pswd_info {
    display: none;
}

#confirm-pswd_info {
    display: none;
}

/* =========== close password format ============= */
/* ========= its for registrer otp popup */

/* .close {
    position: absolute;
    top: 10px;
    right: 15px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 13px;
    background: #00b140;
    border-radius: 100px;
    font-weight: 400;
}

.close:hover {
    text-decoration: none;
}

.close:hover {
    color: #555;
}

.newsletter-sm {
    background: #fff;
    margin: 0;
    padding: 50px 25px;
}

.newsletter-sm h5 {
    color: #00b140;
    margin-bottom: 15px;
    font-weight: 600;
    font-size: 17px;
}

.newsletter-sm .newsletter-input-sm {
    border: 1px solid #ddd;
    font-size: 14px;
    background-color: #fff;
    text-align: center;
    color: #999;
    padding: 10px 15px;
    border-radius: 3px 0px 0px 3px;
}

.newsletter-sm .newsletter-sm-bot,
.removebutton {
    position: relative;
    outline: none;
}

.newsletter-sm .newsletter-button-sm, 
.removebutton {
    text-align: center;
    cursor: pointer;
    font-weight: 700;
    font-size: 14.5px;
    color: #fff;
    border: none;
    background-color: #00b140;
    padding: 10px  15px;
    border-radius: 0px 3px 3px 0px;
    overflow: hidden;
} */
.resendbtn {
    text-align: center;
    cursor: pointer;
    font-weight: 700;
    font-size: 14.5px;
    color: #fff;
    border: none;
    background-color: #0dcaf0;
    padding: 10px 15px;
    border-radius: 0px 3px 3px 0px;
    overflow: hidden;
}

/* ================== close ============ */
</style>
<?php $otp_user_id =  $this->session->userdata('otp_user_id');?>
<input type="hidden" id="otp_user_id" value="<?php echo $otp_user_id; ?>">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div> <a class="close" href="javascript:void(0)" style="color: #fff;" title="Close"
                    data-bs-dismiss="modal"><i class="fa fa-times"></i></a>
                <div class="newsletter-sm">
                    <h5><i class="fa fa-envelope-o"></i>Please, check your mobile for OTP </h5>
                    <form action="javascript:void(0)" method="post">
                        <div class="newsletter-sm-bot">
                            <input class="newsletter-input-sm" id="otp" name="email" placeholder="Enter Your OTP"
                                type="text" />
                            <button class="newsletter-button-sm" type="button" onclick="otpsubmit()">Submit</button>
                            <button class="resendbtn" type="button" onclick="resendOtp()">Resend</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="border-md mx-0 rounded-3 row">
                    <!-- <div class="border-end-md col-md-6 p-sm-5 px-5">
                        <h2 class="h3 mb-4">Join Lead Academy</h2>
                        <p class="mb-0">Get Unlimited Access To World Class Online Learning</p>
                        <img class="d-block img-fluid mx-auto"  style="margin-top:100px" src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/signup.svg'); ?>" width="344" alt="Illustartion">
                    </div> -->
                    <div class="border-end-md col-md-6 p-sm-5 px-5">
                        <h2 class="h3 mb-4 fw-bold text-uppercase align-items-center" style="text-align:center">Join
                            Lead Academy</h2>
                        <h4 class="mb-0" style="font-size:20px ;text-align:center">Get Unlimited Access To World Class
                            Online Learning</h4>
                            <br>
                        <center class="text-center">
                        <a href="<?php echo base_url($enterprise_shortname.'/student-signup'); ?>"><strong>Become an Student</strong></a> 
                        </center>
                        <img class="d-block img-fluid mx-auto" style="margin-top:100px"
                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/signup.svg'); ?>"
                            width="344" alt="Illustartion">
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <h4>Instructor Sign up</h4>
                        <!-- <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="#"><i class="fab fa-google me-1"></i>Sign in with Google</a>
                        <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="#"><i class="fab fa-facebook me-1"></i>Sign in with Facebook</a>
                        <div class="d-flex align-items-center py-2 mb-2">
                            <hr class="w-100">
                            <div class="px-3">Or</div>
                            <hr class="w-100">
                        </div> -->
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>

                        <div class="mb-3">
                            <label class="form-label mb-1" for="name">Full name</label>
                            <input class="form-control form-control-lg" type="text" id="name"
                                placeholder="Enter your full name" autofocus required="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="mobile"><?php echo display('mobile'); ?></label>
                            <input class="form-control form-control-lg" type="number" id="mobile"
                                placeholder="Enter your mobile no" required="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="email">Email address</label>
                            <input class="form-control form-control-lg" type="email" id="email"
                                placeholder="Enter your email" required="">
                        </div>
                        <div class="mb-3 position-relative">
                            <label class="form-label mb-1" for="password"><?php echo display('password'); ?> <small
                                    class="fs-sm text-muted"></small></label>
                            <input class="form-control form-control-lg" type="password" id="password"
                                placeholder="<?php echo display('password'); ?>" required="">
                            <span style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpassword(1)">
                                    <div class="change-icon-1">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>
                            <div id="pswd_info">
                                <h6>Password must be following requirements:</h6>
                                <ul class="ps-0">
                                    <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                    <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                    <li id="number" class="invalid">At least <strong>one number</strong></li>
                                    <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                                </ul>
                            </div>

                        </div>
                        <div class="mb-3 position-relative">
                            <label class="form-label mb-1"
                                for="password-confirm"><?php echo display('confirm_password'); ?></label>
                            <input class="form-control form-control-lg" type="password" id="password-confirm"
                                placeholder="<?php echo display('confirm_password'); ?>" required="">
                            <span style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpassword(2)">
                                    <div class="change-icon-2">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>
                            <div id="confirm-pswd_info">
                                <h6>Password must be following requirements:</h6>
                                <ul class="ps-0">
                                    <li id="confirm-letter" class="invalid">At least <strong>one letter</strong></li>
                                    <li id="confirm-capital" class="invalid">At least <strong>one capital
                                            letter</strong></li>
                                    <li id="confirm-number" class="invalid">At least <strong>one number</strong></li>
                                    <li id="confirm-length" class="invalid">Be at least <strong>8 characters</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agree-to-terms" checked value="1"
                                required>
                            <label class="form-check-label" for="agree-to-terms">By joining, I read and agree to the<a
                                    target="_blank"
                                    href="<?php echo base_url($enterprise_shortname. '/terms-condition/'); ?>"
                                    class="text-decoration-underline">Terms & Conditions</a> and <a
                                    href="<?php echo base_url($enterprise_shortname. '/privacy-policy/'); ?>"
                                    class="text-decoration-underline" target="_blank">Privacy policy</a>
                                    <a target="_blank" href="<?php echo base_url($enterprise_shortname. '/refund-policy'); ?>" class="text-decoration-underline"> and Return and Refund Policy.</a>
                                </label>
                            <!-- <br>
                                <div class="loadotpmodal mt-2">
                                    <?php if($otp_user_id){ ?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">OTP Modal</button>
                                    <?php } ?>
                                </div> -->
                        </div>

                        <input type="hidden" name="usertype" id="usertype" value="5">
                        <button class="btn btn-dark-cerulean btn-lg w-100 registerbtn" onclick="register_save(5)"
                            type="button">Sign up</button>
                        <?php echo form_close(); ?>
                        <div class="mt-sm-4 text-center">Already have an account?
                            <strong>
                                <a href="<?php echo base_url($enterprise_shortname . '/ins-signin'); ?>"
                                    class="text-decoration-underline">Sign in</a>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/intlTelInput.js'); ?>"></script>
<script  src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/utils.js'); ?>"></script>
<script>
$(document).ready(function() {
    // $('input[type=password]').keyup(function() {
    $('#password').keyup(function() {
        // keyup code here

        // set password variable
        var pswd = $("#password").val();
        //validate the length

        if (pswd.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
            var error = 0;
        } else {
            $('#length').removeClass('invalid').addClass('valid');
            var error = 1;
        }
        //validate letter
        if (pswd.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
            var error1 = 1;
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
            var error1 = 0;
        }

        //validate capital letter
        if (pswd.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
            var error2 = 1;
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
            var error2 = 0;
        }

        //validate number
        if (pswd.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
            var error3 = 1;
        } else {
            $('#number').removeClass('valid').addClass('invalid');
            var error3 = 0;
        }
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
        // alert(error+'_'+error1+'_'+error2+'_'+error3);

    }).focus(function() {
        $('#pswd_info').show();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    }).blur(function() {
        $('#pswd_info').hide();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password').css({"border": ""});
        } else {
            $('#pswd_info').show();
            $('#password').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    });

    $('#password-confirm').keyup(function() {
        // keyup code here
        
        // set password variable
        var pswd = $("#password-confirm").val();
        //validate the length

        if (pswd.length < 8) {
            $('#confirm-length').removeClass('valid').addClass('invalid');
            var error = 0;
        } else {
            $('#confirm-length').removeClass('invalid').addClass('valid');
            var error = 1;
        }
        //validate letter
        if (pswd.match(/[A-z]/)) {
            $('#confirm-letter').removeClass('invalid').addClass('valid');
            var error1 = 1;
        } else {
            $('#confirm-letter').removeClass('valid').addClass('invalid');
            var error1 = 0;
        }

        //validate capital letter
        if (pswd.match(/[A-Z]/)) {
            $('#confirm-capital').removeClass('invalid').addClass('valid');
            var error2 = 1;
        } else {
            $('#confirm-capital').removeClass('valid').addClass('invalid');
            var error2 = 0;
        }

        //validate number
        if (pswd.match(/\d/)) {
            $('#confirm-number').removeClass('invalid').addClass('valid');
            var error3 = 1;
        } else {
            $('#confirm-number').removeClass('valid').addClass('invalid');
            var error3 = 0;
        }
        
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password-confirm').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#password-confirm').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
        // alert(error+'_'+error1+'_'+error2+'_'+error3);

    }).focus(function() {
        $('#confirm-pswd_info').show();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password-confirm').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#password-confirm').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    }).blur(function() {
        $('#confirm-pswd_info').hide();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#confirm-pswd_info').hide();
            $('.registerbtn').prop('disabled', false);
            $('#password-confirm').css({"border": ""});
        } else {
            $('#confirm-pswd_info').show();
            $('#password-confirm').css({"border": "1px solid red"});
            $('.registerbtn').prop('disabled', true);
        }
    });


    
 $("#password-confirm").on('keyup',function(){
    var pswd = $("#password").val();
    var password_confirm = $("#password-confirm").val();
    if(pswd != password_confirm){
        $('#password-confirm').css({"border": "1px solid red"});
        $('.registerbtn').prop('disabled', true);
    }else{
        $('#password-confirm').css({"border": "1px solid #45c203"});
    }
 });

 
 var input = document.querySelector("#mobile");
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

});
</script>