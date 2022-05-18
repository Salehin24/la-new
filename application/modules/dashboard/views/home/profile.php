<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
                </div>
            </div> 
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">  
                                <div class="card-header-menu">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <?php
                                $picture = '';
                                if ($user->image) {
                                    $picture = $user->image;
                                } else {
                                    $picture = $user->picture;
                                }
                                ?>
                                <img src="<?php echo base_url((!empty(html_escape($picture)) ? html_escape($picture) : 'assets/img/icons/default.png')) ?>" alt="User Image" class="h-200">
                            </div> 
                            <div class="card-content">
                                <div class="card-content-member">
                                    <h4 class="m-t-0"><?php echo html_escape($user->fullname) ?> (<?php echo html_escape($user->user_level) ?>)</h4> 
                                </div> 
                            </div>
                            <br>
                            <div class="card-content"> 
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="20%"><?php echo display('name'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->name) ?></td>
                                        </tr>
                                        <tr>
                                            <th width="20%"><?php echo display('email'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->email) ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <th width="20%"><?php echo display('about'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->about) ?></td>
                                        </tr> -->
                                        <tr>
                                            <th width="20%"><?php echo display('ip_address'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->ip_address) ?></td>
                                        </tr>
                                        <tr>
                                            <th width="20%"><?php echo display('last_login'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->last_login) ?></td>
                                        </tr>
                                        <tr>
                                            <th width="20%"><?php echo display('last_logout'); ?></th>
                                            <td>:</td>
                                            <td><?php echo html_escape($user->last_logout) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

