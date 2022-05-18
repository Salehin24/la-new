
<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                <input type="hidden" name="currencyid" id="edt_currencyid" value="<?php echo $edit_currencydata->currencyid; ?>">
                <div class="form-group row">
                    <label for="currencyname" class="col-sm-4 col-form-label text-right"><?php echo display('currencyname'); ?> <i class="text-danger">*</i></label>
                    <div class="col-sm-6">
                        <input class="form-control" name="currencyname" id="edt_currencyname" type="text" value="<?php echo $edit_currencydata->currencyname; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="curr_icon" class="col-sm-4 col-form-label text-right"><?php echo display('currency_icon'); ?> <i class="text-danger">*</i></label>
                    <div class="col-sm-6">
                        <input class="form-control" name="curr_icon" id="edt_curr_icon" type="text" value="<?php echo $edit_currencydata->curr_icon; ?>">
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="button" onclick="update_currencyinfo()" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->
</div> 