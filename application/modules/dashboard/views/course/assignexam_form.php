<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<!-- <div class="form-group row">
    <label for="lesson_name" class="col-sm-3 col-form-label"><?php echo display('lesson_name') ?><i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="lesson_name" class="form-control" type="text" placeholder="<?php echo display('lesson_name') ?>" id="lesson_name" required>
    </div>
</div>   -->
<div class="form-group row">
    <!-- <label for="lesson_id" class="col-sm-3 col-form-label"><?php echo display('lesson_name') ?><i class="text-danger">
            </i></label>
    <div class="col-sm-8">
        <select name="lesson_id" class="form-control placeholder-single" id="lesson_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <?php foreach ($get_lessons as $single) { ?>
            <option value="<?php echo html_escape($single->lesson_id); ?>">
                <?php echo html_escape($single->lesson_name); ?>
            </option>
            <?php } ?>
        </select>
    </div> -->
    <label for="section_id" class="col-sm-3 col-form-label">Chapter Name<i class="text-danger">*
            </i></label>
    <div class="col-sm-8">
        <select name="section_id" class="form-control placeholder-single" id="section_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <?php foreach ($get_sections as $single) { ?>
            <option value="<?php echo html_escape($single->section_id); ?>">
                <?php echo html_escape($single->section_name); ?>
            </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="exam_id" class="col-sm-3 col-form-label"><?php echo display('exam_name') ?><i class="text-danger">
            *</i></label>
    <div class="col-sm-8">
        <select name="exam_id" class="form-control placeholder-single" id="exam_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""><?php echo display('select_one'); ?></option>
            <?php foreach($get_exams as $exam){ ?>
            <option value="<?php echo $exam->exam_id; ?>"><?php echo $exam->name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <button type="button" class="btn btn-success w-md m-b-5"
            onclick="assignExam('<?php echo html_escape($course_id); ?>','')"><?php echo display('assign'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>