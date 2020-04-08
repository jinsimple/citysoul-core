<?php
$number_partent = $element_title = $order_by = $textcolor = $colorbackground =  $css ='';
extract(shortcode_atts(array(
    'number_partent' 	=> '',
    'element_title' 	=> '',
    'order_by'			=> '',
    'textcolor'			=> '',
    'colorbackground'	=> '',
    'css' 				=> ''
), $atts));

$rand = rand(1, 99999);
$randomID   =  'list_news_'.$rand;

//Setup style for shortcode
$setup      = array(
    '.citysoul-partner-wrapper .title-partner' 		=> array(
        'color'			=> $textcolor,
    ),
    '.citysoul-partner-wrapper:before'  =>   array(
        'background'    =>  $colorbackground,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if ($number_partent == '') {
  $number_partent = 10;
}
?>

<section class="partner <?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr($randomID);?>">
    <div class="citysoul-partner-wrapper text-white">
        <div class="container">
            <div class=" title-normal text-title text-white text-center citysoul-title title-partner text-16x">
            	<?php 
	            	if ($element_title != '') {
	            		echo esc_html($element_title);
	            	}
            	?>
            </div>
            <div class="clearfix"></div>
            <div class="citysoul-partner-list">
                <?php
			         $args = array(
			              'post_type' => 'partner',
			              'posts_per_page' => $number_partent,
			              'order' => $order_by ,
			        );
			         $loop = new WP_Query( $args );
			         wp_reset_postdata();
			      ?>
			    <?php 
			        while ( $loop->have_posts() ) : $loop->the_post();
		        	$url_partent = get_fields( get_the_ID(),'url_partent', TRUE);

		        	if ($url_partent['url_partent'] != '') {
		        	?>
		        	<div class="img-parter">
		        		<a href="<?php printf($url_partent['url_partent']) ?>">
			                <?php 
			                  if( has_post_thumbnail() ) {
			                    echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(), 'full');
			                  }
			                ?>
			            </a>
		        	</div>
		            <?php } 
		            else {
		              if( has_post_thumbnail() ) {
		              	?>
		              	<div class="img-parter">
			              	<?php
			                echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(), 'full');
			                ?>
		                </div>
		                <?php
		              }
		            }
		            ?>

		        <?php endwhile; ?>
            </div><!--End .citysoul-partner-list-->
        </div><!--End .citysoul-partner-list-->
    </div>
</section><!--End .container-->