<?php
$title_element = $shedule_list_id = $title_desc = $textcolor = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = '';


extract(shortcode_atts(array(
	'pages' 			=> '',
	'title_element' 	=> '',
	'shedule_list_id' 	=> '',
	'textcolor'			=> '',
	'colorborder'		=> '',
	'bgcolor'			=> '',
	'linkcolor'			=> '',
	'linkhover'			=> '',
	'css' 				=> '',
	'title_desc'		=> '',
), $atts));

$args = array(
    'post_type' => 'shedule',
    'posts_per_page' => 1,
);

if(!empty($shedule_list_id)) {
    $shedule_list_id_list = explode(',', $shedule_list_id);
}
$loop = new WP_Query($args);
wp_reset_postdata();
 while ($loop->have_posts())  : $loop->the_post() ;
if($shedule_list_id =='') {
    $shedule_list_id = get_the_ID();
}
endwhile;

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'shdedule_list'.$id_ran;

//Setup style for shortcode
$setup      = array(
    '.gallery ' => array(
        'background'                 => $bgcolor,
    ),
    '.text-white' => array(
        'color'                 => $textcolor,

    ),
    '.title-event-today' => array(
    	'color'  => $linkhover,
    ),
    '.text-active .text-more' => array(
        'color' => $linkhover,
    ),
    '.text-active .text-title' => array(
        'color' => $linkcolor,
    ),
    '.text-title .text-active, .dj-name .text-active' => array(
    	'color' => $linkcolor,
    )
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);

?>


<section class="schedule-list <?php echo esc_html($css_class);?> " id="<?php echo esc_attr($randomID);?>">
    <div class="container">

        <div class="citysoul-title-half title-about-event title-opacity text-center">
        <?php if($title_element != ''): ?>
            <div class="citysoul-title text-opacity text-title text-5x text-white"><?php echo esc_html($title_element); ?></div>
        <?php endif; ?>
        <?php if($title_desc != ''): ?>
            <div class="citysoul-tags main-text text-title text-active"><?php echo esc_html($title_desc); ?></div>
        <?php endif; ?>
        </div>
        <div class="contain-date-event">
            <ul class="list-schedule-time">
            <?php 
            if( have_rows('shedule_timeslot', $shedule_list_id) ): 
				while ( have_rows('shedule_timeslot', $shedule_list_id) ) : the_row();
             ?>
                <li>
                    <div class="text-detail">
                        <p class="citysoul-date text-active"><em class="text-more"><?php the_sub_field('shedule_days') ?> /</em> <strong class="text-title"><?php the_sub_field('shedule_slot') ?></strong></p>
                        <p class="text-title title-event-today"><?php the_sub_field('shedule_description') ?></p>
                        <p class="citysoul-date dj-name"><em class="text-more"><?php echo esc_html('Djs /', 'citysoul'); ?></em> <strong class="text-title text-active"><?php the_sub_field('shedule_author') ?>  </strong></p>
                    </div>
                </li>
				<?php 
				endwhile;
				endif;
				 ?>
            </ul>
        </div>
    </div>
</section>