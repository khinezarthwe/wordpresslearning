<?php 

/*
	Template Name: Special Layout
*/
get_header();
if (have_posts()):
while (have_posts()) : the_post(); ?>

<article class="post">
	<?php the_content();?>
</article>

<? endwhile;
 else :
	echo "No content found";
endif;
get_footer();
 ?>