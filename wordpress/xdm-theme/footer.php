
</main><!-- #main -->

<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
                <p>Promovendo o xadrez en Galicia dende 2013.</p>
                <?php xdm_social_links(); ?>
            </div>
            
            <div class="footer-section">
                <h4>Ligazóns</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            </div>
            
            <div class="footer-section">
                <h4>Contacto</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/index.php/contact/')); ?>">Contactar</a></li>
                    <li><a href="<?php echo esc_url(home_url('/clases')); ?>">Clases</a></li>
                    <li><a href="<?php echo esc_url(home_url('/torneos')); ?>">Torneos</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os dereitos reservados.</p>
        <nav class="footer-legal-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-legal',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 1,
                'items_wrap'     => '%3$s',
            ));
            ?>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
