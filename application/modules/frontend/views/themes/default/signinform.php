<div class="col-md-12 col-lg-12 col-xl-12 loadpage">
    <!-- <div class="my-4"> -->
        <div class="mb-6">
        </div>
        <?php echo form_open_multipart('#', 'class="input-line form-input" role="form" id="myform"'); ?>
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="form-input-group">
                    <div class="apend-wrap">
                        <i class="fa icon-user"></i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required form-label" for="email"><?php echo display('email'); ?></label>
                        <input class="form-control" data-val="true" data-val-required="The UserName field is required." id="email" name="email" placeholder="Your Email" type="text" value="<?php echo get_cookie("email"); ?>" autocomplete="off"/>
                        <span class="underline"></span>
                        <input data-val="true" data-val-required="The UserRole field is required." id="username" name="username" type="hidden" />
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="form-input-group">
                    <div class="apend-wrap">
                        <i class="feather icon-mail"></i>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required form-label" for="password"><?php echo display('password'); ?></label>
                        <input class="form-control" data-val="true" data-val-email="The Password field is not a valid" data-val-required="The Password field is required." id="password" name="password" placeholder="Your Password" type="password" value="<?php echo get_cookie("password"); ?>" />
                        <span class="underline"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <!-- <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" data-val="true" data-val-required="The Remember me? field is required." id="rememberme" onclick="is_remember()" name="rememberme" type="checkbox" value="0">
                    <label class="custom-control-label" for="rememberme"><?php echo display('remember_me'); ?>?</label>
                </div>
            </div>
            <div class="col-6 text-right">
                <a class="m-link-muted small" href="javascript:void(0)" onclick="forgotpassword_form()" data-toggle="modal" data-target="#forgotModal"><?php echo display('forgot_password'); ?> ?</a>
            </div> -->

            

            <div class="col-md-12 center">         
                <input type="hidden" name="subscription_id" id="subscription_id" value="<?php echo $this->session->userdata('subscription_id'); ?>">           
                <input type="hidden" name="checkout" id="checkout" value="<?php if($this->cart->contents()){ echo 'checkout'; }elseif($this->session->userdata('subscription_id')){ echo 'checkout'; }else{echo '0'; } ?>">
                <!-- <input type="text" name="checkout" id="checkout" value="<?php //echo ($this->cart->contents()) ? "checkout" : "0" ?>"> -->
                <input type="button" class="btn btn-success btn-block transition-hover mt-4 mb-2 login_submit" onclick="loginProcess(4)" value="<?php echo display('login'); ?>">
            </div>
        </div>
        <?php echo form_close(); ?>
    <!-- </div> -->
</div>