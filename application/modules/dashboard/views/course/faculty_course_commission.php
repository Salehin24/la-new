<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$position = $setting->currency_position;
$currency = $setting->currency;

$get_facultyCourse = $this->Course_model->get_facultyCourse($user_id);
$totalamounts = 0;
foreach ($get_facultyCourse as $course) {
    $invoiceDetails = $this->db->select('count(quantity) as quantity')->from('invoice_details')->where('product_id', $course->course_id)->get()->row();
    $commissions = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
    $totalamounts += $invoiceDetails->quantity * $commissions->commission;
}
if ($user_type != 1) {
    ?>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('total_course'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php echo html_escape($quick_view['total_course']); ?>
                            </span> Items
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('total_sales'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php echo html_escape($quick_view['total_sales']); ?>
                            </span> Items
                        </div>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('total_amount'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php echo html_escape(($position == 1) ? "$currency$totalamounts" : "$totalamounts$currency"); ?>
                            </span> 
                        </div>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('comming_soon'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                2
                            </span> Items
                        </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php } ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">

                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                    <thead>
                        <tr>
                            <th><?php echo display('sl') ?></th>
                            <th><?php echo display('course') ?></th>
                            <?php if ($user_type == 1) { ?>
                                <th><?php echo display('faculty') ?></th>
                            <?php } ?>
                            <th class="text-right"><?php echo display('price') ?></th>
                            <th class="text-right"><?php echo display('commission'); ?> <i class="text-danger">(%)</i></th>
                            <th class="text-right"><?php echo display('rate') ?></th>
                            <th class="text-right"><?php echo display('total_sales') ?></th>
                            <th class="text-right"><?php echo display('total_amount') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($faculty_course_commission) {
                            $sl = $totalsales = $t_price = $t_commission = $t_rate = $t_sales = $t_amount = 0;
                            foreach ($faculty_course_commission as $single) {
                                $total_sales = $this->Course_model->course_totalsales($single->course_id);
                                $sl++;
                                ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($single->name); ?></td>
                                    <?php if ($user_type == 1) { ?>
                                        <td><?php echo html_escape($single->faculty_name); ?></td>
                                    <?php } ?>
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
                                        $t_rate += $single->commission_rate;
                                        echo html_escape(($position == 1) ? "$currency $single->commission_rate" : "$single->commission_rate $currency");
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
                                        $t_amount += ($totalsales * $single->commission_rate);
                                        $totalamount = $totalsales * $single->commission_rate;
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
                            <th class="text-right" colspan="<?php
                            if ($user_type == 1) {
                                echo "3";
                            } else {
                                echo "2";
                            }
                            ?>"><?php echo display('total'); ?></th>
                            <th class="text-right"><?php echo html_escape($t_price); ?></th>
                            <th class="text-right"><?php echo html_escape($t_commission); ?></th>
                            <th class="text-right"><?php echo html_escape($t_rate); ?></th>
                            <th class="text-right"><?php echo html_escape($t_sales); ?></th>
                            <th class="text-right"><?php echo html_escape($t_amount); ?></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <div class="">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>