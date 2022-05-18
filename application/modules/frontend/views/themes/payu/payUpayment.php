<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- App favicon -->
        <link href="<?php echo base_url('application/modules/frontend/views/themes/default/assets/plugins/bootstrap-4.5.0/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/payu/style.css'); ?>" rel="stylesheet">
        <title><?php echo 'PayU Payment Gateway' ?></title>
    </head>
    <body onload="submitPayuForm()">

        <div class="pmt_preloader">
            <div id="overlayer"></div>
            <span class="pmt_loader">
                <span class="loader-inner"></span>
            </span>
        </div>

        <div class="container"><br>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 pb-5">
                    <!--Form with header-->
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3><?php echo 'PayU Money Payment Gateway' ?></h3>
                            </div>
                        </div>
                        <div class="col-sm-12"> 
                            <div class="card-body p-3">
                                <!--Body-->
                                <div class="errorMsg text-center text-danger m-b-5"></div>
                                <div id="form-container">
                                    <form action="<?php echo $action; ?>" method="post" name="payuForm">
                                        <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
                                        <input type="hidden" name="hash" id="hash" value="<?php echo $hash; ?>"/>
                                        <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                                        <div class="form-group">
                                            <label class="control-label">Total Payable Amount</label>
                                            <input class="form-control" name="amount" value="<?php echo $amount; ?>"  readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Your Name</label>
                                            <input class="form-control" name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input class="form-control" name="email" id="email" value="<?php echo $mailid; ?>" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mobile</label>
                                            <input class="form-control" name="phone" value="<?php echo $phoneno; ?>" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> Payment Info</label>
                                            <textarea class="form-control" name="productinfo" readonly><?php echo $productinfo; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input class="form-control" name="address1" value="<?php echo $address; ?>" readonly/>     
                                        </div>
                                        <div class="form-group">
                                            <input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
                                            <input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />  
                                            <!--for test environment comment  service provider   -->
                                            <input type="hidden" name="service_provider" value="" size="64" />
                                            <input name="curl" value="<?php echo $cancel; ?> " type="hidden" />
                                        </div>
                                        <div class="form-group float-right">
                                            <input type="submit" value="Pay Now" class="btn btn-success" />
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
    </body>
</html>
<!-- Contact Area -->
<script src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('application/modules/frontend/views/themes/payu/script.js') ?>"></script>
