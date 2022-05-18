
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h6 class="card-header"><?php echo html_escape((!empty($title) ? $title : null)) ?>
                <small class="float-right">

                </small>
            </h6>
            <?php echo form_open("dashboard/role/save_role_access"); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="user_id" class="col-sm-2 col-form-label"><?php echo display('user') ?><i class="text-danger"> * </i></label>
                            <div class="col-sm-8">
                                <select class="form-control placeholder-single" name="user_id" id="user_id" required onchange="userRole(this.value)" data-placeholder='<?php echo display('select_one'); ?>'>
                                    <option value=""></option>
                                    <?php
                                    foreach ($user as $val) {
                                        echo '<option value="' . html_escape($val->log_id) . '">' . html_escape($val->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role_id" class="col-sm-2 col-form-label"><?php echo display('role') ?><i class="text-danger"> * </i></label>
                            <div class="col-sm-8">
                                <select multiple="multiple" class="search_test placeholder-single" name="role_id[]" id="role_id" data-placeholder="<?php echo display('select_one'); ?>" required>
                                    <?php foreach ($role as $val) { ?>
                                    <option value="<?php echo html_escape($val->role_id); ?>"><?php echo html_escape($val->role_name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group offset-2 col-sm-6">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="disabled_btn"><?php echo display('save') ?></button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="existrole">
                            <h6 class="existrole_ttl"></h6>         
                            <ul>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/assign_role.js') ?>"></script>










