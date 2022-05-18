<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
        <meta name="author" content="Bdtask">
        <title><?php echo (!empty($setting->title) ? $setting->title : null) ?> :: <?php echo (!empty($title) ? $title : null) ?></title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url((!empty($setting->favicon) ? $setting->favicon : 'assets/dist/img/favicon.png')) ?>">

        <!--------------combine css  start -------------->
        <link href="<?php echo base_url() ?>assets/dist/bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
        <script src="<?php echo base_url() ?>assets/dist/js/jquery.min.js"></script>
        <!--------------combine css  close -------------->
        <!--Start Your Custom Style Now-->
        <link href="<?php echo base_url() ?>assets/dist/css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/dist/css/login.css" rel="stylesheet">
        <?php
        $this->load->model('setting_model');
        $enterprise_shortname = $this->uri->segment(1);
        $enterpriseid = enterpriseid_byshortname($enterprise_shortname);
        $settings_data = $this->setting_model->read((!empty($enterpriseid) ? $enterpriseid : 1));
        $get_enterpriseinfo = get_enterpriseinfo((!empty($settings_data->enterprise_id) ? $settings_data->enterprise_id : '1'));
        ?>
</head>

<body class="bg-white body-bg">
    <main class="register-content">
        <div class="bg-img-hero position-fixed top-0 right-0 left-0">
            <figure class="position-absolute right-0 bottom-0 left-0 m-0">
                <img src="<?php echo base_url('assets/dist/img/fig.svg') ?>" alt="Image Description">
            </figure>
        </div>
        <div class=" container py-5 py-sm-7">
                <a class="d-flex justify-content-center mb-5 news365-logo" href="">
                    <img class="z-index-3"
                        src="<?php echo base_url((!empty($settings_data->logoThree)) ? "$settings_data->logoThree" : "assets/img/logo.png") ?>"
                        alt="Image Description">
                </a>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="panel-header text-center mb-3">
                        <h3 class="fs-24"><?php echo display('sign_into_your_account'); ?></h3>
                    </div>
                     <div class="">
                        <!-- alert message -->
                        <?php if ($this->session->flashdata('message') != null) { ?>
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message'); ?>
                            </div> 
                        <?php } ?>

                        <?php if ($this->session->flashdata('exception') != null) { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('exception'); ?>
                            </div>
                        <?php } ?>

                        <?php if (validation_errors()) { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="form-card mb-5">
                        <div class="form-card_body">
                           <?php echo form_open($get_enterpriseinfo->shortname .'/login', 'id="loginForm" novalidate class="register-form"'); ?>
                            <div class="text-center">
                                <div class="mb-5">
                                        <h1 class="display-4 mt-0 font-weight-semi-bold">
                                            <?php echo display('sign_in') ?></h1>
                                        <p><?php echo display('sign_in_using_your_email_address') ?></p>
                                        <p>
                                        <?php
                                            $error = $this->session->flashdata('error');
                                            $success = $this->session->flashdata('success');
                                            if ($error != '') {
                                                echo $error;
                                            }
                                            if ($success != '') {
                                                echo $success;
                                            }
                                            unset($_SESSION['exception']);
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text"  name="email" id="inputEmail" class="form-control" placeholder="<?php echo display('username') ?>" value="<?php echo get_cookie("email"); ?>" required autofocus>
                                    <div class="invalid-feedback"><?php echo display('email') ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="input-label font-weight-bold"
                                        for="inputPassword"><?php echo display('password') ?></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control password"
                                            placeholder="<?php echo display('password') ?>" name="password"
                                            id="inputPassword" required>
                                        <i onclick="passShow()" class="fa fa-eye"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- capta part -->
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="rememberme" onclick="is_remember()" name="rememberme" value="0">
                                <label class="custom-control-label" for="rememberme"><?php echo display('remember_me'); ?></label>

                            </div>
                              <button type="submit"  class="btn btn-lg btn-block btn-primary"><?php echo display('login') ?></button>
                            </form>
                            <div class="panel-footer">
                                <!-- <table style="cursor:pointer;font-size:12px" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Pass</th> 
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>admin@gmail.com</td>
                                            <td>123456</td> 
                                            <td>Admin</td> 
                                        </tr>   
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo base_url() ?>assets/dist/bootstrap-4.5.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('application/modules/dashboard/assets/js/login.js'); ?>"></script>

</body>

</html>