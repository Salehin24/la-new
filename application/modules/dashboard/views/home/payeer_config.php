<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('payeer_configuration') ?> </h6>
            <hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="#" class="form-vertical" id="insert_customer" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="payment_method_name" class="col-sm-3 col-form-label"><?php echo display('payment_method_name'); ?> <span class="text-danger"> * </span></label>
                <div class="col-sm-6">
                    <input type="text" name="payment_method_name" class="form-control" id="payeer_method_name" value="<?php echo @$get_configdata->payment_method_name; ?>" placeholder="<?php echo display('payment_method_name'); ?>" tabindex="1" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="marchant_id" class="col-sm-3 col-form-label"><?php echo display('marchant_id'); ?></label>
                <div class="col-sm-6">
                    <input type="text" name="marchant_id" class="form-control" id="payeer_marchant_id" value="<?php echo @$get_configdata->marchant_id; ?>" placeholder="<?php echo display('marchant_id'); ?>" tabindex="2">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label"><?php echo display('password'); ?></label>
                <div class="col-sm-6">
                    <input type="text" name="password" class="form-control" id="payeer_password" value="<?php echo @$get_configdata->password; ?>" placeholder="<?php echo display('password'); ?>" tabindex="3">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label"><?php echo display('email'); ?> </label>
                <div class="col-sm-6">
                    <input type="text" name="email" class="form-control" id="payeer_email" value="<?php echo @$get_configdata->email; ?>" placeholder="<?php echo display('email'); ?>" tabindex="4" >
                </div>
            </div>
            <div class="form-group row">
                <label for="currency" class="col-sm-3 col-form-label"><?php echo display('currency'); ?> <span class="text-danger"> * </span></label>
                <div class="col-sm-6">
                    <select name="currency" class="form-control placeholder-single" id="payeer_currency">
                        <option value=""><?php echo '-- select one --'; ?></option>
                        <option value="BDT" <?php
                        if (@$get_configdata->currency == 'BDT') {
                            echo 'selected';
                        }
                        ?>>(BDT) Bangladeshi Taka</option>
                        <option value="USD" <?php
                        if (@$get_configdata->currency == 'USD') {
                            echo 'selected';
                        }
                        ?>>(USD) U.S. Dollar</option>
                        <option value="EUR" <?php
                        if (@$get_configdata->currency == 'EUR') {
                            echo 'selected';
                        }
                        ?>>(EUR) Euro</option>
                        <option value="AUD" <?php
                        if (@$get_configdata->currency == 'AUD') {
                            echo 'selected';
                        }
                        ?>>(AUD) Australian Dollar</option>
                        <option value="CAD" <?php
                        if (@$get_configdata->currency == 'CAD') {
                            echo 'selected';
                        }
                        ?>>(CAD) Canadian Dollar</option>
                        <option value="CZK" <?php
                        if (@$get_configdata->currency == 'CZK') {
                            echo 'selected';
                        }
                        ?>>(CZK) Czech Koruna</option>
                        <option value="DKK" <?php
                        if (@$get_configdata->currency == 'DKK') {
                            echo 'selected';
                        }
                        ?>>(DKK) Danish Krone</option>
                        <option value="HKD" <?php
                        if (@$get_configdata->currency == 'HKD') {
                            echo 'selected';
                        }
                        ?>>(HKD) Hong Kong Dollar</option>
                        <option value="MXN" <?php
                        if (@$get_configdata->currency == 'MXN') {
                            echo 'selected';
                        }
                        ?>>(MXN) Mexican Peso</option>
                        <option value="NOK" <?php
                        if (@$get_configdata->currency == 'NOK') {
                            echo 'selected';
                        }
                        ?>>(NOK) Norwegian Krone</option>
                        <option value="NZD" <?php
                        if (@$get_configdata->currency == 'NZD') {
                            echo 'selected';
                        }
                        ?>>(NZD) New Zealand Dollar</option>
                        <option value="PHP" <?php
                        if (@$get_configdata->currency == 'PHP') {
                            echo 'selected';
                        }
                        ?>>(PHP) Philippine Peso</option>
                        <option value="PLN" <?php
                        if (@$get_configdata->currency == 'PLN') {
                            echo 'selected';
                        }
                        ?>>(PLN) Polish Zloty</option>
                        <option value="BRL" <?php
                        if (@$get_configdata->currency == 'BRL') {
                            echo 'selected';
                        }
                        ?>>(BRL) Brazilian Real</option>
                        <option value="HUF" <?php
                        if (@$get_configdata->currency == 'HUF') {
                            echo 'selected';
                        }
                        ?>>(HUF) Hungarian Forint</option>
                        <option value="ILS" <?php
                        if (@$get_configdata->currency == 'ILS') {
                            echo 'selected';
                        }
                        ?>>(ILS) Israeli New Sheqel</option>
                        <option value="JPY" <?php
                        if (@$get_configdata->currency == 'JPY') {
                            echo 'selected';
                        }
                        ?>>(JPY) Japanese Yen</option>
                        <option value="MYR" <?php
                        if (@$get_configdata->currency == 'MYR') {
                            echo 'selected';
                        }
                        ?>>(MYR) Malaysian Ringgit</option>
                        <option value="GBP" <?php
                        if (@$get_configdata->currency == 'GBP') {
                            echo 'selected';
                        }
                        ?>>(GBP) Pound Sterling</option>
                        <option value="SGD" <?php
                        if (@$get_configdata->currency == 'SGD') {
                            echo 'selected';
                        }
                        ?>>(SGD) Singapore Dollar</option>
                        <option value="SEK" <?php
                        if (@$get_configdata->currency == 'SEK') {
                            echo 'selected';
                        }
                        ?>>(SEK) Swedish Krona</option>
                        <option value="CHF" <?php
                        if (@$get_configdata->currency == 'CHF') {
                            echo 'selected';
                        }
                        ?>>(CHF) Swiss Franc</option>
                        <option value="TWD" <?php
                        if (@$get_configdata->currency == 'TWD') {
                            echo 'selected';
                        }
                        ?>>(TWD) Taiwan New Dollar</option>
                        <option value="THB" <?php
                        if (@$get_configdata->currency == 'THB') {
                            echo 'selected';
                        }
                        ?>>(THB) Thai Baht</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="is_live" class="col-sm-3 col-form-label"><?php echo display('is_live'); ?> <i class="text-danger"></i></label>
                <div class="col-sm-6">
                    <select class="form-control" name="is_live" id="payeer_is_live">
                        <option value="">-- select one -- </option>
                        <option value="1" <?php if (@$get_configdata->is_live == '1') echo 'selected'; ?> ><?php echo display('live'); ?></option>
                        <option value="0" <?php if (@$get_configdata->is_live == '0') echo 'selected'; ?> ><?php echo display('test'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label"><?php echo display('status'); ?> <i class="text-danger"></i></label>
                <div class="col-sm-6">
                    <select class="form-control" name="status" id="payeer_status">
                        <option value="">-- select one -- </option>
                        <option value="1" <?php if (@$get_configdata->status == '1') echo 'selected'; ?> ><?php echo display('active'); ?></option>
                        <option value="0" <?php if (@$get_configdata->status == '0') echo 'selected'; ?> ><?php echo display('inactive'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                <input type="hidden" name="payeer_id" id="payeer_id" value="<?php echo (!empty($get_configdata->id) ? $get_configdata->id : ''); ?>">
                <div class="col-sm-6 text-right">
                    <label>For Payeer Information</label>
                    <a href="https://payeer.com/en/account//" class="btn btn-success w-45"  target="_new">Go</a>
                    <input type="button" onclick="payeerconfigsave()" class="btn btn-info btn-large" value="<?php echo display('save'); ?>">
                </div>
            </div>
        </form>
    </div>
</div>