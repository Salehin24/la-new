<style>
    /*============  its for module ==========*/
    .thumbail_fixed{
        display: block;
        max-height: 200px;
        overflow: hidden;
    }
    .thumbnail{
        display: block;
        padding: 4px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .caption h3{
        font-size: 16px;
        margin-top: 20px;
    }
    .w-100per{
        width: 100%;
    }
    .addon_price{
        font-size: 20px; color: #ff6100; font-weight: 700;    margin-bottom: 0;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <h4 class="card-header"><?php echo (!empty($title) ? $title : null) ?>
                <small class="float-right">
                    <a href="<?php echo base_url(enterpriseinfo()->shortname .'/purchase-addons'); ?>" class="btn btn-success btn-xs">
                        <?php echo display('download'); ?>
                    </a>
                </small>
            </h4>
            <div class="card-body">
                <div class="row">
                    <?php
                    if (!empty($modules)) {
                        foreach ($modules as $module) {
                            if (!in_array($module->identity, $installed)) {
                                $module_img = (!empty($module->thumb) ? $module->thumb : NO_IMAGE);
                                ?>
                                <div class="col-xl-3 col-lg-4">
                                    <div class="thumbnail">
                                        <a href="javascript:void(0)" class="thumbail_fixed">
                                            <img src="<?php echo $module_img; ?>"  alt="<?php echo $module->module_name ?>" class="w-100per">
                                        </a>
                                        <div class="caption">
                                            <h3>
                                                <?php echo $module->module_name; ?>
                                                <span class="price addon_price float-right">$ <?php echo number_format($module->price, 2); ?></span>
                                            </h3>
                                            <div class="category">Version <?php echo $module->version; ?></div>
                                            <p class="caption_desc"><?php echo $module->short_description; ?></p>
                                            <hr>
                                            <p>
                                                <a href="<?php echo $module->payment_url; ?>" target="_blank" role="button"  class="btn btn-success" >Buy Now</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                    <!-- display list of downloaded module without Default Modules -->
                    <?php
                    $path = 'application/modules/';
                    $map = directory_map($path);
                    $def_mods = ['dashboard', 'template', 'frontend'];

                    if (is_array($map))
                    //extract each directory 
                        foreach ($map as $key => $value) {
                            $key = str_replace("\\", '/', $key);
                            $mod = str_replace("/", '', $key);

                            //chek directory is not default modules
                            if ($value != "index.html" && !in_array($mod, $def_mods)) {
                                // set the default config path
                                $file = $path . $key . 'config/config.php';
                                $image = $path . $key . 'assets/images/thumbnail.jpg';
                                $css = $path . $key . 'assets/css/style.css';
                                $js = $path . $key . 'assets/js/script.js';
                                $db = $path . $key . 'assets/data/database.sql';
                                $delMod = ((!is_array($value) && $value != 'index.html') ? $value : (is_array($value) ? $mod : null));
                                //check database.sql and config.php 
                                if (file_exists($file) && file_exists($db) && file_exists($image)) {
                                    @include($file);
//                                    d($HmvcConfig[$mod]);
                                    //check the setting of config.php
                                    if (isset($HmvcConfig[$mod]) && is_array($HmvcConfig[$mod]) && array_key_exists('_title', $HmvcConfig[$mod]) && $HmvcConfig[$mod]['_title'] != '' && array_key_exists('_database', $HmvcConfig[$mod]) && array_key_exists('_description', $HmvcConfig[$mod]) && $HmvcConfig[$mod]['_description'] != ''
                                    ) {
                                        ?>
                                        <!-- display module information -->
                                        <div class="col-xl-3 col-lg-4">
                                            <div class="thumbnail">
                                                <?php
                                                //form to module 
                                                echo form_open('dashboard/module/install');
                                                echo form_hidden('name', $HmvcConfig[$mod]['_title']);
                                                echo form_hidden('image', $image);
                                                echo form_hidden('directory', $mod);
                                                echo form_hidden('description', $HmvcConfig[$mod]['_description']);
                                                ?>

                                                <a href="javascript:void(0)" class="thumbail_fixed">
                                                    <img src="<?php echo base_url('application/modules/' . $mod . '/assets/images/thumbnail.jpg') ?>" alt="<?php echo $mod; ?>" class="mod_thumb_img">
                                                </a>
                                                <div class="caption">
                                                    <h3>
                                                        <?php echo html_escape(($HmvcConfig[$mod]['_title'] != null) ? $HmvcConfig[$mod]['_title'] : null) ?>
                                                        <span class="price addon_price float-right" style="font-size: 20px; color: #ff6100; font-weight: 700;    margin-bottom: 0;">$ <?php echo number_format($module->price, 2); ?></span>
                                                    </h3>
                                                    <div class="category">Version : <strong><?php echo html_escape(($HmvcConfig[$mod]['_version'] != null) ? $HmvcConfig[$mod]['_version'] : null) ?></strong></div>
                                                    <p class="caption_desc">
                                                        <?php echo html_escape(($HmvcConfig[$mod]['_description'] != null) ? $HmvcConfig[$mod]['_description'] : null) ?>
                                                    </p>
                                                    <hr>
                                                    <p>
                                                        <?php
                                                        $mkey = array_search($mod, array_column($modules, 'identity'));
                                                        if (($modules[$mkey]->identity == $mod) && ($modules[$mkey]->version > $HmvcConfig[$mod]['_version'])) {
                                                            ?>
                                                            <a onclick="return confirm('<?php echo display("are_you_sure") ?>')"  href="<?php echo base_url("dashboard/module/updatemodule/$delMod/") ?>" class="btn btn-success"><?php echo display("update") ?></a>
                                                            <?php
                                                        }
                                                        $rows = null;
                                                        $rows = $this->db->select("*")
                                                                ->from('module')
                                                                ->where('directory', $mod)
                                                                ->get();
                                                        if ($rows->num_rows() > 0) {
                                                            ?>
                                                            <a onclick="return confirm('<?php echo display("are_you_sure") ?>')"  href="<?php echo base_url("dashboard/module/uninstall/$delMod") ?>" class="btn btn-danger"><?php echo display("uninstall") ?></a> 
                                                        <?php } else {
                                                            ?>
                                                            <button onclick="return confirm('<?php echo display("are_you_sure") ?>')" type="submit" class="btn btn-success" role="button"><?php echo display("install") ?></button>  
                                                        <?php } ?>
                                                        <a onclick="return confirm('<?php echo display("are_you_sure") ?>')" href="<?php echo base_url("dashboard/module/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        echo form_close();
                                    } else {
                                        ?>
                                        <!-- if module config.php configuration missing -->
                                        <div class="col-xl-3 col-lg-4">
                                            <div class="thumbnail">
                                                <h3><?php echo display("invalid_module") ?> "<?php echo $mod ?>" </h3>
                                                <div class="caption text-danger">
                                                    <h4>Missing config.php</h4> 
                                                    <ul class="pl_10">
                                                        <?php
                                                        if (isset($HmvcConfig[$mod])) {
                                                            if (!array_key_exists('_title', $HmvcConfig[$mod]) || $HmvcConfig[$mod]['_title'] == null) {
                                                                echo '<li>$HmvcConfig["' . $mod . '"]["_title"]</li>';
                                                            }
                                                            if (!array_key_exists('_description', $HmvcConfig[$mod]) || $HmvcConfig[$mod]['_description'] == null) {
                                                                echo '<li>$HmvcConfig["' . $mod . '"]["_description"]</li>';
                                                            }
                                                        } else {
                                                            echo '<li>$HmvcConfig["' . $mod . '"] is not define</li>';
                                                        }
                                                        ?>

                                                        <li></li>
                                                    </ul>
                                                </div>
                                                <p><a onclick="return confirm('<?php echo display("are_you_sure") ?>')" href="<?php echo base_url("dashboard/module/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    // ends of check the setting of config.php
                                } else {
                                    ?>
                                    <!-- if module config.php or database.sql is not found -->
                                    <div class="col-xl-3 col-lg-4">
                                        <div class="thumbnail"> 
                                            <h3><?php echo display("invalid_module") ?> "<?php echo $delMod ?>"</h3>
                                            <div class="caption text-danger">
                                                <h4>Missing</h4> 
                                                <ul class="pl_10">
                                                    <?php
                                                    if (!file_exists($file)) {
                                                        echo "<li>config/config.php</li>";
                                                    }
                                                    if (!file_exists($db)) {
                                                        echo "<li>assets/data/database.sql</li>";
                                                    }
                                                    if (!file_exists($image)) {
                                                        echo "<li>assets/images/thumbnail.jpg</li>";
                                                    }
                                                    if (!file_exists($css)) {
                                                        echo "<li>assets/css/style.css</li>";
                                                    }
                                                    if (!file_exists($js)) {
                                                        echo "<li>assets/js/script.js</li>";
                                                    }
                                                    ?> 
                                                </ul>
                                            </div>
                                            <p><a onclick="return confirm('<?php echo display("are_you_sure") ?>')" href="<?php echo base_url("dashboard/module/uninstall/$delMod/delete") ?>" type="submit" class="btn btn-danger delete_item"><?php echo display("delete") ?></a></p>
                                        </div>
                                    </div>   
                                    <?php
                                }
                            }
                        }
                    ?>

                </div>
            </div> 
        </div> 
    </div>
</div>
