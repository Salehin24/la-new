
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h5 class="card-header"><?php echo (!empty($title) ? $title : null) ?></h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('username') ?></th>
                                <th><?php echo display('role_name') ?></th>
                                <th class='text-center'><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($assign_user)) {
                                $sl = 1;
                                foreach ($assign_user as $value) {
                                    $role_info = $this->db->select('*')->from('sec_user_access_tbl a')
                                                    ->join('sec_role_tbl b', 'b.role_id = a.fk_role_id')
                                                    ->where('a.fk_user_id', $value->fk_user_id)->get()->result();
                                    ?>
                                    <tr>
                                        <td><?php echo $sl++; ?></td>
                                        <td><?php echo html_escape($value->name); ?> </td>
                                        <td>
                                            <ul>
                                                <?php
                                                foreach ($role_info as $role) {
                                                    echo "<li>" . html_escape($role->role_name) . "</li>";
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <td class='text-center'>
                                            <a href="javascript:void(0)" onclick="useraccessrole('<?php echo html_escape($value->fk_user_id); ?>')" class="btn btn-info btn-sm custom_btn" data-toggle="tooltip" data-placement="left" title="Update"  ><i class="ti-pencil-alt" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm custom_btn" onclick="roleassigndelete('<?php echo html_escape($value->fk_user_id); ?>')" data-toggle="tooltip" data-placement="right" title="Delete "><i class="ti-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php if (empty($assign_user)) { ?>
                                <tr>
                                    <th class="text-center text-danger" colspan="6"><?php echo display('record_not_found'); ?></th>
                                </tr>
                            <?php } ?>
                        </tfoot>                        
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
