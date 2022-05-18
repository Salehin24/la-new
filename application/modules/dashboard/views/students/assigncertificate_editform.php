<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="student_id" class="col-sm-3 col-form-label"><?php echo display('student_name') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-9">
        <select name="student_id" class="form-control placeholder-single" id="edit_student_id"
            data-placeholder="<?php echo display('select_one'); ?>" multiple>
            <option value=""></option>
            <?php
                foreach ($get_studentlist as $student) {
            ?>
            <option value="<?php echo html_escape($student->log_id); ?>"
                <?php echo (($assigncertificate_edit->user_id == $student->log_id) ? 'selected' : ''); ?>>
                <?php echo html_escape($student->name); ?>
            </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="certificate_id" class="col-sm-3 col-form-label"><?php echo display('certificate_name') ?> <i
            class="text-danger"> *</i> </label>
    <div class="col-sm-9">
        <select name="certificate_id" class="form-control placeholder-single" id="edit_certificate_id"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value=""></option>
            <?php
                foreach ($get_certificatelist as $certificate) {
            ?>
            <option value="<?php echo html_escape($certificate->id); ?>"
                <?php echo (($assigncertificate_edit->certificate_id == $certificate->id) ? 'selected' : ''); ?>>
                <?php echo html_escape($certificate->title); ?>
            </option>
            <?php } ?>
        </select>
    </div>
</div>
    <input type="hidden" name="mode" id="mode" value="edit">  
    <input type="hidden" name="id" id="id" value="<?php echo $assigncertificate_edit->id; ?>">
<div class="form-group text-right">

    <button type="button" onclick="assigncertificate()"
        class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
</div>
<?php echo form_close(); ?>
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/student.js') ?>"></script>