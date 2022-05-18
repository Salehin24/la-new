
<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="section_name" class="col-sm-3 col-form-label"><?php echo display('section_name') ?><i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="section_name" class="form-control" type="text" value="<?php echo html_escape($section_editdata->section_name); ?>" placeholder="<?php echo display('section_name') ?>" id="section_name" >
    </div>
</div>   
<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <input type="hidden" name="section_id" id="section_id" value="<?php echo html_escape($section_editdata->section_id); ?>">
        <button type="button" class="btn btn-success w-md m-b-5" onclick="sectionupdate()"><?php echo display('update'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>