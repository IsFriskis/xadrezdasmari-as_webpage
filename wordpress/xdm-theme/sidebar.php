<?php
/**
 * The sidebar template
 *
 * @package XDM_Theme
 */
?>

<aside id="secondary" class="sidebar" role="complementary">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>
    
    <!-- Arquivo Widget -->
    <div class="widget widget-arquivo">
        <h3 class="widget-title">Arquivo</h3>
        <div class="widget-content">
            <ul class="arquivo-list">
                <?php
                // Get years with posts
                global $wpdb;
                $years = $wpdb->get_results("
                    SELECT DISTINCT YEAR(post_date) AS year, COUNT(ID) as post_count
                    FROM $wpdb->posts
                    WHERE post_status = 'publish' AND post_type = 'post'
                    GROUP BY YEAR(post_date)
                    ORDER BY year DESC
                ");
                
                foreach ($years as $year) :
                    $current_year = date('Y');
                    $is_expanded = ($year->year == $current_year);
                ?>
                    <li class="arquivo-year <?php echo $is_expanded ? 'expanded' : ''; ?>">
                        <span class="arquivo-toggle" data-year="<?php echo $year->year; ?>">
                            <span class="toggle-icon"><?php echo $is_expanded ? '▼' : '►'; ?></span>
                            <?php echo $year->year; ?> (<?php echo $year->post_count; ?>)
                        </span>
                        <ul class="arquivo-months" <?php echo $is_expanded ? '' : 'style="display:none;"'; ?>>
                            <?php
                            // Get months for this year
                            $months = $wpdb->get_results($wpdb->prepare("
                                SELECT DISTINCT MONTH(post_date) AS month, COUNT(ID) as post_count
                                FROM $wpdb->posts
                                WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = %d
                                GROUP BY MONTH(post_date)
                                ORDER BY month DESC
                            ", $year->year));
                            
                            foreach ($months as $month) :
                                $month_name = date_i18n('m', mktime(0, 0, 0, $month->month, 1));
                                $current_month = date('n');
                                $is_month_expanded = ($year->year == $current_year && $month->month == $current_month);
                            ?>
                                <li class="arquivo-month <?php echo $is_month_expanded ? 'expanded' : ''; ?>">
                                    <span class="arquivo-toggle" data-year="<?php echo $year->year; ?>" data-month="<?php echo $month->month; ?>">
                                        <span class="toggle-icon"><?php echo $is_month_expanded ? '▼' : '►'; ?></span>
                                        <?php echo $month_name; ?> (<?php echo $month->post_count; ?>)
                                    </span>
                                    <ul class="arquivo-posts" <?php echo $is_month_expanded ? '' : 'style="display:none;"'; ?>>
                                        <?php
                                        // Get posts for this month
                                        $posts_in_month = $wpdb->get_results($wpdb->prepare("
                                            SELECT ID, post_title
                                            FROM $wpdb->posts
                                            WHERE post_status = 'publish' AND post_type = 'post' 
                                            AND YEAR(post_date) = %d AND MONTH(post_date) = %d
                                            ORDER BY post_date DESC
                                        ", $year->year, $month->month));
                                        
                                        foreach ($posts_in_month as $post_item) :
                                        ?>
                                            <li><a href="<?php echo get_permalink($post_item->ID); ?>"><?php echo esc_html($post_item->post_title); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.arquivo-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var parent = this.parentElement;
            var sublist = parent.querySelector(':scope > ul');
            var icon = this.querySelector('.toggle-icon');
            
            if (sublist) {
                if (sublist.style.display === 'none') {
                    sublist.style.display = 'block';
                    icon.textContent = '▼';
                    parent.classList.add('expanded');
                } else {
                    sublist.style.display = 'none';
                    icon.textContent = '►';
                    parent.classList.remove('expanded');
                }
            }
        });
    });
});
</script>
