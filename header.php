<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap">
	<?php if ( ! has_site_icon() ) : ?>
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_theme_file_uri( 'images/favicon.svg' ) ); ?>">
	<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/favicon.ico' ) ); ?>" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_theme_file_uri( 'images/favicon.svg' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <div class="announcement-bar">
        <p>🔥 <strong>Now Enrolling for <?php echo esc_html( date_i18n( 'F Y', strtotime( 'first day of next month' ) ) ); ?></strong>
            <a href="#contact" class="announcement-link">Reserve Your Spot →</a>
        </p>
    </div>

	<header id="masthead" class="site-header">
		<div class="container header-container">
			<div class="site-branding">
                <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <?php if ( is_front_page() ) : ?>
                    <p class="site-branding-title">
                    <?php else : ?>
                    <h1 class="site-branding-title">
                    <?php endif; ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <span class="brand-acronym">TNA</span>
                            <span class="brand-tagline">The Notorious Alpha</span>
                        </a>
                    <?php if ( is_front_page() ) : ?>
                    </p>
                    <?php else : ?>
                    </h1>
                    <?php endif; ?>
                <?php endif; ?>
			</div>



            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle Navigation">
                <span></span><span></span><span></span>
            </button>

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
                    'fallback_cb'    => false,
				) );
				?>
                <?php if ( ! has_nav_menu( 'primary' ) ) :
                    $home = is_front_page() ? '' : esc_url( home_url( '/' ) );
                ?>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo $home; ?>#about-us">About</a></li>
                        <li><a href="<?php echo $home; ?>#programs">Programs</a></li>
                        <li><a href="<?php echo $home; ?>#events">Events</a></li>
                        <li><a href="<?php echo $home; ?>#results">Results</a></li>
                        <li><a href="<?php echo $home; ?>#faq">FAQ</a></li>
                        <li class="nav-cta-item">
                            <a href="<?php echo $home; ?>#contact" class="nav-cta">Apply Now</a>
                        </li>
                    </ul>
                <?php endif; ?>
			</nav>
		</div>

        <div class="limited-badge">
            <div class="badge-string"></div>
            <div class="badge-ribbon">
                <svg class="badge-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M12 1L9 9H1l7 5-3 8 7-5 7 5-3-8 7-5h-8z"/></svg>
                <span class="badge-text">Limited<br>Spots!</span>
            </div>
        </div>
	</header>
