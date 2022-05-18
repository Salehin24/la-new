<!-- <div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body"> -->
<!-- <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="faculty_id" class="col-sm-6"><?php echo display('faculty') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="faculty_id" id="faculty_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php //foreach ($get_faculty as $faculty) { ?>
                                        <option value="<?php //echo html_escape($faculty->faculty_id); ?>">
                                            <?php //echo html_escape($faculty->name); ?>
                                        </option>
                                    <?php //} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="email" class="col-sm-5"><?php //echo display('email') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" placeholder="<?php //echo display('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" onclick="faculty_filter()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form> -->
            <!-- </div>
        </div>
    </div>
</div> -->
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
                        <!-- <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button> -->
                        <?php //if ($this->permission->check_label('event_list')->read()->access()) { ?>
                            <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname.'/add-faculty'); ?>" class="btn btn-success" >
                                <?php echo display('add_instructor'); ?>
                            </a> -->
                        <?php //} ?>
                    </small>
                </h4>
            </div>
            <div class="card-body">

                <table class="table display table-bordered table-striped table-hover bg-white m-0" id="instructor_report">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo display('sl') ?></th>
                            <th width="20%"><?php echo display('instructor_name') ?></th>
                            <th class='text-center' width="15%">Joining Date</th>
                            <th class='text-center' width="15%">Number Of Courses</th>
                            <th class='text-center'width="15%">Number Of Subscriber</th>
                            <th class='text-center'width="15%">Life Time Earning</th>
                            <!-- <th class='text-center'width="15%">Life Time Lead Earning</th> -->
                        </tr>
                    </thead>
                </table>

                <?php 
                // $course_type = "JSON_CONTAINS(course_type, '[\"2\"]')";
                // $get_subscribecourse = $this->db->select('course_id')->from('course_tbl a')->where('faculty_id', 'F02FELQZ9')->where($course_type)->get()->result();
                // echo $this->db->last_query();
                // d($get_subscribecourse);
                // $singlecourseid = array();
                // foreach ($get_subscribecourse as $course) {
                //     $singlecourseid[] = $course->course_id;
                // }
                // d($singlecourseid);
                // $get_subscribercount = $this->db->select('id')->from('invoice_details')->where_in('product_id', $singlecourseid)->where('is_subscription', 1)->group_by('customer_id')->get()->num_rows();
                
                // $get_subscriptiontransaction = $this->db->select('invoice_id')->from('invoice_details')->where_in('product_id', $singlecourseid)->where('is_subscription', 1)->group_by('customer_id')->get()->result();
                // $singletransactionid = array();
                // foreach ($get_subscriptiontransaction as $transaction) {
                //     $singletransactionid[] = $transaction->invoice_id;
                // }
                // $get_lifetimeleadearning = $this->db->select_sum('debit')->from('academic_ledger_tbl')->where_in('transaction_id', $singletransactionid)->where('is_subscription', 1)->get()->row();
                // echo $this->db->last_query();
                // d($singletransactionid);
                // d($get_subscriptiontransaction);
                // d($get_lifetimeleadearning);
                ?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="total_faculty" value="<?php //echo ($total_faculty)? $total_faculty:''; ?>">
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/faculty.js') ?>"></script>

<script>
(function ($) {
  "use strict";
  $(document).ready(function () {
    var total_faculty = $("#total_faculty").val();
    var instructor_report = $("#instructor_report").DataTable({
      responsive: true,
      dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
      aaSorting: [[0, "desc"]],
      columnDefs: [
        {
          bSortable: false,
          aTargets: [0],
          searchable: false,
        },
        {
          targets: [2, 3, 4, 5],
          className: "text-center",
        },
        // {
        //   targets: 2,
        //   render: function (data) {
        //     return '<ul class="tabbox">' + data + "</ul>";
        //   },
        // },
      ],
      buttons: [
        {
          extend: "copy",
          className: "btn-sm",
          className: "btn-success",
        },
        {
          extend: "csv",
          title: "ExampleFile",
          className: "btn-sm",
          className: "btn-success",
        },
        {
          extend: "excel",
          title: "ExampleFile",
          className: "btn-sm",
          title: "exportTitle",
          className: "btn-success",
        },
        {
          extend: "print",
          title: "ExampleFile",
          className: "btn-sm",
          title: "exportTitle",
          className: "btn-success",
        },
        {
          extend: "pdf",
          title: "ExampleFile",
          className: "btn-sm",
          title: "exportTitle",
          className: "btn-success",
        },
      ],

      lengthMenu: [
        [10, 50, 100, 150, 200,250],
        [10, 50, 100, 150, 200, "All"],
      ],
      processing: true,
      sProcessing: "<span class='fas fa-sync-alt'></span>",
      serverSide: true,
      serverMethod: "post",

      ajax: {
        url: base_url + enterprise_shortname + "/watchtime-reportdata",
        data: function (data) {
          data.csrf_test_name = CSRF_TOKEN;
        },
      },
      columns: [
        { data: "sl" },
        { data: "name" },
        { data: "joiningdate" },
        { data: "number_ofcourse"},
        { data: "number_ofsubscriber"},
        { data: "lifetime_earning"},
        // { data: "lifetime_leadearning"},
      ],
    });
  });
})(jQuery);
</script>