<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php //if ($this->permission->check_label('category')->create()->access()) { ?>
                        <a href="<?php echo base_url(enterpriseinfo()->shortname .'/category'); ?>"
                            class="btn btn-primary">
                            <?php echo display('category'); ?>
                        </a>
                        <?php //} ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                        id="categoryarchivelist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('category') ?></th>
                                <th><?php echo display('parent_category') ?></th>
                                <th><?php echo display('created_date') ?></th>
                                <th><?php echo display('created_by') ?></th>
                                <th><?php echo display('updated_date') ?></th>
                                <th><?php echo display('updated_by') ?></th>
                                <th><?php echo display('deleted_date') ?></th>
                                <th><?php echo display('deleted_by') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type='hidden' id='total_categoryarchive' value='<?php echo $total_categoryarchive; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/category.js') ?>"></script>