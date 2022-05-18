<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
    <thead>
        <tr>
            <th><?php echo display('faculty_name') ?></th>
            <th><?php echo display('mobile') ?></th>
            <th class="text-center"><?php echo display('total_course') ?></th>
            <th class="text-center"><?php echo display('total_sales') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($faculty_sales_course) {
            foreach ($faculty_sales_course as $faculty) {
                $get_facultyCourse = $this->Faculty_model->get_facultyCourse($faculty->log_id);
                $courseids = '';
                foreach ($get_facultyCourse as $facultycourse) {
                    $courseids .= "'" . $facultycourse->course_id . "',";
                }
                $course_ids = rtrim($courseids, ",");
                $faculty_course_totalsales = $this->Course_model->faculty_course_totalsales($course_ids);
                ?>
                <tr>
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
    <tfoot>
        <?php if(empty($faculty_sales_course)){ ?>
        <tr>
            <th class="text-center text-danger" colspan="6"><?php echo display('record_not_found'); ?></th>
        </tr>
        <?php } ?>
    </tfoot>
</table>