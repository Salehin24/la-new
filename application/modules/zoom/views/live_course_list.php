<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
<div class="row">
    <div class="col-sm-12">
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
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-video"> </i> <?php echo (!empty($title) ? $title : null) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/add-live-course'); ?>"
                            class="btn btn-success-soft">
                            <?php echo display('add_live_course'); ?>
                        </a>
                    </small>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="result_load">
                    <table class="table table-striped table-bordered dt-responsive table-hover"
                        id="livecoursedatatablelist">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="25%"><?php echo display('course_name') ?></th>
                                <th width="20%"><?php echo display('category') ?></th>
                                <th width="10%"><?php echo display('price') ?></th>
                                <th width="10%" class="text-left"><?php echo display('total_sales') ?></th>
                                <th width="20%" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_livecourse" value="<?php echo $total_livecourse; ?>">
<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>
<script type="text/javascript">

</script>