<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('application/modules/stripe/assets/images/thumbnail.jpg'); ?>">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/default/assets/plugins/bootstrap-4.5.0/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <title><?php echo 'Stripe Payment Gateway' ?></title>
    </head>
    <body>
        <div class="container"><br>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 pb-5">

                    <!--Form with header-->
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><?php echo 'Stripe Payment Gateway' ?></h3>
                            </div>
                        </div>
                        <div class="col-sm-12"> 
                            <div class="card-body p-3">
                                <!--Body-->
                                <div class="errorMsg text-center text-danger m-b-5"></div>
                                <div id="form-container">
                                    <form role="form" action="<?php echo base_url('frontend/stripe/stripepayment') ?>" method="post" class="require-validation" data-stripe-publishable-key="<?php echo 'pk_test_TrVFpmZBkgasCE6WTPkZgMPr00UzVVOqgp'; //$paymentinfo->password;                               ?>" id="payment-form">
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-6 form-group required'>
                                                <label class='control-label'>Name of Card</label> 
                                                <input class='form-control' size='4' type='text' name="cardName" id="cardName" placeholder="Card Name">
                                            </div>
                                            <div class='col-xs-12 col-md-6 form-group required'>
                                                <label class='control-label'>Card Number</label> 
                                                <input autocomplete='off' class='form-control card-number' max='20' type='text' name="cardNumber" id="cardNumber" placeholder="Card Number">
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label> 
                                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' name="card_cvc" id="card_cvc" type='text' max="3">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label> 
                                                <input class='form-control card-expiry-month' placeholder='MM' name="card_exp_month" id="card_exp_month" type='text' placeholder="12" max="2">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label> 
                                                <input class='form-control card-expiry-year' placeholder='YYYY' max="4" name="card_exp_year" id="card_exp_year"  type='text'>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-lg btn-block" id="payBtn" type="submit">Pay Now</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Form with header-->
                </div>
            </div>
        </div>
        <input type="hidden" id="purlisherKey" value="<?php echo $gateway->password; ?>"> <!-- PUBLISHABLE_KEY -->
    </body>
</html>
<!-- Contact Area -->
<script src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo base_url('application/modules/frontend/views/themes/stripe/script.js') ?>"></script>

