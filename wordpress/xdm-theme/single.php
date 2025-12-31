<?php
/**
 * The template for displaying single posts
 *
 * @package XDM_Theme
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <header class="single-post-header">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <div class="post-categories">
                            <?php foreach ($categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.85rem;">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1><?php the_title(); ?></h1>
                    
                    <div class="single-post-meta">
                        <span class="post-date">📅 <?php echo xdm_format_date(); ?></span>
                        <span class="post-author">✍️ <?php the_author(); ?></span>
                        <?php if (get_comments_number() > 0) : ?>
                            <span class="post-comments">💬 <?php comments_number('0 comentarios', '1 comentario', '% comentarios'); ?></span>
                        <?php endif; ?>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post-thumbnail">
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
                // Post tags
                $tags = get_the_tags();
                if ($tags) :
                ?>
                    <div class="post-tags mt-lg">
                        <strong>Etiquetas:</strong>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag">
                                #<?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Post Navigation -->
                <nav class="post-navigation">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="nav-previous">
                            <span class="nav-label">← Anterior</span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                        </a>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-next" style="text-align: right;">
                            <span class="nav-label">Seguinte →</span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                        </a>
                    <?php endif; ?>
                </nav>
                
                <?php
                // Comments
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>