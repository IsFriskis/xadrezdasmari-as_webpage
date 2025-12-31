<?php
/**
 * The template for displaying archive pages
 *
 * @package XDM_Theme
 */

get_header();
?>

<div class="archive-header">
    <div class="container">
        <?php
        the_archive_title('<h1>', '</h1>');
        the_archive_description('<p class="archive-description">', '</p>');
        ?>
    </div>
</div>

<div class="container">
    <div class="content-area">
        <div class="main-content">
            <?php if (have_posts()) : ?>
                <div class="cards-grid">
                    <?php
                    while (have_posts()) : the_post();
                        xdm_post_card(true, true);
                    endwhile;
                    ?>
                </div>
                
                <nav class="pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '← Anterior',
                        'next_text' => 'Seguinte →',
                    ));
                    ?>
                </nav>
            <?php else : ?>
                <div class="no-results">
                    <h2>Non se atoparon resultados</h2>
                    <p>Non hai publicacións nesta categoría.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
