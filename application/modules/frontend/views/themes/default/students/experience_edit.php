<form action="" method="post">
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_companyname" class="col-sm-4 mb-2">Company Name <i class="text-danger"> *</i></label>
            <div class="col-sm-12">
                <input name="companyname" type="text" class="form-control" id="edit_companyname"
                    placeholder="Company Name" value="<?php echo html_escape($get_experienceedit->companyname); ?>"
                    required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="edit_title" class="col-sm-4 mb-2">Job <?php echo display('title') ?> <i class="text-danger">
                    *</i></label>
            <div class="col-sm-12">
                <input name="edit_title" type="text" class="form-control" id="edit_title"
                    placeholder="<?php echo display('title') ?>"
                    value="<?php echo html_escape($get_experienceedit->title); ?>" required>
            </div>
        </div>
    </div> <br>

    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_city" class="col-sm-4 mb-2"><?php echo display('city') ?> <i class="text-danger">
                    *</i></label>
            <div class="col-sm-12">
                <input name="edit_city" type="text" class="form-control" id="edit_city"
                    placeholder="<?php echo display('city') ?>"
                    value="<?php echo html_escape($get_experienceedit->city); ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="edit_country" class="col-sm-4 mb-2"><?php echo display('country') ?> <i class="text-danger">
                    *</i></label>
            <div class="col-sm-12">
                <input name="edit_country" type="text" class="form-control" id="edit_country"
                    placeholder="<?php echo display('country') ?>"
                    value="<?php echo html_escape($get_experienceedit->country); ?>" required>
            </div>
        </div>
    </div> <br>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_frommonth" class="col-sm-4 mb-2">From Month <i class="text-danger"> *</i></label>
            <div class="col-sm-12">
                <select class="form-select" id="edit_frommonth" name="edit_frommonth">
                    <option selected>Choose Month</option>
                    <option value="January"
                        <?php echo (($get_experienceedit->frommonth == 'January') ? 'selected' : ''); ?>>Jan</option>
                    <option value="February"
                        <?php echo (($get_experienceedit->frommonth == 'February') ? 'selected' : ''); ?>>Feb</option>
                    <option value="March"
                        <?php echo (($get_experienceedit->frommonth == 'March') ? 'selected' : ''); ?>>Mar
                    </option>
                    <option value="April"
                        <?php echo (($get_experienceedit->frommonth == 'April') ? 'selected' : ''); ?>>Apr
                    </option>
                    <option value="May" <?php echo (($get_experienceedit->frommonth == 'May') ? 'selected' : ''); ?>>May
                    </option>
                    <option value="June" <?php echo (($get_experienceedit->frommonth == 'June') ? 'selected' : ''); ?>>
                        Jun
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label for="edit_fromyear" class="col-sm-4 mb-2">From Year <i class="text-danger"> *</i></label>
            <div class="col-sm-12">
                <select class="form-select" id="edit_fromyear" name="edit_fromyear">
                    <option selected>Choose Year</option>
                    <?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                        <?php
                                        for($y = 2010; $y<=$cy; $y++){  ?>
                                        <option value="<?php echo $y; ?>" <?php echo (($get_experienceedit->fromyear == $y) ? 'selected' : ''); ?>><?php echo $y;?></option>
                                        <?php } ?>
                </select>
            </div>
        </div>
    </div> <br>
    <div class="form-group row toeditareahide">
        <div class="col-md-6">
            <label for="edit_tomonth" class="col-sm-4 mb-2">To Month <i class="text-danger"> *</i></label>
            <div class="col-sm-12">
                <select class="form-select" id="edit_tomonth" name="edit_tomonth">
                    <option selected>Choose Month</option>
                    <option value="January"
                        <?php echo (($get_experienceedit->tomonth == 'January') ? 'selected' : ''); ?>>
                        Jan</option>
                    <option value="February"
                        <?php echo (($get_experienceedit->tomonth == 'February') ? 'selected' : ''); ?>>Feb</option>
                    <option value="March" <?php echo (($get_experienceedit->tomonth == 'March') ? 'selected' : ''); ?>>
                        Mar
                    </option>
                    <option value="April" <?php echo (($get_experienceedit->tomonth == 'April') ? 'selected' : ''); ?>>
                        Apr
                    </option>
                    <option value="May" <?php echo (($get_experienceedit->tomonth == 'May') ? 'selected' : ''); ?>>May
                    </option>
                    <option value="June" <?php echo (($get_experienceedit->tomonth == 'June') ? 'selected' : ''); ?>>Jun
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label for="edit_toyear" class="col-sm-4 mb-2">To Year <i class="text-danger"> *</i></label>
            <div class="col-sm-12">
                <select class="form-select" id="edit_toyear" name="edit_toyear">
                    <option selected>Choose Year</option>
                    <?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                        <?php
                                        for($y = 2010; $y<=$cy; $y++){  ?>
                                        <option value="<?php echo $y; ?>" <?php echo (($get_experienceedit->toyear == $y) ? 'selected' : ''); ?>><?php echo $y;?></option>
                                        <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="edit_toyear" class="col-sm-4"> <i class="text-danger"> </i></label>
            <div class="col-sm-8">
                <input class="form-check-input" type="checkbox" onclick="isNowworking('1', 'edit')" id="nowworking_edit"
                    name="nowworking[]" value="<?php echo $get_experienceedit->is_now; ?>"
                    <?php echo (($get_experienceedit->is_now == 1) ? 'checked' : ''); ?>>
                <!-- <input type="hidden" name="hdn_nowworking[]" id="hdn_nowworking_1"> -->
                <label class="form-check-label" for="nowworking_edit"> I currently work here</label>
            </div>
        </div>
    </div> <br>
    <input type="hidden" id="isnow" value="<?php echo $get_experienceedit->is_now; ?>">
    <div class="form-group row">
        <div class="offset-10 mb-3">
            <button type="button" class="btn btn-dark-cerulean"
                onclick="experienceinfo_update('<?php echo html_escape($get_experienceedit->id) ?>')"><?php echo display('update') ?></button>
        </div>
    </div>
</form>

<script>
$(document).ready(function(){
    var isnow = $("#isnow").val();
    if(isnow == 1){
        $(".toeditareahide").css("display", "none");
    }
})
</script>