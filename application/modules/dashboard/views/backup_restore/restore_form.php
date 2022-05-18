<div class="row">
       <!-- Form controls -->
       <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        if ($error != '') {
            echo $error;
            unset($_SESSION['success']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['error']);
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

                       <?php echo form_open_multipart('dashboard/backup_restore/Data_backup') ?>
                       <div class="form-group row">
                           <div class="col-sm-12">
                               <center>
                                   <h3> If You want to Restore your database . Please click on confirm button.</h3>
                                   <p class="text-danger"> It will delete all your data from your database !!</p>
                               </center>
                           </div>
                       </div>

                       <div class="form-group text-center">
                           <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-danger w-md m-b-5"><?php echo display('cancel') ?></a>
                           <button type="submit" onclick="return confirm('Are you Sure to Restore Your Database ??')" class="btn btn-success w-md m-b-5"><?php echo display('confirm') ?></button>
                       </div>
                       <?php echo form_close() ?>
                   </div>
               </div>
           </div>
       </div>
   </div>