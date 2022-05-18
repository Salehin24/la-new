<?php
    $user_type = $this->session->userdata('user_type');
    
    if((!empty($student_id)) && $user_type){
        $user_id = $student_id;
        // $email = get_studentinfo($user_id)->public_email;
    }elseif($user_type == 4){
        $user_id = $this->session->userdata('user_id');
        // $email = get_studentinfo($user_id)->email;
    }else{
        $user_id = $student_id;
        // $email = get_studentinfo($user_id)->public_email;
    }
    $email = (!empty(get_studentinfo($user_id)->website) ? get_studentinfo($user_id)->website : get_studentinfo($user_id)->email);
//    dd($user_type);
    $image = (!empty(get_userinfo($user_id)->picture) ? get_userinfo($user_id)->picture : $this->session->userdata('image'));
    
    
    $designation = get_studentinfo($user_id)->designation;
    $fullname = get_studentinfo($user_id)->name; //$this->session->userdata('fullname');
     //$this->session->userdata('email'); (!empty($get_studentinfo->public_email) ? $get_studentinfo->public_email : '')
    
    // d(get_studentinfo($user_id));
    ?>
<style>
.bg-img {
    width: 100%;
    /* background-attachment: fixed !important;
    background-position: center center;
    background-repeat: repeat-x; */
    animation: animatedBackground 20s linear infinite;
    background-size: cover !important;
}
</style>
<div class="student-profile-header hero-header text-white position-relative bg-img"
    data-image-src="<?php echo base_url(!empty(get_studentinfo($user_id)->coverpicture) ? get_studentinfo($user_id)->coverpicture : default_600_400()); ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <div class="text-center">
            <div class="avatar-img mb-3">
                <img src="<?php echo base_url(!empty($image) ? $image : default_image());  ?>" alt="">
            </div>
            <h2 class="stydent-name"><?php echo (!empty($fullname) ? $fullname : ''); ?> </h2>
            <div class="fw-bold"><?php echo (!empty($designation) ? $designation : 'Learner'); ?></div>
            <div class="text-decoration-underline fw-bold"><?php echo (!empty($email) ? $email : ''); ?></div>
        </div>
    </div>
</div>