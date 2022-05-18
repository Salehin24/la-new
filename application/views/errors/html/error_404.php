<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$ci = new CI_Controller();
$ci = & get_instance();
$ci->load->helper('url');
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>404 Page Not Found</title>
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!--  CSS -->
        <link href="<?php echo base_url().'assets/dist/css/errorstyle.css'; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/style.css'); ?>"
        rel="stylesheet">
        <script src="<?php echo base_url() ?>assets/dist/js/jquery.min.js"></script>
        </head>

    <body>
        <!-- <div id="wrapper" class="clearfix">
            <div class="main-content">

                <section id="home" class="fullscreen bg-lightest">
                    <div class="display-table text-center">
                        <div class="display-table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">                                        
                                        <img src="<?php echo base_url(); ?>assets/img/404.png" class="width-80"/> 
                                        <button class="btn btn-primary" onclick="history.go(-1);">Go To Home Page</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div> -->
        <div class="align-items-center d-flex py-5 full_page_cover">
            <div class="container-lg">
                <div class="row g-3 align-items-center">
                    <div class="col-xl-4 offset-xl-2 col-md-6 text-center text-md-start">
                        <h2 class="fw-bolder text-danger textB">404</h2>
                        <p class="my-4">Oooops! Sorry, we couldn't find the page you were looking for. If you think this is a problem with us, please Contact Us</p>
                        <a onclick="history.go(-1);" class="btn btn-lg btn-dark-cerulean">Back to home</a>
                    </div>
                    <div class="col-xl-4 col-md-6 text-center text-lg-end">
                        <img src="<?php echo base_url(); ?>assets/img/404sss.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
        <script src="<?php echo base_url() ?>assets/dist/bootstrap-4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>

