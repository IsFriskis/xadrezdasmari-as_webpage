<?php
/**
 * Template for contact page with form
 * 
 * Template Name: Páxina de Contacto
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
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
                <!-- Contact information cards -->
                <div class="cards-grid mt-lg" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div class="card">
                        <div class="card-content text-center">
                            <div style="font-size: 2.5rem; margin-bottom: 1rem;">📍</div>
                            <h3>Localización</h3>
                            <p>Casa da Cultura Vila Concepción</p>
                            <p>Praza Vila Concepción, 1</p>
                            <p>15679 Cambre, </p>       
                            <p>A Coruña</p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-content text-center">
                            <div style="font-size: 2.5rem; margin-bottom: 1rem;">📧</div>
                            <h3>Email</h3>
                            <p><a href="mailto:correo@xdm.es">correo@xdm.es</a></p>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-content text-center">
                            <div style="font-size: 2.5rem; margin-bottom: 1rem;">📱</div>
                            <h3>Redes Sociais</h3>
                            <p>Síguenos nas redes</p>
                            <?php xdm_social_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
