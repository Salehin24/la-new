<?php echo form_open_multipart('pay-with-paypal-submit', 'class="input-line form-input" role="form"'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-input-group">               
                <div class="form-group">
                    <label class="required" for="name"><?php echo display('name'); ?></label>
                    <input class="form-control" id="name" name="name" placeholder="Your Name" type="text" readonly />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-input-group">               
                <div class="form-group">
                    <label class="required" for="facultypaypal"><?php echo display('paypal_account'); ?></label>
                    <input class="form-control" id="facultypaypal" placeholder="Paypal Account" type="text" name="facultypaypal" required readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-input-group">               
                <div class="form-group">
                    <label class="required" for="total_balance"><?php echo display('total_balance'); ?></label>
                    <input class="form-control" id="total_balance" name="total_balance" placeholder="Total balance" type="text" readonly />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-input-group">               
                <div class="form-group">
                    <label class="required" for="payment_amount"><?php echo display('payment_amount'); ?></label>
                    <input class="form-control" id="payment_amount" name="payment_amount" placeholder="Payment Amout" type="text"   onkeyup="onlynumber_allow(this.value, 'payment_amount')"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 center">              
            <input type="hidden" id="faculty_id" name="faculty_id">
            <input type="submit" class="btn btn-success btn-block transition-hover mt-4 mb-2" id="checksubmit" value="<?php echo display('pay_now'); ?>">
        </div>
    </div>
    <div class="text-center">
        
    </div>
<?php echo form_close(); ?>