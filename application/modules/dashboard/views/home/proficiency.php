<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('proficiency'); ?></h6>    
            </div> 
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="proficiency_title" class="col-sm-3"><?php echo display('title') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="title" type="text" class="form-control" id="proficiency_title" placeholder="<?php echo display('title') ?>" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="picture" class="col-sm-3"><?php echo display('picture') ?> 
                            <span class="text-danger">( 118×118 ) Formats:(png,jpeg,jpeg)</span>
                        </label>
                        <div class="col-sm-6">
                            <input name="picture" type="file" class="form-control" id="proficiency_picture" onchange="fileValueOne(this,'team')">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="" class="col-sm-3"></label>
                        <div class="col-sm-6">
                           <img id="image-preview-team" src="" alt="" class="border border-2" width="200px">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <div class="offset-4 mb-3">
                            <button type="button" class="btn btn-info w-md m-b-5" onclick="proficiencyinfo_save()"><?php echo display('save') ?></button>
                        </div>
                    </div>
                    
                </form>
                <!-- language -->  
                    <table class="table table-bordered table-sm" id="proficiencylist">
                        <thead>
                            <tr>
                                <th width="5%"><i class="fa fa-th-list"></i></th>
                                <th width="25%"><?php echo display('title'); ?></th>
                                <th width="20%" class="text-center"><?php echo display('picture'); ?></th>
                                <th width="20%" class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>                        
                    </table>  
                <!-- The Modal -->
                <div class="modal fade" id="proficiencymodal_info" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title proficiencymodal_ttl"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="proficiencyinfo">

                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
