        <style>
            .purchasetable, .subscriptiontable{
                overflow-y : scroll;
                height : 350px;
            }
        </style>
        <h6>
            Purchases List
            <small class="float-right">
            </small>
        </h6>
        <div class="purchasetable">
            <table class="table display table-bordered table-striped table-hover bg-white m-0" id="">
                <thead>
                    <tr>
                        <th width="10%"><?php echo display('sl') ?></th>
                        <th width="30%"><?php echo display('name') ?></th>
                        <th width="20%" class="text-center">Complete Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                if($get_studentpurchasescourse){ 
                    $sl=0;
                    foreach($get_studentpurchasescourse as $purchase){
                        $sl++;
                    ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $purchase->name; ?></td>
                        <td class="text-center"><?php echo (($purchase->complete_status == 1) ? 'Yes' : 'No'); ?></td>
                    </tr>
                    <?php } 
                }else{ ?>
                    <tr>
                        <th class="text-center text-danger" colspan="3">Record not found!</th>
                    <tr>
                        <?php  } ?>
                </tbody>
            </table>
        </div>

        <br><br>
        <h6>
            Subscription List
            <small class="float-right">
            </small>
        </h6>
        <div class="subscriptiontable">
            <table class="table display table-bordered table-striped table-hover bg-white m-0" id="">
                <thead>
                    <tr>
                        <th width="10%"><?php echo display('sl') ?></th>
                        <th width="30%"><?php echo display('name') ?></th>
                        <th width="20%" class="text-center">Complete Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                if($get_studentsubscriptioncourse){ 
                    $sl=0;
                    foreach($get_studentsubscriptioncourse as $subscription){
                        $sl++;
                    ?>
                    <tr>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $subscription->name; ?></td>
                        <td class="text-center"><?php echo (($subscription->complete_status == 1) ? 'Yes' : 'No'); ?>
                        </td>
                    </tr>
                    <?php } 
                }else{ ?>
                    <tr>
                        <th class="text-center text-danger" colspan="3">Record not found!</th>
                    <tr>
                        <?php  } ?>
                </tbody>
            </table>
        </div>