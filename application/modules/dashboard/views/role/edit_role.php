
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h6 class="card-header"><?php echo html_escape((!empty($title) ? $title : null)) ?></h6>
            <?php echo form_open("dashboard/role/save_update") ?>
            <div class="card-body">

                <div class="form-group row">
                    <label for="edit_role_name" class="col-sm-3 col-form-label"><?php echo display('role_name') ?> <i class="text-danger">*</i></label>
                    <div class="col-sm-9">
                        <input name="role_name" type="text" class="form-control" id="edit_role_name" value="<?php echo html_escape($roleData->role_name) ?>"  >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit_role_description" class="col-sm-3 col-form-label"><?php echo display('description') ?> </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="2" name="role_description" id="edit_role_description"><?php echo html_escape($roleData->role_description) ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="role_id" value="<?php echo html_escape($roleData->role_id) ?>">
                <?php $m = 0; ?>                  
                <?php
                foreach ($modules as $value) {

                    $menu_item = $this->db->select('*')->from('sec_menu_item')->where('module', $value->module)->get()->result();
                    ?>
                    <input type="hidden" name="module[]" value="<?php echo html_escape($value->module); ?>">
                    <table class="table table-bordered" id="RoleTbl">
                        <h2><?php echo display(html_escape($value->module)) ?></h2>
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo display('sl_no') ?></th>
                                <th class="text-center"><?php echo display('menu_title') ?></th>
                                <th class="text-center"><?php echo display('can_create') ?></th>
                                <th class="text-center"><?php echo display('can_read') ?></th>
                                <th class="text-center"><?php echo display('can_edit') ?></th>
                                <th class="text-center"><?php echo display('can_delete') ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($menu_item))  ?>
                            <?php $sl = 0; ?>
                            <?php
                            foreach ($menu_item as $value) {
                                $ck_data = $this->db->select('*')
                                                ->where('menu_id', $value->menu_id)
                                                ->where('role_id', $roleData->role_id)->get('sec_role_permission')->row();
                                ?>
                                <tr>
                                    <td><?php echo $sl + 1; ?></td>
                                    <td class="text-<?php echo ($value->parent_menu ? 'right' : '') ?>"><?php echo display(html_escape($value->menu_title)); ?></td>
                                    <td>
                                        <div class="checkbox checkbox-success text-center">
                                            <input type="checkbox" name="create[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" <?php echo html_escape(((@$ck_data->can_create == 1) ? "checked" : null)) ?> id="edit_create[<?php echo $m ?>]<?php echo $sl ?>">
                                            <label for="edit_create[<?php echo $m ?>]<?php echo $sl ?>"></label>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="checkbox checkbox-success text-center">
                                            <input type="checkbox" name="read[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" <?php echo html_escape(((@$ck_data->can_access == 1) ? "checked" : null)) ?> id="edit_read[<?php echo $m ?>]<?php echo $sl ?>">
                                            <label for="edit_read[<?php echo $m ?>]<?php echo $sl ?>"></label>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="checkbox checkbox-success text-center">
                                            <input type="checkbox" name="edit[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" <?php echo html_escape(((@$ck_data->can_edit == 1) ? "checked" : null)) ?> id="edit_edit[<?php echo $m ?>]<?php echo $sl ?>">
                                            <label for="edit_edit[<?php echo $m ?>]<?php echo $sl ?>"></label>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="checkbox checkbox-success text-center">
                                            <input type="checkbox" name="delete[<?php echo $m ?>][<?php echo $sl ?>][]" value="1" <?php echo html_escape(((@$ck_data->can_delete == 1) ? "checked" : null)) ?> id="edit_delete[<?php echo $m ?>]<?php echo $sl ?>">
                                            <label for="edit_delete[<?php echo $m ?>]<?php echo $sl ?>"></label>
                                        </div>
                                    </td>

                            <input type="hidden" name="menu_id[<?php echo $m ?>][<?php echo $sl ?>][]" value="<?php echo html_escape($value->menu_id) ?>">

                            </tr>
                            <?php $sl++ ?>
                        <?php } ?>

                        </tbody>
                    </table>
                    <?php $m++ ?>
                <?php } ?>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5" id="disabled_btn"><?php echo display('update') ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>




