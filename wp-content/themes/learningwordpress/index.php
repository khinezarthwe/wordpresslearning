<?php 
get_header();
if (have_posts()):
while (have_posts()) : the_post(); ?>

<article class="post">
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	posted by <?php the_author(); ?> | Posted in 
	<?php 
		$categories = get_the_category();
		$separator = ", ";
		$output = '';
		if ($categories){
			foreach ($categories as $category) {
				$output .= '<a href = "' . get_category_link($category->term_id)  . '">' . $category->cat_name . '</a>' . $separator;
			}

			echo trim($output,$separator);
		}

	 ?>
	<?php the_content();?>
</article>

<? endwhile;
 else :
	echo "No content found";
endif;
get_footer();
 ?>