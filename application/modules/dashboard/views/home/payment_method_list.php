<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('payment_method_list') ?> </h6><hr>
        </div>
    </div>
    <div class="panel-body">
        <table class="table display table-bordered table-striped bg-white m-0 card-table" id="RoleTbl">
            <thead>
                <tr>
                    <th width="10%"><?php echo display('sl_no') ?></th>
                    <th width="50%"><?php echo display('name') ?></th>
                    <th width="10%" class='text-center'><?php echo display('status') ?></th>
                    <th width="30%" class='text-center'><?php echo display('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($payment_method_list) {
                    $sl = 0;
                    foreach ($payment_method_list as $method) {
                        $sl++;
                        ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo html_escape($method->title); ?></td>
                            <td class="text-center">
                                <?php
                                if ($method->status == 1) {
                                    echo display('active');
                                } else {
                                    echo display('inactive');
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($method->status == 1) {
                                    ?>
                                    <a href='javascript:void(0)' onclick='paymentmethodactiveinactive("<?php echo html_escape($method->id); ?>", <?php echo html_escape($method->status); ?>)'   title='<?php echo display('disapprove'); ?>' class='btn btn-sm btn-success text-white active-inactive-cls' ><i class='fa fa-check' aria-hidden='true'></i></a>
                                <?php } elseif ($method->status == 0) { ?>
                                    <a href='javascript:void(0)' onclick='paymentmethodactiveinactive("<?php echo html_escape($method->id); ?>", <?php echo html_escape($method->status); ?>)'  title='<?php echo display('approve'); ?>' class='btn btn-sm btn-warning active-inactive-cls' ><i class='fa fa-times' aria-hidden='true'></i></a>
                                    <?php
                                }
                                ?>
                                <a href='javascript:void(0)' onclick='paymentmethodconfig("<?php echo html_escape($method->id); ?>", <?php echo html_escape($method->status); ?>)'  title='<?php echo display('edit'); ?>' class='btn btn-sm btn-primary active-inactive-cls' ><i class='fas fa-edit' aria-hidden='true'></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <?php if (empty($payment_method_list)) { ?>
                <tr>
                    <th class="text-center text-danger" colspan="6"><?php echo display('record_not_found'); ?></th>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="info">

            </div>                    
        </div>
    </div>
</div>