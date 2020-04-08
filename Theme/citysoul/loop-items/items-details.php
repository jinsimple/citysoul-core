<div class="content-blog-details">
    <?php 
        /**
             * citysoul_before_loop_content hook.
             *
             * @hooked citysoul_get_thumbnail - 10
             * @hooked citysoul_get_sticker - 20
             * @hooked citysoul_title_single_content - 30
             * @hooked citysoul_info_single_content - 40
             */
            do_action( 'citysoul_before_loop_content' );
    ?>
    <?php 
        /**
             * citysoul_after_loop_content hook.
             *
             * @hooked citysoul_before_content_single - 10
             * @hooked citysoul_content_single - 20
             * @hooked citysoul_tag_share_content_single - 30
             * @hooked citysoul_after_content_single - 40
             */
            do_action( 'citysoul_after_loop_content' );
    ?>
</div>