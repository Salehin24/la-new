<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
    <div class="form-group row">
        <label for="title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-9">
            <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="etitle" value="<?php echo html_escape($edit_data->title); ?>" required>
        </div>
    </div>

    <div class="form-group text-right">
        <input type="hidden" id="forum_category_id" value="<?php echo html_escape($edit_data->forum_category_id); ?>">
        <button type="button" onclick="forumcategory_update()" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
    </div>
    <?php echo form_close(); ?>