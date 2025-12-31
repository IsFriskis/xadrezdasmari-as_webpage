<?php
/**
 * Template for Xogade page
 * 
 * Template Name: Páxina Xogade
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
    <div class="content-area">
        <div class="main-content">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            
            <h2 class="section-title-left mt-xl">Últimas Actividades en XOGADE</h2>
            
            <div class="cards-grid">
                <?php
                $xogade_query = xdm_get_posts_by_category('xogade', 6);
                if ($xogade_query->have_posts()) :
                    while ($xogade_query->have_posts()) : $xogade_query->the_post();
                        xdm_post_card(false, true);
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="card">
                        <div class="card-image card-placeholder">🏆</div>
                        <div class="card-content">
                            <h3 class="card-title">Próximamente</h3>
                            <p class="card-excerpt">Mantente ao día das actividades de XOGADE.</p>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            
            <div class="text-center mt-lg">
                <a href="<?php echo esc_url(get_category_link(get_category_by_slug('xogade'))); ?>" class="btn">
                    Ver todas as actividades →
                </a>
            </div>
        </div>
        
        <aside class="sidebar">
            <!-- XOGADE Info Widget -->
            <div class="widget">
                <h3 class="widget-title">Que é XOGADE?</h3>
                <div class="widget-content">
                    <p>XOGADE é o programa de promoción do deporte escolar da Xunta de Galicia no que participamos activamente.</p>
                    <p><a href="https://xogade.xunta.gal" target="_blank" rel="noopener" class="btn btn-outline">Visitar XOGADE</a></p>
                </div>
            </div>
            
            <!-- Logos -->
            <div class="widget">
                <h3 class="widget-title">Colaboradores</h3>
                <div class="widget-content text-center">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo-xogade.png'); ?>" alt="XOGADE" style="max-width: 150px; margin: 0 auto 1rem;" onerror="this.style.display='none'">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo-fegaxa.png'); ?>" alt="FEGAXA" style="max-width: 150px; margin: 0 auto;" onerror="this.style.display='none'">
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
