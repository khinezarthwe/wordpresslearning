<?php 
error_reporting(E_All);
/*
Plugin Name:  KZoption 
Plugin URI:   https://github.com/khinezarthwe
Description:  Collecting CSV file for the user that admin want to collect these user action. Save all the information of specific user to .csv file.

Date:	      20170919
Version:      1.0
Author:       Khine Zar Thwe
Author URI:   https://github.com/khinezarthwe
*/
/*  
/**======================================================================================
* Class for custom functions. <kzt>
*======================================================================================
*/
// function kzoption_style_script() {
// 	wp_enqueue_style( 'kzOptionStyle', plugin_dir_url( __FILE__ ) . '/css/kz_optioncss.css' );
// }
// add_action( 'wp_enqueue_scripts', 'kzoption_style_script' );
if ( !class_exists( 'KZ_Menu' ) ) {
class KZ_Menu 
{

public function __construct()
	{
		$this->kzcustom_menu();
	}

/**============================================================================================
* Custom Menu with add_menu_page action
 parameters are (operation page, name can be seen in admin menu, who can access, path or unique name for weblink, function, icon or logo , position)
*==============================================================================================
*/

public function kzcustom_menu() // add the admin menu
	{ 

		add_menu_page(
			'kz_option.php',
			'kz_menu',
			'administrator',
			__FILE__ ,
			array('KZ_Menu',
				  'display_option_page'),
			'dashicons-products',25);
		
	}
	
/**============================================================================================
* Adding Admin Menu display function 
checking user permission
*==============================================================================================
*/
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
			<?php KZ_Menu::download_fileview(); ?>
		</div>

	<?php  
	}
/**============================================================================================
* Admin .csv file download file via UI
* creating form for submitting
*==============================================================================================
*/
public function download_fileview()
	{ ?>
<form action="" method="POST">
				   <?php 
				   	$users = get_users( $args );
				   		if ($users) 
				   		{ ?>

    						<h3>Select the user that you want to save his or her record with csv file <select name="user_dropdown">
	        					<?php foreach ($users as $user) {
	           						echo '<option value="' .$user->ID .'">' .$user->display_name .'</option>';
	       					 	} ?>
    						</select></h3>
    						<?php $user_id = $_POST['user_dropdown'];	
						}
				   ?>
				   

				    <!-- <input type="checkbox" name="downloadoption[]" id = "downloadoption" value="comments"> Numbers Comments<br>
  					<input type="checkbox" name="downloadoption[]" id = "downloadoption" value="Post"> Post Conent<br>
  					<input type="checkbox" name="downloadoption[]" id = "downloadoption"value="Posttitle" > Post Title<br>
  					<br> -->
				   <input type="submit" name="submit"  class="button button-primary button-large" value="Download the Data" />

				</form>
			<?php
	}



/**============================================================================================
* CSV export function via submit click 
*==============================================================================================
*/
public function kz_csv_export($user_id) 
	{ 	//export function
		die();
		$filename = 'user_' . $user_id . 'data.csv';
		$header_row = array(
					0 => 'Post Title',
					1 => 'Post Content',
					2 => 'Total Comment on this Post',
				);

		$data_rows = array();
		global $wpdb;
		$post_by_user = $wpdb->get_results( "SELECT post_title,post_content,comment_count FROM {$wpdb->posts} WHERE post_author={$user_id}");

		if(!empty($post_by_user)){
 				foreach ( $post_by_user as $u  ) {
					$row = array();
					$row[0] = strip_tags($u->post_title);
					$row[1] = strip_tags($u->post_content);
					$row[2] = strip_tags($u->comment_count);
					$data_rows[] = $row;
				}

		header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
		$fh = fopen('php://output','wb');
		fputcsv($fh, $header_row);
		foreach ( $data_rows as $data_row )
			{
			 	fputcsv($fh,$data_row);

			}
		fclose( $fh );
		die();
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("This user do not have any record in this blog!")';
			echo '</script>';
			
		}
	}

} 
}

//end of class

/**============================================================================================
* Start adding menu to admin view.
*==============================================================================================
*/

add_action('admin_menu', function(){
	new KZ_Menu();
	#KZ_Menu::kzcustom_menu();
});

/**============================================================================================
* Checking Post Submit and download the csv file
*==============================================================================================
*/

if(isset($_POST['submit']))
	{
		KZ_Menu::kz_csv_export($_POST['user_dropdown']);//call the csv_export function by giving user parameter action		   
	} 
?>