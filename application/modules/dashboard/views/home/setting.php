<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/settings.css') ?>">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        $get_settingsmenu = $this->db->select('*')
                ->from('sec_menu_item')
                ->where('parent_menu', 30)
                ->where('status', 1)
                ->where('is_settings', 1)
                ->order_by('ordering', 'asc')
                ->get()->result();
                // d($get_settingsmenu);
        ?>
    </div>
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <?php echo html_escape((!empty($title) ? $title : null)) ?>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="nav flex-column nav-pills custom_tablist">
                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                <!-- <li class="nav-item">
                                    <a class="nav-link active" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true"><?php echo display('add_user'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getuserlist()" id="v-pills-userlist-tab" data-toggle="pill" href="#v-pills-userlist" role="tab" aria-controls="v-pills-userlist" aria-selected="false"><?php echo display('user_list'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link rolepermission_cls" onclick="getrolepermission_form()" id="v-pills-rolepermission-tab" data-toggle="pill" href="#v-pills-rolepermission" role="tab" aria-controls="v-pills-rolepermission" aria-selected="false"><?php echo display('role_permission'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getrolepermission_list()" id="v-pills-rolelist-tab" data-toggle="pill" href="#v-pills-rolelist" role="tab" aria-controls="v-pills-rolelist" aria-selected="false"><?php echo display('role_list'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getassignuserrole()" id="v-pills-assignuserrole-tab" data-toggle="pill" href="#v-pills-assignuserrole" role="tab" aria-controls="v-pills-assignuserrole" aria-selected="false"><?php echo display('assign_user_role'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getassignuserrolelist()" id="v-pills-assignuserrolelist-tab" data-toggle="pill" href="#v-pills-assignuserrolelist" role="tab" aria-controls="v-pills-assignuserrolelist" aria-selected="false"><?php echo display('assign_user_role_list'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getlanguage();" id="v-pills-addlanguage-tab" data-toggle="pill" href="#v-pills-addlanguage" role="tab" aria-controls="v-pills-addlanguage" aria-selected="false"><?php echo display('add_language'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getphrase()" id="v-pills-addphrase-tab" data-toggle="pill" href="#v-pills-addphrase" role="tab" aria-controls="v-pills-addphrase" aria-selected="false"><?php echo display('add_phrase'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getmailconfig()" id="v-pills-mailconfigs-tab" data-toggle="pill" href="#v-pills-mailconfigs" role="tab" aria-controls="v-pills-mailconfigs" aria-selected="false"><?php echo display('mail_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getsmsconfig()" id="v-pills-smsconfigs-tab" data-toggle="pill" href="#v-pills-smsconfigs" role="tab" aria-controls="v-pills-smsconfigs" aria-selected="false"><?php echo display('sms_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getpaymentmethodlist()" id="v-pills-paymentmethodlist-tab" data-toggle="pill" href="#v-pills-paymentmethodlist" role="tab" aria-controls="v-pills-paymentmethodlist" aria-selected="false"><?php echo display('payment_method_list'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getpaypalconfig()" id="v-pills-paypalconfig-tab" data-toggle="pill" href="#v-pills-paypalconfig" role="tab" aria-controls="v-pills-paypalconfig" aria-selected="false"><?php echo display('paypal_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getstripeconfig()" id="v-pills-stripeconfig-tab" data-toggle="pill" href="#v-pills-stripeconfig" role="tab" aria-controls="v-pills-stripeconfig" aria-selected="false"><?php echo display('stripe_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getpayeerconfig()" id="v-pills-payeerconfig-tab" data-toggle="pill" href="#v-pills-payeerconfig" role="tab" aria-controls="v-pills-payeerconfig" aria-selected="false"><?php echo display('payeer_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getpayuconfig()" id="v-pills-payuconfig-tab" data-toggle="pill" href="#v-pills-payuconfig" role="tab" aria-controls="v-pills-payuconfig" aria-selected="false"><?php echo display('payu_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getpusherconfig()" id="v-pills-pusherconfig-tab" data-toggle="pill" href="#v-pills-pusherconfig" role="tab" aria-controls="v-pills-pusherconfig" aria-selected="false"><?php echo display('pusher_config'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getsubscriberlist()" id="v-pills-subscriberlist-tab" data-toggle="pill" href="#v-pills-subscriberlist" role="tab" aria-controls="v-pills-subscriberlist" aria-selected="false"><?php echo display('subscriber_list'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getcompanies()" id="v-pills-companies-tab" data-toggle="pill" href="#v-pills-companies" role="tab" aria-controls="v-pills-companies" aria-selected="false"><?php echo display('companies'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getteammembers()" id="v-pills-teammembers-tab" data-toggle="pill" href="#v-pills-teammembers" role="tab" aria-controls="v-pills-teammembers" aria-selected="false"><?php echo display('team_members'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getaboutus()" id="v-pills-aboutus-tab" data-toggle="pill" href="#v-pills-aboutus" role="tab" aria-controls="v-pills-aboutus" aria-selected="false"><?php echo display('about_us'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getprivacypolicy()" id="v-pills-privacypolicy-tab" data-toggle="pill" href="#v-pills-privacypolicy" role="tab" aria-controls="v-pills-privacypolicy" aria-selected="false"><?php echo display('privacy_policy'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="gettermscondition()" id="v-pills-termscondition-tab" data-toggle="pill" href="#v-pills-termscondition" role="tab" aria-controls="v-pills-termscondition" aria-selected="false"><?php echo display('terms_condition'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getslider()" id="v-pills-slider-tab" data-toggle="pill" href="#v-pills-slider" role="tab" aria-controls="v-pills-slider" aria-selected="false"><?php echo display('sliders'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getcurrency()" id="v-pills-currency-tab" data-toggle="pill" href="#v-pills-currency" role="tab" aria-controls="v-pills-currency" aria-selected="false"><?php echo display('currency'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" onclick="getappsetting()" id="v-pills-appsetting-tab" data-toggle="pill" href="#v-pills-appsetting" role="tab" aria-controls="v-pills-appsetting" aria-selected="false"><?php echo display('application_setting'); ?></a>
                                </li> -->



                                <?php
                                $sl = 0;
                                foreach ($get_settingsmenu as $menu) {
                                    $sl++;
                                    if ($sl == 1) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    if ($this->permission->check_label($menu->menu_title)->access()) {
                                        // if (get_usertype() != 1) {
                                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $active; ?>"
                                        onclick="<?php echo $menu->page_url; ?>()"
                                        id="v-pills-<?php echo "menu_" . $menu->menu_id; ?>-tab" data-toggle="pill"
                                        href="#v-pills-<?php echo "menu_" . $menu->menu_id; ?>" role="tab"
                                        aria-controls="v-pills-<?php echo "menu_" . $menu->menu_id; ?>"
                                        aria-selected="false"><?php echo display($menu->menu_title); ?></a>
                                </li>
                                <?php
                                        // } elseif (get_usertype() == 1) {
                                        //     if ($menu->page_url != 'add_user' && $menu->page_url != 'getaboutus' && $menu->page_url != 'getfeature' && $menu->page_url != 'getnotice' && $menu->page_url != 'getprivacypolicy' && $menu->page_url != 'gettermscondition' && $menu->page_url != 'getslider' && $menu->page_url != 'getcurrency' && $menu->page_url != 'certificateconfig') {
                                                ?>
                                <!-- <li class="nav-item">
                                                    <a class="nav-link <?php //echo $active; ?>"  onclick="<?php //echo $menu->page_url; ?>()" id="v-pills-<?php //echo "menu_" . $sl; ?>-tab" data-toggle="pill" href="#v-pills-<?php //echo "menu_" . $sl; ?>" role="tab" aria-controls="v-pills-<?php //echo "menu_" . $sl; ?>" aria-selected="false"><?php //echo display($menu->menu_title); ?></a>
                                                </li> -->
                                <?php
                                        //     }
                                        // }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-9 p-15">
                        <div class="tab-content" id="v-pills-tabContent">

                            <?php
                            $sl = 0;
                            foreach ($get_settingsmenu as $menu) {
                                $sl++;
                                $p_sl = $sl - 1;
                                if ($sl == 1) {
                                    // if (get_usertype() != 1) {
                                        ?>
                            <div class="tab-pane fade show active" id="v-pills-<?php echo "menu_" . $menu->menu_id; ?>"
                                role="tabpanel" aria-labelledby="v-pills-<?php echo "menu_" . $menu->menu_id; ?>-tab">
                                <h4><?php echo display('add_user'); ?></h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2"><?php echo display('name') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="name" class="form-control" type="text"
                                            placeholder="<?php echo display('name') ?>" id="name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2"><?php echo display('email') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" type="text"
                                            placeholder="<?php echo display('email') ?>" id="email"
                                            onchange="existing_mailcheck()" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2"><?php echo display('password') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="password" class="form-control" type="password"
                                            placeholder="<?php echo display('password') ?>" id="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile_no" class="col-sm-2"><?php echo display('mobile') ?></label>
                                    <div class="col-sm-9">
                                        <input name="mobile_no" class="form-control" type="text"
                                            placeholder="<?php echo display('mobile') ?>" id="mobile_no" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dateofbirth" class="col-sm-2"><?php echo display('birthday') ?></label>
                                    <div class="col-sm-9">
                                        <input name="date_of_birth" class="form-control datepicker" type="text"
                                            id="date_of_birth" placeholder="Enter Birthday">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2"><?php echo display('address') ?></label>
                                    <div class="col-sm-9">
                                        <textarea name="address" type='text'
                                            placeholder="<?php echo display('address') ?>" class="form-control"
                                            id="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2"><?php echo display('image') ?></label>
                                    <div class="col-sm-9">
                                        <div>
                                            <input type="file" name="image" id="image" class="custom-input-file"
                                                onchange="fileValueOne(this,'user')" />
                                            <label for="image">
                                                <i class="fa fa-upload"></i>
                                                <span class="image-filename"><?php echo display('choose_file'); ?>…</span>
                                            </label>
                                            <span class="text-danger">Size:( 115×90 ) Formats:(png,jpeg,jpeg,svg,webp)</span>
                                            <br>
                                            <img id="image-preview-user" src="" alt="" class="border border-2"
                                                width="200px">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2"><?php echo display('status'); ?><i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="active" class="status" name="status" value="1"
                                                checked>
                                            <label for="active"> <?php echo display('active'); ?> </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="inactive" class="status" name="status" value="0">
                                            <label for="inactive"><?php echo display('inactive'); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="offset-2 mb-3 group-end">
                                    <button type="button" class="btn btn-info w-md m-b-5"
                                        onclick="user_save()"><?php echo display('save') ?></button>
                                </div>
                            </div>
                            <?php
                                    // }
                                } else {
                                    ?>
                            <div class="tab-pane fade" id="v-pills-<?php echo "menu_" . $menu->menu_id; ?>"
                                role="tabpanel" aria-labelledby="v-pills-<?php echo "menu_" . $menu->menu_id; ?>-tab">
                                <div class="<?php echo $menu->menu_title; ?>show"></div><br>

                            </div>
                            <?php } ?>
                            <?php } ?>


                            <!-- <div class="tab-pane fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                                <h4><?php //echo display('add_user'); ?></h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2"><?php echo display('name') ?> <i class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2"><?php echo display('email') ?> <i class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email" onkeyup="existing_mailcheck()" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2"><?php echo display('password') ?> <i class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile_no" class="col-sm-2"><?php echo display('mobile') ?></label>
                                    <div class="col-sm-9">
                                        <input name="mobile_no" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile_no" onkeyup="existing_mailcheck()" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dateofbirth" class="col-sm-2"><?php echo display('birthday') ?></label>
                                    <div class="col-sm-9">
                                        <input name="date_of_birth" class="form-control datepicker" type="text" id="date_of_birth" placeholder="Enter Birthday">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2"><?php echo display('address') ?></label>
                                    <div class="col-sm-9">
                                        <textarea name="address" type='text' placeholder="<?php echo display('address') ?>" class="form-control" id="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2"><?php echo display('image') ?></label>
                                    <div class="col-sm-9">
                                        <div>
                                            <input type="file" name="image" id="image" class="custom-input-file" />
                                            <label for="image">
                                                <i class="fa fa-upload"></i>
                                                <span><?php echo display('choose_file'); ?>…</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2"><?php echo display('status'); ?><i class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="active" class="status" name="status" value="1" checked>
                                            <label for="active"> <?php echo display('active'); ?> </label> &nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="inactive" class="status" name="status" value="0">
                                            <label for="inactive"><?php echo display('inactive'); ?></label>
                                        </div>
                                    </div>
                                </div> -->

                            <!-- <div class="offset-2 mb-3 group-end">
                                    <button type="button" class="btn btn-info w-md m-b-5" onclick="user_save()"><?php echo display('save') ?></button>
                                    <a class="btn btn-success btnNext " id="v-pills-userlist-tab" data-toggle="pill" href="#v-pills-userlist"><?php echo display('next'); ?></a>
                                </div> -->
                        </div>

                        <!-- <div class="tab-pane fade" id="v-pills-userlist" role="tabpanel" aria-labelledby="v-pills-userlist-tab">
                                <div class="userlistshow">
                                </div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-rolepermission-tab" data-toggle="pill" href="#v-pills-rolepermission"><?php echo display('next'); ?></a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-rolepermission" role="tabpanel" aria-labelledby="v-pills-rolepermission-tab">
                                <?php echo form_open_multipart('dashboard/role/save_create', 'class="myform" id="myform"'); ?>
                                <div class="rolepermissionfrm_show">

                                </div>
                                <br>
                                <?php echo form_close(); ?>
                                <div class="offset-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-userlist-tab" data-toggle="pill" href="#v-pills-userlist"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-rolelist-tab" data-toggle="pill" href="#v-pills-rolelist"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-rolelist" role="tabpanel" aria-labelledby="v-pills-rolelist-tab">
                                <div class="rolepermissionlist_show"></div><br>

                                <div class="offset-3 group-end">
                                    <a class="btn btn-danger btnPrevious" onclick="getrolepermission_form()" id="v-pills-rolepermission-tab" data-toggle="pill" href="#v-pills-rolepermission"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-assignuserrole-tab" data-toggle="pill" href="#v-pills-assignuserrole"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-assignuserrole" role="tabpanel" aria-labelledby="v-pills-assignuserrole-tab">
                                <div class="assignuserrole_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-rolelist-tab" data-toggle="pill" href="#v-pills-rolelist"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-assignuserrolelist-tab" data-toggle="pill" href="#v-pills-assignuserrolelist"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-assignuserrolelist" role="tabpanel" aria-labelledby="v-pills-assignuserrolelist-tab">
                                <div class="assignuserrolelist_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-assignuserrole-tab" data-toggle="pill" href="#v-pills-assignuserrole"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-addlanguage-tab" data-toggle="pill" href="#v-pills-addlanguage"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-addlanguage" role="tabpanel" aria-labelledby="v-pills-addlanguage-tab">
                                <div class="addlanguage_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-assignuserrolelist-tab" data-toggle="pill" href="#v-pills-assignuserrolelist"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-addphrase-tab" data-toggle="pill" href="#v-pills-addphrase"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-addphrase" role="tabpanel" aria-labelledby="v-pills-addphrase-tab">
                                <div class="addphrase_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-addlanguage-tab" data-toggle="pill" href="#v-pills-addlanguage"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-mailconfigs-tab" data-toggle="pill" href="#v-pills-mailconfigs"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-mailconfigs" role="tabpanel" aria-labelledby="v-pills-mailconfigs-tab">
                                <div class="mailconfigs_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-addphrase-tab" data-toggle="pill" href="#v-pills-addphrase"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-smsconfigs-tab" data-toggle="pill" href="#v-pills-smsconfigs"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-smsconfigs" role="tabpanel" aria-labelledby="v-pills-smsconfigs-tab">
                                <div class="smsconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-mailconfigs-tab" data-toggle="pill" href="#v-pills-mailconfigs"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-paymentmethodlist-tab" data-toggle="pill" href="#v-pills-paymentmethodlist"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-paymentmethodlist" role="tabpanel" aria-labelledby="v-pills-paymentmethodlist-tab">
                                <div class="paymentmethod_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-smsconfigs-tab" data-toggle="pill" href="#v-pills-smsconfigs"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-paypalconfig-tab" data-toggle="pill" href="#v-pills-paypalconfig"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-paypalconfig" role="tabpanel" aria-labelledby="v-pills-paypalconfig-tab">
                                <div class="paypalconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-paymentmethodlist-tab" data-toggle="pill" href="#v-pills-paymentmethodlist"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-stripeconfig-tab" data-toggle="pill" href="#v-pills-stripeconfig"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-stripeconfig" role="tabpanel" aria-labelledby="v-pills-stripeconfig-tab">
                                <div class="stripeconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-paypalconfig-tab" data-toggle="pill" href="#v-pills-paypalconfig"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-payeerconfig-tab" data-toggle="pill" href="#v-pills-payeerconfig"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-payeerconfig" role="tabpanel" aria-labelledby="v-pills-payeerconfig-tab">
                                <div class="payeerconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-stripeconfig-tab" data-toggle="pill" href="#v-pills-stripeconfig"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-payuconfig-tab" data-toggle="pill" href="#v-pills-payuconfig"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-payuconfig" role="tabpanel" aria-labelledby="v-pills-payuconfig-tab">
                                <div class="payuconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-payeerconfig-tab" data-toggle="pill" href="#v-pills-payeerconfig"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-pusherconfig-tab" data-toggle="pill" href="#v-pills-pusherconfig"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-pusherconfig" role="tabpanel" aria-labelledby="v-pills-pusherconfig-tab">
                                <div class="pusherconfig_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-payuconfig-tab" data-toggle="pill" href="#v-pills-payuconfig"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-subscriberlist-tab" data-toggle="pill" href="#v-pills-subscriberlist"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-subscriberlist" role="tabpanel" aria-labelledby="v-pills-subscriberlist-tab">
                                <div class="subscriberlist_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-pusherconfig-tab" data-toggle="pill" href="#v-pills-pusherconfig"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-companies-tab" data-toggle="pill" href="#v-pills-companies"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-companies" role="tabpanel" aria-labelledby="v-pills-companies-tab">
                                <div class="companies_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-subscriberlist-tab" data-toggle="pill" href="#v-pills-subscriberlist"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-teammembers-tab" data-toggle="pill" href="#v-pills-teammembers"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-teammembers" role="tabpanel" aria-labelledby="v-pills-teammembers-tab">
                                <div class="teammembers_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-companies-tab" data-toggle="pill" href="#v-pills-companies"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-aboutus-tab" data-toggle="pill" href="#v-pills-aboutus"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-aboutus" role="tabpanel" aria-labelledby="v-pills-aboutus-tab">
                                <div class="aboutus_show"></div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-teammembers-tab" data-toggle="pill" href="#v-pills-teammembers"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-privacypolicy-tab" data-toggle="pill" href="#v-pills-privacypolicy"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-privacypolicy" role="tabpanel" aria-labelledby="v-pills-privacypolicy-tab">
                                <div class="privacypolicy_show"></div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-aboutus-tab" data-toggle="pill" href="#v-pills-aboutus"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-termscondition-tab" data-toggle="pill" href="#v-pills-termscondition"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-termscondition" role="tabpanel" aria-labelledby="v-pills-termscondition-tab">
                                <div class="termscondition_show"></div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-privacypolicy-tab" data-toggle="pill" href="#v-pills-privacypolicy"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-slider-tab" data-toggle="pill" href="#v-pills-slider"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-slider" role="tabpanel" aria-labelledby="v-pills-slider-tab">
                                <div class="slider_show"></div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-termscondition-tab" data-toggle="pill" href="#v-pills-termscondition"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-currency-tab" data-toggle="pill" href="#v-pills-currency"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-currency" role="tabpanel" aria-labelledby="v-pills-currency-tab">
                                <div class="currency_show"></div><br>
                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-slider-tab" data-toggle="pill" href="#v-pills-slider"><?php echo display('previous'); ?></a>
                                    <a class="btn btn-success btnNext" id="v-pills-appsetting-tab" data-toggle="pill" href="#v-pills-appsetting"><?php echo display('next'); ?></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-appsetting" role="tabpanel" aria-labelledby="v-pills-appsetting-tab">
                                <div class="appsetting_show"></div><br>

                                <div class="offset-3 mb-3 group-end">
                                    <a class="btn btn-danger btnPrevious" id="v-pills-currency-tab" data-toggle="pill" href="#v-pills-currency"><?php echo display('previous'); ?></a>
                                </div>
                            </div> 
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inline form -->
</div>
<input type="hidden" id="uri" value="<?php echo $this->uri->segment('3'); ?>">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/settings.js') ?>"></script>

<script>
$(document).ready(function() {
    $("body").on("change", "#image", function(e) {
        var filename = e.target.files[0].name;
        $(".image-filename").text(filename);
    });
});
</script>