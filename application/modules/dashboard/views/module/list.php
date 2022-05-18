<div class="row">
     <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h4 class="card-header"><?php echo (!empty($title) ? $title : null) ?>
                <small class="float-right">
                    <a href="<?php echo base_url(enterpriseinfo()->shortname .'/add-module'); ?>" class="btn btn-success btn-xs">
                        <?php echo display('add_module'); ?>
                    </a>
                </small>
            </h4>
            <div class="card-body">
                <table class="datatable table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('image') ?></th>
                            <th><?php echo display('module_name') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('directory') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th class="text-center"><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($moduleData))  ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($moduleData as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><img src="<?php echo base_url(!empty($value->image) ? $value->image : 'assets/img/icons/default.jpg'); ?>" alt="Image" height="50" ></td>
                                <td><?php echo $value->name; ?></td>
                                <td><?php echo $value->description; ?></td>
                                <td><?php echo $value->directory; ?></td>
                                <td>
                                    <?php echo (($value->status == 1) ? display('active') : display('inactive')); ?>
                                </td>
                                <td class="text-center"> 
                                    <?php if ($value->status == 1) { ?>
                                        <a href="<?php echo base_url("dashboard/module/status/$value->id/inactive") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-warning btn-sm" title="Inactive"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url("dashboard/module/status/$value->id/active") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-info btn-sm" title="Active"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>

