<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('privacy_policy') ?> </h6><hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url('privacypolicy-save'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="title" class="col-sm-2"><?php echo display('title') ?> <i class="text-danger"> * </i></label>
                <div class="col-sm-9">
                    <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="privacy_title"  value="<?php
                    if (!empty($get_privacypolicy->title)) {
                        echo html_escape($get_privacypolicy->title);
                    }
                    ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="privacy" class="col-sm-2"><?php echo display('description') ?> <i class="text-danger"> * </i></label>
                <div class="col-sm-9">
                    <textarea name="privacy" class="form-control privacy" placeholder="<?php echo display('description') ?>" id="privacy" rows="10" cols="80"><?php
                        if (!empty($get_privacypolicy->description)) {
                            echo html_escape($get_privacypolicy->description);
                        }
                        ?>
                    </textarea>
                </div>
            </div>
            <div class="offset-3 mb-3 group-end">
                <button type="button" class="btn btn-info w-md m-b-5" onclick="privacypolicy_save()"><?php echo display('update') ?></button>
            </div>
        </form>
    </div>
</div>