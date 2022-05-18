<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/square/assets/css/bootstrap-toggle.css') ?>">
<script src="<?php echo base_url('application/modules/square/assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script>
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo (!empty($title) ? $title : null) ?></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('square/square/config_save'); ?>" method="post">
                    <div class="form-group row">
                        <label for="payment_method_name" class="col-sm-3 col-form-label"><?php echo display('payment_method'); ?> <span class="text-danger"> * </span></label>
                        <div class="col-sm-6">
                            <input type="text" name="payment_method_name" class="form-control" id="payment_method_name" value="<?php echo @$get_configdata->payment_method_name; ?>" placeholder="<?php echo display('payment_method'); ?>" tabindex="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="marchant_id" class="col-sm-3 col-form-label"><?php echo display('marchant_id'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="marchant_id" class="form-control" id="marchant_id" value="<?php echo @$get_configdata->marchant_id; ?>" placeholder="<?php echo display('marchant_id'); ?>" tabindex="2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label"><?php echo display('password'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="password" class="form-control" id="password" value="<?php echo @$get_configdata->password; ?>" placeholder="<?php echo display('password'); ?>" tabindex="3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><?php echo display('email'); ?> </label>
                        <div class="col-sm-6">
                            <input type="text" name="email" class="form-control" id="email" value="<?php echo @$get_configdata->email; ?>" placeholder="<?php echo display('email'); ?>" tabindex="4" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="currency" class="col-sm-3 col-form-label"><?php echo display('currency'); ?> <span class="text-danger"> * </span></label>
                        <div class="col-sm-6">
                            <select name="currency" class="form-control placeholder-single" id="currency">
                                <option value=""><?php echo '-- select one --'; ?></option>
                                <option value="BDT" <?php if(@$get_configdata->currency == 'BDT'){ echo 'selected'; } ?>>(BDT) Bangladeshi Taka</option>
                                <option value="USD" <?php if(@$get_configdata->currency == 'USD'){ echo 'selected'; } ?>>(USD) U.S. Dollar</option>
                                <option value="EUR" <?php if(@$get_configdata->currency == 'EUR'){ echo 'selected'; } ?>>(EUR) Euro</option>
                                <option value="AUD" <?php if(@$get_configdata->currency == 'AUD'){ echo 'selected'; } ?>>(AUD) Australian Dollar</option>
                                <option value="CAD" <?php if(@$get_configdata->currency == 'CAD'){ echo 'selected'; } ?>>(CAD) Canadian Dollar</option>
                                <option value="CZK" <?php if(@$get_configdata->currency == 'CZK'){ echo 'selected'; } ?>>(CZK) Czech Koruna</option>
                                <option value="DKK" <?php if(@$get_configdata->currency == 'DKK'){ echo 'selected'; } ?>>(DKK) Danish Krone</option>
                                <option value="HKD" <?php if(@$get_configdata->currency == 'HKD'){ echo 'selected'; } ?>>(HKD) Hong Kong Dollar</option>
                                <option value="MXN" <?php if(@$get_configdata->currency == 'MXN'){ echo 'selected'; } ?>>(MXN) Mexican Peso</option>
                                <option value="NOK" <?php if(@$get_configdata->currency == 'NOK'){ echo 'selected'; } ?>>(NOK) Norwegian Krone</option>
                                <option value="NZD" <?php if(@$get_configdata->currency == 'NZD'){ echo 'selected'; } ?>>(NZD) New Zealand Dollar</option>
                                <option value="PHP" <?php if(@$get_configdata->currency == 'PHP'){ echo 'selected'; } ?>>(PHP) Philippine Peso</option>
                                <option value="PLN" <?php if(@$get_configdata->currency == 'PLN'){ echo 'selected'; } ?>>(PLN) Polish Zloty</option>
                                <option value="BRL" <?php if(@$get_configdata->currency == 'BRL'){ echo 'selected'; } ?>>(BRL) Brazilian Real</option>
                                <option value="HUF" <?php if(@$get_configdata->currency == 'HUF'){ echo 'selected'; } ?>>(HUF) Hungarian Forint</option>
                                <option value="ILS" <?php if(@$get_configdata->currency == 'ILS'){ echo 'selected'; } ?>>(ILS) Israeli New Sheqel</option>
                                <option value="JPY" <?php if(@$get_configdata->currency == 'JPY'){ echo 'selected'; } ?>>(JPY) Japanese Yen</option>
                                <option value="MYR" <?php if(@$get_configdata->currency == 'MYR'){ echo 'selected'; } ?>>(MYR) Malaysian Ringgit</option>
                                <option value="GBP" <?php if(@$get_configdata->currency == 'GBP'){ echo 'selected'; } ?>>(GBP) Pound Sterling</option>
                                <option value="SGD" <?php if(@$get_configdata->currency == 'SGD'){ echo 'selected'; } ?>>(SGD) Singapore Dollar</option>
                                <option value="SEK" <?php if(@$get_configdata->currency == 'SEK'){ echo 'selected'; } ?>>(SEK) Swedish Krona</option>
                                <option value="CHF" <?php if(@$get_configdata->currency == 'CHF'){ echo 'selected'; } ?>>(CHF) Swiss Franc</option>
                                <option value="TWD" <?php if(@$get_configdata->currency == 'TWD'){ echo 'selected'; } ?>>(TWD) Taiwan New Dollar</option>
                                <option value="THB" <?php if(@$get_configdata->currency == 'THB'){ echo 'selected'; } ?>>(THB) Thai Baht</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_live" class="col-sm-3 col-form-label"><?php echo display('is_live'); ?> <i class="text-danger"></i></label>
                        <div class="switch col-sm-6">
                            <input type="radio" name="is_live" class="live"  id="live" value="1"  <?php if (@$get_configdata->is_live == '1') echo 'checked="checked"'; ?>  <?php
                            if (empty(@$get_configdata->is_live == '1')) {
                                echo 'checked="checked"';
                            } else {
                                echo ' ';
                            }
                            ?>/>
                            <label for="live" id="yes"><strong><?php echo display('live'); ?></strong></label>
                            <input type="radio" name="is_live" class="test" id="test" value="0" <?php if (@$get_configdata->is_live == '0') echo 'checked="checked"'; ?>/>
                            <label for="test" id="no">
                                <strong><?php echo display('test'); ?>Test</strong></label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label"><?php echo display('status'); ?> <i class="text-danger"></i></label>
                        <div class="switch col-sm-6">
                            <input type="radio" name="status" class="active" id="active" value="1"  <?php if (@$get_configdata->status == '1') echo 'checked="checked"'; ?>  <?php
                            if (empty(@$get_configdata->status == '1')) {
                                echo 'checked="checked"';
                            } else {
                                echo ' ';
                            }
                            ?>/>
                            <label for="active" id="yes"><strong><?php echo display('active'); ?></strong></label>
                            <input type="radio" name="status" class="inactive" id="inactive" value="0" <?php if (@$get_configdata->status == '0') echo 'checked="checked"'; ?>/>
                            <label for="inactive" id="no"><strong><?php echo display('inactive'); ?></strong></label>
                        </div>
                    </div>

                    <div class="form-group offset-3 col-sm-2">
                        <input type="hidden" name="id" id="id" value="<?php echo @$get_configdata->id; ?>">
                        <button type="submit" class="btn btn-info w-md m-b-5" onclick=""  tabindex="6"><?php echo display('update'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>