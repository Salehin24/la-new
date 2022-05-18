<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = load_class('Config')->config['base_url'];
?>
<link href="<?php echo $base_url . 'assets/dist/css/errorstyle.css'; ?>" rel="stylesheet" type="text/css"/>

<div class="err_php_div">
    <h4>A PHP Error was encountered</h4>

    <p>Severity: <?php echo html_escape($severity); ?></p>
    <p>Message:  <?php echo htmlspecialchars_decode($message); ?></p>
    <p>Filename: <?php echo html_escape($filepath); ?></p>
    <p>Line Number: <?php echo html_escape($line); ?></p>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

        <p>Backtrace:</p>
        <?php foreach (debug_backtrace() as $error): ?>

            <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                <p style="margin-left:10px">
                    File: <?php echo html_escape($error['file']) ?><br />
                    Line: <?php echo html_escape($error['line']) ?><br />
                    Function: <?php echo html_escape($error['function']) ?>
                </p>

            <?php endif ?>

        <?php endforeach ?>

    <?php endif ?>

</div>