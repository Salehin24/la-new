<?php echo form_open_multipart(enterpriseinfo()->shortname.'/section-save', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="section_name" class="col-sm-3 col-form-label"><?php echo display('section_name') ?><i
            class="text-danger"> *</i></label>
    <div class="col-sm-7">
        <input name="section_name[]" class="form-control" type="text"
            placeholder="<?php echo display('section_name') ?>" id="section_name" required>
    </div>
    <div class="col-sm-1">
        <button id="add-invoice-item" class="btn btn-info btn-sm" name="add-new-item" onclick="appendSectionname()" type="button" style="margin: 0px 15px 15px;"><i class="fa fa-plus"> </i></button>
    </div>
</div>
<div id="appendsection_area"></div>

<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <input type="hidden" name="mode" id="mode" value="<?php echo html_escape($mode); ?>">
        <input type="hidden" name="course_id" id="courseid" value="<?php echo html_escape($course_id); ?>">
        <!-- <button type="submit" class="btn btn-success w-md m-b-5" onclick="section_save()"><?php echo display('save'); ?></button> -->
        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>