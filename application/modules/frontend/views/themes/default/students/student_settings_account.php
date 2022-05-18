<style>
ul li {
    list-style: none;
}

#pswd_info {
    z-index: 9999;
    position: absolute;
    /* top: calc(100% + 12px); */
    bottom: -115px\9;
    /* left: 0; */
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
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
</style>
<!--Start Student Profile Header-->
<?php
                $this->load->view('dashboard_coverpage');
        ?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php
                $this->load->view('dashboard_topmenu');
        ?>
    </div>
</div>
<!--Student Profile Edit Option-->

<!--Start Student Account Settings-->
<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row justify-content-between">
                    <div class="col-md-4 col-lg-3 sticky-content">
                        <h3 class="fw-semi-bold mb-4">Settings</h3>
                        <!--Start Settings Nav-->
                        <?php
                                $this->load->view('setting_menu');
                            ?>
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
                                    <label for="current_password" class="form-label mb-1 fw-medium">Current Password
                                        <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-lg" id="current_password"
                                        placeholder="Your Current Password">
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label mb-1 fw-medium">Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-lg" id="new_password"
                                        placeholder="Your New Password">
                                    <div id="pswd_info">
                                        <h6>Password must be following requirements:</h6>
                                        <ul class="ps-0">
                                            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                            <li id="capital" class="invalid">At least <strong>one capital
                                                    letter</strong></li>
                                            <li id="number" class="invalid">At least <strong>one number</strong></li>
                                            <li id="length" class="invalid">Be at least <strong>8 characters</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="retype_password" class="form-label mb-1 fw-medium">Password
                                        Confirmation<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-lg" id="retype_password"
                                        placeholder="Confirm Your New Password">
                                </div>
                                <button type="button" class="btn btn-dark-cerulean btn-lg passchangebtn"
                                    onclick="student_changepassword()"><i data-feather="save"
                                        class="me-2"></i>Save</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h5 class="mb-0 fw-semi-bold">Language</h5>
                                <em class="text-muted fs-13">(Use the interface language)</em>
                            </div>
                            <?php 
                             $language = get_studentinfo($this->session->userdata('user_id'))->language
                             ?>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="language" class="form-label mb-1 fw-medium">Language
                                        <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg" id='language'
                                        aria-label="Default select example">
                                        <!-- <option value="">-- select one --</option> -->
                                        <option value="1" <?php echo (($language == 1) ? 'selected' : ''); ?>>English
                                        </option>
                                        <!-- <option value="2" <?php echo (($language == 2) ? 'selected' : ''); ?>>Bangla
                                        </option>
                                        <option value="3" <?php echo (($language == 3) ? 'selected' : ''); ?>>Arabic
                                        </option> -->
                                    </select>
                                </div>
                                <button type="button" class="btn btn-dark-cerulean btn-lg" onclick="saveLanguage()"><i
                                        data-feather="save" class="me-2"></i>Save</button>
                            </div>
                        </div>
                        <!-- <hr> -->
                        <!-- <div class="row">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h5 class="mb-0 fw-semi-bold">Social Media Integration</h5>
                                <em class="text-muted fs-13">(Automatically publish & share to Facebook, Twitter and
                                    Linkedin)</em>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label mb-1 fw-medium d-block">Facebook</label>
                                    <a class="btn btn-outline-primary btn-lg" href="#"><i
                                            class="fab fa-facebook me-1"></i>Connect To Facebook</a>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-1 fw-medium d-block">Twitter</label>
                                    <a class="btn btn-outline-primary btn-lg" href="#"><i
                                            class="fab fa-twitter me-1"></i>Connect To Twitter</a>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-1 fw-medium d-block">Linkedin</label>
                                    <a class="btn btn-outline-primary btn-lg" href="#"><i
                                            class="fab fa-linkedin-in me-1"></i>Connect To Linkedin</a>
                                </div>
                            </div>
                        </div> -->
                        <hr>
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
                                    <!-- <a href="#" class="text-decoration-underline">Help section</a>  -->
                                        <a href="<?php echo base_url($enterprise_shortname. '/contact'); ?>"
                                        class="text-decoration-underline">contact us</a>.
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Student Account Settings-->
<script>
$(document).ready(function() {

    $("body").on("keyup", "#new_password", function() {
        var pswd = $("#new_password").val();

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
            $('.passchangebtn').prop('disabled', false);
        } else {
            $('#pswd_info').show();
            $('.passchangebtn').prop('disabled', true);
        }
    });

    $("body").on("focus", "#new_password", function() {
        $('#pswd_info').show();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
            $('.passchangebtn').prop('disabled', false);
        } else {
            $('#pswd_info').show();
            $('.passchangebtn').prop('disabled', true);
        }
    });
    $("body").on("blur", "#new_password", function() {
        $('#pswd_info').hide();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
            $('.passchangebtn').prop('disabled', false);
        } else {
            $('#pswd_info').show();
            $('.passchangebtn').prop('disabled', true);
        }
    });

});
</script>