<h4><?php echo display('user_list'); ?></h4>
<hr>
<div class="table-responsive">
    <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table" id="datablelist">
        <thead>
            <tr>
                <th width="10%"><?php echo display('sl') ?></th>
                <th width="15%"><?php echo display('image') ?></th>
                <th width="15%"><?php echo display('name') ?></th>
                <th width="15%"><?php echo display('email') ?></th>
                <th width="20%"><?php echo display('address') ?></th>
                <th width="10%"><?php echo display('status') ?></th>
                <th width="15%" class="text-center"><?php echo display('action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($user))  ?>
            <?php $sl = 1; ?>
            <?php foreach ($user as $value) { ?>
                <tr>
                    <td><?php echo $sl++; ?></td>
                    <td>
                        <div class="avatar avatar-md">
                            <img src="<?php echo base_url(!empty(html_escape($value->image)) ? html_escape($value->image) : 'assets/img/icons/default.png'); ?>" alt="Image" class="avatar-img rounded-circle">
                        </div>
                    </td>
                    <td><?php echo html_escape($value->name); ?></td>
                    <td><?php echo html_escape($value->email); ?></td>
                    <td><?php echo character_limiter(html_escape($value->address), 20); ?></td>
                    <td><?php //echo ((html_escape($value->status) == 1) ? display('active') : display('inactive')); 
                        ?>
                        <?php if (html_escape($value->status) == 1) { ?>
                            <a href="javascript:void(0)" onclick="userinactive('<?php echo $value->log_id; ?>')" data-toggle="tooltip" title="<?php echo display('disapprove') ?>" class="text-white"><i class="fa fa-check btn-sm btn-success"></i></a>
                        <?php } elseif (html_escape($value->status) == 0) { ?>
                            <a href="javascript:void(0)" onclick="useractive('<?php echo $value->log_id ?>')" data-toggle="tooltip" title="<?php echo display('approve') ?>" class="text-white"><i class="fa fa-times btn-sm btn-warning"></i></a>

                        <?php } ?>
                    </td>
                    <td class='text-center'>
                        <?php
                       
                        if ($value->is_admin == 3) { ?>
                            <a href="javascript:void(0)" onclick="get_useredit('<?php echo html_escape($value->log_id); ?>')" class="btn btn-info btn-sm m-b-5 custom_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
                            <a href="javascript:void(0)" onclick="userdelete('<?php echo html_escape($value->log_id); ?>')" class="btn btn-danger btn-sm m-b-5 custom_btn" onclick="return confirm('<?php echo display("are_you_sure") ?>')" data-toggle="tooltip" data-placement="right" title="Delete "><i class="ti-trash" aria-hidden="true"></i></a>
                        <?php } else { ?>
                            <button class="btn btn-info m-b-5" title="<?php echo display('admin') ?>"><?php echo display('admin') ?></button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-md">
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

<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            // ======== itsf for expense item list datatables ==============
            var table = $("#datablelist").DataTable();
        })
    }(jQuery));
</script>