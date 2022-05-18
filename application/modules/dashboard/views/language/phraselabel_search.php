
<?php echo form_open('dashboard/language/addlebel') ?>
<table class="table table-striped table-sm results">
    <thead> 
        <tr>
            <th><i class="fa fa-th-list"></i></th>
            <th><?php echo display('phrase'); ?></th>
            <th><?php echo display('label'); ?></th> 
        </tr>
    </thead>

    <tbody>
        <?php echo form_hidden('language', $language) ?>
        <?php if (!empty($phrases)) { ?>
            <?php $sl = 1; ?>
            <?php foreach ($phrases as $value) { ?>
                <tr <?php echo (empty($value->$language) ? "class='pe_bg'" : null) ?>>
                    <td><?php echo $sl++ ?></td>
                    <td><input type="text" name="phrase[]" value="<?php echo html_escape($value->phrase) ?>" class="form-control" readonly></td>
                    <td><input type="text" name="lang[]" value="<?php echo html_escape($value->$language) ?>" class="form-control"></td> 
                </tr>
            <?php } ?>
        <?php } ?> 
    </tbody>
    <?php echo form_close() ?>
</table>
<button type="submit" class="btn btn-success"><?php echo display('save'); ?></button>
<?php echo form_close() ?>