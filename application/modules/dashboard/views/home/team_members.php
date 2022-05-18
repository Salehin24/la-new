<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h6><?php echo display('team_members'); ?></h6>    
            </div> 
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="member_name" class="col-sm-3"><?php echo display('name') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="name" type="text" class="form-control" id="member_name" placeholder="<?php echo display('name') ?>" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="member_designation" class="col-sm-3"><?php echo display('designation') ?> <i class="text-danger"> *</i></label>
                        <div class="col-sm-6">
                            <input name="name" type="text" class="form-control" id="member_designation" placeholder="<?php echo display('designation') ?>" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="picture" class="col-sm-3"><?php echo display('picture') ?> 
                            <span class="text-danger">( 118×118 )Formats:(png,jpeg,jpeg)</span>
                        </label>
                        <div class="col-sm-6">
                            <input name="picture" type="file" class="form-control" id="picture" onchange="fileValueOne(this,'team')">
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
                            <button type="button" class="btn btn-info w-md m-b-5" onclick="teammemberinfo_save()"><?php echo display('save') ?></button>
                        </div>
                    </div>
                    
                </form>
                <!-- language -->  
                    <table class="table table-bordered table-sm" id="teammemberlist">
                        <thead>
                            <tr>
                                <th width="5%"><i class="fa fa-th-list"></i></th>
                                <th width="25%"><?php echo display('member_name'); ?></th>
                                <th width="20%"><?php echo display('designation'); ?></th>
                                <th width="20%" class="text-center"><?php echo display('picture'); ?></th>
                                <th width="20%" class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>                        
                    </table>  
                <!-- The Modal -->
                <div class="modal fade" id="teammembermodal_info" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title teammembermodal_ttl"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="teammemberinfo">

                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// function companyfile(value) {
//     var path = value.value;
//     var extenstion = path.split('.').pop();
//     if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
//         document.getElementById('company-image-preview').src = window.URL.createObjectURL(value.files[0]);
//         var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
//         // document.getElementById("filename").innerHTML = filename;
//     } else {
//         alert("File not supported. Kindly Upload the Image of below given extension ")
//     }
//   }
// function Editcompanyfile(value) {
//     var path = value.value;
//     var extenstion = path.split('.').pop();
//     if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
//         document.getElementById('company-image-previewedit').src = window.URL.createObjectURL(value.files[0]);
//         var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
//         // document.getElementById("filename").innerHTML = filename;
//     } else {
//         alert("File not supported. Kindly Upload the Image of below given extension ")
//     }
//   }
</script>