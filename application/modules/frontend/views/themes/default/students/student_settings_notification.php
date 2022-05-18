<!--Start Student Profile Header-->

<?php
                $this->load->view('dashboard_coverpage');
        ?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php
                $this->load->view('dashboard_topmenu');
        ?>
    </div>
</div>
<!--Student Profile Edit Option-->
<!--Start Student Account Settings-->
<div class="py-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row justify-content-between">
                    <div class="col-md-4 col-lg-3 sticky-content">
                        <h3 class="fw-semi-bold mb-4">Settings</h3>
                        <!--Start Settings Nav-->
                        <?php
                                $this->load->view('setting_menu');
                            ?>
                        <!--End Settings Nav-->
                    </div>
                    <div class="col-md-8 col-lg-8 sticky-content">
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
                            ?>
                        <h3 class="fw-semi-bold">Notifications</h3>
                        <div>Email notifications, on-site notifications, sms notifications</div>
                        <hr>
                        <?php echo form_open_multipart($enterprise_shortname.'/save-setting-notification', 'class="myform" id="myform"'); ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-bottom"></th>
                                    <th class="border-bottom">On site</th>
                                    <th class="border-bottom">Email</th>
                                    <th class="border-bottom">sms</th>
                                </tr>
                            </thead>
                            <?php //d($check_settingnotification); 
                                // if($check_settingnotification){
                                //     echo 'ache';
                                // }else{
                                //     echo 'nai';
                                // }
                            ?>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Notifications on courses
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                    echo (($check_settingnotification->courses_site == 1) ? 'checked' : ''); 
                                                }else{
                                                    echo 'checked';
                                                }
                                                
                                                ?> id="courses_site" name="courses_site">
                                            <label class="form-check-label" for="courses_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php
                                                if($check_settingnotification){
                                                    echo (($check_settingnotification->courses_email == 1) ? 'checked' : ''); 
                                                }else{  
                                                    echo 'checked';
                                                }
                                                ?> id="courses_email" name="courses_email">
                                            <label class="form-check-label" for="courses_email">
                                                <i data-feather="mail"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->courses_sms == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }
                                            ?> id="courses_sms" name="courses_sms">
                                            <label class="form-check-label" for="courses_sms">
                                                <i data-feather="message-square"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Notifications on offers &amp; updates
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->offerupdates_site == 1) ? 'checked' : '');
                                            }else{  
                                                echo 'checked';
                                            }
                                             ?> id="offerupdates_site" name="offerupdates_site">
                                            <label class="form-check-label" for="offerupdates_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->offerupdates_email == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }?> id="offerupdates_email" name="offerupdates_email">
                                            <label class="form-check-label" for="offerupdates_email">
                                                <i data-feather="mail"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->offerupdates_sms == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }
                                                ?> id="offerupdates_sms" name="offerupdates_sms">
                                            <label class="form-check-label" for="offerupdates_sms">
                                                <i data-feather="message-square"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Notifications on blogs
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->blog_site == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }
                                            ?> id="blog_site" name="blog_site">
                                            <label class="form-check-label" for="blog_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php if($check_settingnotification){
                                                     echo (($check_settingnotification->blog_email == 1) ? 'checked' : ''); 
                                                    }else{  
                                                        echo 'checked';
                                                    }
                                                    ?> id="blog_email" name="blog_email">
                                            <label class="form-check-label" for="blog_email">
                                                <i data-feather="mail"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->blog_sms == 1) ? 'checked' : ''); 
                                            }else{
                                                echo 'checked';
                                            }
                                            ?> id="blog_sms" name="blog_sms">
                                            <label class="form-check-label" for="blog_sms">
                                                <i data-feather="message-square"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Notifications on events
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->events_site == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }?> id="events_site" name="events_site">
                                            <label class="form-check-label" for="events_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" <?php 
                                                if($check_settingnotification){
                                                echo (($check_settingnotification->events_email == 1) ? 'checked' : ''); 
                                            }else{  
                                                echo 'checked';
                                            }
                                            ?> id="events_email" name="events_email">
                                            <label class="form-check-label" for="events_email">
                                                <i data-feather="mail"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                <?php if($check_settingnotification){ 
                                                    echo (($check_settingnotification->events_sms == 1) ? 'checked' : '');
                                                }else{  
                                                    echo 'checked';
                                                }
                                                 ?>
                                                id="events_sms" name="events_sms">
                                            <label class="form-check-label" for="events_sms">
                                                <i data-feather="message-square"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th scope="row">
                                        Notifications on community
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                <?php echo ((!empty($check_settingnotification->community_site) == 1) ? 'checked' : ''); ?>
                                                id="community_site" name="community_site">
                                            <label class="form-check-label" for="community_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                <?php echo ((!empty($check_settingnotification->community_email) == 1) ? 'checked' : ''); ?>
                                                id="community_email" name="community_email">
                                            <label class="form-check-label" for="community_email">
                                                <i data-feather="mail"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                <?php echo ((!empty($check_settingnotification->community_sms) == 1) ? 'checked' : ''); ?>
                                                id="community_sms" name="community_sms">
                                            <label class="form-check-label" for="community_sms">
                                                <i data-feather="message-square"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <!-- <th scope="row">
                                        <i data-feather="volume-2" class="me-2"></i>Sound Notifications
                                    </th> 
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                <?php echo ((!empty($check_settingnotification->soundnoti_site) == 1) ? 'checked' : ''); ?>
                                                id="soundnoti_site" name="soundnoti_site">
                                            <label class="form-check-label" for="soundnoti_site">
                                                <i data-feather="bell"></i>
                                            </label>
                                        </div>
                                    </td> -->


                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-dark-cerulean btn-lg"><i data-feather="save"
                                class="me-2"></i>Save</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Student Account Settings-->