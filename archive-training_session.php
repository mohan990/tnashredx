<?php
/**
 * Archive template for Training Sessions
 */

get_header();
?>

	<main id="primary" class="site-main">

        <section class="hero-section hero-small">
            <div class="hero-content">
                <h1>Our Training Sessions</h1>
            </div>
        </section>

        <section class="section-padding">
            <div class="container contact-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <div class="content-box">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div style="margin-bottom: 20px;">
                                    <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:auto; border-radius:3px;')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="btn" style="margin-top: 15px;">View Details</a>
                        </div>
                        <?php
                    endwhile;
                else :
                    echo '<p>No training sessions scheduled at the moment. Check back soon!</p>';
                endif;
                ?>
            </div>
        </section>

	</main>

<?php
get_footer();
