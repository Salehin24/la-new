<?php
$this->load->model('Home_model');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$position = $setting->currency_position;
$currency = $setting->currency;

if ($user_type == 1) {
    $get_facultyCourse = $this->Course_model->get_course();
    $totalamounts = $paidamount = 0;
    foreach ($get_facultyCourse as $course) {
        $invoiceDetails = $this->db->select('count(quantity) as quantity, price')->from('invoice_details')->where('status', 1)->where('product_id', $course->course_id)->get()->row();
        $commissions = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
        $commission_rate = ($invoiceDetails->price * $commissions->commission) / 100;
        $totalamounts += $invoiceDetails->quantity * $commission_rate;
    }
    $paidamount = $this->db->select('sum(amount) as paidamount')->from('ledger_tbl')->where('d_c', 'd')->get()->row();
    ?>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('total_sales'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php echo html_escape($quick_view['total_sales']); ?>
                            </span> <?php echo display('items') ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
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
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('paid_amount'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php
                                $paidamount_format = $this->Home_model->changeformat($paidamount->paidamount);
                                $paidamount = $paidamount->paidamount;
                                echo html_escape(($position == 1) ? "$currency$paidamount_format" : "$paidamount_format$currency");
                                ?>
                            </span> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('pending_amount'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php
                                $pending_amount = $totalamounts - $paidamount;
                                $pending_amount = $this->Home_model->changeformat($pending_amount);
                                echo html_escape(($position == 1) ? "$currency$pending_amount" : "$pending_amount $currency");
                                ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
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
                        <!-- <table id="example" class="table table-striped table-bordered"> -->
                        <table id="example" class="table table-striped table-bordered dt-responsive  table-hover results">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('faculty') ?></th>
                                    <th class="text-center"><?php echo display('total_sales') ?></th>
                                    <th class="text-right"><?php echo display('total_amount') ?></th>
                                    <th class="text-right"><?php echo display('paid_amount') ?></th>
                                    <th class="text-right"><?php echo display('balance') ?></th>
                                    <?php if ($user_type == 1) { ?>
                                        <th class="text-center">
                                            <?php echo display('action'); ?>
                                        </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($facultycourse_list) {
                                    $sl = 0;
                                    foreach ($facultycourse_list as $faculty) {
                                        $get_facultyCourse = $this->Faculty_model->get_facultyCourse($faculty->faculty_id);
                                        $faculty_paidamounts = $this->Faculty_model->faculty_paidamount($faculty->faculty_id);
                                        $courseids = '';
                                        foreach ($get_facultyCourse as $facultycourse) {
                                            $courseids .= "'" . $facultycourse->course_id . "',";
                                        }
                                        $course_ids = rtrim($courseids, ",");
                                        $faculty_course_totalsales = $this->Course_model->faculty_course_totalsales($course_ids);

                                        $sl++;
                                        $totalamounts = 0;
                                        foreach ($get_facultyCourse as $course) {
                                            $invoiceDetails = $this->db->select('count(quantity) as quantity, price')->from('invoice_details')->where('status', 1)->where('product_id', $course->course_id)->get()->row();
                                            $commissions = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
                                            $commission_rate = ($invoiceDetails->price * $commissions->commission) / 100;
                                            $totalamounts += $invoiceDetails->quantity * $commission_rate;
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $sl; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('faculty-course-revenue/' . html_escape($faculty->faculty_id)); ?>">
                                                    <?php echo html_escape($faculty->name); ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                echo html_escape((($faculty_course_totalsales->totalsales) ? "$faculty_course_totalsales->totalsales" : "0"));
                                                ?>
                                            </td> 
                                            <td class="text-right">
                                                <?php
                                                $totalamounts = $totalamounts;
                                                echo html_escape(($position == 1) ? "$currency $totalamounts" : "$totalamounts $currency");
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                $paidamount = ($faculty_paidamounts->paidamount) ? "$faculty_paidamounts->paidamount" : "0";
                                                echo html_escape(($position == 1) ? "$currency $paidamount" : "$paidamount $currency");
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                $balance = $totalamounts - $paidamount;
                                                echo html_escape(($position == 1) ? "$currency $balance" : "$balance $currency");
                                                ?>
                                            </td> 
                                            <?php if ($user_type == 1) { ?>
                                                <td class="text-center">
                                                    <input type="hidden" id="ttlbalance_<?php echo $sl; ?>" value="<?php echo html_escape($balance); ?>">
                                                    <input type="hidden" id="facultyname_<?php echo $sl; ?>" value="<?php echo html_escape($faculty->name); ?>">
                                                    <input type="hidden" id="facultyid_<?php echo $sl; ?>" value="<?php echo html_escape($faculty->faculty_id); ?>">
                                                    <input type="hidden" id="facultypaypal_<?php echo $sl; ?>" value="<?php echo html_escape($faculty->paypal); ?>">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="paywith_paypal('<?php echo html_escape($faculty->faculty_id); ?>', '<?php echo $sl; ?>')">
                                                        <?php echo display('pay_with_paypal'); ?>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <div class="">
                        <?php echo htmlspecialchars_decode($links); ?>
                    </div>

                    <!-- The Modal -->
                    <div class="modal" id="payModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php echo display('pay_with_paypal'); ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body" id="payform">

                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close'); ?></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php
} elseif ($user_type == 3) {
    $get_facultyCourse = $this->Course_model->get_facultyCourse($faculty_info->faculty_id);
    $totalamounts = 0;
    foreach ($get_facultyCourse as $course) {
        $invoiceDetails = $this->db->select('count(quantity) as quantity, price')->from('invoice_details')->where('status', 1)->where('product_id', $course->course_id)->get()->row();
        $commissions = $this->db->select('*')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
        $commission_rate = ($invoiceDetails->price * $commissions->commission) / 100;
        $totalamounts += $invoiceDetails->quantity * $commission_rate;
    }
    $faculty_paidamounts = $this->Faculty_model->faculty_paidamount($faculty_info->faculty_id);
    ?>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('total_sales'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php echo html_escape($quick_view['total_sales']); ?>
                            </span> <?php echo display('items') ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
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
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
                        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                            <?php echo display('paid_amount'); ?>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa fa-long-arrow-alt-up text-success"></i>
                            <span class="text-success text-size-2 text-monospace">
                                <?php
                                $paidamount = $this->Home_model->changeformat($faculty_paidamounts->paidamount);
                                $paidamount = ($paidamount) ? "$paidamount" : "0";
                                echo html_escape(($position == 1) ? "$currency$paidamount" : "$paidamount$currency");
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="p-2 bg-white rounded mb-3 shadow-sm">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="w-100"><?php echo display('my_revenue'); ?></h4>
                    <div class="input-group">
                        <input type="text" id="yearmonth_picker" class="form-control" value="<?php echo date('yy-m'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button" onclick="yearmonthly_myrevenue('<?php echo $user_id; ?>')"><i class="fa fa-search"> </i></button>
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
                                if ($faculty_course_revenue) {
                                    $sl = $totalsales = $t_price = $t_commission = $t_rate = $t_sales = $t_amount = 0;
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
                                                echo html_escape($totalsales = empty(!$total_sales->totalsales) ? "$total_sales->totalsales" : "0");
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
                                    <th class="text-right"><?php echo html_escape(!empty($t_price) ? "$t_price" : ""); ?></th>
                                    <th class="text-right"><?php echo html_escape(!empty($t_commission) ? "$t_commission" : ""); ?></th>
                                    <th class="text-right"><?php echo html_escape(!empty($t_rate) ? "$t_rate" : ""); ?></th>
                                    <th class="text-right"><?php echo html_escape(!empty($t_sales) ? "$t_sales" : ""); ?></th>
                                    <th class="text-right"><?php echo html_escape(!empty($t_amount) ? "$t_amount" : ""); ?></th>
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
<?php } ?>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>