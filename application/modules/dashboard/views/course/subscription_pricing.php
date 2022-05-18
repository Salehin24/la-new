<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>"
    rel="stylesheet">
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname . '/coupon-list'); ?>"
                            class="btn btn-success">
                            <?php echo display('coupon_list'); ?>
                        </a> -->
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart("#") ?>
                <div class="form-group row">
                    <label for="max_payable" class="col-sm-5 col-form-label">Max Payable (Tk)<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-3">
                        <input name="max_payable" class="form-control" type="number" placeholder="Max Payable"
                            id="max_payable"
                            value="<?php echo (!empty($get_subscriptionpricing->max_payable) ? $get_subscriptionpricing->max_payable : ''); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="max_percentage" class="col-sm-5 col-form-label">Max Percentage (%)<i
                            class="text-danger"> *</i></label>
                    <div class="col-sm-3">
                        <input name="max_percentage" class="form-control" type="number" placeholder="Max Percentage"
                            id="max_percentage"
                            value="<?php echo (!empty($get_subscriptionpricing->max_percentage) ? $get_subscriptionpricing->max_percentage : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cronjob_time" class="col-sm-5 col-form-label">Server Hit Time<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-3">
                        <input name="cronjob_time" id="cronjob_time" class="form-control timepicker_hm" type="text"
                            placeholder="Server Hit Time"
                            value="<?php echo (!empty($get_subscriptionpricing->cronjob_time) ? $get_subscriptionpricing->cronjob_time : ''); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success w-md m-b-5"
                            onclick="subscriptionpricingupdate('<?php echo (!empty($get_subscriptionpricing->id) ? $get_subscriptionpricing->id : ''); ?>')"><?php echo display('update') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/moment.js'); ?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>">
</script>
<script>
function subscriptionpricingupdate(id) {
    var max_percentage = $("#max_percentage").val();
    var max_payable = $("#max_payable").val();
      var cronjob_time = $("#cronjob_time").val();
    var csrf_test_name = $("[name=csrf_test_name]").val();
    // alert(cronjob_time);
    if (max_percentage == "") {
        $("#max_percentage").focus();
        toastrErrorMsg("Max percentage must be required");
        return false;
    }
    if (max_payable == "") {
        $("#max_payable").focus();
        toastrErrorMsg("Max payable must be required");
        return false;
    }
      if (cronjob_time == "") {
        $("#cronjob_time").focus();
        toastrErrorMsg("Server hit tIme must be required");
        return false;
      }


    $.ajax({
        url: base_url + enterprise_shortname + "/subscription-pricing-update",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            max_percentage: max_percentage,
            max_payable: max_payable,
            cronjob_time: cronjob_time,
        },
        success: function(r) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: "slideDown",
                    timeOut: 1500,
                    onHidden: function() {
                        window.location.reload();
                    },
                };
                toastr.success(r);
            }, 1000);
        },
    });
}
</script>