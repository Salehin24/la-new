<form action="" method="post">
    <div class="form-group row">
        <label for="edit_companyname" class="col-sm-12 mb-2">School/College/University/Institute <i class="text-danger">
                *</i></label>

        <div class="col-sm-12">
            <input name="institutename" type="text" class="form-control" id="institutename"
                placeholder="School/College/University/Institute"
                value="<?php echo html_escape($get_educationedit->institutename); ?>" required>
        </div>
    </div> <br>
    <div class="form-group row">
        <label for="degree" class="col-sm-12 mb-2"><?php echo display('degree') ?> <i class="text-danger"> *</i></label>
        <div class="col-sm-12">
            <input name="degree" type="text" class="form-control" id="degree"
                placeholder="<?php echo display('degree') ?>"
                value="<?php echo html_escape($get_educationedit->degree); ?>" required>
        </div>
    </div> <br>
    <div class="form-group row">
        <label for="passing_year" class="col-sm-12 mb-2">Passing Year <i class="text-danger"> *</i></label>
        <div class="col-sm-12">
            <select class="form-select" id="passing_year" name="passing_year">
                <option selected>Choose Year</option>
                <?php 
                                    $cy = (int)date('Y');
                                    $y = 2005; ?>
                <?php
                                        for($y = 2005; $y<=$cy; $y++){
                                    ?>
                <option value="<?php echo $y;?>" <?php if($y == $get_educationedit->passing_year){echo 'selected';}?>><?php echo $y;?></option>
                <?php } ?>
            </select>
        </div>
    </div> <br>

    <div class="form-group">
        <div class="offset-10 mb-3">
            <button type="button" class="btn btn-dark-cerulean"
                onclick="educationinfo_update('<?php echo html_escape($get_educationedit->id) ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>