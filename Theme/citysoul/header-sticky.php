<div class="sticker">
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
            <?php if (citysoul_check_option_theme('enable-search') != '0'): ?>
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
</div>