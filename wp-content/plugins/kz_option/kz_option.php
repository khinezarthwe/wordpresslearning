<?php 
error_reporting(E_All);
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/*
Plugin Name:  KZoption 
Plugin URI:   https://github.com/khinezarthwe
Description:  Collecting CSV file for the the user that admin want to collect these user action. Save all the information of specific user to .csv file.

Date:	      20170919
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
		
	}

public function kzcustom_menu() // add the admin menu
	{ 
		add_menu_page('kz_option.php', 'kz_menu', 'administrator', __FILE__ ,array('KZ_Menu',
			'display_option_page'),'dashicons-products');
		// parameters are listed as below
		//operation page, name can be seen in admin menu, who can access, path or unique name for weblink, function, icon or logo 
	}
	
	// function for custopm menu display 
public function display_option_page()
	{
		// General check for user permissions.
  		if (!current_user_can('manage_options'))  
  		{
   		 	wp_die( __('You do not have sufficient pilchards to access this page.'));
  		}
		?>
		<div class="container">  
			<h2> <span class="dashicons dashicons-thumbs-up"></span>Hello from Khine Zar Custom Menu Page </h2>
			<h3>You can download the csv file of user custom post.</h3>
				<form action="" method="POST">
				   <?php 
				   	$users = get_users( $args );
				   		if ($users) 
				   		{ ?>
    						<select name="user_dropdown">
	        					<?php foreach ($users as $user) {
	           						echo '<option value="' .$user->ID .'">' .$user->display_name .'</option>';
	       					 	} ?>
    						</select>
    						<?php $user_id = $_POST['user_dropdown'];	
						}
				   ?>
				   <input type="submit" name="submit"  class="button button-primary button-large" value="Download the Data" />
				</form>
		</div>

		<?php // when the form submitted!
			if(isset($_POST['submit']))
				{
					KZ_Menu::kz_csv_export($_POST['user_dropdown']); //call the csv_export function by giving user parameter action		   
				} 
	}

public function kz_csv_export($user_id) 
	{ //export function

		$filename = 'customlist' . time() . '.csv';
		$header_row = array(
					0 => 'Post Title',
					1 => 'Post Content',
				);

		$data_rows = array();
		global $wpdb;
		$post_by_user = $wpdb->get_results( "SELECT post_title,post_content FROM {$wpdb->posts} WHERE post_author={$user_id}");
		#post_by_user = $wpdb->get_results( "SELECT posts->post_title,posts->post_content, FROM {$wpdb->posts} WHERE post_author={$user_id}");
 		foreach ( $post_by_user as $u  ) {
					$row = array();
					$row[0] = $u->post_title;
					$row[1] = $u->post_content;
					$data_rows[] = $row;
				}

		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Type:application/csv;charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . 
        $filename);
        header('Expires: 0');
        header('Pragma: public');
		$fh = fopen('php://output','w');
		fputcsv($fh, $header_row);
		foreach ( $data_rows as $data_row )
			{
			 	fputcsv($fh,$data_row);
			}
		fclose( $fh );
		#die();

	}

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