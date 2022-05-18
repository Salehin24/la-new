<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
    <thead>
        <tr>
            <th width="5%"><?php echo display('sl') ?></th>
            <th width="30%"><?php echo display('course_name') ?></th>
            <th width="20%"><?php echo display('category') ?></th>
            <th width="10%" class="text-center"><?php echo display('total_sales') ?></th>
            <th width="20%"><?php echo display('section_lesson') ?></th>
            <th  width="15%" class="text-center"><?php echo display('action') ?></th> 
        </tr>
    </thead>
    <tbody>
        <?php
        if ($course_list) {
            $sl = 0;
            foreach ($course_list as $course) {
                $course_wise_sectioncount = $this->Course_model->course_wise_sectioncount($course->course_id);
                $course_wise_lessoncount = $this->Course_model->course_wise_lessoncount($course->course_id);
                $course_totalsales = $this->Course_model->course_totalsales($course->course_id);
                $sl++;
                ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td>
                        <a href="<?php echo base_url('course-details/' . html_escape($course->course_id) . '/' . html_escape($course->slug)); ?>" target="_new">
                            <?php echo html_escape($course->name); ?>
                        </a>
                    </td>
                    <td>
                        <?php echo html_escape($course->category_name); ?>
                    </td> 
                    <td class="text-center">
                        <?php echo html_escape($course_totalsales->totalsales); ?>
                    </td> 
                    <td>
                        Total Section <?php echo html_escape($course_wise_sectioncount); ?>
                        <br>
                        Total Lesson <?php echo html_escape($course_wise_lessoncount); ?>
                    </td> 
                    <td class="text-center">
                        <?php
                        if ($user_type == 1) {
                            if ($course->status == 1) {
                                ?>
                        <a href='javascript:void(0)' onclick='courseinactive("<?php echo html_escape($course->course_id); ?>")'  title='<?php echo display('disapprove'); ?>' class='btn btn-sm btn-success text-white' ><i class='fa fa-check' aria-hidden='true'></i></a>
                            <?php } elseif ($course->status == 0) { ?>
                        <a href='javascript:void(0)' onclick='courseactive("<?php echo html_escape($course->course_id); ?>")' title='<?php echo display('approve'); ?>' class='btn btn-sm btn-warning' ><i class='fa fa-times' aria-hidden='true'></i></a>
                                <?php
                            }
                        }
                        ?>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="far fa-comment-dots"></i>
                        </button>
                        <div class="dropdown-menu">
                            <?php if ($this->permission->check_label('course_list')->update()->access()) { ?>
                            <a class="dropdown-item" href="<?php echo base_url('course-edit/' . html_escape($course->course_id)); ?>"><i class="fa fa-edit btn-success  btn btn-sm"> </i> <?php echo display('edit_course'); ?></a>
                                <?php
                            }
                            if ($this->permission->check_label('course_list')->read()->access()) {
                                ?>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="addsection_form('<?php echo html_escape($course->course_id); ?>')"><i class="fab fa-artstation btn-primary  btn btn-sm"> </i> <?php echo display('add_section'); ?></a>
                                <?php
                            }
                            if ($this->permission->check_label('course_list')->read()->access()) {
                                ?>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="addlesson_form('<?php echo html_escape($course->course_id); ?>')"><i class="fab fa-artstation btn-primary  btn btn-sm"> </i> <?php echo display('add_lesson'); ?></a>
                            <?php }
                            if($this->permission->check_label('course_list')->delete()->access()){
                            ?>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="course_delete('<?php echo html_escape($course->course_id); ?>')"><i class="far fa-trash-alt btn-danger  btn btn-sm"> </i> <?php echo display('delete'); ?></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
        <?php if (empty($course_list)) { ?>
            <tr>
                <th class="text-center text-danger" colspan="6"><?php echo display('record_not_found'); ?></th>
            </tr>
        <?php } ?>
    </tfoot>
</table>