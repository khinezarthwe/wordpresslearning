<?php 
/*
Plugin Name:  KZoption 
Plugin URI:   https://github.com/khinezarthwe
Description:  Collecting CSV file for the the user that admin want to collect these user action. Save all the information of specific user to .csv file.
Date:	      20170918
Version:      1.0
Author:       Khine Zar Thwe
Author URI:   https://github.com/khinezarthwe
*/

/**============================================================================================
* Class for custom functions. <kzt>
*==============================================================================================
*/
class KZ_Menu 
{
	
	public function __construct()
	{
		# code...
	}

	public function kzcustom_menu() // add the admin menu
	{ 
		add_menu_page('kz_option.php', 'kz_menu', 'administrator', __FILE__,array('KZ_Menu',
			'display_option_page'),'dashicons-products');
		// parameters are listed as below
		//operation page, name can be seen in admin menu, who can access, path or unique name for weblink, function, icon or logo 

	}

	// function for custopm menu display 
	public function display_option_page()
	{
		?>
		  	<div class="container">  	
				<h2><span class="dashicons dashicons-groups"></span>hello from KZ custom menu</h2>
				<form method="POST" action="kz_option.php">
					
				</form>
			</div>
		<?php 
	}

	function kz_csv_export() 
	{ //export function

			if ( ! is_super_admin() ) {
				return;
			}
			if ( ! isset( $_GET['bbg_export'] ) ) {
				return;
			}

			$filename = 'customlist' . time() . '.csv';
			
				$header_row = array(
					0 => 'Display Name',
					1 => 'Email',
				);

			$data_rows = array();
			global $wpdb, $bp;
			$users = $wpdb->get_results( "SELECT ID, user_email, user_registered FROM {$wpdb->users} WHERE user_status = 0" );
			foreach ( $users as $u ) {
				$row = array();
				$row[0] = bp_core_get_user_displayname( $u->ID );
				$row[1] = $u->user_email;
				$row[2] = xprofile_get_field_data( 2, $u->ID );
				$row[3] = $u->user_registered;
				$data_rows[] = $row;
			}
			$fh = @fopen( 'php://output', 'w' );
			fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Description: File Transfer' );
			header( 'Content-type: text/csv' );
			header( "Content-Disposition: attachment; filename={$filename}" );
			header( 'Expires: 0' );
			header( 'Pragma: public' );
			fputcsv( $fh, $header_row );
			foreach ( $data_rows as $data_row ) {
				fputcsv( $fh, $data_row );
			}
			fclose( $fh );
			die();
	}
add_action( 'admin_init', 'bbg_csv_export' );




} 


//end of class

/**============================================================================================
* Start adding menu to admin view.
*==============================================================================================
*/

add_action('admin_menu', function(){
	KZ_Menu::kzcustom_menu();
});


?>