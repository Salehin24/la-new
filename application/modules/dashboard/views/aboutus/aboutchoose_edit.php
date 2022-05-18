<form action="" method="post">
    <div class="form-group row">
        <label for="edit_title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i
                class="text-danger">
                *</i></label>
        <div class="col-sm-6">
            <input name="edit_title" type="text" class="form-control" id="edit_title"
                placeholder="<?php echo display('title') ?>"
                value="<?php echo html_escape($aboutchoose_edit->choose_title); ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="edit_chooselogo" class="col-sm-3 col-form-label">Logo <i class="text-danger"> * </i></label>
        <div class="col-sm-6">
            <input type="file" name="edit_chooselogo" class="form-control" id="edit_chooselogo"
                onchange="fileValueOne(this,'edit_chooselogo')" required>
                <input type="hidden" id="old_logo" value="<?php echo $aboutchoose_edit->logo; ?>">
            <span class="text-danger mt-5">File size 320*183 </span>
        </div>
        <div class="col-sm-2">
            <img id="image-preview-edit_chooselogo" src="<?php echo base_url($aboutchoose_edit->logo); ?>" alt="" class="border border-2" width="180px">
        </div>
    </div>


    <div class="form-group row">
        <div class="offset-4 mb-3">
            <input type="hidden" id="choose_id" value="<?php echo $aboutchoose_edit->id; ?>">
            <button type="button" class="btn btn-info w-md m-b-5" onclick="aboutchoose_update('<?php echo $aboutchoose_edit->id; ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>