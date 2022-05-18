<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h5 class="card-header"><?php echo (!empty($title) ? $title : null) ?></h5>
            <div class="card-body">            
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('role_name') ?></th>
                                <th><?php echo display('description') ?></th>
                                <th><?php echo display('action') ?>ss</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($role))  ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($role as $value) { ?>
                                <tr>
                                    <td><?php echo $sl++; ?></td>
                                    <td><?php echo html_escape($value->role_name); ?></td>
                                    <td><?php echo html_escape($value->role_description); ?></td>
                                    <td>
                                        <a href="<?php echo base_url("dashboard/role/view/" . html_escape($value->role_id)) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="View"><i class="ti-eye" aria-hidden="true"></i></a>
                                        <a href="<?php echo base_url("dashboard/role/edit_role/" . html_escape($value->role_id)) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
                                        <a href="<?php echo base_url("dashboard/role/delete/" . html_escape($value->role_id)) ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="ti-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

