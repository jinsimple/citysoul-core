<?php 

	$option = $option_data = $title = $text_more = $link_more = $category = $inpost_id = $max_items = $orderby = $order = $title_color =  $text_more_color = $text_url_color = $text_day_color = $text_date_color = $news_bg_color = $text_hotnew_color = $bghotnew_color = $text_url_active = $css = '';

	extract(shortcode_atts(array(
				'option'			=>	'',
        'option_data'       =>  '',
				'title'				=>	'',
				'text_more'			=>	'',
				'link_more'			=>	'',
				'category'			=>	'',
        'inpost_id'         =>  '',
				'orderby'			=>	'',
				'order'				=>	'',
				'max_items'			=>	'',
				'title_color'		=>	'',
				'text_more_color'	=>	'',
				'text_url_color'	=>	'',
				'text_day_color'	=>	'',
				'text_date_color'	=>	'',
        'text_hotnew_color' =>  '',
        'bghotnew_color'    =>  '',
				'news_bg_color'			=>	'',
        'text_url_active'   =>  '',
				'css'				=>	'',
				),
		$atts)
	);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$rand = rand(1, 99999);
$randomID   =  'list_news_'.$rand;

//Setup style for shortcode
$setup      = array(
    '.title-news,.title-text-more-news .text-title ' 		=> array(
        'color'			=> $title_color,

    ),
    '.title-text-more-news:after' => array(
        'background'     => $title_color,

    ),
    '.view-all-link a' 	=> array(
        'color'			=> $text_more_color,

    ),
    '.news-link, a.title-news-views' 	    =>	array(
    	'color'			=> 	$text_url_color,
    ),
    'a.title-news-views:hover'      =>  array(
      'color'     =>  $text_url_active,
    ),
    '.citysoul-date em' =>	array(
    	'color'			=> 	$text_day_color,
    ),
    '.citysoul-date strong' 	=>	array(
    	'color'			=> 	$text_date_color,
    ),
    '.hot-news'         =>  array(
        'background'    =>  $bghotnew_color,
        'color'         =>  $text_hotnew_color,
    ),
    '.hot-news span'    =>  array(
        'color'         =>  $text_hotnew_color,
    ),
    '.bg_color, .data-more-list-news '  =>   array(
        'background'    =>  $news_bg_color,
    ),


);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);
$id_post = '';
if($option_data == '') {
    $option_data = 'inpostid';
}
if($max_items == "") {
  $max_items = 3;
}
if($option == 'newthreeposts'){
  $max_items = 3;
}
if($title == "") {
  $title = esc_html__('News','citysoul');
}
if($text_more == "") {
  $text_more = esc_html__('All more','citysoul');
}
if ($inpost_id != NULL) {
  $id_post = explode(',', $inpost_id);
}

if($option_data == 'inpostid') {
    $args       = array(
        'post_type'         => 'post',
        'post__in'           =>  $id_post,
        'orderby'           => 'ASC',
        'posts_per_page'    =>  $max_items,
        );
} else {
    if ($category == 'All') {
        $args   = array(
        'post_type'         => 'post',
        'posts_per_page'    =>  $max_items,
        'orderby'           =>  $orderby,   
        'order'             =>  $order,
        );
    }
    else{
      $args     = array(
        'post_type'         => 'post',
        'posts_per_page'    => $max_items,
        'orderby'           =>  $orderby,   
        'order'             =>  $order,
        'category_name'     =>  $category,
        );
    }   
}
$loop = new WP_Query( $args );
wp_reset_postdata();
if ($option == '') {
  $option = 'normal';
}

if($option == 'normal') {
?>
<section class="citysoul-news <?php echo esc_attr( $css_class ); ?>">
<div class="container no-padding">
		<div class="citysoul-box-news" id="<?php echo esc_attr($randomID);?>">
		    <div class="title-box-news">
		        <div class="citysoul-title text-white text-3x title-news text-title"><?php echo esc_html($title);?></div>
		        <div class="text-more view-all-link"><a href="<?php echo esc_url($link_more);?>"><?php echo esc_html($text_more);?></a></div>
		    </div><!--End .title-box-news-->
		    <div class="citysoul-list-news">
		        <ul class="citysoul-list-news-view">
		        	<?php 
		        		$i = 1;
		        		while ($loop->have_posts()) : $loop->the_post(); 

		        		$items 	= 	($i == 1)? 'items-big' 	: 'items-small bg_color ';
		        		$respon =	($i == 1)? '' : 'col-md-6 col-xs-6 ';
		        		if($i == 1 ) {
		        			$text = '';
		        			$pulla = '';
		        			$pullb = '';
		        		}
		        		elseif ($i == 2) {
		        			$text = 'text-right';
		        			$pulla = 'pull-right';
		        			$pullb = 'pull-left right';
		        		}
		        		else {
		        			$text = 'text-left';
		        			$pulla = 'pull-left';
		        			$pullb = 'pull-right left';

		         		}
		        		?>
		            <li class="item-news <?php echo esc_attr($items);?> col-md-6 col-xs-12  <?php echo esc_attr($text);?>">
		            	
		            		<a href="#" class="news-images <?php echo esc_attr($pulla);?>"><?php echo get_the_post_thumbnail(get_the_ID());?></a>
					
		                <div class="date-link <?php echo esc_attr($respon);?> <?php echo esc_attr($pullb);?>">
		                    <a href="<?php the_permalink();?>" class="citysoul-title text-title news-link text-white"><?php echo get_the_title();?></a>
		                    <?php echo citysoul_time_link(); ?>
		                </div>
		            </li>
		            <?php 
		            	$i++;
		            	endwhile; ?>
		        </ul>
		    </div><!--End .list-news-->
		</div>
	</div>
</section>	
<?php
}
elseif ($option == 'hot-news') {
?>
<section class="citysoul-news <?php echo esc_attr( $css_class ); ?>">
    <div class="citysoul-box-news citysoul-hot-news" id="<?php echo esc_attr($randomID);?>">
        <div class="pull-right col-md-6 col-xs-12">
            <div class="title-box-news title-hot">
                <div class="citysoul-title text-white text-5x title-news text-title"><?php echo esc_html($title);?></div>
                <div class="text-more view-all-link"><a href="<?php echo esc_url($link_more);?>"><?php echo esc_html($text_more);?></a></div>
            </div><!--End .title-box-news-->
        </div>

        <div class="citysoul-list-news">
            <ul class="citysoul-list-news-view hot-list">
				<?php 
                    $i = 1;
                    while ($loop->have_posts()) : $loop->the_post(); 
                        $block_a    =   ' <a title="'.get_the_title().'" href="'.esc_url(get_permalink()).'" class="citysoul-title text-title news-link text-white">'.get_the_title().'</a>';
                        $block_b    =  citysoul_time_link(); 
                     if($i == 1) {
                     	$ishow      =     'hot news';
                     	$li 		= 	  'items-big';
                     	$span 		= 	  'hot-news text-white';
                     	$block      =      $block_a.$block_b;     
                     }
                     else {
                     	$ishow = '0'.$i;
                     	$span 	=	'number text-5x';
                     	$li_a 	=	'items-small bg_color ';
                     	$block      =      $block_b.$block_a;   
                    	if($i == 2) {
                     		$li_b 	= 	'small-top';
                     	}
                     	else {
                     		$li_b 	= 	'text-left';

                     	}
                     	$li		=	$li_a.$li_b;	
                     }
                ?>
                <li class="item-news <?php echo esc_attr($li);?> col-md-6 col-xs-12">
                	<?php if($i == 1) : ?>
                    <div class="news-images ">
                        <div class="border-image"><?php echo get_the_post_thumbnail(get_the_ID());?>
                        </div>
                    </div>
                	<?php endif;?>
                    <div class="date-link">
                        <span class="text-title <?php echo esc_attr($span);?>"><?php echo esc_html($ishow);?></span>
                        <?php print($block);?>
                    </div>
                </li>
                <?php 
                	$i++;
                	endwhile; ?>
            </ul>
        </div><!--End .list-news-->

    </div><!--End .box-news-->
</section>
<?php
} elseif($option == 'newthreeposts'){
?>
<section class="more-list-news" id="<?php echo esc_attr($randomID);?>">
  <div class='data-more-list-news'>
    <div class="container">
        <div class="title-text-more-news">
            <div class="text-title text-white citysoul-title text-5x text-center"><?php echo esc_html($title);?></div>
        </div>
        <ul class="msb-list-more-news">
        <?php 
            $i = 1;
            while ($loop->have_posts()) : $loop->the_post(); 
            if($i == 2) {
              $item = ' big-news';
            }
            else {
              $item = ' mine-news';
            }
        ?>
            <li class="more-news-item<?php echo esc_attr($item);?>">
                <div class="news-detail-items<?php echo esc_attr($item);?>">
                    <div class="img-news">
                        <a href="<?php esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail(get_the_ID());?></a>
                    </div>
                    <div class="title-more-news">
                        <?php echo citysoul_time_link(); ?>
                        <div class="clearfix"></div>
                        <a href="<?php esc_url(get_permalink());?>" class="title-news-views text-title"><?php echo get_the_title()?></a>
                    </div>
                </div>
            </li>
          <?php $i++; endwhile; ?>
        </ul>
    </div>
  </div>
</section>
<?php
}