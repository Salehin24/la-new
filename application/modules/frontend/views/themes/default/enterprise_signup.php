<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="row mx-0 align-items-center border-md rounded-3">
                    <div class="col-md-6 border-end-md p-4 p-sm-5">
                        <h2 class="h3 mb-4">Join Lead Academy.<br>Get premium benefits:</h2>
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex mb-2"><i class="far fa-check-circle text-dark-cerulean mt-1 me-2"></i><span>Add and promote your listings</span></li>
                            <li class="d-flex mb-2"><i class="far fa-check-circle text-dark-cerulean mt-1 me-2"></i><span>Easily manage your wishlist</span></li>
                            <li class="d-flex mb-0"><i class="far fa-check-circle text-dark-cerulean mt-1 me-2"></i><span>Leave reviews</span></li>
                        </ul><img class="d-block mx-auto img-fluid" src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/signup.svg'); ?>" width="344" alt="Illustartion">
                        <div class="mt-sm-4">Already have an account? <a href="<?php echo base_url($enterprise_shortname . '/signin'); ?>" class="text-decoration-underline">Sign in</a></div>
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
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
                                <input class="form-control form-control-lg" type="text" id="name" placeholder="Enter your full name" required="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="mobile"><?php echo display('mobile'); ?></label>
                                <input class="form-control form-control-lg" type="text" id="mobile" placeholder="Enter your mobile no" required="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="email">Email address</label>
                                <input class="form-control form-control-lg" type="email" id="email" placeholder="Enter your email" required="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="password"><?php echo display('password'); ?> <small class="fs-sm text-muted">(min. 8 char)</small></label>
                                <input class="form-control form-control-lg" type="password" id="password" placeholder="<?php echo display('password'); ?>" required="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="password-confirm"><?php echo display('confirm_password'); ?></label>
                                <input class="form-control form-control-lg" type="password" id="password-confirm" placeholder="<?php echo display('confirm_password'); ?>" required="">
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="agree-to-terms" checked value="1" required="">
                                <label class="form-check-label" for="agree-to-terms">By joining, I agree to the <a href="#" class="text-decoration-underline">Terms of use</a> and <a href="#" class="text-decoration-underline">Privacy policy</a></label>
                            </div>
                        <button class="btn btn-dark-cerulean btn-lg w-100" onclick="register_save(2)" type="button"><?php echo display('signup'); ?></button>
                       <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>