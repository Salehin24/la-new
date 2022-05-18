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
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart("#") ?>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label"><?php echo display('title') ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="title" >
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label for="user_id" class="col-sm-3 col-form-label"><?php echo display('name');?> <i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                          <select class="form-control placeholder-single" name="user_id" id="user_id" data-placeholder="<?php echo display('select_one'); ?>">
                             <option value=""></option>
                             <?php foreach($user as $username){?>
                             <option value="<?php echo $username->student_id ?>"><?php echo $username->name ?></option>
                             <?php }?>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="designation" class="col-sm-3 col-form-label"><?php echo display('designation') ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <input name="designation" class="form-control" type="text" placeholder="<?php echo display('designation') ?>" id="designation" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rating_number" class="col-sm-3 col-form-label"><?php echo display('rating') ?><i class="text-danger"> *</i></label>
                    <div class="col-sm-4">
                        <select class="form-control placeholder-single" name="rating_number" id="rating_number" data-placeholder="-- select one --">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('description') ?></label>
                    <div class="col-sm-4">
                        <textarea name="description" class="form-control" type="text" placeholder="<?php echo display('description') ?>" id="description" ></textarea>
                    </div>
                </div>
                <div class="form-group row">
                <label for="image" class="col-sm-3 col-form-label"><?php echo display('image') ?></label>
                    <div class="col-sm-4">
                        <div>
                            <!-- checkfileExtesion() -->
                            <input type="file" name="image" id="image" class="custom-input-file"
                                onchange="fileValueOne(this,'testimonial')" />
                            <label for="image">
                                <i class="fa fa-upload"></i>
                                <span><?php echo display('choose_file'); ?>…</span>
                            </label>
                        </div>
                        <span class="text-danger">Size:( 150×50 ) Formats:(png,jpeg,jpeg,svg)</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div>
                            <img id="image-preview-testimonial" src="" alt="" class="border border-2"
                                width="200px">
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-4">
                       <button type="button" class="btn btn-success w-md m-b-5" onclick="testimonial_save()" ><?php echo display('save') ?></button>
                    </div>
                   
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- Inline form -->

</div> 
<script>
//     function testimonial_save(){
//       var fd = new FormData();
//   var title    = $("#title").val();
//   var user_id  =$("#user_id").val();
//   var designation=$("#designation").val();
//   var description = $("#description").val();
//   var rating_number = $("#rating_number").val();
//   var image = $("#image").val();
//   var csrf_test_name = $("[name=csrf_test_name]").val();
//   if (title == "") {
//     $("#title").focus();
//     toastrErrorMsg("Title must be required");
//     return false;
//   }
//   if (user_id == "") {
//     $("#user_id").focus();
//     toastrErrorMsg("Name must be required");
//     return false;
//   }
//   if (rating_number == "") {
//     $("#rating_number").focus();
//     toastrErrorMsg("Rating number field must be required");
//     return false;
//   }
//   if (designation == "") {
//     $("#designation").focus();
//     toastrErrorMsg("Designation must be required");
//     return false;
//   }
//   if(rating_number >=6){
//     toastrErrorMsg("Input must be less than 6 ");
//     return false;
//   }
//   fd.append("image", $("#image")[0].files[0]);
//   fd.append("csrf_test_name", csrf_test_name);
//   $.ajax({
//         url: base_url + enterprise_shortname + "/testimonial-save",
//         type: "POST",
//         data: {fd,title:title,user_id:user_id,designation: designation,description:description,rating_number:rating_number},
//         enctype: "multipart/form-data",
//         processData: false,
//         contentType: false,
//         success: function (r) {
//             alert(r);
//             return false;
//             setTimeout(function () {
//                 toastr.options = {
//                     closeButton: true,
//                     progressBar: true,
//                     showMethod: "slideDown",
//                     timeOut: 1500,
//                     onHidden: function () {
//                         window.location.reload();
//                     },
//                 };
//                 toastr.success(r);
//             }, 1000);
//         },
//     });
// }





("use strict");
function testimonial_save() {
   var fd = new FormData();
  var title         = $("#title").val();
  var user_id       =$("#user_id").val();
  var designation   =$("#designation").val();
  var description   = $("#description").val();
  var rating_number = $("#rating_number").val();
  var image         = $("#image").val();
  var csrf_test_name= $("[name=csrf_test_name]").val();
  if (title == "") {
    $("#title").focus();
    toastrErrorMsg("Title must be required");
    return false;
  }
  if (user_id == "") {
    $("#user_id").focus();
    toastrErrorMsg("Name must be required");
    return false;
  }
  if (rating_number == "") {
    $("#rating_number").focus();
    toastrErrorMsg("Rating number field must be required");
    return false;
  }
  if (designation == "") {
    $("#designation").focus();
    toastrErrorMsg("Designation must be required");
    return false;
  }
  if(rating_number >=6){
    toastrErrorMsg("Input must be less than 6 ");
    return false;
  }

  fd.append("image", $("#image")[0].files[0]);
  fd.append("title", $("#title").val());
  fd.append("user_id", $("#user_id").val());
  fd.append("designation", $("#designation").val());
  fd.append("description", $("#description").val());
  fd.append("rating_number", $("#rating_number").val());
  fd.append("csrf_test_name", csrf_test_name);
  $.ajax({
    url: base_url + enterprise_shortname + "/testimonial-save",
    type: "POST",
    data: fd,
    enctype: "multipart/form-data",
    processData: false,
    contentType: false,
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
</script>