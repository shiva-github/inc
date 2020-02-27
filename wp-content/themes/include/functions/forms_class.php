<?php 

/**
 * 
 */
class dbmanager
{
	const logFile = 'log.txt';
	function __construct()
	{
		# code...
	}

	function table_create($tablename,$create_table)
	{
		try {
			global $wpdb;
			global $jal_db_version;
			$table_name = $wpdb->prefix . $tablename;
			$charset_collate = $wpdb->get_charset_collate();
			$sql1 = "CREATE TABLE IF NOT EXISTS `$table_name` (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			";
			$sql2 = '';
			foreach ($create_table as $key => $value) {
				if($value == 'input_text') {
					$sql2 .= $key . ' ' . 'text,';
				}
				if($value == 'input_number') {
					$sql2 .= $key . ' ' . 'int,';
				}

				if($value == 'input_textarea') {
					$sql2 .= $key . ' ' . 'text,';
				}
				if($value == 'checkbox') {
					$sql2 .= $key . ' ' . 'int(2),';
				}
			}
			$sql3 = " created_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, updated_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, PRIMARY KEY  (id) ) $charset_collate;";
			$sql = $sql1 . $sql2 . $sql3;

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
			add_option( 'jal_db_version', $jal_db_version );
		} catch(Exception $e) {
			create_logs('Error', $e);
		}		
	}

	function insert_record($table, $user, $data) {
		try {
			global $wpdb;
			$table1 = $wpdb->prefix . $table;
			$query = "SELECT COUNT(*) FROM " . $table1 ." where LoggedUserId=" . $user . ';';
			$var = $wpdb->get_var($query);
			
			if ( 0 != $var ) {
				unset($data['created_time']);
				$wpdb->update( 
					$table1, 
					$data, 
					array( 'LoggedUserId' => $user )
				);

			} else {
				$wpdb->insert( 
					$table1, 
					$data
				);
			}

			return false;
		} catch(Exception $e) {
			create_logs('Error', $e);
		}
	}



	function fetch_form_data_from_table($table, $userid) {
		try {
			global $wpdb;
			$table = $wpdb->prefix . $table;

			$res = $wpdb->get_results( 'SELECT * FROM ' . $table . ' WHERE LoggedUserId=' . $userid );
			
			return $res;
		} catch(Exception $e) {
			create_logs('Error', $e);
		}
	}

	function create_logs($type, $err) {
		$message = '[' . date() . '] ' . $type . ' ' . json_encode($err);
		$myFile = $this->logFile;
		if (file_exists($myFile)) {
			$fh = fopen($myFile, 'a');
			fwrite($fh, $message . "\n");
		} else {
			$fh = fopen($myFile, 'w');
			fwrite($fh, $message . "\n");
		}
		fclose($fh);
	}
}

