<div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?></h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="student_id" class="col-sm-6"><?php echo display('student') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="student_id" id="student_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_studentlist as $student) { ?>
                                        <option value="<?php echo $student->student_id; ?>">
                                            <?php echo html_escape($student->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="mobile" class="col-sm-5 col-md-6"><?php echo display('mobile') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="mobile" placeholder="<?php echo display('mobile'); ?>">
                            </div>
                        </div>

                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" id='students_filter' onclick=""><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">

                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button>
                    </small>
                </h4>
            </div>
            <div class="card-body results">

                <table class="table display table-bordered table-striped table-hover bg-white m-0" id="studentlist">
                    <thead>
                        <tr>
                            <th width="3%"><?php echo display('sl') ?></th>
                            <th width="15%"><?php echo display('name') ?></th>
                            <th width="10%"><?php echo display('mobile') ?></th>
                            <th width="10%"><?php echo display('email') ?></th>
                            <th width="12%" class="text-center"><?php echo display('picture') ?></th>

                            <th width="20%" class="text-center"><?php echo display('action') ?></th>
                        </tr>
                    </thead>

                </table>

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

<input type="hidden" id="total_student" value="<?php echo $total_student; ?>">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/student.js') ?>"></script>
