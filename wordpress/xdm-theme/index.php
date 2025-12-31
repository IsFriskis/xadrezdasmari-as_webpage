<?php
/**
 * The main template file
 * Used for blog archive and fallback
 *
 * @package XDM_Theme
 */

get_header();
?>

<div class="archive-header">
    <div class="container">
        <?php if (is_home() && !is_front_page()) : ?>
            <h1><?php single_post_title(); ?></h1>
        <?php elseif (is_category()) : ?>
            <h1><?php single_cat_title(); ?></h1>
            <?php the_archive_description('<p class="archive-description">', '</p>'); ?>
        <?php elseif (is_tag()) : ?>
            <h1>Etiqueta: <?php single_tag_title(); ?></h1>
        <?php elseif (is_author()) : ?>
            <h1>Autor: <?php the_author(); ?></h1>
        <?php elseif (is_date()) : ?>
            <h1>
                <?php
                if (is_day()) {
                    echo get_the_date();
                } elseif (is_month()) {
                    echo get_the_date('F Y');
                } elseif (is_year()) {
                    echo get_the_date('Y');
                }
                ?>
            </h1>
        <?php elseif (is_search()) : ?>
            <h1>Resultados da busca: "<?php echo get_search_query(); ?>"</h1>
        <?php else : ?>
            <h1>Blog</h1>
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
                    <p>Non hai publicacións que amosemos. Proba a buscar outra cousa.</p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>