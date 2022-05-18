    <?php 
    $uri_segment = $this->uri->segment(2);
    $uri_segment3 = $this->uri->segment(3);
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    // d($uri_segment3);
    // dd($user_id);
    // if($user_type == 5 && $uri_segment3==$user_id){ 
    if($user_type ==4 || $user_type ==''){ 
        $instructor_id = $this->uri->segment(3);
        ?>
    <ul class="nav" id="navbarResponsive">
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-profile-show' ? 'active':'' ) ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-profile-show/'.$instructor_id); ?>">Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'single-instructor-courses'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/single-instructor-courses/'.$instructor_id); ?>">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'single-instructor-activities'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/single-instructor-activities/'.$instructor_id); ?>">Activity</a>
        </li>
    </ul>
<?php    
//}
   //  elseif($user_type == 5  && $uri_segment3==$user_id){
    ?>
    <!-- <ul class="nav" id="navbarResponsive">
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-profile-show' ? 'active':'' ) ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-profile-show/'.$instructor_id); ?>">Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'single-instructor-courses'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/single-instructor-courses/'.$instructor_id); ?>">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'single-instructor-activities'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/single-instructor-activities/'.$instructor_id); ?>">Activity</a>
        </li>
    </ul> -->

    <?php }else{ 
        $instructor_id = $this->uri->segment(3);
        ?>

<ul class="nav" id="navbarResponsive">
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-dashboard'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-dashboard'); ?>">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-profile'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-profile'); ?>">Profile/CV</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-courses'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-courses'); ?>">Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-activities'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-activities'); ?>">Activity</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-earnings'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-earnings'); ?>">Earnings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-notifications'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-notifications'); ?>">Notification</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-faq'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-faq'); ?>">FAQ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($uri_segment == 'instructor-account-settings'?'active':'') ?>"
                href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-account-settings'); ?>">Settings
            </a>
        </li>
    </ul>
    
    <?php } ?>