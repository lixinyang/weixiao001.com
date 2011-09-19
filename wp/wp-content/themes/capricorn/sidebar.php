<div id="sidebar">
<!-- This is pointless since it's a one column theme. -->
<h3>Archives</h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>

<h3>Categories</h3>
<ul>
    <?php wp_list_cats(); ?>
</ul>	

<h3>Meta</h3>
<ul>
    <li><?php // wp_register(); ?></li>
    <li><?php wp_loginout(); ?></li>
    <li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">Site Feed</a></li>
    <li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>">Comments Feed</a></li>
    <li><a href="#content" title="back to top">Back to top</a></li>
    <?php wp_meta(); ?>
</ul>

<?php if (function_exists('wp_theme_switcher')) { ?>
<h3>Themes</h3>
<div class="themes">
<?php wp_theme_switcher(); ?>
</div>
<?php } ?>
</div>