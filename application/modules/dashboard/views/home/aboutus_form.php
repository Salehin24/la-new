<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('about_us') ?> </h6><hr>
        </div>
    </div>
    <div class="panel-body">
        <?php echo form_open_multipart(enterpriseinfo()->shortname .'/aboutus-save', 'class="myform" id="myform"'); ?>
        <div class="form-group row">
            <label for="title" class="col-sm-2"><?php echo display('title') ?> <i class="text-danger"> * </i></label>
            <div class="col-sm-9">
                <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="title" required  value="<?php
                if (!empty($get_aboutinfo->title)) {
                    echo html_escape($get_aboutinfo->title);
                }
                ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2"><?php echo display('description') ?></label>
            <div class="col-sm-9">
                <textarea name="description" class="form-control" placeholder="<?php echo display('description') ?>" id="description" rows="10" cols="80"><?php
                    if (!empty($get_aboutinfo->description)) {
                        echo html_escape($get_aboutinfo->description);
                    }
                    ?>
                </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="image" class="col-sm-2"><?php echo display('image') ?>
                <span class="text-danger f-s-10">( 1110×690 ) Formats:(png,jpeg,jpeg)</span>
            </label>
            <div class="col-sm-9">
                <input type="file" name="image" id="image" class="" onchange="fileValueOne(this,'about')" />
                <?php if (!empty($get_aboutinfo->picture)) { ?>
                    <div class="img_border m-t-10">
                        <img src="<?php echo base_url(html_escape($get_aboutinfo->picture)); ?>" alt="<?php echo html_escape($get_aboutinfo->title); ?>" width="20%">
                    </div>
                <?php } ?>
            </div>
        </div> 
        <div class="form-group row">
            <label for="" class="col-sm-2"></label>
            <div class="col-sm-9">
            <img id="image-preview-about" src="" alt="" class="border border-2" width="200px">
            </div>
        </div>

        <div class="offset-3 mb-3 group-end">
            <button type="submit" class="btn btn-info w-md m-b-5" id="disabled_btn"><?php echo display('update') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>