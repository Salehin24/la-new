<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
<style>
/* .btn-success {
    color: #fff;
    background-color: #1b5fa0;
    border-color: #1b5fa0;
} */
</style>
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
                            <label for="student_id" class="col-sm-6"><?php echo display('students') ?></label>
                            <div class="col-sm-9">
                                <select class="form-control placeholder-single" name="student_id" id="student_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($student_sales_course as $student) { ?>
                                    <option value="<?php echo html_escape($student->student_id); ?>">
                                        <?php echo html_escape($student->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="mobile" class="col-sm-6"><?php echo display('mobile') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="<?php echo display('mobile'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="start_date" class="col-sm-12"><?php echo display('start_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="start_date" name="start_date"
                                    placeholder="<?php echo display('start_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="end_date" class="col-sm-12"><?php echo display('end_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="end_date" name="end_date"
                                    placeholder="<?php echo display('end_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="mobile" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" onclick="student_salescourse_filter()"><i
                                        class="fa fa-search"></i></button>
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
                <h4><?php
                    echo html_escape((!empty($title) ? $title : null));
                    if ($user_type == 1) {
                        ?>
                    <small class="float-right">
                        <button type="button" class="btn btn-color text-white" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">Filter</button>
                    </small>
                    <?php } ?>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example"
                        class="table display table-bordered table-striped table-hover bg-white m-0  results">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('students_name') ?></th>
                                <th><?php echo display('mobile') ?></th>
                                <th class=""><?php echo display('courses') ?></th>
                                <th class="text-center"><?php echo display('total_sales') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($student_sales_course) {
                                $sl = 0 + $pagenum;
                                foreach ($student_sales_course as $student) {
                                    if ($user_type == 1) {
                                        $get_studentcourse = $this->Student_model->get_studentcourse($student->student_id);
                                    } elseif ($user_type == 3) {
                                        $get_studentcourse = $this->Student_model->get_studentfacultycourse($student->student_id, $user_id);
                                    }
                                    $sl++;
                                    ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($student->name); ?></td>
                                <td><?php echo html_escape($student->mobile); ?></td>
                                <td>
                                    <!-- <ul>
                                        <?php foreach ($get_studentcourse as $course) { ?>
                                        <li><?php echo html_escape($course->name . " -> ( " . html_escape($course->totalcount) . " )"); ?>
                                        </li>
                                        <?php } ?>
                                    </ul> -->
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Total Sales</th>
                                            <th>Purchase Date & time</th>
                                            <th>Original price</th>
                                            <!-- <th>Paid Amount</th> -->
                                        <tr>
                                        </thead>
                                        <?php foreach ($get_studentcourse as $course) { ?>
                                        <tr>
                                            <td><?php echo $course->name; ?></td>
                                            <td class="text-center"><?php echo $course->totalcount; ?></td>
                                            <td class="text-center"><?php echo $course->created_date; ?></td>
                                            <td class="text-center"><?php echo $course->price; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                                <td class="text-center"><?php echo html_escape($student->totalsales); ?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <?php //echo htmlspecialchars_decode($links); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>