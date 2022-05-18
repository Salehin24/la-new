<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php if ($this->permission->check_label('category')->create()->access()) { ?>
                        <a href="<?php echo base_url(enterpriseinfo()->shortname. '/add-enterprise'); ?>" class="btn btn-success">
                            <?php echo display('add_enterprise'); ?>
                        </a>
                        <?php } ?>
                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                        id="enterpriselist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('mobile') ?></th>
                                <th><?php echo display('username') ?></th>
                                <th><?php echo display('student_capacity') ?></th>
                                <th><?php echo display('instructor_capacity') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="info">

            </div>                    
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo $total_enterprisecount; ?>" id="total_enterprisecount">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/enterprise.js') ?>"></script>