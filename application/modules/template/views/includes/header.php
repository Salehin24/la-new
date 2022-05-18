<?php
$this->load->model('Faculty_model');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$image = $this->session->userdata('image');
?>
<div class="sidebar-toggle-icon" id="sidebarCollapse">
    sidebar toggle<span></span>
</div>
<!--/.sidebar toggle icon-->
<?php if ($this->session->userdata('temp_login') == 1) { ?>
<div class="msg-text">
    You are impersonating the institute <strong> <?php echo $this->session->userdata('fullname'); ?> </strong>.
    <hr style="margin: 2px 0">
    Please <a href="<?php echo base_url('dashboard/auth/logout'); ?>"
        style="color: #ffffff; text-decoration: underline;font-style: italic;">click here</a> to logout in order to
    finish impersonating.
</div>
<?php } ?>
<div class="d-flex">
    <ul class="navbar-nav flex-row align-items-center ml-auto">
        <li class="nav-item" blink>
            <a class="nav-link" href="<?php echo base_url((enterpriseinfo()->shortname == 'admin' ? '' : enterpriseinfo()->shortname)); ?>" title="<?php echo display(''); ?>" target="_new">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        <?php
        if ($user_type == 3) {
            $faculty_info = $this->Faculty_model->faculty_info($user_id);
            if (empty($faculty_info->paypal)) {
                ?>
        <li class="nav-item" blink>
            <a class="nav-link bg-warning" href="<?php echo base_url('faculty-edit/' . $user_id); ?>"
                title="<?php echo display('payment_method_not_set_yet'); ?>">
                <i class="typcn typcn-bell"></i>
            </a>
        </li>
        <?php
            }
        }
        if ($user_type == 1) {
            ?>
        <li class="nav-item" blink>
            <a class="nav-link linkpopulate" href="#" title="<?php echo display(''); ?>">
                <i class="typcn typcn-bell"></i>
                <span class="" id="pending-faculty-count"></span>
            </a>
        </li>
        <?php } ?>
        <li class="nav-item dropdown user-menu">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="typcn typcn-user-add-outline"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header d-sm-none">
                    <a href="" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="user-header">
                    <div class="img-user">
                        <img src="<?php echo base_url() . (($image) ? $image : ('assets/img/icons/default.png')); ?>"
                            alt="">
                    </div><!-- img-user -->
                    <h6><?php echo $this->session->userdata('fullname'); ?></h6>
                    <span><?php echo $this->session->userdata('email'); ?></span>
                </div><!-- user-header -->
                <?php if ($user_type == 1 || $user_type == 2) { ?>
                <a href="<?php echo base_url(); ?>dashboard/home/profile" class="dropdown-item"><i
                        class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="<?php echo base_url(); ?>dashboard/home/setting" class="dropdown-item"><i
                        class="typcn typcn-edit"></i> Edit Profile</a>
                <?php
                }
                if ($user_type == 3) {
                    ?>
                <a href="<?php echo base_url('faculty-edit/' . $user_id); ?>" class="dropdown-item"><i
                        class="typcn typcn-edit"></i> Edit Profile </a>
                <a href="<?php echo base_url('faculty-info/' . $user_id); ?>" target="_new" class="dropdown-item"><i
                        class="typcn typcn-edit"></i> <?php echo display('profile'); ?></a>
                <?php
                }
                if ($user_type == 4) {
                    ?>
                <a href="<?php echo base_url('student-edit/' . $user_id); ?>" class="dropdown-item"><i
                        class="typcn typcn-edit"></i> Edit Profile </a>
                <?php
                }
                if ($user_type == 1) {
                    ?>
                <a href="<?php echo base_url(enterpriseinfo()->shortname.'/settings'); ?>" class="dropdown-item"><i
                        class="typcn typcn-cog-outline"></i> Application Settings</a>
                <?php } ?>
                <a href="<?php echo base_url(); ?>dashboard/auth/changepassword_form" class="dropdown-item"><i
                        class="typcn typcn-key-outline"></i> Change Password</a>
                <a href="<?php echo base_url(); ?>dashboard/auth/logout" class="dropdown-item"><i
                        class="typcn typcn-key-outline"></i> Sign Out</a>
            </div>
            <!--/.dropdown-menu -->
        </li>
    </ul>
    <!--/.navbar nav-->
    <div class="nav-clock">
        <div class="time">
            <span class="time-hours"></span>
            <span class="time-min"></span>
            <span class="time-sec"></span>
        </div>
    </div><!-- nav-clock -->
</div>

<!-- Header -->