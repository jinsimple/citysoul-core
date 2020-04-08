<section class="upcomming <?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_html($randomID) ?>">
    <div class="container no-padding">
        <div class="upcomming-slider">
             <div class="title-section">
            <?php if ($list_event_title != ''): ?>
                <div class="citysoul-title text-title text-white <?php echo esc_attr($custom_css); ?>">
                    <?php echo esc_html($list_event_title) ?>
                </div>
            <?php endif ?>
            <?php if ($list_event_description != ''): ?>
                <div class="citysoul-desc text-title text-active <?php echo esc_attr($custom_css); ?>">
                    <?php echo esc_html($list_event_description) ?>
                </div>
            <?php endif ?>
        </div><!--End .title-section-->
            <div class="clearfix"></div>
            <div class="swiper-container citysoul-upcomming citysoul-upcomming-<?php echo esc_html($id_ran) ?>">
                <div class="swiper-wrapper">
                	<?php 
	                while ($loop->have_posts())  : $loop->the_post() ;
                    $unixtimestamp = '';
                    if (function_exists('get_field')) {
                        $unixtimestamp = strtotime(get_field('date_event'));
                    }
                    $link = get_field('buy_link', get_the_ID());
                    if($link != ''){
                        $buy_link = $link;
                    } else {
                        $buy_link = get_the_permalink();
                    }
		            ?>
	                	<div class="swiper-slide upcomming-item">
	                        <div class="slider-image">
	                            <a href="<?php the_permalink() ?>">
					                <?php 
					                  if( has_post_thumbnail() ) {
					                    echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(), 'full');
					                  }
					                ?>
					            </a>
	                        </div><!--End .slider-image-->
	                        <div class="info-slide">
	                            <p class="citysoul-date text-active">
	                            	<em class="text-more"><?php echo date_i18n(( get_option('date_format') ), $unixtimestamp) ; ?></em> 
	                            </p>

	                            <div class="info-ticket">
	                            	<?php 
	                            	$event_title = get_the_title();
	                            	if ('' != $event_title): ?>
	                            		<a href="<?php the_permalink() ?>" class="title-small text-title">
		                                	<?php echo esc_html($event_title) ?>
		                                </a>
		                                <div class="clearfix"></div>
	                            	<?php endif ?>
	                                <?php 
		                                $event_excerpt = get_the_excerpt();
		                                if ('' != $event_excerpt): ?>
		                                <p class="desc-small text-desc">
		                                	<?php echo esc_html($event_excerpt) ?>
		                                </p>
	                                <?php endif ?>
                                    <?php if($enable_link == 'enable'): ?>
	                                <a class="citysoul-button text-title btn-buy" href="<?php echo esc_url($buy_link); ?>"><?php echo esc_html_e('Buy ticket', 'citysoul') ?> <i class="fa fa-ticket"></i></a>
                                    <?php endif; ?>
	                            </div><!--End .info-ticket-->
	                        </div>
	                    </div>
                    <?php 
                        endwhile; 
                        wp_reset_postdata();
                    ?>
                </div>

            </div>
            <div class="btn-next-back btn-next btn-comming-next btn-comming-next-<?php echo esc_html($id_ran) ?>"></div>
            <div class="btn-next-back btn-back btn-comming-back btn-comming-back-<?php echo esc_html($id_ran) ?>"></div>
            <?php if ($href['title'] != ''): ?>
                <div class="all-link text-more">
                <a class="text-white" href="<?php echo esc_url($href['url']) ?>" target="$href['target']">
                        <?php echo esc_html($href['title']) ?>
                    </a>
                </div>
            <?php endif ?>
        </div><!--End upcomming-slider-->
        <?php 
        /*
         * After loop
         * citysoul_upcomming_script - 10
         */
            do_action( 'citysoul_upcomming_script_hook', $id_ran );
        ?>
    </div>
</section><!--End .upcomming-->