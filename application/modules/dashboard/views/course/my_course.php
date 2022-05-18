<?php
$currency = $setting->currency;
$position = $setting->currency_position;
?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('course_name') ?></th>
                                <th class="text-center"><?php echo display('date') ?></th>
                                <th class="text-center"><?php echo display('payment_type') ?></th>
                                <th class="text-right"><?php echo display('price') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($course_list) {
                                $sl = 0;
                                foreach ($course_list as $course) {
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('course-details/' . html_escape($course->course_id)); ?>" target="_new">
                                                <?php echo html_escape($course->name); ?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?php echo html_escape($course->date); ?></td> 
                                        <td class="text-center"><?php
                                            if ($course->payment_method == 1) {
                                                echo 'Cash On Delivery';
                                            } elseif ($course->payment_method == 2) {
                                                echo 'Paypal';
                                            }
                                            ?></td> 
                                        <td class="text-right">
                                            <?php
                                            echo html_escape((($position == 1) ? "$currency $course->price" : "$course->price $currency"));
                                            ?>
                                        </td> 
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
