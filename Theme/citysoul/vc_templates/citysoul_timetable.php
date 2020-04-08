<?php
/**
 * SH Timetable for v1.2.0
 * @author VNMilky
 */
$sh_disable_fillter =
$sh_title =
$sh_locale =
$sh_desc =
$sh_link =
$color_title =
$color_desc =
$color_fillter =
$color_number =
$color_active =
$color_artist =
$color_tag =
$color_tag_bg =
$css = '';
extract(shortcode_atts(array(
    'sh_disable_fillter'        =>  '',
    'sh_title'                  =>  '',
    'sh_desc'                   =>  '',
    'sh_link'                   =>  '',
    'sh_locale'                 =>  '',
    'color_title'               =>  '',
    'color_desc'                =>  '',
    'color_fillter'             =>  '',
    'color_number'              =>  '',
    'color_active'              =>  '',
    'color_artist'              =>  '',
    'color_tag'                 =>  '',
    'color_tag_bg'              =>  '',
    'css'                       =>  '',
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$args = array(
    'post_type'           => 'event',
    'order'               => 'ASC',
    'posts_per_page'      => -1,
    'orderby'             => 'meta_value_num',
    'meta_key'            => 'date_event',
);
$loop = new WP_Query( $args );
wp_reset_postdata();
if($loop->have_posts()):
    $arr = array();
    while($loop-> have_posts()) : $loop->the_post();
            $arr[] = get_the_ID();
    endwhile;
$calendar = '';
if($sh_disable_fillter ==''){
    $sh_disable_fillter = 'no';
}
if($sh_locale ==''){
    $sh_locale = 'no';
}
$sh_link    =  vc_build_link($sh_link);
$sh_link_url = $sh_link['url'];
$sh_link_title = $sh_link['title'];
$sh_link_target = $sh_link['target'];
$sh_link_rel = $sh_link['rel'];
if($sh_link['target'] == ' _blank'){
    $sh_link_target = ' target="_blank"';
}
if($sh_link['rel'] == 'nofollow'){
    $sh_link_rel = ' rel="nofollow"';
}
if($sh_link['title'] == ''){
    $sh_link_title = esc_html__('View', 'citysoul');
}
$calendar = ' view';
if($sh_disable_fillter != 'yes')  {
    $calendar = ' view view-2';
}
$rowID  = 'timetable_v1_2_0_'.$id_ran;
$element  = 'calendar_'.$rowID;
?>
<div id="<?php echo esc_attr($rowID)?>" class="timetable_v2 <?php echo esc_attr($css_class)?>">
<?php if($sh_disable_fillter != 'yes') : ?>
<div class="citysoul-calendar-page event-fc">
        <div class="title-calendar">
            <div class="title-section col-md-6 col-xs-12">
                <div class="citysoul-title text-title text-white"><?php if($sh_title != NULL) : echo esc_attr($sh_title); endif;?></div>
                <div class="citysoul-desc text-title text-active"><?php if($sh_desc != NULL) : echo esc_attr($sh_desc); endif;?></div>
            </div>
            <div class="form-fillter col-md-6 col-xs-12">
                <?php if($sh_link_url != NULL) :?><a class="citysoul-button citysoul-button-o text-active text-title citysoul-button-small" data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?>
                <form action="#" method="GET">
                    <div id="select_month_<?php echo esc_attr($element);?>_m" class="select-option select-month">
                        <select id="select_month_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox">
                        </select>
                    </div>
                    <div class="select-option select-year">
                        <select id="select_year_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox">
                            <?php
                                $y_e = get_posts(
                                    array(
                                        'post_type'     => 'event',
                                        'meta_key'      => 'date_event',
                                        'orderby'       => 'meta_value',
                                        'order'             => 'DESC',
                                        'posts_per_page' => -1,
                                    )
                                );
                                $year_x = array();
                                if($y_e != NULL) :
                                    foreach( $y_e as $key => $s ) :
                                        $year_x =  citysoul_get_field('date_event', $s->ID);
                                        $year_x =  date_i18n('Y',strtotime($year_x));
                                        $year[] =  sprintf('<option value="%s">%s</option>',$year_x,$year_x);
                                    endforeach;
                                   echo implode('',array_unique($year));
                                endif;
                            ?>
                        </select>
                    </div>
                   <?php if($sh_locale != 'no') :?>
                    <div class="select-option select-locale">
                     <select id="select_locale_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox">
                     </select>
                    </div>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>
<?php endif;?>
<?php if($sh_disable_fillter != 'no') : ?>
<div class="citysoul-calendar-page event-fc-v">
        <div class="title-calendar">
            <div class="title-section col-md-6 col-xs-12">
                <form action="#" method="GET">
                    <div id="select_month_<?php echo esc_attr($element);?>_m" class="select-option select-month">
                        <select id="select_month_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox"></select>
                    </div>
                    <div class="select-option select-year">
                        <select id="select_year_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox">
                            <?php
                                $y_e = get_posts(
                                    array(
                                        'post_type'     => 'event',
                                        'meta_key'      => 'date_event',
                                        'orderby'       => 'meta_value',
                                        'order'             => 'DESC',
                                        'posts_per_page' => -1,
                                    )
                                );
                                $year_x = array();
                                if($y_e != NULL) :
                                    foreach( $y_e as $key => $s ) :
                                        $year_x =  citysoul_get_field('date_event', $s->ID);
                                        $year_x =  date_i18n('Y',strtotime($year_x));
                                        $year[] =  sprintf('<option value="%s">%s</option>',$year_x,$year_x);
                                    endforeach;
                                   echo implode('',array_unique($year));
                                endif;
                            ?>
                        </select>
                    </div>
                    <?php if($sh_locale != 'no') :?>
                    <div class="select-option select-locale">
                     <select id="select_locale_<?php echo esc_attr($element);?>" name="" class="citysoul-selectbox">
                     </select>
                    </div>
                    <?php endif;?>
                </form>
            </div>
            <div class="form-fillter col-md-6 col-xs-12">
                <?php if($sh_link_url != NULL) :?><a class="citysoul-button citysoul-button-o text-active text-title citysoul-button-small" data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?>
            </div>
        </div>
    </div>
<?php endif;?>
<div id='<?php echo esc_attr($element);?>' class="calendar<?php echo esc_attr($calendar);?>"></div>
<?php do_action('citysoul_timetable_script_hook',$element,$arr);?>
</div>
<?php endif; // loop

