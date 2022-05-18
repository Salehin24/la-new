<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <h5 class="card-header"><?php echo html_escape((!empty($title) ? $title : null)) ?></h5>
            <div class="card-body">
                <?php
                echo form_open_multipart('#', 'class="form-inner"')
                ?>
                <input type="hidden" value="<?php echo (!empty($setting->id) ? $setting->id : ''); ?>" id="id"
                    name="id">

                <div class="form-group row">
                    <label for="title" class="col-sm-3"><?php echo display('application_title') ?> <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-9">
                        <input name="title" type="text" class="form-control" id="title"
                            placeholder="<?php echo display('application_title') ?>"
                            value="<?php echo html_escape(!empty($setting->title) ? $setting->title : ''); ?>">
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="stname" class="col-sm-3"><?php echo "Store Name"; ?></label>
                    <div class="col-sm-9">
                        <input name="stname" type="text" class="form-control" id="stname"
                            placeholder="<?php echo "Store Name"; ?>"
                            value="<?php echo html_escape(!empty($setting->storename) ? $setting->storename : ''); ?>">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="address" class="col-sm-3"><?php echo display('address') ?></label>
                    <div class="col-sm-9">
                        <input name="address" type="text" class="form-control" id="address"
                            placeholder="<?php echo display('address') ?>"
                            value="<?php echo html_escape(!empty($setting->address) ? $setting->address : '') ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="settingemail" class="col-sm-3"><?php echo display('email') ?></label>
                    <div class="col-sm-9">
                        <input name="email" type="text" class="form-control" id="settingemail"
                            placeholder="<?php echo display('email') ?>"
                            value="<?php echo html_escape(!empty($setting->email) ? $setting->email : '') ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-3"><?php echo display('phone') ?></label>
                    <div class="col-sm-9">
                        <input name="phone" type="number" class="form-control" id="phone"
                            placeholder="<?php echo display('phone') ?>"
                            value="<?php echo html_escape((!empty($setting->phone) ? $setting->phone : '')) ?>">
                    </div>
                </div>

                <?php if (!empty($setting->favicon)) { ?>
                <div class="form-group row">
                    <label for="faviconPreview" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->favicon)) ?>" alt="Favicon"
                            class="img-thumbnail" />
                    </div>
                </div>
                <?php } ?>

                <div class="form-group row">
                    <label for="favicon" class="col-sm-3"><?php echo display('favicon') ?>   <span class="text-danger">Formats:(png,jpeg,jpeg,svg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="favicon" id="favicon">
                        <input type="hidden" name="old_favicon" id="old_favicon"
                            value="<?php echo html_escape(!empty($setting->favicon) ? $setting->favicon : '') ?>">
                    </div>
                </div>

                <?php if (!empty($setting->logo)) { ?>
                <div class="form-group row">
                    <label for="logoPreview" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->logo)) ?>" alt="Picture"
                            class="img-thumbnail" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="logo" class="col-sm-3"><?php echo display('backend_logo') ?><span class="text-danger">(
                            150×50 Formats:png,jpeg,svg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="logo" id="logo">
                        <input type="hidden" name="old_logo" id="old_logo"
                            value="<?php echo html_escape(!empty($setting->logo) ? $setting->logo : '') ?>">
                    </div>
                </div>
                <?php if (!empty($setting->logoTwo)) { ?>
                <div class="form-group row">
                    <label for="logoTwoPreview" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->logoTwo)) ?>" id="logoTwoPreview"
                            alt="Picture" class="img-thumbnail" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="logoTwo" class="col-sm-3"><?php echo display('website_logo'); ?><span
                            class="text-danger f-s-12">( 150×50  Formats: png,jpeg,jpeg,svg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="logoTwo" id="logoTwo">
                        <input type="hidden" name="old_logoTwo" id="old_logoTwo"
                            value="<?php echo html_escape(!empty($setting->logoTwo) ? $setting->logoTwo : '') ?>">
                    </div>
                </div>
              
                <?php if (!empty($setting->logoThree)) { ?>
                <div class="form-group row">
                    <label for="logoThreePreview" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->logoThree)) ?>" id="logoThreePreview"
                            alt="Picture" class="img-thumbnail" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="logoThree" class="col-sm-3"><?php echo display('login_logo') ?><span
                            class="text-danger f-s-12">( 150×50  Formats:png,jpeg,jpeg,svg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="logoThree" id="logoThree">
                        <input type="hidden" name="old_logoThree" id="old_logoThree"
                            value="<?php echo html_escape(!empty($setting->logoThree) ? $setting->logoThree : '') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-sm-3"><?php echo display('ready_subscription_area') ?></label>
                    <div class="col-sm-9">
                        <div class="checkbox checkbox-success">
                            <input id="is_ready_subscription" type="checkbox" name="is_ready_subscription" value="<?php echo (!empty(@$setting->is_ready_subscription) ? $setting->is_ready_subscription : 0); ?>" <?php echo ((@$setting->is_ready_subscription == 1) ? 'checked' : ''); ?>>
                            <label for="is_ready_subscription"><?php echo display('is_ready'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency" class="col-sm-3"><?php echo display('currency') ?></label>
                    <div class="col-sm-9">
                        <select name="currency" id="currency" class="form-control" data-placeholder="">
                            <option value="">-- select one --</option>
                            <?php foreach ($currencyList as $currency) { ?>
                            <option value="<?php echo html_escape($currency->curr_icon); ?>" <?php
                                if (@$setting->currency == $currency->curr_icon) {
                                    echo 'selected';
                                }
                                ?>>
                                <?php echo html_escape($currency->currencyname); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="currency_position" class="col-sm-3"><?php echo display('currency_position') ?></label>
                    <div class="col-sm-9">
                        <select name="currency_position" id="currency_position" class="form-control"
                            data-placeholder="">
                            <option value="">-- select one --</option>
                            <option value="1" <?php
                            if ($setting->currency_position == 1) {
                                echo 'selected';
                            }
                            ?>><?php echo display('left'); ?></option>
                            <option value="2" <?php
                            if ($setting->currency_position == 2) {
                                echo 'selected';
                            }
                            ?>><?php echo display('right'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="language" class="col-sm-3"><?php echo display('language') ?></label>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('language', $languageList, html_escape(!empty($setting->language) ? $setting->language : ''), 'class="form-control placeholder-single" id="language"') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateformat" class="col-sm-3"><?php echo display('date_format'); ?></label>
                    <div class="col-sm-9">
                        <select class="form-control placeholder-single" name="timeformat" id="dateformat">
                            <option value=""><?php echo display('date_format') ?></option>
                            <option value="d/m/Y" <?php echo (@$setting->dateformat == "d/m/Y" ? 'selected' : ''); ?>>
                                dd/mm/yyyy</option>
                            <option value="Y/m/d" <?php echo (@$setting->dateformat == "Y/m/d" ? 'selected' : ''); ?>>
                                yyyy/mm/dd</option>
                            <option value="d-m-Y" <?php echo (@$setting->dateformat == "d-m-Y" ? 'selected' : ''); ?>>
                                dd-mm-yyyy</option>
                            <option value="Y-m-d" <?php echo (@$setting->dateformat == "Y-m-d" ? 'selected' : ''); ?>>
                                yyyy-mm-dd</option>
                            <option value="m/d/Y" <?php echo (@$setting->dateformat == "m/d/Y" ? 'selected' : ''); ?>>
                                mm/dd/yyyy</option>
                            <option value="d M,Y" <?php echo (@$setting->dateformat == "d M,Y" ? "selected" : ''); ?>>dd
                                M,yyyy</option>
                            <option value="d F,Y" <?php echo (@$setting->dateformat == "d F,Y" ? "selected" : ''); ?>>dd
                                MM,yyyy</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="site_align" class="col-sm-3"><?php echo display('site_align') ?></label>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')), html_escape(!empty($setting->site_align) ? 'selected' : ''), 'class="selectpicker placeholder-single form-control" data-live-search="true" id="site_align"') ?>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="youtube_api_key" class="col-sm-3"><?php echo display('youtube_api_key') ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="youtube_api_key" id="youtube_api_key" class="form-control"
                            value="<?php echo html_escape(!empty($setting->youtube_api_key) ? $setting->youtube_api_key : ''); ?>"
                            placeholder="<?php echo display('youtube_api_key'); ?>">
                    </div>
                    <div class="col-sm-1">
                        <a href="https://developers.google.com/youtube/v3/getting-started" class="btn btn-success w-45"
                            target="_new">Go</a>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="vimeo_api_key" class="col-sm-3"><?php echo display('vimeo_api_key') ?></label>
                    <div class="col-sm-8">
                        <input type="text" name="vimeo_api_key" id="vimeo_api_key" class="form-control"
                            value="<?php echo html_escape(!empty($setting->vimeo_api_key) ? $setting->vimeo_api_key : ''); ?>"
                            placeholder="<?php echo display('vimeo_api_key'); ?>">
                    </div>
                    <div class="col-sm-1">
                        <a href="https://www.youtube.com/watch?v=Wwy9aibAd54" class="btn btn-success w-45"
                            target="_new">Go</a>
                    </div>
                </div>
                <?php //if (!empty($setting->apps_logo)) { ?>
                <!-- <div class="form-group row">
                    <label for="apps_logo" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->apps_logo)) ?>" alt="Picture"
                            class="img-thumbnail appslogo_preview" />
                    </div>
                </div> -->
                <?php //} ?>
                <!-- <div class="form-group row">
                    <label for="appslogo" class="col-sm-3"><?php echo display('apps_logo') ?><span
                            class="text-danger f-s-10">( 150×150 )</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="appslogo" id="appslogo">
                        <input type="hidden" name="old_apps_logo" id="old_apps_logo"
                            value="<?php echo html_escape(!empty($setting->apps_logo) ? $setting->apps_logo : ''); ?>">
                    </div>
                </div> -->
                <!-- <div class="form-group row">
                    <label for="apps_url" class="col-sm-3"><?php echo display('apps_url') ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="apps_url" id="apps_url" class="form-control"
                            value="<?php //echo (!empty($setting->apps_url) ? $setting->apps_url : ''); ?>" placeholder="<?php echo display('apps_url'); ?>">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="header_color" class="col-sm-3"><?php echo display('header_color') ?></label>
                    <div class="col-sm-9">
                        <input type="color" name="header_color" id="header_color" class="form-control"
                            value="<?php echo (!empty($setting->header_color) ? $setting->header_color : ''); ?>" placeholder="<?php echo display('header_color'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sidebar_color" class="col-sm-3"><?php echo display('sidebar_color') ?></label>
                    <div class="col-sm-9">
                        <input type="color" name="sidebar_color" id="sidebar_color" class="form-control"
                            value="<?php echo (!empty($setting->sidebar_color) ? $setting->sidebar_color : ''); ?>" placeholder="<?php echo display('sidebar_color'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sidebar_activecolor" class="col-sm-3"><?php echo display('sidebar_active_color') ?></label>
                    <div class="col-sm-9">
                        <input type="color" name="sidebar_activecolor" id="sidebar_activecolor" class="form-control"
                            value="<?php echo (!empty($setting->sidebar_activecolor) ? $setting->sidebar_activecolor : ''); ?>" placeholder="<?php echo display('sidebar_active_color'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="button_color" class="col-sm-3"><?php echo display('button_color') ?></label>
                    <div class="col-sm-9">
                        <input type="color" name="button_color" id="button_color" class="form-control"
                            value="<?php echo (!empty($setting->button_color) ? $setting->button_color : ''); ?>" placeholder="<?php echo display('button_color'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="footer_color" class="col-sm-3"><?php echo display('footer_color') ?></label>
                    <div class="col-sm-9">
                        <input type="color" name="footer_color" id="footer_color" class="form-control"
                            value="<?php echo (!empty($setting->footer_color) ? $setting->footer_color : ''); ?>" placeholder="<?php echo display('footer_color'); ?>">
                    </div>
                </div>
                <?php if (!empty($setting->course_header_image)) { ?>
                <div class="form-group row">
                    <label for="course_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->course_header_image)) ?>" alt="Picture"
                            class="img-thumbnail course_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="course_header_image" class="col-sm-3"><?php echo "Search page header image" //display('course_header_image'); ?><span
                            class="text-danger f-s-10">( 1296x176 Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="course_header_image" id="course_header_image" class="form-control">
                        <input type="hidden" name="old_course_header_image" id="old_course_header_image"
                            value="<?php echo html_escape((!empty($setting->course_header_image) ? $setting->course_header_image : '')) ?>">
                    </div>
                </div>
                <?php if (!empty($setting->lead_featured_image)) { ?>
                <div class="form-group row">
                    <label for="faculty_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->lead_featured_image)) ?>" alt="Picture"
                            class="img-thumbnail faculty_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="faculty_header_image"
                        class="col-sm-3"><?php echo display('lead_featured_image'); ?><span
                            class="text-danger f-s-10">( 710×480 Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="faculty_header_image" id="faculty_header_image" class="form-control">
                        <input type="hidden" name="old_faculty_header_image" id="old_faculty_header_image"
                            value="<?php echo html_escape((!empty($setting->lead_featured_image) ? $setting->lead_featured_image : '')); ?>">
                    </div>
                </div>
                <?php //if (!empty($setting->cart_header_image)) { ?>
                <!-- <div class="form-group row">
                    <label for="cart_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->cart_header_image)) ?>" alt="Picture"
                            class="img-thumbnail cart_header_image_preview" />
                    </div>
                </div> -->
                <?php //} ?>
                <!-- <div class="form-group row">
                    <label for="cart_header_image" class="col-sm-3"><?php echo display('cart_header_image'); ?><span
                            class="text-danger f-s-10">( 1520×620 )</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="cart_header_image" id="cart_header_image" class="form-control">
                        <input type="hidden" name="old_cart_header_image" id="old_cart_header_image"
                            value="<?php echo html_escape((!empty($setting->cart_header_image) ? $setting->cart_header_image : '')) ?>">
                    </div>
                </div> -->
                <!-- <?php if (!empty($setting->checkout_header_image)) { ?>
                <div class="form-group row">
                    <label for="checkout_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->checkout_header_image)) ?>" alt="Picture"
                            class="img-thumbnail checkout_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="checkout_header_image"
                        class="col-sm-3"><?php echo display('checkout_header_image'); ?><span
                            class="text-danger f-s-10">( 1520×620 )</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="checkout_header_image" id="checkout_header_image" class="form-control">
                        <input type="hidden" name="old_checkout_header_image" id="old_checkout_header_image"
                            value="<?php echo html_escape(!empty($setting->checkout_header_image) ? $setting->checkout_header_image : '') ?>">
                    </div>
                </div> -->
                <?php if (!empty($setting->profile_header_image)) { ?>
                <div class="form-group row">
                    <label for="profile_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->profile_header_image)) ?>" alt="Picture"
                            class="img-thumbnail profile_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="profile_header_image"
                        class="col-sm-3"><?php echo display('profile_header_image'); ?><span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="profile_header_image" id="profile_header_image" class="form-control">
                        <input type="hidden" name="old_profile_header_image" id="old_profile_header_image"
                            value="<?php echo html_escape(!empty($setting->profile_header_image) ? $setting->profile_header_image : '') ?>">
                    </div>
                </div>

                <?php if (!empty($setting->faq_header_image)) { ?>
                <div class="form-group row">
                    <label for="faq_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->faq_header_image)) ?>" alt="Picture"
                            class="img-thumbnail faq_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="profile_header_image"
                        class="col-sm-3">Faq Header Image<span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="faq_header_image" id="faq_header_image" class="form-control">
                        <input type="hidden" name="old_faq_header_image" id="old_faq_header_image"
                            value="<?php echo html_escape(!empty($setting->faq_header_image) ? $setting->faq_header_image : '') ?>">
                    </div>
                </div>
                <?php if (!empty($setting->project_header_image)) { ?>
                <div class="form-group row">
                    <label for="project_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->project_header_image)) ?>" alt="Picture"
                            class="img-thumbnail project_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="project_header_image"
                        class="col-sm-3">Project Header Image<span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="project_header_image" id="project_header_image" class="form-control">
                        <input type="hidden" name="old_project_header_image" id="old_project_header_image"
                            value="<?php echo html_escape(!empty($setting->project_header_image) ? $setting->project_header_image : '') ?>">
                    </div>
                </div>
                <?php if (!empty($setting->event_header_image)) { ?>
                <div class="form-group row">
                    <label for="event_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->event_header_image)) ?>" alt="Picture" class="img-thumbnail event_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="event_header_image"
                        class="col-sm-3">Event Header Image<span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="event_header_image" id="event_header_image" class="form-control">
                        <input type="hidden" name="old_event_header_image" id="old_event_header_image"
                            value="<?php echo html_escape(!empty($setting->event_header_image) ? $setting->event_header_image : '') ?>">
                    </div>
                </div>
                
                <?php if (!empty($setting->contactus_header_image)) { ?>
                <div class="form-group row">
                    <label for="contactus_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->contactus_header_image)) ?>" alt="Picture" class="img-thumbnail contactus_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="about_header_image"
                        class="col-sm-3">Contactus Header Image<span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="contactus_header_image" id="contactus_header_image" class="form-control">
                        <input type="hidden" name="old_contactus_header_image" id="old_contactus_header_image"
                            value="<?php echo html_escape(!empty($setting->contactus_header_image) ? $setting->contactus_header_image : '') ?>">
                    </div>
                </div>
                <?php if (!empty($setting->forum_header_image)) { ?>
                <div class="form-group row">
                    <label for="forum_header_image" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->forum_header_image)) ?>" alt="Picture" class="img-thumbnail forum_header_image_preview" />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group row">
                    <label for="forum_header_image"
                        class="col-sm-3">Forum Header Image<span
                            class="text-danger f-s-10">( 1520×620  Formats:png,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="forum_header_image" id="forum_header_image" class="form-control">
                        <input type="hidden" name="old_forum_header_image" id="old_forum_header_image"
                            value="<?php echo html_escape(!empty($setting->forum_header_image) ? $setting->forum_header_image : '') ?>">
                    </div>
                </div>



                <?php //if (!empty($setting->docusign_sample)) { ?>
                <!-- <div class="form-group row">
                    <label for="docusign_sample" class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <img src="<?php echo base_url(html_escape($setting->docusign_sample)) ?>" alt="Picture"
                            class="img-thumbnail docusign_sample_preview" />
                            <input type="hidden" name="old_docusign_sample" id="old_docusign_sample"
                            value="<?php echo html_escape(!empty($setting->docusign_sample) ? $setting->docusign_sample : '') ?>">
                    </div>
                </div> -->
                <?php //} ?>
                <div class="form-group row">
                    <label for="docusign_sample"
                        class="col-sm-3"><?php echo display('docusign_sample'); ?><span
                            class="text-danger f-s-10">(Formats:pdf,jpeg,jpeg)</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="docusign_sample" id="docusign_sample" class="form-control">
                        <input type="hidden" name="old_docusign_sample" id="old_docusign_sample"
                            value="<?php echo html_escape(!empty($setting->docusign_sample) ? $setting->docusign_sample : '') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="timezone" class="col-sm-3"><?php echo display('timezone') ?></label>
                    <div class="col-sm-9">
                        <select name="timezone" id="timezone" class="form-control placeholder-single" required>
                            <option value=""><?php echo display('select_one'); ?></option>
                            <?php foreach (timezone_identifiers_list() as $value) { ?>
                            <option value="<?php echo html_escape($value) ?>"
                                <?php echo html_escape(((@$setting->timezone == $value) ? 'selected' : null)) ?>>
                                <?php echo html_escape($value) ?></option>";
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="power_text" class="col-sm-3"><?php echo display('powered_by_text'); ?></label>
                    <div class="col-sm-9">
                        <textarea name="power_text" id="power_text" class="form-control"
                            placeholder="<?php echo display('powered_by_text'); ?>" maxlength="140"
                            rows="7"><?php echo html_escape(!empty($setting->powerbytxt) ? $setting->powerbytxt : '') ?></textarea>
                    </div>
                </div>
                <div class="form-group offset-3 text-right">
                    <button type="button" onclick="appsetting_save()" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>