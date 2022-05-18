<html>
    <!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Password Recover</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/login-style.css'); ?>">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="welcome_header">
                    <h3 class="text-center">Thank you for your request</h3>
                </div>
            </div>
            <div class="row">
                <div class="welcome_description">
                    Dear <strong>
                        <?php
                        if ($author_info->name) {
                            echo html_escape($author_info->name);
                        }
                        //d($author_info);
                        ?>
                    </strong>
                    <!-- <p>Your Current Password: <strong><?php echo html_escape($random_key); ?></strong> </p> -->
                    <p>Your password reset link:- 
                        <a href="<?php echo base_url($enterprise_shortname. '/password-resetlink?log_id='.$author_info->log_id); ?>" class="btn btn-success">Click Here.</a>
                    </p>
                    <!-- <a href='www.samplewebsite.com/reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a> -->
                    
                </div>
            </div>
            <div class="row">
                <div class="welcome_footer">
                    <p>
                        Regards,<br>

                        <a href="https://www.bdtask.com/"> BDtask </a><br>
                        Supports<br>
                        Mobile: +88-01817-584639<br>
                    </p>
                </div>
            </div>
        </div>
    </body>

</html>
