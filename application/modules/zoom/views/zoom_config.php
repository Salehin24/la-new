
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-cogs"> </i> <?php echo (!empty($title) ? $title : null) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname.'/zoom-meeting'); ?>" class="btn btn-primary">
                            <?php echo display('zoom_meeting'); ?>
                        </a>
                    </small>
                </h5>
            </div>
            <div class="card-body">
            <?php echo form_open_multipart(enterpriseinfo()->shortname . '/zoom-config-save', 'class="", id=""'); ?>
                    <div class="form-group row">
                        <label for="zoom_api_key" class="col-sm-3 col-form-label"><?php echo display('zoom_api_key'); ?> <span class="text-danger"> * </span></label>
                        <div class="col-sm-6">
                            <input type="text" name="zoom_api_key" class="form-control" id="zoom_api_key" value="<?php echo (!empty($get_zoomconfigdata->zoom_api_key) ? $get_zoomconfigdata->zoom_api_key : ''); ?>" placeholder="<?php echo display('zoom_api_key'); ?>" tabindex="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zoom_api_secret" class="col-sm-3 col-form-label"><?php echo display('zoom_api_secret'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="zoom_api_secret" class="form-control" id="zoom_api_secret" value="<?php echo (!empty($get_zoomconfigdata->zoom_api_secret) ? $get_zoomconfigdata->zoom_api_secret : ''); ?>" placeholder="<?php echo display('zoom_api_secret'); ?>" tabindex="2">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="meetingid" class="col-sm-3 col-form-label">Meeting ID</label>
                        <div class="col-sm-6">
                            <input type="text" name="meetingid" class="form-control" id="meetingid" value="<?php echo (!empty($get_zoomconfigdata->meetingid) ? $get_zoomconfigdata->meetingid : ''); ?>" placeholder="Meeting ID" tabindex="3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meeting_password" class="col-sm-3 col-form-label">Meeting Password</label>
                        <div class="col-sm-6">
                            <input type="text" name="meeting_password" class="form-control" id="meeting_password" value="<?php echo (!empty($get_zoomconfigdata->meeting_password) ? $get_zoomconfigdata->meeting_password : ''); ?>" placeholder="Meeting Password" tabindex="2">
                        </div>
                    </div> -->
                    
                    <div class="form-group offset-3">
                        <a href="https://marketplace.zoom.us/develop/create" class="btn btn-sm btn-success" target="_new">Go For API Key and Secret Key</a>
                        <a href="https://us04web.zoom.us/profile" class="btn btn-sm btn-primary" target="_new">Meeting ID & Password</a>
                    </div>

                    <div class="form-group offset-3">
                        <input type="hidden" name="id" id="id" value="<?php echo (!empty($get_zoomconfigdata->id) ? $get_zoomconfigdata->id : ''); ?>">
                        <button type="submit" class="btn btn-info w-md m-b-5" onclick=""  tabindex="6"><?php echo display('update'); ?></button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>