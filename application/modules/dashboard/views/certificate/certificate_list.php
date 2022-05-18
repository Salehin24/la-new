<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- <a href="<?php echo base_url(enterpriseinfo()->shortname . '/add-certificate'); ?>"
                            class="btn btn-success">
                            <?php echo display('add_certificate'); ?>
                        </a> -->
                    </small>
                </h4>
            </div>
            <div class="card-body">
                  <!-- template -->
                  <table class="table table-bordered table-sm" id="templatelist">
                    <thead>
                        <tr>
                            <th width="5%"><i class="fa fa-th-list"></i></th>
                            <th width="20%"><?php echo display('title'); ?></th>
                            <th width="15%"><?php echo display('type'); ?></th>
                            <th width="40%">Certificate Body</th>
                            <th width="20%" class="text-center"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>

                </table>
                <!-- The Modal -->
                <div class="modal fade" id="templatemodal_info" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title templatemodal_ttl"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="templateinfo">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div>

<script>
    $(document).ready(function(){
        var enterprise_shortname = $("#enterprise_shortname").val();
        var base_url = $("#base_url").val();


        var templatelist = $("#templatelist").DataTable({
        responsive: true,
        aaSorting: [[0, "desc"]],
        columnDefs: [
          {
            bSortable: true,
            aTargets: [0],
          },
          {
            bSortable: false,
            targets: [4],
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
          url: base_url + enterprise_shortname + "/get-certificatelist",
          data: function (data) {
            data.csrf_test_name = CSRF_TOKEN;
          },
        },

        columns: [
          { data: "sl" },
          { data: "title" },
          { data: "template_type" },
          { data: "template_body" },
          { data: "action" },
        ],
      });
    });

    
//    ================== its for teammember edit ===========
("use strict");
function template_edit(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/certificate-edit",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".templatemodal_ttl").html("Certificate information update");
      $("#templateinfo").html(r);
      $("#templatemodal_info").modal("show");
      $(".placeholder-single").select2();

      // ========== its for ckeditor start ==========
      CKEDITOR.replace("edit_template_body", {
        toolbarGroups: [
          {
            name: "basicstyles",
            groups: ["basicstyles"],
          },
          {
            name: "links",
            groups: ["links"],
          },
          {
            name: "paragraph",
            groups: ["list", "blocks"],
          },
          {
            name: "document",
            groups: ["mode"],
          },
          {
            name: "insert",
            groups: ["insert"],
          },
          {
            name: "styles",
            groups: ["styles"],
          },
          {
            name: "about",
            groups: ["about"],
          },
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons:
          "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar",
      });
      //            ============= its ckeditor close ===========

    },
  });
}
//    ================== its for show certificate ===========
("use strict");
function show_certificate(id) {
  $.ajax({
    url: base_url + enterprise_shortname + "/show-certificate",
    type: "POST",
    data: { csrf_test_name: CSRF_TOKEN, id: id },
    success: function (r) {
      $(".templatemodal_ttl").html("Certificate Information Preview");
      $("#templateinfo").html(r);
      $("#templatemodal_info").modal("show");
    },
  });
}

//============== its for template delete =========
("use strict");
function template_delete(id) {
  var productmode = $("#productmode").val();
  if (productmode == "demo") {
    toastrWarningMsg("It is disabled for demo mode!");
    return false;
  }

  var r = confirm("Are you sure?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/template-delete",
      type: "POST",
      data: { csrf_test_name: CSRF_TOKEN, id: id },
      success: function (r) {
        toastrSuccessMsg(r);
        $("#templatelist").DataTable().ajax.reload();
      },
    });
  }
}
</script>