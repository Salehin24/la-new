<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
<div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="faculty_id" class="col-sm-6"><?php echo display('faculty') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="faculty_id" id="faculty_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_faculty as $faculty) { ?>
                                        <option value="<?php echo html_escape($faculty->faculty_id); ?>">
                                            <?php echo html_escape($faculty->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="mobile" class="col-sm-6"><?php echo display('mobile') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="<?php echo display('mobile'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" onclick="faculty_salescourse_filter()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table display table-bordered table-striped table-hover bg-white m-0  results">
                    <!-- <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table results"> -->
                        <thead>
                            <tr><th><?php echo display('sl');?></th>
                                <th><?php echo display('faculty_name') ?></th>
                                <th><?php echo display('mobile') ?></th>
                                <th class="text-center"><?php echo display('total_course') ?></th>
                                <th class="text-center"><?php echo display('total_sales') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($faculty_sales_course) {
                                $sl=0;
                                foreach ($faculty_sales_course as $faculty) {
                                    $get_facultyCourse = $this->Faculty_model->get_facultyCourse($faculty->faculty_id);
                                    $courseids = '';
                                  
                                    foreach ($get_facultyCourse as $facultycourse) {
                                        $courseids .= "'" . $facultycourse->course_id . "',";
                                    }
                                    $course_ids = rtrim($courseids, ",");
                                    $faculty_course_totalsales = $this->Course_model->faculty_course_totalsales($course_ids);
                                    ?>
                                    <tr>
                                         <td><?php echo ++$sl; ?></td>
                                        <td><?php echo html_escape($faculty->name); ?></td>
                                        <td><?php echo html_escape($faculty->mobile); ?></td>
                                        <td class="text-center">
                                            <?php echo html_escape($faculty->totalcourse); ?>
                                        </td>
                                        <td class="text-center"><?php echo html_escape((($faculty_course_totalsales->totalsales) ? "$faculty_course_totalsales->totalsales" : "0")); ?></td> 
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>
