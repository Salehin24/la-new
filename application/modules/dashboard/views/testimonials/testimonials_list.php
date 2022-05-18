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
            if ($file_uploaderror != '') {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
            }
            ?>
        </div>
        <!-- modal form -->
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
                        
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                        id="testimonial_list">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('title') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('designation') ?></th>
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
<input type='hidden' id='total_testimonialcount' value='<?php echo $total_testimonialcount; ?>'>
<script>
(function ($) {
  "use strict";
  $(document).ready(function () {
  // ============= its for Archive list ===============
  var total_testimonialcount = $("#total_testimonialcount").val();
  var examlist = $("#testimonial_list").DataTable({
    responsive: true,
    dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
    // aaSorting: [[0, "desc"]],
    columnDefs: [
      {
        bSortable: true,
        aTargets: [0],
      },
      {
        bSortable: false,
        targets: 8,
        className: "text-center",
      },
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
      [20, 50, 100, 150, 200, +total_testimonialcount],
      [20, 50, 100, 150, 200, "All"],
    ],
    processing: true,
    sProcessing: "<span class='fas fa-sync-alt'></span>",
    serverSide: true,
    serverMethod: "post",

    ajax: {
      url: base_url + enterprise_shortname + "/get-testimonial",
      data: function (data) {
        //   console.log(data);
        data.csrf_test_name = CSRF_TOKEN;
      },
    },

    columns: [
      { data: "sl" },
      { data: "title" },
      { data: "name" },
      { data: "designation" },
      { data: "created_date" },
      { data: "created_by" },
      { data: "updated_date" },
      { data: "updated_by" },
    //   { data: "deleted_date" },
    //   { data: "deleted_by" },
      { data: "action" }
    ],
  });
});
})(jQuery);




function testimonials_delete(testimonials_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/testimonials-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, testimonials_id: testimonials_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#testimonial_list").DataTable().ajax.reload();
          setTimeout(function () {
            toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: "slideDown",
              timeOut: 1500,
              onHidden: function () {
                // window.location.reload();
              },
            };
            toastr.success("Testimonials deleted successfully!");
          }, 1000);
        }
      },
    });
  }
}
function testimonial_inactive(testimonials_id) {

  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/testimonial-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, testimonials_id: testimonials_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#testimonial_list").DataTable().ajax.reload();
          setTimeout(function () {
            toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: "slideDown",
              timeOut: 1500,
              onHidden: function () {
                // window.location.reload();
              },
            };
            toastr.success("Testimonial Inative successfully!");
          }, 1000);
        }
      },
    });
  }
}


function testimonials_active(testimonials_id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }
  var base_url = $("#base_url").val();
  var CSRF_TOKEN = $("#CSRF_TOKEN").val();
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/testimonial-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, testimonials_id: testimonials_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#testimonial_list").DataTable().ajax.reload();
          setTimeout(function () {
            toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: "slideDown",
              timeOut: 1500,
              onHidden: function () {
                // window.location.reload();
              },
            };
            toastr.success("Testimonial Active successfully!");
          }, 1000);
        }
      },
    });
  }
}

</script>