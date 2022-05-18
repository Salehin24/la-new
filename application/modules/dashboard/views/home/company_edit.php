<form action="" method="post">
    <div class="form-group row">
        <label for="c_name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <input name="c_name" type="text" class="form-control" id="c_name" placeholder="<?php echo display('name') ?>" value="<?php echo html_escape($company_edit->name); ?>" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="c_link" class="col-sm-3 col-form-label"><?php echo display('link') ?> <i class="text-danger"> </i></label>
        <div class="col-sm-6">
            <input name="c_link" type="text" class="form-control" id="c_link" placeholder="<?php echo display('link') ?>" value="<?php echo html_escape($company_edit->link); ?>">
                                <span class="text-danger f-s-10">( Need your full URL)</span>
        </div>
    </div> 
    <div class="form-group row">
        <label for="edit_ordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
        <div class="col-sm-6">
            <select class="form-control ordering placeholder-single" id="edit_ordering" data-placeholder="-- select one --"
                name="edit_ordering">
                <option value="">-- select one --</option>
                <?php for ($i = 1; $i < 51; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php echo (($company_edit->ordering == $i) ? 'selected' : ''); ?>>
                    <?php echo $i; ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?></label>
        <div class="col-sm-6">
            <!-- <input name="c_logo" type="file" class="form-control" id="c_logo" onchange="fileValueOne(this,'editcompnay')">  -->
            <input type="file" name="c_logo" id="c_logo" class="custom-input-file" onchange="fileValueOne(this,'editcompnay')" />
                <label for="c_logo">
                    <i class="fa fa-upload"></i>
                    <span class="edit-logo-filename"><?php echo (!empty($company_edit->picture) ? $company_edit->filename :  display('choose_file'). '...'); ?></span>
                </label>
            <span class="text-danger m-t-10 f-s-10">( Only .png and svg format with transparent background (304*64) )</span>
            <input type="hidden" name="old_logo" id="old_logo" value="<?php echo html_escape($company_edit->picture) ?>">
            <input type="hidden" name="old_logofilename" id="old_logofilename" value="<?php echo html_escape($company_edit->filename) ?>">
            <?php if ($company_edit->picture) { ?>
                <div class="img_border">
                    <img src="<?php echo base_url(html_escape($company_edit->picture)); ?>" alt="<?php echo html_escape($company_edit->name); ?>" width="100%">
                </div>
            <?php } ?>
        </div>
    </div> 
    <div class="form-group row">
        <label for="" class="col-sm-3"></label>
        <div class="col-sm-6">
        <img id="image-preview-editcompnay" src="" alt="" class="border border-2" width="200px">
        </div>
    </div>
    
    <div class="form-group row">  
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5" onclick="company_infoupdate('<?php echo html_escape($company_edit->company_id); ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>


<script>
$(document).ready(function() {
    $("body").on("change", "#c_logo", function(e) {
        var filename = e.target.files[0].name;
        $(".edit-logo-filename").text(filename);
    });
});
</script>