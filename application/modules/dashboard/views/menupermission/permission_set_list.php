
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('menu_list'); ?>
                    </h4>
                    <hr>
                </div>
            </div>
            <div class="panel-body">
                <div class="">
                    <table class=" table table-bordered table-hover" id="menulist">
                        <thead>
                            <tr>
                                <th width="10%"><?php echo display('sl') ?></th>
                                <th width="25%"><?php echo display('menu_title') ?></th>
                                <th width="15%"><?php echo display('page_url') ?></th>
                                <th width="10%"><?php echo display('module') ?></th>
                                <th width="15%"><?php echo display('parent') ?></th>
                                <th width="15" class="text-center"><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-md">
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

