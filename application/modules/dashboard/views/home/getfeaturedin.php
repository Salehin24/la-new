<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('featured_in'); ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i
                                class="text-danger">
                                *</i></label>
                        <div class="col-sm-6">
                            <input name="name" type="text" class="form-control" id="featuredin_name"
                                placeholder="<?php echo display('name') ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="link" class="col-sm-3 col-form-label"><?php echo display('link') ?> <i
                                class="text-danger">
                            </i></label>
                        <div class="col-sm-6">
                            <input name="link" type="text" class="form-control" id="link"
                                placeholder="<?php echo display('link') ?>">
                            <span class="text-danger f-s-10">( Need your full URL)</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                        <div class="col-sm-6">
                            <select class="form-control ordering placeholder-single" id="ordering"
                                data-placeholder="-- select one --" name="ordering">
                                <option value="">-- select one --</option>
                                <?php for ($i = 1; $i < 51; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-sm-6">
                            <!-- <input name="logo" type="file" class="form-control" id="logofeaturedin"
                                onchange="fileValueOne(this,'featuredin')" value=""> -->

                            <input type="file" name="logo" id="logofeaturedin" class="custom-input-file"
                                onchange="fileValueOne(this,'featuredin')" />
                            <label for="logofeaturedin">
                                <i class="fa fa-upload"></i>
                                <span class="featuredin-filename"><?php echo display('choose_file'). '...'; ?></span>
                            </label>

                            <span class="text-danger f-s-10">( Only .png and svg format with transparent background
                                (304*64) )</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-6">
                            <img id="image-preview-featuredin" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-3 mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5 m-l-10"
                                onclick="featuredin_infosave()"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </form>
                <!-- featuredin -->

                <table class="table table-bordered table-sm" id="featuredin_datalist">
                    <thead>
                        <tr>
                            <th width="10%"><i class="fa fa-th-list"></i></th>
                            <th width="30%"><?php echo display('featured_in').' '.display('name'); ?></th>
                            <th width="20%"><?php echo display('link'); ?></th>
                            <th width="10%"><?php echo display('ordering'); ?></th>
                            <th width="20%"><?php echo display('picture'); ?></th>
                            <th width="10%" class="text-center"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="modal_infosf" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttlf"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="infosf">

            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_company" value="<?php echo html_escape($total_featuredin); ?>">
<script>
$(document).ready(function() {
    $("body").on("change", "#logofeaturedin", function(e) {
        var filename = e.target.files[0].name;
        $(".featuredin-filename").text(filename);
    });
});
</script>