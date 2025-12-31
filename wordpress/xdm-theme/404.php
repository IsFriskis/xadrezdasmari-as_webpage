<?php
/**
 * The template for displaying 404 pages
 *
 * @package XDM_Theme
 */

get_header();
?>

<div class="archive-header">
    <div class="container">
        <h1>Páxina non atopada</h1>
    </div>
</div>

<div class="container">
    <div class="page-content text-center">
        <div style="font-size: 8rem; margin-bottom: 2rem;">♔</div>
        <h2>Erro 404</h2>
        <p class="mb-lg">A páxina que buscas non existe ou foi movida.</p>
        
        <div class="mb-lg">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">Volver ao inicio</a>
        </div>
        
        <div style="max-width: 400px; margin: 0 auto;">
            <h3>Buscar no sitio</h3>
            <?php get_search_form(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
