
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h6 class="card-header"><?php echo display('user_access_role'); ?></h6>
            <div class="card-body">
                <?php echo form_open("dashboard/role/update_access_role", array('name' => 'role_acc')); ?>
                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label"><?php echo display('user') ?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-9">
                        <select class="form-control placeholder-single" name="user_id" id="user_id" required data-placeholder='<?php echo display('select_one'); ?>'>
                            <option value=""></option>
                            <?php foreach ($user as $val) { ?>
                                <option value="<?php echo html_escape($val->log_id); ?>" <?php
                                if ($editdatainfo->fk_user_id == $val->log_id) {
                                    echo 'selected';
                                }
                                ?>>
                                            <?php echo html_escape($val->name); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php
                foreach ($assigned_roled as $assignrole) {
                    $role_id[] = html_escape($assignrole->fk_role_id);
                }
                ?>
                <div class="form-group row">
                    <label for="role_id" class="col-sm-3 col-form-label"><?php echo display('role') ?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-9">
                        <select multiple="multiple" class="search_test placeholder-single" name="role[]" id="role_id" data-placeholder="<?php echo display('select_one'); ?>" required>
                            <?php
                            foreach ($role as $val) {
                                ?>
                                <option value="<?php echo html_escape($val->role_id); ?>" <?php
                                if (in_array(html_escape($val->role_id), $role_id)) {
                                    echo 'selected';
                                }
                                ?>>
                                            <?php echo html_escape($val->role_name); ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save_btn save" id="disabled_btn"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/assign_role.js') ?>"></script>

