"use strict"; // Start of use strict
function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if ($(window).scrollTop() !== scroll_to) {
        $('html, body').stop().animate({scrollTop: scroll_to}, 0);
    }
}

function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if (direction === 'right') {
        new_value = now_value + (100 / number_of_steps);
    } else if (direction === 'left') {
        new_value = now_value - (100 / number_of_steps);
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

jQuery(document).ready(function () {

    // Form

    $('.f1 fieldset:first').fadeIn('slow');

    // $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function () {
    //     $(this).removeClass('input-error');
    // });

    // next step
    $('.f1 .f1-buttons .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // fields validation
        parent_fieldset.find('input[type="checkbox"]#flexCheckDefault').each(function () {
            if ($(this).val() === "") {
                $(this).addClass('input-error');
                toastr["error"]('Please Check Terms and Conditions');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });
        // fields validation

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar
                bar_progress(progress_line, 'right');
            var csrf_test_name   = $('[name="csrf_test_name"]').val();  
            var url              = $("#base_urlrm").val();
            var terms            = $("#flexCheckDefault").val();
            var sale_benefits    = $("#flexSwitchCheckDefault").val();
            var subcrib_benefits = $("#flexSwitchCheckDefault2").val();
            var course_id        = $("#course_id").val();
            $.ajax({
                    url: url + "/instructor-course-termscondition",
                    type: "POST",
                    data: {course_id:course_id,terms :terms,sale_benefits:sale_benefits,subscribe_benfits:subcrib_benefits,csrf_test_name: csrf_test_name},
                    success: function(data) {
                     $("#course_id").val(data);
                    },
                    error: function(xhr) {
                        alert('failed!');
                    }
                });
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });

    // next step
    $('.f1  .f2-buttons .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line  = $(this).parents('.f1').find('.f1-progress-line');
        // fields validation
      // parent_fieldset.find('textarea#aboutCourse,input[type="text"] #courseTitle,select#courseCatagory,select#course_level').each(function () {
      
      
      var edit_type =$('#edit_type').val();
        if(edit_type){
            parent_fieldset.find('#old_hover_thum,#old_minithum,#old_thumbnail,#course_level,#courseCatagory,#courseTitle').each(function () {
                if ($(this).val() === "") {
                    console.log(this);
                    // $(this).addClass('input-error');
                    $(this).addClass('input-error');
                    next_step = false;
                    $(this).focus();
                } else {
                    $(this).removeClass('input-error');
                }
            });
           }else{
                parent_fieldset.find('#imgupload,#imgupload2,#formFile2,#course_level,#courseCatagory,#courseTitle').each(function () {
                    if ($(this).val() === "") {
                        console.log(this);
                        // $(this).addClass('input-error');
                        $(this).addClass('input-error');
                        next_step = false;
                        $(this).focus();
                    } else {
                        $(this).removeClass('input-error');
                    }
                }); 
           }


        // fields validation

    if (next_step) {
    parent_fieldset.fadeOut(400, function () {
    var p_grade=$("#passing_grade").val();
    // change icons
    current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar
    var csrf_test_name = $('[name="csrf_test_name"]').val();  
    var frm = $("#save_course");
    var url = $("#base_urlrm").val();
  
    var fd = new FormData();
    // fd.append("video_trailer", $("#formFile")[0].files[0]);    
    fd.append("url", $("#url").val());
    fd.append("passing_grade", $("#passing_grade").val());
    fd.append("thumbnail", $("#formFile2")[0].files[0]);
    fd.append("mini_thumbnail", $("#imgupload")[0].files[0]);
    fd.append("thumbnail_hover", $("#imgupload2")[0].files[0]);
    fd.append("old_video", $('[name="old_video"]').val());
    fd.append("old_thumbnail", $('[name="old_thumbnail"]').val());
    fd.append("old_minithum", $('[name="old_minithum"]').val());
    fd.append("old_hover_thum", $('[name="old_hover_thum"]').val());
    fd.append("courseTitle", $('[name="courseTitle"]').val());
    fd.append("course_id", $("#course_id").val());
    fd.append("faculty_id", $('[name="faculty_id"]').val());

     var bnefits = $('input[name="benifits[]"]');
        for (var i = 0; i <bnefits.length; i++) {
        var benefit=bnefits[i];
            fd.append("benifits[]", benefit.value);  
        }

    var requiremts = $('input[name="requirements[]"]');
        for (var i = 0; i <requiremts.length; i++) {
        var requirement=requiremts[i];
            fd.append("requirements[]", requirement.value);  
        }

      var rlresources = $('input[name="relatedResources[]"]');
        for (var i = 0; i <rlresources.length; i++) {
        var relatedresources=rlresources[i];
            fd.append("relatedResources[]", relatedresources.value);  
        } 

     var studenoutcomes = $('input[name="skillsGainByStudent[]"]');
        for (var i = 0; i <studenoutcomes.length; i++) {
        var courseoutcomes=studenoutcomes[i];
            fd.append("skillsGainByStudent[]", courseoutcomes.value);  
        }


     var gainskill = $('input[name="skillsgain[]"]');
        for (var i = 0; i <gainskill.length; i++) {
        var gainskills=gainskill[i];
            fd.append("skillsgain[]", gainskills.value);  
        } 

    fd.append("courseContents", $('[name="courseContents"]').val());
    fd.append("aboutCourse", $('[name="aboutCourse"]').val());
    fd.append("course_isfor", $('[name="course_isfor"]').val());
    fd.append("courseResult", $('[name="courseResult"]').val());
    fd.append("courseCatagory", $('[name="courseCatagory"]').val());
    fd.append("category_id", $('[name="category_id"]').val());
    fd.append("related_course[]", $('[name="related_course[]"]').val());
    fd.append("course_level", $('[name="course_level"]').val());
    fd.append("language", $('[name="language"]').val());
    // fd.append("skillsGainByStudent", $('[name="skillsGainByStudent"]').val());
    // fd.append("relatedResources", $('[name="relatedResources"]').val());
    //fd.append("relatedResources[]", $('[name="relatedResources[]"]').val());
    fd.append("csrf_test_name", csrf_test_name);    
        $.ajax({
            url: url + "/instructor-course-save",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(data) {
            
                $("#course_id").val(data);
            // console.log(data);
             return false;
            },
            error: function(xhr) {
                alert('failed!');
            }
        });
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });


     $('.f1  .f3-buttons .btn-next').on('click', function () {
       
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // fields validation
        // parent_fieldset.find('input[type="text"], input[type="password"], input[type="file"], textarea').each(function () {
        //     if ($(this).val() === "") {
        //         $(this).addClass('input-error');
        //         next_step = false;
        //     } else {
        //         $(this).removeClass('input-error');
        //     }
        // });
        // fields validation

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar

   
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });

      $('.f1  .f4-buttons .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // fields validation
        // parent_fieldset.find('input[type="text"], input[type="password"], input[type="file"], textarea').each(function () {
        //     if ($(this).val() === "") {
        //         $(this).addClass('input-error');
        //         next_step = false;
        //     } else {
        //         $(this).removeClass('input-error');
        //     }
        // });
        // fields validation

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });

       $('.f1  .f5-buttons .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // fields validation
         var course_type = $('input[name="course_types[]"]');
         var df_val = 0;
         for (var i = 0; i <course_type.length; i++) {
        var types=course_type[i];
            var df_val = df_val + (types.value?parseInt(types.value):0); 
        }
      
         if(df_val == 0){
           $('input[name="course_types[]"]').addClass('input-error'); 
           toastr["error"]('Please Select Course Type');
            next_step = false; 
         }else{
         $('input[name="course_types[]"]').removeClass('input-error');    
         }

         var purchase_pricing = $("#purchasePricing").val();
         if(purchase_pricing != ''){
         var course_price = $("#course_price").val();
         if(course_price == ''){
           $("#course_price").addClass('input-error');
           next_step = false;
           $(this).focus();
         }else{
         $("#course_price").removeClass('input-error');
         }
       }
       var is_offer = $("#is_offer").val();
       var offer_courses = $("#offer_course").val();
       var offer_price   = $("#offer_price").val();

       if(is_offer == 1){

        if(offer_courses ==''){
           toastr["error"]('Please Select Offer Course');
           next_step = false;
        }

         if(offer_price == ''){
          $("#offer_price").addClass('input-error');
           next_step = false;  
         }else{
           $("#offer_price").removeClass('input-error'); 
         }
       }
        // parent_fieldset.find('input[type="text"], input[type="password"], input[type="file"], textarea').each(function () {
        //     if ($(this).val() === "") {
        //         $(this).addClass('input-error');
        //         next_step = false;
        //     } else {
        //         $(this).removeClass('input-error');
        //     }
        // });
        // fields validation

    if (next_step) {
     parent_fieldset.fadeOut(400, function () {
     var disam = $('[name="course_discount"]').val();
     if(disam != ''){
      var dis_type = $('[name="discount_type"]').val();
     }else{
      var dis_type = '';
     }
     var csrf_test_name = $('[name="csrf_test_name"]').val();  
    var frm = $("#save_course");
    var url = $("#base_urlrm").val();
    var prfd = new FormData();
    prfd.append("course_id", $('[name="course_id"]').val());
    prfd.append("course_price", $('[name="course_price"]').val());
    var ctype = $('input[name="course_types[]"]');
    for (var i = 0; i <ctype.length; i++) {
    var type=ctype[i];
   
    if(type.value !=''){
        prfd.append("course_types[]", type.value);
    }
  
     
    }
       

    prfd.append("offer_course", $('#offer_course').val()); 
    prfd.append("course_old_price", $('[name="course_old_price"]').val());
    prfd.append("course_discount", $('[name="course_discount"]').val());
    prfd.append("is_offer", $('[name="is_offer"]').val());
    prfd.append("offer_price", $('[name="offer_price"]').val());
    prfd.append("discount_type", dis_type);
    prfd.append("csrf_test_name", csrf_test_name);    
        $.ajax({
            url: url + "/instructor-course-price-save",
            type: "POST",
            data: prfd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(data) {
             console.log(data);
            },
            error: function(xhr) {
                alert('failed!');
            }
        });
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar

   
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });

        $('.f1  .f6-buttons .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // fields validation
        parent_fieldset.find('input[type="text"], input[type="password"], input[type="file"], textarea').each(function () {
            if ($(this).val() === "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });
        // fields validation

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active').removeClass('activated');
                // progress bar

   
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }

    });

    // previous step
    $('.f1 .btn-previous').on('click', function () {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');
   
        $(this).parents('fieldset').fadeOut(400, function () {
            // change icons
            current_active_step.removeClass('active').addClass('activated').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class($('.f1'), 20);
        });
    });

// clicking on previous activated buton on top
$('.f1-step').on('click', function () {
		
    
    var findActive = $(".f1-steps" ).find(".active").attr("class");		
    var posArr = findActive.split(' ');
    let result = posArr[1].substring(4);
    
    var current_class= $(this).attr('class');
    var nameArr = current_class.split(' ');
    let result2 = nameArr[1].substring(4);
    if(nameArr[2]!= "activated"){
     
    }else{
    $('.f1-step').removeClass("active");	
    }
    
    
    if(nameArr[2]== "activated"){
        $("."+nameArr[1]).addClass("active");
        $(".step"+result2).removeClass("activated");
        $(".step"+result).addClass("activated");
        $(".field"+result).css("display","none");
        $(".field"+result2).css("display", "block");	
    }

});

    // submit
    $('.f1 #final_step').on('click', function (e) {
    var url = $("#base_urlrm").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val(); 
    var course_id        = $("#course_id").val();
    //  var welcomeMessage = $("#welcomeMessage").val(); 
    // var congratulationsMessage = $("#congratulationsMessage").val();  
    var fdata = new FormData(); 
     fdata.append("course_id", course_id);
    // fdata.append("docusin", $("#docusing_file")[0].files[0]);
    // fdata.append("welcomeMessage", welcomeMessage);
    // fdata.append("congratulationsMessage", congratulationsMessage);
    // fdata.append("old_docusin", $("#old_docusin").val());
    fdata.append("csrf_test_name", csrf_test_name);    
        $.ajax({
            url: url + "/instructor-course-docusin",
            type: "POST",
            data: fdata,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(data) {
             
            swal({
            title: "Congratulation ! Your course successfully submited",
            text: "",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: '#14AD54',
            confirmButtonText: 'Create new course',
            cancelButtonText: "Close",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm){
            location.replace(url+'/instructor-course-add');

            } else {
            location.replace(url+'/instructor-courses');

            }
        });
        },
            error: function(xhr) {
                alert('failed!');
            }
        });

       

    });


});