
<!--------------combine js  start -------------->
<script src="<?php echo base_url() ?>assets/dist/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/bootstrap-4.5.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/scrollbar-min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/metismenu-min.js"></script>
<!--------------combine js  start -------------->

<!-- Third Party Scripts(used by this page)-->
<script src="<?php echo base_url() ?>assets/plugins/chartJs/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/sparkline/sparkline.min.js"></script>

<!--=========== its for datatables ============-->
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<!--Page Active Scripts(used by this page)-->
<script src="<?php echo base_url() ?>assets/plugins/datatables/data-bootstrap4.active.js"></script>

<!--Page Active Scripts(used by this page)-->
<script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>



<script src="<?php echo base_url() ?>assets/plugins/moment/moment.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!--Page Active Scripts(used by this page)-->
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.active.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/pages/select2.js"></script>

<script src="<?php echo base_url() ?>assets/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>
<!--========== its for bootstrap datepickers ==========-->
<script src="<?php echo base_url() ?>assets/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!--Page Scripts(used by all page)-->
<script src="<?php echo base_url() ?>assets/dist/js/sidebar.js"></script>

<!-- Flot Charts js -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.pie.min.js'); ?>" type="text/javascript"></script>
<!----------- its for bootstrap 4 tag inputs ============-->
<script src="<?php echo base_url('assets/plugins/Bootstrap-4-Tag-Input/tagsinput.js'); ?>" type="text/javascript"></script>

<!--========= its for toastr msg show ===========-->
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/common.js') ?>"></script>
<script src="<?php echo base_url('assets/dist/js/pusher.min.js'); ?>"></script>
<input type="hidden" id="onlynumber_allow" value="<?php echo display('onlynumber_allow'); ?>">
<input type="hidden" id="security_character" value="<?php echo display('security_character'); ?>">
<input type="hidden" id="coursespecial_character" value="<?php echo display('coursespecial_character'); ?>">
<input type="hidden" id="mail_specialcharacter_remove" value="<?php echo display('mail_specialcharacter_remove'); ?>">
<input type="hidden" id="segment1" value="<?php echo $this->uri->segment('1'); ?>">
<input type="hidden" id="segment2" value="<?php echo $this->uri->segment('2'); ?>">
<input type="hidden" id="segment3" value="<?php echo $this->uri->segment('3'); ?>">
<input type="hidden" id="api_key" value="<?php echo $this->session->userdata('api_key'); ?>">
<input type="hidden" id="cluster" value="<?php echo $this->session->userdata('cluster'); ?>">
<!-- database button link  -->
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jszip.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/pdfmake.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/vfs_fonts.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/buttons.html5.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/buttons.print.min.js');?>"></script>
        
<?php
$path = 'application/modules/';
$map = directory_map($path);
if (is_array($map) && sizeof($map) > 0)
    foreach ($map as $key => $value) {
        $js = str_replace("\\", '/', $path . $key . 'assets/js/script.js');
        if (file_exists($js)) {
            echo "<script src=" . base_url($js) . " type=\"text/javascript\"></script>";
        }
    }
?>
