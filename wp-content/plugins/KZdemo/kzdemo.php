<?php 
/*
Plugin Name:  KZdemo 
Plugin URI:   https://github.com/khinezarthwe
Description:  Just a demo
Version:      20170915
Author:       Khine Zar Thwe
Author URI:   https://github.com/khinezarthwe
*/

// add_filter('the_title', ucwords);
// add_filter('the_content', function($content){
// 	return $content . ' ' . time();
// });
//  

// add_action('comment_post', function(){
// 	$email = get_bloginfo('admin_email');
// 	wp_mail(
// 		$email,
// 		'New Comment Posted',
// 		'A new comment has been left on your blog.'
// 		);
// });

add_filter('the_content',function($content){
	$id = get_the_id();
	if (!is_singular('post')){
		return $content;
	}
	$terms = get_the_terms($id,'category');
	$cats = array();
	 foreach ($terms as $term){
	 	$cats[] = $term->term_taxonomy_id;
	 }

	 $loop = new WP_Query(
   		array(
  			'posts_per_page' => 3,
  			'category__in'	 => $cats,
  			'orderby'		 => 'rand',
   			'post__not_in' 	 => array($id),
   			)
	 );
	if ($loop->have_posts()){
		$content .= '

		<h2>  You may also like .... </h2>
		<ul class = "related-category-posts">';
		while ($loop->have_posts()){
			$loop->the_post();
			$content .=  '
			<li>
			<a href = "'. get_permalink() . '">' . get_the_title() . '</a> </li>' ;
		}
		$content .= '</ul>';
		wp_reset_query();
	}

	return $content;

});

?>