<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">  
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard/language") ?>"> <i class="fa fa-list"></i>  <?php echo display('language_list') ?> </a> 
                </div> 
            </div>

            <div class="card-body">                  
                <div class="float-right">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <?php echo form_open('dashboard/language/addPhrase', ' class="form-inline" ') ?> 
                                    <div class="form-group mr-2">
                                        <label class="sr-only" for="addphrase"> <?php echo display('phrase_name'); ?></label>
                                        <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><?php echo display('save'); ?></button>
                                    <?php echo form_close(); ?>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-th-list"></i></th>
                                <th><?php echo display('phrase'); ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($phrases)) { ?>
                                <?php $sl = 1 ?>
                                <?php foreach ($phrases as $value) { ?>
                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo html_escape($value->phrase) ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table> 
                </div> 

                <div class="float-right">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div>


        </div>
    </div>
</div>