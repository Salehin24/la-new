<style>
.resendbtn {
    text-align: center;
    cursor: pointer;
    font-weight: 700;
    font-size: 14.5px;
    color: #fff;
    background-color: #0dcaf0;
    overflow: hidden;
    border-color: #0dcaf0;
}

.countdown {
    color: #fb2b2b;
    font-weight: 700;
    font-size: 15px;
    margin-left: 15px;
}

/* ================== close ============ */
</style>
<?php $otp_user_id =  $this->session->userdata('otp_user_id');?>
<input type="hidden" id="otp_user_id" value="<?php echo $otp_user_id; ?>">


<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="border-md mx-0 rounded-3 p-5">

                    <div class="justify-content-center row">
                        <div class="col-md-12">
                            <div class='align-items-center d-flex justify-content-between mb-3'>
                                <h5 class="mb-0 text-left">Please, check your mobile for OTP</h5>

                            </div>
                            <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                            <div class="mb-3">
                                <input class="form-control form-control-lg" type="text" id="otp" placeholder="OTP"
                                    autofocus required="">
                            </div>
                        </div>
                    </div>
                    <div class="align-items-center d-flex justify-content-left">
                        <button class="btn btn-dark-cerulean btn-lg" onclick="otpsubmit()" type="button">Submit</button>
                        <button class="btn btn-primary btn-lg mx-2 resendbtn" onclick="resendOtp()"
                            type="button">Resend</button>
                        <div class="countdown"></div>
                    </div>
                    <?php echo form_close(); ?>
                    <!-- <div class="mt-sm-4 text-center">Already have an account?
                            <strong>
                                <a href="<?php echo base_url($enterprise_shortname . '/signin'); ?>" class="text-decoration-underline">Sign in</a>
                            </strong>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".resendbtn").hide();
$(document).ready(function() {
    $(".resendbtn").hide();
    // $(".resendbtn").delay(59000).show(400);
    // $(".resendbtn").delay(59000).show(400);
    $(".resendbtn").delay(59000).show(400);


    var timer2 = "00:59";
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
        // alert(timer2);
        if (timer2 == '0:00') {
            $(".countdown").hide(400);
        }
    }, 1000);

});
</script>