<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('application/modules/square/assets/images/thumbnail.jpg'); ?>">
        <link href="<?php echo base_url('application/modules/square/assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/square/assets/css/style.css'); ?>" rel="stylesheet">

        <script src="<?php echo base_url('application/modules/square/assets/js/jquery-3.4.1.min.js') ?>"></script>
        <title><?php echo 'Square Payment Gateway' ?></title>
    </head>
    <body>
        <div class="container"><br>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 pb-5">
                    <!--Form with header-->
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><?php echo 'Square Payment Gateway' ?></h3>
                            </div>
                        </div>
                        <div class="col-sm-12"> 
                            <div class="card-body p-3">
                                <!--Body-->
                                <div class="errorMsg text-center text-danger m-b-5"></div>
                                <div id="form-container">
                                    <?php
                                    $applicationid = $gateway->marchant_id; // application id;
                                    $locationID = $gateway->email; //location id;
                                    ?>
                                    <input type="hidden" id="applicationId" value="<?php echo $applicationid; ?>">
                                    <input type="hidden" id="locationId" value="<?php echo $locationID; ?>">
                                    <?php
                                    $islive = $gateway->is_live;
                                    if ($islive == 1) {
                                        ?>
                                        <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
                                        <!-- link to the local SqPaymentForm initialization -->
                                        <script type="text/javascript" src="<?php echo base_url('application/modules/square/assets/js/square_live.js'); ?>"></script>
                                        <?php
                                    } else {
                                        ?>
                                        <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>
                                        <!-- link to the local SqPaymentForm initialization -->
                                        <script type="text/javascript" src="<?php echo base_url('application/modules/square/assets/js/square_sandbox.js'); ?>"></script>
                                    <?php } ?>


                                    <!-- link to the custom styles for SqPaymentForm -->
                                    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/square/assets/css/sqpaymentform-basic.css'); ?>">
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function (event) {
                                            if (SqPaymentForm.isSupportedBrowser()) {
                                                paymentForm.build();
//                                                paymentForm.recalculateSize();
                                            }
                                        });
                                    </script>

                                    <div id="form-container">
                                        <div id="sq-ccbox">
                                            <form id="nonce-form" novalidate action="<?php echo base_url('square-payment-success'); ?>" method="post">
                                                <fieldset>
                                                    <span class="label">Card Number</span>
                                                    <div id="sq-card-number"></div>
                                                    <div class="third">
                                                        <span class="label">Expiration</span>
                                                        <div id="sq-expiration-date"></div>
                                                    </div>

                                                    <div class="third">
                                                        <span class="label">CVV</span>
                                                        <div id="sq-cvv"></div>
                                                    </div>

                                                    <div class="third">
                                                        <span class="label">Postal</span>
                                                        <div id="sq-postal-code"></div>
                                                    </div>
                                                </fieldset>

                                                <button id="sq-creditcard" class="button-credit-card" onClick="requestCardNonce(event)">Pay <?php echo $gateway->currency . " " . $this->session->userdata('total_amount'); ?></button>
                                                <div id="error"></div>
                                                <!-- After a nonce is generated it will be assigned to this hidden input field. -->
                                                <input type="hidden" id="amount" name="amount" value="<?php echo $this->session->userdata('total_amount'); ?>">
                                                <input type="hidden" id="currency" name="currency" value="<?php echo $gateway->currency; ?>">
                                                <input type="hidden" id="orderid" name="orderid" value="<?php echo $this->session->userdata('invoice_id'); ?>">
                                                <input type="hidden" id="card-nonce" name="nonce">
                                            </form>
                                        </div> <!-- end #sq-ccbox -->

                                    </div> <!-- end #form-container -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Form with header-->
                </div>
            </div>
        </div>
    </body>
</html>
<!-- Contact Area -->
<script src="<?php echo base_url('application/modules/square/assets/js/script.js') ?>"></script>

