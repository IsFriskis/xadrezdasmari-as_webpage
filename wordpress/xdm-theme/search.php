<?php
/**
 * The template for displaying search results
 *
 * @package XDM_Theme
 */

get_header();
?>

<div class="archive-header">
    <div class="container">
        <h1>
            <?php
            printf(
                'Resultados da busca: "%s"',
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <p class="archive-description">
            <?php
            global $wp_query;
            printf(
                'Atopáronse %d resultados',
                $wp_query->found_posts
            );
            ?>
        </p>
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
                    <p>A túa busca non deu resultados. Proba con outros termos.</p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
