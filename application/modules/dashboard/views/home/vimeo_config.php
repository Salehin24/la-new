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
                    <label for="client_id" class="col-sm-4 col-form-label">Client ID<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="client_id" class="form-control" type="text" placeholder="Client ID" id="client_id"
                            value="<?php echo (!empty($get_socialauthconfigdata->appid_clientid) ? $get_socialauthconfigdata->appid_clientid : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="secret_key" class="col-sm-4 col-form-label">Client Secret Key<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="secret_key" class="form-control" type="text" placeholder="Secret Key"
                            id="secret_key"
                            value="<?php echo (!empty($get_socialauthconfigdata->secret_key) ? $get_socialauthconfigdata->secret_key : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="access_token" class="col-sm-4 col-form-label">Access Token<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="access_token" class="form-control" type="text" id="access_token" placeholder="Access Token"
                            value="<?php echo (!empty($get_socialauthconfigdata->access_token) ? $get_socialauthconfigdata->access_token : ''); ?>">
                    </div>
                    
                    <div class="offset-4 col-sm-12">
                        <span class="text-danger">
                            Go to developer page for configuration 
                            <a href="https://developer.vimeo.com/" class="btn btn-success btn-sm"
                                targe="_new">Go</a>
                        </span>
                    </div>
                </div>
                <div class="form-group row">

                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-5 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success w-md m-b-5"
                            onclick="vimeoconfigupdate('<?php echo (!empty($get_socialauthconfigdata->id) ? $get_socialauthconfigdata->id : ''); ?>')"><?php echo display('update') ?></button>
                    </div>

                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
function vimeoconfigupdate(id) {
    var client_id = $("#client_id").val();
    var secret_key = $("#secret_key").val();
    var access_token = $("#access_token").val();
    var csrf_test_name = $("[name=csrf_test_name]").val();

    if (client_id == "") {
        $("#client_id").focus();
        toastrErrorMsg("Client id must be required");
        return false;
    }
    if (secret_key == "") {
        $("#secret_key").focus();
        toastrErrorMsg("Secret key must be required");
        return false;
    }
    if (access_token == "") {
        $("#access_token").focus();
        toastrErrorMsg("Access token must be required");
        return false;
    }


    $.ajax({
        url: base_url + enterprise_shortname + "/vimeo-config-update",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            id: id,
            client_id: client_id,
            secret_key: secret_key,
            access_token: access_token
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