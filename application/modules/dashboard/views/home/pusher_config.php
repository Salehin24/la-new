
<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('pusher_configuration') ?> </h6><hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="#" class="form-vertical" id="insert_customer" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="form-group row">
                <label for="api_id" class="col-sm-3 col-form-label text-right"><?php echo display('api_id') ?> <i class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="api_id" class="form-control api_id" id="api_id" name="api_id" value="<?php echo html_escape(!empty($pusher_config->api_id) ? $pusher_config->api_id : ''); ?>" required>
                </div>      
            </div>
            <div class="form-group row">
                <label for="api_key" class="col-sm-3 col-form-label text-right"><?php echo display('api_key') ?> <i class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="api_key" class="form-control api_key" id="api_key" name="api_key" value="<?php echo html_escape(!empty($pusher_config->api_key) ? $pusher_config->api_key : ''); ?>" required>
                </div>   
            </div>
            <div class="form-group row">
                <label for="secret_key" class="col-sm-3 col-form-label text-right"><?php echo display('secret_key') ?> <i class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="secret_key" class="form-control secret_key" id="secret_key" name="secret_key" value="<?php echo html_escape(!empty($pusher_config->secret_key) ? $pusher_config->secret_key : ''); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="cluster" class="col-sm-3 col-form-label text-right"><?php echo display('cluster') ?> <i class="text-danger"> *</i></label>
                <div class="col-sm-6">
                    <input type="cluster" class="form-control cluster" id="cluster" name="cluster" value="<?php echo html_escape(!empty($pusher_config->cluster) ? $pusher_config->cluster : ''); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-6 text-right">                    
                     <label>For Pusher Information</label>
                    <a href="https://dashboard.pusher.com/apps" class="btn btn-success w-45"  target="_new">Go</a>
                    <input type="button" onclick="pusherconfigsave()" class="btn btn-info btn-large" value="<?php echo display('update'); ?>">
                </div>
            </div>
        </form>
    </div>
</div>