<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        ?>
    </div>
    <!-- Inline form -->
</div> 
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?>
                    <small class="float-right">
                        <?php // if ($this->permission->check_label('category')->create()->access()) { ?>
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/enterprise-list'); ?>" class="btn btn-success">
                            <?php
                            echo display('enterprise_list');
                            ?>
                        </a>
                        <?php // }   ?>
                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="result_load">
                    <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile" onkeyup="onlynumber_allow(this.value, 'mobile')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateofbirth" class="col-sm-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="dateofbirth" class="form-control datepicker" type="text"  id="dateofbirth" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label"><?php echo display('username') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="username" class="form-control" type="text" placeholder="<?php echo display('username') ?>" id="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="student_capacity" class="col-sm-3 col-form-label"><?php echo display('student_capacity') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="capacity" class="form-control" type="number" id="student_capacity" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instructor_capacity" class="col-sm-3 col-form-label"><?php echo display('instructor_capacity') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <input name="instructor_capacity" class="form-control" type="number" id="instructor_capacity" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-3 col-form-label"><?php echo display('role_assign') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-5">
                            <select class="form-control placeholder-single" id="role_id" name="role_id" data-placeholder="<?php echo display('select_one'); ?>" multiple>
                                <option value=""></option>    
                                <?php foreach ($get_rolepermission as $role) { ?>
                                    <option value="<?php echo $role->role_id; ?>">
                                        <?php echo $role->role_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-right col-sm-5">
                        <button type="button" onclick="enterprise_save()" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/enterprise.js') ?>"></script>