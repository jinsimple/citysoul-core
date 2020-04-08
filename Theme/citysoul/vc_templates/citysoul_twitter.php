<?php 
$twitter_nick = $max_items = $twitter_color = $twitter_screenname_color = $twitter_nickname_color = $twitter_tweet_color = $twitter_detail_color = $css = '';
$twitter_active_color = $twitter_follow_color = '';
extract(shortcode_atts(array(
    'max_items'                     =>  '',
    'twitter_color'                 =>  '',
    'twitter_screenname_color'      =>  '',
    'twitter_nickname_color'        =>  '',
    'twitter_tweet_color'           =>  '',
    'twitter_detail_color'          =>  '',
    'css'                           =>  '',
    'twitter_active_color'          =>  '',
    'twitter_follow_color'          =>  '',
    'twitter_nick'                  =>  '',
), $atts));
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$randomID = rand(999, 9999);

//Setup style for shortcode
$setup      = array(
    '.twitter-recents-items .title-items-twitter , .twitter-recents-items .title-items-twitter i'           =>  array(
            'color'                                         =>  $twitter_color,
        ),
    '.twitter-user .text-active, .latest-twitter i,.title-recent .text-active'                                                         =>  array(
            'color'                                         =>  $twitter_screenname_color,
        ),
    '.latest-twitter a.name-follow ,.title-recent .name-follow'                                                         =>  array(
            'color'                                         =>  $twitter_nickname_color,
        ),  
    '.latest-twitter span.time ,.title-recent span.time'                                                         =>  array(
            'color'                                         =>  $twitter_tweet_color,
        ),  
    '.latest-twitter .message , .latest-twitter .message *, .latest-twitter .twitter-hashtag ,.item-recent .content-recent '                                                         =>  array(
            'color'                                         =>  $twitter_detail_color,
        ),
    '.citysoul-button .btn-buy .btn-active .twitter-follow-button,.twitter-user '                                                         =>  array(
            'color'                                         =>  $twitter_active_color,
        ),
    '.text-title .btn-buy'                                                         =>  array(
            'color'                                             =>  $twitter_follow_color,
            'background'                                         =>  $twitter_active_color,
        ),
      
    );
if($max_items == ""){
    $max_items = 2;
}
echo citysoul_css_shortcode('twitter-'.$randomID, $setup);
?>
<section class="twitter-recentpost <?php echo esc_attr( $css_class ); ?>" id="twitter-<?php echo esc_attr($randomID);?>">
    <div class="container">
        <div class="twitter-recents-items">
            <div class="twitter-message col-md-6 col-sm-6 col-xs-12">
                <div class="text-title text-right">
                    <div class="citysoul-title text-3x text-active title-items-twitter"><i class="fa fa-twitter"></i><?php echo esc_html__('Twitter','citysoul');?></div>
                    <ul class="latest-twitter">
                          
                    <?php 
                        if (function_exists('citysoul_latest_tweets_render')) {
                            $twitterMessage = citysoul_latest_tweets_render($max_items);
                            foreach ($twitterMessage as $key => $value) {                      
                                printf('%s',$value); 
                            }  
                        }                
                        ?>
                    </ul>
                    <div class="clearfix"></div>
                    <a class="citysoul-button btn-buy btn-active twitter-follow-button"
  href="<?php echo esc_url('https://twitter.com/') ?><?php echo esc_attr($twitter_nick);?>"><?php echo esc_html__('Follow','citysoul');?></a>

                </div><!--End .citysoul-title-->
            </div><!--End .twitter-message-->
            <div class="recent-post col-md-6 col-sm-6 col-xs-12">
                <div class="text-title text-left">
                    <div class="citysoul-title text-active text-3x title-items-twitter"><?php echo esc_html__('Recent comments','citysoul');?></div>
                    <ul class="latest-news">
                    <?php
                        $args = array(
                        'status' => 'approve',
                        'number' => $max_items,
                        );
                        $comments = get_comments($args);
                        foreach($comments as $comment) :
                            $email = explode('@',$comment->comment_author_email);


                    ?>
                        <li>
                            <span class="recent-image">
                                <a href="<?php echo esc_url(get_comment_link($comment));?>"><?php echo get_avatar( $comment,60)?></a>
                            </span>
                            <div class="item-recent">
                                <p class="title-recent"><strong class="text-active"><?php echo esc_html($comment->comment_author);?></strong><a class="name-follow">@<?php echo esc_html($email[0]);?></a><span class="time"> - <?php echo date_i18n(get_option('date_format'),strtotime($comment->comment_date));?> </span></p>
                                <p class="content-recent message text-more"><?php echo esc_html($comment->comment_content);?></p>
                            </div>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </div><!--End .citysoul-title-->
            </div><!--End .recent-post-->
        </div><!--End .twitter-recents-items-->
    </div>
</section><!--End .twitter-recentpost-->
