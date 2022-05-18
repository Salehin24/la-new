<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$db->select('a.id, a.log_id, a.name, a.shortname');
$db->from('loginfo_tbl a');
$db->where('a.user_types', 1);
$db->or_where('a.user_types', 2);
$query = $db->get();
$result = $query->result();
$segment1 = $this->uri->segment(1);

$enterprise_shortname = array(); //array("admin", "tester", "software-testing");
// echo '<pre>'; print_r($result);
foreach ($result as $row) {
    $enterprise_shortname[] = $row->shortname;
    
    // echo $row->shortname.".<br>"; 
    //$route[$row->shortname . '/category'] = 'dashboard/Category/index';
    // echo $row->shortname.'.'.$route['login'] = "dashboard/auth/index";
    // echo "<br>";
    //$row->shortname.'.'.$route['category'] = "dashboard/Category/index";
    // echo '<br>';
}
// echo '<pre>'; print_r($enterprise_shortname);
//die();

// $route['(:any)'] = 'frontend/Frontend/websiteload/$1';
$route['welcome'] = "welcome/index";
$route['login'] = "dashboard/auth/index";

$route['login-as-enterprise/(:any)'] = 'dashboard/Enterprise/login_as_enterprise/$1';
$route['about'] = 'frontend/Frontend/about';
$route['eventlist'] = 'frontend/Frontend/eventlist/';
$route['blog'] = 'frontend/Frontend/blog';
// $route['category-archives'] = 'dashboard/Category/category_archives';



foreach ($result as $row) {
     if (in_array($segment1, $enterprise_shortname)){
        $route['(:any)'] = 'frontend/Frontend/websiteload/$1';
    }
    
    // $route['(:any)'] = 'frontend/Frontend/websiteload/$1';

//=========== its for frontend start =============
    $route[$row->shortname . '/comming-soon'] = 'frontend/Frontend/comming_soon';
    $route[$row->shortname . '/interest-save'] = 'frontend/Frontend/interest_save';
    $route[$row->shortname . '/nofity_counter'] = 'frontend/Frontend/nofity_counter';
    $route[$row->shortname . '/nofity-read'] = 'frontend/Frontend/nofity_read';
    $route[$row->shortname . '/socialIconOrdering'] = 'frontend/Frontend/socialIconOrdering';
    $route[$row->shortname . '/student-signinform'] = 'frontend/Frontend/student_signinform';
    $route[$row->shortname . '/student-dashboard'] = 'frontend/Frontend/student_dashboard';
    $route[$row->shortname . '/get-time_spent_filter'] = 'frontend/Frontend/get_time_spent_filter';
    $route[$row->shortname . '/student-courses-overviews'] = 'frontend/Frontend/courses_overviews';
    $route[$row->shortname . '/student-courses-overviews/(:any)'] = 'frontend/Frontend/courses_overviews/$1';
    $route[$row->shortname . '/student-progress-sort-filtering'] = 'frontend/Frontend/student_progress_sort_filtering';
    $route[$row->shortname . '/student-profile-dashboard'] = 'frontend/Frontend/student_profile_dashboard';
    $route[$row->shortname . '/student-profile-show/(:any)'] = 'frontend/Frontend/student_profile_show/$1';
    $route[$row->shortname . '/download-certificate/(:any)'] = 'frontend/Frontend/download_certificate/$1';
    $route[$row->shortname . '/student-profile-edit'] = 'frontend/Frontend/student_profile_edit';
    $route[$row->shortname . '/getvideoiframe-load'] = 'frontend/Frontend/getvideoiframe_load';
    $route[$row->shortname . '/student-add-project'] = 'frontend/Frontend/student_project_add';
    $route[$row->shortname . '/student-add-project/(:any)'] = 'frontend/Frontend/student_project_add/$1';
    $route[$row->shortname . '/get-coursepicture'] = 'frontend/Frontend/get_coursepicture';
    $route[$row->shortname . '/get-sectionbycourse'] = 'frontend/Frontend/get_sectionbycourse';
    $route[$row->shortname . '/get-assignmentchapterbycourse'] = 'frontend/Frontend/get_assignmentchapterbycourse';
    $route[$row->shortname . '/get-assignmentcheckbycourse'] = 'frontend/Frontend/get_assignmentcheckbycourse';
    $route[$row->shortname . '/get-assignmentbychapter'] = 'frontend/Frontend/get_assignmentbychapter';
    $route[$row->shortname . '/get-lessonbycoursesection'] = 'frontend/Frontend/get_lessonbycoursesection';
    $route[$row->shortname . '/student-project-save'] = 'frontend/Frontend/student_project_save';
    $route[$row->shortname . '/student-project-edit/(:any)'] = 'frontend/Frontend/student_project_edit/$1';
    $route[$row->shortname . '/student-project-update'] = 'frontend/Frontend/student_project_update';
    $route[$row->shortname . '/project-details-delete'] = 'frontend/Frontend/project_details_delete';
    $route[$row->shortname . '/type-wise-project-load'] = 'frontend/Frontend/type_wise_project_load';
    $route[$row->shortname . '/type-wise-project-load-public'] = 'frontend/Frontend/type_wise_project_load_public';
    $route[$row->shortname . '/student-project-delete'] = 'frontend/Frontend/student_project_delete';
    $route[$row->shortname . '/student-project-view/(:any)'] = 'frontend/Frontend/student_project_view/$1';
    $route[$row->shortname . '/student-project-publicview/(:any)'] = 'frontend/Frontend/student_project_publicview/$1';
    $route[$row->shortname . '/comment-save'] = 'frontend/Frontend/comment_save';
    $route[$row->shortname . '/loadcomments'] = 'frontend/Frontend/loadcomments';
    $route[$row->shortname . '/likeunlikethisproject'] = 'frontend/Frontend/likeunlikethisproject';
    $route[$row->shortname . '/student-settings-account'] = 'frontend/Frontend/student_settings_account';
    $route[$row->shortname . '/student-notification'] = 'frontend/Frontend/student_notification';
    $route[$row->shortname . '/student-notification/(:any)'] = 'frontend/Frontend/student_notification/$1';
    $route[$row->shortname . '/student-settings-notification'] = 'frontend/Frontend/student_settings_notification';
    $route[$row->shortname . '/student-settings-payments'] = 'frontend/Frontend/student_settings_payments';
    $route[$row->shortname . '/settings-affiliation'] = 'frontend/Frontend/student_settings_affiliation';
    $route[$row->shortname . '/student-password-update'] = 'frontend/Frontend/student_password_update';
    $route[$row->shortname . '/language-update'] = 'frontend/Frontend/language_update';
    $route[$row->shortname . '/save-setting-notification'] = 'frontend/Frontend/save_setting_notification';
    $route[$row->shortname . '/student-activity'] = 'frontend/Frontend/student_activity';
    $route[$row->shortname . '/student-activity/(:any)'] = 'frontend/Frontend/student_activity/$1';
    $route[$row->shortname . '/sticky-note-save'] = 'frontend/Frontend/sticky_note_save';
    $route[$row->shortname . '/stickynoteedit-form'] = 'frontend/Frontend/stickynoteedit_form';
    $route[$row->shortname . '/sticky-note-update'] = 'frontend/Frontend/sticky_note_update';
    $route[$row->shortname . '/sticky-note-delete'] = 'frontend/Frontend/sticky_note_delete';
    $route[$row->shortname . '/student-course-status-wise-show'] = 'frontend/Frontend/student_course_status_wise_show';
    $route[$row->shortname . '/exam-donestatus'] = 'frontend/Frontend/exam_donestatus';
    $route[$row->shortname . '/get-passfailquiz'] = 'frontend/Frontend/get_passfailquiz';
    
    $route[$row->shortname . '/fileupload-progressbar-check'] = 'frontend/Frontend/fileupload_progressbar_check';
    $route[$row->shortname . '/student-fileupload-progressbar-check'] = 'frontend/Frontend/student_fileupload_progressbar_check';
    $route[$row->shortname . '/resume-upload'] = 'frontend/Frontend/resume_upload';
    $route[$row->shortname . '/resume-upload-delete'] = 'frontend/Frontend/resume_upload_delete';
    $route[$row->shortname . '/profile-update'] = 'frontend/Frontend/profile_update';
    $route[$row->shortname . '/biography-update'] = 'frontend/Frontend/biography_update';
    $route[$row->shortname . '/skills-update'] = 'frontend/Frontend/skills_update';
    $route[$row->shortname . '/autocomplete-proficiency-search'] = 'frontend/Frontend/autocomplete_proficiency_search';
    $route[$row->shortname . '/proficiency-update'] = 'frontend/Frontend/proficiency_update';
    $route[$row->shortname . '/student-proficiency-delete'] = 'frontend/Frontend/student_proficiency_delete';
    $route[$row->shortname . '/student-featureshow-update'] = 'frontend/Frontend/student_featureshow_update';
    $route[$row->shortname . '/experience-save'] = 'frontend/Frontend/experience_save';
    $route[$row->shortname . '/experience-edit'] = 'frontend/Frontend/experience_edit';
    $route[$row->shortname . '/experience-update'] = 'frontend/Frontend/experience_update';
    $route[$row->shortname . '/student-experience-delete'] = 'frontend/Frontend/student_experience_delete';
    $route[$row->shortname . '/education-save'] = 'frontend/Frontend/education_save';
    $route[$row->shortname . '/education-edit'] = 'frontend/Frontend/education_edit';
    $route[$row->shortname . '/education-update'] = 'frontend/Frontend/education_update';
    $route[$row->shortname . '/student-education-delete'] = 'frontend/Frontend/student_education_delete';
    $route[$row->shortname . '/hiringinfo-update'] = 'frontend/Frontend/hiringinfo_update';
    $route[$row->shortname . '/certificateshow-update'] = 'frontend/Frontend/certificateshow_update';
    $route[$row->shortname . '/student-profile-picture-update'] = 'frontend/Frontend/student_profile_picture_update';
    $route[$row->shortname . '/student-cover-picture-update'] = 'frontend/Frontend/student_cover_picture_update';
    $route[$row->shortname . '/contact-update'] = 'frontend/Frontend/contact_update';

    $route[$row->shortname . '/get-explorecourse'] = 'frontend/Frontend/get_explorecourse';
    $route[$row->shortname . '/get-explorecourse-load-more'] = 'frontend/Frontend/get_explorecourse_load_more';
    $route[$row->shortname . '/category-course/(:any)'] = 'frontend/Frontend/category_course/$1';
    $route[$row->shortname . '/locad-more-course'] = 'frontend/Frontend/locad_more_course';
    $route[$row->shortname . '/course-filtering-loadmore'] = 'frontend/Frontend/course_filtering_loadmore';
    $route[$row->shortname . '/course-details/(:any)'] = 'frontend/Frontend/course_details/$1';
    $route[$row->shortname . '/course-details/(:any)/(:any)'] = 'frontend/Frontend/course_details/$1/$2';
    $route[$row->shortname . '/show-assignmentDetails'] = 'frontend/Frontend/show_assignmentDetails';
    $route[$row->shortname . '/locad-more-project'] = 'frontend/Frontend/locad_more_project';
    $route[$row->shortname . '/add-to-mycourse'] = 'frontend/Frontend/add_to_mycourse'; //free course url 
    
    $route[$row->shortname . '/allcourse'] = 'frontend/Frontend/allcourse'; 
    $route[$row->shortname . '/allcourse/(:any)'] = 'frontend/Frontend/allcourse/$1';
    $route[$row->shortname . '/load-more-allcourse'] = 'frontend/Frontend/load_more_allcourse'; 

    $route[$row->shortname . '/show-quizform/(:any)/(:any)'] = 'frontend/Frontend/show_quizform/$1/$2';
    $route[$row->shortname . '/show-quizform/(:any)/(:any)/(:any)'] = 'frontend/Frontend/show_quizform/$1/$2/$3';
    $route[$row->shortname . '/exam-submit'] = 'frontend/Frontend/exam_submit';
    $route[$row->shortname . '/student-follow-instructor'] = 'frontend/Frontend/student_follow_instructor';
    $route[$row->shortname . '/student-unfollow-instructor'] = 'frontend/Frontend/student_unfollow_instructor';
    $route[$row->shortname . '/faq-page'] = 'frontend/Frontend/faq';
    $route[$row->shortname . '/contact'] = 'frontend/Frontend/contact';
    $route[$row->shortname . '/submit-contact'] = 'frontend/Frontend/submit_contact';
    $route[$row->shortname . '/blog'] = 'frontend/Frontend/blog';
    $route[$row->shortname . '/blog/(:any)'] = 'frontend/Frontend/blog/$1';
    $route[$row->shortname . '/forum-details/(:any)'] = 'frontend/Frontend/forum_details/$1';
    $route[$row->shortname . '/forum-category-page/(:any)'] = 'frontend/Frontend/forum_category/$1';
    $route[$row->shortname . '/forum-category-page/(:any)/(:any)'] = 'frontend/Frontend/forum_category/$1';
    $route[$row->shortname . '/eventlist'] = 'frontend/Frontend/eventlist/';
    $route[$row->shortname . '/eventlist/(:any)'] = 'frontend/Frontend/eventlist/$1';
    $route[$row->shortname . '/project-list'] = 'frontend/Frontend/project_list/';
    $route[$row->shortname . '/project-list/(:any)'] = 'frontend/Frontend/project_list/$1';
    $route[$row->shortname . '/project-view/(:any)'] = 'frontend/Frontend/project_view/$1';
    $route[$row->shortname . '/get-allprojectbytype'] = 'frontend/Frontend/get_allprojectbytype';

    // $route[$row->shortname . '/exam-result/(:any)'] = 'frontend/Frontend/exam_result/$1';

    // $route[$row->shortname . '/get-studentexamshow'] = 'frontend/Frontend/get_studentexamshow';
    $route[$row->shortname . '/add-to-cart'] = 'frontend/Frontend/add_to_cart/';
    $route[$row->shortname . '/cart'] = 'frontend/Frontend/cart/';
    $route[$row->shortname . '/cart-update'] = 'frontend/Frontend/update_cart/';
    $route[$row->shortname . '/cart-delete'] = 'frontend/Frontend/cart_delete/';
    $route[$row->shortname . '/checkout'] = 'frontend/Frontend/checkout';
    $route[$row->shortname . '/apply-coupon'] = 'frontend/Frontend/apply_coupon';
    
    $route[$row->shortname . '/subscription-checkout/(:any)'] = 'frontend/Frontend/subscription_checkout/$1';
    $route[$row->shortname . '/confirm-order'] = 'frontend/Frontend/confirm_order';
    $route[$row->shortname . '/uniqueemail-check'] = 'frontend/Frontend/uniqueemailcheck';
    $route[$row->shortname . '/show-course-preview'] = 'frontend/Frontend/show_course_preview';
    $route[$row->shortname . '/load-course-content'] = 'frontend/Frontend/load_course_content';
    $route[$row->shortname . '/get-coursesave'] = 'frontend/Frontend/get_coursesave';
    $route[$row->shortname . '/course-notesave'] = 'frontend/Frontend/course_notesave';
    $route[$row->shortname . '/noteedit-form'] = 'frontend/Frontend/noteedit_form';
    $route[$row->shortname . '/get-noteslist'] = 'frontend/Frontend/get_noteslist';
    $route[$row->shortname . '/get-notecount'] = 'frontend/Frontend/get_notecount';
    $route[$row->shortname . '/note-delete'] = 'frontend/Frontend/note_delete';
    $route[$row->shortname . '/get-allnoteslist'] = 'frontend/Frontend/get_allnoteslist';
    $route[$row->shortname . '/get-allnotecount'] = 'frontend/Frontend/get_allnotecount';
    $route[$row->shortname . '/claim-certificate-form'] = 'frontend/Frontend/claim_certificate_form';
    $route[$row->shortname . '/assign-student-course-certificate'] = 'frontend/Frontend/assign_student_course_certificate';
    $route[$row->shortname . '/student-signup'] = 'frontend/Frontend/student_signup';
    $route[$row->shortname . '/otp-check'] = 'frontend/Frontend/otp_checkform';
    $route[$row->shortname . '/ins-signup'] = 'frontend/Frontend/instructor_signup';
    $route[$row->shortname . '/enterprise-signup'] = 'frontend/Frontend/enterprise_signup';
    // $route[$row->shortname . '/learner-signin'] = 'frontend/Frontend/signin';
    $route[$row->shortname . '/learner'] = 'frontend/Frontend/learner';
    $route[$row->shortname . '/ins'] = 'frontend/Frontend/instructor';
    // $route[$row->shortname . '/ins-signin'] = 'frontend/Frontend/signin';
    $route[$row->shortname . '/signin'] = 'frontend/Frontend/signin';
    $route[$row->shortname . '/ins-signin'] = 'frontend/Frontend/ins_signin';
    $route[$row->shortname . '/forgotpassword-form'] = 'frontend/Frontend/forgotpassword_form';
    $route[$row->shortname . '/forgot-password-send'] = 'dashboard/auth/forgot_password_send';
    $route[$row->shortname . '/password-resetlink'] = 'frontend/Frontend/password_resetlink';
    $route[$row->shortname . '/password-reset'] = 'dashboard/auth/password_reset';
    $route[$row->shortname . '/register-save'] = 'frontend/Frontend/register_save';
    $route[$row->shortname . '/checkout-unique-mailcheck'] = 'frontend/Frontend/checkout_unique_mailcheck';
    $route[$row->shortname . '/otpsubmit'] = 'frontend/Frontend/otpsubmit';
    $route[$row->shortname . '/resendotp'] = 'frontend/Frontend/resendotp';
    $route[$row->shortname . '/subscriber-save'] = 'frontend/Frontend/subscriber_save';
    $route[$row->shortname . '/about'] = 'frontend/Frontend/about';
   
    $route[$row->shortname . '/privacy-policy'] = 'frontend/Frontend/privacy_policy';
    $route[$row->shortname . '/refund-policy'] = 'frontend/Frontend/refund_policy';
    $route[$row->shortname . '/terms-condition'] = 'frontend/Frontend/terms_condition';
    $route[$row->shortname . '/autocomplete-course-search'] = 'frontend/Frontend/autocomplete_course_search';
    $route[$row->shortname . '/autocomplete-course-search-ex'] = 'frontend/Frontend/autocomplete_course_search_ex';
    $route[$row->shortname . '/typeahead-search'] = 'frontend/Frontend/typeahead_search';
    $route[$row->shortname . '/autocomplete-category-wise-course-search'] = 'frontend/Frontend/autocomplete_category_wise_course_search';
    $route[$row->shortname . '/category-wise-typeahead-search'] = 'frontend/Frontend/category_wise_typeahead_search';
    $route[$row->shortname . '/category-course-filtering'] = 'frontend/Frontend/category_course_filtering';
    // subscription_details
    $route[$row->shortname . '/subscription-details'] = 'frontend/Frontend/subscription_details';
    // video time count
    $route[$row->shortname . '/set-timewatchs'] = 'frontend/Frontend/set_timewatch';
    $route[$row->shortname . '/lesson-textfilecompleted'] = 'frontend/Frontend/lesson_textfilecompleted';

    $route[$row->shortname . '/instructor-project-add'] = 'frontend/Instructor/instructor_project_add';
    $route[$row->shortname . '/instructor-project-submit'] = 'frontend/Instructor/instructor_project_save';
    $route[$row->shortname . '/instructor-project-edit/(:any)'] = 'frontend/Instructor/instructor_project_edit/$1';
    $route[$row->shortname . '/instructor-project-submitupdate'] = 'frontend/Instructor/instructor_project_update';
    $route[$row->shortname . '/type-wise-instructor-project-load'] = 'frontend/Instructor/type_wise_instructor_project_load';
    $route[$row->shortname . '/type-wise-instructor-project-public'] = 'frontend/Instructor/type_wise_instructor_project_public';
    $route[$row->shortname . '/instructor-project-view/(:any)'] = 'frontend/Instructor/instructor_project_view/$1';
    $route[$row->shortname . '/instructor-project-delete'] = 'frontend/Instructor/instructor_project_delete';
    $route[$row->shortname . '/instructor-project-review/(:any)'] = 'frontend/Instructor/instructor_project_review/$1';
    $route[$row->shortname . '/instructor-project-review-submit'] = 'frontend/Instructor/instructor_project_review_submit';
    $route[$row->shortname . '/courseload-withprojectsummary'] = 'frontend/Instructor/courseload_withprojectsummary';
    
    // ================ its for instructor dashboard ===============
    $route[$row->shortname . '/instructor-dashboard'] = 'frontend/Instructor/instructor_dashboard';
    $route[$row->shortname . '/yearmonthinstructor-earninggraph'] = 'frontend/Instructor/yearmonthinstructor_earninggraph';
    $route[$row->shortname . '/instructor-profile'] = 'frontend/Instructor/instructor_profile';
    $route[$row->shortname . '/instructor-profile-show/(:any)'] = 'frontend/Instructor/instructor_profile_show/$1';
    $route[$row->shortname . '/single-instructor-courses/(:any)'] = 'frontend/Instructor/single_instructor_courses/$1';
    $route[$row->shortname . '/single-instructor-activities/(:any)'] = 'frontend/Instructor/single_instructor_activities/$1';
    $route[$row->shortname . '/instructor-profile-edit'] = 'frontend/Instructor/instructor_profile_edit';
    $route[$row->shortname . '/instructor-resume-upload-delete'] = 'frontend/Instructor/instructor_resume_upload_delete';
    $route[$row->shortname . '/instructor-courses'] = 'frontend/Instructor/courses';
    $route[$row->shortname . '/course-agreement-submit'] = 'frontend/Instructor/course_agreement_submit';
    $route[$row->shortname . '/instructor-course-add'] = 'frontend/Instructor/course_form';
    $route[$row->shortname . '/instructor-activities'] = 'frontend/Instructor/activities';
    $route[$row->shortname . '/instructor-earnings'] = 'frontend/Instructor/earnings';
    $route[$row->shortname . '/user-paymentmethodsave'] = 'frontend/Instructor/user_paymentmethodsave';
    $route[$row->shortname . '/user-bankpaymentmethodsave'] = 'frontend/Instructor/user_bankpaymentmethodsave';
    $route[$row->shortname . '/remove-mobilebanking'] = 'frontend/Instructor/remove_mobilebanking';
    $route[$row->shortname . '/withdraw-submit'] = 'frontend/Instructor/withdraw_submit';
    $route[$row->shortname . '/withdraw-filter'] = 'frontend/Instructor/withdraw_filter';
    $route[$row->shortname . '/instructor-notifications'] = 'frontend/Instructor/notifications';
    $route[$row->shortname . '/instructor-notifications/(:any)'] = 'frontend/Instructor/notifications/$1';
    $route[$row->shortname . '/instructor-account-settings'] = 'frontend/Instructor/account_settings';
    $route[$row->shortname . '/instructor-notification-settings'] = 'frontend/Instructor/instructor_notification_settings';
    $route[$row->shortname . '/save-instructor-setting-notification'] = 'frontend/Instructor/save_setting_notification';
    $route[$row->shortname . '/instructor-affiliation-settings'] = 'frontend/Instructor/instructor_affiliation_setting';
    $route[$row->shortname . '/instructor-payment-setting'] = 'frontend/Instructor/instructor_payment_setting';
    $route[$row->shortname . '/instructor-change-password'] = 'frontend/Instructor/change_password';
    $route[$row->shortname . '/instructor-change-language'] = 'frontend/Instructor/instructor_language_change';   
    $route[$row->shortname . '/instructor-sticky-note'] = 'frontend/Instructor/instructor_sticky_note_save';  
    $route[$row->shortname . '/instructor-sticky-note-delete'] = 'frontend/Instructor/instructorsticky_note_delete';
    $route[$row->shortname . '/instructor-resume-upload'] = 'frontend/Instructor/resume_upload';
    $route[$row->shortname . '/instructor-fileupload-progressbar-check'] = 'frontend/Instructor/instructor_fileupload_progressbar_check';
    $route[$row->shortname . '/instructor-profile-update'] = 'frontend/Instructor/instructor_profile_update';
    $route[$row->shortname . '/instructor-biography-update'] = 'frontend/Instructor/biography_update';
    $route[$row->shortname . '/instructor-skill-update'] = 'frontend/Instructor/instructor_skills_update';
    $route[$row->shortname . '/instructor-proficiency-update'] = 'frontend/Instructor/proficiency_update';
    $route[$row->shortname . '/instructor-featureshow-update'] = 'frontend/Instructor/instructor_featureshow_update';
    $route[$row->shortname . '/instructor-experience-save'] = 'frontend/Instructor/experience_save';
    $route[$row->shortname . '/instructor-experience-editdata'] = 'frontend/Instructor/experience_edit';
    $route[$row->shortname . '/instructor-experience-update'] = 'frontend/Instructor/experience_update';
    $route[$row->shortname . '/instructor-education-save'] = 'frontend/Instructor/education_save';
    $route[$row->shortname . '/instructor-education-editdata'] = 'frontend/Instructor/education_edit_data';
    $route[$row->shortname . '/instructor-education-update'] = 'frontend/Instructor/education_update';
    $route[$row->shortname . '/instructor-contact-save'] = 'frontend/Instructor/contact_save';
    $route[$row->shortname . '/instructor-sociallink-save'] = 'frontend/Instructor/social_link_add';
    $route[$row->shortname . '/instructor-sociallink-list'] = 'frontend/Instructor/social_link_ajaxlist';
    $route[$row->shortname . '/instructor-sociallink-delete'] = 'frontend/Instructor/social_link_delete';
    $route[$row->shortname . '/instructor-profile-picture-update'] = 'frontend/Instructor/instructor_profile_picture_update';
    $route[$row->shortname . '/instructor-cover-picture-update'] = 'frontend/Instructor/instructor_cover_picture_update';
    $route[$row->shortname . '/get-subcategory'] = 'frontend/Instructor/get_subcategory';
    $route[$row->shortname . '/instructor-course-save'] = 'frontend/Instructor/save_course';
    $route[$row->shortname . '/instructor-add-chapter'] = 'frontend/Instructor/add_chapter';
    $route[$row->shortname . '/instructor-add-lesson'] = 'frontend/Instructor/add_lesson';
    $route[$row->shortname . '/instructor-delete-lesson'] = 'frontend/Instructor/delete_lesson';
    $route[$row->shortname . '/instructor-delete-lesson-resourses'] = 'frontend/Instructor/instructor_delete_lesson_resourses';
    $route[$row->shortname . '/instructor-delete-lesson-multifile'] = 'frontend/Instructor/instructor_delete_lesson_multifile';

    $route[$row->shortname . '/instructor-add-quiz'] = 'frontend/Instructor/add_quiz';
    $route[$row->shortname . '/instructor-delete-question'] = 'frontend/Instructor/delet_question';
    $route[$row->shortname . '/instructor-delete-quiz'] = 'frontend/Instructor/delet_quiz';
    $route[$row->shortname . '/get-course-chapterlist'] = 'frontend/Instructor/get_course_chapterlist';
    $route[$row->shortname . '/instructor-project-save'] = 'frontend/Instructor/save_project_assignment';
    $route[$row->shortname . '/instructor-delete-project'] = 'frontend/Instructor/assigned_project_delete';
    $route[$row->shortname . '/instructor-course-price-save'] = 'frontend/Instructor/course_pricing_save';
    $route[$row->shortname . '/instructor-course-edit/(:any)'] = 'frontend/Instructor/course_edit/$1';
    $route[$row->shortname . '/instructor-project-preview'] = 'frontend/Instructor/course_preview';
    $route[$row->shortname . '/instructor-course-termscondition'] = 'frontend/Instructor/course_terms_condition';
    $route[$row->shortname . '/instructor-delete-chapter'] = 'frontend/Instructor/delete_chapter';
    $route[$row->shortname . '/instructor-course-docusin'] = 'frontend/Instructor/course_docusin_add';
    $route[$row->shortname . '/instructor-course-videoupload'] = 'frontend/Instructor/instructor_course_videoupload';
    $route[$row->shortname . '/instructor-new-certificate'] = 'frontend/Instructor/instructor_new_certificate';
    $route[$row->shortname . '/instructor-certificate-save'] = 'frontend/Instructor/instructor_save_certificate';
    $route[$row->shortname . '/instructor-certificate-delete'] = 'frontend/Instructor/instructor_certificate_delete';
    $route[$row->shortname . '/instructor-certificate-showhide'] = 'frontend/Instructor/instructor_certificate_showhide';
    $route[$row->shortname . '/instructor-faq'] = 'frontend/Instructor/instructor_faq';
    $route[$row->shortname . '/instructor-faqeditform'] = 'frontend/Instructor/instructor_faqeditform';
    $route[$row->shortname . '/instructor-delete-video'] = 'frontend/Instructor/delete_video';
    $route[$row->shortname . '/instinstructor-save-downloadablefiles'] = 'frontend/Instructor/instructor_save_downloadablefiles';

    // $route[$row->shortname .'/signup'] = 'frontend/Frontend/signup';
    // $route[$row->shortname .'/signin'] = 'frontend/Frontend/signin';
// ================== its for dashboard module start =================
    $route[$row->shortname . '/revenuestatus-monthyear'] = "dashboard/home/revenuestatus_monthyear";
    $route[$row->shortname . '/yearmonthly-salesamount'] = "dashboard/home/yearmonthly_salesamount";
    $route[$row->shortname . '/yearmonth-todays-sales']  = "dashboard/home/yearmonth_todays_sales";
    $route[$row->shortname .'/review-save']              = 'frontend/Frontend/review_save';

    $route[$row->shortname . '/login'] = "dashboard/auth/index";
    $route[$row->shortname . '/login-process'] = "dashboard/auth/login_process";
    $route[$row->shortname . '/password-update'] = 'dashboard/auth/password_update';
    $route[$row->shortname . '/logout'] = "dashboard/auth/logout";

    // ============ its for add-enterprise ============
    $route[$row->shortname . '/add-enterprise'] = 'dashboard/Enterprise/index';
    $route[$row->shortname . '/enterprise-save'] = 'dashboard/Enterprise/enterprise_save';
    $route[$row->shortname . '/add-enterprise'] = 'dashboard/Enterprise/index';
    $route[$row->shortname . '/enterprise-list'] = 'dashboard/Enterprise/enterprise_list';
    $route[$row->shortname . '/get-enterpriselist'] = 'dashboard/Enterprise/get_enterpriselist';
    $route[$row->shortname . '/enterprise-editform'] = 'dashboard/Enterprise/enterprise_editform';
    $route[$row->shortname . '/enterprise-inactive'] = 'dashboard/Enterprise/enterprise_inactive';
    $route[$row->shortname . '/enterprise-active'] = 'dashboard/Enterprise/enterprise_active';
    $route[$row->shortname . '/enterprise-delete'] = 'dashboard/Enterprise/enterprise_delete';
    $route[$row->shortname . '/login-as-enterprise/(:any)'] = 'dashboard/Enterprise/login_as_enterprise/$1';
    $route[$row->shortname . '/dashboard'] = 'dashboard/home';

    // =============== its for about ==================    
    $route[$row->shortname . '/aboutus'] = 'dashboard/Aboutus/index';
    $route[$row->shortname . '/aboutus/(:any)'] = 'dashboard/Aboutus/index/$1';
    $route[$row->shortname . '/about-summary-save'] = 'dashboard/Aboutus/about_summary_save';
    $route[$row->shortname . '/about-choose-save'] = 'dashboard/Aboutus/about_choose_save';
    $route[$row->shortname . '/get-choosenlist'] = 'dashboard/Aboutus/get_choosenlist';
    $route[$row->shortname . '/aboutchoose-edit'] = 'dashboard/Aboutus/aboutchoose_edit';
    $route[$row->shortname . '/aboutchoose-infoupdate'] = 'dashboard/Aboutus/aboutchoose_infoupdate';
    $route[$row->shortname . '/aboutchoose-delete'] = 'dashboard/Aboutus/aboutchoose_delete';
    $route[$row->shortname . '/about-service-save'] = 'dashboard/Aboutus/about_service_save';
    $route[$row->shortname . '/get-aboutservicelist'] = 'dashboard/Aboutus/get_aboutservicelist';
    $route[$row->shortname . '/aboutservice-edit'] = 'dashboard/Aboutus/aboutservice_edit';
    $route[$row->shortname . '/aboutservice-delete'] = 'dashboard/Aboutus/aboutservice_delete';
    
    //=============== its for category =============
    $route[$row->shortname . '/category'] = 'dashboard/Category/index';
    $route[$row->shortname . '/get-categorylist'] = 'dashboard/Category/get_categorylist';
    $route[$row->shortname . '/category/(:any)'] = 'dashboard/Category/index/$1';
    $route[$row->shortname . '/category-save'] = 'dashboard/Category/category_save';
    $route[$row->shortname . '/category-edit/(:any)'] = 'dashboard/Category/category_edit/$1';
    $route[$row->shortname . '/category-update'] = 'dashboard/Category/category_update';
    $route[$row->shortname . '/category-delete'] = 'dashboard/Category/category_delete';
    $route[$row->shortname . '/category-search'] = 'dashboard/Category/category_search';
    $route[$row->shortname . '/category-inactive'] = 'dashboard/Category/category_inactive';
    $route[$row->shortname . '/category-active'] = 'dashboard/Category/category_active';
    $route[$row->shortname . '/category-ordering-update'] = 'dashboard/Category/category_ordering_update';
    $route[$row->shortname . '/show-category'] = 'dashboard/Category/show_category';
    $route[$row->shortname . '/category-archives'] = 'dashboard/Category/category_archives';
    $route[$row->shortname . '/get-categoryarchivelist'] = 'dashboard/Category/get_categoryarchivelist';
    $route[$row->shortname . '/category-restore'] = 'dashboard/Category/category_restore';
    $route[$row->shortname . '/set-timewatch'] = 'dashboard/Category/set_timewatch';
    $route[$row->shortname . '/test-vimeoapi'] = 'dashboard/Category/test_vimeoapi';
    $route[$row->shortname . '/subcategory'] = 'dashboard/Category/subcategory';
    $route[$row->shortname . '/get-subcategorylist'] = 'dashboard/Category/get_subcategorylist';

    //======= its for coupon==================
    $route[$row->shortname . '/coupon-list'] = 'dashboard/coupon/index';
    $route[$row->shortname . '/add-coupon'] = 'dashboard/coupon/add_coupon';
    $route[$row->shortname . '/coupon-save'] = 'dashboard/coupon/coupon_save';
    $route[$row->shortname . '/get-couponlist'] = 'dashboard/coupon/get_couponlist';
    $route[$row->shortname . '/edit-coupon/(:any)'] = 'dashboard/coupon/coupon_edit/$1';
    $route[$row->shortname . '/coupon-update'] = 'dashboard/coupon/coupon_update';
    $route[$row->shortname . '/coupon-delete'] = 'dashboard/coupon/coupon_delete';
    $route[$row->shortname . '/coupon-inactive'] = 'dashboard/coupon/coupon_inactive';
    $route[$row->shortname . '/coupon-active'] = 'dashboard/coupon/coupon_active';
    $route[$row->shortname . '/coupon-generate'] = 'dashboard/coupon/coupon_generate';
    
    //======= its for certificate==================
    $route[$row->shortname . '/add-certificate'] = 'dashboard/certificate/index';
    $route[$row->shortname . '/certificateinfo-save'] = 'dashboard/certificate/certificateinfo_save';
    $route[$row->shortname . '/certificate-list'] = 'dashboard/certificate/certificate_list';
    $route[$row->shortname . '/get-certificatelist'] = 'dashboard/certificate/get_certificatelist';
    $route[$row->shortname . '/certificate-edit'] = 'dashboard/certificate/certificate_edit';
    $route[$row->shortname . '/show-certificate'] = 'dashboard/certificate/show_certificate';
    $route[$row->shortname . '/certificate-delete'] = 'dashboard/certificate/certificate_delete';
    $route[$row->shortname . '/certificate-archives'] = 'dashboard/certificate/certificate_archives';

    //============ its for course ============
    $route[$row->shortname . '/add-course'] = 'dashboard/Course/index';
    $route[$row->shortname . '/add-course/(:any)'] = 'dashboard/Course/index/$1';
    $route[$row->shortname . '/category-wise-subcategory'] = 'dashboard/Course/category_wise_subcategory';
    $route[$row->shortname . '/course-save'] = 'dashboard/Course/course_save';
    $route[$row->shortname . '/course-list'] = 'dashboard/Course/course_list';
    $route[$row->shortname . '/course-list/(:any)'] = 'dashboard/Course/course_list/$1';
    $route[$row->shortname . '/course-preview'] = 'dashboard/Course/course_preview';
    $route[$row->shortname . '/course-feedbacksubmit'] = 'dashboard/Course/course_feedbacksubmit';
    $route[$row->shortname . '/course-filter'] = 'dashboard/Course/course_filter';
    $route[$row->shortname . '/course-datalist'] = 'dashboard/Course/course_datalist';
    $route[$row->shortname . '/course-archive'] = 'dashboard/Course/course_archive';
    $route[$row->shortname . '/course-archivedatalist'] = 'dashboard/Course/course_archivedatalist';
    $route[$row->shortname . '/course-restore'] = 'dashboard/Course/course_restore';
    $route[$row->shortname . '/course-edit/(:any)'] = 'dashboard/Course/course_edit/$1';
    $route[$row->shortname . '/course-update'] = 'dashboard/Course/course_update';
    $route[$row->shortname . '/course-inactivepreview'] = 'dashboard/Course/course_inactivepreview';
    $route[$row->shortname . '/course-inactive'] = 'dashboard/Course/course_inactive';
    $route[$row->shortname . '/course-active'] = 'dashboard/Course/course_active';
    // $route[$row->shortname . '/course-popularstatus'] = 'dashboard/Course/course_popularstatus';
    // $route[$row->shortname . '/course-newstatus'] = 'dashboard/Course/course_newstatus';
    $route[$row->shortname . '/coursesharepercent-check'] = 'dashboard/Course/coursesharepercent_check';
    $route[$row->shortname . '/course-delete'] = 'dashboard/Course/course_delete';
    $route[$row->shortname . '/category-wise-course'] = 'dashboard/Course/category_wise_course';
    $route[$row->shortname . '/single-invoice/(:any)'] = 'dashboard/Course/single_invoice/$1';
    $route[$row->shortname . '/addsection-form'] = 'dashboard/Course/addsection_form';
    $route[$row->shortname . '/section-save'] = 'dashboard/Course/section_save';
    $route[$row->shortname . '/editsection-form'] = 'dashboard/Course/editsection_form';
    $route[$row->shortname . '/section-update'] = 'dashboard/Course/section_update';
    $route[$row->shortname . '/section-delete'] = 'dashboard/Course/section_delete';
    $route[$row->shortname . '/addlesson-form'] = 'dashboard/Course/addlesson_form';
    $route[$row->shortname . '/get-video-details'] = 'dashboard/Course/get_video_details';
    $route[$row->shortname . '/lesson-save'] = 'dashboard/Course/lesson_save';
    $route[$row->shortname . '/editlesson-form'] = 'dashboard/Course/editlesson_form';
    $route[$row->shortname . '/lesson-update'] = 'dashboard/Course/lesson_update';
    $route[$row->shortname . '/lesson-delete'] = 'dashboard/Course/lesson_delete';
    $route[$row->shortname . '/resource-delete'] = 'dashboard/Course/resource_delete';
    $route[$row->shortname . '/assignexam-form'] = 'dashboard/Course/assignexam_form';
    $route[$row->shortname . '/assign-exam'] = 'dashboard/Course/assign_exam';
    $route[$row->shortname . '/assignexam-edit'] = 'dashboard/Course/assignexam_edit';
    $route[$row->shortname . '/assignexam-delete'] = 'dashboard/Course/assignexam_delete';
    $route[$row->shortname . '/course-exam-edit/(:any)'] = 'dashboard/Course/course_exam_edit/$1';
    $route[$row->shortname . '/add-exam'] = 'dashboard/Course/add_exam';
    $route[$row->shortname . '/add-exam/(:any)'] = 'dashboard/Course/add_exam/$1';
    $route[$row->shortname . '/exam-save'] = 'dashboard/Course/exam_save';
    $route[$row->shortname . '/exam-list'] = 'dashboard/Course/exam_list';
    $route[$row->shortname . '/get-examlist'] = 'dashboard/Course/get_examlist';
    $route[$row->shortname . '/exam-edit/(:any)'] = 'dashboard/Course/exam_edit/$1';
    $route[$row->shortname . '/exam-update'] = 'dashboard/Course/exam_update';
    $route[$row->shortname . '/exam-archives'] = 'dashboard/Course/exam_archives';
    $route[$row->shortname . '/get-archivelist'] = 'dashboard/Course/get_archivelist';
    $route[$row->shortname . '/add-questionform'] = 'dashboard/Course/add_questionform';
    $route[$row->shortname . '/question-save'] = 'dashboard/Course/question_save';
    $route[$row->shortname . '/show-examset'] = 'dashboard/Course/show_examset';
    $route[$row->shortname . '/exam-inactive'] = 'dashboard/Course/exam_inactive';
    $route[$row->shortname . '/exam-active'] = 'dashboard/Course/exam_active';
    $route[$row->shortname . '/exam-delete'] = 'dashboard/Course/exam_delete';
    $route[$row->shortname . '/purchased-course-list'] = 'dashboard/Course/student_sales_course';
    $route[$row->shortname . '/purchased-course-list/(:any)'] = 'dashboard/Course/student_sales_course/$1';
    $route[$row->shortname . '/student-salescourse-filter'] = 'dashboard/Course/student_salescourse_filter';
    $route[$row->shortname . '/faculty-sales-course'] = 'dashboard/Course/faculty_sales_course';
    $route[$row->shortname . '/faculty-salescourse-filter'] = 'dashboard/Course/faculty_salescourse_filter';
    $route[$row->shortname . '/commission-list'] = 'dashboard/Course/commission_list';
    $route[$row->shortname . '/commission-list/(:any)'] = 'dashboard/Course/commission_list/$1';
    $route[$row->shortname . '/faculty-wise-course'] = 'dashboard/Course/faculty_wise_course';
    $route[$row->shortname . '/course-wise-courseinfo'] = 'dashboard/Course/course_wise_courseinfo';
    $route[$row->shortname . '/faculty-course-commission'] = 'dashboard/Course/faculty_course_commission';
    $route[$row->shortname . '/faculty-revenue'] = 'dashboard/Course/faculty_revenue';
    $route[$row->shortname . '/faculty-revenue/(:any)'] = 'dashboard/Course/faculty_revenue/$1';
    $route[$row->shortname . '/yearmonthly-myrevenue'] = 'dashboard/Course/yearmonthly_myrevenue';
    $route[$row->shortname . '/faculty-course-revenue/(:any)'] = 'dashboard/Course/faculty_course_revenue/$1';
    $route[$row->shortname . '/faculty-course-revenue/(:any)/(:any)'] = 'dashboard/Course/faculty_course_revenue/$1/$2';
    $route[$row->shortname . '/pay-form'] = 'dashboard/Course/pay_form';
    $route[$row->shortname . '/pay-with-paypal-submit'] = 'dashboard/Course/pay_with_paypal_submit';
    $route[$row->shortname . '/admin-revenue'] = 'dashboard/Course/admin_revenue';
    $route[$row->shortname . '/admin-revenue/(:any)'] = 'dashboard/Course/admin_revenue/$1';
    $route[$row->shortname . '/photo-resize-form'] = 'dashboard/Course/photo_resize_form';
    $route[$row->shortname . '/photo-resize-submit'] = 'dashboard/Course/photo_resize_submit';
    $route[$row->shortname . '/csrf-generator'] = 'dashboard/Course/csrf_generator';
    $route[$row->shortname . '/customvideocheck'] = 'dashboard/Course/customvideocheck';
    $route[$row->shortname . '/course-faq'] = 'dashboard/Course/course_faq';
    $route[$row->shortname . '/course-faq-save'] = 'dashboard/Course/course_faq_save';
    $route[$row->shortname . '/course-get-faqlist'] = 'dashboard/Course/course_get_faqlist';
    $route[$row->shortname . '/course-faqedit-form'] = 'dashboard/Course/course_faqedit_form';
    $route[$row->shortname . '/course-faq-delete'] = 'dashboard/Course/course_faq_delete';
    $route[$row->shortname . '/faq'] = 'dashboard/Course/faq';
    $route[$row->shortname . '/get-faqlist'] = 'dashboard/Course/get_faqlist';
    $route[$row->shortname . '/faq-save'] = 'dashboard/Course/faq_save';
    $route[$row->shortname . '/faqedit-form'] = 'dashboard/Course/faqedit_form';
    $route[$row->shortname . '/faq-delete'] = 'dashboard/Course/faq_delete';
    $route[$row->shortname . '/sharepercent-form'] = 'dashboard/Course/sharepercent_form';
    $route[$row->shortname . '/sharepercent-save'] = 'dashboard/Course/sharepercent_save';
    $route[$row->shortname . '/tagstatus-form'] = 'dashboard/Course/tagstatus_form';
    $route[$row->shortname . '/tagstatus-save'] = 'dashboard/Course/tagstatus_save';
    $route[$row->shortname . '/course-agreement-paperupload'] = 'dashboard/Course/course_agreement_paperupload';
    $route[$row->shortname . '/projectassignment-form'] = 'dashboard/Course/projectassignment_form';
    $route[$row->shortname . '/get-chapterbycourse'] = 'dashboard/Course/get_chapterbycourse';
    $route[$row->shortname . '/project-assignment-add'] = 'dashboard/Course/project_assignment_add';
    $route[$row->shortname . '/projectassignment-editform'] = 'dashboard/Course/projectassignment_editform';
    $route[$row->shortname . '/project-assignment-update'] = 'dashboard/Course/project_assignment_update';
    $route[$row->shortname . '/assignmentproject-delete'] = 'dashboard/Course/assignmentproject_delete';
    $route[$row->shortname . '/subscription-pricing'] = 'dashboard/Course/subscription_pricing';
    $route[$row->shortname . '/subscription-pricing-update'] = 'dashboard/Course/subscription_pricing_update';
    $route[$row->shortname . '/promo-video-upload'] = 'dashboard/Course/PromoVideoUpload';
    $route[$row->shortname . '/lesson-video-upload'] = 'dashboard/Course/LessonVideoUpload';

    $route[$row->shortname . '/subscription-list'] = 'dashboard/Subscription/index';
    $route[$row->shortname . '/subcription-save'] = 'dashboard/Subscription/subcription_save';
    $route[$row->shortname . '/get-subscriptionlist'] = 'dashboard/Subscription/get_subscriptionlist';
    $route[$row->shortname . '/subscription-delete'] = 'dashboard/Subscription/subscription_delete';
    $route[$row->shortname . '/subscription-edit'] = 'dashboard/Subscription/subscription_edit';
    $route[$row->shortname . '/subcription-update'] = 'dashboard/Subscription/subcription_update';
    $route[$row->shortname . '/video-watch-time'] = 'dashboard/course/video_watch_time';
    //  library content 
    $route[$row->shortname . '/library-content-save'] = 'dashboard/LibraryContent/library_content_save';
    $route[$row->shortname . '/library-content-list'] = 'dashboard/LibraryContent/index';
    $route[$row->shortname . '/get-librarylist'] = 'dashboard/LibraryContent/get_librarylist';
    $route[$row->shortname . '/library-content-update'] = 'dashboard/LibraryContent/library_content_update';
    $route[$row->shortname . '/library-content-edit/(:any)'] = 'dashboard/LibraryContent/library_content_edit/$1';
    $route[$row->shortname . '/library-delete'] = 'dashboard/LibraryContent/library_delete';

    //=========== its for student module ==========
    $route[$row->shortname . '/add-student'] = 'dashboard/Students/index';
    $route[$row->shortname . '/get-studentlist'] = 'dashboard/Students/get_studentlist';
    $route[$row->shortname . '/student-save'] = 'dashboard/Students/student_save';
    $route[$row->shortname . '/student-list'] = 'dashboard/Students/student_list';
    $route[$row->shortname . '/student-list/(:any)'] = 'dashboard/Students/student_list/$1';
    $route[$row->shortname . '/students-filter'] = 'dashboard/Students/students_filter';
    $route[$row->shortname . '/student-edit/(:any)'] = 'dashboard/Students/student_edit/$1';
    $route[$row->shortname . '/student-update'] = 'dashboard/Students/student_update';
    $route[$row->shortname . '/student-delete'] = 'dashboard/Students/student_delete';
    $route[$row->shortname . '/student-inactive'] = 'dashboard/Students/student_inactive';
    $route[$row->shortname . '/student-active'] = 'dashboard/Students/student_active';
    $route[$row->shortname . '/assign-certificate'] = 'dashboard/Students/assign_certificate';
    $route[$row->shortname . '/assign-certificate-save'] = 'dashboard/Students/assign_certificate_save';
    $route[$row->shortname . '/get-assignedcertificatelist'] = 'dashboard/Students/get_assignedcertificatelist';
    $route[$row->shortname . '/assigncertificate-edit'] = 'dashboard/Students/assigncertificate_edit';
    $route[$row->shortname . '/assigncertificate-delete'] = 'dashboard/Students/assigncertificate_delete';
    $route[$row->shortname . '/showassign-certificate/(:any)'] = 'dashboard/Students/showassign_certificate/$1';
    $route[$row->shortname . '/showassign-certificate'] = 'dashboard/Students/showassign_certificate';
    $route[$row->shortname . '/student-showcourse'] = 'dashboard/Students/student_showcourse';

    //=========== its for faculty module ==========
    $route[$row->shortname . '/add-faculty'] = 'dashboard/Faculty/index';
    $route[$row->shortname . '/faculty-save'] = 'dashboard/Faculty/faculty_save';
    $route[$row->shortname . '/faculty-capacity-check'] = 'dashboard/Faculty/faculty_capacity_check';
    $route[$row->shortname . '/faculty-list'] = 'dashboard/Faculty/faculty_list';
    $route[$row->shortname . '/get-facultylist'] = 'dashboard/Faculty/get_facultylist';
    $route[$row->shortname . '/faculty-list/(:any)'] = 'dashboard/Faculty/faculty_list/$1';
    $route[$row->shortname . '/faculty-filter'] = 'dashboard/Faculty/faculty_filter';
    $route[$row->shortname . '/faculty-edit/(:any)'] = 'dashboard/Faculty/faculty_edit/$1';
    $route[$row->shortname . '/faculty-update'] = 'dashboard/Faculty/faculty_update';
    $route[$row->shortname . '/experience-delete'] = 'dashboard/Faculty/experience_delete';
    $route[$row->shortname . '/education-delete'] = 'dashboard/Faculty/education_delete';
    $route[$row->shortname . '/faculty-delete'] = 'dashboard/Faculty/faculty_delete';
    $route[$row->shortname . '/faculty-inactive'] = 'dashboard/Faculty/faculty_inactive';
    $route[$row->shortname . '/faculty-active'] = 'dashboard/Faculty/faculty_active';
    $route[$row->shortname . '/show-instructor'] = 'dashboard/Faculty/show_instructor';
    $route[$row->shortname . '/instructor-report'] = 'dashboard/Faculty/instructor_report';
    $route[$row->shortname . '/instructor-reportlist'] = 'dashboard/Faculty/instructor_report_list';

    //================= its for settings module ============
    $route[$row->shortname . '/settings'] = 'dashboard/Setting/index';
    $route[$row->shortname . '/settings/(:any)'] = 'dashboard/Setting/index/1$';
    $route[$row->shortname . '/checkuser-uniqueemail'] = 'dashboard/User/checkuser_uniqueemail';
    $route[$row->shortname . '/get-unique-username'] = 'dashboard/User/get_unique_username';
    $route[$row->shortname . '/user-save'] = 'dashboard/User/user_save';
    $route[$row->shortname . '/get-userlist'] = 'dashboard/User/get_userlist';
    $route[$row->shortname . '/useredit-form'] = 'dashboard/User/useredit_form';
    $route[$row->shortname . '/user-update'] = 'dashboard/User/user_update';
    $route[$row->shortname . '/user-delete'] = 'dashboard/User/delete';
    $route[$row->shortname . '/user-inactive'] = 'dashboard/User/user_inactive';
    $route[$row->shortname . '/user-active'] = 'dashboard/User/user_active';
    $route[$row->shortname . '/get-menuform'] = 'dashboard/Permission_setup/index';
    $route[$row->shortname . '/get-menulist'] = 'dashboard/Permission_setup/menu_item_list';
    $route[$row->shortname . '/menu-save'] = 'dashboard/Permission_setup/menu_save';
    $route[$row->shortname . '/menu-edit'] = 'dashboard/Permission_setup/menu_edit';
    $route[$row->shortname . '/menu-update'] = 'dashboard/Permission_setup/menu_update';
    $route[$row->shortname . '/menu-delete'] = 'dashboard/Permission_setup/menu_delete';
    $route[$row->shortname . '/menu-inactive'] = 'dashboard/Permission_setup/menu_inactive';
    $route[$row->shortname . '/menu-active'] = 'dashboard/Permission_setup/menu_active';
    $route[$row->shortname . '/menu-list'] = 'dashboard/Permission_setup/menu_list';
    $route[$row->shortname . '/icon-load'] = 'dashboard/Permission_setup/icon_load';
    $route[$row->shortname . '/get-rolepermissionform'] = 'dashboard/Role/get_rolepermissionform';
    $route[$row->shortname . '/role-permission-save'] = 'dashboard/Role/save_create';
    $route[$row->shortname . '/get-rolepermissionlist'] = 'dashboard/Role/role_list';
    $route[$row->shortname . '/role-editform'] = 'dashboard/Role/role_editform';
    // $route[$row->shortname . '/role-edit/(:any)'] = 'dashboard/role/edit_role/$1';
    $route[$row->shortname . '/role-delete'] = 'dashboard/role/delete_role';
    $route[$row->shortname . '/assign-user-role'] = 'dashboard/Role/assign_role_to_user';
    $route[$row->shortname . '/assign-user-role-list'] = 'dashboard/Role/assign_role_to_user_list';
    $route[$row->shortname . '/user-role-check'] = 'dashboard/Role/user_role_check';
    $route[$row->shortname . '/user-access-role-edit'] = 'dashboard/Role/edit_access_role';
    $route[$row->shortname . '/role-assign-delete'] = 'dashboard/Role/delete_access_role';
    $route[$row->shortname . '/add-language'] = 'dashboard/Language/index';
    $route[$row->shortname . '/language-save'] = 'dashboard/Language/addLanguage';
    $route[$row->shortname . '/phrase-save'] = 'dashboard/Language/phrase_save';
    $route[$row->shortname . '/add-phrase'] = 'dashboard/Language/add_phrase';
    $route[$row->shortname . '/phrase-list'] = 'dashboard/Language/phrase_list';
    $route[$row->shortname . '/phrase-label-edit/(:any)'] = 'dashboard/language/editPhrase/$1';
    $route[$row->shortname . '/phrase-label-edit/(:any)/(:any)'] = 'dashboard/language/editPhrase/$1/$2';
    $route[$row->shortname . '/phrase-label-search'] = 'dashboard/language/phrase_label_search';
    $route[$row->shortname . '/mail-config'] = 'dashboard/Setting/mail_config';
    $route[$row->shortname . '/mailconfig-update'] = 'dashboard/Setting/mail_config_update';
    $route[$row->shortname . '/sms-config'] = 'dashboard/Setting/sms_config';
    $route[$row->shortname . '/smsconfig-save'] = 'dashboard/Setting/sms_config_update';
    $route[$row->shortname . '/payment-method-list'] = 'dashboard/Setting/payment_method_list';
    $route[$row->shortname . '/paymentmethod-config-form'] = 'dashboard/Setting/paymentmethod_config_form';
    $route[$row->shortname . '/payment-method-update'] = 'dashboard/Setting/payment_method_update';
    $route[$row->shortname . '/payment-method-activeinactive'] = 'dashboard/Setting/payment_method_activeinactive';
    $route[$row->shortname . '/paypal-config'] = 'dashboard/Setting/paypal_config';
    $route[$row->shortname . '/stripe-config'] = 'dashboard/Setting/stripe_config';
    $route[$row->shortname . '/stripeconfig-save'] = 'dashboard/Setting/stripeconfig_save';
    $route[$row->shortname . '/payeer-config'] = 'dashboard/Setting/payeer_config';
    $route[$row->shortname . '/payeerconfig-save'] = 'dashboard/Setting/payeerconfig_save';
    $route[$row->shortname . '/payu-config'] = 'dashboard/Setting/payu_config';
    $route[$row->shortname . '/payuconfig-save'] = 'dashboard/Setting/payuconfig_save';
    $route[$row->shortname . '/paypalconfig-save'] = 'dashboard/Setting/paypal_setting_update';
    $route[$row->shortname . '/pusher-config'] = 'dashboard/Setting/pusher_config';
    $route[$row->shortname . '/pusherconfig-save'] = 'dashboard/Setting/pusherconfig_save';
    $route[$row->shortname . '/subscriber-list'] = 'dashboard/Setting/subscriber_list';
    $route[$row->shortname . '/get-subscriberlist'] = 'dashboard/Setting/get_subscriberlist';
    $route[$row->shortname . '/companies'] = 'dashboard/Setting/companies';
    $route[$row->shortname . '/get-companylist'] = 'dashboard/Setting/get_companylist';
    $route[$row->shortname . '/company-infosave'] = 'dashboard/Setting/company_infosave';
    $route[$row->shortname . '/company-edit'] = 'dashboard/Setting/company_edit';
    $route[$row->shortname . '/company-infoupdate'] = 'dashboard/Setting/company_infoupdate';
    $route[$row->shortname . '/company-delete'] = 'dashboard/Setting/company_delete';
    // alamin 24/7/21
    $route[$row->shortname . '/get-featuredin'] = 'dashboard/Setting/getfeaturedin';
    $route[$row->shortname . '/get-featuredinlist'] = 'dashboard/Setting/get_featuredinlist';
    $route[$row->shortname . '/featuredin-infosave'] = 'dashboard/Setting/featuredin_infosave';
    $route[$row->shortname . '/featuredin-edit'] = 'dashboard/Setting/featuredin_edit';
    $route[$row->shortname . '/featuredin-infoupdate'] = 'dashboard/Setting/featuredin_infoupdate';
    $route[$row->shortname . '/featuredin-delete'] = 'dashboard/Setting/featuredin_delete';
    
    $route[$row->shortname . '/paywith'] = 'dashboard/Setting/paywith';
    $route[$row->shortname . '/get-paywithlist'] = 'dashboard/Setting/get_paywithlist';
    $route[$row->shortname . '/paywith-infosave'] = 'dashboard/Setting/paywith_infosave';
    $route[$row->shortname . '/paywith-edit'] = 'dashboard/Setting/paywith_edit';
    $route[$row->shortname . '/paywith-infoupdate'] = 'dashboard/Setting/paywith_infoupdate';
    $route[$row->shortname . '/paywith-delete'] = 'dashboard/Setting/paywith_delete';

    $route[$row->shortname . '/get-proficiency'] = 'dashboard/Setting/get_proficiency';
    $route[$row->shortname . '/get-proficiencylist'] = 'dashboard/Setting/get_proficiencylist';
    $route[$row->shortname . '/proficiency-infosave'] = 'dashboard/Setting/proficiency_infosave';
    $route[$row->shortname . '/proficiency-edit'] = 'dashboard/Setting/proficiency_edit';
    $route[$row->shortname . '/proficiency-infoupdate'] = 'dashboard/Setting/proficiency_infoupdate';
    $route[$row->shortname . '/proficiency-delete'] = 'dashboard/Setting/proficiency_delete';

    $route[$row->shortname . '/team-members'] = 'dashboard/Setting/team_members';
    $route[$row->shortname . '/get-teammemberlist'] = 'dashboard/Setting/get_teammemberlist';
    $route[$row->shortname . '/teammembers-infosave'] = 'dashboard/Setting/teammembers_infosave';
    $route[$row->shortname . '/teammember-edit'] = 'dashboard/Setting/teammember_edit';
    $route[$row->shortname . '/teammember-infoupdate'] = 'dashboard/Setting/teammember_infoupdate';
    $route[$row->shortname . '/teammember-delete'] = 'dashboard/Setting/teammember_delete';
    $route[$row->shortname . '/templateinfo'] = 'dashboard/Setting/templateinfo';
    $route[$row->shortname . '/templateinfo-save'] = 'dashboard/Setting/templateinfo_save';
    $route[$row->shortname . '/get-templatelist'] = 'dashboard/Setting/get_templatelist';
    $route[$row->shortname . '/template-edit'] = 'dashboard/Setting/template_edit';
    $route[$row->shortname . '/template-delete'] = 'dashboard/Setting/template_delete';
    $route[$row->shortname . '/aboutus-form'] = 'dashboard/Setting/aboutus_form';
    $route[$row->shortname . '/aboutus-save'] = 'dashboard/Setting/aboutus_save';
    $route[$row->shortname . '/privacy-policy-form'] = 'dashboard/Setting/privacy_policy_form';
    $route[$row->shortname . '/privacy-policy-save'] = 'dashboard/Setting/privacy_policy_save';
    $route[$row->shortname . '/refund-policy-form'] = 'dashboard/Setting/refund_policy_form';
    $route[$row->shortname . '/refund-policy-save'] = 'dashboard/Setting/refund_policy_save';
    $route[$row->shortname . '/termscondition-form'] = 'dashboard/Setting/termscondition_form';
    $route[$row->shortname . '/termscondition-save'] = 'dashboard/Setting/termscondition_save';
    $route[$row->shortname . '/slider-form'] = 'dashboard/Setting/slider_form';
    $route[$row->shortname . '/slider-info-save'] = 'dashboard/Setting/slider_info_save';
    $route[$row->shortname . '/currency-form'] = 'dashboard/Setting/currency_form';
    $route[$row->shortname . '/currency-save'] = 'dashboard/Setting/currency_save';
    $route[$row->shortname . '/currency-list'] = 'dashboard/Setting/currency_list';
    $route[$row->shortname . '/currencyedit-form'] = 'dashboard/Setting/currencyedit_form';
    $route[$row->shortname . '/currency-update'] = 'dashboard/Setting/update_currencyinfo';
    $route[$row->shortname . '/currencyinfo-delete'] = 'dashboard/Setting/currencyinfo_delete';
    $route[$row->shortname . '/get-activitieslog'] = 'dashboard/Setting/get_activitieslog';
    $route[$row->shortname . '/get-activitieslogdatalist'] = 'dashboard/Setting/get_activitieslogdatalist';
    $route[$row->shortname . '/add-appsetting'] = 'dashboard/Setting/app_setting';
    $route[$row->shortname . '/google-login-config'] = 'dashboard/Setting/google_login_config';
    $route[$row->shortname . '/google-config-update'] = 'dashboard/Setting/google_config_update';
    $route[$row->shortname . '/facebook-login-config'] = 'dashboard/Setting/facebook_login_config';
    $route[$row->shortname . '/facebook-config-update'] = 'dashboard/Setting/facebook_config_update';
    $route[$row->shortname . '/vimeo-config'] = 'dashboard/Setting/vimeo_config';
    $route[$row->shortname . '/vimeo-config-update'] = 'dashboard/Setting/vimeo_config_update';
    
    $route[$row->shortname . '/home-page-setting'] = 'dashboard/Setting/home_page_setting';
    $route[$row->shortname . '/ourfeatures-save'] = 'dashboard/Setting/ourfeatures_save';
    $route[$row->shortname . '/get-ourfeaturelist'] = 'dashboard/Setting/get_ourfeaturelist';
    $route[$row->shortname . '/ourfeature-edit'] = 'dashboard/Setting/ourfeature_edit';
    $route[$row->shortname . '/ourfeature-infoupdate'] = 'dashboard/Setting/ourfeature_infoupdate';
    $route[$row->shortname . '/ourfeature-delete'] = 'dashboard/Setting/ourfeature_delete';
    $route[$row->shortname . '/website-settingform'] = 'dashboard/Setting/website_settingform';
    $route[$row->shortname . '/website-settingupate'] = 'dashboard/Setting/website_settingupate';
    $route[$row->shortname . '/strength-number'] = 'dashboard/Setting/strength_number';
    $route[$row->shortname . '/strengthnumber-upate'] = 'dashboard/Setting/strengthnumber_upate';
    $route[$row->shortname . '/need-consultation'] = 'dashboard/Setting/need_consultation';
    $route[$row->shortname . '/get-consultationlist'] = 'dashboard/Setting/get_consultationlist';

    //==============testimonials================
    $route[$row->shortname . '/testimonials-list'] = 'dashboard/testimonials/index';
    $route[$row->shortname . '/add-testimonial'] = 'dashboard/testimonials/add_testimonial';
    $route[$row->shortname . '/testimonial-save'] = 'dashboard/testimonials/testimonial_save';
    $route[$row->shortname . '/get-testimonial'] = 'dashboard/testimonials/get_testimonial';
    $route[$row->shortname . '/edit-testimonial/(:any)'] = 'dashboard/testimonials/edit_testimonial/$1';
    $route[$row->shortname . '/testimonial-update'] = 'dashboard/testimonials/testimonial_update';
    $route[$row->shortname . '/testimonials-delete'] = 'dashboard/testimonials/testimonials_delete';
    $route[$row->shortname . '/testimonial-inactive'] = 'dashboard/testimonials/testimonial_inactive';
    $route[$row->shortname . '/testimonial-active'] = 'dashboard/testimonials/testimonial_active';

    //add-ons 
    $route[$row->shortname . '/add-ons'] = 'dashboard/module/module_list';
    $route[$row->shortname . '/purchase-addons'] = 'dashboard/module/purchase_addons';
    $route[$row->shortname . '/verify-purchase-request'] = 'dashboard/module/verify_purchase_request';

    //  today create routes
    $route[$row->shortname . '/restore'] = "dashboard/backup_restore/restore_form";
    $route[$row->shortname . '/db_import'] = "dashboard/backup_restore/import_form";
    $route[$row->shortname . '/backup'] = "dashboard/backup_restore/download_backup";

    //============= its for forum module ==============
    $route[$row->shortname . '/forum-category'] = 'dashboard/Forumcontroller/forum_category';
    $route[$row->shortname . '/forum-category/(:any)'] = 'dashboard/Forumcontroller/forum_category/$1';
    $route[$row->shortname . '/forum-category-save'] = 'dashboard/Forumcontroller/forum_category_save';
    $route[$row->shortname . '/forumcategory-edit'] = 'dashboard/Forumcontroller/forumcategory_edit';
    $route[$row->shortname . '/forumcategory-update'] = 'dashboard/Forumcontroller/forumcategory_update';
    $route[$row->shortname . '/forum-category-delete'] = 'dashboard/Forumcontroller/forum_category_delete';
    $route[$row->shortname . '/add-forum'] = 'dashboard/Forumcontroller/add_forum';
    $route[$row->shortname . '/forum-save'] = 'dashboard/Forumcontroller/forum_save';
    $route[$row->shortname . '/forum-list'] = 'dashboard/Forumcontroller/forum_list';
    $route[$row->shortname . '/forum-list/(:any)'] = 'dashboard/Forumcontroller/forum_list/$1';
    $route[$row->shortname . '/forum-active'] = 'dashboard/Forumcontroller/forum_active/';
    $route[$row->shortname . '/forum-inactive'] = 'dashboard/Forumcontroller/forum_inactive/';
    $route[$row->shortname . '/forum-edit/(:any)'] = 'dashboard/Forumcontroller/forum_edit/$1';
    $route[$row->shortname . '/forum-update'] = 'dashboard/Forumcontroller/forum_update';
    $route[$row->shortname . '/forum-delete/(:any)'] = 'dashboard/Forumcontroller/forum_delete/$1';
    $route[$row->shortname . '/comment-list'] = 'dashboard/Forumcontroller/comment_list';
    $route[$row->shortname . '/comment-active'] = 'dashboard/Forumcontroller/comment_active';
    $route[$row->shortname . '/comment-inactive'] = 'dashboard/Forumcontroller/comment_inactive';
    $route[$row->shortname . '/comment-delete/(:any)'] = 'dashboard/Forumcontroller/comment_delete/$1';
    $route[$row->shortname . '/forum-filter'] = 'dashboard/Forumcontroller/forum_filter';

    // ============ its for communicate module ================
    $route[$row->shortname . '/send-emailform'] = 'dashboard/Communicatecontroller/send_emailform';
    $route[$row->shortname . '/get-loadusers'] = 'dashboard/Communicatecontroller/get_loadusers';
    $route[$row->shortname . '/get-loadbccusers'] = 'dashboard/Communicatecontroller/get_loadbccusers';
    $route[$row->shortname . '/send-email'] = 'dashboard/Communicatecontroller/send_email';
    $route[$row->shortname . '/send-smsform'] = 'dashboard/Communicatecontroller/send_smsform';
    $route[$row->shortname . '/send-sms'] = 'dashboard/Communicatecontroller/send_sms'; 
    $route[$row->shortname . '/email-list'] = 'dashboard/Communicatecontroller/email_list'; 
    $route[$row->shortname . '/get-emaillist'] = 'dashboard/Communicatecontroller/get_emaillist'; 
    $route[$row->shortname . '/sms-list'] = 'dashboard/Communicatecontroller/sms_list'; 
    $route[$row->shortname . '/get-smslist'] = 'dashboard/Communicatecontroller/get_smslist';
    $route[$row->shortname . '/notice-board'] = 'dashboard/Communicatecontroller/notice_board';  

    // ============= its for reports module ==================
    $route[$row->shortname . '/watchtime-list'] = 'dashboard/Reportcontroller/watchtime_list';
    $route[$row->shortname . '/watchtime-reportdata'] = 'dashboard/Reportcontroller/watchtime_reportdata';
    $route[$row->shortname . '/payment-disbursement'] = 'dashboard/Reportcontroller/payment_disbursement';
    $route[$row->shortname . '/paymentdisbursement-datalist'] = 'dashboard/Reportcontroller/paymentdisbursement_datalist';
    $route[$row->shortname . '/withdraw-request-status'] = 'dashboard/Reportcontroller/withdraw_request_status';
    $route[$row->shortname . '/withdraw-remarks-submit'] = 'dashboard/Reportcontroller/withdraw_remarks_submit';
}

// $route['default_controller'] = 'dashboard/auth/index'; 
$route['default_controller'] = 'frontend/Frontend/index';
$route['dashboard'] = "dashboard/home";
$route['logout'] = "dashboard/auth/logout";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$modules_path = APPPATH . 'modules/';
$modules = scandir($modules_path);

foreach ($modules as $module) {
    if ($module === '.' || $module === '..')
        continue;
    if (is_dir($modules_path) . '/' . $module) {
        $routes_path = $modules_path . $module . '/config/routes.php';
        if (file_exists($routes_path)) {
            require($routes_path);
        } else {
            continue;
        }
    }
}    