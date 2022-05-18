<form action="" method="post">
    <?php 
    $filename = '';
    // d($paywith_edit);
    if($paywith_edit->logo){
        $file_name = $paywith_edit->logo;                                  
        $filename = explode('-f-', $file_name);
        $filename = $filename[1];
        // d($file_name);
        // d($filename);
    }
    ?>
    <div class="form-group row">
        <label for="edit_paywithlogo" class="col-sm-3 col-form-label"><?php echo display('logo') ?>        </label>
        <div class="col-sm-6">
            <!-- <input name="edit_paywithlogo" type="file" class="form-control" id="edit_paywithlogo" onchange="fileValueOne(this,'editpaywith')">  -->
            <input type="file" name="edit_paywithlogo" id="edit_paywithlogo" class="custom-input-file" onchange="fileValueOne(this,'editpaywith')" />
                <label for="edit_paywithlogo">
                    <i class="fa fa-upload"></i>
                    <span class="editpaywith-filename"><?php echo (!empty($paywith_edit->logo) ? $filename :  display('choose_file'). '...'); ?></span>
                </label>
            <!-- <span class="text-danger m-t-10 f-s-10">( Only .png and svg format with transparent background (304*64) )</span> -->
            <input type="hidden" name="old_paywithlogo" id="old_paywithlogo" value="<?php echo html_escape($paywith_edit->logo) ?>">
            <?php if ($paywith_edit->logo) { ?>
                <div class="img_border">
                    <img src="<?php echo base_url(html_escape($paywith_edit->logo)); ?>" alt="<?php echo html_escape($paywith_edit->logo); ?>" width="100%">
                </div>
            <?php } ?>
        </div>
    </div> 
    <div class="form-group row">
        <label for="" class="col-sm-3"></label>
        <div class="col-sm-6">
        <img id="image-preview-editpaywith" src="" alt="" class="border border-2" width="200px">
        </div>
    </div>
    
    <div class="form-group row">  
        <div class="offset-4 mb-3">
            <button type="button" class="btn btn-info w-md m-b-5" onclick="paywith_infoupdate('<?php echo html_escape($paywith_edit->id); ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>