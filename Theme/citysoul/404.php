<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage citysoul
 * @since citysoul 0.0.1
 */

get_header(); ?>

<section class="page-404">
    <div class="citysoul-404">
        <div class="container">
            <div class="citysoul-text-404 col-md-5 col-sm-12 col-xs-12 pull-right text-5x">
                <span class="text-title text-active"><?php esc_html_e('404 Not found -  ', 'citysoul') ?></span>
                <p class="text-title text-white text-desc-404">
                	<?php esc_html_e('the resource requested could not be found on this server', 'citysoul') ?>
                </p>
            </div><!--End .citysoul-text-404-->
            <div class="clearfix"></div>
            <div class="citysoul-404-button col-md-4 col-sm-12 col-xs-12 pull-right">
                <div class="text-more text-404-guide text-active text-16x">( <?php esc_html_e('Please try one of the following pages', 'citysoul') ?> )</div>
                <a href="<?php echo esc_url(home_url( '/' ));?>" class="citysoul-button citysoul-button-o text-active text-title ">
                	<?php esc_html_e('Home page', 'citysoul') ?>
                </a>
            </div><!--End .citysoul-404-button-->
        </div>
    </div><!--End citysoul-404-->
</section>
<?php
get_footer('none');
