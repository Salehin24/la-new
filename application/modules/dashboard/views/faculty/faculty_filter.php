<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
    <thead>
        <tr>
            <th width="5%"><?php echo display('sl') ?></th>
            <th width="25%"><?php echo display('name') ?></th>
            <th width="10%"><?php echo display('email') ?></th>
            <th width="30%"><?php echo display('courses') ?></th>
            <th width="15%" class="text-center"><?php echo display('picture') ?></th>
            <th width="15%" class="text-center"><?php echo display('action') ?></th> 
        </tr>
    </thead>
    <tbody>
        <?php
        $sl = 0;
        foreach ($faculty_list as $faculty) {
            $get_facultyCourse = $this->Faculty_model->get_facultyCourse($faculty->faculty_id);
            $sl++;
            ?>
            <tr>
                <td><?php echo $sl; ?></td>
                <td>
                    <a href="<?php echo base_url('faculty-info/' . html_escape($faculty->faculty_id)); ?>" target="_new">
                        <?php echo html_escape($faculty->name); ?>
                    </a>
                </td>
                <td><?php echo html_escape($faculty->email); ?></td>
                <td>
                    <ul>
                        <?php foreach ($get_facultyCourse as $course) { ?>
                            <li><?php echo html_escape($course->name); ?></li>
                        <?php } ?>
                    </ul>
                </td> 
                <td class="text-center">
                    <div class="avatar avatar-xs">
                        <img src="<?php echo base_url(!empty(html_escape($faculty->picture)) ? html_escape($faculty->picture) : 'assets/img/icons/default.png'); ?>" alt="<?php echo $faculty->name; ?>" class="avatar-img rounded-circle">
                    </div>
                </td>
                <td class="text-center">
                    <?php
                    if ($this->permission->check_label('faculty_list')->update()->access()) {
                        if ($faculty->logstatus == 1) {
                            ?>
                            <a href='javascript:void(0)' onclick='facultyinactive("<?php echo html_escape($faculty->faculty_id); ?>")'   title='<?php echo display('disapprove'); ?>' class='btn btn-sm btn-success text-white' ><i class='fa fa-check' aria-hidden='true'></i></a>
                        <?php } elseif ($faculty->logstatus == 0) { ?>
                            <a href='javascript:void(0)' onclick='facultyactive("<?php echo html_escape($faculty->faculty_id); ?>")'  title='<?php echo display('approve'); ?>' class='btn btn-sm btn-warning' ><i class='fa fa-times' aria-hidden='true'></i></a>
                            <?php
                        }
                    }
                    if ($this->permission->check_label('faculty_list')->update()->access()) {
                        ?>
                        <a class="btn btn-success btn-sm" href="<?php echo base_url('faculty-edit/' . html_escape($faculty->faculty_id)); ?>"><i class="fa fa-edit"> </i> </a>
                        <?php
                    }
                    if ($this->permission->check_label('faculty_list')->delete()->access()) {
                        ?>
                        <a class="btn-danger btn btn-sm" href="javascript:void(0)" onclick="faculty_delete('<?php echo html_escape($faculty->faculty_id); ?>')"><i class="far fa-trash-alt"> </i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <?php if (empty($faculty_list)) { ?>
            <tr>
                <th colspan="6" class="text-center text-danger"><?php echo display('record_not_found'); ?></th>
            </tr>
        <?php } ?>
    </tfoot>
</table>