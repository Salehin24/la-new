<table class="table table-border">
    <tr>
        <th><?php echo display('name'); ?></th>
        <th>:</th>
        <td>
            <?php  echo $show_instructorinfo->name; ?>
        </td>
    </tr>
    <tr>
        <th><?php echo display('email'); ?></th>
        <th>:</th>
        <td>
            <?php  echo $show_instructorinfo->email; ?>
        </td>
    </tr>
    <tr>
        <th><?php echo display('mobile'); ?></th>
        <th>:</th>
        <td>
            <?php  echo $show_instructorinfo->mobile; ?>
        </td>
    </tr>
        <th><?php echo display('date_of_birth'); ?></th>
        <th>:</th>
        <td>
            <?php  echo $show_instructorinfo->birthday; ?>
        </td>
    </tr>
    <?php if($show_instructorinfo->picture){ ?>
    <tr>
        <th><?php echo display('picture'); ?></th>
        <th>:</th>
        <td>
            <div class="img_border">
                <img src="<?php echo base_url(html_escape($show_instructorinfo->picture)); ?>"
                    alt="<?php echo html_escape($show_instructorinfo->name); ?>" width="20%">
            </div>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="3" class="text-right">
            <a href="<?php echo base_url(enterpriseinfo()->shortname . '/faculty-edit/'.$show_instructorinfo->faculty_id); ?>"><i class="fa fa-edit btn btn-info btn-sm"> </i></a>
        </th>
    </tr>
</table>