<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$position = $setting->currency_position;
$currency = $setting->currency;
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover bg-white m-0 dt-responsive">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo display('sl') ?></th>
                            <th width="25%"><?php echo display('course') ?></th>
                            <th width="12%" class="text-right"><?php echo display('total_sales') ?></th>
                            <th width="10%" class="text-right"><?php echo display('price') ?></th>
                            <th width="15%" class="text-right"><?php echo display('commission') ?><span class="text-danger"> (%)</span></th>
                            <th width="18%" class="text-right"><?php echo display('commission_rate') ?></th>
                            <th width="15%" class="text-right"><?php echo display('total_revenue') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl = 0 + $pagenum;
                        $t_sales = $t_price = $t_commission = $t_commissionrate = $t_revenue = 0;
                        foreach ($adminrevenue_courses as $course) {
                            $course_totalsales = $this->Course_model->course_totalsales($course->course_id);
                            $sl++;
                            ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($course->name); ?></td>
                                <td class="text-right">
                                    <?php
                                    $t_sales += $course_totalsales->totalsales;
                                    echo html_escape(($course_totalsales->totalsales) ? "$course_totalsales->totalsales" : "0");
                                    ?>
                                </td>
                                <td class="text-right">
                                    <?php
                                    $t_price += $course->price;
                                    echo html_escape(($position == 1) ? "$currency $course->price" : "$course->price $currency");
                                    ?>
                                </td>
                                <td class="text-right">
                                    <?php
                                    $commission = 100 - $course->commission;
                                    $t_commission += $commission;
                                    echo html_escape($commission);
                                    ?>
                                </td>
                                <td class="text-right">
                                    <?php
                                    $commission_rate = ($course->price * $commission) / 100;
                                    $t_commissionrate += $commission_rate;
                                    echo html_escape(($position == 1) ? "$currency $commission_rate" : "$commission_rate $currency");
                                    ?>
                                </td>
                                <td class="text-right">
                                    <?php
                                    $total_revenue = ($course_totalsales->totalsales * $commission_rate);
                                    $t_revenue += $total_revenue;
                                    echo html_escape(($position == 1) ? "$currency $total_revenue" : "$total_revenue $currency");
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right"><?php echo display('total'); ?></th>
                            <th class="text-right"><?php echo html_escape(($position == 1) ? "$t_sales" : "$t_sales"); ?></th>
                            <th class="text-right"><?php echo html_escape(($position == 1) ? "$currency $t_price" : "$t_price $currency"); ?></th>
                            <th class="text-right"></th>
                            <th class="text-right"><?php echo html_escape(($position == 1) ? "$currency $t_commissionrate" : "$t_commissionrate $currency"); ?></th>
                            <th class="text-right"><?php echo html_escape(($position == 1) ? "$currency $t_revenue" : "$t_revenue $currency"); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
                <?php echo htmlspecialchars_decode($links); ?>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>