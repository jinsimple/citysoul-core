<?php 
$contact_title = $contact_description = $id_contact_form = $css = '';
$title_color = $description_color = $border_input_color = $text_input_color = $border_submit_color = $text_submit_color = '';
extract(shortcode_atts(array(
    'contact_title'             =>  '',
    'contact_description'       =>  '',
    'id_contact_form'           =>  '',
    'title_color'               =>  '',
    'description_color'         =>  '',
    'border_input_color'        =>  '',
    'text_input_color'          =>  '',
    'border_submit_color'       =>  '',
    'text_submit_color'         =>  '',

), $atts));
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$randID = rand(1,99999);
$setup      = array(
    '.title-form-contact .citysoul-title' => array(
        'color'     => $title_color,
        ),
    '.title-form-contact .text-desc' => array(
        'color'     => $description_color,
        ),
     '.citysoul-input-text' => array(
        'border-color'=> $border_input_color,
        'color'         =>  $text_input_color,
    ),
    '.btn-contact' => array(
        'border-color'=> $border_submit_color,
        'color'         =>  $text_submit_color,
    ),
     

    
);
echo citysoul_css_shortcode('contact-page-'.$randID, $setup);

if($contact_title == ''){
    $contact_title = esc_html__('Write to us','citysoul');
}
?><section class="contact-page <?php echo esc_html($css_class);?>" id="contact-page-<?php echo esc_html($randID);?>">
    <div class="citysoul-contact">
            <div class="citysoul-form-contact">
                <div class="title-form-contact">
                    <div class="citysoul-title text-title text-active text-3x"><?php echo esc_html($contact_title);?></div>
                    <?php if($contact_description !==  null) :?>
                    <div class="text-desc desc-contact"><?php echo esc_html($contact_description);?> </div>
                    <?php endif; ?>
                    <div class="form-contact">
                    <?php if($id_contact_form != null) {
                        echo do_shortcode('[contact-form-7 id="'.$id_contact_form.'" title="Contact"]');
                    }
                    else  esc_html__('Please creat Form Contact !','citysoul');
                    ?>
                    </div><!--End form-contact-->
                </div><!--End .title-form-->
            </div>

    </div><!--End .citysoul-contact-->
</section><!--End .contact-page-->