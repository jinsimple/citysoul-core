<div class="clearfix"></div>

<?php
	//Function change background footer theme option and page option
	citysoul_bg_footer('footer-background-img');
    if (!is_404()) {
        $footer_setting = citysoul_check_option_theme('footer-type');
        if ($footer_setting == '') {
            $footer_setting = "default";
        }
        citysoul_get_template('templates/footer/footer', $footer_setting);
    }
if (citysoul_check_option_theme('enable-go-top') == '1'): ?>
	<a href="#" class="back-to-top"></a>
<?php endif ?>

<?php wp_footer(); ?>
</body>
</html>
