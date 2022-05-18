<?php echo form_open_multipart(enterpriseinfo()->shortname .'/question-save', 'class="myform" id="myform"'); ?>

<div class="form-group row">
    <label for="question_name" class="col-sm-3 col-form-label"><?php echo display('question_name') ?><i
            class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="question_name" class="form-control" type="text"
            placeholder="<?php echo display('question_name') ?>" id="question_name" required>
    </div>
</div>
<div class="form-group row">
    <label for="qst_type" class="col-sm-3 col-form-label"><?php echo display('question_type'); ?> <i class="text-danger"> *
        </i></label>
    <div class="col-sm-8">
        <select class="form-control placeholder-single" name="question_type" id="qst_type"
            onchange="loadquestiondatamodal(this.value)" data-placeholder="<?php echo display('select_one'); ?>"
            required>
            <option value=""><?php echo display('select_one'); ?></option>
            <option value="1">True/False</option>
            <option value="2">Multiple Answer</option>
            <option value="3"><?php echo display('short_answer'); ?></option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="qst_mark" class="col-sm-3 col-form-label"><?php echo display('question_mark') ?> <i class="text-danger"> *
        </i></label>
    <div class="col-sm-8">
    <input type="number" min="1" name="question_mark" id="qst_mark"
                                    class="form-control" placeholder="<?php echo display('question_mark'); ?>" required>
    </div>
</div>

<div class="form-group row">
    <div class="loaddata_modal col-sm-12 w-100p">

    </div>
</div>

<div class="form-group row ">
    <div class="offset-3 col-md-2">
        <input type="hidden" name="mode" id="mode" value="<?php echo $action; ?>">
        <input type="hidden" name="exam_id" id="exam_id" value="<?php echo html_escape($exam_id); ?>">
        <input type="hidden" name="assign_id" id="assign_id" value="<?php echo html_escape($assign_id); ?>">
        <button type="submit" class="btn btn-success w-md m-b-5"
            ><?php echo display('add'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>