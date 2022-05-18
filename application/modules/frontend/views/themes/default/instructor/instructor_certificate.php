 <?php echo form_open_multipart($enterprise_shortname .'/instructor-certificate-save','id="instructor_certificate"')?>
    <div class="form-group row">
        <label for="certificatename" class="col-md-4">Certificate Name <i class="text-danger"> *</i></label>
        <div class="col-md-8">
            <input name="certificatename" type="text" class="form-control" id="certificatename" placeholder="Certificate Name"
                value="" required>
        </div>
    </div> <br>
    <div class="form-group row">
        <label for="pyear" class="col-md-4">Year <i class="text-danger"> *</i></label>
        <div class="col-md-8">
            <select class="form-select" id="pyear" name="pyear">
                <option  value="">Choose Year</option>
                  <?php 
                                    $cy = (int)date('Y');
                                    $y = 2005; ?>
                                    <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                    <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                    <?php } ?>
            </select>
        </div>
    </div> 
     <br>
      <div class="form-group row">
        <label for="organization_logo" class="col-md-4"> Organization Logo </label>
        <div class="col-md-8">
            <input name="organization_logo" type="file" class="form-control" id="organization_logo" 
                value="">
        </div>
    </div>
     <br>
      <div class="form-group row">
        <label for="certificate" class="col-md-4">Upload Certificate </label>
        <div class="col-md-8">
            <input name="certificate" type="file" class="form-control" id="certificate" 
                value="">
        </div>
    </div> <br>
    <div class="form-group row">
        <div class="offset-4 mb-3">
            <input type="hidden"  name="faculty_id" value="<?php echo $faculty_id?>">
            <button type="button" id="new_certificate_add" class="btn btn-dark-cerulean"
                ><?php echo display('save') ?></button>
        </div>
    </div>
<?php echo form_close()?>