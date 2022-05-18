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
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active allpaymentdisbursement" disbursement="all" id="pills-tab-0" data-toggle="pill" href="#pills-0" role="tab"
                            aria-controls="pills-0" aria-selected="true">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link allpaymentdisbursement" disbursement="4" id="pills-tab-1" data-toggle="pill" href="#pills-1" role="tab"
                            aria-controls="pills-1" aria-selected="false">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link allpaymentdisbursement" disbursement="2" id="pills-tab-2" data-toggle="pill" href="#pills-2" role="tab"
                            aria-controls="pills-2" aria-selected="false">On Hold</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link allpaymentdisbursement" disbursement="1" id="pills-tab-3" data-toggle="pill" href="#pills-3" role="tab"
                            aria-controls="pills-3" aria-selected="false">Paid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link allpaymentdisbursement" disbursement="3" id="pills-tab-4" data-toggle="pill" href="#pills-4" role="tab"
                            aria-controls="pills-4"  aria-selected="false">Cancelled</a>
                    </li>
                </ul>
                <input type='hidden' id='disbursement_status' value=''>
                <table class="table display table-bordered table-striped table-hover bg-white m-0"
                    id="paymentdisbursement_report">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo display('sl') ?></th>
                            <th width="20%">Requested By</th>
                            <th class='text-center' width="15%">Request ID</th>
                            <th class='text-center' width="10%">Month</th>
                            <th class='text-center' width="10%">Amount</th>
                            <th class='text-center' width="20%">Payment Details</th>
                            <th class='text-center' width="10%">Status</th>
                            <th class='text-center' width="10%">Paid By</th>
                            <th class='text-center' width="10%">Payment Date</th>
                            <th class='text-center' width="15%">Remarks</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="preview_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="form-group row">
                        <label for="feedback" class="col-sm-2">Remarks</label>
                        <div class="col-sm-5">
                            <input type="file" name="docusign" id="docusign" class="custom-input-file" />
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="remarks" name="remarks" cols="10"
                            row="5"><?php //echo (!empty($course_info->feedback) ? $course_info->feedback : ''); ?></textarea>
                    </div>
                    <input type="hidden" id="withdraw_id" value="">
                    <input type="hidden" id="withdraw_status" value="">
                    <input type="button" value="Submit" onclick="withdrawremarks()" class="btn btn-success btn-sm">
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="total_faculty" value="<?php //echo ($total_faculty)? $total_faculty:''; ?>">
<script src="<?php //echo base_url('application/modules/dashboard/assets/js/faculty.js') ?>"></script>

<script>
(function($) {
    "use strict";
    $(document).ready(function() {
        var total_faculty = $("#total_faculty").val();
        var paymentdisbursement_report = $("#paymentdisbursement_report").DataTable({
            responsive: true,
            // dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
            dom: "<'row'<'col-sm-4'l><'col-sm-4'><'col-sm-4'f>>tp",
            aaSorting: [
                [0, "desc"]
            ],
            columnDefs: [{
                    bSortable: false,
                    aTargets: [0],
                    searchable: false,
                },
                {
                    targets: [2, 3, 4, 5, 6, 7, 8],
                    className: "text-center",
                },
                // {
                //   targets: 2,
                //   render: function (data) {
                //     return '<ul class="tabbox">' + data + "</ul>";
                //   },
                // },
            ],
            // buttons: [{
            //         extend: "copy",
            //         className: "btn-sm",
            //         className: "btn-success",
            //     },
            //     {
            //         extend: "csv",
            //         title: "ExampleFile",
            //         className: "btn-sm",
            //         className: "btn-success",
            //     },
            //     {
            //         extend: "excel",
            //         title: "ExampleFile",
            //         className: "btn-sm",
            //         title: "exportTitle",
            //         className: "btn-success",
            //     },
            //     {
            //         extend: "print",
            //         title: "ExampleFile",
            //         className: "btn-sm",
            //         title: "exportTitle",
            //         className: "btn-success",
            //     },
            //     {
            //         extend: "pdf",
            //         title: "ExampleFile",
            //         className: "btn-sm",
            //         title: "exportTitle",
            //         className: "btn-success",
            //     },
            // ],

            lengthMenu: [
                [10, 50, 100, 150, 200, 250],
                [10, 50, 100, 150, 200, "All"],
            ],
            processing: true,
            sProcessing: "<span class='fas fa-sync-alt'></span>",
            serverSide: true,
            serverMethod: "post",

            ajax: {
                url: base_url + enterprise_shortname + "/paymentdisbursement-datalist",
                data: function(data) {
                    data.csrf_test_name = CSRF_TOKEN;
                    data.disbursement_status = $("#disbursement_status").val();
                },
            },
            columns: [{
                    data: "sl"
                },
                {
                    data: "requestedby"
                },
                {
                    data: "request_id"
                },
                {
                    data: "month"
                },
                {
                    data: "amount"
                },
                {
                    data: "payment_details"
                },
                {
                    data: "status"
                },
                {
                    data: "paidby"
                },
                {
                    data: "payment_date"
                },
                {
                    data: "remarks"
                },
            ],
        });

        //course filtering
    $("body").on("click", "#pills-tab-0", function () {
        var disbursement_status = $("#pills-tab-0").attr("disbursement");
        $("#disbursement_status").val(disbursement_status);
        paymentdisbursement_report.ajax.reload();
    });
    $("body").on("click", "#pills-tab-1", function () {
        var disbursement_status = $("#pills-tab-1").attr("disbursement");
        $("#disbursement_status").val(disbursement_status);
        paymentdisbursement_report.ajax.reload();
    });
    $("body").on("click", "#pills-tab-2", function () {
        var disbursement_status = $("#pills-tab-2").attr("disbursement");
        $("#disbursement_status").val(disbursement_status);
        paymentdisbursement_report.ajax.reload();
    });
    $("body").on("click", "#pills-tab-3", function () {
        var disbursement_status = $("#pills-tab-3").attr("disbursement");
        $("#disbursement_status").val(disbursement_status);
        paymentdisbursement_report.ajax.reload();
    });
    $("body").on("click", "#pills-tab-4", function () {
        var disbursement_status = $("#pills-tab-4").attr("disbursement");
        $("#disbursement_status").val(disbursement_status);
        paymentdisbursement_report.ajax.reload();
    });
    // $("body").on("click", ".allpaymentdisbursement", function () {
        
    //   var category_id = $("#category_id").val();
    //   var course_id = $("#course_id").val();
    //   var start_date = $("#start_date").val();
    //   var end_date = $("#end_date").val();
    //   if (
    //     category_id == "" &&
    //     course_id == "" &&
    //     faculty_id == "" &&
    //     start_date == "" &&
    //     end_date == ""
    //   ) {
    //     setTimeout(function () {
    //       toastr.options = {
    //         closeButton: true,
    //         progressBar: true,
    //         showMethod: "slideDown",
    //         timeOut: 1500,
    //       };
    //       toastr.error("Empty field not allow!");
    //     }, 1000);
    //   } else {
        // paymentdisbursement_report.ajax.reload();
    //   }
    // });

    });
})(jQuery);


function withdrawRequestStatus(status, id, user_id) {
    var csrf_test_name = $('[name="CSRF_TOKEN"]').val();
    //   alert(id); return false;
    var r = confirm("Are you sure, change the status!");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/withdraw-request-status",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                status: status,
                id: id,
                user_id: user_id,
            },
            success: function(r) {
                if (status != 1) {
                    $("#withdraw_id").val(id);
                    $("#withdraw_status").val(status);
                    $("#preview_modal").modal("show");
                } else {
                    toastr["success"]("Status changed successfully!");
                    $("#paymentdisbursement_report").DataTable().ajax.reload();
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 600);
                }
            },
        });
    }
}

function withdrawremarks() {
    var csrf_test_name = $('[name="CSRF_TOKEN"]').val();
    var remarks = $("#remarks").val();
    var withdraw_id = $("#withdraw_id").val();
    var withdraw_status = $("#withdraw_status").val();
    $.ajax({
        url: base_url + enterprise_shortname + "/withdraw-remarks-submit",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            withdraw_id: withdraw_id,
            withdraw_status: withdraw_status,
            remarks: remarks,
        },
        success: function(r) {
            toastr["success"]("Submited successfully!");
            $("#paymentdisbursement_report").DataTable().ajax.reload();
            setTimeout(function() {
                // location.reload();
                $("#preview_modal").modal("hide");
            }, 600);
        },
    });
}
</script>