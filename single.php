<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container">
                <?php
                if (has_post_thumbnail()) :
                    the_post_thumbnail('large', array('class' => 'featured-image'));
                endif;
                ?>
                
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?> 