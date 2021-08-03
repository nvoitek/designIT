<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package designIT
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if (is_active_sidebar('sidebar-footer')) { ?>
			<ul id="sidebar">
				<?php dynamic_sidebar('sidebar-footer'); ?>
			</ul>
		<?php } ?>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>