<style>
.fg-modal {
    position: fixed;
    top: 120px;
}
</style>
<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="row mx-0 align-items-center border-md rounded-3">
                    <div class="col-md-6 border-end-md p-4 p-sm-5">
                        <h2 class="h3 mb-4 mb-sm-5">Hey there!<br>Welcome back.</h2><img
                            class="d-block mx-auto img-fluid"
                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/signin.svg'); ?>"
                            width="344" alt="Illustartion">
                        <!--<div class="mt-4 mt-sm-5">Don't have an account? <a href="<?php echo base_url($enterprise_shortname . '/signup'); ?>" class="text-decoration-underline">Sign up here</a></div>-->
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                        <h4>Student Sign in</h4>
                        <!-- <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="#"><i
                                class="fab fa-google me-1"></i>Sign in with Google</a> -->
                        <?php echo $googlelogin_button; ?>
                        <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href="<?php echo $authURL; ?>"><i
                                class="fab fa-facebook me-1"></i>Sign in with Facebook</a>
                        <!-- <div class="d-flex align-items-center py-3 mb-3">
                            <hr class="w-100">
                            <div class="px-3">Or</div>
                            <hr class="w-100">
                        </div> -->
                        <?php echo form_open_multipart('', 'class="myform" id="learner_myform"'); ?>
                        <div class="mb-3">
                            <label class="form-label mb-1" for="email">Email address</label>
                            <input class="form-control form-control-lg" name="email" type="email" id="email"
                                placeholder="Enter your email" tabindex="1" required="" autofocus>
                        </div>
                        <div class="mb-3" style="position : relative">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label class="form-label mb-0" for="password">Password</label><a class="fs-sm" href="#"
                                    class="text-decoration-underline"></a>
                            </div>
                            <input class="form-control form-control-lg" name="password" type="password" id="password"
                                placeholder="Enter password" tabindex="2" required="">
                            <span style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpassword(4)">
                                    <div class="change-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>
                        </div>

                        <!-- <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" data-val="true" data-val-required="The Remember me? field is required." id="rememberme" onclick="is_remember()" name="rememberme" type="checkbox" value="0">
                                <label class="custom-control-label" for="rememberme"><?php echo display('remember_me'); ?>?</label>
                            </div>
                        </div> -->


                        <button class="btn btn-dark-cerulean btn-lg w-100 login_submit" type="button"
                            onclick="loginProcess(4)">Sign in</button>
                        <?php echo form_close(); ?>

                        <div class="col-6 text-right">
                            <a class="m-link-muted small" href="javascript:void(0)" onclick="forgotpassword_form()"
                                data-toggle="modal"
                                data-target="#forgotModal"><strong><?php echo display('forgot_password'); ?> ?</strong>
                            </a>
                        </div>

                        <div class="mt-sm-4 text-center">Don't have an account?
                            <strong>
                                <a href="<?php echo base_url($enterprise_shortname . '/student-signup'); ?>"
                                    class="text-decoration-underline">Sign up</a>
                            </strong>
                        </div>

                        <div class="mt-sm-4 text-center">Login as
                            <strong>
                                <a href="<?php echo base_url($enterprise_shortname . '/ins-signin'); ?>"
                                    class="text-decoration-underline">Instructor</a>
                            </strong>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fg-modal m-t-40 " id="forgotmodal_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title forgotmodal_ttl"></h6>
                <!-- <button type="button" class="close" data-bs-dismiss="modal">&times;</button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="forgotinfo">

            </div>
            <!-- Modal footer -->
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>