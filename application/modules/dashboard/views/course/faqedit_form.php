<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="question" class="col-sm-3 col-form-label"><?php echo display('question') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-9">
        <input name="question" class="form-control" type="text"
               placeholder="<?php echo display('question') ?>" id="edit_question" value="<?php echo (!empty($faqeditdata->question) ? $faqeditdata->question : ''); ?>" required>
    </div>
</div>
<div class="form-group row">
    <label for="answer" class="col-sm-3 col-form-label"><?php echo display('answer') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-9">
        <textarea name="answer" id="edit_answer" class="form-control" cols="40" rows="10"  placeholder="<?php echo display('answer') ?>"><?php echo (!empty($faqeditdata->answer) ? $faqeditdata->answer : ''); ?></textarea>
    </div>
</div>
<input type="hidden" name="mode" id="mode" value="edit">
<input type="hidden" name="id" id="id" value="<?php echo $faqeditdata->id; ?>">
<div class="form-group text-right">
    <button type="button" onclick="faqsave()"
            class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
</div>
<?php echo form_close(); ?>