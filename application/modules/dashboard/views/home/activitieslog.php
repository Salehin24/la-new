<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('activities_log'); ?></h6>    
            </div> 
            <div class="card-body">
                    <table class="table table-bordered table-sm" id="activitiesloglist">
                        <thead>
                            <tr>
                                <th width="5%"><i class="fa fa-th-list"></i></th>
                                <th width="25%"><?php echo display('title'); ?></th>
                                <th width="10%"><?php echo display('action'); ?></th>
                                <th width="15%" class=""><?php echo display('enterprise'); ?></th>
                                <th width="15%" class=""><?php echo display('created_by'); ?></th>
                                <th width="15%" class=""><?php echo display('created_date'); ?></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>                        
                    </table>  
            </div>
        </div>
    </div>
</div>
