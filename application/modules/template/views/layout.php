<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if ($this->session->userdata('isLogIn') == false) {
    $this->session->sess_destroy();
    redirect('login');
}
?>
<!doctype html>
<html lang="en">
    <head>
        <?php $this->load->view('includes/head') ?>
    </head>
    <body class="fixed">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav class="sidebar sidebar-bunker">
                <?php $this->load->view('includes/sidebar') ?>
            </nav>
            <!-- Page Content  -->
            <div class="content-wrapper">
                <div class="main-content position-relative">
                    <div class="page-loader-wrapper">
                        <div class="loader">
                            <div class="preloader">
                                <div class="spinner-layer pl-green">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <p>Please wait...</p>
                        </div>
                    </div>

                    <nav class="navbar-custom-menu navbar navbar-expand-lg m-0">
                        <?php $this->load->view('includes/header'); ?>
                    </nav><!--/.navbar-->
                    <!--Content Header (Page header)-->
                    <?php
                    $titlename = str_replace("_", " ", $this->uri->segment(1));
                    $titlename1 = str_replace("_", " ", $this->uri->segment(1));
                    $titlename2 = str_replace("_", " ", $this->uri->segment(2));
                    ?>

                    <div class="body-content" id="bodycontent">
                        <?php $this->load->view('includes/messages') ?>
                        <?php echo $this->load->view($module . '/' . $page) ?>

                    </div><!--/.body content-->
                </div><!--/.main content-->
                <footer class="footer-content fixed-footer">
                    <div class="footer-text d-flex align-items-center justify-content-between">
                        <div class="copy"><?php echo (!empty($setting->footer_text) ? $setting->footer_text : null) ?><a href="<?php echo current_url() ?>">
                                <?php echo (!empty($setting->title) ? $setting->title : null) ?></a></div>
                        <div class="credit"><?php echo display('designed_by'); ?> : <a href="#"><?php echo display('owner_name'); ?></a></div>
                    </div>
                </footer><!--/.footer content-->
                <div class="overlay"></div>
            </div><!--/.wrapper-->
        </div>
        <?php $this->load->view('includes/js') ?>
    </body>
</html>