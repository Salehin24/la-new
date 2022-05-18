<div class="row">
    <div class="col-sm-12 col-md-12">
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
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <?php if ($this->permission->check_label('forum_list')->read()->access()) { ?>
                            <a href="<?php echo base_url(enterpriseinfo()->shortname.'/forum-list'); ?>" class="btn btn-primary" >
                                <?php echo display('forum_list'); ?>
                            </a>
                        <?php } ?>
                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="30%"><?php echo display('forum') ?></th>
                                <th width="30%"><?php echo display('comments') ?></th>
                                <th width="15%"><?php echo display('students') ?></th>
                                <th width="15%" class="text-center"><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($comment_list) {
                                $sl = 0;
                                foreach ($comment_list as $single) {
                                    $sl++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($single->title); ?></td>
                                        <td><?php echo html_escape($single->comments); ?></td>
                                        <td><?php echo html_escape($single->name); ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($single->status == 1) {
                                                ?>
                                                <a href='javascript:void(0)' onclick='commentinactive("<?php echo html_escape($single->comment_id); ?>")'  title='Inactive' class='btn btn-sm btn-warning text-white' ><i class='fa fa-times' aria-hidden='true'></i></a>
                                            <?php } elseif ($single->status == 0) { ?>
                                                <a href='javascript:void(0)' onclick='commentactive("<?php echo html_escape($single->comment_id); ?>")' title='Active' class='btn btn-sm btn-success' ><i class='fa fa-check-circle' aria-hidden='true'></i></a>
                                                <?php
                                            }
                                            ?>
                                            <?php if ($this->permission->check_label('comment_list')->delete()->access()) { ?>
                                                <a class="btn-danger btn btn-sm" href="<?php echo base_url('comment-delete/' . html_escape($single->comment_id)); ?>"   id="forumdisabled_btn" onclick="return confirm('Do you want to delete it')"><i class="far fa-trash-alt"> </i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php if (empty($comment_list)) { ?>
                                <tr>
                                    <th class="text-danger text-center" colspan="6"><?php echo display('record_not_found'); ?></th>
                                </tr>
                            <?php } ?>
                        </tfoot>
                    </table>
                </div>
                <div class="">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/forum.js') ?>"></script>