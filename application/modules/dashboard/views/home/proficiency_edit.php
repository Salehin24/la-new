
<form action="" method="post">
    <div class="form-group row">
        <label for="edit_proficiencytitle" class="col-sm-3"><?php echo display('title') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-6">
            <input name="edit_proficiencytitle" type="text" class="form-control" id="edit_proficiencytitle" placeholder="<?php echo display('title') ?>" value="<?php echo html_escape($proficiency_edit->title); ?>" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="edit_proficiencypicture" class="col-sm-3"><?php echo display('picture') ?> <i class="text-danger"> </i></label>
        <div class="col-sm-6">
            <input name="edit_proficiencypicture" type="file" class="form-control" id="edit_proficiencypicture" onchange="fileValueOne(this,'editteam')">
            <input type="hidden" name="old_proficiencylogo" id="old_proficiencylogo" value="<?php echo html_escape($proficiency_edit->picture) ?>" >
            <span class="text-danger">( 118×118 ) Formats:(png,jpeg,jpeg) </span>
            <?php if ($proficiency_edit->picture) { ?>
                <div class="img_border">
                    <img src="<?php echo base_url(html_escape($proficiency_edit->picture)); ?>" alt="<?php echo html_escape($proficiency_edit->title); ?>" width="100%">
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
            <button type="button" class="btn btn-info w-md m-b-5" onclick="proficiencyinfo_update('<?php echo html_escape($proficiency_edit->proficiency_id) ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>