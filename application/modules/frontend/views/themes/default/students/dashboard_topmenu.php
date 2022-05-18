           <?php
           $user_type = $this->session->userdata('user_type');
           $user_id = $this->session->userdata('user_id');
           if($user_type == 4){
           ?>
           <ul class="nav" id="navbarResponsive">
               <li class="nav-item">
                   <a class="nav-link student-dashboard"
                       href="<?php echo base_url($enterprise_shortname. '/student-dashboard'); ?>">Dashboard</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link student-profile-dashboard"
                       href="<?php echo base_url($enterprise_shortname. '/student-profile-dashboard'); ?>">Profile/CV</a>
               </li>
               <!-- <li class="nav-item">
                   <a class="nav-link student-public-view"
                       href="<?php echo base_url($enterprise_shortname. '/student-profile-show/'.$user_id); ?>">Public View</a>
               </li> -->
               <li class="nav-item">
                   <a class="nav-link student-activity"
                       href="<?php echo base_url($enterprise_shortname. '/student-activity/'); ?>">Activity</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link student-notification"
                       href="<?php echo base_url($enterprise_shortname .'/student-notification'); ?>">Notification</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link student-settings-account"
                       href="<?php echo base_url($enterprise_shortname . '/student-settings-account'); ?>">Settings</a>
               </li>
           </ul>
           <?php }else{ ?>
           <ul class="nav" id="navbarResponsive">
               <li class="nav-item">
                   <a class="nav-link student-profile-dashboard"
                       href="<?php echo base_url($enterprise_shortname. '/student-profile-show/'.$student_id); ?>">Profile/CV</a>
               </li>
           </ul>
           <?php } ?>