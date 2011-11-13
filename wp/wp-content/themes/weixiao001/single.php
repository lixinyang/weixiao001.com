<?php get_header(); ?>
<!-- theme for POST -->
		<div id="left">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<h2><?php the_title(); ?></h2>
				<div class="post_meta">
					<span class="post_day"><?php the_date(); ?> <?php the_time(); ?> </span>
					分类: <?php the_category(' &bull; ') ?>
				</div>

				<div class="entry">
					<?php the_content(); ?>
					<div class="clear"></div>
					<?php wp_link_pages(); ?>
				</div>
				
			</div>

		<?php endwhile; ?>
		<?php endif; ?>
			
		<?php comments_template(); ?>
		</div>
		
		<div id="right">
			<?php get_sidebar(); ?>
		</div>
	<?php get_footer(); ?>	