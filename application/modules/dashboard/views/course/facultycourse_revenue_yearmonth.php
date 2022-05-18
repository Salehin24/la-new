<?php
$position = $setting->currency_position;
$currency = $setting->currency;
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
?>
<thead>
    <tr>
        <th width="10%"><?php echo display('sl') ?></th>
        <th width="30%"><?php echo display('course') ?></th>
        <th width="10%" class="text-right"><?php echo display('price') ?></th>
        <th width="15%" class="text-right"><?php echo display('commission'); ?> <i class="text-danger">(%)</i></th>
        <th width="10%" class="text-right"><?php echo display('rate') ?></th>
        <th width="10%" class="text-right"><?php echo display('total_sales') ?></th>
        <th width="15%" class="text-right"><?php echo display('total_earning') ?></th>
    </tr>
</thead>
<tbody>
    <?php
    if ($facultycourse_revenue_yearmonth) {
        $sl = $totalsales = $t_price = $t_commission = $t_rate = $t_sales = $t_amount = 0;
        foreach ($facultycourse_revenue_yearmonth as $single) {
            $total_sales = $this->Course_model->course_totalsales_yearmonth($single->course_id, $year, $month, $user_id, $user_type);
            $sl++;
            ?>
            <tr>
                <td><?php echo $sl; ?></td>
                <td><?php echo html_escape($single->name); ?></td>
                <td class="text-right">
                    <?php
                    $t_price += $single->price;
                    echo html_escape(($position == 1) ? "$currency $single->price" : "$single->price $currency");
                    ?>
                </td>
                <td class="text-right">
                    <?php
                    $t_commission += $single->commission;
                    echo html_escape($single->commission);
                    ?>
                </td>
                <td class="text-right">
                    <?php
                    $commission_rate = ($single->price * $single->commission) / 100;
                    $t_rate += $commission_rate;
                    echo html_escape(($position == 1) ? "$currency $commission_rate" : "$commission_rate $currency");
                    ?>
                </td>
                <td class="text-right">
                    <?php
                    $t_sales += $total_sales->totalsales;
                     $totalsales = empty(!$total_sales->totalsales) ? "$total_sales->totalsales" : "0";
                     echo html_escape($totalsales);
                    ?>
                </td>
                <td class="text-right">
                    <?php
                    $t_amount += ($totalsales * $commission_rate);
                    $totalamount = $totalsales * $commission_rate;
                    echo html_escape(($position == 1) ? "$currency $totalamount" : "$totalamount $currency)");
                    ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
<tfoot>
    <tr>
        <th class="text-right" colspan="2"><?php echo display('total'); ?></th>
        <th class="text-right"><?php echo html_escape((!empty($t_price) ? "$t_price" : "")); ?></th>
        <th class="text-right"><?php echo html_escape((!empty($t_commission) ? "$t_commission" : "")); ?></th>
        <th class="text-right"><?php echo html_escape((!empty($t_rate) ? "$t_rate" : "")); ?></th>
        <th class="text-right"><?php echo html_escape((!empty($t_sales) ? "$t_sales" : "")); ?></th>
        <th class="text-right"><?php echo html_escape((!empty($t_amount) ? "$t_amount" : "")); ?></th>
    </tr>
</tfoot>
