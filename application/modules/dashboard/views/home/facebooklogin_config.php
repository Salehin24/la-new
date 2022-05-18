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
                    <label for="client_id" class="col-sm-4 col-form-label">App ID<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="client_id" class="form-control" type="text" placeholder="App ID" id="client_id"
                            value="<?php echo (!empty($get_socialauthconfigdata->appid_clientid) ? $get_socialauthconfigdata->appid_clientid : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="secret_key" class="col-sm-4 col-form-label">Secret Key<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="secret_key" class="form-control" type="text" placeholder="Secret Key"
                            id="secret_key"
                            value="<?php echo (!empty($get_socialauthconfigdata->secret_key) ? $get_socialauthconfigdata->secret_key : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="redirect_url" class="col-sm-4 col-form-label">Redirect URL<i class="text-danger">
                            *</i></label>
                    <div class="col-sm-5">
                        <input name="redirect_url" class="form-control" type="text" id="redirect_url"
                            value="<?php echo base_url('/frontend/frontend/signinbyfacebook'); ?>" readonly>
                    </div>
                    
                    <div class="offset-4 col-sm-12">
                        <span class="text-danger">
                            Please, copy the url and paste your facebook developer Valid OAuth Redirect URIs
                            <a href="https://developers.facebook.com/" class="btn btn-success btn-sm"
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
                            onclick="facebookconfigupdate('<?php echo (!empty($get_socialauthconfigdata->id) ? $get_socialauthconfigdata->id : ''); ?>')"><?php echo display('update') ?></button>
                    </div>

                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
function facebookconfigupdate(id) {
    var client_id = $("#client_id").val();
    var secret_key = $("#secret_key").val();
    var redirect_url = $("#redirect_url").val();
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


    $.ajax({
        url: base_url + enterprise_shortname + "/facebook-config-update",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            id: id,
            client_id: client_id,
            secret_key: secret_key,
            redirect_url: redirect_url
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