<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="col-sm-12">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $file_uploaderror = $this->session->flashdata('file_uploaderror');
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
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)); ?>
                    <small class="float-right">
                        <?php if ($this->permission->check_label('question_list')->read()->access()) { ?>
                        <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname . '/add-exam'); ?>"
                            class="btn btn-success text-white">
                            <?php //echo display('add_exam'); ?>
                        </a> -->
                        <?php } ?>
                    </small>
                </h4>
            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0" id="examlist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('created_date') ?></th>
                                <th><?php echo display('created_by') ?></th>
                                <th><?php echo display('updated_date') ?></th>
                                <th><?php echo display('updated_by') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
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
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>