<?php
function bfm_add_remove_featured_ajax_process(){
    global $bp;
    if( !is_user_logged_in() || !current_user_can('create_users') )
        die();
    $uid = $bp->displayed_user->id;
    $is_featured = get_user_meta($uid, 'bfm_is_featured', true);
    if(!$is_featured){
        if ( update_user_meta($uid, 'bfm_is_featured', 1) )
                die('Remove Featured');
    }else{
        if ( update_user_meta($uid, 'bfm_is_featured', 0) )
                die('Make Featured');
    }
        
}
add_action('wp_ajax_bfm_featured_process','bfm_add_remove_featured_ajax_process');
