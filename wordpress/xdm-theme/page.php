<?php
/**
 * The template for displaying pages
 *
 * @package XDM_Theme
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-content">
        <?php if (has_post_thumbnail()) : ?>
            <div class="single-post-thumbnail mb-lg">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        
        <div class="entry-content">
            <?php
            the_content();
            
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">Páxinas:</span>',
                'after'  => '</div>',
            ));
            ?>
        </div>
        
        <?php
        // Comments for pages (if enabled)
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>
    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
