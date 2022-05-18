<div class="">
    <div class="form-group row">
        <label for="feedback" class="col-sm-2">Feedback</label>
        <div class="col-sm-5">
            <input type="file" name="docusign" id="docusign" class="custom-input-file" />
        </div>
    </div>
    <div class="form-group">
        <textarea class="form-control" id="feedback" name="feedback" cols="10"
            row="5"><?php echo (!empty($course_info->feedback) ? $course_info->feedback : ''); ?></textarea>
    </div>
    <input type="button" value="Reject" onclick="coursefeedback('<?php echo $course_info->course_id; ?>')"
        class="btn btn-danger btn-sm">
</div>