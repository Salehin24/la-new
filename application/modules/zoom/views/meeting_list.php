
<link href="<?php echo base_url('application/modules/zoom/assets/css/style.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
<?php
date_default_timezone_set("Asia/Dhaka");
?>

<header class="hero-header bg-image" data-image-src="<?php echo base_url('application/modules/zoom/assets/images/zoom-slider-1.png'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="category-details">
                    <h1 class="title fs-26 font-weight-bold"><?php echo display('profiles'); ?></h1>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="section  h-400px">
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <?php
                $this->load->view('frontend/themes/default/student_panel/dashboard_sidebar');
                ?>
            </div>
            <div class="col-md-9">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo display('meeting_list'); ?></h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table display table-responsive table-bordered table-striped table-hover bg-white m-0 card-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%"><?php echo display('sl') ?></th>
                                            <th width="20%"><?php echo display('title') ?></th>
                                            <th width="15%" class="text-center"><?php echo display('meeting') . ' ' . display('date'); ?></th>
                                            <th width="15%" class="text-center"><?php echo display('start_time') ?></th>
                                            <th width="15%" class="text-center"><?php echo display('end_time') ?></th>
                                            <th width="15%" class="text-center"><?php echo display('status') ?></th>
                                            <th width="10%" class="text-center"><?php echo display('action') ?></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($meeting_list) {
                                            $sl = 0 + $pagenum;
                                            $labelmode = '';
                                            foreach ($meeting_list as $single) {
                                                $sl++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td><?php echo html_escape($single->title); ?></td>
                                                    <th class="text-center"><?php echo html_escape(date('d M Y', strtotime($single->meeting_date))); ?></th>
                                                    <td class="text-center"><?php echo html_escape($single->start_time); ?></td>
                                                    <td class="text-center"><?php echo html_escape($single->end_time); ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time()) {
                                                            $status = '<i class="fas fa-video"></i> ' . display('live');
                                                            $labelmode = 'btn btn-success-soft';
                                                            $hostbtn = "getJoinModal('$single->meeting_id|$single->id')";
                                                        }
                                                        if (strtotime($single->meeting_date) < strtotime(date("Y-m-d")) || strtotime($single->end_time) <= time()) {
                                                            $status = '<i class="far fa-check-square"></i> ' . display('expired');
                                                            $labelmode = 'btn btn-danger-soft';
                                                            $hostbtn = '';
                                                        }
                                                        if (strtotime($single->meeting_date) > strtotime(date("Y-m-d")) || strtotime($single->end_time) <= time()) {
                                                            $status = '<i class="far fa-clock"></i> ' . display('waiting');
                                                            $labelmode = 'btn btn-info-soft';
                                                            $hostbtn = '';
                                                        }
                                                        echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
                                                        ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <a class="" href="javascript:void(0)" onclick="<?php echo $hostbtn; ?>" data-toggle="tooltip" data-original-title="Host" ><i class="fas fa-network-wired btn btn-primary btn-sm"> </i> </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <?php if (empty($meeting_list)) { ?>
                                        <tfoot>
                                            <tr>
                                                <th colspan="8" class="text-center text-danger"><?php echo display('record_not_found'); ?></th>
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                                <br>
                                <div class="">
                                    <?php echo htmlspecialchars_decode($links); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>


<!-- The Modal -->
<div class="modal fade" id="meeting_modalinfo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="meeting_info">

            </div>                    
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>