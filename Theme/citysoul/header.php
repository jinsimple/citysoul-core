<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php if (citysoul_check_option_theme('enable-responsive') != '0') {?>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
    <?php } ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<?php if (!is_404()) { ?>
    <header>
        <div id="citysoul-mobile-menu" class="container">
            <button id="trigger-overlay">
                <i></i>
            </button>
            <div class="overlay overlay-scale">
            <?php wp_nav_menu( array( // show menu mobile
                'theme_location' => 'mobile-menu',
                'container' => 'nav',
                'container_class' => 'mobile-menu'
             ) ); ?>
        </div>
        </div>
        <!-- open/close -->
        
        <div class="top-header text-more">
            <div class="container">
                <div class="top-bar-left col-lg-6 col-md-6 col-xs-6">
                    <?php if (citysoul_check_option_theme('phone-header') != NULL): 

                    $phone = citysoul_check_option_theme('phone-header');
                    $list_phone = explode('/',$phone);
                    
                    $call = '';
                    foreach ($list_phone as $key => $value) {
                        if($call == '') {
                            $call = '<a href="tel:'.$value.'">'.$value.'</a>';
                        } else {
                            $call .= ' / <a href="tel:'.$value.'">'.$value.'</a>';
                        }
                    }
                    ?>
                        <i class="fa fa-phone"></i><?php print($call); ?>
                    <?php endif ?>
                </div>

                <div class="top-bar-right col-lg-6 col-md-6 col-xs-6">
                    <ul>
                        <?php if (!is_user_logged_in()): ?>
                            <?php if (get_option( 'users_can_register' )): ?>
                                <li class="text-top-header"><a href="#" class="text-center"><?php esc_html_e('Sign up','citysoul')?></a>
                                    <div class="citysoul-form-user form-register">
                                        <span class="title-form text-title"><?php esc_html_e('Sign up with','citysoul')?></span>
                                        <ul class="citysoul-social">
                                            <?php
                                                if (function_exists('citysoul_social_link')) {
                                                    citysoul_social_link();
                                                }
                                            ?>
                                        </ul>
                                        <div class="clearfix"></div>
                                        <?php echo do_action('register_form');?>
                                    </div><!--End .form-register-->
                                </li>
                            <?php endif ?>

                            <li class="text-top-header"><a href="#" class="text-center"><?php esc_html_e('Login','citysoul')?></a>

                                <div class="citysoul-form-user form-login">
                                    <span class="title-form text-title"><?php esc_html_e('Login with','citysoul')?></span>
                                    <ul class="citysoul-social">
                                        <?php
                                            if (function_exists('citysoul_social_link')) {
                                                citysoul_social_link();
                                            }
                                        ?>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <?php wp_login_form(); ?> 
                                </div><!--End .form-register-->
                            </li>
                        <?php endif ?>
                        <?php if (is_user_logged_in()): ?>
                            <?php if(citysoul_check_option_theme('enable-log-inout') != '0'): ?>
                            <li class="text-logout"><?php wp_loginout(); ?></li>
                            <?php endif; ?>
                        <?php endif ?>
                        <?php if (citysoul_check_option_theme('enable-link-language')!= '0'): ?>
                            <li class="language-list">
                                <ul class="citysoul-language">
                                    <li><a href="#"><?php esc_html_e('En','citysoul')?></a></li>
                                    <li><a href="#"><?php esc_html_e('Fr','citysoul')?></a></li>
                                </ul>
                            </li><!--End .language-list-->
                        <?php endif ?>
                        <?php if(citysoul_check_option_theme('enable-link-social') != '0'): ?>
                        <li class="social-list">

                            <ul class="citysoul-social">
                                <?php
                                    if (function_exists('citysoul_social_link')) {
                                        citysoul_social_link();
                                    }
                                ?>
                            </ul>
                        </li><!--End .social-list-->
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div><!--End .top-header-->

        <div class="bottom-header">
            <div class="container">
                <div class="citysoul-logo">
                    <?php do_action('citysoul_main_logo','main_logo');?>
                </div>
                <div class="logo-mobile">
                    <?php do_action('citysoul_main_logo','mobile_logo');?>
                </div>
                <!--End #logo-->
                <?php 
                if (citysoul_check_option_theme('enable-search') != '0'): ?>
                    <div class="search">
                        <span class="btn-search">
                            <a href="#" data-toggle="modal" data-target="#citysoulSearch"><i class="fa fa-search"></i></a>
                        </span>
                    </div><!--End .search-->
                <?php endif ?>
                <?php 
                if (citysoul_check_option_theme('enable-main-nav') != '0'): ?>
                    <div class="navigator text-title">
                        <?php citysoul_main_menu('main-menu') ?>
                    </div><!--End .navigator-->
                <?php endif ?>
                
            </div>
        </div><!--End .bottom-header-->
    </header>
    <div class="postion-menu-sticker"></div>
    <?php
    if (citysoul_check_option_theme('enable-fixed') != '0') {
        citysoul_get_template('header-sticky');
    }
    
    citysoul_get_template('searchform-popup'); 

    $slide_id = citysoul_get_field('select_slide');
    if ($slide_id != '0' && $slide_id != NULL && $slide_id != '' && $slide_id != 'Select') {
        ?>
        <section class="main-slider">
            <?php
            if ( function_exists('mspr_two_instance_notice') ) {
              echo do_shortcode( '[masterslider id="'.$slide_id.'"]' ); 
            }
            ?>
        </section>
        <?php
    }
    ?>

<?php }  
    if (citysoul_check_option_theme('enable-loader-wrapper') != '0') : ?>
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left" data-wow-delay=".2s"></div>
</div>
<?php endif;