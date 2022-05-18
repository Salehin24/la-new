<?php
$position = $setting->currency_position;
$currency = $setting->currency;
?>
<thead>
    <tr>
        <th width="10%"><?php echo display('sl_no'); ?></th>
        <th width="60%"><?php echo display('course_name'); ?></th>
        <th width="30%" class="text-right"><?php echo display('price'); ?></th>
    </tr>
</thead>
<?php if ($todays_salesreport) { ?>
    <tbody>
        <?php
        $sl = $price = 0;
        foreach ($todays_salesreport as $salesreport) {
            $sl++
            ?>
            <tr>
                <td><?php echo $sl; ?></td>
                <td><?php echo html_escape($salesreport->name); ?></td>
                <td class="text-right">
                    <?php
                    $price += $salesreport->price;
                    echo html_escape(($position == 1) ? "$currency $salesreport->price" : "$salesreport->price $currency");
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2" class="text-right"><?php echo display('total'); ?></th>
            <th class="text-right">
                <?php echo html_escape((($position == 1) ? "$currency $price" : "$price $currency")); ?>
            </th>
        </tr>
    </tfoot>
<?php } else { ?>
    <tfoot>
        <tr>
            <th colspan="6" class="text-center text-danger"><?php echo display('record_not_found'); ?></th>
        </tr>
    </tfoot>
<?php } ?>
