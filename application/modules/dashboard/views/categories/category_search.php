<table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
    <thead>
        <tr>
            <th><?php echo display('sl') ?></th>
            <th><?php echo display('category') ?></th>
            <th><?php echo display('parent_category') ?></th>
            <th><?php echo display('commission') ?></th>
            <th class="text-center"><?php echo display('action') ?></th> 
        </tr>
    </thead>
    <tbody>
        <?php
        if ($category_list) {
            $sl = 0;
            foreach ($category_list as $single) {
                $parents = $this->Category_model->category_parent_name($single->parent_id);
                $sl++;
                ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo html_escape($single->name); ?></td>
                    <td><?php echo html_escape((!empty($parents->name)) ? "$parents->name" : ""); ?></td>
                    <td><?php echo html_escape($single->commission); ?>%</td>
                    <td class="text-center">
                        <?php if ($this->permission->check_label('category')->update()->access()) { ?>
                            <a class="" href="<?php echo base_url('category-edit/' . html_escape($single->category_id)); ?>"><i class="fa fa-edit btn btn-success btn-sm"> </i> </a>
                            <?php
                        }
                        if ($this->permission->check_label('category')->delete()->access()) {
                            ?>
                            <a class="" href="javascript:void(0)" onclick="category_delete('<?php echo html_escape($single->category_id) ?>')"><i class="far fa-trash-alt btn-danger btn btn-sm"> </i> </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    <?php if (empty($category_list)) { ?>
        <tfoot>
            <tr>
                <th class="text-danger text-center" colspan="6"><?php echo display('record_not_found'); ?></th>
            </tr>
        </tfoot>
    <?php } ?>
</table>