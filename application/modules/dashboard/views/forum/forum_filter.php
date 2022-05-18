<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
    <thead>
        <tr>
            <th width="5%"><?php echo display('sl') ?></th>
            <th width="30%"><?php echo display('title') ?></th>
            <th width="15%"><?php echo display('category') ?></th>
            <th width="35%"><?php echo display('description') ?></th>
            <th width="15%" class="text-center"><?php echo display('action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($forum_list) {
            $sl = 0;
            foreach ($forum_list as $single) {
                $sl++;
                ?>
        <tr>
            <td><?php echo $sl; ?></td>
            <td>
                <a href="<?php echo base_url('forum-details/' . html_escape($single->forum_id) . "/" . html_escape($single->slug)); ?>"
                    target="_new">
                    <?php echo html_escape($single->title); ?>
                </a>
            </td>
            <td><?php echo html_escape($single->category_name); ?></td>
            <td><?php echo substr(html_escape($single->description), 0, 150) . " ...."; ?></td>
            <td class="text-center">
                <?php if ($this->permission->check_label('forum_list')->update()->access()) { ?>
                <a class="" href="<?php echo base_url('forum-edit/' . html_escape($single->forum_id)); ?>"><i
                        class="fa fa-edit btn btn-success btn-sm"> </i> </a>
                <?php
                        }
                        if ($this->permission->check_label('forum_list')->delete()->access()) {
                            ?>
                <a class="" href="<?php echo base_url('forum-delete/' . html_escape($single->forum_id)); ?>"
                    onclick="return confirm('Are you sure')"><i class="far fa-trash-alt btn-danger btn btn-sm"> </i>
                </a>
                <?php } ?>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
        <?php if (empty($forum_list)) { ?>
        <tr>
            <th class="text-danger text-center" colspan="6"><?php echo display('record_not_found'); ?></th>
        </tr>
        <?php } ?>
    </tfoot>
</table>