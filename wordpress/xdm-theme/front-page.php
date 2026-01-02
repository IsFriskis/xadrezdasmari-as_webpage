
<?php
/**
 * Template Name: Páxina Principal
 * The template for the homepage
 *
 * @package XDM_Theme
 */

get_header();

// Get customizer settings
$hero_title = get_theme_mod('xdm_hero_title', 'Xadrez das Mariñas');
$hero_subtitle = get_theme_mod('xdm_hero_subtitle', 'Formación, competición e xadrez educativo nas Mariñas e en Galicia');
$hero_image = get_theme_mod('xdm_hero_image');
?>

<!-- Hero Section -->
<section class="hero">
    <?php if ($hero_image) : ?>
        <div class="hero-background-image" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
        </div>
    <?php elseif (file_exists(get_template_directory() . '/assets/hero.png')) : ?>
        <div class="hero-background-image" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/hero.png'); ?>');">
        </div>
    <?php elseif (file_exists(get_template_directory() . '/assets/hero.jpg')) : ?>
        <div class="hero-background-image" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/hero.jpg'); ?>');">
        </div>
    <?php endif; ?>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-text">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/index.php/escola/')); ?>" class="btn-hero btn-hero-primary">Únete á Escola</a>
                <a href="<?php echo esc_url(home_url('/index.php/torneos/')); ?>" class="btn-hero btn-hero-outline">Vindeiros Torneos</a>
            </div>
        </div>
    </div>
</section>

<!-- Novas Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title-left">Novas</h2>
        
        <div class="content-area">
            <div class="main-content">
                <div class="cards-grid cards-grid-2">
                    <?php
                    $novas_query = xdm_get_posts_by_category('novas', 6);
                    if ($novas_query->have_posts()) :
                        while ($novas_query->have_posts()) : $novas_query->the_post();
                            xdm_post_card(true, true);
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback to latest posts
                        $latest_posts = new WP_Query(array('posts_per_page' => 4));
                        while ($latest_posts->have_posts()) : $latest_posts->the_post();
                            xdm_post_card(true, true);
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Actividades XOGADE Widget -->
                <div class="widget">
                    <h3 class="widget-title">Actividades en XOGADE</h3>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/xogade.jpg'); ?>" alt="XOGADE" class="widget-image" onerror="this.style.display='none'">
                    <div class="widget-content">
                        <p><a href="<?php echo esc_url(home_url('/index.php/xogade/')); ?>" class="btn">Ver actividades</a></p>
                    </div>
                </div>
                
                <!-- Novas recentes Widget -->
                <div class="widget">
                    <h3 class="widget-title">Novas recentes</h3>
                    <div class="widget-content">
                        <ul class="widget-posts-list">
                            <?php
                            $recent_posts = xdm_get_recent_posts(5);
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                                <li class="widget-post-item">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <span class="widget-post-date"><?php echo xdm_format_date(); ?></span>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                        <p class="mt-md"><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline">Ver máis artigos</a></p>
                    </div>
                </div>
                
                <!-- Formación Widget -->
                <div class="widget">
                    <h3 class="widget-title">Formación</h3>
                    <div class="widget-content">
                        <ul class="widget-posts-list">
                            <?php
                            // Mix posts from 'escola' (novas/escola) and 'leccions' (xadrez/leccions) categories
                            $formacion_query = new WP_Query(array(
                                'category_name' => 'escola,leccions',
                                'posts_per_page' => 4,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));
                            if ($formacion_query->have_posts()) :
                                while ($formacion_query->have_posts()) : $formacion_query->the_post();
                                ?>
                                    <li class="widget-post-item">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <span class="widget-post-date"><?php echo xdm_format_date(); ?></span>
                                    </li>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<li>Non hai artigos de formación aínda.</li>';
                            endif;
                            ?>
                        </ul>
                        <p class="mt-md"><a href="<?php echo esc_url(home_url('/index.php/category/novas/escola/')); ?>" class="btn btn-outline">Ver máis titoriais</a></p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Torneos Section -->
<section class="section section-alt">
    <div class="container">
        <h2 class="section-title-left">Torneos</h2>
        
        <div class="cards-grid cards-grid-2">
            <?php
            $torneos_query = xdm_get_posts_by_category('torneos', 2);
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
                        <p class="card-excerpt">Mantente ao día dos nosos torneos e competicións.</p>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <div class="text-center mt-lg">
            <a href="<?php echo esc_url(home_url('/torneos')); ?>" class="btn">Ver máis torneos →</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
