<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h4><?php echo display('sms_configuration') ?> </h4>
        </div>
    </div>
    <div class="panel-body">
        <form action="#" method="post">
            <div class="form-group row">
                <label for="provider_name" class="col-sm-3 col-form-label"><?php echo display('provider_name'); ?> </label>
                <div class="col-sm-9">
                    <input type="text" name="provider_name" class="form-control" id="provider_name" value="<?php echo html_escape((!empty($sms_gateway->provider_name) ? $sms_gateway->provider_name : '')); ?>" placeholder="<?php echo display('provider_name'); ?>" tabindex="1" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="user_name" class="col-sm-3 col-form-label"><?php echo display('username'); ?> (<?php echo display('api_key') ?>) <i class="text-danger"> * </i> </label>
                <div class="col-sm-9">
                    <input type="text" name="user_name" class="form-control" id="user_name" value="<?php echo html_escape(!empty($sms_gateway->user) ? $sms_gateway->user : ''); ?>" placeholder="<?php echo display('username'); ?>" tabindex="2" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="sms_password" class="col-sm-3 col-form-label"><?php echo display('password'); ?> (<?php echo display('api_secret') ?>) <i class="text-danger"> * </i> </label>
                <div class="col-sm-9">
                    <input type="text" name="password" class="form-control" id="sms_password" value="<?php echo html_escape(!empty($sms_gateway->password) ? $sms_gateway->password : ''); ?>" placeholder="<?php echo display('password'); ?>" tabindex="3" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-3 col-form-label"><?php echo display('phone'); ?>  <span class="text-danger"> </span></label>
                <div class="col-sm-9">
                    <input type="number" name="phone" class="form-control" id="phone" value="<?php echo html_escape(!empty($sms_gateway->phone) ? $sms_gateway->phone : ''); ?>" placeholder="<?php echo display('phone'); ?>" tabindex="4" >
                </div>
            </div>
            <div class="form-group row">
                <label for="sender_name" class="col-sm-3 col-form-label"><?php echo display('sender_name'); ?> <span class="text-danger"> </span></label>
                <div class="col-sm-9">
                    <input type="text" name="sender_name" class="form-control" id="sender_name" value="<?php echo html_escape(!empty($sms_gateway->authentication) ? $sms_gateway->authentication : ''); ?>" placeholder="<?php echo display('sender_name'); ?>" tabindex="5">
                </div>
            </div>
            <div class="form-group row">
                <label for="invoice" class="col-sm-3 col-form-label"><?php echo display('invoice'); ?> <i class="text-danger"></i></label>
                <div class="switch col-sm-6">
                    <input type="radio" name="isinvoice" class="isinvoice3"  id="isinvoice2" value="1"  <?php echo ((!empty($sms_gateway->is_invoice) == '1') ? 'checked' : ''); ?>  <?php
                    // if (!empty($sms_gateway->is_invoice) == '1') {
                    //     echo 'checked="checked"';
                    // } else {
                    //     echo ' ';
                    // }
                    ?>/>
                    <label for="isinvoice2" id="yes">
                        <strong><?php echo display('yes'); ?></strong></label>
                    <input type="radio" name="isinvoice" class="isinvoice3" id="isinvoice3" value="0" <?php echo ((!empty($sms_gateway->is_invoice) == '0') ? 'checked' : ''); ?>/>
                    <label for="isinvoice3" id="no"><strong><?php echo display('no'); ?></strong></label>
                </div>
            </div>

            <div class="form-group row">
                <label for="customer_receive" class="col-sm-3 col-form-label"><?php echo display('customer_receive'); ?> <i class="text-danger"></i></label>
                <div class="switch col-sm-6">
                    <input type="radio" name="isreceive" class="isreceive3" id="isreceive3" value="1" <?php echo ((!empty($sms_gateway->is_receive) == '1') ? 'checked' : ''); ?>  <?php
                //    if (!empty($sms_gateway->is_receive) == '1') {
                //     echo 'checked="checked"';
                // } else {
                //     echo ' ';
                // }
                    ?>/>
                    <label for="isreceive3" id="yes"><strong><?php echo display('yes'); ?></strong></label>
                    <input type="radio" name="isreceive" class="isreceive3" id="isreceive4" value="0" <?php echo ((!empty($sms_gateway->is_receive) == '0') ? 'checked' : ''); ?>/>
                    <label for="isreceive4" id="no"><strong><?php echo display('no'); ?></strong></label>
                </div>
            </div>

            <div class="form-group offset-3 col-sm-2">
                <button type="button" class="btn btn-info w-md m-b-5" onclick="smsconfig_save()"  tabindex="6"><?php echo display('update'); ?></button>
            </div>
        </form>
    </div>
</div>