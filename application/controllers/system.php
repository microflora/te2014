<?php
class System extends CI_Controller
{
	function System() {
		parent::__construct();
		$this->load->dbutil();
	}

	function db_backup() {
		
        // Load the DB utility class
		$this->load->dbutil();
		
		$prefs = array(
                //'tables'      => array('table1', 'table2'),  // Array of tables to backup.
                //'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => "db_backup_".date("Ymd_His").".zip",    // File name - NEEDED ONLY WITH ZIP FILES
                //'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                //'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                //'newline'     => "\n"               // Newline character used in backup file
              );
        
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup($prefs);;
		
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file("backup/db_backup_".date("Ymd_His").".zip", $backup);

		echo "Backup Success!";
	}

}