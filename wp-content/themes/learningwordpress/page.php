<?php 
get_header();
if (have_posts()):
while (have_posts()) : the_post(); ?>
<article class="post">
	<h2><?php the_title(); ?></h2>
	<?php the_content();?>
</article>

<? endwhile;
 else :
	echo "No content found";
endif;
get_footer();
 ?>