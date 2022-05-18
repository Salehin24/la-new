<style>
ul li {
    list-style: none;
}

#pswd_info {
    position: absolute;
    top: calc(100% + -40px);
    bottom: -115px\9;
    /* left: 45px; */
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
    top: calc(100% + -40px);
    bottom: -115px\9;
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
</style>
<?php
$customer_user_id = $this->session->userdata('user_id');
$customer_user_type = $this->session->userdata('user_type');
$session_id = $this->session->userdata('session_id');

$name = $mobile = $email = $address = $country_id = $city = $state = $zipcode = '';
if ($customer_user_type == '4') {
    $customer_info = $this->Frontend_model->get_student_info($customer_user_id);
    $name = $customer_info->name;
    $mobile = $customer_info->mobile;
    $email = $customer_info->email;
    $address = $customer_info->address;
    $country_id = $customer_info->country;
    $city = $customer_info->city;
    $state = $customer_info->state;
    $zipcode = $customer_info->zipcode;
}
?>
<?php echo form_open_multipart($enterprise_shortname .'/confirm-order', 'class="checkout-conent" id="checkoutFrm"'); ?>
<div class="bg-alice-blue py-5">
    <div class="container-lg p-0">
        <div class="row g-1">
            <div class="col-md-5 col-lg-4 order-md-last sticky-content">
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
                    <div class="card-body p-4 p-xl-5">

                        <h5 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-dark-cerulean"><?php echo display('your_order'); ?></span>
                            <!-- <span class="badge bg-dark-cerulean rounded-circle">3</span> -->
                        </h5>
                        <ul class="list-group mb-3" style="list-style: none;">
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
                                <div>
                                    <h6 class="my-0"><?php echo display('course'); ?></h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted"><?php echo display('total'); ?></span>
                            </li>
                            <?php
                                $coupon_amnt = 0;
                                $carts = $this->cart->contents();
                                foreach ($carts as $items) {
                                ?>
                            <input type="hidden" value="<?php echo  $items['is_course_type'];?>" id="is_course_type"
                                name="is_course_type[]">
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
                                <div style="width:70%">
                                    <h6 class="my-0"
                                        style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                        <?php echo html_escape($items['name']); ?></h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted" style="width:30%;text-align:right">BDT
                                    <?php echo html_escape(number_format($items['price'])); ?><?php //echo $this->cart->format_number(html_escape($items['price'])); ?>
                                </span>
                            </li>
                            <?php } ?>
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2 cart-subtotal">
                                <h6 class="my-0"><?php echo display('subtotal'); ?></h6>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">
                                    </span> BDT
                                    <?php echo html_escape(number_format($this->cart->total())); ?><?php //echo $this->cart->format_number(html_escape($this->cart->total())); ?>
                                </span>
                            </li>

                            <!-- coupon end -->


                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2"
                                id="couponAmountRow">
                                <div>
                                    <div class="coupon_discount">
                                        <h6 class="my-0"><?php echo display('coupon_discount') ?></h6>
                                    </div>
                                </div>
                                <!-- <td class="text-right"> -->
                                <!-- <span id="set_coupon_price"></span> -->
                                <span class="text-muted" id="set_coupon_price"></span>
                                <!-- </td> -->

                            </li>
                            <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2 order-total">
                                <h6><?php echo display('total'); ?></h6>
                                <td class="text-right">
                                    <strong>
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">
                                            </span>
                                            <?php //echo $this->cart->format_number(html_escape($this->cart->total())); ?>
                                            BDT <span id="total_amount"></span>
                                        </span>
                                        <!-- <input type="hidden" class="text-right" name="grandtotal" id="grandtotal"
                                                value="<?php echo html_escape($this->cart->total()); ?>"> -->
                                    </strong>
                                    <input type="hidden" name="grandtotal" id="order_total_amount">
                                    <input type="hidden" name="cart_total_amount" id="cart_total_amount"
                                        value="<?php echo html_escape($this->cart->total()); ?>">

                                </td>
                            </li>
                            <!-- coupon start  -->
                            <li class="border-bottom  justify-content-between lh-sm mb-2 pb-2">
                                <span class="text-danger" id="coupon_error_text_color"><span
                                        id="coupon_error"></span></span>
                                <span class="control-label font-weight-600" for="coupon_code">Use coupon code </span>
                                <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Enter your coupon here
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="row g-3">
                                            <!-- col-auto -->
                                            <div class="">
                                                <input type="text" id="coupon_code" class="form-control"
                                                    name="coupon_code" placeholder="Enter your coupon here">
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-primary" id="coupon_value">Apply Coupon</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault">
                                I read and agree to the <a
                                    href="<?php echo base_url($enterprise_shortname .'/terms-condition'); ?>">Terms
                                    &amp; Conditions</a>,
                                <a href="<?php echo base_url($enterprise_shortname. '/privacy-policy'); ?>">
                                    Privacy Policy</a>, and
                                <a href="<?php echo base_url($enterprise_shortname. '/refund-policy'); ?>"> Return and
                                    Refund Policy.</a>
                            </label>
                        </div>
                        <h5 class="mt-4 text-dark-cerulean">Payment</h5>
                        <!-- <div class="mt-3">
								<div class="form-check">
									<input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
									<label class="form-check-label" for="debit">Debit card</label>
								</div>
								<div class="form-check">
									<input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
									<label class="form-check-label" for="paypal">PayPal</label>
								</div>
							</div> -->
                        <?php foreach ($get_paymentgateway as $paymentgateway) { ?>
                        <div class="payment-block" id="payment">
                            <div class="payment-item">
                                <input type="radio" name="payment_method" class="p_method"
                                    id="payment_method_<?php echo $paymentgateway->id; ?>" data-parent="#payment"
                                    data-target="#description_<?php echo $paymentgateway->title; ?>"
                                    value="<?php echo $paymentgateway->value; ?>">
                                <label
                                    for="payment_method_<?php echo $paymentgateway->id; ?>"><?php echo $paymentgateway->title; ?></label>
                            </div>
                        </div>
                        <?php } ?>
                        <button class="w-100 btn btn-dark-cerulean btn-lg mt-3" type="submit" id="confirm_btn">Continue
                            to checkout</button>

                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 sticky-content">
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
                    <div class="card-body p-4 p-xl-5">
                        <h5 class="mb-3 text-dark-cerulean">Billing address</h5>
                        <!-- <form class="needs-validation" novalidate> -->
                        <div class="row g-3">

                            <div class="col-sm-12">
                                <label for="firstName" class="form-label"><?php echo display('name'); ?> <i
                                        class="text-danger"> *</i></label>
                                <!-- <input type="text" class="form-control" id="name" placeholder="" value="<?php echo html_escape($name); ?>" required> -->
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="<?php echo display('name'); ?>"
                                    value="<?php echo html_escape($name); ?>">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <!-- <div class="col-sm-6">
										<label for="lastName" class="form-label">Last name</label>
										<input type="text" class="form-control" id="lastName" placeholder="" value="" required>
										<div class="invalid-feedback">
											Valid last name is required.
										</div>
									</div> -->

                            <div class="col-6">
                                <label for="mail" class="form-label"><?php echo display('email'); ?> <span
                                        class="text-muted"><i class="text-danger"> *</i></span></label>
                                <input type="email" class="form-control" name="email" id="mail"
                                    onkeyup="existing_mailcheck()" value="<?php echo html_escape($email); ?>"
                                    placeholder="<?php echo display('email'); ?>">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="mobile" class="form-label">Mobile <span class="text-muted"><i
                                            class="text-danger"> *</i></span></label>
                                <div class="input-group has-validation">
                                    <input type="number" class="form-control" id="mobile" name="mobile"
                                        placeholder="<?php echo display('mobile'); ?>"
                                        value="<?php echo html_escape($mobile); ?>" required>
                                    <div class="invalid-feedback">
                                        Mobile
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label"><?php echo display('address'); ?><span
                                        class="text-muted"><i class="text-danger"> *</i></span></label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="<?php echo display('address'); ?>"
                                    value="<?php echo html_escape($address); ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="country_id" class="form-label"><?php echo display('country'); ?><span
                                        class="text-muted"><i class="text-danger"> *</i></span></label>
                                <select class="form-select" name="country_id" id="country_id"
                                    data-placeholder="-- select one --" required>
                                    <option value="">-- select one --</option>
                                    <?php foreach ($get_countries as $country) { ?>
                                    <option value="<?php echo html_escape($country->CountryID); ?>" <?php
                                                if ($country->CountryID == $country_id) {
                                                    echo 'selected';
                                                }
                                                ?>>
                                        <?php echo html_escape($country->CountryName); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label"><?php echo display('town'); ?> /
                                    <?php echo display('city'); ?><span class="text-muted"><i class="text-danger">
                                            *</i></span></label>
                                <input type="text" id="city" class="form-control" name="city"
                                    placeholder="<?php echo display('town'); ?> / <?php echo display('city'); ?>"
                                    value="<?php echo html_escape($city); ?>">
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label"><?php echo display('state'); ?><span
                                        class="text-muted"><i class="text-danger"> *</i></span></label>
                                <input type="text" id="state" class="form-control" name="state"
                                    placeholder="<?php echo display('state'); ?>"
                                    value="<?php echo html_escape($state); ?>">
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="zip"
                                    class="form-label"><?php echo display('postcode') . " / " . display('zip'); ?></label>
                                <input type="number" class="form-control" id="zipcode" name="zipcode"
                                    placeholder="<?php echo display('postcode') . " / " . display('zip'); ?>"
                                    value="<?php echo html_escape($zipcode); ?>" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>

                        </div>

                        <div class="row gy-3 mt-3">
                            <div class="col-md-12">
                                <!-- <h3 class="text-danger" id="coupon_error_text_color"><span id="coupon_error"></span></h3>
                                                <label class="control-label font-weight-600" for="coupon_code">Use coupon code </label>
                                                <a  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Enter your coupon here
                                                </a>
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                      <div class="row g-3">
                                                        <div class="col-auto">
                                                          <input type="text" id="coupon_code" class="form-control" name="coupon_code" placeholder="" >
                                                         </div>
                                                        <div class="col-auto">
                                                        <a class="btn btn-primary" id="coupon_value">Apply Coupon</a>
                                                        </div>
                                                      </div>
                                                     </div>
                                                </div> -->



                            </div>



                        </div>



                        <!-- </form> -->

                        <?php if (!$this->session->userdata('session_id')) { ?>
                        <div class="form-row">
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" name="account_status"
                                    id="account_check" onclick="create_account()" value="0">
                                <label class="custom-control-label"
                                    for="account_check"><?php echo display('create_an_account'); ?>!</label>
                            </div>
                            <div class="password_area col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="password"><?php echo display('password'); ?></label>
                                        <input type="password" name="password" class="form-control" id="pass">
                                        <span
                                            style="position: absolute;    right: 455px;    top: 553px;    font-size: 20px;">
                                            <a href="javascript:void(0)" onclick="viewcheckoutpassword(1)">
                                                <div class="change-icon-1">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </a>
                                        </span>
                                        <div id="pswd_info">
                                            <h6>Password must be following requirements:</h6>
                                            <ul class="ps-0">
                                                <li id="letter" class="invalid">At least <strong>one letter</strong>
                                                </li>
                                                <li id="capital" class="invalid">At least <strong>one capital
                                                        letter</strong></li>
                                                <li id="number" class="invalid">At least <strong>one number</strong>
                                                </li>
                                                <li id="length" class="invalid">Be at least <strong>8
                                                        characters</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirmpw"><?php echo display('confirm_password'); ?></label>
                                        <input type="password" name="confirmpw" class="form-control" id="confirmpw">
                                        <span style="position: absolute; right: 53px; top: 553px; font-size: 20px;">
                                            <a href="javascript:void(0)" onclick="viewcheckoutpassword(2)">
                                                <div class="change-icon-2">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </a>
                                        </span>
                                        <div id="confirm-pswd_info">
                                            <h6>Password must be following requirements:</h6>
                                            <ul class="ps-0">
                                                <li id="confirm-letter" class="invalid">At least <strong>one
                                                        letter</strong></li>
                                                <li id="confirm-capital" class="invalid">At least <strong>one capital
                                                        letter</strong></li>
                                                <li id="confirm-number" class="invalid">At least <strong>one
                                                        number</strong></li>
                                                <li id="confirm-length" class="invalid">Be at least <strong>8
                                                        characters</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>



<?php
$carts_info = $this->cart->contents();
$rowid = '';
foreach ($carts_info as $info) {
    $rowid = $info['rowid'];
}
?>
<input type="hidden" id="session_id" value="<?php echo html_escape($session_id); ?>">
<input type="hidden" id="cart_contents"
    value="<?php echo html_escape(!empty($rowid) ? $rowid : 'subscriptionitem'); ?>">

<script>
var cart_total_amount = $('#cart_total_amount').val();
$('#couponAmountRow').hide();
$('#total_amount').html(cart_total_amount);
// $('#order_total_amount').val(parseFloat(cart_total_amount).toFixed(2));
$('#order_total_amount').val(cart_total_amount);
var coupon_amnt = $('#coupon_amnt').val();
var coupon_message = $('#coupon_message').val();
var coupon_error_message = $('#coupon_error_message').val();
var coupon_amnt = 0;
//check coupon amount
$('#coupon_value').on('click', function(e) {
    e.preventDefault();
    let couponInfo = $('#coupon_code').val();
    let coupon_code = $.trim(couponInfo);
    let subscription_price = $("#subscription_price").val();
    $.ajax({
        url: base_url + enterprise_shortname + "/apply-coupon",
        type: "post",
        data: {
            "csrf_test_name": CSRF_TOKEN,
            "coupon_code": coupon_code,
            subscription_price: subscription_price
        },
        success: function(r) {
            // var coupon_amnt = $('#coupon_amnt').val();
            var obj = JSON.parse(r);
            if (obj.coupon_type == '1' || obj.coupon_type == '2') {
                couponAmount = obj.coupon_amnt;
                $('#set_coupon_price').html(couponAmount);
                $('#couponAmountRow').show();
                // var afterCouponTotalAmount = +parseFloat(cart_total_amount).toFixed(2) - +parseFloat(couponAmount).toFixed(2);
                var afterCouponTotalAmount = (cart_total_amount ? parseFloat(cart_total_amount) :
                    0) - (couponAmount ? parseFloat(couponAmount) : 0);
                $('#total_amount').html(parseFloat(afterCouponTotalAmount).toFixed(2));
                $('#order_total_amount').val(parseFloat(afterCouponTotalAmount).toFixed(2));
                $('#coupon_error').html(obj.coupon_message)
                $('#coupon_error_text_color').css({
                    'color': '#155724'
                });
            } else {
                $('#coupon_error').html(obj.coupon_error_message);
                $('#coupon_error_text_color').css({
                    'color': '#721c24'
                });
            }
            // else if(r=='6'){
            //   toastrErrorMsg("login to apply coupon");

            // }else if(r=='5'){
            //     toastrErrorMsg("Coupon Code must be required!");
            // }else if(r=='3'){

            //     toastrErrorMsg("coupon is expired!");
            // }



        }
    });

});



// ============ its for password validation ================
$('#pass').keyup(function() {
    // keyup code here

    // set password variable
    var pswd = $("#pass").val();
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
    } else {
        $('#pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
    // alert(error+'_'+error1+'_'+error2+'_'+error3);

}).focus(function() {
    $('#pswd_info').show();
    if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
        $('#pswd_info').hide();
        $('.registerbtn').prop('disabled', false);
    } else {
        $('#pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
}).blur(function() {
    $('#pswd_info').hide();
    if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
        $('#pswd_info').hide();
        $('.registerbtn').prop('disabled', false);
    } else {
        $('#pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
});

$('#confirmpw').keyup(function() {
    // keyup code here

    // set password variable
    var pswd = $("#confirmpw").val();
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
    } else {
        $('#confirm-pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
    // alert(error+'_'+error1+'_'+error2+'_'+error3);

}).focus(function() {
    $('#confirm-pswd_info').show();
    if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
        $('#confirm-pswd_info').hide();
        $('.registerbtn').prop('disabled', false);
    } else {
        $('#confirm-pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
}).blur(function() {
    $('#confirm-pswd_info').hide();
    if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
        $('#confirm-pswd_info').hide();
        $('.registerbtn').prop('disabled', false);
    } else {
        $('#confirm-pswd_info').show();
        $('.registerbtn').prop('disabled', true);
    }
});


function viewcheckoutpassword(type) {
    if (type == 1) {
        if ("password" == $("#pass").attr("type")) {
            $("#pass").prop("type", "text");
            $(".change-icon-1").html('<i class="far fa-eye-slash"></i>');
        } else {
            $("#pass").prop("type", "password");
            $(".change-icon-1").html('<i class="fas fa-eye"></i>');
        }
    } else if (type == 2) {
        if ("password" == $("#confirmpw").attr("type")) {
            $("#confirmpw").prop("type", "text");
            $(".change-icon-2").html('<i class="far fa-eye-slash"></i>');
        } else {
            $("#confirmpw").prop("type", "password");
            $(".change-icon-2").html('<i class="fas fa-eye"></i>');
        }
    }
}
</script>