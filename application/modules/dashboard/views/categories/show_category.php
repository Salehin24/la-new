<table class="table table-border">
    <tr>
        <th><?php echo display('name'); ?></th>
        <th>:</th>
        <td>
            <?php  echo $edit_data->name; ?>
        </td>
    </tr>
    
    <?php if($edit_data->picture){ ?>
    <tr>
        <th><?php echo display('picture'); ?></th>
        <th>:</th>
        <td>
            <div class="img_border">
                <img src="<?php echo base_url(html_escape($edit_data->picture)); ?>"
                    alt="<?php echo html_escape($edit_data->name); ?>" width="20%">
            </div>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="3" class="text-right">
            <a href="<?php echo base_url(enterpriseinfo()->shortname . '/category-edit/'.$edit_data->category_id); ?>"><i class="fa fa-edit btn btn-info btn-sm"> </i></a>
        </th>
    </tr>
</table>