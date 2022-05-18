<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div id="loading" style="display: none; text-align: center;">
                <img id="loading-image" src="<?php echo base_url('assets/img/box.gif'); ?>" alt="Loading..." />
            </div>
            <div class="row waitmsg" style="display: none;">
                <div class="col-md-12">
                    <h3 class="text-center">The Module is installing now... Please wait for <span id="wait"> 10</span> Seconds.</h3>
                </div> 
            </div> 
            <h4 class="card-header"><?php echo (!empty($title) ? $title : null) ?>
                <small class="float-right">
                    <a href="<?php echo base_url('add-ons'); ?>" class="btn btn-success btn-xs">
                        <?php echo display('add_ons'); ?>
                    </a>
                </small>
            </h4>
            <div class="card-body">
                <center>                     
                    <?php echo form_open_multipart('javascript:void(0)', 'id="purchase" id="myform"'); ?>
                    <div class="form-group has-success col-sm-6">
                        <label class="form-control-label" for="purchase_key"><?php echo display('purchase_key'); ?></label>
                        <input type="text" class="form-control form-control-success text-center" id="purchase_key" placeholder="Enter your purchase key">
                        <div class="form-feedback"><?php echo display('success'); ?> ! <?php echo display('almost_done_it'); ?>.</div>
                        <small class="text-muted"><?php echo display('you_got_a_purchase_key'); ?></small>
                        <br>
                        <input type="hidden" name="itemtype" id="itemtype" value="module">
                    </div>
                    <div class="form-group">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/add-ons'); ?>" class="btn btn-danger" data-dismiss="modal"><?php echo display('cancel'); ?></a>
                        <button type="submit" class="btn btn-success" id="install_now"><?php echo display('verify'); ?> &amp; <?php echo display('install_now'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </center>
            </div>
        </div>
    </div>

</div>
