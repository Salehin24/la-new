<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
<meta name="author" content="Bdtask">
<title><?php echo html_escape((!empty($setting->title) ? $setting->title : null)) ?> ::
    <?php echo html_escape((!empty($title) ? $title : null)) ?></title>
<!-- App favicon -->
<link rel="shortcut icon"
    href="<?php echo base_url(html_escape((!empty($setting->favicon) ? $setting->favicon : 'assets/img/icons/favicon.png'))) ?>"
    type="image/x-icon">
<script src="<?php echo base_url('assets/dist/js/webfont.js'); ?>"></script>

<link
    href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
<!--Third party Styles(used by this page)-->
<link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/dist/css/select.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css" rel="stylesheet">

<!--========== its for datetimepicker css============-->
<link href="<?php echo base_url(); ?>assets/dist/css/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/plugins/glyphicons/glyphicons.css'); ?>" rel="stylesheet">
<!--------------combine css  start -------------->
<link href="<?php echo base_url() ?>assets/dist/bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/dist/css/metismenu.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/dist/css/themify.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/dist/css/typicons.css" rel="stylesheet">
<!--------------combine css  close -------------->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url('application/modules/dashboard/assets/css/datepickercss.css') ?>">
<!--=========== jquery ui css ==========-->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet"
    type="text/css" />
<!--========= its for toastr msg show ===========-->
<link href="<?php echo base_url('assets/plugins/Bootstrap-4-Tag-Input/tagsinput.css'); ?>" rel=stylesheet
    type="text/css" />
<!----------- its for bootstrap 4 tag inputs ============-->
<link href="<?php echo base_url('assets/plugins/toastr/toastr.css'); ?>" rel=stylesheet type="text/css" />
<!--Start Your Custom Style Now-->
<link href="<?php echo base_url() ?>assets/dist/css/custom.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/dist/css/common.css" rel="stylesheet">
<!-- Include module style -->
<input type="hidden" id="productmode" value="main">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" id="usertype" value="<?php echo get_usertype(); ?>">
<input type="hidden" id="enterprise_shortname" value="<?php echo enterpriseinfo()->shortname; ?>">
<input type="hidden" id="enterprise_id" value="<?php echo get_enterpriseid(); ?>">
<input type="hidden" name="CSRF_TOKEN" id="CSRF_TOKEN" value="<?php echo $this->security->get_csrf_hash(); ?>">
<?php
$path = 'application/modules/';
$map = directory_map($path);
if (is_array($map) && sizeof($map) > 0)
    foreach ($map as $key => $value) {
        $css = str_replace("\\", '/', $path . $key . 'assets/css/style.css');
        if (file_exists($css)) {
            echo "<link href=" . base_url($css) . " rel=\"stylesheet\">";
        }
    }
?>
<script src="<?php echo base_url() ?>assets/dist/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/multiselectedjs/jquery.multiselect.js"></script>
<link href="<?php echo base_url() ?>assets/plugins/multiselectedjs/jquery.multiselect.css" rel="stylesheet">
<!--========== its for datetimepicker ============-->
<script type="text/javascript" src="<?php echo base_url('assets/dist/js/jquery-ui-timepicker-addon.js'); ?>"></script>
<style>
/* .navbar-custom-menu.navbar {
    background: <?php echo ( !empty(get_appsettings()->header_color) ? get_appsettings()->header_color : '#fff') ?>;
}

.sidebar-bunker {
    background-color: <?php echo ( !empty(get_appsettings()->sidebar_color) ? get_appsettings()->sidebar_color : '#1c1f22');
    ?>
}

.sidebar-nav ul li.mm-active a {
    background-color: <?php echo ( !empty(get_appsettings()->sidebar_activecolor) ? get_appsettings()->sidebar_activecolor : '#134779');
    ?>;
    box-shadow: 0 0 10px 1px <?php echo ( !empty(get_appsettings()->sidebar_activecolor) ? get_appsettings()->sidebar_activecolor : '#134779'); ?>;
}

.btn-color{
    background-color: <?php echo (!empty(get_appsettings()->header_colo) ? get_appsettings()->header_color : '#1b5fa0'); ?>;
}
.footer-content {
    background-color: <?php echo ( !empty(get_appsettings()->footer_color) ? get_appsettings()->footer_color : '#fff');
    ?>;
} */
</style>