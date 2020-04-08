<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage citysoul
 * @since citysoul 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<li class="video-item col-md-6 col-sm-6 col-xs-12">
    <a  class="video-thumbs">
	<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
        <span class="video-control " >
        	<span class="icon-play icon-white play-button"></span>
        </span>
		<input type="hidden" value='<iframe width="560" id="videos" height="315" src="<?php echo get_post_meta(get_the_ID(), 'url', true);?>?&enablejsapi=1" frameborder="0" allowfullscreen></iframe>'>
    </a>
    <div class="video-title text-center">
        <p class="citysoul-date text-active"><em class="text-more"><?php echo get_the_date(); ?></em></p>
        <a class="txt-title text-title text-white text-16x" data-toggle="modal" data-target="#<?php echo get_the_ID();?>"><?php the_title(); ?></a>
    </div>

    
</li>
