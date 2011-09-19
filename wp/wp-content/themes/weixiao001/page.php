<?php get_header(); ?>
<!-- theme for PAGE -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
<div class="main">
	<?php the_content('全文...?'); ?>
</div>
<?php endwhile; else: ?>
<?php include (TEMPLATEPATH . '/404.php'); ?>
<?php endif; ?>
<?php get_footer(); ?>
