<form action="javascript:void(0)" class="input-line form-input" method="post" role="form">
    <div class="row no-gutters">
        <div class="col-md-12">
            <p class="text-center">Fill with your mail to receive instructions on how to reset your password.</p>
            <div class="form-input-group">
                <div class="apend-wrap">
                    <i class="feather icon-user"></i>
                </div>
                <div class="form-group">
                    <!-- <label class="required mb-2" for="email"><?php echo display('email'); ?></label> -->
                    <input class="form-control" data-val="true" data-val-required="The UserName field is required." id="forgot_email" name="email" placeholder="Enter Your Mail" type="text"/>
                    <span class="underline"></span>
                    <input data-val="true" data-val-required="The UserRole field is required." id="username" name="username" type="hidden" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 center">                    
            <input type="hidden" name="checkout" id="checkout" value="checkout">
            <input type="button" class="btn btn-block btn-success lh-lg mb-2 mt-3 transition-hover w-100" onclick="forgotpassword_send()" value="Reset Password">
        </div>
    </div>
    <div class="text-center">
    <p class="text-muted text-center mt-3 mb-0">
                                Remember your password? <a class="external" href="javascript:void(0)" data-bs-dismiss="modal"> Sign in.</a>.
                            </p>
    </div>
</form>  