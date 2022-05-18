<?php
$currency = $setting->currency;
$position = $setting->currency_position;
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('course_name') ?></th>
                                <th><?php echo display('category') ?></th>
                                <th><?php echo display('section_lesson') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($enrollCourse_list) {
                                $sl = 0;
                                foreach ($enrollCourse_list as $course) {
                                    $course_wise_sectioncount = $this->Course_model->course_wise_sectioncount($course->course_id);
                                    $course_wise_lessoncount = $this->Course_model->course_wise_lessoncount($course->course_id);
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('course-details/' . html_escape($course->course_id)); ?>" target="_new">
                                                <?php echo html_escape($course->name); ?>
                                            </a>
                                        </td>
                                        <td><?php echo html_escape($course->category_name); ?></td> 
                                        <td>
                                            Total Section <?php echo html_escape($course_wise_sectioncount); ?>
                                            <br>
                                            Total Lesson <?php echo html_escape($course_wise_lessoncount); ?>
                                        </td> 
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
