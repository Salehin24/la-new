<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        ?>
    </div>
    <!-- Inline form -->
</div>
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?>
                   
                </h4>

            </div>
            <div class="card-body">
                <div class="result_load">

                    <?php echo form_open_multipart('dashboard/backup_restore/importdata') ?>
                    <div class="form-group row">
                        <label for="file" class="col-sm-3 col-form-label"><?php echo display('db_import') ?></label>
                        <div class="col-sm-5">
                            <input type="file" name="image" class="form-control" placeholder="<?php echo display('import') ?>" id="file" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('db_import') ?></button>
                         </div>
                    </div>

                    
                    <?php echo form_close() ?>

                </div>
            </div>
        </div>
    </div>
</div>