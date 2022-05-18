<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
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
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('add_faq'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="question" class="col-sm-3 col-form-label"><?php echo display('question') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="question" class="form-control" type="text"
                                       placeholder="<?php echo display('question') ?>" id="question" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-sm-3 col-form-label"><?php echo display('answer') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <textarea name="answer" id="answer" class="form-control" cols="40" rows="10"  placeholder="<?php echo display('answer') ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" onclick="faqsave()"
                                    class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- Inline form -->
</div>
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php // if ($this->permission->check_label('category')->create()->access()) { ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                            <?php echo display('add_faq'); ?>
                        </button>
                        <?php // } ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                           id="faqlist">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="35%"><?php echo display('question') ?></th>
                                <th width="45%"><?php echo display('answer') ?></th>
                                <th width="15%" class="text-center"><?php echo display('action') ?></th>
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
<input type='hidden' id='total_faq' value='<?php echo $total_faq; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>
