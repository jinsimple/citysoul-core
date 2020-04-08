<?php

$title_element = $list_post_id = $pages = $option = $textcolor = $colorborder = $bgcolor = $linkcolor = $linkhover = $css = '';

extract( shortcode_atts( array(
	'title_element'		=> '',
	'list_post_id'		=> '',
	'pages'				=> '',
	'textcolor'			=> '',
	'colorborder'		=> '',
	'bgcolor'			=> '',
	'linkcolor'			=> '',
	'linkhover'			=> '',
    'option'            => '',
	'css'				=> '',
), $atts));

if($option == '') {
    $option = 1;
}

if( !empty($list_post_id)) {
	$list_id = explode(',', $list_post_id);
}

if($pages == '') {
	$pages = -1;
}

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);


$id_ran = rand(1, 99999);
$randomID   =  'list_post_'.$id_ran;

//Setup style for shortcode
$setup      = array(
    '.left-content' => array(
        'background'                 => $bgcolor,
    ),
    '.citysoul-date .text-title, .citysoul-date .text-more ' => array(
        'color'                 => $textcolor,

    ),
    '.title-post a, .tags-links ' => array(
    	'color'					=> $linkcolor,
    ),
    '.text-desc'  => array(
    	'color' => $bgcolor,
    ),
    '.cat-links' => array(
    	'color' => $linkhover,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);



?>

<article class="content-blog left-content col-xs-12 <?php echo esc_html($css_class);?>" id="<?php echo esc_html($randomID);?>">             
    <ul class="citysoul-list-blog col-xs-12">

	<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    	$per_page = get_option( 'posts_per_page' );
		$args = array(
            'post_type'     => 'post',
            'posts_per_page' => $pages,
            'paged' => $paged,
          );
		if(isset($list_id)) {
			$args['post__in'] = $list_id;
		}

        $loop = new WP_Query( $args );	
        wp_reset_postdata();
        while ($loop->have_posts())  : $loop->the_post() ;
	
        citysoul_get_loop( 'items','post' );
	 endwhile; ?>

    </ul>
    <div class="clearfix"></div>

    <?php 
    if( $option == 2) {
        if(function_exists('citysoul_pagination')) {
            echo citysoul_pagination($loop);
        }
    } else { ?>
  
    
    <div class="loadmore-button text-center">
    <?php
        if (function_exists('citysoul_jqueryLoadmore')) {
            $setting = array(
                'container'     => '.citysoul-list-videos', // <ul class="citysoul-list-videos">
                'template'      => 'items-videos',
                'loadmore'      => $pages,
                'button_text'   => 'Read more ..',
            );
            citysoul_jqueryLoadmore($setting , $args);
        }
    ?>
    </div>
    <?php } ?>


</article>