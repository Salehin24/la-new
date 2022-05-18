<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <a href="<?php echo base_url(enterpriseinfo()->shortname . '/send-smsform'); ?>"
                            class="btn btn-success">
                            <?php echo display('send_sms'); ?>
                        </a>
                        <a href="<?php echo base_url(enterpriseinfo()->shortname . '/send-emailform'); ?>"
                            class="btn btn-info">
                            <?php echo display('send_email'); ?>
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <!-- template -->
                <table class="table table-bordered table-sm" id="emaillist">
                    <thead>
                        <tr>
                            <th width="10%"><i class="fa fa-th-list"></i></th>
                            <th width="20%">Subject</th>
                            <th width="40%"><?php echo display('message'); ?></th>
                            <th width="20%">To</th>
                            <th width="10%">Created Date</th>
                            <!-- <th width="20%" class="text-center"><i class="fa fa-cogs"></i></th> -->
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
             
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
$(document).ready(function() {
    var enterprise_shortname = $("#enterprise_shortname").val();
    var base_url = $("#base_url").val();


    var templatelist = $("#emaillist").DataTable({
        responsive: true,
        aaSorting: [
            [0, "desc"]
        ],
        columnDefs: [{
                bSortable: true,
                aTargets: [0],
            },
            {
                targets: [4],
                className: "text-center",
            },
        ],
        buttons: [{
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
        ],

        lengthMenu: [
            [20, 50, 100, 150, 200, 250],
            [20, 50, 100, 150, 200, "All"],
        ],
        processing: true,
        sProcessing: "<span class='fas fa-sync-alt'></span>",
        serverSide: true,
        serverMethod: "post",

        ajax: {
            url: base_url + enterprise_shortname + "/get-smslist",
            data: function(data) {
                data.csrf_test_name = CSRF_TOKEN;
            },
        },

        columns: [{
                data: "sl"
            },
            {
                data: "title"
            },
            {
                data: "message"
            },
            {
                data: "name"
            },
            {
                data: "created_date"
            },
        ],
    });
});


//    ================== its for show certificate ===========
// ("use strict");
// function show_certificate(id) {
//   $.ajax({
//     url: base_url + enterprise_shortname + "/show-certificate",
//     type: "POST",
//     data: { csrf_test_name: CSRF_TOKEN, id: id },
//     success: function (r) {
//       $(".templatemodal_ttl").html("Certificate Information Preview");
//       $("#templateinfo").html(r);
//       $("#templatemodal_info").modal("show");
//     },
//   });
// }
</script>