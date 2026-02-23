<?php
/**
 * Single template for Training Sessions
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <section class="hero-section hero-small" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)) <?php if (has_post_thumbnail()) { echo ', url(' . get_the_post_thumbnail_url() . ')'; } ?> center/cover no-repeat;">
                <div class="hero-content">
                    <h1><?php the_title(); ?></h1>
                </div>
            </section>

            <section class="section-padding">
                <div class="container content-box" style="max-width: 800px;">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #333;">
                        <a href="<?php echo get_post_type_archive_link( 'training_session' ); ?>" class="btn">Back to All Sessions</a>
                    </div>
                </div>
            </section>
            <?php
        endwhile;
        ?>

	</main>

<?php
get_footer();
