<?php

if ( ! function_exists( 'tna_gym_setup' ) ) :
	function tna_gym_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'shiny-gym' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'tna_gym_setup' );

function tna_gym_scripts() {
    $theme_version = filemtime( get_stylesheet_directory() . '/style.css' );
	wp_enqueue_style( 'shiny-gym-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'tna_gym_scripts' );

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
		'menu_icon'             => 'dashicons-universal-access', 
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

function tna_gym_seo_tags() {
    global $post;

    if ( is_singular() && ! empty( $post ) ) {
        if ( has_excerpt( $post->ID ) ) {
            $description = wp_strip_all_tags( get_the_excerpt( $post->ID ) );
        } else {
            $description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '...' );
        }
    } elseif ( is_front_page() ) {
        $description = 'TNA - The Notorious Alpha | CrossFit & functional fitness online coach in Bangalore, India. Expert body recomposition, metabolic reset & remote performance coaching by Maheshwaran ChandraMohan — serving clients worldwide.';
    } else {
        $description = get_bloginfo( 'description' );
    }
    $description = esc_attr( $description );

    if ( is_front_page() ) {
        $keywords = 'CrossFit coaching Bangalore, online CrossFit coach India, functional fitness training Bangalore, online personal trainer Bangalore, body recomposition coach India, remote fitness coaching India, fat loss coach Bangalore, metabolic reset program, online fitness transformation India, elite performance coaching, ShredX program, TNA fitness coach, online strength training India, functional fitness coach Bangalore';
    } elseif ( is_singular() && ! empty( $post ) ) {
        $keywords = wp_strip_all_tags( get_the_tags( $post->ID ) ? implode( ', ', wp_list_pluck( get_the_tags( $post->ID ), 'name' ) ) : '' );
    } else {
        $keywords = 'CrossFit Bangalore, online fitness coach India, functional fitness, body recomposition, TNA ShredX';
    }

    $title = esc_attr( wp_get_document_title() );

    $url = esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );

    $og_image = '';
    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) );
    } else {
        $og_image = esc_url( get_template_directory_uri() . '/images/earth_network.png' );
    }

    $og_type = is_singular() ? 'article' : 'website';

    echo '<meta name="description" content="' . $description . '" />' . "\n";
    if ( $keywords ) {
        echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
    }
    echo '<meta name="robots" content="index, follow" />' . "\n";
    echo '<meta name="author" content="Maheshwaran ChandraMohan" />' . "\n";
    echo '<link rel="canonical" href="' . $url . '" />' . "\n";

    echo '<meta name="geo.region" content="IN-KA" />' . "\n";
    echo '<meta name="geo.placename" content="Bangalore, Karnataka, India" />' . "\n";
    echo '<meta name="geo.position" content="12.9716;77.5946" />' . "\n";
    echo '<meta name="ICBM" content="12.9716, 77.5946" />' . "\n";

    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '" />' . "\n";
    echo '<meta property="og:title" content="' . $title . '" />' . "\n";
    echo '<meta property="og:description" content="' . $description . '" />' . "\n";
    echo '<meta property="og:url" content="' . $url . '" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
    echo '<meta property="og:locale" content="en_IN" />' . "\n";
    if ( $og_image ) {
        echo '<meta property="og:image" content="' . $og_image . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
    }

    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:site" content="@tna_shredx" />' . "\n";
    echo '<meta name="twitter:creator" content="@tna_shredx" />' . "\n";
    echo '<meta name="twitter:title" content="' . $title . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . $description . '" />' . "\n";
    if ( $og_image ) {
        echo '<meta name="twitter:image" content="' . $og_image . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tna_gym_seo_tags', 1 );
