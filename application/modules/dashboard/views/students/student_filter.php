<div class="table-responsive">
    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
        <thead>
            <tr>
                <th width="3%"><?php echo display('sl') ?></th>
                <th width="15%"><?php echo display('name') ?></th>
                <th width="10%"><?php echo display('mobile') ?></th>
                <th width="10%"><?php echo display('email') ?></th>
                <th width="15%"><?php echo display('biography') ?></th>
                <th width="15%"><?php echo display('courses') ?></th>
                <th width="15%" class="text-center"><?php echo display('picture') ?></th>
                <th width="17%" class="text-center"><?php echo display('action') ?></th> 
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
                        <td><?php echo html_escape($student->email); ?></td>
                        <td><?php echo nl2br(html_escape($student->biography)); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($get_studentcourse as $course) { ?>
                                    <li><?php echo html_escape($course->name); ?></li>
                                <?php } ?>
                            </ul>
                        </td> 
                        <td class="text-center">
                            <div class="avatar avatar-xs">
                                <img src="<?php echo base_url(!empty(html_escape($student->picture)) ? html_escape($student->picture) : 'assets/img/icons/default.png'); ?>" alt="<?php echo html_escape($student->name); ?>" class="avatar-img rounded-circle">
                            </div>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($this->permission->check_label('student_list')->update()->access()) {
                                if ($student->logstatus == 1) {
                                    ?>
                                    <a href='javascript:void(0)' onclick='studentinactive("<?php echo html_escape($student->student_id); ?>")'   title='<?php echo display('disapprove'); ?>' class='btn btn-sm btn-success text-white' ><i class='fa fa-check' aria-hidden='true'></i></a>
                                <?php } elseif ($student->logstatus == 0) { ?>
                                    <a href='javascript:void(0)' onclick='studentactive("<?php echo html_escape($student->student_id); ?>")'  title='<?php echo display('approve'); ?>' class='btn btn-sm btn-warning' ><i class='fa fa-times' aria-hidden='true'></i></a>
                                    <?php
                                }
                            }
                            if ($this->permission->check_label('student_list')->update()->access()) {
                                ?>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('student-edit/' . html_escape($student->student_id)); ?>"><i class="fa fa-edit"> </i></a>
                                <?php
                            }
                            if ($this->permission->check_label('student_list')->delete()->access()) {
                                ?>
                                <a class="btn-danger btn btn-sm" href="javascript:void(0)" onclick="student_delete('<?php echo html_escape($student->student_id); ?>')"><i class="far fa-trash-alt"> </i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <?php if (empty($student_list)) { ?>
                <tr>
                    <th class="text-danger text-center" colspan="7"><?php echo display('record_not_found'); ?></th>
                </tr>
            <?php } ?>
        </tfoot>
    </table>
</div>