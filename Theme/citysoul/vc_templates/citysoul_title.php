<?php
    $option = $element_description = $element_title = $hidden_dot = $hidden_line = $descriptioncolor = $titlecolor = $colorborder = $bgcolordot = $css = "";

    extract(shortcode_atts(array(
        'option'                    => '',
        'element_description'       => '',
        'element_title'             => '',
        'hidden_dot'                => '',
        'hidden_line'               => '',
        'descriptioncolor'          => '',
        'titlecolor'                => '',
        'colorborder'               => '',
        'bgcolordot'                => '',
        'css'                       => '',
    ), $atts));

    $id_ran = rand(1, 99999);
    $randomID   =  'citysoul-title-box-menu_'.$id_ran;
    
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

    //Setup style for shortcode
    $setup      = array(
        '.citysoul-title' => array(
            'color'                 => $descriptioncolor,
        ),
        '.text-main-list' => array(
            'color'                 => $titlecolor,
        ),
    );
    // Make css style for shortcode
    echo citysoul_css_shortcode($randomID, $setup);
?>
<div class="citysoul-title-box-menu text-border-bottom text-center <?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_html($randomID) ?>">
  <?php if ($element_title != ''): ?>
      <div class="text-title citysoul-title text-7x"><?php echo esc_html($element_title) ?></div>
  <?php endif ?>
  <?php if ($element_description != ''): ?>
      <div class="text-main-list view-all-link view-all-link-mirror text-more"><?php echo esc_html($element_description) ?></div>
  <?php endif ?>
</div>