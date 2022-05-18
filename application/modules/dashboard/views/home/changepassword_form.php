<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h4 class="card-header"><?php echo (!empty($title) ? $title : null) ?></h4>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="form-group row">
                        <label for="student_email" class="col-4 col-form-label"> <?php echo display('email'); ?></label> 
                        <div class="col-8">
                            <input id="student_email" name="email" placeholder="<?php echo display('email'); ?>" class="form-control here" readonly type="text" value="<?php echo $user->email; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_password" class="col-4 col-form-label"><?php echo display('current_password'); ?></label> 
                        <div class="col-8">
                            <input id="current_password" name="current_password" placeholder="<?php echo display('current_password'); ?>" class="form-control here" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-4 col-form-label"><?php echo display('new_password'); ?></label> 
                        <div class="col-8">
                            <input id="new_password" name="new_password" placeholder="<?php echo display('new_password'); ?>" class="form-control here" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="retype_password" class="col-4 col-form-label"><?php echo display('retype_password'); ?></label> 
                        <div class="col-8">
                            <input id="retype_password" name="retype_password" placeholder="<?php echo display('retype_password'); ?>" class="form-control here" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->log_id; ?>" >
                            <button name="submit" type="submit" class="btn btn-primary" onclick="changepassword()"><?php echo display('update'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/settings.js') ?>"></script>

