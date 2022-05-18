<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('paywith'); ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <!-- <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">
                                *</i></label>
                        <div class="col-sm-6">
                            <input name="name" type="text" class="form-control" id="featuredin_name"
                                placeholder="<?php echo display('name') ?>" required>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-sm-6">
                            <!-- <input name="logo" type="file" class="form-control" id="logopaywith"
                                onchange="fileValueOne(this,'paywith')" value="" required> -->
                                <input type="file" name="logo" id="logopaywith" class="custom-input-file" onchange="fileValueOne(this,'paywith')" />
                                <label for="logopaywith">
                                    <i class="fa fa-upload"></i>
                                    <span class="paywith-filename"><?php echo display('choose_file'). '...'; ?></span>
                                </label>
                            <!-- <span class="text-danger f-s-10">( Only .png and svg format with transparent background (304*64) )</span> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-6 img-load">
                            <img id="image-preview-paywith" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-3 mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5 m-l-10"
                                onclick="paywith_infosave()"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </form>
                <!-- featuredin -->

                <table class="table table-bordered table-sm" id="paywith_datalist">
                    <thead>
                        <tr>
                            <th width="10%"><i class="fa fa-th-list"></i></th>
                            <th width="20%"><?php echo display('logo'); ?></th>
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

<script>
$(document).ready(function() {
    $("body").on("change", "#logopaywith", function(e) {
        var filename = e.target.files[0].name;
        $(".paywith-filename").text(filename);
    });
    $("body").on("change", "#edit_paywithlogo", function(e) {
        var filename = e.target.files[0].name;
        $(".editpaywith-filename").text(filename);
    });
});
</script>