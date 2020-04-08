<?php
/*
Plugin Name: Flowdemo
Plugin URI: http://beautheme.com/
Description: Beautheme Demo
Author: Beauthemes
Author URI: http://beautheme.com/
Text Domain: beautheme
Version: 1.0
*/

// Demo - Styles
if (!function_exists('flowdemo_demo_styles')) {
	function flowdemo_demo_styles() {
		$plugin_url = plugin_dir_url( __FILE__ );

		wp_enqueue_style( 'flowdemo-demo-import-style', $plugin_url . '/assets/css/style.css', array(),'1.0.0', 'all' );

	}
}
add_action( 'wp_enqueue_scripts', 'flowdemo_demo_styles' );

add_action( 'wp_footer', 'flowdemo_support_button' );
if (!function_exists('flowdemo_support_button')) {
	function flowdemo_support_button() {
		$response = '';
		$api_url = get_option('api_url');
		$check_rs_cache = get_option('reset_cache');

		//Cache API
		$caching = get_transient('api-flow-demo');
		if ($check_rs_cache == 'reset') {
			$caching = false;
			//Update field reset
			update_option( 'reset_cache', '' );
		}
		if ( $caching == false ) {
			$response = wp_remote_get( $api_url );
			$api_content = $body_rp_content = '';
			if( is_array($response) ) {
				$body_rp_content = $response['body'];
			}
			if ($body_rp_content != '') {
				$api_content = $body_rp_content;
			}
			$json = json_decode($api_content);
			// Send data to array
			$output = array(
                'shares' => $json
        	);
			// Create key transient 'api-flow-demo'
        	set_transient( 'api-flow-demo', $output, 60*60*24 ); // 60*60*24 cache every 24h (sec*min*hou)
		}
		else {
        	$json = $caching['shares'];
		}
		if ($api_url != '') {
		$json = get_object_vars($json);
		$title = (get_object_vars($json['title'])['rendered']);
		$content = (get_object_vars($json['content'])['rendered']);

		$data_acf = get_object_vars($json['acf']);
		//Item show
		$data_acf_item = $data_acf["item_show"];
		//Item interested
		$data_acf_item_interested = $data_acf["item_may_be_interested"];
		//Text interested
  		$data_acf_text_interested = $data_acf["text_interested"];
		//Theme price
		$data_acf_price = $data_acf["price_of_item"];
		//Theme link document
		$data_acf_link_document = $data_acf["link_document"];
		//Theme link pushchase
		$data_acf_link_pushchase = $data_acf["link_pushchase"];
		//Theme image sale
		$data_acf_image_sale = $data_acf["image_sale"];
		//Theme text sale
		$data_acf_text_sale = $data_acf["text_sale"];
		//Theme link support
		$data_acf_link_support = $data_acf["link_support"];
		//$data_acf_item_array = get_object_vars($data_acf_item);
		if ($data_acf_link_support == '') {
			$data_acf_link_support = 'http://support.beautheme.com/';
		}
		
			?>
			<div id="wr-toolbar" class="right-position">
				<div class="wr-toolbar-inner">
					<div class="toolbar-scroll">
						<div class="open" id="wr-toolbar-open">
							<?php 
							$plugin_url = plugin_dir_url( __FILE__ );
							if ($data_acf_link_support != ""): ?>
								<div class="wrticksy">
									<a href="<?php echo esc_attr($data_acf_link_support) ?>" target="_blank">
										<img src="<?php echo esc_attr($plugin_url) ?>/assets/images/+.png" alt="">
									</a>
								</div>
							<?php endif ?>
						</div>

						<div class="toolbar-header">
							<div class="buy-now">
								<a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="back-to"><span>←</span>Back to Overview</a>
								<?php if ($data_acf_link_pushchase != '' || $data_acf_price != '' ): ?>
									<a href="<?php echo esc_attr($data_acf_link_pushchase); ?>" target="_blank" class="btn-buy">Purchase for $<?php echo esc_attr($data_acf_price) ?></a>
								<?php endif ?>
							</div>
						</div>
						
						<div class="toolbar-content">
							<?php if ($title != ''): ?>
							<div class="package-text">
								<div class="title_theme">
									<?php echo esc_attr($title) ?>
								</div>
								<div class="content_theme">
									<?php echo flowdemo_html_wpkses($content) ?>
								</div>
							</div>
							<?php endif ?>
							<?php 
							$count = count($data_acf_item);
							if ($data_acf_item != false): ?>
								<div class="wr-toolbar-list">
									<?php 
										$count = count($data_acf_item);
										for ($i=0; $i < $count; $i++) { 
											$name_item = $data_acf_item[$i]->name_item;
											$link_demo = $data_acf_item[$i]->link_demo;
											$image_item = $data_acf_item[$i]->image_item;
											
											if ($image_item != '') {
												$size = 'thumb';
												$thumb = $image_item->sizes;
												$thumb_custom = $thumb->thumb;
											}
										?>
										<div class="item">
											<div class="niche-thumb">
												<?php if ($image_item != ''): ?>
												<a href="<?php echo esc_attr($link_demo) ?>">
													<img src="<?php echo esc_attr($thumb_custom) ?>" alt="<?php echo esc_attr($name_item) ?>" width="405" height="300">
												</a>
												<?php endif ?>
												<?php if ($name_item != ''): ?>
													<div class="niche-title">
														<a href="<?php echo esc_attr($link_demo) ?>">
															<?php echo esc_attr($name_item) ?>
														</a>
													</div>
												<?php endif ?>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php endif ?>
							<?php 
							$count_interested = count($data_acf_item_interested);
							if ($data_acf_item_interested != false): ?>
								<?php if ($data_acf_text_interested != ''): ?>
									<div class="text-interested"><?php echo esc_attr($data_acf_text_interested); ?></div>
								<?php endif ?>
								<div class="wr-toolbar-list">
									<?php 
										for ($i=0; $i < $count_interested; $i++) { 
											$name_item = $data_acf_item_interested[$i]->name_item;
											$link_demo = $data_acf_item_interested[$i]->link_demo;
											$image_item = $data_acf_item_interested[$i]->image_item;

											if ($image_item != '') {
												$size = 'thumb';
												$thumb = $image_item->sizes;
												$thumb_custom = $thumb->thumb;
											}
											
									?>
										<div class="item">
											<div class="niche-thumb">
												<?php if ($image_item != ''): ?>
												<a href="<?php echo esc_attr($link_demo) ?>">
													<img src="<?php echo esc_attr($thumb_custom) ?>" alt="<?php echo esc_attr($name_item) ?>" width="405" height="300">
												</a>
												<?php endif ?>
												<?php if ($name_item != ''): ?>
													<div class="niche-title">
														<a href="<?php echo esc_attr($link_demo) ?>">
															<?php echo esc_attr($name_item) ?>
														</a>
													</div>
												<?php endif ?>
											</div>
										</div>
									<?php 
										}
									?>
								</div>
							<?php endif ?>

							<div class="toolbar-footer">
								<div class="fc jcsb">
									<?php if ($data_acf_link_support != ''): ?>
										<span class="link_support">
											<a href="<?php echo esc_attr($data_acf_link_support) ?>" target="_blank">You need help ?</a>
										</span>
									<?php endif ?>
									<?php if ($data_acf_link_document != ''): ?>
									<span class="link_document"><a href="<?php echo esc_attr($data_acf_link_document) ?>" target="_blank"> Try Viewing our documentation</a></span>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="overlay"></div>
				<div class="wrtb-tooltip">
					<div class="tooltip-content">
						<?php if ($data_acf_text_sale): ?> 
							<div class="tooltip-content-inner">
								<?php echo flowdemo_html_wpkses($data_acf_text_sale); ?>
							</div>
						<?php endif ?> 
						
						<?php if ($data_acf_link_pushchase != '' || $data_acf_price != '' ): ?>

							<div class="buy-now">
								<a target="_blank" class="btn-buy" href="<?php echo esc_attr($data_acf_link_pushchase); ?>">PURCHASE FOR $<?php echo esc_attr($data_acf_price) ?></a>
							</div>
						<?php endif ?>
					</div>
					<?php  if($data_acf_price != '' ) { ?>
						<div class="tooltip-btn">
							<a target="_blank" href="<?php echo esc_attr($data_acf_link_pushchase); ?>">
								<span>ONLY</span>
								<strong>$<?php echo esc_attr($data_acf_price) ?></strong>
							</a>
						</div>
					<?php } ?>

				</div>
			</div>
			<script type="text/javascript">
			    (function($){
	    			'use strict';
			    	$('.wrticksy').click(function(event) {
			    		$("#wr-toolbar-open").toggleClass('active-open');
			    		setTimeout(function(){
				        $("#wr-toolbar").toggleClass('active');
				        }, 150); 
				        return false;
				    });

				    $('.tooltip-btn').hover(function(event) {
			    		$(".tooltip-content").toggleClass('active-open');
				    });
				})( jQuery, window, document );
			</script>
			<?php
		}
	}
}


function flowdemo_add_theme_menu_item()
{
	add_menu_page("Flow demo", "Flow demo", "manage_options", "flow-demo", "flowdemo_theme_settings_page", null, 99);
}

add_action("admin_menu", "flowdemo_add_theme_menu_item");

function flowdemo_theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Flow demo</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function flowdemo_display_api_element()
{
	?>
    	<input type="text" name="api_url" id="api_url" value="<?php echo get_option('api_url'); ?>" />
    <?php
}
function display_test_twitter_element(){
//php code to take input from text field for twitter URL.
?>
<input type="text" name="reset_cache" id="reset_cache" value="<?php echo get_option('reset_cache'); ?>" />
<b>Type 'reset', save and refresh home page to reset cache</b>
<?php
}
function flowdemo_display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
	add_settings_field("api_url", "API flow demo", "flowdemo_display_api_element", "theme-options", "section");
    register_setting("section", "api_url");

    add_settings_field('twitter_url', 'Reset cache', 'display_test_twitter_element', 'theme-options', 'section');
	register_setting( 'section', 'reset_cache');
}

add_action("admin_init", "flowdemo_display_theme_panel_fields");

if(!function_exists('flowdemo_html_wpkses')) {
    function flowdemo_html_wpkses($content=''){
        $kses = array(
            //formatting
            'strong' => array(),
            'em'     => array(),
            'b'      => array(),
            'i'      => array(),

            //links
            'a'     => array(
                'href' => array()
            ),
            //Img
            'img'   =>  array(
                'src'   =>  array(),
                'class' =>  array(),
                'alt'   =>  array(),
                'width' =>  array(),
                'height'=>  array(),
                ),
            'video' => array(
                'class' =>  array(),
                'id' =>  array(),
                'width' =>  array(),
                'height' =>  array(),
                'preload' =>  array(),
                'controls' =>  array(),
                ),
            'source'    =>  array(
                'type'  =>  array(),
                'src'  =>  array(),
                ),
        );
        if($content != NULL) {
            return wp_kses($content,$kses);
        }
    }
}