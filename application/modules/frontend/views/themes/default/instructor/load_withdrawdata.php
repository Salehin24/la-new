<table class="table align-middle table-bordered">
    <thead class="">
        <tr class="">
            <th scope="col">ID</th>
            <th scope="col">Method</th>
            <th class='text-center' scope="col">Status</th>
            <th class='text-center' scope="col">Amount</th>
            <th class='text-center' scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if($get_withdrawfilterdata){ 
                foreach($get_withdrawfilterdata as $request){
                                    ?>
        <tr>
            <td>#<?php echo $request->request_id; ?></td>
            <td>
                <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bkash.png'); ?>"
                                            alt=""> -->
                <?php echo $request->bank_name; ?>
            </td>
            <td class='text-center'>
                <?php if($request->status == 4){ ?>
                <span class="custom-btn p-1 w-100 me-2"
                    style="background-color:#ffca2c;border:1px solid #ffca2c;color:#fff">Pending</span>
                <div class='text-center text-danger mt-2'>
                    <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?></div>
                <?php }elseif($request->status == 1){ ?>
                <span class="custom-btn p-1 w-100 me-2"
                    style="background-color:#198754;border:1px solid #198754;color:#fff">Paid</span>
                <?php }elseif($request->status == 2){ ?>
                <span class="custom-btn p-1 w-100 me-2"
                    style="background-color:#ffca2c;border:1px solid #ffca2c;color:#fff">On
                    Hold</span>
                <div class='text-center text-danger mt-2'>
                    <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?></div>
                <?php }elseif($request->status == 3){ ?>
                <span class="custom-btn p-1 w-100 me-2"
                    style="background-color:#bb2d3b;border:1px solid #bb2d3b;color:#fff">Cancelled</span><br>
                <div class='text-center text-danger mt-2'>
                    <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?></div>
                <?php } ?>
            </td>
            <td class='text-center'>
                <?php echo $request->amount;  ?>
            </td>
            <td class='text-center'>
                <?php echo date('M d, Y', strtotime($request->date)); ?>
            </td>
        </tr>
        <?php
                               } 
                            }else{ ?>
                            <tr>
                                <th colspan="5" class='text-center text-danger'>Record not found!</th>
                            </tr>
                        <?php }  ?>
    </tbody>
</table>