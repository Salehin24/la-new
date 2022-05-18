<?php
$this->load->model('Home_model');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$position = $setting->currency_position;
$currency = $setting->currency;

$get_facultyCourse = $this->Course_model->get_facultyCourse($faculty_info->faculty_id);
$totalamounts = 0;
$courseids = '';
foreach ($get_facultyCourse as $course) {
    $invoiceDetails = $this->db->select('count(quantity) as quantity, price')->from('invoice_details')->where('status', 1)->where('product_id', $course->course_id)->get()->row();
    $commissions = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
    $commission_rate = ($invoiceDetails->price * $commissions->commission) / 100;
    $totalamounts += $invoiceDetails->quantity * $commission_rate;

    $courseids .= "'" . $course->course_id . "',";
}
$course_ids = rtrim($courseids, ",");
if ($course_ids) {
    $faculty_course_totalsales = $this->Course_model->faculty_course_totalsales($course_ids);
    $total_sales = $faculty_course_totalsales->totalsales;
}
$faculty_paidamounts = $this->Faculty_model->faculty_paidamount($faculty_info->faculty_id);
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        <?php echo display('total_sales'); ?>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                        <span class="text-success text-size-2 text-monospace">
                            <?php echo html_escape(($total_sales) ? "$total_sales" : "0"); ?>
                        </span> <?php echo display('items'); ?>
                    </div>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        <?php echo display('total_earning'); ?>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                        <span class="text-success text-size-2 text-monospace">
                            <?php
                            $totalEarning = $this->Home_model->changeformat($totalamounts);
                            echo html_escape(($position == 1) ? "$currency$totalEarning" : "$totalEarning$currency");
                            ?>
                        </span> 
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        <?php echo display('paid_amount'); ?>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                        <span class="text-success text-size-2 text-monospace">
                            <?php
                            $paidamount_format = $this->Home_model->changeformat($faculty_paidamounts->paidamount);
                            $paidamount_format = ($paidamount_format) ? "$paidamount_format" : "0";
                            echo html_escape(($position == 1) ? "$currency$paidamount_format" : "$paidamount_format$currency");
                            ?>
                        </span> 
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
                    <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                        <?php echo display('pending_amount'); ?>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                        <span class="text-success text-size-2 text-monospace">
                            <?php
                            $pending_amount = $totalamounts - $faculty_paidamounts->paidamount;
                            $pending_amount = $this->Home_model->changeformat($pending_amount);
                            echo html_escape(($position == 1) ? "$currency$pending_amount" : "$pending_amount$currency");
                            ?>
                        </span>
                    </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="w-100"><?php echo html_escape($faculty_info->name); ?> </h4>
                <div class="input-group">
                    <input type="text" id="yearmonth_picker" class="form-control" value="<?php echo date('yy-m'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="yearmonthly_myrevenue('<?php echo html_escape($faculty_info->faculty_id); ?>')"><i class="fa fa-search"> </i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table yearmonth_results">
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
                        $sl = $totalsales = $t_price = $t_commission = $t_rate = $t_sales = $t_amount = 0;
                        if ($faculty_course_revenue) {
                            foreach ($faculty_course_revenue as $single) {
                                $total_sales = $this->Course_model->course_totalsales($single->course_id);
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