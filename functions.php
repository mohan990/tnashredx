<?php

if ( ! function_exists( 'tna_shredx_setup' ) ) :
	function tna_shredx_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'tna-shredx' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'tna_shredx_setup' );

// Optimised front-page <title> — targets "Gym in Bangalore", "Personal Training", etc.
function tna_shredx_document_title( $title ) {
	if ( is_front_page() ) {
		$title['title']   = 'TNAShredX | Gym in Bangalore | Personal Training & Fitness Center';
		unset( $title['tagline'] );
		unset( $title['site'] );
	}
	return $title;
}
add_filter( 'document_title_parts', 'tna_shredx_document_title' );
add_filter( 'document_title_separator', function() { return '|'; } );

function tna_shredx_scripts() {
    $theme_version = filemtime( get_stylesheet_directory() . '/style.css' );
	wp_enqueue_style( 'tna-shredx-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'tna_shredx_scripts' );

function tna_shredx_custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Training Sessions', 'Post Type General Name', 'tna-shredx' ),
		'singular_name'         => _x( 'Training Session', 'Post Type Singular Name', 'tna-shredx' ),
		'menu_name'             => __( 'Training Sessions', 'tna-shredx' ),
		'name_admin_bar'        => __( 'Training Session', 'tna-shredx' ),
		'archives'              => __( 'Session Archives', 'tna-shredx' ),
		'attributes'            => __( 'Session Attributes', 'tna-shredx' ),
		'parent_item_colon'     => __( 'Parent Session:', 'tna-shredx' ),
		'all_items'             => __( 'All Sessions', 'tna-shredx' ),
		'add_new_item'          => __( 'Add New Training Session', 'tna-shredx' ),
		'add_new'               => __( 'Add New', 'tna-shredx' ),
		'new_item'              => __( 'New Session', 'tna-shredx' ),
		'edit_item'             => __( 'Edit Session', 'tna-shredx' ),
		'update_item'           => __( 'Update Session', 'tna-shredx' ),
		'view_item'             => __( 'View Session', 'tna-shredx' ),
		'view_items'            => __( 'View Sessions', 'tna-shredx' ),
		'search_items'          => __( 'Search Session', 'tna-shredx' ),
		'not_found'             => __( 'Not found', 'tna-shredx' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'tna-shredx' ),
		'featured_image'        => __( 'Featured Image', 'tna-shredx' ),
		'set_featured_image'    => __( 'Set featured image', 'tna-shredx' ),
		'remove_featured_image' => __( 'Remove featured image', 'tna-shredx' ),
		'use_featured_image'    => __( 'Use as featured image', 'tna-shredx' ),
		'insert_into_item'      => __( 'Insert into session', 'tna-shredx' ),
		'uploaded_to_this_item' => __( 'Uploaded to this session', 'tna-shredx' ),
		'items_list'            => __( 'Sessions list', 'tna-shredx' ),
		'items_list_navigation' => __( 'Sessions list navigation', 'tna-shredx' ),
		'filter_items_list'     => __( 'Filter sessions list', 'tna-shredx' ),
	);
	$args = array(
		'label'                 => __( 'Training Session', 'tna-shredx' ),
		'description'           => __( 'Elite training and conditioning protocols', 'tna-shredx' ),
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
add_action( 'init', 'tna_shredx_custom_post_type', 0 );

function tna_shredx_seo_tags() {
    global $post;

    if ( is_singular() && ! empty( $post ) ) {
        if ( has_excerpt( $post->ID ) ) {
            $description = wp_strip_all_tags( get_the_excerpt( $post->ID ) );
        } else {
            $description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '...' );
        }
    } elseif ( is_front_page() ) {
        $description = 'TNAShredX — Top Gym & Fitness Center in Bangalore. Expert Personal Training, Strength & Conditioning, CrossFit, and body recomposition programs. Online coaching worldwide by Maheshwaran ChandraMohan.';
    } else {
        $description = get_bloginfo( 'description' );
    }
    $description = esc_attr( $description );

    if ( is_front_page() ) {
        $keywords = 'Gym in Bangalore, Fitness Center Bangalore, Personal Training Bangalore, Strength and Conditioning Bangalore, CrossFit coaching Bangalore, online personal trainer Bangalore, body recomposition coach India, fat loss coach Bangalore, metabolic reset program, remote fitness coaching India, functional fitness Bangalore, TNAShredX, ShredX program, online strength training India';
    } elseif ( is_singular() && ! empty( $post ) ) {
        $keywords = wp_strip_all_tags( get_the_tags( $post->ID ) ? implode( ', ', wp_list_pluck( get_the_tags( $post->ID ), 'name' ) ) : '' );
    } else {
        $keywords = 'CrossFit Bangalore, online fitness coach India, functional fitness, body recomposition, TNA ShredX';
    }

    $title = esc_attr( wp_get_document_title() );

    if ( is_front_page() ) {
        $url = esc_url( home_url( '/' ) );
    } elseif ( is_singular() ) {
        $url = esc_url( get_permalink() );
    } else {
        $url = esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . strtok( $_SERVER['REQUEST_URI'], '?' ) );
    }

    $og_image = '';
    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) );
    } else {
        $og_image = esc_url( home_url( '/og.jpg' ) );
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
add_action( 'wp_head', 'tna_shredx_seo_tags', 1 );

// Append sitemap URL to WordPress virtual robots.txt
function tna_shredx_robots_txt( $output, $public ) {
	if ( $public ) {
		$output .= "\nSitemap: " . esc_url( home_url( '/sitemap.xml' ) ) . "\n";
	}
	return $output;
}
add_filter( 'robots_txt', 'tna_shredx_robots_txt', 10, 2 );
