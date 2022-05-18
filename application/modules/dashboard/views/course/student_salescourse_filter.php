<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
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
        if ($student_list) {
            $sl = 0;
            foreach ($student_list as $student) {
                $get_studentcourse = $this->Student_model->get_studentcourse($student->student_id);
                $sl++;
                ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo html_escape($student->name); ?></td>
                    <td><?php echo html_escape($student->mobile); ?></td>
                    <td>
                        <ul>
                            <?php foreach ($get_studentcourse as $course) { ?>
                                <li><?php echo html_escape($course->name . " -> ( " . $course->totalcount . " )"); ?></li>
                            <?php } ?>
                        </ul>
                    </td>
                    <td class="text-center"><?php echo html_escape($student->totalsales); ?></td> 
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
        <?php if (empty($student_list)) { ?>
            <tr>
                <th class="text-center text-danger" colspan="6"><?php echo display('record_not_found'); ?></th>
            </tr>
        <?php } ?>
    </tfoot>
</table>