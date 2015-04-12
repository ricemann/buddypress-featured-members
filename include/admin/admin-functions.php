<?php
function bfm_admin_init() {
   wp_register_style( 'bfm-admin-style',BFM_LIB_URL.'css/admin-style.css' );
   wp_register_style( 'bfm-jquery-ui-css', BFM_LIB_URL.'css/jquery-ui.min.css' ); 
}
add_action( 'admin_init', 'bfm_admin_init' );

//////////////////////////////////////////////////////////////////////////////////

function bfm_load_admin_styles(){
    wp_enqueue_style( 'bfm-admin-style' );
    wp_enqueue_style( 'bfm-jquery-ui-css' );
}

//////////////////////////////////////////////////////////////////////////////////

function bfm_admin_option_page(){
    $page = add_menu_page( 
            "BuddyPress Featured Member", 
            "Featured Member", 
            "manage_options",
            "buddypress-featured-member",
            'bfm_admin_option_page_layout',
            BFM_LIB_URL.'images/bfm-admin-icon.png'
            );
    add_action( 'admin_print_styles-'.$page , 'bfm_load_admin_styles' );
}
add_action('admin_menu', 'bfm_admin_option_page');

//////////////////////////////////////////////////////////////////////////////////


function bfm_admin_option_page_layout(){
    $html = '';
    $html .= '<div id="bfm_admin_page_container">';
        $html .= apply_filters('bfm_donation_markup','');
        $html .= '<div id="bfm_admin_page">';
        
        $html .=     '<div id="bfm_admin_page_header" class="bfm_box">';
        
        $html .=        '<div id="bfm_admin_logo">';
        $html .=        '<h1 class="bfm-logo">BuddyPress Featured Member</h1>';
        $html .=        '<h1 class="bfm-logo-text"> | Shortcode Generator</h1>';
        $html .=        '</div>';
        
        $html .=     '</div>';
        
        $html .=     '<div id="bfm_admin_page_fields" class="bfm_box">';
        $html .=        '<div id="bfm_admin_page_fields_container">';
        #########################################################################
        $html .=            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>Max. Number of Featured Members</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input type="number" class="bfm_text_box" name="max_featured_member" id="max_featured_member" value="5" />';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        #########################################################################
        $html .=            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>Filter By</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input value="active" type="text" class="bfm_text_box hidden" name="filter" id="filter" />';
        $html .=                    '<div class="radio-box filter_radio_box">';
        $html .=                    '<span class="option selected" value="active">Aactive</span>';
        $html .=                    '<span class="option" value="newest">Newest</span>';
        $html .=                    '<span class="option" value="popular">Popular</span>';
        $html .=                    '<span class="option" value="online">Online</span>';
        $html .=                    '<span class="option" value="alphabetical">Alphabetical</span>';
        $html .=                    '<span class="option" value="random">Random</span>';
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        #########################################################################
        $html .=            apply_filters('buat_filter_option','');
        #########################################################################
        $html .=            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>View Mode</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input type="text" value="slider" class="bfm_text_box hidden" name="view_mode" id="view_mode" />';
        $html .=                    '<div class="radio-box view_radio_box">';
        $html .=                    '<span class="option selected" value="slider">Slider</span>';
        $html .=                    '<span class="option" value="normal">Normal</span>';
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        #########################################################################
        $html .=            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>Avatar Style</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input type="text" value="round_0" class="bfm_text_box hidden" name="avatar_style" id="avatar_style" />';
        $html .=                    '<div class="avatar-style-box">';
        for($i=0;$i<=7;$i++):
        $html .=                        '<div class="avatar-box" value="round_'.$i.'">';
        $html .=                        '<img src="'.BFM_LIB_URL.'images/avatar.jpg" class="round_'.$i.'" />';
        $html .=                        '</div>';
        endfor;
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        #########################################################################
        $html .=            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>Avatar Size</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input type="text" value="150" class="bfm_avatar_size hidden" name="avatar_size" id="avatar_size" />';
        $html .=                    '<div class="avatar-size-box">';
        $html .=                        '<img src="'.BFM_LIB_URL.'images/avatar.jpg" class="round_0" />';
        $html .=                    '</div>';
        $html .=                    '<div class="avatar-size-box-slider">';
        $html .=                         '<div id="slider-range-max"></div>';
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        #########################################################################
        $html .=        '<textarea class="bfm_shortcode bfm_box hidden"></textarea>';
        $html .=        '<a class="generate_shortcode" href="#">Generate Shortcode</a>';
        $html .=        '</div>';
        $html .=     '</div>';
        
        $html .= '</div>';
    $html .= '</div>';
    
    echo $html;
}


//////////////////////////////////////////////



if( is_plugin_active('buddypress-user-account-type-pro/buddypress-user-account-type-pro.php') ){
    function bfm_filter_by_buat_type(){
        $settings = get_option('buatp_basic_setting',true);
        $field_name = $settings['buatp_type_field_selection'];
        $field_id = buatp_get_field_id_by_name($field_name);
        $type_names = buatp_get_all_types($field_id);
        if(!$type_names)
            return;
        $html  =            '<div class="bfm_single_field">';
        $html .=                '<div class="bfm_single_field_title">';
        $html .=                    '<p>BUAT User Type</p>';
        $html .=                '</div>';
        $html .=                '<div class="bfm_single_field_values">';
        $html .=                    '<input value="" type="text" class="bfm_text_box hidden" name="user_type" id="user_type" />';
        $html .=                    '<div class="radio-box user_type_radio_box">';
        foreach ($type_names as $val){
        $html .=                    '<span class="option" value="'.$val['name'].'">'.$val['name'].'</span>';
        }
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=                '<div class="clear"></div>';
        $html .=            '</div>';
        return $html;
    }
    add_filter('buat_filter_option','bfm_filter_by_buat_type');
}

?>