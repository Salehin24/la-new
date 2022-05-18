<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('phrase'); ?></h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="phrase" class="col-sm-2"><?php echo display('phrase') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="phrase" type="text" class="form-control" id="phrase" placeholder="<?php echo display('phrase'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5" onclick="save_phrase()"><?php echo display('save') ?></button>
                        </div>
                    </div> 
                </form>
                <!-- language -->  
                <table class="table table-bordered table-sm" id="phraselist">
                    <thead>
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th><?php echo display('phrase'); ?></th>
                            <th class="text-left"><?php echo display('english'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody> 
                </table>  

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/phrase.js') ?>"></script>