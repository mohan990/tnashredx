<?php
get_header();
?>

	<main id="primary" class="site-main">
        <div class="container section-padding">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'content-box' ); ?>>
                        <header class="entry-header">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                endwhile;
            else :
                echo '<p>No content found.</p>';
            endif;
            ?>
        </div>
	</main>

<?php
get_footer();
