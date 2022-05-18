<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/settings.css') ?>">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        $get_settingsmenu = $this->db->select('*')
                ->from('sec_menu_item')
                ->where('parent_menu', 76)
                ->where('status', 1)
                ->where('is_homesetting', 1)
                ->order_by('ordering', 'asc')
                ->get()->result();
                // d($get_settingsmenu);
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




                                <?php
                                $sl = 0;
                                foreach ($get_settingsmenu as $menu) {
                                    $sl++;
                                    if ($sl == 1) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    if ($this->permission->check_label($menu->menu_title)->access()) {
                                        // if (get_usertype() != 1) {
                                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $active; ?>"
                                        onclick="<?php echo $menu->page_url; ?>()"
                                        id="v-pills-<?php echo "menu_" . $sl; ?>-tab" data-toggle="pill"
                                        href="#v-pills-<?php echo "menu_" . $sl; ?>" role="tab"
                                        aria-controls="v-pills-<?php echo "menu_" . $sl; ?>"
                                        aria-selected="false"><?php echo display($menu->menu_title); ?></a>
                                </li>
                                <?php
                                        // } elseif (get_usertype() == 1) {
                                        //     if ($menu->page_url != 'add_user' && $menu->page_url != 'getaboutus' && $menu->page_url != 'getfeature' && $menu->page_url != 'getnotice' && $menu->page_url != 'getprivacypolicy' && $menu->page_url != 'gettermscondition' && $menu->page_url != 'getslider' && $menu->page_url != 'getcurrency' && $menu->page_url != 'certificateconfig') {
                                                ?>
                                <!-- <li class="nav-item">
                                                    <a class="nav-link <?php //echo $active; ?>"  onclick="<?php //echo $menu->page_url; ?>()" id="v-pills-<?php //echo "menu_" . $sl; ?>-tab" data-toggle="pill" href="#v-pills-<?php //echo "menu_" . $sl; ?>" role="tab" aria-controls="v-pills-<?php //echo "menu_" . $sl; ?>" aria-selected="false"><?php //echo display($menu->menu_title); ?></a>
                                                </li> -->
                                <?php
                                        //     }
                                        // }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-9 p-15">
                        <div class="tab-content" id="v-pills-tabContent">

                            <?php
                            $sl = 0;
                            foreach ($get_settingsmenu as $menu) {
                                $sl++;
                                $p_sl = $sl - 1;
                                if ($sl == 1) {
                                    // if (get_usertype() != 1) {
                                        ?>
                            <div class="tab-pane fade show active" id="v-pills-<?php echo "menu_" . $sl; ?>"
                                role="tabpanel" aria-labelledby="v-pills-<?php echo "menu_" . $sl; ?>-tab">
                                <h4>Our Features</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="featuretitle"
                                        class="col-sm-2 col-form-label"><?php echo display('title') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="featuretitle" class="form-control" type="text"
                                            placeholder="<?php echo display('title') ?>" id="featuretitle" value=""
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="featurelink"
                                        class="col-sm-2 col-form-label"><?php echo display('link') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <input name="featurelink" class="form-control" type="text"
                                            placeholder="<?php echo display('link') ?>" id="featurelink" value=""
                                            required>
                                <span class="text-danger f-s-10">( Need your full URL)</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="featuresummary"
                                        class="col-sm-2 col-form-label"><?php echo display('summary') ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <textarea name="featuresummary" class="form-control"
                                            placeholder="<?php echo display('summary') ?>" id="featuresummary"></textarea>
                                        <span style="padding-left:10px; color: red;">Total word Count :
                                            <span id="display_count"
                                                style="font-size:16px; color:black; color: red;">0</span> words
                                            &
                                            <span id="count_left"
                                                style="font-size:16px; color:black;  color: red;">15</span> words
                                            left.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="featureordering"
                                        class="col-sm-2 col-form-label"><?php echo display('ordering'); ?> <i
                                            class="text-danger"> * </i></label>
                                    <div class="col-sm-9">
                                        <select class="form-control featureordering placeholder-single"
                                            id="featureordering" data-placeholder="-- select one --" name="ordering">
                                            <option value=""></option>
                                            <?php for ($i = 1; $i < 5; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ourfeatureimage"
                                        class="col-sm-2 col-form-label"><?php echo display('image') ?></label>
                                    <div class="col-sm-9">
                                        <div>
                                            <input type="file" name="ourfeatureimage" id="ourfeatureimage"
                                                class="custom-input-file" onchange="fileValueOne(this,'user')" />
                                            <label for="ourfeatureimage">
                                                <i class="fa fa-upload"></i>
                                                <span class="ourfeature-filename"><?php echo display('choose_file'); ?>…</span>
                                            </label>
                                            <span class="text-danger">Size:( 59*59 ) Formats:(png,jpg,jpeg, svg)</span>
                                            <br>
                                            <img id="image-preview-user" src="" alt="" class="border border-2"
                                                width="200px">

                                        </div>
                                    </div>
                                </div>

                                <div class="offset-2 mb-3 group-end">
                                    <button type="button" class="btn btn-info w-md m-b-5"
                                        onclick="ourfeaturessave()"><?php echo display('save') ?></button>
                                </div>

                                <table class="table table-bordered table-sm" id="ourfeature_datalist">
                                    <thead>
                                        <tr>
                                            <th width="5%"><i class="fa fa-th-list"></i></th>
                                            <th width="30%"><?php echo display('title'); ?></th>
                                            <th width="5%"><?php echo display('ordering'); ?></th>
                                            <th width="15%"><?php echo display('link'); ?></th>
                                            <th width="15%"><?php echo display('summary'); ?></th>
                                            <th width="15%"><?php echo display('picture'); ?></th>
                                            <th width="15%" class="text-center"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>

                                </table>

                            </div>
                            <?php
                                    // }
                                } else {
                                    ?>
                            <div class="tab-pane fade" id="v-pills-<?php echo "menu_" . $sl; ?>" role="tabpanel"
                                aria-labelledby="v-pills-<?php echo "menu_" . $sl; ?>-tab">
                                <div class="<?php echo $menu->menu_title; ?>show"></div><br>

                            </div>
                            <?php } ?>
                            <?php } ?>



                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inline form -->
</div>

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

<input type="hidden" id="uri" value="<?php echo $this->uri->segment('3'); ?>">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/settings.js?v=2') ?>"></script>


<script>
var max_count = 15;
$(document).ready(function() {
    var wordCounts = {};
    $("#featuresummary").keyup(function() {
        var matches = this.value.match(/\b/g);
        wordCounts["featuresummary"] = matches ? matches.length / 2 : 0;
        var finalCount = 0;
        $.each(wordCounts, function(k, v) {
            finalCount += v;
        });
        var vl = this.value;
        if (finalCount > max_count) {
            vl = vl.substring(0, vl.length - 1);
            this.value = vl;
            alert("Must be "+max_count+" word limited!");
        }
        var countleft = parseInt(max_count - finalCount);

        $('#display_count').html(finalCount);
        $('#count_left').html(countleft);
    });

    $("#featuresummary").bind('change paste',function() {
        var matches = this.value.match(/\b/g);
        wordCounts["featuresummary"] = matches ? matches.length / 2 : 0;
        var finalCount = 0;
        $.each(wordCounts, function(k, v) {
            finalCount += v;
        });
        var vl = this.value;
        var countleft = parseInt(max_count - finalCount);
        if (finalCount > max_count) {
            $("#featuresummary").val('');
        }

        $('#display_count').html(finalCount);
        $('#count_left').html(countleft);
    });

    $("body").on("change", "#ourfeatureimage", function (e) {
      var filename = e.target.files[0].name;
      $(".ourfeature-filename").text(filename);
    });
});
</script>