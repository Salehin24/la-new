<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('payu_configuration') ?> </h6>
            <hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="#" class="form-vertical" id="insert_customer" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="payment_method_name" class="col-sm-3 col-form-label"><?php echo display('payment_method'); ?> <span class="text-danger"> * </span></label>
                <div class="col-sm-6">
                    <input type="text" name="payment_method_name" class="form-control" id="payu_method_name" value="<?php echo (!empty($get_configdata->payment_method_name) ? $get_configdata->payment_method_name : ''); ?>" placeholder="<?php echo display('payment_method'); ?>" tabindex="1" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="marchant_id" class="col-sm-3 col-form-label"><?php echo display('marchant_id'); ?></label>
                <div class="col-sm-6">
                    <input type="text" name="marchant_id" class="form-control" id="payu_marchant_id" value="<?php echo (!empty($get_configdata->marchant_id) ? $get_configdata->marchant_id : ''); ?>" placeholder="<?php echo display('marchant_id'); ?>" tabindex="2">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label"><?php echo display('password'); ?></label>
                <div class="col-sm-6">
                    <input type="text" name="password" class="form-control" id="payu_password" value="<?php echo (!empty($get_configdata->password) ? $get_configdata->password : ''); ?>" placeholder="<?php echo display('password'); ?>" tabindex="3">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label"><?php echo display('email'); ?> </label>
                <div class="col-sm-6">
                    <input type="text" name="email" class="form-control" id="payu_email" value="<?php echo (!empty($get_configdata->email) ? $get_configdata->email : ''); ?>" placeholder="<?php echo display('email'); ?>" tabindex="4" >
                </div>
            </div>
            <div class="form-group row">
                <label for="currency" class="col-sm-3 col-form-label"><?php echo display('currency'); ?> <span class="text-danger"> * </span></label>
                <div class="col-sm-6">
                    <select name="currency" class="form-control placeholder-single" id="payu_currency">
                        <option value=""><?php echo '-- select one --'; ?></option>
                        <option value="BDT" <?php echo (@$get_configdata->currency == 'BDT' ? 'selected' : ''); ?>>(BDT)
                            Bangladeshi Taka</option>
                        <option value="USD" <?php echo (@$get_configdata->currency == 'USD' ? 'selected' : ''); ?>>(USD)
                            U.S. Dollar</option>
                        <option value="EUR" <?php echo (@$get_configdata->currency == 'EUR' ? 'selected' : ''); ?>>(EUR)
                            Euro</option>
                        <option value="AUD" <?php echo (@$get_configdata->currency == 'AUD' ? 'selected' : ''); ?>>(AUD)
                            Australian Dollar</option>
                        <option value="CAD" <?php echo (@$get_configdata->currency == 'CAD' ? 'selected' : ''); ?>>(CAD)
                            Canadian Dollar</option>
                        <option value="CZK" <?php echo (@$get_configdata->currency == 'CZK' ? 'selected' : ''); ?>>(CZK)
                            Czech Koruna</option>
                        <option value="DKK" <?php echo (@$get_configdata->currency == 'DKK' ? 'selected' : ''); ?>>(DKK)
                            Danish Krone</option>
                        <option value="HKD" <?php echo (@$get_configdata->currency == 'HKD' ? 'selected' : ''); ?>>(HKD)
                            Hong Kong Dollar</option>
                        <option value="MXN" <?php echo (@$get_configdata->currency == 'MXN' ? 'selected' : ''); ?>>(MXN)
                            Mexican Peso</option>
                        <option value="NOK" <?php echo (@$get_configdata->currency == 'NOK' ? 'selected' : ''); ?>>(NOK)
                            Norwegian Krone</option>
                        <option value="NZD" <?php echo (@$get_configdata->currency == 'NZD' ? 'selected' : ''); ?>>(NZD)
                            New Zealand Dollar</option>
                        <option value="PHP" <?php echo (@$get_configdata->currency == 'PHP' ? 'selected' : ''); ?>>(PHP)
                            Philippine Peso</option>
                        <option value="PLN" <?php echo (@$get_configdata->currency == 'PLN' ? 'selected' : ''); ?>>(PLN)
                            Polish Zloty</option>
                        <option value="BRL" <?php echo (@$get_configdata->currency == 'BRL' ? 'selected' : ''); ?>>(BRL)
                            Brazilian Real</option>
                        <option value="HUF" <?php echo (@$get_configdata->currency == 'HUF' ? 'selected' : ''); ?>>(HUF)
                            Hungarian Forint</option>
                        <option value="ILS" <?php echo (@$get_configdata->currency == 'ILS' ? 'selected' : ''); ?>>(ILS)
                            Israeli New Sheqel</option>
                        <option value="JPY" <?php echo (@$get_configdata->currency == 'JPY' ? 'selected' : ''); ?>>(JPY)
                            Japanese Yen</option>
                        <option value="MYR" <?php echo (@$get_configdata->currency == 'MYR' ? 'selected' : ''); ?>>(MYR)
                            Malaysian Ringgit</option>
                        <option value="GBP" <?php echo (@$get_configdata->currency == 'GBP' ? 'selected' : ''); ?>>(GBP)
                            Pound Sterling</option>
                        <option value="SGD" <?php echo (@$get_configdata->currency == 'SGD' ? 'selected' : ''); ?>>(SGD)
                            Singapore Dollar</option>
                        <option value="SEK" <?php echo (@$get_configdata->currency == 'SEK' ? 'selected' : ''); ?>>(SEK)
                            Swedish Krona</option>
                        <option value="CHF" <?php echo (@$get_configdata->currency == 'CHF' ? 'selected' : ''); ?>>(CHF)
                            Swiss Franc</option>
                        <option value="TWD" <?php echo (@$get_configdata->currency == 'TWD' ? 'selected' : ''); ?>>(TWD)
                            Taiwan New Dollar</option>
                        <option value="THB" <?php echo (@$get_configdata->currency == 'THB' ? 'selected' : ''); ?>>(THB)
                            Thai Baht</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="is_live" class="col-sm-3 col-form-label"><?php echo display('is_live'); ?> <i class="text-danger"></i></label>
                <div class="col-sm-6">
                    <select class="form-control" name="is_live" id="payu_is_live">
                        <option value="">-- select one -- </option>
                        <option value="1" <?php echo (@$get_configdata->is_live == '1' ? 'selected' : ''); ?>>
                            <?php echo display('live'); ?></option>
                        <option value="0" <?php echo (@$get_configdata->is_live == '0' ? 'selected' : ''); ?>>
                            <?php echo display('test'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label"><?php echo display('status'); ?> <i class="text-danger"></i></label>
                <div class="col-sm-6">
                    <select class="form-control" name="status" id="payu_status">
                        <option value="">-- select one -- </option>
                        <option value="1" <?php echo (@$get_configdata->status == 1 ? 'selected' : ''); ?>>
                            <?php echo display('active'); ?></option>
                        <option value="0" <?php echo (@$get_configdata->status == 0 ? 'selected' : ''); ?>>
                            <?php echo display('inactive'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                <input type="hidden" name="payu_id" id="payu_id" value="<?php echo (!empty($get_configdata->id) ? $get_configdata->id : ''); ?>">
                <div class="col-sm-6 text-right">
                    <label>For PayU Information</label>
                    <a href="https://payu.in/developer-guide" class="btn btn-success w-45"  target="_new">Go</a>
                    <input type="button" onclick="payuconfigsave()" class="btn btn-info btn-large" value="<?php echo display('save'); ?>">
                </div>
            </div>
        </form>
    </div>
</div>