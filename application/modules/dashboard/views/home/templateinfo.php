<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('template'); ?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="template_title" class="col-sm-3"><?php echo display('title') ?> <i
                                class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="title" type="text" class="form-control" id="template_title"
                                placeholder="<?php echo display('title') ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="template_type" class="col-sm-3"><?php echo display('template_type') ?> <i
                                class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <select class="form-control placeholder-single" id="template_type" name="template_type"
                                data-placeholder="-- select one --">
                                <option value=""></option>
                                <option value="sms"><?php echo display('sms'); ?></option>
                                <option value="email"><?php echo display('email'); ?></option>
                                <!-- <option value="certificate"><?php echo display('certificate'); ?></option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="template_body" class="col-sm-3"><?php echo display('template_body') ?> <i
                                class="text-danger"> *</i></label>
                        <div class="col-sm-9">
                            <textarea name="template_body" rows="10" class="form-control" id="template_body"
                                placeholder="<?php echo display('template_body') ?>" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="template_body" class="col-sm-3">&nbsp</label>
                        <div class="col-sm-6">
                            <div class="text-danger">
                                For SMS : [name][mobile_no][message]
                            </div>
                            <div class="text-danger">
                                For Mail : [name][email][username][title][message]
                            </div>
                            <!-- <div class="text-danger">
                                For Certificate : [name][summary][certificate_name][date]
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5"
                                onclick="templateinfo_save()"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </form>
                <!-- template -->
                <table class="table table-bordered table-sm" id="templatelist">
                    <thead>
                        <tr>
                            <th width="5%"><i class="fa fa-th-list"></i></th>
                            <th width="20%"><?php echo display('title'); ?></th>
                            <th width="15%"><?php echo display('template_type'); ?></th>
                            <th width="40%"><?php echo display('template_body'); ?></th>
                            <th width="20%" class="text-center"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>

                </table>
                <!-- The Modal -->
                <div class="modal fade" id="templatemodal_info" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title templatemodal_ttl"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="templateinfo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>