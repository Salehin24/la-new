<?php
$position = (!empty($setting->currency_position) ? $setting->currency_position : '');
$currency = (!empty($setting->currency) ? $setting->currency : '');
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table display table-bordered table-striped table-hover bg-white m-0">
                    <!-- <table id="example" class="table display table-bordered table-striped table-hover bg-white m-0 card-table"> -->
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('category') ?></th>
                                <th class='text-center'><?php echo display('instructor_commission') ?> <i class="text-danger">(%)</i></th>
                                <th class="text-center"><?php echo display('admin_commission'); ?> <i class="text-danger">(%)</i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($commission_list) {
                                $sl = 0+$pagenum;
                                foreach ($commission_list as $single) {
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($single->name); ?></td>
                                        <td class="text-center"><?php echo html_escape($single->commission); ?></td>
                                        <td class='text-center'>
                                            <?php
                                            echo (100 - html_escape($single->commission));
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
                <div class="m-2">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>