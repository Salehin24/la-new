<?php
    $user_id = $this->session->userdata('user_id');
    $user_type = $this->session->userdata('user_type');
    //  dd($user_type);
    if($user_type == 5 && empty($instructor_id)){
    $image = (!empty(get_userinfo($user_id)->picture) ? get_userinfo($user_id)->picture : $this->session->userdata('image'));
    $coverimage =  (!empty($instructors_data->coverpicture) ? base_url($instructors_data->coverpicture) : base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/profile-bg.jpg'));
    $fullname = $instructors_data->name; //$this->session->userdata('fullname');
    $email = $instructors_data->email; //$this->session->userdata('email');
    $designation = $instructors_data->designation;
    ?>
<div class="student-profile-header hero-header text-white position-relative bg-img"
    data-image-src="<?php echo $coverimage; ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <div class="text-center">
            <div class="avatar-img mb-3">
                <img src="<?php echo base_url(!empty($image) ? $image : default_image());  ?>" alt="">
            </div>
            <h2 class="stydent-name"><?php echo $fullname;?></h2>
            <div><?php echo (!empty($designation) ? $designation : ''); ?></div>
            <div class="text-decoration-underline"><?php echo $email?></div>
        </div>
    </div>
</div>
<?php }else{
        $image = (!empty(get_userinfo($instructor_info->faculty_id)->picture) ? get_userinfo($instructor_info->faculty_id)->picture : $this->session->userdata('image'));
        $coverimage = (!empty($instructor_info->coverpicture) ? base_url($instructor_info->coverpicture) : base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/profile-bg.jpg'));
        $designation = $instructor_info->designation;
        $instructor_id = $instructor_info->faculty_id;
        
        $enterprise_id = (!empty($enterprise_shortname) ? enterpriseid_byshortname($enterprise_shortname) : 1);
        $student_id = $this->session->userdata('user_id');
        if($student_id){
        $check_followinginstructor = $this->Frontend_model->check_followinginstructor($student_id, $instructor_id, $enterprise_id);
        }
    ?>
<div class="student-profile-header hero-header text-white position-relative bg-img"
    data-image-src="<?php echo $coverimage; ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <div class="text-center">
            <div class="avatar-img mb-3">
                <img src="<?php echo base_url(!empty($image) ? $image : default_image());  ?>" alt="">
            </div>
            <div class="d-flex justify-content-center mb-3">
                <span class="me-2 px-3 py-2 bg-light text-dark rounded">Instructor</span>
                <?php 
                    if($user_type == 4 || $user_type == ''){
                if(@$check_followinginstructor){ ?>
                    <button class="btn btn-danger btn-sm text-white" onclick="studentUnfollowInstructor('<?php echo @$check_followinginstructor->id; ?>')">Unfollow</button>
                    <?php }else{ ?>
                <button type="button" class="px-3 py-2 bg-light text-dark rounded"
                    onclick="studentFollowInstructor('<?php echo $instructor_id; ?>')"><i
                        class="fas fa-plus me-1"></i>Follow</button>
                        <?php } 
                        }
                        ?>
            </div>
            <h2 class="stydent-name"><?php echo (!empty($instructor_info->name) ? $instructor_info->name : '');?></h2>
            <div><?php echo (!empty($designation) ? $designation : ''); ?></div>
            <div class="text-decoration-underline">
                <?php echo (!empty($instructor_info->public_email) ? $instructor_info->public_email : ''); ?></div>
        </div>
    </div>
</div>
<?php } ?>

<script>
var user_id = $("#user_id").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var enterprise_id = $("#enterprise_id").val();
var base_url = $("#base_url").val();
var CSRF_TOKEN = $("#CSRF_TOKEN").val();
$(document).ready(function() {

});

("use strict");

function toastrSuccessMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function() {
                window.location.reload();
            },
        };
        toastr.success(r);
    }, 1000);
}

("use strict");
function toastrErrorMsg(r) {
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: "slideDown",
      timeOut: 1500,
    };
    toastr.error(r);
  }, 1000);
}

"use strict";

function studentFollowInstructor(faculty_id) {
    if (user_id == '') {
        toastrErrorMsg("Please login firstly");
        return false;
    }
    var fd = new FormData();
    fd.append("user_id", user_id);
    fd.append("faculty_id", faculty_id);
    fd.append("enterprise_id", enterprise_id);
    fd.append("csrf_test_name", CSRF_TOKEN);

    $.ajax({
        url: base_url + enterprise_shortname + "/student-follow-instructor",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastrSuccessMsg(r);
        },
    });
}

("use strict");
function studentUnfollowInstructor(id) {
//   var user_id = $("#user_id").val();
//   var enterprise_id = $("#enterprise_id").val();
    
  var fd = new FormData();
  fd.append("user_id", user_id);
  fd.append("id", id);
  fd.append("enterprise_id", enterprise_id);
  fd.append("csrf_test_name", CSRF_TOKEN);
  var r = confirm("Do you want to delete?");
  if (r == true) {
    $.ajax({
      url: base_url + enterprise_shortname + "/student-unfollow-instructor",
      type: "POST",
      data: fd,
      enctype: "multipart/form-data",
      processData: false,
      contentType: false,
      success: function (r) {
        toastrSuccessMsg(r);
      },
    });
  }
}
</script>