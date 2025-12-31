
<?php
/**
 * Xadrez das Mariñas Theme Functions
 *
 * @package XDM_Theme
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function xdm_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 400, true);
    add_image_size('card-thumbnail', 400, 250, true);
    add_image_size('hero-image', 1200, 600, true);
    
    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 120,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Custom background support
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Editor styles
    add_theme_support('editor-styles');
    
    // Responsive embeds
    add_theme_support('responsive-embeds');
    
    // Block styles
    add_theme_support('wp-block-styles');
    
    // Register navigation menus
    register_nav_menus(array(
        'main'         => __('Menú Principal', 'xdm-theme'),
        'footer'       => __('Menú do Pé de Páxina', 'xdm-theme'),
        'footer-legal' => __('Menú Legal', 'xdm-theme'),
    ));
}
add_action('after_setup_theme', 'xdm_theme_setup');

/**
 * Set the content width
 */
function xdm_content_width() {
    $GLOBALS['content_width'] = apply_filters('xdm_content_width', 1200);
}
add_action('after_setup_theme', 'xdm_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function xdm_scripts() {
    // Main stylesheet
    wp_enqueue_style('xdm-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Navigation script
    wp_enqueue_script('xdm-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true);
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'xdm_scripts');

/**
 * Register widget areas
 */
function xdm_widgets_init() {
    // Main sidebar
    register_sidebar(array(
        'name'          => __('Barra Lateral', 'xdm-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Engade widgets aquí para que aparezan na barra lateral.', 'xdm-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3><div class="widget-content">',
    ));
    
    // Footer widget area 1
    register_sidebar(array(
        'name'          => __('Pé de Páxina 1', 'xdm-theme'),
        'id'            => 'footer-1',
        'description'   => __('Primeira columna do pé de páxina.', 'xdm-theme'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer widget area 2
    register_sidebar(array(
        'name'          => __('Pé de Páxina 2', 'xdm-theme'),
        'id'            => 'footer-2',
        'description'   => __('Segunda columna do pé de páxina.', 'xdm-theme'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'xdm_widgets_init');

/**
 * Custom excerpt length
 */
function xdm_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'xdm_excerpt_length');

/**
 * Custom excerpt more
 */
function xdm_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'xdm_excerpt_more');

/**
 * Add custom classes to body
 */
function xdm_body_classes($classes) {
    // Add class if sidebar is active
    if (is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    }
    
    // Add class for singular posts
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    return $classes;
}
add_filter('body_class', 'xdm_body_classes');

/**
 * Custom Walker for main navigation with dropdown support
 */
class XDM_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sub-menu">';
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }
}

/**
 * Format date in Galician
 */
function xdm_format_date($date = null) {
    $months_gl = array(
        'January' => 'xaneiro',
        'February' => 'febreiro',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'maio',
        'June' => 'xuño',
        'July' => 'xullo',
        'August' => 'agosto',
        'September' => 'setembro',
        'October' => 'outubro',
        'November' => 'novembro',
        'December' => 'decembro'
    );
    
    if ($date === null) {
        $date = get_the_date('j \d\e F, Y');
    }
    
    return strtr($date, $months_gl);
}

/**
 * Get posts by category for homepage sections
 */
function xdm_get_posts_by_category($category_slug, $posts_per_page = 3) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'category_name'  => $category_slug,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    return new WP_Query($args);
}

/**
 * Get recent posts
 */
function xdm_get_recent_posts($posts_per_page = 5, $exclude = array()) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__not_in'   => $exclude,
    );
    
    return new WP_Query($args);
}

/**
 * Theme customizer settings
 */
function xdm_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('xdm_hero_section', array(
        'title'    => __('Sección Hero', 'xdm-theme'),
        'priority' => 30,
    ));
    
    // Hero Title
    $wp_customize->add_setting('xdm_hero_title', array(
        'default'           => 'Xadrez das Mariñas',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('xdm_hero_title', array(
        'label'   => __('Título do Hero', 'xdm-theme'),
        'section' => 'xdm_hero_section',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('xdm_hero_subtitle', array(
        'default'           => 'Formación, competición e xadrez educativo nas Mariñas e en Galicia',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('xdm_hero_subtitle', array(
        'label'   => __('Subtítulo do Hero', 'xdm-theme'),
        'section' => 'xdm_hero_section',
        'type'    => 'textarea',
    ));
    
    // Hero Image
    $wp_customize->add_setting('xdm_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'xdm_hero_image', array(
        'label'   => __('Imaxe do Hero', 'xdm-theme'),
        'section' => 'xdm_hero_section',
    )));
    
    // Social Links Section
    $wp_customize->add_section('xdm_social_section', array(
        'title'    => __('Redes Sociais', 'xdm-theme'),
        'priority' => 35,
    ));
    
    // Facebook
    $wp_customize->add_setting('xdm_facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('xdm_facebook_url', array(
        'label'   => __('URL de Facebook', 'xdm-theme'),
        'section' => 'xdm_social_section',
        'type'    => 'url',
    ));
    
    // Twitter/X
    $wp_customize->add_setting('xdm_twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('xdm_twitter_url', array(
        'label'   => __('URL de Twitter/X', 'xdm-theme'),
        'section' => 'xdm_social_section',
        'type'    => 'url',
    ));
    
    // Instagram
    $wp_customize->add_setting('xdm_instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('xdm_instagram_url', array(
        'label'   => __('URL de Instagram', 'xdm-theme'),
        'section' => 'xdm_social_section',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'xdm_customize_register');

/**
 * Display social links
 */
function xdm_social_links() {
    $facebook  = get_theme_mod('xdm_facebook_url');
    $twitter   = get_theme_mod('xdm_twitter_url');
    $instagram = get_theme_mod('xdm_instagram_url');
    
    if (!$facebook && !$twitter && !$instagram) {
        return;
    }
    
    echo '<div class="social-links">';
    
    if ($facebook) {
        echo '<a href="' . esc_url($facebook) . '" target="_blank" rel="noopener" aria-label="Facebook">';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 17.9895 4.3882 22.954 10.125 23.8542V15.4688H7.07812V12H10.125V9.35625C10.125 6.34875 11.9166 4.6875 14.6576 4.6875C15.9701 4.6875 17.3438 4.92188 17.3438 4.92188V7.875H15.8306C14.34 7.875 13.875 8.80008 13.875 9.75V12H17.2031L16.6711 15.4688H13.875V23.8542C19.6118 22.954 24 17.9895 24 12Z"/></svg>';
        echo '</a>';
    }
    
    if ($twitter) {
        echo '<a href="' . esc_url($twitter) . '" target="_blank" rel="noopener" aria-label="Twitter">';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>';
        echo '</a>';
    }
    
    if ($instagram) {
        echo '<a href="' . esc_url($instagram) . '" target="_blank" rel="noopener" aria-label="Instagram">';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>';
        echo '</a>';
    }
    
    echo '</div>';
}

/**
 * Display post card
 */
function xdm_post_card($show_category = true, $show_excerpt = true) {
    ?>
    <article class="card">
        <div class="card-image">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('card-thumbnail'); ?>
                </a>
                <?php if ($show_category) : 
                    $categories = get_the_category();
                    if (!empty($categories)) : ?>
                        <span class="card-category"><?php echo esc_html($categories[0]->name); ?></span>
                    <?php endif;
                endif; ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="card-placeholder">♔</div>
                </a>
                <?php if ($show_category) : 
                    $categories = get_the_category();
                    if (!empty($categories)) : ?>
                        <span class="card-category"><?php echo esc_html($categories[0]->name); ?></span>
                    <?php endif;
                endif; ?>
            <?php endif; ?>
        </div>
        <div class="card-content">
            <span class="card-date"><?php echo xdm_format_date(); ?></span>
            <h3 class="card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php if ($show_excerpt) : ?>
                <p class="card-excerpt"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
            <div class="card-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-outline">Ver máis novas →</a>
            </div>
        </div>
    </article>
    <?php
}

/**
 * Add preconnect for Google Fonts (if used)
 */
function xdm_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'xdm_resource_hints', 10, 2);

/**
 * Disable WordPress emoji
 */
function xdm_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'xdm_disable_emojis');

/**
 * Add theme version to scripts/styles
 */
function xdm_get_theme_version() {
    $theme = wp_get_theme();
    return $theme->get('Version');
}
