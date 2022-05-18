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
                        <a href="<?php echo base_url(enterpriseinfo()->shortname . '/coupon-list'); ?>"
                            class="btn btn-success">
                            <?php echo display('coupon_list'); ?>
                        </a>
                    </small>
                </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart("#") ?>
                <!-- <div class="form-group row">
                    <label for="coupon_code" class="col-sm-3 col-form-label"><?php echo 'Coupon Code' ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-3">
                        <input name="coupon_code" class="form-control" type="text" placeholder="<?php echo 'Coupon Code' ?>" id="coupon_code" >
                    </div>
                    <div class="col-sm-1">
                        <button class="form-control btn btn-success" type="button" onclick="coupon_generate()">Generate</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount_type" class="col-sm-3 col-form-label"><?php echo 'Discount Type';?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-2">
                          <select class="form-control" name="discount_type" id="discount_type">
                             <option value="">Select</option>
                             <option value="1">Fixed</option>
                             <option value="2">Percent</option>
                          </select>
                    </div>
                    <div class="col-sm-2">
                        <input name="coupon_discount" class="form-control" type="text" placeholder="<?php echo 'Enter Amount/Percent' ?>" id="coupon_discount" >
                    </div>
                </div>

                <div class="form-group row">
                     <label for="discount_limit" class="col-sm-3 col-form-label"><?php echo 'Coupon Discount Limit' ?></label>
                    <div class="col-sm-4">
                    <input name="discount_limit" class="form-control" type="text" placeholder="<?php echo 'Set Discount Amount Limit' ?>" id="discount_limit" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="applicable_to" class="col-sm-3 col-form-label"><?php echo 'Coupon Applicable To';?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-2">
                          <select class="form-control" name="applicable_to" id="applicable_to">
                             <option value="">Select</option>
                             <option value="1">Everything</option>
                             <option value="2">category</option>
                             <option value="3">Subcategory</option>
                             <option value="4">Course</option>
                        
                          </select>
                    </div>
                    <div class="col-sm-2">
                          <select class="form-control" name="applicable_to" id="applicable_to">
                             <option value="">All</option>
                             <option value="1">Fixed</option>
                             <option value="2">Percent</option>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="coupon_host" class="col-sm-3 col-form-label"><?php echo 'Coupon Host';?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-2">
                          <select class="form-control" name="coupon_host" id="coupon_host">
                             <option value="">Select</option>
                             <option value="1">Admin</option>
                             <option value="2">Instructor</option>
                          </select>
                    </div>
                    <div class="col-sm-2">
                            <select class="form-control" name="coupon_host" id="coupon_host">
                             <option value="">Select</option>
                             <option value="1">Fixed</option>
                             <option value="2">Percent</option>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="coupon_charge" class="col-sm-3 col-form-label"><?php echo 'Coupon Charge';?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                    <input name="discount_charge" class="form-control" type="text" placeholder="<?php echo 'Enter Amount Percent' ?>" id="discount_charge"> 
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expiry_date" class="col-sm-3 col-form-label"><?php echo 'Expiry Date' ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <input name="expiry_date" class="form-control start_datas" type="text" id="expiry_date" placeholder="<?php echo 'expiry_date' ?>">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="coupon_code" class="col-sm-3 col-form-label"><?php echo 'Coupon Code' ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-3">
                        <input name="coupon_code" class="form-control" type="text" placeholder="<?php echo 'Coupon Code' ?>" id="coupon_code" >
                    </div>
                    <div class="col-sm-1">
                        <button class="form-control btn btn-sm btn-success" type="button" onclick="coupon_generate()">Generate</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount_type" class="col-sm-3 col-form-label"><?php echo 'Discount Type';?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                          <select class="form-control" name="discount_type" id="discount_type">
                             <option value="">Select</option>
                             <option value="1">Fixed</option>
                             <option value="2">Percent</option>
                          </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('category') ?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <select name="category_id" class="form-control placeholder-single" id="category_ids" data-placeholder="<?php echo display('select_one'); ?>">
                            <option value=""></option>
                            <?php foreach ($get_categoryforlibary as $category) { ?>
                            <option value="<?php echo html_escape($category->category_id); ?>">
                                <?php echo html_escape($category->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('subcategory') ?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <select name="category_id" class="form-control placeholder-single" id="category_ids" data-placeholder="<?php echo display('select_one'); ?>">
                            <option value=""></option>
                            <?php foreach ($get_categoryforlibary as $category) { ?>
                            <option value="<?php echo html_escape($category->category_id); ?>">
                                <?php echo html_escape($category->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_id" class="col-sm-3 col-form-label"><?php echo display('course') ?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <select name="category_id" class="form-control placeholder-single" id="category_ids" data-placeholder="<?php echo display('select_one'); ?>">
                            <option value=""></option>
                            <?php foreach ($get_categoryforlibary as $category) { ?>
                            <option value="<?php echo html_escape($category->category_id); ?>">
                                <?php echo html_escape($category->name); ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="coupon_discount" class="col-sm-3 col-form-label"><?php echo 'Coupon Discount' ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <input name="coupon_discount" class="form-control" type="text" placeholder="<?php echo 'Coupon Discount' ?>" id="coupon_discount" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount_limit" class="col-sm-3 col-form-label"><?php echo 'Discount Limit' ?></label>
                    <div class="col-sm-4">
                        <input name="discount_limit" class="form-control" type="text" placeholder="<?php echo 'Discount Limit' ?>" id="discount_limit" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry_date" class="col-sm-3 col-form-label"><?php echo 'Expiry Date' ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <input name="expiry_date" class="form-control start_datas" type="text" id="expiry_date" placeholder="<?php echo 'expiry_date' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-4">
                       <button type="button" class="btn btn-success w-md m-b-5" onclick="coupon_save()" ><?php echo display('save') ?></button>
                    </div>
                   
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div> 

<script>
function coupon_save(){
  var coupon_code    = $("#coupon_code").val();
  var discount_type  =$("#discount_type").val();
  var coupon_discount=$("#coupon_discount").val();
  var discount_limit = $("#discount_limit").val();
  var expiry_date    =   $("#expiry_date").val();
  var csrf_test_name = $("[name=csrf_test_name]").val();

  if (coupon_code == "") {
    $("#coupon_code").focus();
    toastrErrorMsg("Coupon code must be required");
    return false;
  }
  if (discount_type == "") {
    $("#discount_type").focus();
    toastrErrorMsg("Discount type must be required");
    return false;
  }
  if (coupon_discount == "") {
    $("#coupon_discount").focus();
    toastrErrorMsg("Coupon Discount must be required");
    return false;
  }
  if (expiry_date == "") {
    $("#expiry_date").focus();
    toastrErrorMsg("Expiry Date must be required");
    return false;
  }

  $.ajax({

        url: base_url + enterprise_shortname + "/coupon-save",
        type: "POST",
        data: {

            csrf_test_name: CSRF_TOKEN,
            coupon_code: coupon_code,
            discount_type: discount_type,
            coupon_discount: coupon_discount,
            discount_limit:discount_limit,
            expiry_date:expiry_date

        },
        success: function (r) {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: "slideDown",
                    timeOut: 1500,
                    onHidden: function () {
                        window.location.reload();
                    },
                };
                toastr.success(r);
            }, 1000);
        },
    });
}

function coupon_generate(){
    $.ajax({
        url: base_url + enterprise_shortname + "/coupon-generate",
        type: "POST",
        data: {csrf_test_name: CSRF_TOKEN},
        success: function (r) {
           $("#coupon_code").val(r);
        },
    });
}

</script>