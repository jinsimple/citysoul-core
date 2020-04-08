<section class="no-results not-found">
		<div class="">
			<div class="container">
				<div class="title-box book-center text-title text-3x title-post"><span><?php esc_html_e( 'Nothing Found', 'citysoul' ); ?></span></div>
			</div>
		</div>
		<div class="page-content">
			<div class="container">
                <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                    <p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'citysoul' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
                <?php elseif ( is_search() ) : ?>
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'citysoul' ); ?></p>
                <?php else : ?>
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'citysoul' ); ?></p>
                <?php endif; ?>
                <?php get_search_form(); ?>
			</div>
		</div><!-- .page-content -->
</section><!-- .no-results -->