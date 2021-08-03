<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package designIT
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function designit_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'designit_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function designit_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'designit_pingback_header' );

/**
 * Custom post types
 */

 function custom_post_services() {
	register_post_type('service',
		array(
			'labels' => array(
				'name' => __('Services', 'designit'),
				'singular_name' => __('Service', 'designit'),
			),
			'public' => true,
			'show-in-rest' => true,
			'supports' => array ('title', 'editor', 'thumbnail'),
			)
		);
 }

 add_action( 'init', 'custom_post_services' );

 /**
  * Services shortcode
  */

function register_services_shortcode() {
	ob_start();
	?>

	<div class="services container">
		<?php 
			$the_query = new WP_Query(array(
				'post_type' => 'service',
			));
			?>

			<div class="row">

			<?php
			while ($the_query->have_posts()):
				$the_query->the_post(); 
				?>

				<div class="service">
					<div class="service-thumbnail">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'large'); ?>
					</div>
					<?php the_content(); ?>
				</div>

			<?php endwhile; ?>

			</div>
	</div>

	<?php
	wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'services', 'register_services_shortcode' );

/**
 * Font Awesome
 */

function load_fa() {
	wp_enqueue_script('fa-scripts', 'https://kit.fontawesome.com/8aeb714f6e.js', array(), "1.0.0", true);
}
add_action('wp_enqueue_scripts', 'load_fa');


/**
 * Sidebar
 */

function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'designit' ),
        'id'            => 'sidebar-footer',
        'description'   => __( 'Widgets in this area will be shown in footer.', 'designit' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );