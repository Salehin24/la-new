<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo 'Payeer Payment' ?></title>
        <link href="<?php echo base_url('application/modules/frontend/views/themes/default/assets/plugins/bootstrap-4.5.0/css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <div class="container"><br>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 pb-5">

                    <!--Form with header-->
                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-info text-white text-center py-2">
                                <h3>Payeer Payment</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <!--Body-->
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo display("customer_id") ?></th>
                                    <td class="text-right"><?php echo $user_id ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("order_no") ?></th>
                                    <td class="text-right"><?php echo $m_orderid ?></td>
                                </tr>
                                <tr>
                                    <th><?php echo display("total_amount") ?></th>
                                    <td class="text-right"><?php echo get_currencyiconposition(get_appsettings()->currency, get_appsettings()->currency_position, $m_amount) ?></td>
                                </tr>
                            </table>

                            <div class="form-group">
                                <form method="post" action="https://payeer.com/merchant/">
                                    <input type="hidden" name="m_shop" value="<?php echo $m_shop ?>">
                                    <input type="hidden" name="m_orderid" value="<?php echo $m_orderid ?>">
                                    <input type="hidden" name="m_amount" value="<?php echo $m_amount ?>">
                                    <input type="hidden" name="m_curr" value="<?php echo $m_curr ?>">
                                    <input type="hidden" name="m_desc" value="<?php echo $m_desc ?>">
                                    <input type="hidden" name="m_sign" value="<?php echo $sign ?>">
                                    
                                    <a href="<?php echo base_url('checkout'); ?>" class="btn btn-primary  w-md m-b-5">
                                        <?php echo display("cancel"); ?>
                                    </a>
                                    <button type="submit" class="btn btn-success"><?php echo display('send'); ?></button>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                    <!--Form with header-->
                </div>
            </div>
        </div>
    </body>
</html>