<form action="" method="post">
    <div class="form-group row">
        <label for="student_name" class="control-label form-check-label fw-semi-bold mb-2">Student Name <i class="text-danger">
                *</i></label>
        <div class="col-sm-12">
            <input name="student_name" type="text" class="form-control" id="student_name"
                value="<?php echo get_studentinfo($student_id)->name; ?>" readonly>
        </div>
    </div> <br>
    <div class="form-group row">
        <label for="course_name" class="control-label form-check-label fw-semi-bold mb-2"><?php echo display('course_name') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-12">
            <input name="course_name" type="text" class="form-control" id="course_name"
                placeholder="<?php echo display('degree') ?>" value="<?php echo get_courseinfo($course_id)->name; ?>"
                readonly>
        </div>
    </div> <br>
    <div class="form-group row">
        <label for="certificate_id" class="control-label form-check-label fw-semi-bold mb-2"><?php echo display('certificate_name') ?> <i class="text-danger">
                *</i></label>
        <div class="col-sm-12">
            <select class="form-control" id="certificate_id" name="certificate_id">
                <option value="">-- select one -- </option>
                <?php foreach($get_templates as $template){ ?>
                <option value="<?php echo $template->id; ?>">
                    <?php echo $template->title; ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </div> <br>
    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>">
    <div class="form-group row">
        <div class="">
            <button type="button" class="btn btn-dark-cerulean w-md m-b-5"
                onclick="assignedStudentCertificate()"><?php echo display('submit') ?></button>
        </div>
    </div>
</form>