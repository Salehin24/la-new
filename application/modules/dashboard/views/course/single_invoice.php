<?php
$currency = $setting->currency;
$position = $setting->currency_position;
?> 
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8">
        <div class="header p-0 ml-0 mr-0 shadow-none">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="header-pretitle fs-10 font-weight-bold text-muted text-uppercase mb-1">Payments</h6>
                        <h1 class="header-title fs-25 font-weight-600">Invoice No: INV-000567F7-00</h1>
                    </div>
                    
                </div> 
            </div>
        </div>
        <!--/.End of header-->
        <div class="card card-body p-5" id="printableArea">
            <div class="row">
                <div class="col text-right">
                    <div class="badge badge-success">Paid</div>
                </div>
            </div> 
            <div class="row">
                <div class="col text-center">
                    <img src="<?php echo base_url(html_escape($setting->logo)); ?>" alt="..." class="img-fluid mb-4">
                    <h4 class="mb-0 font-weight-bold">Invoice from <?php echo html_escape($setting->title); ?></h4>
                    <p class="text-muted mb-5">Invoice: <?php echo html_escape($get_invoice_info->invoice_id); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h6 class="text-uppercase text-muted fs-12 font-weight-600">Invoiced To</h6>
                    <p class="text-muted mb-4">
                        <strong class="text-body fs-16"><?php echo html_escape($get_invoice_info->name); ?></strong> <br>
                        <?php echo html_escape($get_invoice_info->address); ?> <br>
                        <?php echo html_escape($get_invoice_info->email); ?> <br>
                        <?php echo html_escape($get_invoice_info->mobile); ?>
                    </p>
                    <h6 class="text-uppercase text-muted fs-12 font-weight-600">Invoiced ID</h6>
                    <p class="mb-4"><?php echo html_escape($get_invoice_info->invoice_id); ?></p>
                </div>
                <div class="col-12 col-md-6 text-md-right">
                    <h6 class="text-uppercase text-muted fs-12 font-weight-600">Invoiced From</h6>
                    <p class="text-muted mb-4">
                        <strong class="text-body fs-16"><?php echo $setting->title; ?></strong> <br>
                        <?php echo html_escape($setting->address); ?> <br>
                        <?php echo html_escape($setting->email); ?> <br>
                        <?php echo html_escape($setting->phone); ?>
                    </p>
                    <h6 class="text-uppercase text-muted fs-12 font-weight-600"> Due date</h6>
                    <p class="mb-4"><time datetime="2018-04-23">Apr 23, 2018</time></p>
                </div>
            </div> 
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table my-4">
                            <thead>
                                <tr>
                                    <th class="px-0 bg-transparent border-top-0">
                                        <span class="h6 font-weight-bold"><?php echo display('course_name'); ?></span>
                                    </th>
                                    <th class="px-0 bg-transparent border-top-0">
                                        <span class="h6 font-weight-bold"><?php echo display('quantity'); ?></span>
                                    </th>
                                    <th class="px-0 bg-transparent border-top-0 text-right">
                                        <span class="h6 font-weight-bold"><?php echo display('rate'); ?></span>
                                    </th>
                                    <th class="px-0 bg-transparent border-top-0 text-right">
                                        <span class="h6 font-weight-bold"><?php echo display('total_amount'); ?></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 0;
                                foreach ($get_invoicedetails as $single) {
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td class="px-0">
                                            <?php echo html_escape($single->name); ?>
                                        </td>
                                        <td class="px-0">
                                            <?php echo html_escape($single->quantity); ?>
                                        </td>
                                        <td class="px-0 text-right">
                                            <?php echo html_escape((($position == 0) ? "$currency $single->price" : "$single->price $currency")); ?>
                                        </td>
                                        <td class="px-0 text-right">
                                            <?php echo html_escape((($position == 0) ? "$currency $single->total_price" : "$single->total_price $currency")); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="px-0 border-top border-top-2 text-right" colspan="2">
                                        <strong><?php echo display('grand_total'); ?></strong>
                                    </td>
                                    <td colspan="2" class="px-0 text-right border-top border-top-2">
                                        <span class="fs-16 font-weight-600">
                                            <?php echo html_escape((($position == 0) ? "$currency $get_invoice_info->total_amount" : "$get_invoice_info->total_amount $currency")); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 border-top border-top-2 text-right" colspan="2">
                                        <strong><?php echo display('paid_amount'); ?></strong>
                                    </td>
                                    <td colspan="2" class="px-0 text-right border-top border-top-2">
                                        <span class="fs-16 font-weight-600">
                                            <?php echo html_escape((($position == 0) ? "$currency $get_invoice_info->paid_amount" : "$get_invoice_info->paid_amount $currency")); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 border-top border-top-2 text-right" colspan="2">
                                        <strong><?php echo display('due_amount'); ?></strong>
                                    </td>
                                    <td colspan="2" class="px-0 text-right border-top border-top-2">
                                        <span class="fs-16 font-weight-600">
                                            <?php echo html_escape((($position == 0) ? "$currency $get_invoice_info->due_amount" : "$get_invoice_info->due_amount $currency")); ?>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="my-5">
                    <h6 class="text-uppercase font-weight-bold">Comments </h6>
                    <p class="text-muted mb-0">
                        Demo data
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>