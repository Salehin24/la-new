<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('currency'); ?></h4>
            </div>
            <div class="card-body">
                <?php echo form_open(); ?>
                <div class="form-group row">
                    <label for="currencyname" class="col-sm-3 col-form-label text-right"><?php echo display('currencyname'); ?> <i class="text-danger">*</i></label>
                    <div class="col-sm-6">
                        <input class="form-control" name="currencyname" id="currencyname" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="curr_icon" class="col-sm-3 col-form-label text-right"><?php echo display('currency_icon'); ?> <i class="text-danger">*</i></label>
                    <div class="col-sm-6">
                        <input class="form-control" name="curr_icon" id="curr_icon" type="text">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="form-group offset-3 col-sm-2">
                        <input type="button" onclick="currency_save()" class="btn btn-info btn-large" value="<?php echo display('save'); ?>">
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!-- language -->  
                <table class="table table-bordered table-sm" id="currencylist">
                    <thead>
                        <tr>
                            <th width="10%"><i class="fa fa-th-list"></i></th>
                            <th width="50%"><?php echo display('currencyname'); ?></th>
                            <th width="20%" class="text-left"><?php echo display('icon'); ?></th>
                            <th width="20%" class="text-left"><?php echo display('action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody> 
                </table>  

            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="currencymodal_info" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title currencymodal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="currencyinfo">

            </div>                    
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/currency.js') ?>"></script>