<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('language'); ?>
                    <small class="float-right">
                        <input type="text" class="form-control" placeholder="<?php echo display('search'); ?> ..." onkeyup="phraselabel(this.value)">
                    </small>
                </h4>
            </div> 

            <div class="card-body results">
                <div class="float-right">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
                <?php echo form_open('dashboard/language/addlebel') ?>
                <table class="table table-striped table-sm">
                    <thead> 
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th><?php echo display('phrase') ?></th>
                            <th><?php echo display('label') ?></th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php echo form_hidden('language', $language) ?>
                        <?php if (!empty($phrases)) { ?>
                            <?php $sl = 1 + $pagenum; ?>
                            <?php foreach ($phrases as $value) { ?>
                                <tr <?php echo (empty($value->$language) ? "class='pe_bg'" : null) ?>>

                                    <td><?php echo  $sl++ ?></td>
                                    <td><input type="text" name="phrase[]" value="<?php echo html_escape($value->phrase) ?>" class="form-control" readonly></td>
                                    <td><input type="text" name="lang[]" value="<?php echo html_escape($value->$language) ?>" class="form-control"></td> 
                                </tr>
                            <?php } ?>
                        <?php } ?> 
                    </tbody>
                    <?php echo  form_close() ?>
                </table>
                <?php echo form_close() ?>
                <div class="float-right">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
                <button type="submit" class="btn btn-success" id="disabled_btn"><?php echo display('save') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('application/modules/dashboard/assets/js/settings.js'); ?>">
    