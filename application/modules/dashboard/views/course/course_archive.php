<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
?>
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
        ?>
    </div>
</div>
<br>
<div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="category_id" class="col-sm-12"><?php echo display('category') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single"
                                    onchange="category_wise_course(this.value)" name="category_id" id="category_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_category as $category) { ?>
                                    <option value="<?php echo html_escape($category->category_id); ?>">
                                        <?php echo html_escape($category->name); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="course_id" class="col-sm-12"><?php echo display('course') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="course_id" id="course_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="faculty_id" class="col-sm-12"><?php echo display('instructor') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="faculty_id" id="faculty_id"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach($get_faculty as $faculty){ ?>
                                    <option value="<?php echo $faculty->faculty_id; ?>">
                                        <?php echo $faculty->name; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="start_date" class="col-sm-12"><?php echo display('from_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="start_date" name="start_date"
                                    placeholder="<?php echo display('start_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="end_date" class="col-sm-12"><?php echo display('to_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="end_date" name="end_dates"
                                    placeholder="<?php echo display('end_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-color text-white" id="coursearchivefilter" onclick=""><i
                                        class="fa fa-search"></i></button>
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
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <button type="button" class="btn btn-color text-white" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample"><?php echo display('filter'); ?></button>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <div class="" id="result_load">
                    <table class="table table-striped table-bordered dt-responsive table-hover"
                        id="coursearchivelist">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="25%"><?php echo display('course_name') ?></th>
                                <th width="10%"><?php echo display('category') ?></th>
                                <?php if ($user_type == 1) { ?>
                                <th><?php echo display('instructor') ?></th>
                                <?php } ?>
                                <!-- <th width="15%" class="text-left"><?php echo display('total_sales') ?></th> -->
                                <th width="15%"><?php echo display('section_lesson') ?></th>
                                <th width="10%"><?php echo display('created_date') ?></th>
                                <th width="10%"><?php echo display('created_by') ?></th>
                                <th width="10%"><?php echo display('updated_date') ?></th>
                                <th width="10%"><?php echo display('updated_by') ?></th>
                                <th width="10%"><?php echo display('deleted_date') ?></th>
                                <th width="10%"><?php echo display('deleted_by') ?></th>
                                <th width="20%" class="text-center"><?php echo display('action') ?></th>
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
<input type="hidden" id="total_coursearchive" value="<?php echo (!empty($total_coursearchive) ? $total_coursearchive : 0); ?>">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/coursedatatable.js')?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>