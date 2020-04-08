<footer class="footer-dark">
    <div class="main-footer">
        <div class="container">
            <?php
                if (citysoul_GetOption('footer-widget-number')!= NULL) {
                    $numshow = intval(citysoul_GetOption('footer-widget-number'));
                }else{
                    $numshow = 6;
                }
                $columns = intval(12/$numshow);
                if($numshow > 0){
                    if (function_exists("dynamic_sidebar")) {
                        for ($i=1; $i <= $numshow; $i++) {
                                echo '<div class="footer-widget col-md-'.$columns.' col-sm-'.$columns.' col-xs-12"><div class="footer-column">';
                                if ( is_active_sidebar( 'sidebar-footer-'.$i ) ){
                                        dynamic_sidebar( 'sidebar-footer-'.$i );
                                }
                                echo '</div></div>';
                         }
                    }
                }
            ?>
            <div class="clearfix"></div>
            <?php if (citysoul_check_option_theme('text-copyright') != NULL): ?>
              <span class="copyright text-desc">
                <?php echo wp_kses_post(citysoul_check_option_theme('text-copyright')); ?>
              </span>
            <?php endif ?>
        </div>
    </div>
</footer>