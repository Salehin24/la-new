<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h4 class="card-header"><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            <div class="card-body">
                <?php echo form_open_multipart("dashboard/home/profile_update") ?>
                <?php echo form_hidden('id', html_escape($user->log_id)) ?>
              
                <div class="form-group row">
                    <label for="firstname" class="col-sm-3 col-form-label"><?php echo display('name'); ?> <i class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name'); ?>" id="firstname"  value="<?php echo html_escape($user->name) ?>">
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="lastname" class="col-sm-3 col-form-label"><?php echo display('last_name'); ?>  <i class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="lastname" class="form-control" type="text" placeholder="<?php echo display('last_name'); ?>" id="lastname" value="<?php echo html_escape($user->lastname) ?>">
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile'); ?> <i class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile'); ?>" id="mobile" value="<?php echo html_escape($user->mobile) ?>">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label"><?php echo display('email'); ?> <i class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="email" class="form-control" type="text" placeholder="<?php echo display('email'); ?>" id="email" value="<?php echo html_escape($user->email) ?>">
                    </div>
                </div> 

                <!-- <div class="form-group row">
                    <label for="about" class="col-sm-3 col-form-label"><?php echo display('about'); ?> </label>
                    <div class="col-sm-9">
                        <textarea name="about" placeholder="About" class="form-control" id="about"><?php echo html_escape($user->about) ?></textarea>
                    </div>
                </div> -->


                <div class="form-group row">
                    <label for="preview" class="col-sm-3 col-form-label"><?php echo display('preview'); ?> </label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(!empty(html_escape($user->image)) ? html_escape($user->image) : "assets/img/icons/default.png") ?>" class="img-thumbnail" width="125" height="100">
                    </div>
                    <input type="hidden" name="old_image" value="<?php echo html_escape($user->image) ?>">
                </div> 
                <div class="form-group row">
                    <label for="preview" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                    
                    <img id="image-preview-userprofile" src="" alt="" class="border border-2" width="200px">
                    </div>
                 
                </div> 

                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"><?php echo display('image'); ?> </label>
                    <div class="col-sm-9">
                        <input type="file" name="image" id="image" aria-describedby="fileHelp"  onchange="fileValueOne(this,'userprofile')">
                        <small id="fileHelp" class="text-muted"></small>
                    </div>
                </div> 

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5" id="disabled_btn"><?php echo display('save'); ?> </button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>

