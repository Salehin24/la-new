
<div class="pt-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">

                    <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-course-add'); ?>"
                        class="btn btn-dark-cerulean me-2">Create New Course</a>
                    <!-- <button class="btn btn-dark-cerulean">Assignment Project Review (34)</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="counter-content py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 g-2 g-xl-3">
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="h5 mb-0">Total Course</span>
                            <span class="fw-semi-bold h2 mb-0"><span
                                    class="counter d-inline-block"><?php echo $total_course;?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="h5 mb-0">Active Course</span>
                            <span class="fw-semi-bold h2 mb-0 text-success"><span
                                    class="counter d-inline-block"><?php echo $active_course?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="h5 mb-0">Pending Course</span>
                            <span class="fw-semi-bold h2 mb-0 text-warning"><span
                                    class="counter d-inline-block"><?php echo $pending_course?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="h5 mb-0">Draft Course</span>
                            <span class="fw-semi-bold h2 mb-0 text-info"><span
                                    class="counter d-inline-block"><?php echo $draf_course?></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Counter-->

<div class="py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4 mb-3 mb-xl-0 table-responsive">
                        <div class="mb-3">
                            <h4 class="mb-3">Course List</h4>
                        </div>
                        <table class="table align-middle datatablenn table-bordered">
                            <thead class="">
                                <tr class="">
                                    <th width="20%" scope="col">Courses</th>
                                    <th width="10%" scope="col">Categories</th>
                                    <th width="15%" scope="col">Chapters &amp; Lessons</th>
                                    <th width="15%" scope="col">Sale Type</th>
                                    <th width="10%" scope="col">Agreement</th>
                                    <!-- <th width="10%" scope="col">Submit Agreement</th> -->
                                    <th width="10%" scope="col">Created</th>
                                    <th width="10%" scope="col">Updated</th>
                                    <th width="20%" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
									if($course_list){
                                        $sl=0;
										foreach($course_list as $courses){
                                            $sl++;
										?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo base_url($courses['picture'])?>" class="me-2 rounded"
                                                alt="" height="90px" width="30%">
                                            <div class="d-block">
                                                <a class="text-dark"
                                                    href="<?php echo base_url($enterprise_shortname.'/course-details/'.$courses['course_id']); ?>"><?php echo $courses['name']; ?></a>
                                                <div class="d-flex">
                                                    <div class="me-2"><i class="far fa-clock me-1"></i><?php 
														echo date("H:i:s", strtotime(!empty($courses['total_duration']) ? $courses['total_duration'] : ''));
													?></div>
                                                    <div><i
                                                            class="me-1 fas fa-signal"></i><?php echo ($courses['course_level'] == 1?'Beginner':'').($courses['course_level'] == 2?'Intermediate':'').($courses['course_level'] == 3?'Advanced':'')?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $courses['category_name']?></td>
                                    <td>
                                        <div>Total Chapters: <?php echo $courses['total_chapter']?></div>
                                        <div>Total Lessons: <?php echo $courses['total_lession']?></div>
                                    </td>
                                    <td>
                                        <?php 
                                        $types = $courses['course_type'];
										// $coursetypes = substr($types, 1, -1);
                                        // $typesarray = array();
										// if($coursetypes){
										// 	$typesarray = explode(',' , $coursetypes);
										// }
										// for($i =0;$i < count($typesarray);$i++){
										// 	$typedata = substr($typesarray[$i], 1, -1);
										// 	echo ($typedata==1?'Purchase ,':'').($typedata==2?'Subscription ,':'').($typedata==3?'Free ,':'').($typedata==4?'Govt':'');
										// }
                                        $types_decode = json_decode($types);
                                        if($types_decode){
                                            // foreach($types_decode as $type){
                                                if(in_array("1", $types_decode)){
                                                    echo "Purchase<br>";
                                                }
                                                if(in_array("2", $types_decode)){
                                                    echo "Subscription<br>";
                                                }
                                                if(in_array("3", $types_decode)){
                                                    echo "Free<br>";
                                                }
                                                if(in_array("4", $types_decode)){
                                                    echo "Govt<br>";
                                                }
                                            // }
                                        }
									?>
                                    </td>
                                    <td>
                                        <?php if($courses['submit_agreement']){ ?>
                                        <a href="<?php echo base_url($courses['submit_agreement']); ?>"
                                            class="text-center" download data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Download Agreement">
                                            <i class="fas fa-cloud-download-alt"></i>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <?php 
                                        if($courses['docusign']){
                                        if(empty($courses['submit_agreement'])){ ?>
                                        <input type='file' name="submit_agreement" id="submit_agreement"
                                            onchange="submiteAgreementpaper('submit_agreement', '<?php echo $courses['course_id']?>')">
                                        <div class="progress-area_<?php echo $courses['course_id']; ?> mt-2"></div>
                                        <div id="uploadStatus_" <?php echo $courses['course_id']; ?>></div>
                                        <?php }else{ ?>
                                        <a href="<?php echo base_url($courses['submit_agreement']); ?>"
                                            class="text-center" download data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Show Agreement">
                                            <i class="fas fa-cloud-download-alt"></i>
                                        </a>
                                        <?php } 
                                        }
                                        ?>
                                    </td> -->
                                    <td>
                                        <div>
                                            <?php echo date("d-m-Y", (!empty($courses['created_date']) ? strtotime($courses['created_date']) : '')); ?>
                                        </div>
                                        <div>
                                            <?php echo date("h:i: a", strtotime(!empty($courses['created_date']) ? $courses['created_date'] : '')); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?php echo date("d-m-Y", (!empty($courses['updated_date']) ? strtotime($courses['updated_date']) : '')); ?>
                                        </div>
                                        <div>
                                            <?php echo date("h:i: a", strtotime(!empty($courses['updated_date']) ? $courses['updated_date'] : '')); ?>
                                        </div>
                                        <div>
                                            <?php echo $courses['updatedby']; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($courses['is_draft'] == 1){?>
                                            <!-- <button class="custom-btn w-100"
                                                style="background-color:#29b9f8;border:1px solid #29b9f8;color:#fff">Draft
                                            </button> -->
                                            <?php }else{?>
                                            <?php if($courses['status'] == 1){?>
                                            <span class="custom-btn w-100 me-2"
                                                style="background-color:#1acb97;border:1px solid #1acb97;color:#fff">Active</span>
                                            <?php }elseif($courses['status'] == 2){?>
                                            <button class="custom-btn  w-100"
                                                style="background-color:#feaa46;border:1px solid #feaa46;">Pending
                                            </button>
                                            <?php }elseif($courses['status'] == 4){?>
                                            <!-- <button class="custom-btn w-100"
                                                style="background-color:#e43b38;border:1px solid #e43b38;color:#fff;">Cancelled</button> -->
                                            <?php }?>
                                            <?php }?>

                                            <?php
                                             if($courses['status'] != 1){ 
                                                 ?>
                                            <div class="dropdown dropdown-user dropdown-edit">
                                                <?php if($courses['status'] == 4 || $courses['is_draft'] == 1){ ?>
                                                <button class="dropdown-toggle btn p-2" id="user9"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <?php if($courses['is_draft'] == 1){?>
                                                        <span class="custom-btn me-1"
                                                            style="background-color:#29b9f8;border:1px solid #29b9f8;color:#fff;">Draft
                                                         </span>
                                                    <?php }elseif($courses['status'] == 4){?>
                                                        <span class="custom-btn me-1"
                                                        style="background-color:#e43b38;border:1px solid #e43b38;color:#fff;">Cancelled</span>    
                                                    <?php }?>
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <?php } ?>
                                                <?php //if(($courses['status'] != 2) && ($courses['is_draft'] != 0)){  ?>
                                                <div class="dropdown-menu dropdown-menu-right sm-menu animate slideIn p-3"
                                                    aria-labelledby="user">
                                                    <div class="user-holder">
                                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-course-edit/'.$courses['course_id']); ?>"
                                                            class="dropdown-item"><i class="far fa-edit"></i>
                                                            Edit</a>
                                                        <?php if($courses['status'] == 4){ ?>
                                                        <a href="javascript:void(0)" class="dropdown-item"
                                                            data-bs-placement="top" data-bs-toggle="modal"
                                                            data-bs-target="#feedbackModal-<?php echo $sl; ?>"
                                                            data-bs-backdrop="false" title="Feedback"><i
                                                                class="fas fa-list"></i>
                                                            Feedback</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php //} ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="feedbackModal-<?php echo $sl; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Course Feedback
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo (!empty($courses['feedback']) ? $courses['feedback'] : ''); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                }
                            }
                            ?>
                            </tbody>
                        </table>


                        <!-- <nav class="mt-4">
								<ul class="pagination justify-content-center">
									<li class="page-item disabled">
										<span class="page-link">Previous</span>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item active" aria-current="page">
										<span class="page-link">2</span>
									</li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#">Next</a>
									</li>
								</ul>
							</nav> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Start Popular Course-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-md-4">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4>Assignment Project (Review)</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="viewe-carousel owl-carousel owl-theme">
                    <!--Start Course Card-->
                    <?php
                     foreach($course_list as $course){
                          $reviewpending_projectcount = $this->Instructor_model->reviewpending_projectcount($course['course_id']);
                        //   d($reviewpending_projectcount);
                          if($reviewpending_projectcount !=0){
                         ?>
                    <div class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border">
                        <div class="position-relative course-card_top">
                            <div class="position-relative">
                                <!--Start Course Image-->
                                <a href="javascript:void(0)" class="course-card_img"
                                    onclick="courseload_withprojectsummary('<?php echo $course['course_id']; ?>')">
                                    <img src="<?php echo base_url(!empty($course['picture']) ? $course['picture'] : default_600_400()); ?>"
                                        class="img-fluid w-100" alt="">
                                </a>
                                <!--End Course Image-->
                                <!--Start items badge-->
                                <div
                                    class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100">
                                    <span class="badge bg-success me-1">New</span>
                                    <span
                                        class="badge bg-primary"><?php echo (!empty($course['category_name']) ? $course['category_name'] : ''); ?></span>
                                </div>
                                <!--End items badge-->
                            </div>
                            <!--Start Course Card Body-->
                            <div class="course-card_body bg-prussian-blue text-white p-3 position-relative">
                                <!--Start Course Title-->
                                <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                    <a href="javascript:void(0)" class="text-white text-decoration-none"
                                        onclick="courseload_withprojectsummary('<?php echo $course['course_id']; ?>')">
                                        <?php echo (!empty($course['name']) ? $course['name'] : ''); ?>
                                    </a>
                                </h3>
                                <!--End Course Title-->
                            </div>
                            <!--End Course Card Body-->
                        </div>
                        <div class="course-card_footer g-2 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1 me-1">
                                    <div>Review Pending</div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="custom-btn w-100"><?php echo $reviewpending_projectcount; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } }?>
                    <!--End Course Card-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Popular Course-->

<div id="loadcoursewithprojectsummary"></div>

<div class="py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4 mb-3 mb-xl-0 table-responsive">
                        <div class="mb-3">
                            <?php 
								$count_reviewproject = count($get_reviewproject);
								?>
                            <h4 class="mb-3">Projects/Assignment (<?php echo $count_reviewproject; ?>)</h4>
                        </div>
                        <table class="table align-middle table-bordered">
                            <thead class="">
                                <tr class="">
                                    <th scope="col">Projects/Assignment</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
								// d($get_reviewproject);
								if($get_reviewproject){
									foreach($get_reviewproject as $review){ ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo base_url(!empty($review->coverpic) ? $review->coverpic : default_600_400()); ?>"
                                                class="me-2 rounded" alt="" height="90px">
                                            <div class="d-block">
                                                <a class="text-dark"
                                                    href="<?php echo base_url($enterprise_shortname.'/instructor-project-view/'.$review->project_id); ?>"><?php echo (!empty($review->title) ? $review->title : ''); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($review->chapter_source){ ?>
                                        <div>Chapters: <?php echo $review->chapter_source; ?></div>
                                        <?php } ?>
                                        <?php if($review->lesson_source){ ?>
                                        <div>Lessons: <?php echo $review->lesson_source; ?></div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($review->project_status == 0){ ?>
                                        <span class="custom-btn">Project in Review</span>
                                        <?php }elseif($review->project_status == 1){ ?>
                                        <span class="custom-btn">Project approved</span>
                                        <?php }elseif($review->project_status == 2){ ?>
                                        <span class="custom-btn">Project not approved</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($review->project_status == 1){ ?>
                                        <span class="border-1 p-2 rounded-1"
                                            style="background-color:#198754;color:#fff;">Reviewed</span>
                                        <?php }elseif($review->project_status == 2){?>
                                        <span class="border-1 p-2 rounded-1"
                                            style="background-color: red;color:#fff;">Reviewed</span>
                                        <?php }else{ ?>
                                        <a href="<?php echo base_url($enterprise_shortname.'/instructor-project-review/'.$review->project_id); ?>"
                                            class="btn btn-info" style="color:#fff;">Review</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php }
                            }else{ ?>
                                <tr>
                                    <th colspan="5" class="text-center text-danger">Record not found!</th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">2</span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var CSRF_TOKEN = $('#CSRF_TOKEN').val();
var enterprise_id = $("#enterprise_id").val();

$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

});

function courseload_withprojectsummary(course_id) {

    $.ajax({
        url: base_url + enterprise_shortname + "/courseload-withprojectsummary",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            course_id: course_id,
            enterprise_id: enterprise_id,
        },
        success: function(r) {
            $("#loadcoursewithprojectsummary").html(r);
        },
    });
}

// // =============== its for  file type check ===============
// function filetypecheck(fileid) {
//     var allowedTypes = [
//         "application/pdf",
//         "application/msword",
//         "application/vnd.ms-office",
//         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
//         "image/jpeg",
//         "image/png",
//         "image/jpg",
//         "image/gif",
//     ];

//     // var file = this.files[0];
//     var file = $("#" + fileid)[0].files[0];
//     var fileType = file.type;
//     if (!allowedTypes.includes(fileType)) {
//         alert("Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).");
//         $("#" + fileid).val("");
//         return false;
//     }
// }

// function submiteAgreementpaper(fileid, course_id) {
//     filetypecheck(fileid);
//     var fd = new FormData();

//     fd.append("submit_agreement", $("#submit_agreement")[0].files[0]);

//     fd.append("course_id", course_id);
//     //   fd.append("old_docusign", $("#old_docusign").val());
//     fd.append("csrf_test_name", CSRF_TOKEN);

//     $.ajax({
//         type: "POST",
//         url: base_url + enterprise_shortname + "/course-agreement-submit",
//         // data: new FormData(this),
//         data: fd,
//         contentType: false,
//         cache: false,
//         processData: false,

//         error: function() {
//             $("#uploadStatus_" + course_id).html(
//                 '<p style="color:#EA4335;">File upload failed, please try again.</p>'
//             );
//         },
//         success: function(resp) {
//             console.log(resp);
//             if (resp == "ok") {
//                 $("#uploadStatus_" + course_id).html(
//                     '<p style="color:#28A74B;">File has uploaded successfully!</p>'
//                 );
//                 $(".progress-area_" + course_id).html(
//                     '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
//                 );
//             } else if (resp == "err") {
//                 $(".progress-area_" + course_id).html("");
//                 $("#uploadStatus_" + course_id).html(
//                     '<p style="color:#EA4335;">Please select a valid file to upload.</p>'
//                 );
//             }
//         },
//     });
// }
</script>