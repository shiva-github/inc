<?php 

/**
 * 
 */
class dbmanager
{
	function __construct()
	{
		# code...
	}

	function table_create($tablename,$create_table)
	{
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
	}

	function insert_record($table, $user, $data) {
		global $wpdb;
		$table = $wpdb->prefix . $table;
		$var = $wpdb->get_var("SELECT COUNT(*) FROM $table where LoggedUserId=$user;");

		if ( 0 != $var ) {
				$wpdb->update( 
				    $table, 
				    $data, 
				    array( 'LoggedUserId' => $user )
				);
		} else {
			$wpdb->insert( 
				$table, 
				$data
			);
		}
		
		return false;
	}
}

