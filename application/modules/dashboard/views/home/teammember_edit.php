<form action="" method="post">
    <div class="form-group row">
        <label for="c_name" class="col-sm-3"><?php echo display('name') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <input name="c_name" type="text" class="form-control" id="cm_name" placeholder="<?php echo display('name') ?>" value="<?php echo html_escape($teammember_edit->name); ?>" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="c_designation" class="col-sm-3"><?php echo display('designation') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <input name="c_designation" type="text" class="form-control" id="cm_designation" placeholder="<?php echo display('designation') ?>" value="<?php echo html_escape($teammember_edit->designation); ?>" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="picture" class="col-sm-3"><?php echo display('picture') ?> <i class="text-danger"> </i></label>
        <div class="col-sm-6">
            <input name="c_picture" type="file" class="form-control" id="cm_picture" onchange="fileValueOne(this,'editteam')">
            <input type="hidden" name="old_logo" id="old_logo" value="<?php echo html_escape($teammember_edit->picture) ?>" >
            <span class="text-danger">( 118×118 )  Formats:(png,jpeg,jpeg)</span>
            <?php if ($teammember_edit->picture) { ?>
                <div class="img_border">
                    <img src="<?php echo base_url(html_escape($teammember_edit->picture)); ?>" alt="<?php echo html_escape($teammember_edit->name); ?>" width="100%">
                </div>
            <?php } ?>
        </div>
    </div> 
    <div class="form-group row">
        <label for="" class="col-sm-3"></label>
        <div class="col-sm-6">
            <img id="image-preview-editteam" src="" alt="" class="border border-2" width="200px">
        </div>
    </div>
    <div class="form-group row">                        
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5" onclick="teammemberinfo_update('<?php echo html_escape($teammember_edit->teammember_id) ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>