<?php
/**
 * Template for displaying category archives
 *
 * @package XDM_Theme
 */

get_header();

$category = get_queried_object();
?>

<div class="archive-header">
    <div class="container">
        <h1><?php single_cat_title(); ?></h1>
        <?php if (category_description()) : ?>
            <p class="archive-description"><?php echo category_description(); ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="content-area">
        <div class="main-content">
            <?php if (have_posts()) : ?>
                <div class="cards-grid">
                    <?php
                    while (have_posts()) : the_post();
                        xdm_post_card(false, true);
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
