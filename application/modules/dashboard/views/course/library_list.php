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
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
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
                                <select class="form-control placeholder-single" onchange="category_wise_course(this.value)" name="category_id" id="category_id" data-placeholder="<?php echo display('select_one'); ?>">
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
                                <select class="form-control placeholder-single" name="course_id" id="course_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_course as $course) { ?>
                                        <option value="<?php echo html_escape($course->course_id); ?>">
                                            <?php echo html_escape($course->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="start_date" class="col-sm-12"><?php echo display('from_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="<?php echo display('start_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="end_date" class="col-sm-12"><?php echo display('to_date') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control datepicker" id="end_date" name="end_dates" placeholder="<?php echo display('end_date'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success" id="coursefilter" onclick=""><i class="fa fa-search"></i></button>
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
                    <!-- <small class="float-right">
                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><?php echo display('filter'); ?></button>
                    </small> -->
                </h4>
            </div>
            <div class="card-body">
                <div class="" id="result_load">
                    <table class="table table-striped table-bordered dt-responsive table-hover" id="library_contentlist">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="25%"><?php echo display('name') ?></th>
                                <th width="25%"><?php echo display('category_name') ?></th>
                                <th width="25%"><?php echo display('faculty_name') ?></th>
                                <th width="25%" class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_lib_content" value="<?php echo (!empty($total_lib_content) ? $total_lib_content : 0); ?>">

<script src="<?php echo base_url('application/modules/dashboard/assets/js/library.js') ?>"></script>

