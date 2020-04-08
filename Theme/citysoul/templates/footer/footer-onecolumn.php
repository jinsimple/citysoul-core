<footer class="footer-dark">
    <div class="main-footer">
        <div class="container">
            <?php
             if (function_exists("dynamic_sidebar")) {
                 if ( is_active_sidebar( 'sidebar-footer-onecolumn') ){
                     dynamic_sidebar( 'sidebar-footer-onecolumn');
                 }
             }
            ?>
        </div>
    </div>
    <div class="bottom-footer text-center">
        <ul class="citysoul-social social-round">
            <?php echo citysoul_social_link('footer');?>
        </ul>
        <div class="container">
            <?php if (citysoul_check_option_theme('text-copyright') != NULL): ?>
              <span class="copyright text-desc">
                <?php echo wp_kses_post(citysoul_check_option_theme('text-copyright')); ?>
              </span>
            <?php endif ?>
        </div>
    </div>
</footer>