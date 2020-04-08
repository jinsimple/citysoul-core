(function($) {
    "use strict";
    //Template page
    jQuery(document).ready(function($) {
        $('div[data-name="main_body_font"],div[data-name="page_font_style"],div[data-name="dot_title_background"]').hide('fast');
        $('#page_template').change(function() {
            if ($(this).val() == 'templates/template-choose-sidebar.php') {
                $('#_beautheme_sidebar').show('fast');
            } else {
                $('#_beautheme_sidebar').hide('slow');
            }
        });
    });
})(jQuery);