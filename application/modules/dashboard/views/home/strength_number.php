<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('strength_number') ?> </h6>
            <hr>
        </div>
    </div>
    <?php //d($setting); ?>
    <div class="panel-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="learner_count" class="col-sm-2">Learners Count <i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="learner_count" class="form-control" type="text" placeholder="Learners Count"
                        id="learner_count" value="<?php echo ((!empty($setting->learner_count))  ? $setting->learner_count : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="total_course" class="col-sm-2">Total Course <i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="total_course" class="form-control" type="text" placeholder="Total Course"
                        id="total_course" value="<?php echo ((!empty($setting->total_course))  ? $setting->total_course : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="language_count" class="col-sm-2">Language<i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="language_count" class="form-control" type="text" placeholder="Language"
                        id="language_count" value="<?php echo ((!empty($setting->language_count))  ? $setting->language_count : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="successfully_students" class="col-sm-2">Successfully Student<i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="successfully_students" class="form-control" type="text" placeholder="Successfully Student"
                        id="successfully_students" value="<?php echo ((!empty($setting->successfully_students))  ? $setting->successfully_students : ''); ?>">
                </div>
            </div>
                        

            <div class="offset-3 mb-3 group-end">
                <input type="hidden" id="id" value="<?php echo ((!empty($setting->id))  ? $setting->id : ''); ?>">
                <button type="button" onclick="strengthnumber_upate()"
                    class="btn btn-info w-md m-b-5"><?php echo display('update') ?></button>
            </div>
        </form>
    </div>
</div>