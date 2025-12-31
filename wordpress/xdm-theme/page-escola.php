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
            
            <!-- Courses/Classes Cards -->
            <div class="cards-grid mt-xl" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                <div class="card">
                    <div class="card-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">👶</div>
                        <h3>Iniciación</h3>
                        <p>Para nenos e nenas a partir de 5 anos que queren aprender as bases do xadrez.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📈</div>
                        <h3>Perfeccionamento</h3>
                        <p>Para xogadores que xa coñecen as regras e queren mellorar o seu nivel.</p>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
                        <h3>Competición</h3>
                        <p>Adestramento para xogadores que participan en torneos e competicións.</p>
                    </div>
                </div>
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
                    <p><strong>📅 Horarios:</strong><br>Luns a Venres</p>
                    <p><strong>📍 Lugar:</strong><br>As Mariñas, Galicia</p>
                    <p><strong>👥 Idades:</strong><br>Desde 5 anos</p>
                    <p class="mt-md">
                        <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn">Contactar</a>
                    </p>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
