<?php
/**
 * Template for Torneos page
 * 
 * Template Name: Páxina Torneos
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

<div class="container">
    <div class="content-area no-sidebar">
        <div class="main-content">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            
            <h2 class="section-title-left mt-xl">Próximos Torneos</h2>
            
            <div class="cards-grid">
                <?php
                $torneos_query = xdm_get_posts_by_category('torneos', 6);
                if ($torneos_query->have_posts()) :
                    while ($torneos_query->have_posts()) : $torneos_query->the_post();
                        xdm_post_card(true, true);
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="card">
                        <div class="card-image card-placeholder">🏆</div>
                        <div class="card-content">
                            <h3 class="card-title">Próximamente</h3>
                            <p class="card-excerpt">Estamos preparando novos torneos. Mantente ao día!</p>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            
            <div class="text-center mt-lg">
                <a href="<?php echo esc_url(get_category_link(get_category_by_slug('torneos'))); ?>" class="btn">
                    Ver todos os torneos →
                </a>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
