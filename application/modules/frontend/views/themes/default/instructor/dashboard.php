	<style>
.zone-agrement-upload.zone.upload label {
    background: transparent;
    color: #212529;
}

.zone-agrement-upload.zone .selectFile {
    height: 36px;
}

.progress {
    height: 15px;
    border-radius: 0.5rem;
}

.progress-bar {
    background-color: #1270ca;
    height: 15px;
    border-radius: 10px;
}
#apexLineChart .apexcharts-menu-icon{
	display:none;
}
	</style>
	<div class="counter-content pt-5 pb-4 bg-alice-blue">
	    <div class="container-lg">
	        <div class="mb-5">
	            <h4 class="fw-bold mb-0">Instructor Overview</h4>
	        </div>
	        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-2 g-xl-3">
	            <div class="col">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
	                    <div class="card-body p-4 text-center">
	                        <h5>Sale Earning</h5>
	                        <h4 class="fw-semi-bold h2 my-2">BDT <span
	                                class="counter d-inline-block"><?php echo number_format($total_earning,2);?></span>
	                        </h4>
	                        <div class="mt-2 mb-1">Earning this month</div>
	                        <button class="btn btn-sm btn-success w-auto">BDT
	                            <?php echo number_format($monthly_sales_earning,2)?></button>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
	                    <div class="card-body p-4 text-center">
	                        <h5>Subscriptions</h5>
	                        <h4 class="fw-semi-bold h2 my-2">BDT <span
	                                class="counter d-inline-block"><?php echo number_format($total_subcription_earning,3);?></span>
	                        </h4>
	                        <div class="mt-2 mb-1">Last day earning</div>
	                        <button class="btn btn-sm btn-success w-auto">BDT
	                            <?php echo number_format($monthly_subc_earning,3)?></button>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
	                    <div class="card-body p-4 text-center align-items-center">
	                        <h5>Students</h5>
	                        <h4 class="fw-semi-bold h2 my-2"><span
	                                class="counter d-inline-block"><?php echo $total_students; ?></span></h4>
	                        <div class="mt-2 mb-1">New this month</div>
	                        <button class="btn btn-warning btn-sm w-50"><?php echo $new_students;?>+</button>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
	                    <div class="card-body p-4 text-center align-items-center">
	                        <h5>Courses Active</h5>
	                        <h4 class="fw-semi-bold h2 my-2"><span
	                                class="counter d-inline-block"><?php echo $total_courses?></span></h4>
	                        <div class="mt-2 mb-1">New this month</div>
	                        <button class="btn btn-warning btn-sm w-50"><?php echo $new_courses?>+</button>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
	                    <div class="card-body p-4 d-flex text-center align-items-start flex-wrap text-center">
	                        <h5 class="w-100">Instructor Rating</h5>
	                        <h4 class="fw-semi-bold h2 my-2 w-100"><i class="fas fa-star me-2"></i><span
	                                class="counter d-inline-block"><?php echo number_format($instructor_rating,2);?></span>
	                        </h4>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!--End Counter-->

	<div class="bg-alice-blue py-3">
	    <div class="container-lg">
	        <div class="row">
	            <div class="col-xl-9 col-md-8 d-flex flex-column">
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0">
	                    <div class="card-body p-4">
	                        <div class='row'>
	                            <div class='col-sm-8'>
									<h6 class="fs-17 font-weight-600 mb-0">Earnings</h6>
								</div>
	                            <div class="col-sm-4  d-flex">
	                                <select class="form-select" id="year_id" onchange="yearmonthinstructorearninggraph()">
	                                    <option value="">Select One</option>
	                                    <option value="2021">2021</option>
	                                    <option value="2022">2022</option>
	                                    <option value="2023">2023</option>
	                                    <option value="2024">2024</option>
	                                </select>
									&nbsp;&nbsp;
	                                <select class="form-select" id="month_id" onchange="yearmonthinstructorearninggraph()">
	                                    <option value="">Select One</option>
	                                    <option value="01">January</option>
	                                    <option value="02">February</option>
	                                    <option value="03">March</option>
	                                    <option value="04">April</option>
	                                    <option value="05">May</option>
	                                    <option value="06">June</option>
	                                    <option value="07">July</option>
	                                    <option value="08">August</option>
	                                    <option value="09">September</option>
	                                    <option value="10">October</option>
	                                    <option value="11">November</option>
	                                    <option value="12">December</option>
	                                </select>
	                            </div>
	                        </div>

	                        <div id="apexLineChart"></div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xl-3 col-md-4">
	                <div class="row">
	                    <div class="col-md-12 col-sm-6">
	                        <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4">
	                            <div
	                                class="card-body p-4 d-flex justify-content-center align-items-start flex-wrap text-center">
	                                <h5 class="w-100">Agreements</h5>
	                                <h4 class="fw-semi-bold h2 my-2 w-100"><span
	                                        class="counter d-inline-block"><?php echo $pending_docusin;?> </span></h4>
	                                <?php if($pending_docusin > 0){ ?>
	                                <button type="button" class="btn btn-outline-dark-cerulean btn-sm d-block"
	                                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-backdrop="false">
	                                    Review Now
	                                </button>
	                                <?php } ?>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	                        aria-hidden="true" data-bs-backdrop="static">
	                        <div class="modal-dialog modal-dialog-centered modal-xl">
	                            <div class="modal-content">
	                                <div class="modal-header">
	                                    <h5 class="modal-title" id="exampleModalLabel">Course Agreement Sign</h5>
	                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
	                                        aria-label="Close"></button>
	                                </div>
	                                <div class="modal-body">
	                                    <table class="table align-middle table-bordered agreement-signdatatables">
	                                        <thead class="">
	                                            <tr class="">
	                                                <th scope="col">Courses</th>
	                                                <th scope="col" class="text-center">Download</th>
	                                                <th scope="col" class="text-center">Upload</th>
	                                                <th scope="col" class="text-center">Status</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody>
	                                            <?php if($get_pendingagreements){
													// d($get_pendingagreements);
													$s=0;
													foreach($get_pendingagreements as $agreement){
														$s++;
													?>
	                                            <tr>
	                                                <th scope="row">
	                                                    <div class="d-flex align-items-center">
	                                                        <img src="<?php echo base_url(!empty($agreement->picture) ? $agreement->picture : 'application/modules/frontend/views/themes/default/assets/img/offer/01.jpg'); ?>"
	                                                            class="me-2 rounded" alt="" width='40%'>
	                                                        <span><?php echo (!empty($agreement->name) ? $agreement->name : ''); ?></span>
	                                                    </div>
	                                                </th>
	                                                <td class="text-center">
	                                                    Course Agreement <a
	                                                        href="<?php echo base_url($agreement->docusign); ?>"
	                                                        download><svg viewBox="0 0 24 24" width="24" height="24"
	                                                            stroke="currentColor" stroke-width="2" fill="none"
	                                                            stroke-linecap="round" stroke-linejoin="round"
	                                                            class="css-i6dzq1">
	                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
	                                                            </path>
	                                                            <polyline points="7 10 12 15 17 10"></polyline>
	                                                            <line x1="12" y1="15" x2="12" y2="3"></line>
	                                                        </svg> </a>
	                                                </td>
	                                                <td class="text-center">
	                                                    <div
	                                                        class="zone upload zone-agrement-upload text-center d-inline-block">
	                                                        <div id="dropZ2">
	                                                            <?php if($agreement->agreement_status != 3){ ?>
	                                                            <div class="selectFile">
	                                                                <label for="signedagreement">Signed Agreement <svg
	                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
	                                                                        height="24" viewBox="0 0 24 24" fill="none"
	                                                                        stroke="currentColor" stroke-width="2"
	                                                                        stroke-linecap="round" stroke-linejoin="round"
	                                                                        class="feather feather-upload me-2">
	                                                                        <path
	                                                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
	                                                                        </path>
	                                                                        <polyline points="17 8 12 3 7 8"></polyline>
	                                                                        <line x1="12" y1="3" x2="12" y2="15"> </line>
	                                                                    </svg> </label>
	                                                                <input type="file" name="files" id="signedagreement"
	                                                                    name="signedagreement[]"
	                                                                    onchange="signedagreementupload('<?php echo $s; ?>', '<?php echo $agreement->course_id; ?>')">
	                                                            </div>
	                                                            <?php } ?>
	                                                        </div>
	                                                    </div>

	                                                    <div class="col-md-12">
	                                                        <?php if($agreement->submit_agreement){ ?>
	                                                        <div class="mx-auto" id="progress_<?php echo $s; ?>"
	                                                            style="display: block">
	                                                            <div class="progress-bar"
	                                                                id="progress-bar_<?php echo $s; ?>" width="100%"
	                                                                style="width: 100%;">100%</div>
	                                                        </div>
	                                                        <div class="mx-auto" id="uploadStatus_<?php echo $s; ?>">
	                                                            <p class="mb-0" style="color:#28A74B;">File has uploaded
	                                                                successfully!</p>
	                                                        </div>
	                                                        <?php }else{ ?>
	                                                        <div class="progress mx-auto" id="progress_<?php echo $s; ?>">
	                                                            <div class="progress-bar"
	                                                                id="progress-bar_<?php echo $s; ?>"></div>
	                                                        </div>
	                                                        <div class="mx-auto" id="uploadStatus_<?php echo $s; ?>"></div>
	                                                        <?php } ?>
	                                                    </div>

	                                                </td>
	                                                <td class='text-center'>
	                                                    <?php if($agreement->agreement_status == 1){ ?>
	                                                    <span class="custom-btn p-1 w-100"
	                                                        style="background-color:#feaa46;border:1px solid #feaa46; color:white; ">Pending
	                                                        <?php //echo $agreement->agreement_status; ?></span>
	                                                    <?php }elseif($agreement->agreement_status == 3){ ?>
	                                                    <span class="custom-btn p-1 w-100"
	                                                        style="background-color:#17a2b8;border:1px solid #17a2b8; color:white; ">Submited
	                                                        <?php //echo $agreement->agreement_status; ?></span>
	                                                    <?php }elseif($agreement->agreement_status == 4){ ?>
	                                                    <p><?php echo (!empty($agreement->agreement_reason) ? $agreement->agreement_reason : ''); ?>
	                                                    </p>
	                                                    <span class="custom-btn p-1 w-100" data-bs-toggle="tooltip"
	                                                        data-bs-placement="top"
	                                                        title="<?php echo (!empty($agreement->agreement_reason) ? $agreement->agreement_reason : ''); ?>"
	                                                        style="background-color:red;border:1px solid red; color:white; ">Rejected
	                                                        <?php //echo $agreement->agreement_status; ?></span>
	                                                    <?php } ?>
	                                                </td>
	                                            </tr>
	                                            <?php }
												} ?>
	                                            <!-- <tr>
	                                                <th scope="row">
	                                                    <div class="d-flex align-items-center">
	                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/offer/02.jpg'); ?>" class="me-2 rounded" alt="">
	                                                        <span>Php Mysql with database</span>
	                                                    </div>
	                                                </th>
	                                                <td class="text-center">Course Agreement <i
	                                                        class="fad fa-arrow-to-bottom fa-fw"></i></td>
	                                                <td class="text-center">Signed Agreement</td>
	                                                <td>
	                                                    <button class="btn btn-warning w-100">Pending</button>
	                                                </td>
	                                            </tr> -->
	                                        </tbody>
	                                    </table>
	                                </div>
	                                <div class="modal-footer">
	                                    <!-- <button type="button" class="btn btn-secondary"
	                                        data-bs-dismiss="modal">Close</button>
	                                    <button type="button" class="btn btn-primary">Save changes</button> -->
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="col-md-12 col-sm-6">
	                        <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4">
	                            <div
	                                class="card-body p-4 d-flex justify-content-center align-items-start flex-wrap text-center">
	                                <h5 class="w-100">Student Projects Review Pending</h5>
	                                <h4 class="fw-semi-bold h2 my-2 w-100"><span
	                                        class="counter d-inline-block"><?php echo $project_pending?></span></h4>
	                                <a class="btn btn-outline-dark-cerulean btn-sm d-block my-1"
	                                    href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-courses'); ?>">Review
	                                    Now <i data-feather="arrow-right"></i></a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="bg-alice-blue py-3">
	    <div class="container-lg">
	        <div class="row">
	            <div class="col-xxl-4 col-md-6 d-flex flex-column">
	                <!--Start Section Header-->
	                <div class="section-header mb-4">
	                    <h5>Sticky Note</h5>
	                    <div class="section-header_divider"></div>
	                </div>
	                <!--End Section Header-->
	                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xxl-0">
	                    <div class="card-body p-4">
	                        <div class="align-items-center d-flex justify-content-between mb-2">
	                            <button class="btn btn-transparent px-0" data-bs-toggle="modal"
	                                data-bs-target="#NoteModal"><i data-feather="plus-circle" class="me-1"></i>Create New
	                                Note</button>
	                        </div>
	                        <div class="note-carousel owl-carousel owl-theme" id="instructor_notes">


	                            <?php   
							 if($sticky_notes){                          
                                $n=0;
                                foreach($sticky_notes as $sticky){ 
                                    $n++;
                                    ?>
	                            <div class="note_item">
	                                <div class="p-4 bg-light-yellow rounded">
	                                    <div class="d-flex position-absolute btn-act">
	                                        <button class="btn bg-transparent px-0 me-1" title="Delete"
	                                            data-toggle="tooltip" data-placement="top"
	                                            onclick="deleteinstructorStickynote('<?php echo $sticky->id; ?>')">
	                                            <i data-feather="trash-2"></i>
	                                        </button>
	                                        <button class="btn bg-transparent p-0" title="Save" data-toggle="tooltip"
	                                            data-placement="top"
	                                            onclick="updateStickynote_instructor('<?php echo $sticky->id; ?>','<?php echo $n; ?>')">
	                                            <!-- <i data-feather="check-square"></i> -->
	                                            <i class="fas fa-save" style="font-size: 19px;line-height: 35px;"></i>
	                                        </button>

	                                        </button>
	                                    </div>
	                                    <div class="border-bottom-ly pb-3 mb-3 mt-3">
	                                        <textarea name=""
	                                            class="fs-13 fw-semi-bold border-0 w-100 bg-transparent note_heading"
	                                            id="notetitle_<?php echo $n; ?>"><?php echo (!empty($sticky->title) ? $sticky->title : ''); ?></textarea>
	                                        <div class="fs-12 text-muted">Last Updated:
	                                            <?php echo date('d F Y', strtotime($sticky->updated_date));  ?></div>

	                                    </div>
	                                    <textarea name="" class="border-0 w-100 bg-transparent note_input"
	                                        id="notedescription_<?php echo $n; ?>"><?php echo (!empty($sticky->notes) ? $sticky->notes : ''); ?></textarea>
	                                </div>
	                            </div>
	                            <?php }} ?>


	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xxl-4 col-md-6 d-flex flex-column">
	                <!--Start Section Header-->
	                <div class="section-header mb-4">
	                    <h5>News, Updates, Offers</h5>
	                    <div class="section-header_divider"></div>
	                </div>
	                <!--End Section Header-->
	                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100 mb-4 mb-xxl-0">
	                    <div class="card-body p-4 mb-3 mb-xl-0">
	                        <div class="news-carousel owl-carousel owl-theme">

	                            <!--Start News, Events-->
	                            <?php 
                             $count = 0;
                             $div_count = count($offer_courses) - 1;
                             if($count < count($offer_courses)){
                             for($i = 0;$i <= $div_count;$i +=3){ ?>
	                            <div>
	                                <!--Start News, Events-->
	                                <?php
                                    $child = $i+3;
                                     for($j = $i;$j < $child;$j++){?>

	                                <?php if(count($offer_courses) > $j){?>
	                                <div class="d-flex border p-3 rounded mb-2">
	                                    <div class="flex-shrink-0 width_70">
	                                        <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/'.html_escape(get_activethemes()->name).'/assets/img/offer/01.jpg') ?>" alt="..." class="rounded"> -->
	                                        <img src="<?php echo base_url($offer_courses[$j]['picture']) ?>" alt="..." class="rounded">
	                                    </div>
	                                    <div class="flex-grow-1 ms-3">
	                                        <h6><a href="#"
	                                                class="text-dark-cerulean"><?php echo ($offer_courses[$j]['name'] ? $offer_courses[$j]['name'] : '');?></a>
	                                        </h6>
	                                        <div class="text-muted fs-13"><?php echo $offer_courses[$j]['category_name']?>
	                                        </div>
	                                    </div>
	                                </div>

	                                <?php  } ?>
	                                <!--End News, Events-->

	                                <?php  }?>
	                            </div>
	                            <?php $count += $j;}
                             }else{
                             ?>
	                            <p>No record found!</p>
	                            <?php } ?>
	                            <!--End News, Events-->




	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xxl-4 d-flex flex-column">
	                <!--Start Section Header-->
	                <div class="d-sm-flex align-items-center justify-content-between mb-4">
	                    <div class="section-header mb-3 mb-sm-0">
	                        <h5>My Live Events </h5>
	                        <div class="section-header_divider"></div>
	                    </div>

	                </div>
	                <!--End Section Header-->
	                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100 mb-4 mb-xl-0">
	                    <div class="card-body p-4 tech">
	                        <?php if($live_event){?>
	                        <?php foreach($live_event as $levents){ ?>
	                        <div
	                            class="d-md-flex card-tech justify-content-between align-items-center bg-alice-blue border p-2 pe-3 rounded shadow-sm me-0 me-sm-2 me-xxl-0 mb-2">

	                            <div class="d-block">
	                                <!--Start Event-->
	                                <div class="align-items-center d-flex mb-2">
	                                    <div class="flex-shrink-0">
	                                        <div class="bg-white border event-date px-3 py-2 rounded text-center">
	                                            <div class="fs-13 text-muted">
	                                                <?php echo date("M", strtotime($levents['meeting_date'])) ?></div>
	                                            <div class="fs-4 fw-semi-bold">
	                                                <?php echo date("d", strtotime($levents['meeting_date'])) ?></div>
	                                        </div>
	                                    </div>
	                                    <div class="align-items-center d-sm-flex flex-grow-1 justify-content-between ms-3">
	                                        <div>
	                                            <h6 class="event-ttl"><?php echo $levents['name']?></h6>
	                                            <div class="fs-12 text-muted">
	                                                <?php echo date("h:i a", strtotime($levents['start_time'])) ?> -
	                                                <?php echo date("h:i a", strtotime($levents['end_time'])) ?></div>
	                                            <div><?php echo ($levents['summary']?$levents['summary']:'')?></div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <!--End Event-->
	                                <!-- <div class="d-flex justify-content-between">
	                                    <div class="px-3 py-2 text-center">
	                                        <div class="fs-13 fw-semi-bold">Type</div>
	                                        <div class="fs-13 text-muted fw-semi-bold">Public</div>
	                                    </div>
	                                    <div class="px-3 py-2 text-center">
	                                        <div class="fs-13 fw-semi-bold">Tickets</div>
	                                        <div class="fs-13 text-muted fw-semi-bold">Free</div>
	                                    </div>
	                                    <div class="px-3 py-2 text-center">
	                                        <div class="fs-13 fw-semi-bold">Enrolled</div>
	                                        <div class="fs-13 text-muted"><?php echo ($levents['total_enroll']?$levents['total_enroll']:0)?></div>
	                                    </div>
	                                </div> -->
	                            </div>
	                            <div class="d-flex d-md-block">
	                                <!-- <button
	                                    class="btn btn-outline-dark-cerulean btn-sm d-block w-100 w-sm-auto my-1 mx-md-0 mx-1">Pending</button> -->
	                                <!-- <button
	                                    class="btn btn-outline-dark-cerulean btn-sm d-block w-100 w-sm-auto my-1 mx-md-0 mx-1">View
	                                    <i data-feather="arrow-right"></i></button> -->
	                                <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$levents['course_id']); ?>"
	                                    class="btn btn-outline-dark-cerulean btn-sm d-block w-100 w-sm-auto my-1 mx-md-0 mx-1">Details
	                                    <i data-feather="arrow-right"></i></a>
	                            </div>
	                        </div>
	                        <?php }}else{?>
	                        <div
	                            class="d-md-flex card-tech justify-content-between align-items-center bg-alice-blue border p-2 pe-3 rounded shadow-sm me-0 me-sm-2 me-xxl-0 mb-2">

	                            <div class="d-block">
	                                Live Events Not Found
	                            </div>
	                        </div>
	                        <?php }?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="bg-alice-blue py-3">
	    <div class="container-lg">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
	                    <div class="card-body p-4 mb-3 mb-xl-0 table-responsive">
	                        <table class="table align-middle table-bordered datatablenn">
	                            <thead class="">
	                                <tr class="">
	                                    <th scope="col">Courses</th>
	                                    <th scope="col">Rating</th>
	                                    <th scope="col" class="text-center">Students</th>
	                                    <!-- <th scope="col" class="text-center">Avg. Purchase Amount</th> -->
	                                    <th scope="col" class="text-center">Total Earnings</th>
	                                    <th scope="col" class='text-center'>Status</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php 
									if($course_list){
										foreach($course_list as $courses){
										?>
	                                <tr>
	                                    <th scope="row">
	                                        <div class="d-flex align-items-center">
	                                            <img src="<?php echo base_url($courses['picture'])?>" class="me-2 rounded"
	                                                alt="" height="80px" width="30%">
	                                            <a class="text-dark"
	                                                href="<?php echo base_url($enterprise_shortname .'/course-details/'.$courses['course_id']); ?>">
	                                                <?php echo $courses['name']?>
	                                            </a>
	                                        </div>
	                                    </th>
	                                    <td>
	                                        <?php 
									
									$rating =  average_ratings_number($courses['course_id'],$enterprise_id);
									echo $rating;
									?>
	                                    </td>
	                                    <td class="text-center"><?php echo $courses['total_student']?></td>
	                                    <!-- <td class="text-center"><?php echo number_format($courses['course_price'],3);?> </td> -->
	                                    <td class="text-center">
	                                        <?php echo number_format($courses['total_purchase_amount'],2);?> </td>
	                                    <td class="text-center">
	                                        <?php if($courses['is_draft'] == 1){?>
	                                        <span class="custom-btn p-1 w-100"
	                                            style="background-color:#29b9f8;border:1px solid #29b9f8;color:#fff">Draft</span>
	                                        <?php }else{?>
	                                        <?php if($courses['status'] == 1){ ?>
	                                        <span class="custom-btn p-1 w-100 me-2"
	                                            style="background-color:#1acb97;border:1px solid #1acb97;color:#fff">Active</span>
	                                        <?php }elseif($courses['status'] == 2){?>
	                                        <span class="custom-btn p-1 w-100"
	                                            style="background-color:#feaa46;border:1px solid #feaa46;">Pending</span>
	                                        <?php }else{?>
	                                        <span class="custom-btn p-1 w-100"
	                                            style="background-color:#e43b38;border:1px solid #e43b38;color:#fff;">Cancelled</span>
	                                        <?php }?>
	                                        <?php }?>
	                                    </td>
	                                </tr>
	                                <?php }}else{?>
	                                <tr>
	                                    <td colspan="7" class="text-center">
	                                        <h4>Course Not Found</h4>
	                                    </td>
	                                </tr>
	                                <?php }?>

	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <input type="hidden" id="instructor_earningschartdata" value="<?php echo $instructor_earningschartdata; ?>">
	    <input type="hidden" id="allpreviousmonths" value="<?php echo $allpreviousmonths; ?>">

	    <div class="modal fade" id="NoteModal" tabindex="-1" aria-hidden="true" style="display: none;">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleModalLabel">Add Note</h5>
	                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	                </div>
	                <div class="modal-body">
	                    <div class="mb-3">
	                        <label for="notetitle" class="form-label">Title</label>
	                        <input type="text" class="form-control" id="notetitle" placeholder="">
	                    </div>
	                    <div class="mb-3">
	                        <label for="description" class="form-label">Description</label>
	                        <textarea class="form-control" id="description" rows="3"></textarea>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	                    <button type="button" class="btn btn-primary" onclick="instructor_stickynotesave()"
	                        id="stickynotesave">Save</button>

	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<script
	    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/apexcharts/dist/apexcharts.active.js'); ?>">
	</script>

	<script type="text/javascript">
$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // ============== its for pending agreement datatables ===========
    var table = $('.agreement-signdatatables').DataTable({
        lengthChange: false,
        buttons: [{
                extend: 'copy',
                className: 'btn-success'
            },
            {
                extend: 'excel',
                className: 'btn-success'
            },
            {
                extend: 'pdf',
                className: 'btn-success'
            },
            {
                extend: 'colvis',
                className: 'btn-success'
            }
        ]

    });

});

("use strict");

function updateStickynote_instructor(id, sl) {
    //  var id= $("#stickynote_id").val();
    var title = $("#notetitle_" + sl).val();
    var description = $("#notedescription_" + sl).val();
    var enterprise_id = $("#enterprise_id").val();
    var user_id = $("#user_id").val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    //alert(title);
    if (id != "") {
        if (title == "") {
            toastr["error"]("Title must be required");
            $("#notetitle").focus();
            return false;
        }
        if (description == "") {
            toastr["error"]("Description must be required");
            $("#description").focus();
            return false;
        }
        $.ajax({
            url: base_url + "/sticky-note-update",
            type: "POST",
            data: {
                id: id,
                csrf_test_name: csrf_test_name,
                enterprise_id: enterprise_id,
                user_id: user_id,
                title: title,
                description: description,
            },
            success: function(r) {
                toastr["success"]("Successfully Updated");
            },
        });
    }
}

function deleteinstructorStickynote(id) {
    var title = $("#notetitle_1").text();
    var r = confirm("Do you want to delete?");
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    if (r == true) {
        $.ajax({
            url: base_url + "/instructor-sticky-note-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id,
                title: title
            },
            success: function(r) {
                toastr["success"](r);
                // $("#note_item").load();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    }
}

function instructor_stickynotesave() {
    var enterprise_id = $("#enterprise_id").val();
    var user_id = $("#user_id").val();
    var title = $("#notetitle").val();
    var description = $("#description").val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    if (title == "") {

        toastr["error"]("Title must be required");
        $("#notetitle").focus();
        return false;
    }
    if (description == "") {

        toastr["error"]("Description must be required");
        $("#description").focus();
        return false;
    }

    $.ajax({
        url: base_url + "/instructor-sticky-note",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            enterprise_id: enterprise_id,
            user_id: user_id,
            title: title,
            description: description,
        },
        success: function(r) {
            toastr["success"]("Successfully Saved");
            $("#notetitle").val("");
            $("#description").val("");
            $("#NoteModal").modal("hide");
            // $(".note-carousel").load();
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}
// FFFFFF

// =============== its for signedagreementupload =============
$(".progress").hide();

function signedagreementupload(sl, course_id) {
    $(".progress").show();
    $(".progress").css("background-color", "#FFFFFF");;
    var fd = new FormData();
    // fd.append("signedagreement", $("#signedagreement" + sl)[0].files[0]);
    fd.append("signedagreement", $("#signedagreement")[0].files[0]);
    fd.append("course_id", course_id);
    // fd.append("file_id", id);
    fd.append("csrf_test_name", CSRF_TOKEN);

    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                    $("#progress-bar_" + sl).width(percentComplete + '%');
                    $("#progress-bar_" + sl).html(percentComplete + '%');
                }
            }, false);
            return xhr;
        },
        type: 'POST',
        url: base_url + "frontend/instructor/signedagreementupload",
        data: fd,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $("#progress-bar_" + sl).width('0%');
        },
        error: function() {
            $('#uploadStatus_' + sl).html(
                '<p style="color:#EA4335;">File upload failed, please try again.</p>');
        },
        success: function(resp) {
            $("#uploadStatus_" + sl).html(
                '<p class="mb-0" style="color:#28A74B;">File has uploaded successfully!</p>');
        }
    });
}


function yearmonthinstructorearninggraph(){
    var user_id = $("#user_id").val();
    var year_id = $("#year_id").val();
    var month_id = $("#month_id").val();
	var enterprise_id = $("#enterprise_id").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();

    $.ajax({
        url: base_url + enterprise_shortname + "/yearmonthinstructor-earninggraph",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            enterprise_id: enterprise_id,
            year_id: year_id,
            month_id: month_id,
            user_id: user_id,
        },
        success: function(r) {
			// console.log(r);
			$("#apexLineChart").html(r);
        },
    });
}

	</script>