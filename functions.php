<?php
/**
 * Theme functions and definitions
 */

if ( ! function_exists( 'tna_gym_setup' ) ) :
	function tna_gym_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'shiny-gym' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'tna_gym_setup' );

/**
 * Enqueue scripts and styles.
 */
function tna_gym_scripts() {
    $theme_version = filemtime( get_stylesheet_directory() . '/style.css' );
	wp_enqueue_style( 'shiny-gym-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'tna_gym_scripts' );

/**
 * Register Custom Post Type for Training Sessions
 */
function tna_gym_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Training Sessions', 'Post Type General Name', 'shiny-gym' ),
		'singular_name'         => _x( 'Training Session', 'Post Type Singular Name', 'shiny-gym' ),
		'menu_name'             => __( 'Training Sessions', 'shiny-gym' ),
		'name_admin_bar'        => __( 'Training Session', 'shiny-gym' ),
		'archives'              => __( 'Session Archives', 'shiny-gym' ),
		'attributes'            => __( 'Session Attributes', 'shiny-gym' ),
		'parent_item_colon'     => __( 'Parent Session:', 'shiny-gym' ),
		'all_items'             => __( 'All Sessions', 'shiny-gym' ),
		'add_new_item'          => __( 'Add New Training Session', 'shiny-gym' ),
		'add_new'               => __( 'Add New', 'shiny-gym' ),
		'new_item'              => __( 'New Session', 'shiny-gym' ),
		'edit_item'             => __( 'Edit Session', 'shiny-gym' ),
		'update_item'           => __( 'Update Session', 'shiny-gym' ),
		'view_item'             => __( 'View Session', 'shiny-gym' ),
		'view_items'            => __( 'View Sessions', 'shiny-gym' ),
		'search_items'          => __( 'Search Session', 'shiny-gym' ),
		'not_found'             => __( 'Not found', 'shiny-gym' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'shiny-gym' ),
		'featured_image'        => __( 'Featured Image', 'shiny-gym' ),
		'set_featured_image'    => __( 'Set featured image', 'shiny-gym' ),
		'remove_featured_image' => __( 'Remove featured image', 'shiny-gym' ),
		'use_featured_image'    => __( 'Use as featured image', 'shiny-gym' ),
		'insert_into_item'      => __( 'Insert into session', 'shiny-gym' ),
		'uploaded_to_this_item' => __( 'Uploaded to this session', 'shiny-gym' ),
		'items_list'            => __( 'Sessions list', 'shiny-gym' ),
		'items_list_navigation' => __( 'Sessions list navigation', 'shiny-gym' ),
		'filter_items_list'     => __( 'Filter sessions list', 'shiny-gym' ),
	);
	$args = array(
		'label'                 => __( 'Training Session', 'shiny-gym' ),
		'description'           => __( 'Gym classes and training sessions', 'shiny-gym' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-universal-access', // Adds a cool icon in admin menu
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'training_session', $args );
}
add_action( 'init', 'tna_gym_custom_post_type', 0 );

/**
 * Basic dynamic SEO Tags
 */
function tna_gym_seo_tags() {
    global $post;
    if ( is_singular() ) {
        // Description
        $excerpt = wp_trim_words( $post->post_content, 20, '...' );
        if ( !empty( $excerpt ) ) {
            echo '<meta name="description" content="' . esc_attr( strip_tags( $excerpt ) ) . '" />' . "\n";
        }
    } else {
        echo '<meta name="description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tna_gym_seo_tags', 1 );
