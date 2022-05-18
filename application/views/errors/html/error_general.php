<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = load_class('Config')->config['base_url'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Error</title>
        <link href="<?php echo $base_url . 'assets/dist/css/errorstyle.css'; ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="container">
            <h1><?php echo html_escape($heading); ?></h1>
            <?php echo htmlspecialchars_decode($message); ?>
        </div>
    </body>
</html>