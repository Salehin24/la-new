<div class="sidebar-header">
    <a href="<?php echo base_url(($get_enterpriseinfo->shortname == 'admin' ? '' : $get_enterpriseinfo->shortname)) ?>" class="logo" target="_new">
        <img src="<?php echo base_url((!empty($setting->logo) ? $setting->logo : 'assets/img/icons/logo.png')) ?>"
            alt="">
    </a>
</div>
<!--/.sidebar header-->
<div class="profile-element d-flex align-items-center flex-shrink-0">
    <?php
    $image = $this->session->userdata('image');
    $fullname = $this->session->userdata('fullname');
    $user_id = $this->session->userdata('user_id');
    $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2);
    ?>
    <div class="avatar avatar-xs online">
        <img src="<?php echo base_url((!empty($image) ? $image : 'assets/img/icons/default.png')) ?>"
            class="img-fluid avatar-img rounded-circle" alt="">
    </div>
    <div class="profile-text">
        <h6 class="m-0"><?php echo $fullname; ?> </h6>
    </div>
</div>
<!--/.profile element-->
<div class="sidebar-body">
    <nav class="sidebar-nav">
        <ul class="metismenu">
            <li class="dashboard <?php echo (($segment2 == "dashboard") ? "mm-active" : null) ?>">
                <a href="<?php echo base_url('dashboard/home') ?>"><i class="typcn typcn-home-outline mr-2"></i>
                    <?php echo display('dashboard') ?></a>
            </li>
            <?php
            $modules = $this->db->select('*')->from('sec_menu_item')->where('parent_menu', 0)->where('status', 1)->where('is_frontend', 0)->order_by('menu_title', 'asc')->get()->result();
            foreach ($modules as $module) {
                $submenus = $this->db->select('*')
                                ->from('sec_menu_item')
                                ->where('parent_menu', $module->menu_id)
                                ->where('status', 1)
                                ->where('is_settings', 0)
                                ->where('is_homesetting', 0)
                                ->order_by('ordering', 'asc')
                                ->get()->result();
                if (!empty($submenus)) {
                    if ($this->permission->module($module->module)->access()) {
                        ?>
            <li class="<?php echo $module->menu_title; ?>">
                <a class="has-arrow material-ripple" href="#">
                    <i class="<?php echo $module->icon; ?> mr-2"></i>
                    <?php echo display($module->menu_title); ?>
                </a>
                <ul class="nav-second-level" id="<?php echo $module->menu_title; ?>">
                    <?php
                                foreach ($submenus as $submenu) {
                                    $childmenus = $this->db->select('*')
                                                    ->from('sec_menu_item')
                                                    ->where('parent_menu', $submenu->menu_id)
                                                    ->where('status', 1)
                                                    ->order_by('menu_id', 'asc')
                                                    ->get()->result();
                                    if (!empty($childmenus)) {
                                        ?>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false">Level - 2</a>
                        <ul class="nav-third-level">
                            <li><a href="#">Menu Item</a></li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">Level - 3</a>
                                <ul class="nav-fourth-level">
                                    <li><a href="#">Level - 4</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php
                                    } else {
                                        if ($this->permission->check_label($submenu->menu_title)->read()->access()) {
                                            ?>
                    <li class="<?php echo (($segment2 == $submenu->page_url) ? "mm-active" : null) ?>">
                        <a
                            href="<?php echo base_url($get_enterpriseinfo->shortname.'/'. $submenu->page_url); ?>"><?php echo display($submenu->menu_title); ?></a>
                    </li>
                    <?php
                                        }
                                    }
                                }
                                ?>
                </ul>
            </li>
            <?php
                    }
                } else {
                    if ($this->permission->module($module->module)->access()) {
                        ?>
            <li
                class="<?php echo $module->menu_title; ?> <?php  echo (($segment2 == $module->page_url) ? "mm-active" : null) ?>">
                <a href="<?php echo base_url($get_enterpriseinfo->shortname .'/'. $module->page_url) ?>"><i
                        class="<?php echo $module->icon; ?> mr-2"></i>
                    <?php echo display($module->menu_title); ?>
                </a>
            </li>
            <?php
                    }
                }
            }
            ?>


        </ul>
    </nav>
</div><!-- sidebar-body -->