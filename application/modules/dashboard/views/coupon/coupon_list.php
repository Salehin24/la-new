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
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('add_category'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="parent_id" class="col-sm-3 col-form-label"><?php echo display('parent') ?> </label>
                            <div class="col-sm-9">
                                <select name="parent_id" class="form-control placeholder-single" id="parent_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php
                                    foreach ($parent_category as $parent) {
                                    ?>
                                        <option value="<?php echo html_escape($parent->category_id); ?>">
                                            <?php echo html_escape($parent->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ordering" class="col-sm-3 col-form-label"><?php echo display('ordering'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control ordering placeholder-single" id="ordering" data-placeholder="-- select one --" name="ordering">
                                    <option value=""></option>
                                    <?php for ($i = 1; $i < 51; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_type" class="col-sm-3 col-form-label"><?php echo 'Category Type' ?><i class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <select name="category_type" class="form-control placeholder-single" id="category_type" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <option value="1"><?php echo html_escape("Is Course"); ?></option>
                                    <!-- <option value="2"><?php echo html_escape("Is Library"); ?></option> -->

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="commission" class="col-sm-3 col-form-label"><?php echo display('commission') ?> <i class="text-danger"> *</i></label>
                            <div class="col-sm-9">
                                <input name="commission" class="form-control" type="number" placeholder="<?php echo display('commission') ?>" id="commission" required>
                                <span class="text-danger"><?php echo html_escape('Counted  as %'); ?> </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <input id="is_popular" type="checkbox" class="is_popular" value="1">
                                    <label for="is_popular"><?php echo display('is_popular'); ?></label>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                            <div class="col-sm-9">
                                <div>
                                    <input type="file" name="image" id="image" class="custom-input-file" onchange="checkfileExtesion()" />
                                    <label for="image">
                                        <i class="fa fa-upload"></i>
                                        <span><?php echo display('choose_file'); ?>…</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" onclick="category_save()" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
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
                        <?php if ($this->permission->check_label('coupon')->create()->access()) { ?>
                        <a href="<?php echo base_url(enterpriseinfo()->shortname. '/add-coupon'); ?>" class="btn btn-success">
                            <?php echo display('add_coupon'); ?>
                        </a>
                        <?php } ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0" id="couponlist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('coupon_code') ?></th>
                                <th><?php echo display('discount_type') ?></th>
                                <th><?php echo display('coupon_discount') ?></th>
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

<input type='hidden' id='total_couponcount' value='<?php echo $total_couponcount; ?>'>
<!-- <script src="<?php echo base_url('application/modules/dashboard/assets/js/category.js') ?>"></script> -->
<script>

(function ($) {
  "use strict";
  $(document).ready(function () {
  // ============= its for Archive list ===============
  var total_exam = $("#total_couponcount").val();
  var examlist = $("#couponlist").DataTable({
    responsive: true,
    dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>tp",
    aaSorting: [[0, "desc"]],
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
      [20, 50, 100, 150, 200, +total_exam],
      [20, 50, 100, 150, 200, "All"],
    ],
    processing: true,
    sProcessing: "<span class='fas fa-sync-alt'></span>",
    serverSide: true,
    serverMethod: "post",

    ajax: {
      url: base_url + enterprise_shortname + "/get-couponlist",
      data: function (data) {
          console.log(data);
        data.csrf_test_name = CSRF_TOKEN;
      },
    },

    columns: [
      { data: "sl" },
      { data: "coupon_code" },
      { data: "discount_type" },
      { data: "coupon_discount" },
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




function coupon_delete(coupon_id) {
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
      url: base_url + enterprise_shortname + "/coupon-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, coupon_id: coupon_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#couponlist").DataTable().ajax.reload();
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
            toastr.success("Coupon deleted successfully!");
          }, 1000);
        }
      },
    });
  }
}
function couponinactive(coupon_id) {
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
      url: base_url + enterprise_shortname + "/coupon-inactive",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, coupon_id: coupon_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#couponlist").DataTable().ajax.reload();
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
            toastr.success("Coupon Inative successfully!");
          }, 1000);
        }
      },
    });
  }
}

function couponactive(coupon_id) {
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
      url: base_url + enterprise_shortname + "/coupon-active",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, coupon_id: coupon_id },
      success: function (r) {
        if (r == 0) {
          toastrErrorMsg("It has some courses");
        } else {
          $("#couponlist").DataTable().ajax.reload();
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
            toastr.success("Coupon Active successfully!");
          }, 1000);
        }
      },
    });
  }
}


</script>