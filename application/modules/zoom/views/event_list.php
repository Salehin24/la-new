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
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/add-event'); ?>"
                            class="btn btn-success-soft">
                            <?php echo display('add_event'); ?>
                        </a>
                    </small>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="result_load">
                    <table class="table table-striped table-bordered dt-responsive table-hover"
                        id="liveeventdatatablelist">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="25%"><?php echo display('event') ?></th>
                                <th width="20%"><?php echo display('category') ?></th>
                                <th width="10%"><?php echo display('price') ?></th>
                                <th width="10%" class="text-left">Total Participant</th>
                                <th width="20%" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_liveevent" value="<?php echo $total_liveevent; ?>">
<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>
<script>
    //its for event inactive
("use strict");
function event_inactive(event_id) {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var d = confirm("Are you sure?");
    if (d == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/event-inactive",
            type: "POST",
            data: {csrf_test_name: CSRF_TOKEN, event_id: event_id},
            success: function (r) {
                toastrSuccessMsg(r);
                location.reload();
                // return false;
            },
        });
    }
}
//============= its for event active ===========
("use strict");
function event_active(event_id) {
    var d = confirm("Are you sure?");
    if (d == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/event-active",
            type: "POST",
            data: {csrf_test_name: CSRF_TOKEN, event_id: event_id},
            success: function (r) {
                
                toastrSuccessMsg(r);
                location.reload();
            },
        });
    }
}
</script>