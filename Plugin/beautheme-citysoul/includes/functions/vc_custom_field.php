<?php
///Template Array VC
if(class_exists('WPBakeryShortCode')) {
    vc_add_shortcode_param( 'number', 'beatheme_custom_type_vc_map_number' );
    vc_add_shortcode_param( 'textarea_rows', 'beatheme_custom_type_vc_map_textarea' );
    vc_add_shortcode_param( 'textfield_disabled','beatheme_custom_type_vc_map_textfield_disabled' );
    vc_add_shortcode_param( 'radio', 'beau_custom_type_vc_radio',10);
}
if(!function_exists('beatheme_custom_type_vc_map_number')){
    function beatheme_custom_type_vc_map_number( $settings, $value ) {
       return '<div class="param_type_number">'
                 .'<input min="'.esc_attr($settings['min']).'" max="'.esc_attr($settings['max']).'" name="'.esc_attr($settings['param_name']).'" class="wpb_vc_param_value wpb-textinput ' .
                 esc_attr($settings['param_name'] ).' ' .
                 esc_attr( $settings['type'] ) . '_field" type="number" value="' . esc_attr( $value ) . '" />' .
                 '</div>';
    }
}
if(!function_exists('beatheme_custom_type_vc_map_textarea')){
    function beatheme_custom_type_vc_map_textarea( $settings, $value ) {
       return '<div class="param_type_textarea">'
                 .'<textarea name="'.esc_attr($settings['param_name']).'" class="wpb_vc_param_value wpb-textarea '.esc_attr($settings['param_name']).' textarea" rows="'.esc_attr($settings['rows']).'">'.esc_attr($value).'</textarea>' .
                 '</div>';
    }
}
if(!function_exists('beatheme_custom_type_vc_map_textfield_disabled')){
    function beatheme_custom_type_vc_map_textfield_disabled( $settings, $value ) {
        return '<div class="param_type_textfield_disabled">'
                 .'<input name="'.esc_attr($settings['param_name']).'" class="wpb_vc_param_value wpb-textinput ' .
                 esc_attr($settings['param_name'] ).' ' .
                 esc_attr( $settings['type'] ) . '_field" type="number" disabled value="' . esc_attr( $value ) . '" />' .
                 '</div>';
    }
}
if(!function_exists('beau_custom_type_vc_radio')){
    function beau_custom_type_vc_radio( $settings, $value ) {
        $output = '';
        if ( is_array( $value ) ) {
            $value = ''; // fix #1239
        }
        $current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
        $values = isset( $settings['value'] ) && is_array( $settings['value'] ) ? $settings['value'] : array( __( 'Yes' ) => 'true' );
        if ( ! empty( $values ) ) {
            foreach ( $values as $label => $v ) {
                $checked = count( $current_value ) > 0 && in_array( $v, $current_value ) ? ' checked' : '';
                $output .= '<label class="vc_radio-label"><input id="'
                           . $settings['param_name'] . '-' . $v . '" value="'
                           . $v . '" class="wpb_vc_param_value '
                           . $settings['param_name'] . ' ' . $settings['type'] . '"
                           type="radio" name="'
                           . $settings['param_name'].'"'
                           . $checked . ' >'
                           . $label . '</label>';
            }
        }

        return $output;
    }
}