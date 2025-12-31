<?php
/**
 * Search form template
 *
 * @package XDM_Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Buscar:', 'label', 'xdm-theme'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Buscar...', 'placeholder', 'xdm-theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo _x('Buscar', 'submit button', 'xdm-theme'); ?></span>
        🔍
    </button>
</form>
