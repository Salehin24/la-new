<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
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
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('assign_certificate'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="student_id"
                                class="col-sm-3 col-form-label"><?php echo display('student_name') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select name="student_id[]" class="form-control placeholder-single" id="student_id"
                                    data-placeholder="<?php echo display('select_one'); ?>" multiple>
                                    <option value=""></option>
                                    <?php
                                    foreach ($get_studentlist as $student) {
                                    ?>
                                    <option value="<?php echo html_escape($student->log_id); ?>">
                                        <?php echo html_escape($student->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_id"
                                class="col-sm-3 col-form-label"><?php echo display('certificate_name') ?> <i
                                    class="text-danger"> *</i>
                            </label>
                            <div class="col-sm-9">
                                <select name="certificate_id" class="form-control placeholder-single"
                                    id="certificate_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php
                                    foreach ($get_certificatelist as $certificate) {
                                    ?>
                                    <option value="<?php echo html_escape($certificate->id); ?>">
                                        <?php echo html_escape($certificate->title); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="button" onclick="assigncertificate()"
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
                        <?php if ($this->permission->check_label('category')->create()->access()) { ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            <?php echo display('assign'); ?>
                        </button>
                        <?php } ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                        id="assignedcertificatelist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('student_name') ?></th>
                                <th><?php echo display('certificate_name') ?></th>
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
<input type='hidden' id='total_assignedcertificate' value='<?php echo $total_assignedcertificate = 250; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/student.js') ?>"></script>