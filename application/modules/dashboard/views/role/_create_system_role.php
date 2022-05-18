<h4><?php echo display('role_permission'); ?></h4>
<hr>
<?php echo form_open_multipart(enterpriseinfo()->shortname .'/role-permission-save', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="role_name" class="col-sm-3  col-form-label"><?php echo display('role_name') ?> <i class="text-danger">*</i></label>
    <div class="col-sm-9">
        <input name="role_name" type="text" class="form-control" id="role_name" placeholder="<?php echo display('role_name') ?>" required>
    </div>
</div>
<div class="form-group row">
    <label for="role_description" class="col-sm-3  col-form-label"><?php echo display('description') ?> <i class="text-danger"></i></label>
    <div class="col-sm-9">
        <textarea class="form-control" rows="2" name="role_description" id="role_description"></textarea>
    </div>
</div>
<?php $m = 0; ?>                  
<?php
foreach ($modules as $value) {
    $menu_item = $this->db->select('*')->from('sec_menu_item')->where('module', $value->module)->get()->result();
    ?>
    <input type="hidden" name="module[]" value="<?php echo html_escape($value->module); ?>">
    <div class="table-responsive">
        <table class="table table-bordered" id="RoleTbl">
            <h4><?php echo display(html_escape($value->module)) ?></h4>
            <thead>
                <tr>
                    <th><?php echo display('sl_no') ?></th>
                    <th class="text-center"><?php echo display('menu_title'); ?></th>
                    <th class="text-center"><?php echo display('can_create'); ?></th>
                    <th class="text-center"><?php echo display('can_read'); ?></th>
                    <th class="text-center"><?php echo display('can_edit'); ?></th>
                    <th class="text-center"><?php echo display('can_delete'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($menu_item))  ?>
                <?php $sl = 0; ?>
                <?php foreach ($menu_item as $value) { ?>
                    <tr>
                        <td><?php echo $sl + 1; ?></td>
                        <td class="text-<?php echo ($value->parent_menu ? 'right' : '') ?>"><?php echo display(html_escape($value->menu_title)); ?></td>
                        <td>
                            <div class="checkbox checkbox-success text-center">
                                <input type="checkbox" name="create[<?php echo $m ?>][<?php echo $sl ?>][]" class="can_create" value="1" id="create[<?php echo $m ?>]<?php echo $sl ?>">
                                <label for="create[<?php echo $m ?>]<?php echo $sl ?>"></label>
                            </div>
                        </td>

                        <td>
                            <div class="checkbox checkbox-success text-center">
                                <input type="checkbox" name="read[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" class="can_read" id="read[<?php echo $m ?>]<?php echo $sl ?>">
                                <label for="read[<?php echo $m ?>]<?php echo $sl ?>"></label>
                            </div>
                        </td> 
                        <td>
                            <div class="checkbox checkbox-success text-center">
                                <input type="checkbox" name="edit[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" class="can_edit" id="edit[<?php echo $m ?>]<?php echo $sl ?>">
                                <label for="edit[<?php echo $m ?>]<?php echo $sl ?>"></label>
                            </div>
                        </td> 
                        <td>
                            <div class="checkbox checkbox-success text-center">
                                <input type="checkbox" name="delete[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" class="can_delete" id="delete[<?php echo $m ?>]<?php echo $sl ?>">
                                <label for="delete[<?php echo $m ?>]<?php echo $sl ?>"></label>
                            </div>
                        </td>
                <input type="hidden" name="menu_id[<?php echo $m ?>][<?php echo $sl ?>][]" value="<?php echo $value->menu_id ?>">
                </tr>
                <?php $sl++ ?>
            <?php } ?>

            </tbody>
        </table>
    </div>
    <?php $m++ ?>
<?php } ?>

<div class="form-group text-right">
    <button type="submit" id="disabled_btn" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
</div>
<?php echo form_close(); ?>
