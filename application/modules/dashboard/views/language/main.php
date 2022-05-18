<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('language'); ?></h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="language" class="col-sm-3"><?php echo display('language_name') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="language" type="text" class="form-control" id="language" placeholder="Language Name" required>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5" onclick="save_language()"><?php echo display('save') ?></button>
                        </div>
                    </div> 
                </form>
                <!-- language -->  
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" language_list>
                        <thead>
                            <tr>
                                <th><i class="fa fa-th-list"></i></th>
                                <th><?php echo display('language'); ?></th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($languages)) { ?>
                                <?php $sl = 1 ?>
                                <?php foreach ($languages as $key => $language) { ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo html_escape($language) ?></td>
                                        <td class="text-center ">
                                            <a href="<?php echo base_url(enterpriseinfo()->shortname ."/phrase-label-edit/$key") ?>" class="btn btn-primary custom_btn" title="Edit"><i class="ti-pencil-alt"></i></a>  
                                        </td> 
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>  

            </div>
        </div>
    </div>
</div>
