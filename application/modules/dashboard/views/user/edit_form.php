<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <?php          //  echo html_escape((!empty($title) ? $title : null));            ?>
            <div class="card-body">
                <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $edit_data->log_id; ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                            class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>"
                            id="edit_name" value="<?php echo html_escape($edit_data->name) ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i
                            class="text-danger"> * </i></label>
                    <div class="col-sm-9">
                        <input name="email" class="form-control" type="text"
                            placeholder="<?php echo display('email') ?>" id="edit_email" onkeyup="existing_mailcheck()"
                            value="<?php echo html_escape($edit_data->email) ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> </label>
                    <div class="col-sm-9">
                        <input name="password" class="form-control" type="password"
                            placeholder="<?php echo display('password') ?>" id="edit_password">
                        <input name="oldpass" class="form-control" type="hidden" id="oldpass"
                            value="<?php echo html_escape($edit_data->password); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile_no" class="col-sm-3 col-form-label"><?php echo display('mobile') ?></label>
                    <div class="col-sm-9">
                        <input name="mobile_no" placeholder="<?php echo display('mobile_no') ?>" class="form-control"
                            id="edit_mobile" value="<?php echo html_escape($edit_data->mobile_no); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile_no" class="col-sm-3 col-form-label"><?php echo display('birthday') ?></label>
                    <div class="col-sm-9">
                        <input name="date_of_birth" class="form-control datepicker" type="text" id="edit_date_of_birth"
                            placeholder="Enter Birthday"
                            value="<?php if ($edit_data->date_of_birth == '0000-00-00') {
                                                                                                                                                            echo date('Y-m-d');
                                                                                                                                                        } else {
                                                                                                                                                            echo html_escape($edit_data->date_of_birth);
                                                                                                                                                        } ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label"><?php echo display('address') ?></label>
                    <div class="col-sm-9">
                        <textarea name="address" placeholder="<?php echo display('address') ?>" class="form-control"
                            id="edit_address"><?php echo html_escape($edit_data->address); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="preview" class="col-sm-3 col-form-label"><?php echo display('preview') ?></label>
                    <div class="col-sm-2 img_border">
                        <img src="<?php echo base_url(!empty($edit_data->image) ? $edit_data->image : "./assets/img/icons/default.jpg") ?>"
                            class="img-thumbnail" width="125" height="100">
                    </div>

                    <div class="col-sm-7">

                    </div>
                    <input type="hidden" name="hdn_image" id="hdn_image"
                        value="<?php echo html_escape($edit_data->image) ?>">
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-2 ">
                        <img id="image-preview-edituser" src="" alt="" class="border border-2" width="200px">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-9">
                        <div>
                            <input type="file" name="edit_image" id="edit_image" class="custom-input-file"
                                onchange="fileValueOne(this,'edituser')" value="" />
                            <label for="edit_image">
                                <i class="fa fa-upload"></i>
                                <span class="editimage-filename"><?php echo display('choose_file'); ?>…</span>
                            </label>
                        </div>
                        <span class="text-danger">Size:( 115×90 ) Formats:(png,jpeg,jpeg,svg,webp)</span>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="button" onclick="update_userinfo()"
                        class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->
</div>
<script>
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
});
$("body").on("change", "#edit_image", function (e) {
      var filename = e.target.files[0].name;
      $(".editimage-filename").text(filename);
    });
</script>