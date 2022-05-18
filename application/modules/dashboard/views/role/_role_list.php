
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h5 class="card-header">
                <?php echo html_escape((!empty($title) ? $title : null)) ?> 
                <small class="float-right"></small>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped bg-white m-0 card-table" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('role_name') ?></th>
                                <th><?php echo display('description') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($role_list))  ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($role_list as $value) { ?>
                                <tr>
                                    <td><?php echo $sl++; ?></td>
                                    <td><?php echo html_escape($value->role_name); ?></td>
                                    <td><?php echo html_escape($value->role_description); ?></td>
                                    <td class="text-center">
                                        <a href="#" onclick="role_edit('<?php echo html_escape($value->role_id); ?>')"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm custom_btn"><i class="ti-pencil-alt" aria-hidden="true"></i></a>

                                        <a href="javascript:void(0)" onclick="roledelete('<?php echo html_escape($value->role_id); ?>')" class="btn btn-danger btn-sm custom_btn" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa ti-trash" aria-hidden="true"></i></a>
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
