<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('website_settngs') ?> </h6>
            <hr>
        </div>
    </div>
    <?php //d($setting); ?>
    <div class="panel-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="subscription_savetitle" class="col-sm-2">Subscription Save Title <i class="text-danger">
                    </i></label>
                <div class="col-sm-9">
                    <input name="subscription_savetitle" class="form-control" type="text"
                        placeholder="Subscription Save Title" id="subscription_savetitle"
                        value="<?php echo ((!empty($setting->subscription_savetitle))  ? $setting->subscription_savetitle : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="anyquestion_title" class="col-sm-2">Any Question Title <i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="anyquestion_title" class="form-control" type="text" placeholder="Any Question Title"
                        id="anyquestion_title"
                        value="<?php echo ((!empty($setting->anyquestion_title))  ? $setting->anyquestion_title : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="footer_text" class="col-sm-2"><?php echo display('footer_text') ?></label>
                <div class="col-sm-9">
                    <textarea name="footer_text" class="form-control" id="footer_text"
                        placeholder="<?php echo display('footer_text') ?>" maxlength="100"
                        rows="7"><?php echo html_escape(!empty($setting->footer_text) ? $setting->footer_text : '') ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="footer_about" class="col-sm-2"><?php echo display('about') ?></label>
                <div class="col-sm-9">
                    <textarea name="footer_about" type="text" class="form-control" id="footer_about"
                        placeholder="<?php echo display('about') ?>"><?php echo html_escape(!empty($setting->footer_about) ? $setting->footer_about : ''); ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="facebook_link" class="col-sm-2"><?php echo display('facebook_link') ?></label>
                <div class="col-sm-9">
                    <input name="facebook_link" type="text" class="form-control" id="facebook_link"
                        placeholder="<?php echo display('facebook_link') ?>"
                        value="<?php echo html_escape(!empty($setting->facebook_link) ? $setting->facebook_link : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="twitter_link" class="col-sm-2"><?php echo display('twitter_link') ?></label>
                <div class="col-sm-9">
                    <input name="twitter_link" type="text" class="form-control" id="twitter_link"
                        placeholder="<?php echo display('twitter_link') ?>"
                        value="<?php echo html_escape(!empty($setting->twitter_link) ? $setting->twitter_link : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="youtube_link" class="col-sm-2"><?php echo display('youtube_link') ?></label>
                <div class="col-sm-9">
                    <input name="youtube_link" type="text" class="form-control" id="youtube_link"
                        placeholder="<?php echo display('youtube_link') ?>"
                        value="<?php echo html_escape(!empty($setting->youtube_link) ? $setting->youtube_link : ''); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="instagram_link" class="col-sm-2"><?php echo display('instagram_link') ?></label>
                <div class="col-sm-9">
                    <input name="instagram_link" type="text" class="form-control" id="instagram_link"
                        placeholder="<?php echo display('instagram_link') ?>"
                        value="<?php echo html_escape(!empty($setting->instagram_link) ? $setting->instagram_link : ''); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="footer_logo" class="col-sm-2">Footer Logo<span class="text-danger f-s-12">( 159×67
                        Formats:png,jpeg,jpeg,svg)</span></label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="footer_logo" id="footer_logo" onchange="fileValueOne(this,'footer_logo')"> -->
                    <input type="hidden" name="old_footer_logo" id="old_footer_logo"
                        value="<?php echo html_escape(!empty($setting->footer_logo) ? $setting->footer_logo : '') ?>">
                    <input type="file" name="footer_logo" id="footer_logo" class="custom-input-file"
                        onchange="fileValueOne(this,'footer_logo')" />
                    <label for="footer_logo">
                        <i class="fa fa-upload"></i>
                        <span
                            class="footerlogo-filename"><?php echo (!empty($setting->footer_logo) ? 'Choosed File' :  display('choose_file'). '...'); ?></span>
                    </label>
                </div>
            </div>
            <?php if (!empty($setting->footer_logo)) { ?>
            <div class="form-group row">
                <label for="logoTwoPreview" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img src="<?php echo base_url(html_escape($setting->footer_logo)) ?>" id="image-preview-footer_logo"
                        alt="Picture" class="img-thumbnail" width="20%" />
                </div>
            </div>
            <?php } ?>
            <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-footer_logo" src="" alt="" class="border border-2" width="200px">
                </div>
            </div>
            <div class="form-group row">
                <label for="anyquestion_picture" class="col-sm-2">Any Question Picture
                    <span class="text-danger f-s-10">( 339×366 ) Formats:(png,jpeg,jpeg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="anyquestion_picture" id="anyquestion_picture" class=""
                        onchange="fileValueOne(this,'anyquestion_picture')" /> -->

                    <input type="hidden" name="old_anyquestion_picture" id="old_anyquestion_picture" class=""
                        value="<?php if(!empty($setting->anyquestion_picture)){ echo html_escape($setting->anyquestion_picture); } ?>" />

                    <input type="file" name="anyquestion_picture" id="anyquestion_picture" class="custom-input-file"
                        onchange="fileValueOne(this,'anyquestion_picture')" />
                    <label for="anyquestion_picture">
                        <i class="fa fa-upload"></i>
                        <span
                            class="anyquestion-filename"><?php echo (!empty($setting->anyquestion_picture) ? 'Choosed File' :  display('choose_file'). '...'); ?></span>
                    </label>
                    <?php if (!empty($setting->anyquestion_picture)) { ?>
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($setting->anyquestion_picture)); ?>"
                            alt="<?php echo html_escape($setting->title); ?>" width="20%"
                            id="image-preview-anyquestion_picture">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-anyquestion_picture" src="" alt="" class="border border-2" width="200px">
                </div>
            </div>


            <div class="form-group row">
                <label for="signin_picture" class="col-sm-2">Signin Picture
                    <span class="text-danger f-s-10">( 344*404 ) Formats:(png,jpeg,jpeg,svg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="signin_picture" id="signin_picture" class=""
                        onchange="fileValueOne(this,'signin_picture')" /> -->
                    <input type="file" name="signin_picture" id="signin_picture" class="custom-input-file"
                        onchange="fileValueOne(this,'signin_picture')" />
                    <label for="signin_picture">
                        <i class="fa fa-upload"></i>
                        <span
                            class="signin-filename"><?php echo (!empty($setting->signin_picture) ? 'Choosed File' :  display('choose_file'). '...'); ?></span>
                    </label>

                    <input type="hidden" name="old_signin_picture" id="old_signin_picture" class=""
                        value="<?php if(!empty($setting->signin_picture)){ echo html_escape($setting->signin_picture); } ?>" />
                    <?php if (!empty($setting->signin_picture)) { ?>
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($setting->signin_picture)); ?>"
                            alt="<?php echo html_escape($setting->title); ?>" width="20%"
                            id="image-preview-signin_picture">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-signin_picture" src="" alt="" class="border border-2" width="200px">
                </div>
            </div>

            <div class="form-group row">
                <label for="signup_picture" class="col-sm-2">Signup Picture
                    <span class="text-danger f-s-10">( 344*404 ) Formats:(png,jpeg,jpeg,svg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="signup_picture" id="signup_pictures" class=""
                        onchange="fileValueOne(this,'signup_picture')" /> -->

                    <input type="file" name="signup_picture" id="signup_pictures" class="custom-input-file"
                        onchange="fileValueOne(this,'signup_picture')" />
                    <label for="signup_pictures">
                        <i class="fa fa-upload"></i>
                        <span
                            class="signup-filename"><?php echo (!empty($setting->signup_picture) ? 'Choosed File' :  display('choose_file'). '...'); ?></span>
                    </label>


                    <input type="hidden" name="old_signup_picture" id="old_signup_picture" class=""
                        value="<?php if(!empty($setting->signup_picture)){ echo html_escape($setting->signup_picture); } ?>" />
                    <?php if (!empty($setting->signup_picture)) { ?>
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($setting->signup_picture)); ?>"
                            alt="<?php echo html_escape($setting->title); ?>" width="20%"
                            id="image-preview-signup_picture">
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-signup_picture" src="" alt="" class="border border-2" width="200px">
                </div>
            </div>
            <div class="offset-3 mb-3 group-end">
                <input type="hidden" id="id" value="<?php echo ((!empty($setting->id))  ? $setting->id : ''); ?>">
                <button type="button" onclick="website_settingupate()"
                    class="btn btn-info w-md m-b-5"><?php echo display('update') ?></button>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $("body").on("change", "#footer_logo", function(e) {
        var filename = e.target.files[0].name;
        $(".footerlogo-filename").text(filename);
    });
    $("body").on("change", "#anyquestion_picture", function(e) {
        var filename = e.target.files[0].name;
        $(".anyquestion-filename").text(filename);
    });
    $("body").on("change", "#signin_picture", function(e) {
        var filename = e.target.files[0].name;
        $(".signin-filename").text(filename);
    });
    $("body").on("change", "#signup_pictures", function(e) {
        var filename = e.target.files[0].name;
        $(".signup-filename").text(filename);
    });
});
</script>