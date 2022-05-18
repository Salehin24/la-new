<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Bdtask Ltd
    # Author link: https://www.bdtask.com/
    # Dynamic style php file
    # Developed by :Isahaq
    #------------------------------------    

class Backup_restore extends MX_Controller {

    private $savePath = "assets/data/backup/";
    private $fileName = "backup.sql";

    public function __construct() {
        parent::__construct();
    }



    public function process() 
    {
        $input = $this->input->post('input',TRUE);
        if ($input == 1) {
            if ($this->backup()) {
                $data['success'] = display('backup_successfully');
            } else {
                $data['error']   = display('please_try_again');
            }
        }

        if ($input == 2) {
            if ($this->restore()) {
                $data['success'] = display('restore_successfully');
            } else {
                $data['error']   = display('please_try_again');
            }
        }

        echo json_encode($data);
    }

    public function checkBackup() 
    {
        if (file_exists($this->savePath . $this->fileName)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkFileInfo()
     {
        if (file_exists($this->savePath . $this->fileName)) {
            $info = get_file_info($this->savePath . $this->fileName);
            return ( array(
                'name' => $info['name'],
                'size' => number_format($info['size'] / 1024, 2) . " KB (" . $info['size'] . " bytes)",
                'date' => date('Y-m-d H:i', $info['date']) . ' (' . $this->timeAgo($info['date']) . ')'
            ));
        } else {
            return false;
        }
    }

    public function backup() 
    {
        $this->load->helper('file');
        $this->load->dbutil();

        $prefs = array(
            'format'     => 'txt',
            'add_drop'   => TRUE,
            'add_insert' => TRUE,
            'newline'    => "\n"
        );

        $backup = $this->dbutil->backup($prefs);

        if (write_file($this->savePath . $this->fileName, $backup)) {
            return true;
        } else {
            return false;
        }
    }

    public function restore()
     {
        $isi_file     = file_get_contents($this->savePath . $this->fileName);
        $string_query = rtrim($isi_file, "\n;");
        $array_query  = explode(";", $string_query);
        foreach ($array_query as $query) {
            $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
            $this->db->query($query);
            $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
        }
        if (@unlink($this->savePath . $this->fileName)) {
            return true;
        } else {
            return false;
        }
    }

    public function download() 
    {  
        $db_name = 'backup' . '.sql';

        $this->load->dbutil();
        $prefs = array(
            'format'   => 'sql',
            'filename' => 'backup.sql');
        $b         = $this->dbutil->backup($prefs);
        $save      = 'assets/data/backup/' . $db_name;
        $this->load->helper('file');
        $username = $this->db->username;
        //----- Removing Security Hash FROM CREATE VIEW Queries
        $backup =  $b;
        //----- Commenting INSERT queries FOR VIEWS

       
        write_file($save, $backup);

         $this->session->set_flashdata('message', 'Back Up Successfully Completed');
         redirect($_SERVER['HTTP_REFERER']);
    }



        public function download_backup()
         {
        $db_name = 'backup' . '.sql';

        $this->load->dbutil();
        $prefs = array(
            'format'   => 'sql',
            'filename' => 'backup.sql');
        $b         = $this->dbutil->backup($prefs);
        $save      = 'assets/data/backup/' . $db_name;
        $this->load->helper('file');
        $username = $this->db->username;
        //----- Removing Security Hash FROM CREATE VIEW Queries
        $backup =  $b;
        //----- Commenting INSERT queries FOR VIEWS

       
        write_file($save, $backup);

        
        $this->load->helper('download');
        force_download('./assets/data/backup/' . $db_name, NULL);

    }



    public function delete() 
    {
        if (file_exists($this->savePath . $this->fileName)) {
            if (@unlink($this->savePath . $this->fileName)) {
                $this->session->set_flashdata('message', display('delete_successfully'));
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

 
// import form
    public function import_form()
    {
    $data['title']     = display('db_import');
    $data['module']    = "dashboard";  
    $data['page']      = "backup_restore/import";  
    echo Modules::run('template/layout', $data); 
  }
  // import database
  public function importdata() 
  {

   
    $hostname = $this->db->hostname;
    $username = $this->db->username;
    $password = $this->db->password;
    $database = $this->db->database;

     @$mysqli = new \mysqli(
            $hostname,
            $username,
            $password,
            $database
        );

        // Check for errors
        if (mysqli_connect_errno()){
            echo 'fail to connect';
            return false;
       }

 
            if ($_FILES['image']['name']) {
            $config['upload_path'] = './assets/dbimport/';
            $config['allowed_types'] = '*';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = true;
      
            $this->load->library('upload', $config);
          
            if (!$this->upload->do_upload('image')) {
                
                // $error = array('error' => $this->upload->display_errors());
                $error = $this->upload->display_errors();
                // $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                $this->session->set_flashdata('file_uploaderror', $error);
                redirect(base_url(enterpriseinfo()->shortname. '/db_import'));
            } else {
               
                $file     = $this->upload->data();
                $file_url = base_url() . "assets/dbimport/" . $file['file_name'];
            
            }
        }


       $tables = $this->db->list_tables();
   
foreach ($tables as $table)
{
   
   $this->db->truncate($table);
}
    $templine = '';
    // Read in entire file
    $lines = file($file_url);
    foreach($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current templine we are creating
        $templine.=$line;

        // If it has a semicolon at the end, it's the end of the query so can process this templine
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $this->db->query($templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }

$this->session->set_flashdata('message', 'Successfully Imported');
 redirect($_SERVER['HTTP_REFERER']);


    }

// Restore form
    public function restore_form()
    {
    $data['title']     = display('restore');
    
    $data['module']    = "dashboard";  
    $data['page']      = "backup_restore/restore_form";  
    echo Modules::run('template/layout', $data); 
  }

    // Data Restore 
    public function Data_backup() 
      {
    $hostname = $this->db->hostname;
    $username = $this->db->username;
    $password = $this->db->password;
    $database = $this->db->database;

     @$mysqli = new \mysqli(
            $hostname,
            $username,
            $password,
            $database
        );

        // Check for errors
        if (mysqli_connect_errno()){
            echo 'fail to connect';
            return false;
       }
        

$file_url = base_url() . "assets/data/backup/default.sql";
       $tables = $this->db->list_tables();

foreach ($tables as $table)
{
   
   $this->db->truncate($table);
}
    $templine = '';
    // Read in entire file
    $lines = file($file_url);
    foreach($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current templine we are creating
        $templine.=$line;

        // If it has a semicolon at the end, it's the end of the query so can process this templine
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $this->db->query($templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
    //   $this->session->set_userdata(array('message' => 'Successfully Restored '));
    //   redirect(base_url('logout'));
    // $this->session->set_flashdata('message', 'Successfully Restored');
    $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Successfully Restored!</div>");
    redirect($_SERVER['HTTP_REFERER']);
    }
}