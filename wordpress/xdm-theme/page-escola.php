<?php
/**
 * Template for Clases/Escola page
 * 
 * Template Name: Páxina Escola
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
            
            <h2 class="section-title-left mt-xl">Últimas Publicacións de Formación</h2>
            
            <div class="cards-grid cards-grid-2">
                <?php
                $escola_query = xdm_get_posts_by_category('escola', 4);
                if ($escola_query->have_posts()) :
                    while ($escola_query->have_posts()) : $escola_query->the_post();
                        xdm_post_card(true, true);
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        
        <aside class="sidebar">
            <!-- Info Widget -->
            <div class="widget">
                <h3 class="widget-title">Información</h3>
                <div class="widget-content">
                    <p><strong>📅 Horarios por grupo:</strong></p>
                    <ul class="widget-posts-list">
                        <li class="widget-post-item">
                            <strong>Iniciación ó Xadrez</strong><br>
                            <span class="widget-post-date">Luns de 18:00 a 19:00</span>
                        </li>
                        <li class="widget-post-item">
                            <strong>Adestramento — Nivel III</strong><br>
                            <span class="widget-post-date">Luns de 19:00 a 20:30</span>
                        </li>
                        <li class="widget-post-item">
                            <strong>Xadrez de Iniciación</strong><br>
                            <span class="widget-post-date">Sábado de 10:30 a 11:30</span>
                        </li>
                    </ul>
                    <p class="mt-md"><strong>📍 Lugar:</strong><br>Casa da Cultura de Vila Concepción, Cambre</p>                    
                    <p class="mt-md">
                        <a href="<?php echo esc_url(home_url('/index.php/contact/')); ?>" class="btn">Contactar</a>
                    </p>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
