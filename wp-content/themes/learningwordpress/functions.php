<?php 
//linking with .css file and wordpress
function learningWordPress_resources(){
	wp_enqueue_style('style',get_stylesheet_uri());
}
add_action('wp_enqueue_scripts','learningWordPress_resources');


// function calliing have to register in menu
register_nav_menus(array(
	'primary' => __('Primary Menu'),
	'footer'  => __('Footer Menu'),

	));
 ?>