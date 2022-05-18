<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>

<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name"
            value="<?php echo (!empty($get_enterpriseeditdata->name) ? $get_enterpriseeditdata->name : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile"
            onkeyup="onlynumber_allow(this.value, 'mobile')"
            value="<?php echo (!empty($get_enterpriseeditdata->mobile_no) ? $get_enterpriseeditdata->mobile_no : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="dateofbirth" class="col-sm-3 col-form-label"><?php echo display('date_of_birth') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-5">
        <input name="dateofbirth" class="form-control datepicker" type="text" id="dateofbirth"
            value="<?php echo (!empty($get_enterpriseeditdata->date_of_birth) ? $get_enterpriseeditdata->date_of_birth : date('Y-m-d')); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email"
            value="<?php echo (!empty($get_enterpriseeditdata->email) ? $get_enterpriseeditdata->email : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label"><?php echo display('username') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <input name="username" class="form-control" type="text" placeholder="<?php echo display('username') ?>"
            id="username"
            value="<?php echo (!empty($get_enterpriseeditdata->username) ? $get_enterpriseeditdata->username : ''); ?>"
            required>
    </div>
</div>
<!-- <div class="form-group row">
    <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>"
            id="password" required>
    </div>
</div> -->
<div class="form-group row">
    <label for="student_capacity" class="col-sm-3 col-form-label"><?php echo display('student_capacity') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-5">
        <input name="capacity" class="form-control" type="number" id="student_capacity"
            value="<?php echo (!empty($get_enterpriseeditdata->student_capacity) ? $get_enterpriseeditdata->student_capacity : ''); ?>"
            required>
    </div>
</div>
<div class="form-group row">
    <label for="instructor_capacity" class="col-sm-3 col-form-label"><?php echo display('instructor_capacity') ?> <i
            class="text-danger"> *</i></label>
    <div class="col-sm-5">
        <input name="instructor_capacity" class="form-control" type="number" id="instructor_capacity"
            value="<?php echo (!empty($get_enterpriseeditdata->faculty_capacity) ? $get_enterpriseeditdata->faculty_capacity : ''); ?>"
            required>
    </div>
</div>
<?php
foreach ($get_assignedrole as $assignrole) {
    $role_id[] = html_escape($assignrole->fk_role_id);
}
?>
<div class="form-group row">
    <label for="role_id" class="col-sm-3 col-form-label"><?php echo display('role_assign') ?> <i class="text-danger">
            *</i></label>
    <div class="col-sm-5">
        <select class="form-control placeholder-single" id="role_id" name="role_id"
            data-placeholder="<?php echo display('select_one'); ?>" multiple>
            <option value=""></option>
            <?php foreach ($get_rolepermission as $role) { ?>
            <option value="<?php echo $role->role_id; ?>" <?php
                                                                if ($get_assignedrole) {
                                                                    if (in_array(html_escape($role->role_id), $role_id)) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>>
                <?php echo $role->role_name; ?>
            </option>
            <?php } ?>
        </select>
    </div>
</div>
<input type="hidden" id="edit_mode" value="edit">
<input name="old_pass" class="form-control" type="hidden" id="old_pass"
    value="<?php echo (!empty($get_enterpriseeditdata->password) ? $get_enterpriseeditdata->password : ''); ?>">
<input type="hidden" name="enterpriseid" id="enterpriseid"
    value="<?php echo (!empty($get_enterpriseeditdata->enterprise_id) ? $get_enterpriseeditdata->enterprise_id : ''); ?>">

<div class="form-group text-right col-sm-5">
    <button type="button" onclick="enterprise_save()"
        class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
</div>
<?php echo form_close(); ?>

<script>
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
});
</script>