<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/imageresize.css') ?>">
<form action="#" method="post">
    <div class="form-group row">
        <div class="col-sm-12">
            <label for="image_path"><?php echo display('image_path') ?><i class="text-danger"> *</i></label>
            <input name="image_path" class="form-control image_path f-s-12" type="text" value="<?php if(html_escape($get_coursepicture->picture)){ echo html_escape($get_coursepicture->picture); }; ?>" placeholder="<?php echo display('image_path') ?>" id="image_path" readonly>
        </div>
    </div>  
    <div class="form-group row">
        <div class="col-sm-6">
            <label for=""><?php echo display('image_width'); ?></label>
            <input type="text" name="width" class="form-control widthsize" placeholder="<?php echo display('image_width'); ?>" autofocus="">
        </div>
        <div class="col-sm-6">
            <label for=""><?php echo display('image_height'); ?></label>
            <input type="text" name="height" class="form-control heightsize" placeholder="<?php echo display('image_height'); ?>">
        </div>
    </div>
    <div class="form-group row ">
        <div class="offset-3 col-md-2">
            <input type="hidden" name="course_id" id="courseid" value="<?php echo $course_id; ?>">
            <button type="button" class="btn btn-success w-md m-b-5" onclick="photoresize()"><?php echo display('submit'); ?></button>
        </div>
    </div>
</form>
