<form action="" method="post">
    <div class="form-group row">
        <label for="template_title" class="col-sm-3"><?php echo display('title') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-6">
            <input name="title" type="text" class="form-control" id="edit_template_title"
                placeholder="<?php echo display('title') ?>"
                value="<?php echo (!empty($template_edit->title) ? $template_edit->title : ''); ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_type" class="col-sm-3"><?php echo display('type') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <select class="form-control placeholder-single" id="edit_template_type" name="template_type"
                data-placeholder="-- select one --">
                <option value=""></option>
                <option value="sms" <?php echo (($template_edit->template_type == 'sms') ? 'selected' : ''); ?>>
                    <?php echo display('sms'); ?></option>
                <option value="email" <?php echo (($template_edit->template_type == 'email') ? 'selected' : ''); ?>>
                    <?php echo display('email'); ?></option>
                <!-- <option value="certificate"
                    <?php //echo (($template_edit->template_type == 'certificate') ? 'selected' : ''); ?>>
                    <?php //echo display('certificate'); ?></option> -->
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_body" class="col-sm-3"><?php echo display('template_body') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-9">
            <textarea name="template_body" rows="10" class="form-control" id="edit_template_body"
                placeholder="<?php echo display('template_body') ?>"
                required><?php echo (!empty($template_edit->template_body) ? $template_edit->template_body : ''); ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="template_body" class="col-sm-3">&nbsp</label>
        <div class="col-sm-6">
            <div class="text-danger">
                For SMS : [name][mobile_no][message]
            </div>
            <div class="text-danger">
                For Mail : [name][email][username][title][message]
            </div>
            <!-- <div class="text-danger">
                For Certificate : [name][summary][certificate_name][date]
            </div> -->
        </div>
    </div>
    <input type='hidden' value='edit' id='mode'>
    <input type='hidden' value='<?php echo $template_edit->id; ?>' id='id'>
    <div class="form-group row">
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5"
                onclick="templateinfo_save()"><?php echo display('update') ?></button>
        </div>
    </div>
</form>