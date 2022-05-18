<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h4><?php echo display('mail_configuration') ?> </h4>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart('#', 'class="form-vertical" id="myform"'); ?>
        <div class="form-group row">
            <label for="protocol" class="col-sm-3 col-form-label text-right"><?php echo display('protocol'); ?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <input class="form-control" name="protocol" id="protocol" type="text" value="<?php echo html_escape((!empty($mail_setting->protocol) ? $mail_setting->protocol : '')); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="smtp_host" class="col-sm-3 col-form-label  text-right"><?php echo display('smtp_host'); ?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <input class="form-control" name="smtp_host" id="smtp_host" type="text" value="<?php echo html_escape(!empty($mail_setting->smtp_host) ? $mail_setting->smtp_host : ''); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="smtp_port" class="col-sm-3 col-form-label  text-right"><?php echo display('smtp_port'); ?><i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <input class="form-control" name="smtp_port" id="smtp_port" type="number" value="<?php echo html_escape(!empty($mail_setting->smtp_port) ? $mail_setting->smtp_port : ''); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="smtp_user" class="col-sm-3 col-form-label text-right"><?php echo display('sender_mail'); ?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <input class="form-control" name="smtp_user" id="smtp_user" type="email" value="<?php echo html_escape(!empty($mail_setting->smtp_user) ? $mail_setting->smtp_user : ''); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="smtp_pass" class="col-sm-3 col-form-label  text-right"><?php echo display('password'); ?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <input class="form-control" name="smtp_pass" id="smtp_pass" type="password" value="<?php echo html_escape(!empty($mail_setting->smtp_pass) ? $mail_setting->smtp_pass : ''); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mailtype" class="col-sm-3 col-form-label  text-right"><?php echo display('mail_type'); ?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
                <select class="form-control" name="mailtype" id="mailtype" data-placeholder="<?php echo display('select_one'); ?>">
                    <option value=""><?php echo display('select_one'); ?></option>
                    <option value="html" <?php echo ($mail_setting->mailtype == 'html' ? 'selected' : ''); ?>><?php echo display('html'); ?></option>
                    <option value="text" <?php echo ($mail_setting->mailtype == 'text' ? 'selected' : ''); ?>><?php echo display('text'); ?></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="invoice" class="col-sm-3 col-form-label text-right"><?php echo display('invoice'); ?> <i class="text-danger"></i></label>
            <div class="switch col-sm-6">
                <input type="radio" name="isinvoice" class="isinvoice" id="isinvoice1" value="1"  <?php echo ((!empty($mail_setting->is_invoice) == '1') ? 'checked' : ''); ?>  
                <?php
                if (!empty($mail_setting->is_invoice) == '1') {
                    echo 'checked="checked"';
                } else {
                    echo ' ';
                }
                ?>/>
                <label for="isinvoice1" id="yes">
                    <strong><?php echo display('yes'); ?></strong></label>
                <input type="radio" name="isinvoice" class="isinvoice" id="isinvoice0" value="0" <?php echo ((!empty($mail_setting->is_invoice) == '0') ? 'checked' : ''); ?>/>
                <label for="isinvoice0" id="no"><strong><?php echo display('no'); ?></strong></label>
            </div>
        </div>
        <div class="form-group row">
            <label for="customer_receive" class="col-sm-3 col-form-label text-right"><?php echo display('customer_receive'); ?> <i class="text-danger"></i></label>
            <div class="switch col-sm-6">
                <input type="radio" name="isreceive" class="isreceive" id="isreceive1" value="1"  <?php if (!empty($mail_setting->is_invoice) == '1') echo 'checked="checked"'; ?>  <?php
                if (!empty($mail_setting->is_receive) == '1') {
                    echo 'checked="checked"';
                } else {
                    echo ' ';
                }
                ?>/>
                <label for="isreceive1" id="yes">
                    <strong><?php echo display('yes'); ?></strong></label>
                <input type="radio" name="isreceive" class="isreceive" id="isreceive0" value="0" <?php if (!empty($mail_setting->is_receive) == '0') echo 'checked="checked"'; ?>/>
                <label for="isreceive0" id="no">
                    <strong><?php echo display('no'); ?></strong>
                </label>
            </div>

        </div>

        <div class="form-group row">
            <div class="form-group offset-3 col-sm-2">
                <input type="button" onclick="mailconfig_save()" class="btn btn-info btn-large" value="<?php echo display('save'); ?>">
            </div>
        </div>
        <?php form_close(); ?>
    </div>
</div>