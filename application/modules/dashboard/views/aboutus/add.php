<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/settings.css') ?>">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
        }
        if ($success != '') {
            echo $success;
        }
        $segment3 = $this->uri->segment(3);
        ?>
    </div>
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <?php echo html_escape((!empty($title) ? $title : null)) ?>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="nav flex-column nav-pills custom_tablist">
                            <ul class="nav nav-pills" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link <?php //echo (($segment3 == 1) ? 'active' : ''); ?>" onclick="" id="v-pills-menu_1-tab" data-toggle="pill"
                                        href="#v-pills-menu_1" role="tab" aria-controls="v-pills-menu_1"
                                        aria-selected="true">About Lead Academy</a>
                                </li>
                                <?php if(@$get_aboutinfo->about_id){ ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php //echo (($segment3 == 2) ? 'active' : ''); ?>" onclick="" id="v-pills-menu_2-tab" data-toggle="pill"
                                        href="#v-pills-menu_2" role="tab" aria-controls="v-pills-menu_2"
                                        aria-selected="false">Why Choose</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php //echo (($segment3 == 3) ? 'active' : ''); ?>" onclick="" id="v-pills-menu_3-tab" data-toggle="pill"
                                        href="#v-pills-menu_3" role="tab" aria-controls="v-pills-menu_3"
                                        aria-selected="false">Our Service</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-9 p-15">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-pills-menu_1" role="tabpanel"
                                aria-labelledby="v-pills-menu_1-tab">
                                <h4>About Lead Academy</h4>
                                <hr>
                                <?php echo form_open_multipart(enterpriseinfo()->shortname .'/about-summary-save', 'class="myform" id="myform"'); ?>
                                <?php //d($get_aboutinfo); ?>
                                <div class="form-group row">
                                    <label for="summary" class="col-sm-2 col-form-label">Summary <i class="text-danger">
                                            * </i></label>
                                    <div class="col-sm-9">
                                        <textarea name="summary" class="form-control" placeholder="Title" rows="10"
                                            id="summary"
                                            required><?php echo (!empty($get_aboutinfo->summary) ? $get_aboutinfo->summary : ''); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="aboutlink" class="col-sm-2 col-form-label">Link <i class="text-danger">
                                            * </i></label>
                                    <div class="col-sm-9">
                                        <input name="aboutlink" class="form-control" type="text" placeholder="Link"
                                            id="aboutlink"
                                            value="<?php echo (!empty($get_aboutinfo->aboutlink) ? $get_aboutinfo->aboutlink : ''); ?>"
                                            required="">
                                        <span class="text-danger f-s-10">( Need your full URL)</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mission" class="col-sm-2 col-form-label">Mission <i class="text-danger">
                                            * </i></label>
                                    <div class="col-sm-9">
                                        <textarea name="mission" class="form-control" placeholder="Mission" rows="5"
                                            id="mission"><?php echo (!empty($get_aboutinfo->mission) ? $get_aboutinfo->mission : ''); ?></textarea>
                                        <!-- <span style="padding-left:10px; color: red;">Total word Count :
                                            <span id="display_count"
                                                style="font-size:16px; color:black; color: red;">0</span> words
                                            &amp;
                                            <span id="count_left"
                                                style="font-size:16px; color:black;  color: red;">15</span> words
                                            left.</span> -->
                                    </div>
                                </div>



                                <div class="offset-2 mb-3 group-end">
                                    <input type="hidden" name="about_id" id="about_id"
                                        value="<?php echo (!empty($get_aboutinfo->about_id) ? $get_aboutinfo->about_id : ''); ?>">
                                    <button type="submit" class="btn btn-info w-md m-b-5" onclick="">Save</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="tab-pane fade" id="v-pills-menu_2" role="tabpanel"
                                aria-labelledby="v-pills-menu_2-tab">


                                <div class="getfeaturedinshow">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="card">
                                                <?php echo form_open_multipart(enterpriseinfo()->shortname .'/about-choose-save', 'class="myform" id="myform"'); ?>
                                                <div class="card-header">
                                                    <h6>Why choose Lead Academy</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row m-r">
                                                        <div class="col-sm-5">
                                                            Title
                                                        </div>
                                                        <div class="col-sm-5">
                                                            Logo
                                                        </div>
                                                    </div>
                                                    <div id="chooselogo_area">
                                                        <div class="form-group row m-r">
                                                            <div class="col-sm-5">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 pr-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                name="choose_title[]" id="choose_title"
                                                                                placeholder="<?php echo "Title"; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="d-flex mt-2">
                                                                    <div class="flex-grow-1 pr-3">
                                                                        <div class="form-group">
                                                                            <input type="file" class="form-control"
                                                                                name="chooselogo[]" id="chooselogo"
                                                                                onchange="aboutfileValueOne(this,'chooselogo', '1')">
                                                                            <span class="text-danger mt-5">File size
                                                                                320*183 </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <img id="image-preview-chooselogo-1" src="" alt=""
                                                                    class="border border-2" width="180px">
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <button type='button'
                                                                    class='btn btn-danger btn-sm custom_btn m-t-10'
                                                                    name='button' onclick='removewhychooselog(this)'>
                                                                    <i class='fa fa-minus'></i> </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                            onclick="appendwhychooselogo()"><i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="offset-2 mb-3 group-end">
                                                    <input type="hidden" name="about_id" id="about_id"
                                                        value="<?php echo (!empty($get_aboutinfo->about_id) ? $get_aboutinfo->about_id : ''); ?>">
                                                    <button type="submit" class="btn btn-info w-md m-b-5"
                                                        onclick="">Save</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                            <br>
                                            <div class="card">
                                                <div class="card-header">
                                                    List of record
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered table-sm" id="choose_datalist"
                                                        style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%"><i class="fa fa-th-list"></i></th>
                                                                <th width="30%"><?php echo display('title'); ?></th>
                                                                <th width="20%"><?php echo display('picture'); ?></th>
                                                                <th width="30%" class="text-center"><i
                                                                        class="fa fa-cogs"></i></th>
                                                            </tr>
                                                        </thead>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="tab-pane fade" id="v-pills-menu_3" role="tabpanel"
                                aria-labelledby="v-pills-menu_3-tab">
                                <div class="collaborateshow">
                                    <div class="getfeaturedinshow">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6>Our Services</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php echo form_open_multipart(enterpriseinfo()->shortname .'/about-service-save', 'class="myform" id="myform"'); ?>
                                                        <div class="form-group row">
                                                            <label for="service_title"
                                                                class="col-sm-2 col-form-label">Title
                                                                <i class="text-danger">
                                                                    * </i></label>
                                                            <div class="col-sm-9">
                                                                <input name="service_title" class="form-control"
                                                                    placeholder="Title" rows="10" id="service_title"
                                                                    value=""
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                                // $subtitles = json_decode(@$get_aboutinfo->service_subtitle);
                                                        ?>
                                                        <div class="form-group row m-r">
                                                            <label class="col-sm-2 col-form-label"
                                                                for="subtitle">Subtitle</label>
                                                            <div class="col-sm-8">
                                                                <?php 
                                                                // if($subtitles){
                                                                //     foreach($subtitles as $sub){
                                                                ?>
                                                                <div id="">
                                                                    <div class="d-flex mt-2">
                                                                        <div class="flex-grow-1 pr-3">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control"
                                                                                    name="subtitle[]" id="subtitle"
                                                                                    value=""
                                                                                    placeholder="<?php echo "Subtitle"; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <button type='button'
                                                                                class='btn btn-danger btn-sm custom_btn m-t-0'
                                                                                name='button'
                                                                                onclick='removeService(this)'>
                                                                                <i class='fa fa-minus'></i> </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                //} 
                                                                //}
                                                                ?>
                                                                <div id="service_area"></div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-success text-white btn-sm custom_btn mt-2"
                                                                    onclick="appendService()"><i class="fa fa-plus"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="service_logo"
                                                                class="col-sm-2 col-form-label">Logo <i
                                                                    class="text-danger"> </i></label>
                                                            <div class="col-sm-6">
                                                                <input type="file" name="service_logo"
                                                                    class="form-control" id="service_logo"
                                                                    onchange="fileValueOne(this,'service_logo')">
                                                                <input type="hidden" id="old_service_logo"
                                                                    name="old_service_logo"
                                                                    value="">
                                                                <span class="text-danger mt-5">File size 165*165 </span>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <img id="image-preview-service_logo"
                                                                    src="" alt="" class="border border-2" width="165px">
                                                            </div>
                                                        </div>

                                                        <div class="offset-2 mb-3 group-end">
                                                            <input type="hidden" name="about_id" id="about_id"
                                                                value="<?php echo (!empty($get_aboutinfo->about_id) ? $get_aboutinfo->about_id : ''); ?>">
                                                            <button type="submit" class="btn btn-info w-md m-b-5"
                                                                onclick="">Save</button>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="card">
                                                    <div class="card-header">
                                                        List of record
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-sm"
                                                            id="service_datalist" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th width="20%"><i class="fa fa-th-list"></i></th>
                                                                    <th width="30%"><?php echo display('title'); ?></th>
                                                                    <th width="20%"><?php echo display('picture'); ?>
                                                                    </th>
                                                                    <th width="30%" class="text-center"><i
                                                                            class="fa fa-cogs"></i></th>
                                                                </tr>
                                                            </thead>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>


                            </div><br>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inline form -->


<!-- The Modal -->
<div class="modal fade" id="modal_infoour" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttlour"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="infoour">

            </div>
        </div>
    </div>
</div>

<!-- <input type="hidden" id="uri" value="<?php echo $this->uri->segment('3'); ?>"> -->
<script src="<?php echo base_url('application/modules/dashboard/assets/js/about.js') ?>"></script>


<script>
$(document).ready(function() {


});
</script>