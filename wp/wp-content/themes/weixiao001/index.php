<?php get_header(); ?>

<div id="left">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post">
<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<div class="main">
	<?php the_content('Read more...?'); ?>
</div>
<div class="meta">
<span class="post_day"><?php the_date(); ?> <?php the_time(); ?> </span> 分类: <?php the_category(' &bull; ') ?> 
 <?php the_tags('Tags: ', ', ', ''); ?> &bull; <?php comments_popup_link('无留言','1 条留言','% 条留言'); ?> <?php edit_post_link(' &mdash; (Edit)'); ?>
</div>

   </div>
    
    <?php if ( comments_open() ) comments_template(); ?>

<?php endwhile; else: ?>
<?php include (TEMPLATEPATH . '/404.php'); ?>
<?php endif; ?>

<div class="navigation_group">
	<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>
</div>

<div id="right">
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

    