<?php 
/*
Plugin Name:  KZdemo 
Plugin URI:   https://github.com/khinezarthwe
Description:  Just a demo
Version:      20170915
Author:       Khine Zar Thwe
Author URI:   https://github.com/khinezarthwe
*/

add_filter('the_title', ucwords);
add_filter('the_content', function($content){
	return $content . ' ' . time();
});
 ?>