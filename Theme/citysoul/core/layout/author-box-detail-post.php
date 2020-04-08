<?php 
$current_user = wp_get_current_user();
//Only show if login
?>
<?php if (is_user_logged_in()): ?>
    <?php if ($current_user->description != NULL): ?>
        <div class="citysoul-author-box">
            <div class="auth-avatar">
                <?php echo get_avatar( $comment, 120 ); ?>
            </div><!-- End .auth-avatar -->
            <div class="author-infomation">
                <div class="author-name text-title citysoul-title text-16x text-white">
                	<?php the_author(); ?>
                </div>
                
            	<div class="author-short-desc text-more text-white">
    	        	<?php echo esc_html($current_user->description) ?>
    	        </div>
                
                
                <?php if ($current_user->user_url != NULL): ?>
        	        <div class="author-url text-desc">
        	        	<a href="<?php echo esc_url($current_user->user_url) ?>" target="_blank" ref="dofollow">
        	        		<?php echo esc_url($current_user->user_url) ?>
        	        	</a>
        	        </div>
                <?php endif ?>
            </div><!--End .aurhor-infomation-->
        </div><!--End .box-author -->
    <?php endif ?>
<?php endif ?>