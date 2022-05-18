<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('paypal_configuration') ?> </h6>
            <hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="#" class="form-vertical" id="insert_customer" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            <!-- <div class="form-group row">
                <label for="payment_gateway"
                    class="col-sm-3 col-form-label text-right"><?php //echo display('payment_gateway') ?> <i
                        class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <select class="form-control" class="form-control payment_gateway" id="payment_gateway"
                        name="payment_gateway" required>
                        <option value=""><?php //echo display('select_one'); ?></option>
                        <option value="paypal"
                            <?php //echo (@$paypal_setting->payment_gateway == 'paypal') ? 'selected' : ''; ?>>
                            <?php //echo display('paypal'); ?></option>
                        <option value="sandbox"
                            <?php //echo (@$paypal_setting->payment_gateway == 'sandbox') ? 'selected' : ''; ?>>
                            <?php //echo display('sandbox'); ?></option>
                    </select>
                </div>
            </div> -->
            <div class="form-group row">
                <label for="ClientID" class="col-sm-3 col-form-label text-right"><?php echo "ClientID" ?> <i
                        class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control email" id="ClientID" name="ClientID"
                        value="<?php echo html_escape(!empty($paypal_setting->ClientID) ? $paypal_setting->ClientID : ''); ?>"
                        placeholder="<?php echo 'ClientID';?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="ClientSecret" class="col-sm-3 col-form-label text-right"><?php echo "ClientSecret" ?> <i
                        class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control email" id="ClientSecret" name="ClientSecret"
                        value="<?php echo html_escape(!empty($paypal_setting->ClientSecret) ? $paypal_setting->ClientSecret : ''); ?>"
                        placeholder="<?php echo 'ClientSecret';?>" required>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label text-right"><?php //echo display('email') ?> <i
                        class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="email" class="form-control email" id="paypalemail" name="email"
                        value="<?php //echo html_escape(!empty($paypal_setting->payment_mail) ? $paypal_setting->payment_mail : ''); ?>"
                        placeholder="<?php //echo display('email');?>" required>
                </div>
            </div> -->
            <div class="form-group row">
                <label for="currency" class="col-sm-3 col-form-label text-right"><?php echo display('currency') ?> <i
                        class="text-danger"> </i></label>
                <div class="col-sm-6">
                    <select class="form-control select2" name="currency" id="currency" data-placeholder="">
                        <option value=""><?php echo display('select_one'); ?></option>
                        <option value="USD" <?php echo (@$paypal_setting->currency == 'USD' ? 'selected' : ''); ?>>(USD)
                            U.S. Dollar</option>
                        <option value="EUR" <?php echo (@$paypal_setting->currency == 'EUR' ? 'selected' : ''); ?>>(EUR)
                            Euro</option>
                        <option value="AUD" <?php echo (@$paypal_setting->currency == 'AUD' ? 'selected' : ''); ?>>(AUD)
                            Australian Dollar</option>
                        <option value="CAD" <?php echo (@$paypal_setting->currency == 'CAD' ? 'selected' : ''); ?>>(CAD)
                            Canadian Dollar</option>
                        <option value="CZK" <?php echo (@$paypal_setting->currency == 'CZK' ? 'selected' : ''); ?>>(CZK)
                            Czech Koruna</option>
                        <option value="DKK" <?php echo (@$paypal_setting->currency == 'DKK' ? 'selected' : ''); ?>>(DKK)
                            Danish Krone</option>
                        <option value="HKD" <?php echo (@$paypal_setting->currency == 'HKD' ? 'selected' : ''); ?>>(HKD)
                            Hong Kong Dollar</option>
                        <option value="Yen" <?php echo (@$paypal_setting->currency == 'Yen' ? 'selected' : ''); ?>>(YEN)
                            Japanese</option>
                        <option value="MXN" <?php echo (@$paypal_setting->currency == 'MXN' ? 'selected' : ''); ?>>(MXN)
                            Mexican Peso</option>
                        <option value="NOK" <?php echo (@$paypal_setting->currency == 'NOK' ? 'selected' : ''); ?>>(NOK)
                            Norwegian Krone</option>
                        <option value="NZD" <?php echo (@$paypal_setting->currency == 'NZD' ? 'selected' : ''); ?>>(NZD)
                            New Zealand Dollar</option>
                        <option value="PHP" <?php echo (@$paypal_setting->currency == 'PHP' ? 'selected' : ''); ?>>(PHP)
                            Philippine Peso</option>
                        <option value="PLN" <?php echo (@$paypal_setting->currency == 'PLN' ? 'selected' : ''); ?>>(PLN)
                            Polish Zloty</option>
                        <option value="SGD" <?php echo (@$paypal_setting->currency == 'SGD' ? 'selected' : ''); ?>>(SGD)
                            Singapore Dollar</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="mode" class="col-sm-3 col-form-label text-right"><?php echo display('mode') ?> <i
                        class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <select name="mode" id="paypalmode" class="form-control">
                        <option value=""><?php echo display('select_one'); ?></option>
                        <option value="sandbox" <?php echo (@$paypal_setting->status == 'sandbox' ? 'selected' : ''); ?>>
                            <?php echo display('development'); ?></option>
                        <option value="live" <?php echo (@$paypal_setting->status == 'live' ? 'selected' : ''); ?>>
                            <?php echo display('production'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-6 text-right">
                    <label>For Paypal Information</label>
                    <a href="https://developer.paypal.com/docs/api-basics/sandbox/accounts/"
                        class="btn btn-success w-45" target="_new">Go</a>
                    <input type="button" onclick="paypalconfigsave()" class="btn btn-info btn-large"
                        value="<?php echo display('save'); ?>">
                </div>
            </div>
        </form>
    </div>
</div>