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

// Optimised <title>: brand-led on the front page for keywords, and the TNAShredX
// brand appended to every other page's own title so the tab reads consistently.
function tna_shredx_document_title( $title ) {
	if ( is_front_page() ) {
		// "Online" leads because the coaching is remote-first and that is the
		// higher-intent query; Bangalore stays for local/Maps relevance. Kept
		// under ~60 chars so Google does not truncate it in results.
		$title['title']   = 'TNAShredX | Online Gym and Personal Training | Bangalore';
		unset( $title['tagline'] );
		unset( $title['site'] );
	} else {
		// Keep the page's own title (good for SEO), but force the site name to the brand.
		$title['site'] = 'TNAShredX';
		unset( $title['tagline'] );
	}
	return $title;
}
add_filter( 'document_title_parts', 'tna_shredx_document_title' );
add_filter( 'document_title_separator', function() { return '|'; } );

function tna_shredx_scripts() {
	// Root style.css holds only the theme header; enqueue it so WordPress
	// registers the theme stylesheet, then load the real styles from styles/main.css.
	$theme_version = filemtime( get_stylesheet_directory() . '/style.css' );
	wp_enqueue_style( 'tna-shredx-style', get_stylesheet_uri(), array(), $theme_version );

	$main_css_path = get_stylesheet_directory() . '/styles/main.css';
	if ( file_exists( $main_css_path ) ) {
		wp_enqueue_style(
			'tna-shredx-main',
			get_stylesheet_directory_uri() . '/styles/main.css',
			array( 'tna-shredx-style' ),
			filemtime( $main_css_path )
		);
	}
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
        $description = 'TNAShredX by The Notorious Alpha — an online gym and personal training studio for fat loss, strength and body recomposition. Based in Bangalore, coaching clients worldwide.';
    } else {
        $description = get_bloginfo( 'description' );
    }
    $description = esc_attr( $description );

    if ( is_front_page() ) {
        // Brand, then programs, then events/credentials, then the generic
        // gym/online head terms and the Bangalore long tail.
        $keywords = 'TNA ShredX, TNAShredX, TNA ShredX gym, TNAShredX gym, TNA gym, TNA ShredX Bangalore, TNAShredX online gym, '
            . 'ShredX gym, The Notorious Alpha, TNA The Notorious Alpha, Notorious Alpha gym, Maheshwaran ChandraMohan, '
            . 'ShredX, ShredX program, Nomad X, TNA Tribe, TNAs Tribe, 1-on-1 Elite Coaching, Direct Bio-Sync, Bio-Sync coaching, '
            . 'Alpha Circuit, Alpha Circuit obstacle race, CrossFit competitions Bangalore, Powerlifting championships Bangalore, '
            . 'online gym, 100% online gym, gym, virtual gym, online gym India, online personal training, online fitness coaching, '
            . 'Gym in Bangalore, Fitness Center Bangalore, Personal Training Bangalore, Strength and Conditioning Bangalore, '
            . 'CrossFit coaching Bangalore, online personal trainer Bangalore, body recomposition coach India, fat loss coach Bangalore, '
            . 'metabolic reset program, remote fitness coaching India, functional fitness Bangalore, online strength training India';
    } elseif ( is_singular() && ! empty( $post ) ) {
        $keywords = wp_strip_all_tags( get_the_tags( $post->ID ) ? implode( ', ', wp_list_pluck( get_the_tags( $post->ID ), 'name' ) ) : '' );
    } else {
        $keywords = 'The Notorious Alpha, TNAShredX, TNA ShredX, online gym, CrossFit Bangalore, online fitness coach India, functional fitness, body recomposition';
    }

    $title = esc_attr( wp_get_document_title() );

    if ( is_front_page() ) {
        $url = esc_url( home_url( '/' ) );
    } elseif ( is_singular() ) {
        $url = esc_url( get_permalink() );
    } else {
        // Build from home_url(), never $_SERVER['HTTP_HOST']. Using the request
        // host makes www. and non-www. each self-canonicalise, which splits the
        // page into two competing URLs in Google's index (separate favicons,
        // split link equity). home_url() always emits the one canonical host.
        $path = strtok( $_SERVER['REQUEST_URI'], '?' );
        $url  = esc_url( home_url( $path ) );
    }

    // Resolve a share image and its real dimensions. Never hardcode 1200x630 —
    // wrong dimensions make Facebook/X skip the image entirely.
    $og_image  = '';
    $og_width  = '';
    $og_height = '';

    if ( is_singular() && has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        if ( $thumb ) {
            $og_image  = esc_url( $thumb[0] );
            $og_width  = (int) $thumb[1];
            $og_height = (int) $thumb[2];
        }
    }

    // Fall back to the WordPress Site Icon, then to the brand mark. The previous
    // /og.jpg fallback pointed at a file that does not exist.
    if ( ! $og_image && has_site_icon() ) {
        $og_image  = esc_url( get_site_icon_url( 512 ) );
        $og_width  = 512;
        $og_height = 512;
    }
    if ( ! $og_image ) {
        $og_image = 'https://tnashredx.com/wp-content/uploads/2026/07/shredX.webp';
    }

    $og_type = is_singular() ? 'article' : 'website';

    echo '<meta name="description" content="' . $description . '" />' . "\n";
    if ( $keywords ) {
        echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";
    }
    // Thin/utility views must not be indexed (guide §10). Everything else gets
    // the rich-preview directives Google honours for image-heavy pages.
    if ( is_search() || is_404() ) {
        echo '<meta name="robots" content="noindex, follow" />' . "\n";
    } else {
        echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />' . "\n";
    }
    echo '<meta name="author" content="Maheshwaran ChandraMohan" />' . "\n";
    echo '<meta name="theme-color" content="#0a0a1a" />' . "\n";
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
        if ( $og_width && $og_height ) {
            echo '<meta property="og:image:width" content="' . $og_width . '" />' . "\n";
            echo '<meta property="og:image:height" content="' . $og_height . '" />' . "\n";
        }
        echo '<meta property="og:image:alt" content="' . $title . '" />' . "\n";
    }

    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:site" content="@tna_shredx" />' . "\n";
    echo '<meta name="twitter:creator" content="@tna_shredx" />' . "\n";
    echo '<meta name="twitter:title" content="' . $title . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . $description . '" />' . "\n";
    if ( $og_image ) {
        echo '<meta name="twitter:image" content="' . $og_image . '" />' . "\n";
        echo '<meta name="twitter:image:alt" content="' . $title . '" />' . "\n";
    }
}
add_action( 'wp_head', 'tna_shredx_seo_tags', 1 );

// Renders a status message using the theme's success/error styling.
function tna_shredx_form_notice( $type, $text ) {
	if ( $type === 'success' ) {
		$style = 'color: #25d366; background: rgba(37, 211, 102, 0.1);';
	} else {
		$style = 'color: var(--primary-color); background: rgba(204, 41, 54, 0.1);';
	}
	return '<p style="' . $style . ' padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">' . esc_html( $text ) . '</p>';
}

// Hidden honeypot + off-screen styling. Real users and screen readers never see or reach it.
function tna_shredx_honeypot_field() {
	return '<div aria-hidden="true" style="position:absolute; left:-9999px; top:-9999px; height:0; overflow:hidden;">'
		. '<label for="tna_website">Leave this field empty</label>'
		. '<input type="text" id="tna_website" name="tna_website" tabindex="-1" autocomplete="off" value="">'
		. '</div>';
}

/**
 * Shared spam guard for the theme's contact forms.
 *
 * Runs nonce → honeypot → throttle before any mail is attempted. Returns an array:
 *   ['proceed' => bool, 'status' => string]
 * When 'proceed' is false the caller must render 'status' and skip wp_mail().
 * A tripped honeypot returns proceed=false with a fake success message so bots
 * cannot tell they were caught.
 */
function tna_shredx_guard_submission() {
	// CSRF: reject anything without a valid, current nonce.
	if ( ! isset( $_POST['tna_contact_nonce'] ) || ! wp_verify_nonce( $_POST['tna_contact_nonce'], 'tna_contact_form' ) ) {
		return array(
			'proceed' => false,
			'status'  => tna_shredx_form_notice( 'error', '✘ Security check failed. Please refresh the page and try again.' ),
		);
	}

	// Honeypot: a filled tna_website field means a bot. Show fake success, discard silently.
	if ( ! empty( $_POST['tna_website'] ) ) {
		return array(
			'proceed' => false,
			'status'  => tna_shredx_form_notice( 'success', '✔ Thank you for contacting us. We\'ll get back to you soon.' ),
		);
	}

	// Throttle: one submission per IP per minute, set before mail so retries can't flood.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'tna_form_' . md5( $ip );
	if ( $ip && get_transient( $key ) ) {
		return array(
			'proceed' => false,
			'status'  => tna_shredx_form_notice( 'error', '✘ Please wait a minute before sending another message.' ),
		);
	}
	if ( $ip ) {
		set_transient( $key, 1, MINUTE_IN_SECONDS );
	}

	return array( 'proceed' => true, 'status' => '' );
}

// Append sitemap URL to WordPress virtual robots.txt
function tna_shredx_robots_txt( $output, $public ) {
	if ( $public ) {
		// Core serves its sitemap index at /wp-sitemap.xml — the previous
		// /sitemap.xml only resolves if an SEO plugin creates it.
		$sitemap = function_exists( 'get_sitemap_url' )
			? get_sitemap_url( 'index' )
			: home_url( '/wp-sitemap.xml' );
		$output .= "\nSitemap: " . esc_url( $sitemap ) . "\n";
	}
	return $output;
}
add_filter( 'robots_txt', 'tna_shredx_robots_txt', 10, 2 );

// BreadcrumbList JSON-LD on inner pages (guide §7). The front page is excluded —
// a single-item breadcrumb carries no value and Google ignores it.
function tna_shredx_breadcrumb_schema() {
	if ( is_front_page() || is_404() || is_search() ) {
		return;
	}

	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => 'Home',
			'item'     => home_url( '/' ),
		),
	);

	if ( is_singular() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => wp_strip_all_tags( get_the_title() ),
			'item'     => get_permalink(),
		);
	} elseif ( is_post_type_archive() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => wp_strip_all_tags( post_type_archive_title( '', false ) ),
			'item'     => get_post_type_archive_link( get_post_type() ),
		);
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => wp_strip_all_tags( single_term_title( '', false ) ),
			'item'     => get_term_link( get_queried_object() ),
		);
	}

	// Only Home resolved — nothing worth emitting.
	if ( count( $items ) < 2 ) {
		return;
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);

	echo "\n" . '<script type="application/ld+json">'
		. wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		. '</script>' . "\n";
}
add_action( 'wp_head', 'tna_shredx_breadcrumb_schema', 2 );
